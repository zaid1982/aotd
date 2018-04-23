<script type="text/javascript">
    
    var mvt_otable;
    var mvt_load_type;
    var mvt_1st_load = true;
    
    $(document).ready(function () {
        
        $('#form_mvt').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mvt_inventory_id : {
                    validators: {
                        notEmpty: {
                            message: 'Inventory Category is required'
                        }
                    }
                },
                mvt_transaction_type : {
                    validators: {
                        notEmpty: {
                            message: 'Transaction Type is required'
                        }
                    }
                },
                mvt_stock_purchased : {
                    validators: {
                        notEmpty: {
                            message: 'Stock Purchased is required'
                        },
                        integer: {
                            message: 'Stock Purchased is not a valid number'
                        },
                        greaterThan: {
                            value: 0
                        }
                    }
                },
                mvt_quantity_taken : {
                    validators: {
                        notEmpty: {
                            message: 'Quantity Taken is required'
                        },
                        integer: {
                            message: 'Quantity Taken is not a valid number'
                        },
                        greaterThan: {
                            value: 0
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                return {
                                    valid: value <= parseInt($('#mvt_total_stock').val()),    
                                    message: 'Please enter a value less than or equal to Total Stock, which is '+$('#mvt_total_stock').val()
                                }
                            }
                        }
                    }
                }
            }
        });
        
        $('#mvt_transaction_type').on('change', function () {
            $('#mvt_div_stock_purchased, #mvt_div_quantity_taken').hide();
            $('#mvt_stock_purchased, #mvt_quantity_taken').val('');
            $('#form_mvt').data('bootstrapValidator').resetField('mvt_stock_purchased');
            $('#form_mvt').data('bootstrapValidator').resetField('mvt_quantity_taken');
            $('#form_mvt').bootstrapValidator('enableFieldValidators', 'mvt_stock_purchased', false);
            $('#form_mvt').bootstrapValidator('enableFieldValidators', 'mvt_quantity_taken', false);
            if ($(this).val() == '1') {
                $('#mvt_div_stock_purchased').show();
                $('#form_mvt').bootstrapValidator('enableFieldValidators', 'mvt_stock_purchased', true);
            } else if ($(this).val() == '2') {
                $('#mvt_div_quantity_taken').show();
                $('#form_mvt').bootstrapValidator('enableFieldValidators', 'mvt_quantity_taken', true);
            }
        });
        
        $('#mvt_inventory_id').on('change', function () {            
            if (mvt_load_type == 1) {
                $('#mvt_div_stock_purchased, #mvt_div_quantity_taken').hide();
                $('#mvt_stock_purchased, #mvt_quantity_taken, #mvt_transaction_type').val('');
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_stock_purchased');
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_quantity_taken');
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_transaction_type');
            }
            $('#mvt_transaction_type').prop('disabled', true);
            if ($(this).val() != '') {
                var inventory = f_get_general_info('aotd_inventory', {inventory_id:$(this).val()});
                $('#mvt_total_stock').val(formattedNumber(inventory.balance));
                $('#mvt_balance').val(formattedNumber(inventory.balance));
                $('#form_mvt').bootstrapValidator('revalidateField', 'mvt_quantity_taken'); 
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_quantity_taken');
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_inventory_id');     
                if (mvt_load_type == 1) {
                    $('#mvt_transaction_type').prop('disabled', false);
                }
            } 
            $('#form_mvt').data('bootstrapValidator').resetField('mvt_transaction_type');
        });
        
        $('#mvt_stock_purchased').on('keyup', function () {
            var bootstrapValidator = $('#form_mvt').data('bootstrapValidator');
            if (bootstrapValidator.isValidField('mvt_stock_purchased')) { 
                var new_value = parseInt($('#mvt_balance').val()) + parseInt($(this).val());
                $('#mvt_balance').val(new_value);
            } else {
                $('#mvt_balance').val($('#mvt_total_stock').val());
            }
        });
        
        $('#mvt_quantity_taken').on('keyup', function () {
            var bootstrapValidator = $('#form_mvt').data('bootstrapValidator');
            if (bootstrapValidator.isValidField('mvt_quantity_taken')) { 
                var new_value = parseInt($('#mvt_balance').val()) - parseInt($(this).val());
                $('#mvt_balance').val(new_value);
            } else {
                $('#mvt_balance').val($('#mvt_total_stock').val());
            }
        });
        
        $('#mvt_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mvt").data('bootstrapValidator');
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
                        $('#mvt_inventory_ids').val($('#mvt_inventory_id').val());
                        if (f_submit_forms('form_mvt', 'p_inventory', 'Inventory Transaction successfully added.', '', 'modal_inv_transaction')) {         
                            if (mvt_otable == 'vmg') {
                                f_vmg_summary();
                                f_vmg_process (vmg_summary_id, 'All Category');
                            } else if (mvt_otable == 'vtr') {
                                f_vtr_summary();
                                f_vtr_process (vtr_summary_id, 'All Items');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });   
        
    function f_mvt_load_inventory_trans(load_type, transaction_id, inventory_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            if (mvt_1st_load) {
                get_option('mvt_inventory_id', '1', 'aotd_inventory', 'inventory_id', 'item_name', 'inventory_status', 'Please select..');
                mvt_1st_load = false;
            }
            $('#form_mvt').trigger('reset');
            $('#form_mvt').bootstrapValidator('resetForm', true);
            mvt_load_type = load_type;
            mvt_otable = otable;
            $('#mvt_div_transaction_no, #mvt_div_stock_purchased, #mvt_div_quantity_taken, #mvt_div_date_trans').hide();
            if (mvt_load_type == 1) {       
                $('#form_mvt').find('input, textarea, select').prop('disabled',false);     
                $('#mvt_funct').val('add_inventory_transaction');
                $('#mvt_inventory_id').select2().val(inventory_id).trigger('change');
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_inventory_id');        
                $('#mvt_inventory_id').prop('disabled', (inventory_id!=''));
                var profile = f_get_general_info('profile', {user_id:$('#user_id').val(), profile_status:'1'});
                $('#mvt_profile_name').val(profile.profile_name);
                $('#mvt_profile_name, #mvt_total_stock, #mvt_balance').prop('disabled',true);        
                $('#form_mvt').bootstrapValidator('enableFieldValidators', 'mvt_stock_purchased', false);
                $('#form_mvt').bootstrapValidator('enableFieldValidators', 'mvt_quantity_taken', false);
            } else {
                $('#form_mvt').find('input, textarea, select').prop('disabled',true);
                var field_info = f_get_general_info('aotd_inventory_transaction', {transaction_id:transaction_id}, 'mvt');
                $('#mvt_inventory_id').select2().val(field_info.inventory_id).trigger('change');
                $('#form_mvt').data('bootstrapValidator').resetField('mvt_inventory_id');
                var profile = f_get_general_info('profile', {user_id:field_info.user_id, profile_status:'1'});
                $('#mvt_profile_name').val(profile.profile_name);
                $('#mvt_div_transaction_no, #mvt_div_date_trans').show();
                if (field_info.transaction_type == '1')
                    $('#mvt_div_stock_purchased').show();
                else if (field_info.transaction_type == '2')
                    $('#mvt_div_quantity_taken').show();
            }
            
            $('#mvt_transaction_id').val(transaction_id); 
            $('#modal_inv_transaction').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }    
    
</script>