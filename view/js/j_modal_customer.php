<script type="text/javascript">

    var mcu_otable;
    var mcu_load_type;
    var mcu_1st_load = true; 
    
    $(document).ready(function () {

        $('#form_mcu').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mcu_client_organisation : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Name is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Customer Name not more than 100 characters'
                        }
                    }
                },
                mcu_clientGrp_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Type is required'
                        }
                    }
                },
                mcu_client_pic : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Person In Charge not more than 100 characters'
                        }
                    }
                },
                mcu_client_designation : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Designation not more than 100 characters'
                        }
                    }
                },
                mcu_client_address : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Address not more than 255 characters'
                        }
                    }
                },
                mcu_client_city : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'City not more than 100 characters'
                        }
                    }
                },
                mcu_client_state : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'State not more than 100 characters'
                        }
                    }
                },
                mcu_client_postcode : {
                    validators: {
                        regexp: {
                            regexp: /^\d{5}$/,
                            message: 'Postcode must contain 5 digits'
                        }
                    }
                },
                mcu_client_phoneNo : {
                    validators: {
                        stringLength : {
                            max : 20,
                            message : 'Phone No. not more than 20 characters'
                        }
                    }
                },
                mcu_client_faxNo : {
                    validators: {
                        stringLength : {
                            max : 20,
                            message : 'Fax No. not more than 20 characters'
                        }
                    }
                },
                mcu_client_email : {
                    validators: {
                        stringLength : {
                            max : 50,
                            message : 'Email must be not more than 50 characters'
                        },
                        emailAddress : {
                            message : 'Email is not valid'
                        }
                    }
                },
                mcu_client_url : {
                    validators: {
                        stringLength : {
                            max : 50,
                            message : 'URL must be not more than 50 characters'
                        }
                    }
                },
                mcu_client_black : {
                    validators: {
                        notEmpty: {
                            message: 'Blacklisted is required'
                        }
                    }
                }
            }
        });
        
        $('#mcu_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mcu").data('bootstrapValidator');
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
                        var msg_success = mcu_load_type == 1 ? 'Customer Category successfully added.' : 'Customer Category successfully updated.';
                        if (f_submit_forms('form_mcu', 'p_client', msg_success, '', 'modal_customer')) {         
                            if (mcu_otable == 'cmg') {
                                f_cmg_summary();
                                f_cmg_process (cmg_summary_id, 'All Types');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_mcu_load_customer(load_type, client_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            if (mcu_1st_load) {
                get_option('mcu_clientGrp_id', '', 'aotd_client_group', 'clientGrp_id', 'clientGrp_name', 'clientGrp_id', ' ');
                get_option('mcu_country_id', '1', 'ref_country', 'country_id', 'country_desc', 'country_status', ' ');
                mcu_1st_load = false;
            }
            $('#form_mcu').trigger('reset');
            $('#form_mcu').bootstrapValidator('resetForm', true);
            mcu_load_type = load_type;
            mcu_otable = otable;
            if (mcu_load_type == 1) {            
                $('#mcu_funct').val('add_customer');
            } else if (mcu_load_type == 2) {
                $('#mcu_funct').val('update_customer');
                var client_info = f_get_general_info('aotd_client_info', {client_id:client_id}, 'mcu');
                $("input[name=mcu_client_black][value=" + client_info.client_black + "]").prop('checked', true);
            }
            $('#mcu_client_id').val(client_id); 
            $('#modal_customer').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>