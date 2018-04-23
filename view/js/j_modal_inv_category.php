<script type="text/javascript">

    var mvc_otable;
    var mvc_load_type;
    
    $(document).ready(function () {

        $('#form_mvc').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mvc_inventory_type : {
                    validators: {
                        notEmpty: {
                            message: 'Category Name is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Category Name not more than 100 characters'
                        }
                    }
                },
                mvc_inventory_type_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        $('#mvc_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mvc").data('bootstrapValidator');
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
                        var msg_success = mvc_load_type == 1 ? 'Inventory Category successfully added.' : 'Inventory Category successfully updated.';
                        if (f_submit_forms('form_mvc', 'p_inventory', msg_success, '', 'modal_inv_category')) {         
                            if (mvc_otable == 'vct') {
                                f_vct_summary();
                                f_vct_process (vct_summary_id, 'All Category');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_mvc_load_inventory_category(load_type, inventory_type_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mvc').trigger('reset');
            $('#form_mvc').bootstrapValidator('resetForm', true);
            mvc_load_type = load_type;
            mvc_otable = otable;
            if (mvc_load_type == 1) {            
                $('#mvc_funct').val('add_inventory_category');
            } else if (mvc_load_type == 2) {
                $('#mvc_funct').val('save_inventory_category');
                var field_info = f_get_general_info('aotd_inventory_type', {inventory_type_id:inventory_type_id}, 'mvc');
                $("input[name=mvc_inventory_type_status][value=" + field_info.inventory_type_status + "]").prop('checked', true);
            }
            $('#mvc_inventory_type_id').val(inventory_type_id); 
            $('#modal_inv_category').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>