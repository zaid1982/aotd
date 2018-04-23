<script src="js/plugin/summernote/summernote.min.js"></script>

<script type="text/javascript">
    
    var mmc_otable;
    var mmc_load_type;
    
    $(document).ready(function () {
                
        $('#form_mmc').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mmc_emailType_title : {
                    validators: {
                        notEmpty: {
                            message: 'Email Title is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Email Title not more than 150 characters'
                        }
                    }
                },
                mmc_snote_emailType_text : {
                    validators: {
                        callback: {
                            message: 'Email Text is required',
                            callback: function(value, validator, $field) {
                                var code = $('[name="mmc_snote_emailType_text"]').summernote('code');
                                return (code !== '' && code.substr(0,11) != '<p><br></p>');
                            }
                        }
                    }
                },
                mmc_emailType_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        $('#mmc_snote_emailType_text').summernote({
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    $('#form_mmc').bootstrapValidator('revalidateField', 'mmc_snote_emailType_text');
                    $('#mmc_emailType_text').val(contents);
                }
            }
        });   
        
        $('#mmc_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mmc").data('bootstrapValidator');
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
                        if (f_submit_forms('form_mmc', 'p_maintenance', 'Email Notification successfully updated.', '', 'modal_email_noti')) {         
                            f_smc_process();
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_mmc_load_email(load_type, emailType_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mmc').trigger('reset');
            $('#form_mmc').bootstrapValidator('resetForm', true);
            mmc_otable = otable;
            mmc_load_type = load_type;
            var email_type = f_get_general_info('email_type', {emailType_id:emailType_id}, 'mmc');  
            $("input[name='mmc_emailType_status'][value=" + email_type.emailType_status + "]").prop('checked', true);
            $('[name="mmc_snote_emailType_text"]').summernote('code', email_type.emailType_text);
            $('#form_mmc').bootstrapValidator('resetField', 'mmc_snote_emailType_text');
            $('#modal_email_noti').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>