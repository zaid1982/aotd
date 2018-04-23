<script type="text/javascript">
        
    var mcsl_otable;
    var mcsl_load_type;
    var mcsl_1st_load = true;
    
    $(document).ready(function () {
        
        $('#form_mcsl').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mcsl_client_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Name is required'
                        }
                    }
                },            
                mcsl_ectRep_sampleDesc : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Sample Description must not more than 150 characters'
                        }
                    }
                },       
                mcsl_ectRep_totalSample : {
                    validators: {
                        notEmpty: {
                            message: 'Total Sample is required'
                        },
                        integer: {
                            message: 'Total Sample is not an integer'
                        }
                    }
                },                          
                mcsl_ectRep_substance : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Name of Substance must not more than 150 characters'
                        }
                    }
                },                         
                mcsl_ectRep_formula : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Empirical Formula must not more than 100 characters'
                        }
                    }
                },                         
                mcsl_ectRep_component : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Purity / Relative Proportion must not more than 150 characters'
                        }
                    }
                },                         
                mcsl_ectRep_physical : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Physical Characteristics must not more than 100 characters'
                        }
                    }
                },                         
                mcsl_ectRep_solubility : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Solubility must not more than 100 characters'
                        }
                    }
                },                        
                mcsl_ectRep_condition : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Storage Condition must not more than 100 characters'
                        }
                    }
                },         
                mcsl_ectRep_msds : {
                    validators: {
                        notEmpty: {
                            message: 'MSDS is required'
                        }
                    }
                },                     
                mcsl_ectRep_remark : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Remarks must not more than 255 characters'
                        }
                    }
                }    
            }
        });
                
        $('#modal_eco_sample_login').on('hide.bs.modal', function() {
            if (mcsl_otable == 'mccr')
                $('#modal_eco_certificate').removeClass('darken');
        });
        
        $('#mcsl_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mcsl").data('bootstrapValidator');
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
                        var msg_success = mcsl_load_type == 1 ? 'Certificate successfully created. Please proceed with sample naming from the \'Draft\' list.' : 'Certificate Information successfully updated.';
                        if (f_submit_forms('form_mcsl', 'p_aotd', msg_success, '', 'modal_eco_sample_login')) {         
                            if (mcsl_load_type == 1 && mcsl_otable == 'elg') {
                                f_elg_summary();
                                f_elg_process (elg_summary_id);
                            } else if (mcsl_load_type == 2 && mcsl_otable == 'mccr') { 
                                f_get_general_info('vw_ect_cert', {ectRep_no:$('#mcsl_ectRep_no').val()}, 'mccr');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);                        
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_mcsl_load_sample_login(load_type, ectRep_no, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){  
            if (mcsl_1st_load) {
                get_option('mcsl_client_id', '0', 'aotd_client_info', 'client_id', 'client_organisation', 'client_black');
                mcsl_1st_load = false;
            }
            $('#mcsl_client_id').val('').trigger('change');
            $('#form_mcsl').trigger('reset'); 
            $('#form_mcsl').bootstrapValidator('resetForm', true);
            //$('#form_mcsl').find('input, radio, textarea, select').prop('disabled',false);
            mcsl_otable = otable;
            mcsl_load_type = load_type;
            $('.mcsl_viewOnly').prop('disabled',true);
            $('.mcsl_hideFill, .mcsl_hideEdit').show();
            if (mcsl_load_type == 1) {                
                $('.mcsl_hideFill').hide();
                $('#mcsl_funct').val('create_ect_cert');
            } else if (mcsl_load_type == 2) {
                $('.mcsl_hideEdit').hide();
                $('#mcsl_funct').val('save_ect_cert_info');
                $('#mcsl_client_id, #mcsl_ectRep_totalSample').prop('disabled',true);
                var cert_info = f_get_general_info('vw_ect_cert', {ectRep_no:ectRep_no}, 'mcsl');
                $('#mcsl_ectRep_no2').val(ectRep_no);
                $("input[name='mcsl_ectRep_msds'][value=" + cert_info.ectRep_msds + "]").prop('checked', true);
                $('#mcsl_client_id').trigger('change');
                if (mcsl_otable == 'mccr') 
                    $('#modal_eco_certificate').addClass('darken');
            }
            $('#modal_eco_sample_login').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>