<script type="text/javascript">
    
    var mflt_otable;
    var mflt_load_type;
    var mflt_otable_field;
    var data_mflt_field;
    
    $(document).ready(function () {
        
        get_option('mflt_effCat_id', '1', 'eff_cat', 'effCat_id', 'effCat_name', 'effCat_status', ' ', 'ref_id');
        
        $('#form_mflt_form').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mflt_effTest_name : {
                    validators: {
                        notEmpty: {
                            message: 'Test Name is required'
                        },
                        stringLength : {
                            max : 150,
                            message : 'Test Name must not more than 150 characters'
                        }
                    }
                },                
                mflt_effTest_desc : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Test Description must not more than 255 characters'
                        }
                    }
                },    
                mflt_effCat_id : {
                    validators: {
                        notEmpty: {
                            message: 'Evaluation Group is required'
                        }
                    }
                },  
                mflt_effTest_cost : {
                    validators: {
                        numeric: {
                            message: 'Cost is not a valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        },
                        callback: {
                            message: 'Cost must be equal or greater than 0',
                            callback: function (value, validator, $field) {
                                return (value == '' || isNaN(value) || parseFloat(value) >= 0);
                            }
                        }
                    }
                },    
                mflt_effTest_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        var datatable_mflt_field = undefined; 
        mflt_otable_field = $('#datatable_mflt_field').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mflt_field) {
                    datatable_mflt_field = new ResponsiveDatatablesHelper($('#datatable_mflt_field'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mflt_field.createExpandIcon(nRow);
                var info = mflt_otable_field.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mflt_field.respond();
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'effField_name'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_mflf_load_field (2, '+row.effField_id+', '+$('#mflt_effTest_id').val()+',\'mflt\');" data-toggle="tooltip" data-original-title="Edit Field Name"><i class="fa fa-edit"></i></a>';
                            $label += ' <a href="javascript:void(0)" class="btn btn-danger btn-xs" style="width:24px" onclick="f_mflf_delete_field ('+row.effField_id+',\'mflt\');" data-toggle="tooltip" data-original-title="Delete Field Name"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        $('#mflt_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mflt_form").data('bootstrapValidator');
            bootstrapValidator.validate();
            if (!bootstrapValidator.isValid()) {         
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }
            if (data_mflt_field.length == 0) {
                f_notify(2, 'Error', 'Field Name must be added');    
                return false;
            }
            $.SmartMessageBox({
                title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                content : "Are you sure?",
                buttons : '[No][Yes]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "Yes") {
                    $('#modal_waiting').on('shown.bs.modal', function(e){   
                        $('#mflt_funct').val('save_eff_test');
                        if (f_submit_forms('form_mflt,#form_mflt_form', 'p_aotd', 'Data successfully saved', '', 'modal_eff_test')) {         
                            if (mflt_otable == 'flm') {
                                f_flm_table_test();
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });          
        });
        
    });
    
    function f_mflt_edit(edit_type) {
        if (edit_type == 1) {
            $('.mflt_editView').show();
            $('.mflt_infoView').hide();
            mflt_otable_field.columns(3).visible(true);
        } else {
            $('.mflt_editView').hide();
            $('.mflt_infoView').show();
            mflt_otable_field.columns(3).visible(false);
        }
        $('#modal_eff_test').scrollTop(0);
    }
    
    function f_mflt_table_field() {
        data_mflt_field = f_get_general_info_multiple('dt_eff_field', {effTest_id:$('#mflt_effTest_id').val()}, '', '', 'effField_id');
        f_dataTable_draw(mflt_otable_field, data_mflt_field, 'datatable_mflt_field', 4);
    }
    
    function f_mflt_load_test(load_type, effTest_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){   
            $('#form_mflt,#form_mflt_form').trigger('reset'); 
            $('#form_mflt_form').bootstrapValidator('resetForm', true);
            $('#form_mflt_form').find('input, textarea, select').prop('disabled',false);
            mflt_otable = otable;
            mflt_load_type = load_type;
            $('.mflt_viewOnly').prop('disabled',true);
            if (load_type == 1) {
                if (!f_submit_normal('create_eff_test', {}, 'p_aotd', '', errMsg_default))   
                    return false;
                f_flm_table_test();
                effTest_id = result_submit;
                f_mflt_edit(1);
            } else {
                f_mflt_edit(3);
            }
            var lab_info = f_get_general_info('aotd_lab', {lab_id:'EFF'});
            var test_info = f_get_general_info('vw_eff_test', {effTest_id:effTest_id}, 'mflt');
            $('#mflt_lab_name').val(lab_info.lab_name);
            $('#lmflt_lab_name').html(lab_info.lab_name);
            $('#lmflt_effTest_cost').html(formattedNumber(test_info.effTest_cost,2));
            $('#mflt_effTest_ids').val(test_info.effTest_id);
            $("input[name=mflt_effTest_status][value=" + test_info.effTest_status + "]").prop('checked', true);
            f_mflt_table_field();
            $('#modal_eff_test').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>