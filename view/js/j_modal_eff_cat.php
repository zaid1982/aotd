<script type="text/javascript">
    
    $(document).ready(function () {

        $('#form_mfc').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mfc_effCat_name : {
                    validators: {
                        notEmpty: {
                            message: 'Category Name is required'
                        },
                        stringLength : {
                            max : 150,
                            message : 'Category Name not more than 150 characters'
                        }
                    }
                },
                mfc_effCat_filter : {
                    validators: {
                        notEmpty: {
                            message: 'Filtered Name is required'
                        },
                        stringLength : {
                            max : 150,
                            message : 'Filtered Name not more than 150 characters'
                        }
                    }
                }
            }
        });
        
        $('#mfc_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mfc").data('bootstrapValidator');
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
                        if (f_submit_forms('form_mfc', 'p_aotd', 'Evaluation Group successfully added.', '', 'modal_eff_cat')) {         
                            f_flm_table_test();
                            get_option('flm_category', '', 'eff_cat', 'effCat_filter', 'effCat_name', 'effCat_status', ' ');        
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_mfc_load_effCat() {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mfc').trigger('reset');
            $('#form_mfc').bootstrapValidator('resetForm', true);
            $('#modal_eff_cat').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>