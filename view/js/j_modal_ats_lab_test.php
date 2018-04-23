<script type="text/javascript">
        
    var malt_otable;
    var malt_load_type;
    var malt_otable_component;
    var data_malt_component;
    
    $(document).ready(function () {
        
        $('#form_malt_form').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                malt_atsTest_name : {
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
                malt_atsTest_desc : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Test Description must not more than 255 characters'
                        }
                    }
                },                
                malt_atsTest_cat : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Test Method must not more than 255 characters'
                        }
                    }
                },                
                malt_atsTest_equipment : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Test Size must not more than 100 characters'
                        }
                    }
                },
                malt_atsTest_cost : {
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
                malt_atsTest_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        var datatable_malt_component = undefined; 
        malt_otable_component = $('#datatable_malt_component').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_malt_component) {
                    datatable_malt_component = new ResponsiveDatatablesHelper($('#datatable_malt_component'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_malt_component.createExpandIcon(nRow);
                var info = malt_otable_component.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_malt_component.respond();
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'atsField_name'},
                    {mData: 'formula_list'},
                    {mData: null, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_malc_load_component (2, '+row.atsField_id+', '+$('#malt_atsTest_id').val()+',\'malt\');" data-toggle="tooltip" data-original-title="Edit Component"><i class="fa fa-edit"></i></a>';
                            $label += ' <a href="javascript:void(0)" class="btn btn-danger btn-xs" style="width:24px" onclick="f_malc_delete_component ('+row.atsField_id+',\'malt\');" data-toggle="tooltip" data-original-title="Delete Component"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        $('#malt_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_malt_form").data('bootstrapValidator');
            bootstrapValidator.validate();
            if (!bootstrapValidator.isValid()) {         
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }
            if (data_malt_component.length == 0) {
                f_notify(2, 'Error', 'Component must be added');    
                return false;
            }
            $.SmartMessageBox({
                title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                content : "Are you sure?",
                buttons : '[No][Yes]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "Yes") {
                    $('#modal_waiting').on('shown.bs.modal', function(e){   
                        $('#malt_funct').val('save_ats_test');
                        if (f_submit_forms('form_malt,#form_malt_form', 'p_aotd', 'Data successfully saved', '', 'modal_ats_lab_test')) {         
                            if (malt_otable == 'alm') {
                                f_alm_table_test();
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });          
        });
        
    });
    
    function f_malt_edit(edit_type) {
        if (edit_type == 1) {
            $('.malt_editView').show();
            $('.malt_infoView').hide();
            malt_otable_component.columns(3).visible(true);
        } else {
            $('.malt_editView').hide();
            $('.malt_infoView').show();
            malt_otable_component.columns(3).visible(false);
        }
        $('#modal_ats_lab_test').scrollTop(0);
    }
    
    function f_malt_table_field() {
        data_malt_component = f_get_general_info_multiple('dt_ats_field', {atsTest_id:$('#malt_atsTest_id').val()}, '', '', 'atsField_id');
        f_dataTable_draw(malt_otable_component, data_malt_component, 'datatable_malt_component', 4);
    }
    
    function f_malt_load_test(load_type, atsTest_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){           
            $('#form_malt,#form_malt_form').trigger('reset'); 
            $('#form_malt_form').bootstrapValidator('resetForm', true);
            $('#form_malt_form').find('input, textarea, select').prop('disabled',false);
            malt_otable = otable;
            malt_load_type = load_type;
            $('.malt_viewOnly').prop('disabled',true);
            if (load_type == 1) {
                if (!f_submit_normal('create_ats_test', {}, 'p_aotd', '', errMsg_default))   
                    return false;
                f_alm_table_test();
                atsTest_id = result_submit;
                f_malt_edit(1);
            } else {
                f_malt_edit(3);
            }
            var lab_info = f_get_general_info('aotd_lab', {lab_id:'ATS'});
            var test_info = f_get_general_info('vw_ats_test', {atsTest_id:atsTest_id}, 'malt');
            $('#malt_lab_name').val(lab_info.lab_name);
            $('#lmalt_lab_name').html(lab_info.lab_name);
            $('#lmalt_atsTest_cost').html(test_info.atsTest_cost);
            $('#malt_atsTest_ids').val(test_info.atsTest_id);
            $("input[name=malt_atsTest_status][value=" + test_info.atsTest_status + "]").prop('checked', true);
            f_malt_table_field();
            $('#modal_ats_lab_test').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>