<script type="text/javascript">

    var mplf_otable;
    var mplf_load_type;
    
    $(document).ready(function () {

        $('#form_mplf').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mplf_phyField_name : {
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
                mplf_phyTest_status : {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                }
            }
        });
        
        $('#modal_phy_field').on('hide.bs.modal', function() {
            if (mplf_otable == 'mplt') 
                $('#modal_phy_test').removeClass('darken');
        });
        
        $('#mplf_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mplf").data('bootstrapValidator');
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
                        var msg_success = mplf_load_type == 1 ? 'Field Name successfully added.' : 'Field Name successfully updated.';
                        if (f_submit_forms('form_mplf', 'p_aotd', msg_success, '', 'modal_phy_field')) {         
                            if (mplf_otable == 'mplt') {
                                f_mplt_table_field();
                                f_plm_table_test();
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
    
    function f_mplf_delete_field(phyField_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){   
            if (f_submit_normal('delete_phy_field', {phyField_id:phyField_id}, 'p_aotd', 'Field Name successfully deleted.')) {         
                if (otable == 'mplt') {
                    f_mplt_table_field();
                    f_plm_table_test();
                }
            }
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show'); 
    }
     
    function f_mplf_load_field(load_type, phyField_id, phyTest_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mplf').trigger('reset');
            $('#form_mplf').bootstrapValidator('resetForm', true);
            mplf_load_type = load_type;
            mplf_otable = otable;
            var lab_info = f_get_general_info('aotd_lab', {lab_id:'PHY'});
            $('#mplf_lab_name').val(lab_info.lab_name);
            var test_info = f_get_general_info('phy_test', {phyTest_id:phyTest_id});
            $('#mplf_phyTest_name').val(test_info.phyTest_name);
            if (mplf_load_type == 1) {            
                $('#mplf_funct').val('add_phy_field');
                $("input[name=mplf_phyTest_status][value=1]").prop('checked', true);
            } else if (mplf_load_type == 2) {
                $('#mplf_funct').val('save_phy_field');
                var field_info = f_get_general_info('phy_field', {phyField_id:phyField_id}, 'mplf'); 
                $("input[name=mplf_phyTest_status][value=" + field_info.phyField_status + "]").prop('checked', true);
            }
            if (mplf_otable == 'mplt') 
                $('#modal_phy_test').addClass('darken');
            $('#mplf_phyField_id').val(phyField_id); 
            $('#mplf_phyTest_id').val(phyTest_id); 
            $('#modal_phy_field').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>