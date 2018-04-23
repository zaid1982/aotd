<script type="text/javascript">

    var marw_otable;
    var marw_load_type;
    var marw_ats_field_formula;
    
    $(document).ready(function () {

        $('#form_marw').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                marw_atsRaw_value_0 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_1 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_2 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_3 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_4 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_5 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_6 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_7 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_8 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                marw_atsRaw_value_9 : {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Must be not more than 100 characters long'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                }
            }
        });
        
        $('#modal_ats_raw').on('hide.bs.modal', function() {
            if (marw_otable == 'macr')
                $('#modal_ats_certificate').removeClass('darken');
        });
        
        $('#marw_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_marw").data('bootstrapValidator');
            bootstrapValidator.validate();
            if (!bootstrapValidator.isValid()) {         
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }           
            $.SmartMessageBox({
                title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                content : "Are you sure?",
                buttons : '[No][Yes]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "Yes") {
                    $('#modal_waiting').on('shown.bs.modal', function(e){   
                        $('#marw_funct').val('save_ats_result');
                        if (f_submit_forms('form_marw', 'p_aotd', 'Test Result successfully saved.', '', 'modal_ats_raw')) {         
                            if (marw_otable == 'macr') {
                                macr_load_direct = $('#marw_atsField_id').val();
                                data_macr_workSummary = f_get_general_info_multiple('dt_ats_list_test', {}, {atsCert_id:$('#marw_atsCert_id').val()});
                                f_dataTable_draw(macr_otable_workSummary, data_macr_workSummary, 'datatable_macr_workSummary', 5);
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_marw_load_raw(load_type, atsLab_id, atsField_id, atsRes_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_marw').trigger('reset');
            $('#form_marw').bootstrapValidator('resetForm', true);
            marw_load_type = load_type;
            marw_otable = otable;
            var ats_sample_info = f_get_general_info('ats_sample_info', {atsLab_id:atsLab_id}, 'marw');
            var ats_field = f_get_general_info('ats_field', {atsField_id:atsField_id}, 'marw');
            var atsTest_name = f_get_value_from_table('ats_test', 'atsTest_id', ats_field.atsTest_id, 'atsTest_name');
            $('#lmarw_atsTest_name').html(atsTest_name);
            var ats_cert_field = f_get_general_info('ats_cert_field', {atsCert_id:ats_sample_info.atsCert_id, atsField_id:atsField_id});
            var ats_formula = f_get_general_info('ats_formula', {atsFormula_id:ats_cert_field.atsFormula_id});
            if (load_type == 1) {            
                $('#marw_title').html('Set Test Result');
                if (atsRes_id == '') {
                    if (!f_submit_normal('set_ats_res', {atsLab_id:atsLab_id, atsLab_code:ats_sample_info.atsLab_code, atsField_id:atsField_id, atsFormula_id:ats_cert_field.atsFormula_id}, 'p_aotd'))   return false;
                    atsRes_id = result_submit;
                }                
            } 
            $('#marw_formula').attr('src', 'img/aotd-formula/'+ats_formula.atsFormula_img);
            $('.marw_div_var').hide();
            for (var i=0;i<10;i++) {
                $('#form_marw').bootstrapValidator('enableFieldValidators', 'marw_atsRaw_value_'+i, false);
                $('#marw_atsRaw_id_'+i).val('');                
            }
            var arr_var_raw = f_get_general_info_multiple('vw_ats_raw', {}, {atsLab_id:atsLab_id, atsField_id:atsField_id}, '', 'atsVar_id');
            $.each(arr_var_raw,function(u) {
                $('#lmarw_atsVar_name_'+u).html(arr_var_raw[u].atsVar_name);
                $('#lmarw_atsVar_unit_'+u).html(arr_var_raw[u].atsUnits_unit);
                $('#marw_atsRaw_value_'+u).val(arr_var_raw[u].atsRaw_value);
                $('#marw_atsRaw_id_'+u).val(arr_var_raw[u].atsRaw_id);
                $('#marw_div_var_'+u).show();
                $('#form_marw').bootstrapValidator('enableFieldValidators', 'marw_atsRaw_value_'+u, true);
                $('#form_marw').bootstrapValidator('enableFieldValidators', 'marw_atsRaw_value_'+u, ats_formula.atsFormula_id != '31', 'numeric');
            });
            if (marw_otable == 'macr') 
                $('#modal_ats_certificate').addClass('darken');
            $('#marw_atsLab_id').val(atsLab_id); 
            $('#marw_atsField_id').val(atsField_id); 
            $('#marw_atsRes_id').val(atsRes_id==null?'':atsRes_id); 
            $('#marw_atsFormula_id').val(ats_formula.atsFormula_id);
            $('#modal_ats_raw').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>