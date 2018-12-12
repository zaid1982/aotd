<script type="text/javascript">
        
    var mle_otable;
    var mle_load_type;
    var mle_1st_load = true;    
    
    $(document).ready(function () {
        
        $('#form_mle').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mle_lab_name : {
                    validators: {
                        notEmpty: {
                            message: 'Laboratory Name is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Laboratory Name must not more than 100 characters'
                        }
                    }
                },             
                mle_lab_desc : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Laboratory Description must not more than 255 characters'
                        }
                    }
                }
            }
        });
        
        $('#mle_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mle").data('bootstrapValidator');
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
                        $('#mle_funct').val('save_lab');
                        if (f_submit_forms('form_mle', 'p_aotd', 'Data successfully updated', '', 'modal_lab_edit')) {         
                            if (mle_otable == 'alm') {
                                f_get_general_info('vw_aotd_lab', {lab_id:'ATS'}, 'alm');
                            } else if (mle_otable == 'flm') {
                                f_get_general_info('vw_aotd_lab', {lab_id:'EFF'}, 'flm');
                            } else if (mle_otable == 'plm') {
                                f_get_general_info('vw_aotd_lab', {lab_id:'PHY'}, 'plm');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });            
        });
    });
    
    function f_mle_load_lab(load_type, lab_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){           
            if (mle_1st_load) {      
                get_option('mle_lab_head_unit', '', 'user_name');    
                get_option('mle_lab_quality_manager', '', 'user_name');    
                get_option('mle_lab_technical_manager', '', 'user_name');    
                get_option('mle_lab_technical_manager2', '', 'user_name');    
                get_option('mle_lab_research_officer', '', 'user_name');    
                get_option('mle_lab_supervisor', '', 'user_name');          
                get_option('mle_lab_accountant', '', 'user_name');             
                mle_1st_load = false;
            }
            $('#form_mle').trigger('reset');
            $('#form_mle').bootstrapValidator('resetForm', true);
            $('#form_mle').find('input, textarea, select').prop('disabled',false);
            mle_load_type = load_type;
            mle_otable = otable;
            $('.mle_viewOnly').prop('disabled',true);
            var lab_info = f_get_general_info('aotd_lab', {lab_id:lab_id}, 'mle'); 
            $('#mle_lab_ids').val(lab_info.lab_id);
            $('#mle_lab_head_unit').select2().val(lab_info.lab_head_unit).trigger('change');
            $('#mle_lab_quality_manager').select2().val(lab_info.lab_quality_manager).trigger('change');
            $('#mle_lab_technical_manager').select2().val(lab_info.lab_technical_manager).trigger('change');
            $('#mle_lab_technical_manager2').select2().val(lab_info.lab_technical_manager2).trigger('change');
            $('#mle_lab_research_officer').select2().val(lab_info.lab_research_officer).trigger('change');
            $('#mle_lab_supervisor').select2().val(lab_info.lab_supervisor).trigger('change');
            $('#mle_lab_accountant').select2().val(lab_info.lab_accountant).trigger('change');
            $('#modal_lab_edit').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>