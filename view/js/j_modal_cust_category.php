<script type="text/javascript">

    var mcc_otable;
    var mcc_load_type;
    
    $(document).ready(function () {

        $('#form_mcc').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mcc_clientGrp_name : {
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
                mcc_clientType_id : {
                    validators: {
                        notEmpty: {
                            message: 'Customer Type is required'
                        }
                    }
                },
                mcc_clientGrp_desc : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Category Description not more than 255 characters'
                        }
                    }
                }
            }
        });
        
        $('#mcc_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mcc").data('bootstrapValidator');
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
                        var msg_success = mcc_load_type == 1 ? 'Customer Category successfully added.' : 'Customer Category successfully updated.';
                        if (f_submit_forms('form_mcc', 'p_client', msg_success, '', 'modal_cust_category')) {         
                            if (mcc_otable == 'ccm') {
                                f_ccm_summary();
                                f_ccm_process (ccm_summary_id, 'All Types');
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_mcc_load_custCate(load_type, clientGrp_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mcc').trigger('reset');
            $('#form_mcc').bootstrapValidator('resetForm', true);
            mcc_load_type = load_type;
            mcc_otable = otable;
            if (mcc_load_type == 1) {            
                $('#mcc_funct').val('add_customer_category');
            } else if (mcc_load_type == 2) {
                $('#mcc_funct').val('update_customer_category');
                f_get_general_info('aotd_client_group', {clientGrp_id:clientGrp_id}, 'mcc'); 
            }
            $('#mcc_clientGrp_id').val(clientGrp_id); 
            $('#modal_cust_category').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>