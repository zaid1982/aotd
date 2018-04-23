<script type="text/javascript">

    var mflf_otable;
    var mflf_load_type;
    
    $(document).ready(function () {

        $('#form_mflf').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mflf_effField_name : {
                    validators: {
                        notEmpty: {
                            message: 'Field Name is required'
                        },
                        stringLength : {
                            max : 150,
                            message : 'Field Name not more than 150 characters'
                        }
                    }
                },
                mflf_effTest_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        $('#modal_eff_field').on('hide.bs.modal', function() {
            if (mflf_otable == 'mflt') 
                $('#modal_eff_test').removeClass('darken');
        });
        
        $('#mflf_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mflf").data('bootstrapValidator');
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
                        var msg_success = mflf_load_type == 1 ? 'Field Name successfully added.' : 'Field Name successfully updated.';
                        if (f_submit_forms('form_mflf', 'p_aotd', msg_success, '', 'modal_eff_field')) {         
                            if (mflf_otable == 'mflt') {
                                f_mflt_table_field();
                                f_flm_table_test();
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_mflf_delete_field(effField_id, otable) {
        $.SmartMessageBox({
            title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
            content : "Are you sure?",
            buttons : '[No][Yes]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Yes") {
                $('#modal_waiting').on('shown.bs.modal', function(e){   
                    if (f_submit_normal('delete_eff_field', {effField_id:effField_id}, 'p_aotd', 'Field Name successfully deleted.')) {         
                        if (otable == 'mflt') {
                            f_mflt_table_field();
                            f_flm_table_test();
                        }
                    }
                    $('#modal_waiting').modal('hide');
                    $(this).unbind(e);
                }).modal('show'); 
            }                            
        }); 
    }
     
    function f_mflf_load_field(load_type, effField_id, effTest_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mflf').trigger('reset');
            $('#form_mflf').bootstrapValidator('resetForm', true);
            mflf_load_type = load_type;
            mflf_otable = otable;
            var lab_info = f_get_general_info('aotd_lab', {lab_id:'EFF'});
            $('#mflf_lab_name').val(lab_info.lab_name);
            var test_info = f_get_general_info('eff_test', {effTest_id:effTest_id});
            $('#mflf_effTest_name').val(test_info.effTest_name);
            if (mflf_load_type == 1) {            
                $('#mflf_funct').val('add_eff_field');
                $("input[name=mflf_effTest_status][value=1]").prop('checked', true);
            } else if (mflf_load_type == 2) {
                $('#mflf_funct').val('save_eff_field');
                var field_info = f_get_general_info('eff_field', {effField_id:effField_id}, 'mflf'); 
                $("input[name=mflf_effTest_status][value=" + field_info.effField_status + "]").prop('checked', true);
            }
            if (mflf_otable == 'mflt') 
                $('#modal_eff_test').addClass('darken');
            $('#mflf_effField_id').val(effField_id); 
            $('#mflf_effTest_id').val(effTest_id); 
            $('#modal_eff_field').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>