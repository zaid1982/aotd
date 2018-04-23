<script type="text/javascript">
    
    var mplt_otable;
    var mplt_load_type;
    var mplt_otable_field;
    var data_mplt_field;
    
    $(document).ready(function () {
                
        $('#form_mplt_form').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mplt_phyTest_name : {
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
                mplt_phyTest_parameters : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Test Parameters must not more than 255 characters'
                        }
                    }
                },                 
                mplt_phyTest_cat : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Category must not more than 150 characters'
                        }
                    }
                },                 
                mplt_phyTest_equipment : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Equipment Used must not more than 150 characters'
                        }
                    }
                },    
                mplt_phyTest_cost : {
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
                mplt_phyTest_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        var datatable_mplt_field = undefined; 
        mplt_otable_field = $('#datatable_mplt_field').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mplt_field) {
                    datatable_mplt_field = new ResponsiveDatatablesHelper($('#datatable_mplt_field'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mplt_field.createExpandIcon(nRow);
                var info = mplt_otable_field.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mplt_field.respond();
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'phyField_name'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_mplf_load_field (2, '+row.phyField_id+', '+$('#mplt_phyTest_id').val()+',\'mplt\');" data-toggle="tooltip" data-original-title="Edit Field Name"><i class="fa fa-edit"></i></a>';
                            $label += ' <a href="javascript:void(0)" class="btn btn-danger btn-xs" style="width:24px" onclick="f_mplf_delete_field ('+row.phyField_id+',\'mplt\');" data-toggle="tooltip" data-original-title="Delete Field Name"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        $('#mplt_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mplt_form").data('bootstrapValidator');
            bootstrapValidator.validate();
            if (!bootstrapValidator.isValid()) {         
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }
            if (data_mplt_field.length == 0) {
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
                        $('#mplt_funct').val('save_phy_test');
                        if (f_submit_forms('form_mplt,#form_mplt_form', 'p_aotd', 'Data successfully saved', '', 'modal_phy_test')) {         
                            if (mplt_otable == 'plm') {
                                f_plm_table_test();
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });          
        });
        
    });
    
    function f_mplt_edit(edit_type) {
        if (edit_type == 1) {
            $('.mplt_editView').show();
            $('.mplt_infoView').hide();
            mplt_otable_field.columns(3).visible(true);
        } else {
            $('.mplt_editView').hide();
            $('.mplt_infoView').show();
            mplt_otable_field.columns(3).visible(false);
        }
        $('#modal_phy_test').scrollTop(0);
    }
    
    function f_mplt_table_field() {
        data_mplt_field = f_get_general_info_multiple('dt_phy_field', {phyTest_id:$('#mplt_phyTest_id').val()}, '', '', 'phyField_id');
        f_dataTable_draw(mplt_otable_field, data_mplt_field, 'datatable_mplt_field', 4);
    }
    
    function f_mplt_load_test(load_type, phyTest_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){   
            $('#form_mplt,#form_mplt_form').trigger('reset'); 
            $('#form_mplt_form').bootstrapValidator('resetForm', true);
            $('#form_mplt_form').find('input, textarea, select').prop('disabled',false);
            mplt_otable = otable;
            mplt_load_type = load_type;
            $('.mplt_viewOnly').prop('disabled',true);
            if (load_type == 1) {
                if (!f_submit_normal('create_phy_test', {}, 'p_aotd', '', errMsg_default))   
                    return false;
                f_flm_table_test();
                phyTest_id = result_submit;
                f_mplt_edit(1);
            } else {
                f_mplt_edit(3);
            }
            var lab_info = f_get_general_info('aotd_lab', {lab_id:'PHY'});
            var test_info = f_get_general_info('vw_phy_test', {phyTest_id:phyTest_id}, 'mplt');
            $('#mplt_lab_name').val(lab_info.lab_name);
            $('#lmplt_lab_name').html(lab_info.lab_name);
            $('#lmplt_phyTest_cost').html(formattedNumber(test_info.phyTest_cost,2));
            $('#mplt_phyTest_ids').val(test_info.phyTest_id);
            $("input[name=mplt_phyTest_status][value=" + test_info.phyTest_status + "]").prop('checked', true);
            f_mplt_table_field();
            $('#modal_phy_test').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>