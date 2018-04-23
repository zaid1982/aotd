<script type="text/javascript">
        
    var mpsl_otable;
    var mpsl_load_type;
    var mpsl_1st_load = true;
    
    $(document).ready(function () {
        
        $('#form_mpsl').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mpsl_client_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Name is required'
                        }
                    }
                },      
                mpsl_phyRep_totalSample : {
                    validators: {
                        notEmpty: {
                            message: 'Total Sample is required'
                        },
                        integer: {
                            message: 'Total Sample is not an integer'
                        }
                    }
                },                          
                mpsl_phyRep_physical : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Physical Form must not more than 100 characters'
                        }
                    }
                },                         
                mpsl_phyRep_quantity : {
                    validators: {
                        stringLength : {
                            max : 30,
                            message : 'Quantity must not more than 30 characters'
                        }
                    }
                },                         
                mpsl_phyRep_color : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Colour must not more than 100 characters'
                        }
                    }
                },                         
                mpsl_phyRep_other : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Other must not more than 255 characters'
                        }
                    }
                },                         
                mpsl_phyTest_id : {
                    validators: {
                        notEmpty: {
                            message: 'Test Method is required'
                        }
                    }
                }         
            }
        });
                
        $('#modal_phy_sample_login').on('hide.bs.modal', function() {
            if (mpsl_otable == 'mpcr')
                $('#modal_phy_certificate').removeClass('darken');
        });
        
        $('#mpsl_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mpsl").data('bootstrapValidator');
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
                        var msg_success = mpsl_load_type == 1 ? 'Certificate successfully created. Please proceed with sample naming from the \'Draft\' list.' : 'Certificate Information successfully updated.';
                        if (f_submit_forms('form_mpsl', 'p_aotd', msg_success, '', 'modal_phy_sample_login')) {         
                            if (mpsl_load_type == 1 && mpsl_otable == 'plg') {
                                f_plg_summary();
                                f_plg_process (plg_summary_id);
                            } else if (mpsl_load_type == 2 && mpsl_otable == 'mpcr') { 
                                f_get_general_info('vw_phy_cert', {phyRep_no:$('#mpsl_phyRep_no').val()}, 'mpcr');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);                        
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_mpsl_load_sample_login(load_type, phyRep_no, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){  
            if (mpsl_1st_load) {
                get_option('mpsl_client_id', '0', 'aotd_client_info', 'client_id', 'client_organisation', 'client_black');
                get_option('mpsl_phyTest_id', '1', 'phy_test', 'phyTest_id', 'phyTest_name', 'phyTest_status');
                mpsl_1st_load = false;
            }
            $('#mpsl_client_id').val('').trigger('change');
            $('#mpsl_phyTest_id').val('').trigger('change');
            $('#form_mpsl').trigger('reset'); 
            $('#form_mpsl').bootstrapValidator('resetForm', true);
            //$('#form_mpsl').find('input, radio, textarea, select').prop('disabled',false);
            mpsl_otable = otable;
            mpsl_load_type = load_type;
            $('.mpsl_viewOnly').prop('disabled',true);
            $('.mpsl_hideFill, .mpsl_hideEdit').show();
            if (mpsl_load_type == 1) {                
                $('.mpsl_hideFill').hide();
                $('#mpsl_funct').val('create_phy_cert');
            } else if (mpsl_load_type == 2) {
                $('.mpsl_hideEdit').hide();
                $('#mpsl_funct').val('save_phy_cert_info');
                $('#mpsl_client_id, #mpsl_phyTest_id, #mpsl_phyRep_totalSample').prop('disabled',true);
                var cert_info = f_get_general_info('vw_phy_cert', {phyRep_no:phyRep_no}, 'mpsl');
                $('#mpsl_phyRep_no2').val(phyRep_no);
                $("input[name='mpsl_phyRep_msds'][value=" + cert_info.phyRep_msds + "]").prop('checked', true);
                $('#mpsl_client_id').trigger('change');
                $('#mpsl_phyTest_id').trigger('change');
                if (mpsl_otable == 'mpcr') 
                    $('#modal_phy_certificate').addClass('darken');
            }
            $('#modal_phy_sample_login').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>