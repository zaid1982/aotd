<script type="text/javascript">

    var masf_otable;
    var masf_load_type;
    var masf_ats_field_formula;
    
    $(document).ready(function () {

        $('#form_masf').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
            }
        });
        
        $('#modal_ats_formula_set').on('hide.bs.modal', function() {
            if (masf_otable == 'macr')
                $('#modal_ats_certificate').removeClass('darken');
        });
        
        $('#masf_btn_save').on('click', function () {
            if (typeof $("input[name='masf_atsFormula_id']:checked").val() === 'undefined') {         
                f_notify(2, 'Error', 'Please make sure Component selected');    
                return false;
            }            
            $.SmartMessageBox({
                title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                content : "Are you sure?",
                buttons : '[No][Yes]'
            }, function(ButtonPressed) {
                if (ButtonPressed === "Yes") {
                    $('#modal_waiting').on('shown.bs.modal', function(e){   
                        var msg_success = masf_load_type == 1 ? 'Component successfully set.' : 'Component successfully updated.';
                        if (f_submit_forms('form_masf', 'p_aotd', msg_success, '', 'modal_ats_formula_set')) {         
                            if (masf_otable == 'macr') {
                                macr_load_direct = $('#masf_atsField_id').val();
                                data_macr_workSummary = f_get_general_info_multiple('dt_ats_list_test', {}, {atsCert_id:$('#masf_atsCert_id').val()});
                                f_dataTable_draw(macr_otable_workSummary, data_macr_workSummary, 'datatable_macr_workSummary', 5);
                            }
                        }
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show'); 
                }                            
            });     
        });
        
    });
     
    function f_masf_load_formula(load_type, atsCert_id, atsField_id, atsCertField_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_masf').trigger('reset');
            $('#form_masf').bootstrapValidator('resetForm', true);
            masf_load_type = load_type;
            masf_otable = otable;
            var atsTest_id = f_get_value_from_table('ats_field', 'atsField_id', atsField_id, 'atsTest_id');
            var atsTest_name = f_get_value_from_table('ats_test', 'atsTest_id', atsTest_id, 'atsTest_name');
            $('#masf_atsTest_name').val(atsTest_name);
            $('#masf_div_component').html('');
            masf_ats_field_formula = f_get_general_info_multiple('ats_field_formula', {atsField_id:atsField_id});
            $.each(masf_ats_field_formula,function(u) {
                var ats_formula = f_get_general_info('ats_formula', {atsFormula_id:masf_ats_field_formula[u].atsFormula_id});
                if (ats_formula != '') {
                    var html = '<div class="radio">' 
                        + '<label>'
                        + '<input type="radio" class="radiobox" name="masf_atsFormula_id" value="'+ats_formula.atsFormula_id+'"  />'
                        + '<span><img src="img/aotd-formula/'+ats_formula.atsFormula_img+'" alt="Formula" style="max-width:330px"></span>'
                        + '</label>'
                        + '</div>';
                    $('#masf_div_component').append(html);
                }                
            });
            if (atsCertField_id == null) {            
                $('#masf_title').html('Set Formula');
                $('#masf_funct').val('set_ats_field_formula');
            } else {
                $('#masf_title').html('Change Formula');
                $('#masf_funct').val('change_ats_field_formula');
            }
            if (masf_otable == 'macr') 
                $('#modal_ats_certificate').addClass('darken');
            $('#masf_atsCert_id').val(atsCert_id); 
            $('#masf_atsTest_id').val(atsTest_id); 
            $('#masf_atsField_id').val(atsField_id); 
            $('#masf_atsCertField_id').val(atsCertField_id==null?'':atsCertField_id); 
            $('#modal_ats_formula_set').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }

</script>