<script type="text/javascript">
    
    var malc_otable;
    var malc_load_type;
    var malc_otable_formula;
    var data_malc_formula;
    
    $(document).ready(function () {
        
        $('#form_malc').bootstrapValidator({
            excluded: ':disabled',
            fields: {  
                malc_atsField_name : {
                    validators: {
                        notEmpty: {
                            message: 'Component Name is required'
                        },
                        stringLength : {
                            max : 150,
                            message : 'Component Name must not more than 150 characters'
                        }
                    }
                }
            }
        });
        
        var datatable_malc_formula = undefined; 
        malc_otable_formula = $('#datatable_malc_formula').DataTable({
            "aaSorting": [1,'asc'],
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_malc_formula) {
                    datatable_malc_formula = new ResponsiveDatatablesHelper($('#datatable_malc_formula'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_malc_formula.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_malc_formula.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    var bootstrapValidator = $("#form_malc").data('bootstrapValidator');
                    bootstrapValidator.addField('malc_atsFormula_id[]', {validators:{choice:{min:1,message:'At least 1 Formula required'}}});
                }
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            var checked = row.atsFf_id == null ? '' : 'checked';
                            $label = '<div class="checkbox"><label><input type="checkbox" class="checkbox style-3" name="malc_atsFormula_id[]" value="'+row.atsFormula_id+'" onchange="f_malc_disable_note(this);" '+checked+'/><span></span></label></div>';
                            return $label;
                        }
                    },
                    {mData: 'atsFormula_name'},
                    {mData: 'atsFormula_img',
                        mRender: function (data, type, row) {
                            $label = '<img src="img/aotd-formula/'+data+'" alt="Formula" style="width:100%">';
                            return $label;
                        }
                    },
                    {mData: null, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            var disabled = row.atsFf_id == null ? 'disabled' : '';
                            $label = '<textarea class="form-control" name="malc_atsFf_notes_'+row.atsFormula_id+'" id="malc_atsFf_notes_'+row.atsFormula_id+'" rows="2" style="width:100%" maxlength="225" '+disabled+'>'+(row.atsFf_notes==null?'':row.atsFf_notes)+'</textarea>';
                            return $label;
                        }
                    }
                ]
        });
                
        $('#modal_ats_lab_component').on('hide.bs.modal', function() {
            if (data_malc_formula.length > 0) {
                var bootstrapValidator = $("#form_malc").data('bootstrapValidator');
                bootstrapValidator.removeField('malc_atsFormula_id[]');
            }
        });
        
        $('#malc_btn_save').on('click', function () {    
            var bootstrapValidator = $("#form_malc").data('bootstrapValidator');
            bootstrapValidator.validate();
            if (!bootstrapValidator.isValid()) {         
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }
            $('#modal_waiting').on('shown.bs.modal', function(e){
                $('#malc_funct').val(malc_load_type==1?'add_ats_field':'save_ats_field');
                if (f_submit_forms('form_malc', 'p_aotd', 'Data successfully saved', '', 'modal_ats_lab_component')) {         
                    if (malc_otable == 'malt') {
                        f_malt_table_field();
                        f_alm_table_test();
                    }
                }
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_malc_disable_note(ex) {
        $('#malc_atsFf_notes_'+ex.value).prop('disabled', !ex.checked).val('');
    }
    
    function f_malc_delete_component(atsField_id, otable) {
        if (otable == 'malt' && data_malt_component.length == 1) {
            f_notify(2, 'Error', 'Test must have at least 1 Component. Please edit current component to modify.');    
            return false;
        }
        $.SmartMessageBox({
            title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
            content : "Are you sure?",
            buttons : '[No][Yes]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Yes") {
                $('#modal_waiting').on('shown.bs.modal', function(e){
                    if (f_submit_normal('delete_ats_field', {atsField_id: atsField_id}, 'p_aotd', 'Data successfully deleted.')) {
                        if (otable == 'malt') {
                            f_malt_table_field();
                            f_alm_table_test();
                        }
                    }
                    $('#modal_waiting').modal('hide');
                    $(this).unbind(e);
                }).modal('show'); 
            }
        });  
    }

    function f_malc_load_component(load_type, atsField_id, atsTest_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){           
            $('#form_malc').trigger('reset'); 
            $('#form_malc').bootstrapValidator('resetForm', true);
            $('#form_malc').find('input, textarea, select').prop('disabled',false);
            malc_otable = otable;
            malc_load_type = load_type;    
            $('.malc_viewOnly').prop('disabled',true);
            if ((load_type == 1 && atsTest_id == '') || (load_type == 2 && (atsField_id == '' && atsTest_id == ''))) {
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
                return false;
            }
            f_get_general_info('ats_test', {atsTest_id:atsTest_id}, 'malc');
            if (load_type == 1) {
                data_malc_formula = f_get_general_info_multiple('dt_ats_formula', {}, {atsField_id:'0'}, '', 'atsFormula_id');
                f_dataTable_draw(malc_otable_formula, data_malc_formula, 'datatable_malc_formula', 4);
            } else if (load_type == 2) {
                f_get_general_info('ats_field', {atsField_id:atsField_id}, 'malc');
                data_malc_formula = f_get_general_info_multiple('dt_ats_formula', {}, {atsField_id:atsField_id}, '', 'atsFormula_id');
                f_dataTable_draw(malc_otable_formula, data_malc_formula, 'datatable_malc_formula', 4);
            } else {
                f_notify(2, 'Error', errMsg_default);    
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
                return false;
            }
            $('#modal_ats_lab_component').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>