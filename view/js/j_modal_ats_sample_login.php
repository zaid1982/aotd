<script type="text/javascript">
        
    var masl_otable;
    var masl_load_type;
    var masl_1st_load = true;
    
    $(document).ready(function () {
        
        $('#form_masl').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                masl_client_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Name is required'
                        }
                    }
                }, 
                masl_atsCert_accredited : {
                    validators: {
                        notEmpty: {
                            message: 'Accredited is required'
                        }
                    }
                },  
                masl_atsCert_totalSample : {
                    validators: {
                        notEmpty: {
                            message: 'Total Sample is required'
                        },
                        integer: {
                            message: 'Total Sample is not an integer'
                        }
                    }
                },      
                'masl_atsTest_id[]' : {
                    validators : {
                        choice : {
                            min : 1,
                            message : 'At least 1 Analysis required'
                        }                        
                    }
                },
                masl_atsCert_equipment : {
                    validators: {
                        notEmpty: {
                            message: 'Equipment is required'
                        }
                    }
                },    
                masl_atsCert_chemical : {
                    validators: {
                        notEmpty: {
                            message: 'Chemical/Glassware is required'
                        }
                    }
                },                             
                masl_atsType_id : {
                    validators: {
                        notEmpty : {
                            message : 'Type of Sample is required'
                        }
                    }
                },                          
                masl_atsCondition_id : {
                    validators: {
                        notEmpty : {
                            message : 'Condition of Sample is required'
                        }
                    }
                },        
                'masl_ats_analyst_user[]' : {
                    validators : {
                        choice : {
                            min : 1,
                            message : 'At least 1 Analyst required'
                        }                        
                    }
                },                   
                masl_atsCert_remark : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Remarks must not more than 255 characters'
                        }
                    }
                }    
            }
        });
                
        $('#modal_ats_sample_login').on('hide.bs.modal', function() {
            if (masl_otable == 'macr')
                $('#modal_ats_certificate').removeClass('darken');
        });
        
        $('#masl_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_masl").data('bootstrapValidator');
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
                        var msg_success = masl_load_type == 1 ? 'Certificate successfully created. Please proceed with sample naming from the \'Draft\' list.' : 'Certificate Information successfully updated.';
                        if (f_submit_forms('form_masl', 'p_aotd', msg_success, '', 'modal_ats_sample_login')) {         
                            if (masl_load_type == 1 && masl_otable == 'clg') {
                                f_clg_summary();
                                f_clg_process (clg_summary_id);
                            } else if (masl_load_type == 2 && masl_otable == 'macr') { 
                                f_get_general_info('vw_ats_cert', {atsCert_id:$('#masl_atsCert_id').val()}, 'macr');
                                f_get_general_info('vw_ats_analyst', {}, 'macr', '', {atsCert_id:$('#masl_atsCert_id').val()});
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);                        
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_masl_load_sample_login(load_type, atsCert_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){  
            if (masl_1st_load) {
                get_option('masl_client_id', '0', 'aotd_client_info', 'client_id', 'client_organisation', 'client_black');
                get_option('masl_atsTest_id', '1', 'ats_test', 'atsTest_id', 'atsTest_name', 'atsTest_status', '');
                get_option('masl_atsType_id', '1', 'ats_type', 'atsType_id', 'atsType_desc', 'atsType_status', ' ', 'ref_id');
                get_option('masl_atsCondition_id', '1', 'ats_condition', 'atsCondition_id', 'atsCondition_desc', 'atsCondition_status', ' ', 'ref_id');
                get_option('masl_ats_analyst_user', '1', 'ats_analyst', '', '', '', '', 'ref_id');
                masl_1st_load = false;
            }
            $('#masl_client_id').val('').trigger('change');
            $('#masl_atsTest_id').val([]).trigger('change');
            $('#masl_ats_analyst_user').val([]).trigger('change');
            $('#form_masl').trigger('reset'); 
            $('#form_masl').bootstrapValidator('resetForm', true);
            //$('#form_masl').find('input, radio, textarea, select').prop('disabled',false);
            $('#form_masl').bootstrapValidator('enableFieldValidators', 'masl_atsTest_id[]', false); 
            masl_otable = otable;
            masl_load_type = load_type;
            $('.masl_viewOnly').prop('disabled',true);
            $('.masl_hideFill, .masl_hideEdit').show();
            if (masl_load_type == 1) {                
                $('.masl_hideFill').hide();
                $('#masl_funct').val('create_ats_cert');
                $('#form_masl').bootstrapValidator('enableFieldValidators', 'masl_atsTest_id[]', true); 
            } else if (masl_load_type == 2) {
                $('.masl_hideEdit').hide();
                $('#masl_funct').val('save_ats_cert_info');
                $('#masl_client_id, #masl_atsCert_totalSample').prop('disabled',true);
                $("input[name='masl_atsCert_accredited']").prop('disabled',true);
                var cert_info = f_get_general_info('vw_ats_cert', {atsCert_id:atsCert_id}, 'masl');
                $("input[name='masl_atsCert_accredited'][value=" + cert_info.atsCert_accredited + "]").prop('checked', true);
                $("input[name='masl_atsCert_equipment'][value=" + cert_info.atsCert_equipment + "]").prop('checked', true);
                $("input[name='masl_atsCert_chemical'][value=" + cert_info.atsCert_chemical + "]").prop('checked', true);
                $('#masl_client_id').trigger('change');
                var arr_analyst = [];
                var arr_ats_analyst = f_get_general_info_multiple('ats_analyst', {atsCert_id:atsCert_id});
                $.each(arr_ats_analyst,function(u) {
                    arr_analyst.push(arr_ats_analyst[u].user_id);
                });
                $('#masl_ats_analyst_user').val(arr_analyst).trigger('change');
                if (masl_otable == 'macr') 
                    $('#modal_ats_certificate').addClass('darken');
            }
            $('#modal_ats_sample_login').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>