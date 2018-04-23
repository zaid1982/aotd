<script type="text/javascript">
        
    var mbsl_otable;
    var mbsl_load_type;
    var mbsl_1st_load = true;
    
    $(document).ready(function () {
        
        $('#form_mbsl').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mbsl_client_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Name is required'
                        }
                    }
                },            
                mbsl_bdtRep_sampleDesc : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Sample Description must not more than 150 characters'
                        }
                    }
                },       
                mbsl_bdtRep_totalSample : {
                    validators: {
                        notEmpty: {
                            message: 'Total Sample is required'
                        },
                        integer: {
                            message: 'Total Sample is not an integer'
                        }
                    }
                },                          
                mbsl_bdtRep_substance : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Name of Substance must not more than 150 characters'
                        }
                    }
                },                         
                mbsl_bdtRep_formula : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Empirical Formula must not more than 100 characters'
                        }
                    }
                },                         
                mbsl_bdtRep_component : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Purity / Relative Proportion must not more than 150 characters'
                        }
                    }
                },                         
                mbsl_bdtRep_physical : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Physical Characteristics must not more than 100 characters'
                        }
                    }
                },                         
                mbsl_bdtRep_solubility : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Solubility must not more than 100 characters'
                        }
                    }
                },                        
                mbsl_bdtRep_condition : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Storage Condition must not more than 100 characters'
                        }
                    }
                },         
                mbsl_bdtRep_msds : {
                    validators: {
                        notEmpty: {
                            message: 'MSDS is required'
                        }
                    }
                },                     
                mbsl_bdtRep_remark : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Remarks must not more than 255 characters'
                        }
                    }
                }    
            }
        });
                
        $('#modal_bio_sample_login').on('hide.bs.modal', function() {
            if (mbsl_otable == 'mbcr')
                $('#modal_bio_certificate').removeClass('darken');
        });
        
        $('#mbsl_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mbsl").data('bootstrapValidator');
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
                        var msg_success = mbsl_load_type == 1 ? 'Certificate successfully created. Please proceed with sample naming from the \'Draft\' list.' : 'Certificate Information successfully updated.';
                        if (f_submit_forms('form_mbsl', 'p_aotd', msg_success, '', 'modal_bio_sample_login')) {         
                            if (mbsl_load_type == 1 && mbsl_otable == 'blg') {
                                f_blg_summary();
                                f_blg_process (blg_summary_id);
                            } else if (mbsl_load_type == 2 && mbsl_otable == 'mbcr') { 
                                f_get_general_info('vw_bdt_cert', {bdtRep_no:$('#mbsl_bdtRep_no').val()}, 'mbcr');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);                        
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_mbsl_load_sample_login(load_type, bdtRep_no, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){  
            if (mbsl_1st_load) {
                get_option('mbsl_client_id', '0', 'aotd_client_info', 'client_id', 'client_organisation', 'client_black');
                mbsl_1st_load = false;
            }
            $('#mbsl_client_id').val('').trigger('change');
            $('#form_mbsl').trigger('reset'); 
            $('#form_mbsl').bootstrapValidator('resetForm', true);
            //$('#form_mbsl').find('input, radio, textarea, select').prop('disabled',false);
            mbsl_otable = otable;
            mbsl_load_type = load_type;
            $('.mbsl_viewOnly').prop('disabled',true);
            $('.mbsl_hideFill, .mbsl_hideEdit').show();
            if (mbsl_load_type == 1) {                
                $('.mbsl_hideFill').hide();
                $('#mbsl_funct').val('create_bdt_cert');
            } else if (mbsl_load_type == 2) {
                $('.mbsl_hideEdit').hide();
                $('#mbsl_funct').val('save_bdt_cert_info');
                $('#mbsl_client_id, #mbsl_bdtRep_totalSample').prop('disabled',true);
                var cert_info = f_get_general_info('vw_bdt_cert', {bdtRep_no:bdtRep_no}, 'mbsl');
                $('#mbsl_bdtRep_no2').val(bdtRep_no);
                $("input[name='mbsl_bdtRep_msds'][value=" + cert_info.bdtRep_msds + "]").prop('checked', true);
                $('#mbsl_client_id').trigger('change');
                if (mbsl_otable == 'mbcr') 
                    $('#modal_bio_certificate').addClass('darken');
            }
            $('#modal_bio_sample_login').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>