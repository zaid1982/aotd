<script type="text/javascript">

    var mvi_otable;
    var mvi_load_type;
    var mvi_1st_load = true;
    
    $(document).ready(function () {

        $('#form_mvi').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mvi_item_name : {
                    validators: {
                        notEmpty: {
                            message : 'Item Name is required'
                        },
                        stringLength : {
                            max : 150,
                            message : 'Item Name not more than 150 characters'
                        }
                    }
                },
                mvi_inventory_type_id : {
                    validators: {
                        notEmpty: {
                            message : 'Inventory Category is required'
                        }
                    }
                },
                mvi_location : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Location not more than 100 characters'
                        }
                    }
                },
                mvi_classification : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Classification not more than 150 characters'
                        }
                    }
                },
                mvi_form : {
                    validators: {
                        stringLength : {
                            max : 100,
                            message : 'Form not more than 100 characters'
                        }
                    }
                },
                mvi_packing_size : {
                    validators: {
                        stringLength : {
                            max : 50,
                            message : 'Packing Size not more than 50 characters'
                        }
                    }
                },
                mvi_formulation : {
                    validators: {
                        stringLength : {
                            max : 150,
                            message : 'Formula not more than 150 characters'
                        }
                    }
                },
                mvi_msds : {
                    validators: {
                        stringLength : {
                            max : 50,
                            message : 'MSDS not more than 50 characters'
                        }
                    }
                },
                mvi_balance : {
                    validators: {
                        notEmpty: {
                            message : 'Balance is required'
                        },
                        stringLength : {
                            max : 15,
                            message : 'Balance not more than 15 characters'
                        },
                        integer: {
                            message: 'Balance is not a valid number'
                        },
                        greaterThan: {
                            value: 0
                        }
                    }
                },
                mvi_min_level : {
                    validators: {
                        notEmpty: {
                            message : 'Minimum Level is required'
                        },
                        stringLength : {
                            max : 2,
                            message : 'Minimum Level not more than 2 characters'
                        },
                        integer: {
                            message : 'Minimum Level is not a valid number'
                        },
                        greaterThan: {
                            value: 0
                        }
                    }
                },
                mvi_price : {
                    validators: {
                        stringLength : {
                            max : 15,
                            message : 'Cost not more than 15 characters'
                        },
                        numeric: {
                            message : 'Cost is not a valid number',
                            thousandsSeparator : '',
                            decimalSeparator : '.'
                        },
                        greaterThan: {
                            value: 0
                        }
                    }
                },
                mvi_inventory_status : {
                    validators: {
                        notEmpty: {
                            message : 'Status is required'
                        }
                    }
                }
            }
        });
        
        $('#mvi_btn_save').on('click', function () {
            var bootstrapValidator = $('#form_mvi').data('bootstrapValidator');
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
                        var formData = new FormData($('#form_mvi')[0]);
                        $.ajax({
                            url: "process/p_inventory.php",
                            type: "POST",
                            dataType: "json",
                            async: false,
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            xhr: function() {
                                myXhr = $.ajaxSettings.xhr();
                                return myXhr;
                            },
                            success: function(resp) {
                                if (resp.success == true){ 
                                    var msg_success = mvi_load_type == 1 ? 'Inventory Item successfully added.' : 'Inventory Item successfully updated.';
                                    f_notify(1, 'Success', msg_success);
                                    if (mvi_otable == 'vct') {
                                        f_vct_summary();
                                        f_vct_process (vct_summary_id, 'All Category');
                                    }
                                    $('#modal_inv').modal('hide');
                                } else {
                                    f_notify(2, 'Error', resp.errors);
                                }
                            },
                            error: function() {
                                f_notify(2, 'Error', errMsg_default);
                            }
                        });
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_mvi_load_inventory(load_type, inventory_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            if (mvi_1st_load) {
                get_option('mvi_inventory_type_id', '1', 'aotd_inventory_type', 'inventory_type_id', 'inventory_type', 'inventory_type_status', 'Please select..');
                mvi_1st_load = false;
            }
            $('#form_mvi').trigger('reset');
            $('#form_mvi').bootstrapValidator('resetForm', true);
            mvi_load_type = load_type;
            mvi_otable = otable;
            $('.mvi_div_picture').hide();
            if (mvi_load_type == 1) {            
                $('#mvi_funct').val('add_inventory_item');
                $('#mvi_inventory_type_id').select2().val('').trigger('change');
            } else if (mvi_load_type == 2) {
                $('#mvi_funct').val('save_inventory_item');
                var field_info = f_get_general_info('aotd_inventory', {inventory_id:inventory_id}, 'mvi');
                $('#mvi_inventory_type_id').select2().val(field_info.inventory_type_id).trigger('change');
                $("input[name=mvi_inventory_status][value=" + field_info.inventory_status + "]").prop('checked', true);
                if (field_info.document_id != null) {
                    $('.mvi_div_picture').show();
                    var document = f_get_general_info('document', {document_id:field_info.document_id});
                    var document_src = document.document_folder + '/' + document.document_filename + '.' + document.document_extension;
                    $('#mvi_picture').attr('src', document_src.replace('../', ''));
                }
            }
            $('#form_mvi').data('bootstrapValidator').resetField('mvi_inventory_type_id');
            $('#mvi_inventory_id').val(inventory_id); 
            $('#modal_inv').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>