<script type="text/javascript">
        
    var mle2_otable;
    var mle2_load_type;
    var mle2_1st_load = true;    
    
    $(document).ready(function () {
        
        $('#form_mle2').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                mle2_lab_name : {
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
                mle2_lab_desc : {
                    validators: {
                        stringLength : {
                            max : 255,
                            message : 'Laboratory Description must not more than 255 characters'
                        }
                    }
                },             
                mle2_lab_cost : {
                    validators: {
                        notEmpty: {
                            message: 'Cost is required'
                        },
                        stringLength : {
                            max : 10,
                            message : 'Cost must not more than 10 characters'
                        },
                        numeric: {
                            message: 'Must valid number',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                }
            }
        });
        
        $('#mle2_btn_save').on('click', function () {
            var bootstrapValidator = $("#form_mle2").data('bootstrapValidator');
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
                        $('#mle2_funct').val('save_lab2');
                        if (f_submit_forms('form_mle2', 'p_aotd', 'Data successfully updated', '', 'modal_lab_edit2')) {         
                            if (mle2_otable == 'blm') {
                                f_get_general_info('vw_aotd_lab', {lab_id:'BDT'}, 'blm');
                                var lab_cost = f_get_value_from_table('bdt_test', 'bdtTest_id', '1', 'bdtTest_price');
                                $('#lblm_lab_cost').html('RM '+lab_cost);
                            } else if (mle2_otable == 'elm') {
                                f_get_general_info('vw_aotd_lab', {lab_id:'ECT'}, 'elm');
                                var lab_cost = f_get_value_from_table('ect_test', 'ectTest_id', '1', 'ectTest_price');
                                $('#lelm_lab_cost').html('RM '+lab_cost);
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });            
        });
    });
    
    function f_mle2_load_lab(load_type, lab_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){           
            if (mle2_1st_load) {      
                get_option('mle2_lab_head_unit', '', 'user_name');    
                get_option('mle2_lab_quality_manager', '', 'user_name');     
                get_option('mle2_lab_research_officer', '', 'user_name');       
                mle2_1st_load = false;
            }
            $('#form_mle2').trigger('reset');
            $('#form_mle2').bootstrapValidator('resetForm', true);
            $('#form_mle2').find('input, textarea, select').prop('disabled',false);
            mle2_load_type = load_type;
            mle2_otable = otable;
            $('.mle2_viewOnly').prop('disabled',true);
            var lab_info = f_get_general_info('aotd_lab', {lab_id:lab_id}, 'mle2'); 
            $('#mle2_lab_ids').val(lab_info.lab_id);
            $('#mle2_lab_head_unit').select2().val(lab_info.lab_head_unit).trigger('change');
            $('#mle2_lab_quality_manager').select2().val(lab_info.lab_quality_manager).trigger('change');
            $('#mle2_lab_research_officer').select2().val(lab_info.lab_research_officer).trigger('change');
            var mle2_lab_cost = '';
            if (mle2_otable == 'blm') {
                mle2_lab_cost = f_get_value_from_table('bdt_test', 'bdtTest_id', '1', 'bdtTest_price');                
            } else if (mle2_otable == 'elm') {
                mle2_lab_cost = f_get_value_from_table('ect_test', 'ectTest_id', '1', 'ectTest_price');
            }
            $('#mle2_lab_cost').val(mle2_lab_cost);
            $('#modal_lab_edit2').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>