<script type="text/javascript">
        
    var mfsl_otable;
    var mfsl_load_type;
    var mfsl_1st_load = true;
    
    $(document).ready(function () {
        
        $('#form_mfsl').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mfsl_client_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Name is required'
                        }
                    }
                },      
                mfsl_effRep_totalSample : {
                    validators: {
                        notEmpty: {
                            message: 'Total Sample is required'
                        },
                        integer: {
                            message: 'Total Sample is not an integer'
                        }
                    }
                },                          
                mfsl_effRep_physical : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Physical Form must not more than 100 characters'
                        }
                    }
                },                         
                mfsl_effRep_quantity : {
                    validators: {
                        stringLength : {
                            max : 30,
                            message : 'Quantity must not more than 30 characters'
                        }
                    }
                },                         
                mfsl_effRep_color : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Colour must not more than 100 characters'
                        }
                    }
                },                         
                mfsl_effRep_other : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Other must not more than 255 characters'
                        }
                    }
                },                         
                mfsl_effTest_id : {
                    validators: {
                        notEmpty: {
                            message: 'Test Method is required'
                        }
                    }
                }         
            }
        });
                
        $('#modal_eff_sample_login').on('hide.bs.modal', function() {
            if (mfsl_otable == 'mfcr')
                $('#modal_eff_certificate').removeClass('darken');
        });
        
        $('#mfsl_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mfsl").data('bootstrapValidator');
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
                        var msg_success = mfsl_load_type == 1 ? 'Certificate successfully created. Please proceed with sample naming from the \'Draft\' list.' : 'Certificate Information successfully updated.';
                        if (f_submit_forms('form_mfsl', 'p_aotd', msg_success, '', 'modal_eff_sample_login')) {         
                            if (mfsl_load_type == 1 && mfsl_otable == 'flg') {
                                f_flg_summary();
                                f_flg_process (flg_summary_id);
                            } else if (mfsl_load_type == 2 && mfsl_otable == 'mfcr') { 
                                f_get_general_info('vw_eff_cert', {effRep_no:$('#mfsl_effRep_no').val()}, 'mfcr');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);                        
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_mfsl_load_sample_login(load_type, effRep_no, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){  
            if (mfsl_1st_load) {
                get_option('mfsl_client_id', '0', 'aotd_client_info', 'client_id', 'client_organisation', 'client_black');
                get_option('mfsl_effTest_id', '1', 'eff_test', 'effTest_id', 'effTest_name', 'effTest_status');
                mfsl_1st_load = false;
            }
            $('#mfsl_client_id').val('').trigger('change');
            $('#mfsl_effTest_id').val('').trigger('change');
            $('#form_mfsl').trigger('reset'); 
            $('#form_mfsl').bootstrapValidator('resetForm', true);
            //$('#form_mfsl').find('input, radio, textarea, select').prop('disabled',false);
            mfsl_otable = otable;
            mfsl_load_type = load_type;
            $('.mfsl_viewOnly').prop('disabled',true);
            $('.mfsl_hideFill, .mfsl_hideEdit').show();
            if (mfsl_load_type == 1) {                
                $('.mfsl_hideFill').hide();
                $('#mfsl_funct').val('create_eff_cert');
            } else if (mfsl_load_type == 2) {
                $('.mfsl_hideEdit').hide();
                $('#mfsl_funct').val('save_eff_cert_info');
                $('#mfsl_client_id, #mfsl_effTest_id, #mfsl_effRep_totalSample').prop('disabled',true);
                var cert_info = f_get_general_info('vw_eff_cert', {effRep_no:effRep_no}, 'mfsl');
                $('#mfsl_effRep_no2').val(effRep_no);
                $("input[name='mfsl_effRep_msds'][value=" + cert_info.effRep_msds + "]").prop('checked', true);
                $('#mfsl_client_id').trigger('change');
                $('#mfsl_effTest_id').trigger('change');
                if (mfsl_otable == 'mfcr') 
                    $('#modal_eff_certificate').addClass('darken');
            }
            $('#modal_eff_sample_login').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>