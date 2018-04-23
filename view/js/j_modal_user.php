<script type="text/javascript">
        
    var mus_otable;
    var mus_load_type;
    
    $(document).ready(function () {
                
        $('#form_mus').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mus_user_name : {
                    validators: {
                        notEmpty: {
                            message: 'Username is required'
                        },
                        stringLength : {
                            max : 40,
                            message : 'Username must not more than 80 characters'
                        }
                    }
                },
                mus_title_id : {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                mus_profile_name : {
                    validators: {
                        notEmpty: {
                            message: 'First Name is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'First Name must not more than 80 characters'
                        }
                    }
                },
                mus_profile_lastname : {
                    validators: {
                        notEmpty: {
                            message: 'Last Name is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Last Name must not more than 80 characters'
                        }
                    }
                },
                mus_profile_designation : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Designation must not more than 100 characters'
                        }
                    }
                },
                mus_profile_phoneNo : {
                    validators: {
                        stringLength : {
                            max : 11,
                            message : 'Phone No. must be not more than 11 characters'
                        },
                        digits : {
                            message : 'Phone No. must be digits'
                        }
                    }
                },
                mus_profile_faxNo : {
                    validators: {
                        stringLength : {
                            max : 11,
                            message : 'Fax No. must be not more than 11 characters'
                        },
                        digits : {
                            message : 'Fax No. must be digits'
                        }
                    }
                },
                mus_profile_email : {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                        stringLength : {
                            max : 50,
                            message : 'Email must be not more than 50 characters'
                        },
                        emailAddress : {
                            message : 'Email is not valid'
                        }
                    }
                },
                mus_profile_organization : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Organization must not more than 100 characters'
                        }
                    }
                },
                'mus_wfGroup_ids[]' : {
                    validators : {
                        choice : {
                            min : 1,
                            message : 'At least 1 Department required'
                        }                        
                    }
                },
                mus_profile_remark : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Remark must not more than 255 characters'
                        }
                    }
                },
                mus_user_password : {
                    validators: {
                        notEmpty: {
                            message: 'Last Name is required'
                        },
                        stringLength : {
                            min : 6,
                            max : 20,
                            message : 'Password must not less than 6 and not more than 20 characters'
                        }
                    }
                },
                mus_profile_ikimNo : {
                    validators: {
                        stringLength : {
                            max : 30,
                            message : 'IKIM No. must not more than 30 characters'
                        }
                    }
                },
                mus_address_line1 : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Address must not more than 255 characters'
                        }
                    }
                },    
                mus_address_postcode: {
                    validators: {
                        regexp: {
                            regexp: /^\d{5}$/,
                            message: 'Registered Address Postcode must contain 5 digits'
                        }
                    }
                },
                mus_profile_specialization : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Specialization must not more than 100 characters'
                        }
                    }
                },
                'mus_uType_ids[]' : {
                    validators : {
                        choice : {
                            min : 1,
                            message : 'At least 1 Roles required'
                        }                        
                    }
                }
            }
        }); 
        
        $('#form_mus').find('[name="mus_wfGroup_ids[]"]').on('click', function () {
            f_mus_set_roles($(this).val(), $(this).is(':checked'));
        });
        
        $('#mus_country_id').on('change', function () {
            set_option_empty('mus_city_id');            
            set_option_empty('mus_state_id');
            if ($(this).val() != '')
                get_option('mus_state_id', '1', 'ref_state', 'state_id', 'state_desc', 'state_status', ' ', 'ref_desc', 'country_id', $(this).val(), '1'); 
        });
        
        $('#mus_state_id').on('change', function () {
            set_option_empty('mus_city_id');          
            if ($(this).val() != '')
                get_option('mus_city_id', '1', 'ref_city', 'city_id', 'city_desc', 'city_status', ' ', 'ref_desc', 'state_id', $(this).val(), '1'); 
        });
        
        $('#mus_btn_save').on('click', function () {
            if (mus_otable == 'umg') {
                var bootstrapValidator = $("#form_mus").data('bootstrapValidator');
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
                            var msg_success = mus_load_type == 1 ? 'User successfully added.' : 'User profile successfully updated.';
                            if (f_submit_forms('form_mus', 'p_maintenance', msg_success, '', 'modal_user')) {   
                                f_umg_summary();
                                f_umg_process (umg_summary_id, 'All Users');
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else if (mus_otable == 'idx') {
                var bootstrapValidator = $("#form_mus").data('bootstrapValidator');
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
                            if (f_submit_forms('form_mus', 'p_maintenance', 'Profile successfully updated.', '', 'modal_user')) {         
                                if (mus_load_type == 1)
                                    f_send_email('email_user_creation', {user_id:result_submit_forms});
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else {  
                f_notify(2, 'Error', errMsg_default);    
                return false;
            }
        });
        
    });
    
    function f_mus_set_roles(wfGroup_id, is_checked) {
        if (wfGroup_id == '2') {
            is_checked == true ? $('#mus_span_ats').show() : $('#mus_span_ats').hide();
        } else if (wfGroup_id == '3') {
            is_checked == true ? $('#mus_span_bio').show() : $('#mus_span_bio').hide();
        } else if (wfGroup_id == '4') {
            is_checked == true ? $('#mus_span_eco').show() : $('#mus_span_eco').hide();
        } else if (wfGroup_id == '5') {
            is_checked == true ? $('#mus_span_phy').show() : $('#mus_span_phy').hide();
        } else if (wfGroup_id == '6') {
            is_checked == true ? $('#mus_span_eff').show() : $('#mus_span_eff').hide();
        }
        if (!is_checked)
            f_mus_reset_roles(wfGroup_id);
    }
    
    function f_mus_reset_roles(wfGroup_id) {
        if (wfGroup_id == '2') {
            $("input[name='mus_uType_ids[]'][value=19]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=13]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=27]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=36]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=37]").prop('checked', false);
        } else if (wfGroup_id == '3') {
            $("input[name='mus_uType_ids[]'][value=15]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=21]").prop('checked', false);
        } else if (wfGroup_id == '4') {
            $("input[name='mus_uType_ids[]'][value=17]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=18]").prop('checked', false);
        } else if (wfGroup_id == '5') {
            $("input[name='mus_uType_ids[]'][value=9]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=11]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=10]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=28]").prop('checked', false);
        } else if (wfGroup_id == '6') {
            $("input[name='mus_uType_ids[]'][value=14]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=23]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=42]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=34]").prop('checked', false);
            $("input[name='mus_uType_ids[]'][value=35]").prop('checked', false);
        }
    }
    
    function f_mus_load_user(load_type, user_id, otable) { 
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mus').trigger('reset');
            $('#form_mus').bootstrapValidator('resetForm', true);
            mus_load_type = load_type;
            mus_otable = otable;
            $('#form_mus').find('input, textarea, select').prop('disabled',false);
            $('#mus_span_ats, #mus_span_bio, #mus_span_eco, #mus_span_phy, #mus_span_eff').hide();
            var status = load_type <= 2 ? '1' : '';
            get_option('mus_title_id', status, 'ref_title', 'title_id', 'title_desc', 'title_status', ' ', 'ref_id');
            get_option('mus_country_id', status, 'ref_country', 'country_id', 'country_desc', 'country_status', ' ');  
            set_option_empty('mus_city_id');          
            if (mus_load_type == 1) {            
                $("#form_mus").find("#funct").val('add_user');
                $('#mus_country_id').val(1);
                get_option('mus_state_id', status, 'ref_state', 'state_id', 'state_desc', 'state_status', ' ', 'ref_desc', 'country_id', '1');  
            } else if (mus_load_type >= 2) {
                $('.mus_viewOnly').prop('disabled',true);
                var profile = f_get_general_info('vw_profile', {user_id:user_id}, 'mus'); 
                $('#mus_user_password').val('1029384756');
                $("input[name=mus_user_status][value=" + profile.user_status + "]").prop('checked', true);                   
                get_option('mus_state_id', status, 'ref_state', 'state_id', 'state_desc', 'state_status', ' ', 'ref_desc', 'country_id', (profile.country_id!=null?profile.country_id:'1'));  
                $('#mus_state_id').val((profile.state_id!=''?profile.state_id:''));
                if (profile.state_id != null)
                    get_option('mus_city_id', status, 'ref_city', 'city_id', 'city_desc', 'city_status', ' ', 'ref_desc', 'state_id', (profile.state_id!=null?profile.state_id:''), '1');            
                $('#mus_city_id').val((profile.city_id!=''?profile.city_id:''));
                if (profile.country_id == null) 
                    $('#mus_country_id').val(1);
                var arr_group_user = f_get_general_info_multiple('wf_group_user', {user_id:user_id}); 
                $.each(arr_group_user, function(u){
                    $("input[name='mus_wfGroup_ids[]'][value=" + arr_group_user[u].wfGroup_id + "]").prop('checked', true);
                    f_mus_set_roles(arr_group_user[u].wfGroup_id, true);
                });
                var arr_role = f_get_general_info_multiple('user_type', {user_id:user_id}); 
                $.each(arr_role, function(u){
                    $("input[name='mus_uType_ids[]'][value=" + arr_role[u].uType_id + "]").prop('checked', true);
                });                
                if (mus_load_type == 2) {
                    if (mus_otable == 'idx') {
                        $("#form_mus").find("#funct").val('update_profile');  
                        $("input[name='mus_wfGroup_ids[]']").prop('disabled', true);
                        $("input[name='mus_uType_ids[]']").prop('disabled', true);
                        $("input[name='mus_user_status']").prop('disabled', true);
                    } else {
                        $("#form_mus").find("#funct").val('update_user');  
                    }
                } else {
                    $('#form_mus').find('input, textarea, button, select').prop('disabled',true);
                    $('#mus_btn_save').hide();
                }         
            } else {
                f_notify(2, 'Ralat', errMsg_default);
                return false;
            }        
            $('#mus_user_id').val(user_id); 
            $('#modal_user').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>