<script type="text/javascript">
    
    var mup_otable;
    var mup_load_type;
    
    $(document).ready(function () {
        
        $('#form_upload').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mup_document_sampleCode : {
                    validators : {
                        notEmpty: {
                            message: 'Sample Code is required'
                        }                     
                    }
                }, 
                mup_document_name : {
                    validators : {
                        notEmpty: {
                            message: 'Document Name is required'
                        },
                        stringLength : {
                            max : 100,
                            message : 'Document Name must be not more than 100 characters long'
                        }                  
                    }
                },
                mup_documentName_id : {
                    validators : {
                        notEmpty: {
                            message: 'Document Type is required'
                        }                     
                    }
                },
                mup_file : {
                    validators : {
                        notEmpty: {
                            message: 'File is required'
                        },
                        file: {
                            extension: 'pdf,jpeg,jpg,png',
                            type: 'application/pdf,image/jpeg,image/jpg,image/png',
                            maxSize: '10000000',
                            message: 'Only maximum 10MB of PDF, jpeg, jpg and png format allowed.'
                        }          
                    }
                }
            }
        });
        
        $('#modal_upload').on('hide.bs.modal', function() {
            if (mup_otable == 'mpcr')
                $('#modal_phy_certificate').removeClass('darken');
            else if (mup_otable == 'mfcr')
                $('#modal_eff_certificate').removeClass('darken');
            else if (mup_otable == 'macr')
                $('#modal_ats_certificate').removeClass('darken');
            else if (mup_otable == 'mbcr')
                $('#modal_bdt_certificate').removeClass('darken');
            else if (mup_otable == 'mccr')
                $('#modal_eco_certificate').removeClass('darken');
        });
        
        $('#mup_btn_submit').on('click', function () {
            var bootstrapValidator = $("#form_upload").data('bootstrapValidator');
            bootstrapValidator.validate();
            if (bootstrapValidator.isValid()) {       
                $('#modal_waiting').on('shown.bs.modal', function(e){      
                    var formData = new FormData($('#form_upload')[0]);
                    $.ajax({
                        url: "process/p_upload.php",
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
                                f_notify(1, 'Success', 'Document successfully added.');
                                if (mup_otable == 'mpcr') {
                                    f_save_audit('215', $('#mup_document_sampleCode').val());
                                    data_mpcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:$('#mpcr_wfTrans_id').val(), document_sampleCode:$('#mpcr_phyLab_code').val()}, {}, '', 'document_sampleCode');
                                    f_dataTable_draw(mpcr_otable_upload, data_mpcr_upload, 'datatable_mpcr_upload', 6);
                                } else if (mup_otable == 'mfcr') {
                                    f_save_audit('315', $('#mup_document_sampleCode').val());
                                    data_mfcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:$('#mfcr_wfTrans_id').val(), document_sampleCode:$('#mfcr_effLab_code').val()}, {}, '', 'document_sampleCode');
                                    f_dataTable_draw(mfcr_otable_upload, data_mfcr_upload, 'datatable_mfcr_upload', 6);
                                } else if (mup_otable == 'macr') {
                                    f_save_audit('115', $('#mup_document_sampleCode').val());
                                    data_macr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+$('#macr_atsCert_no').val()+'%'}, {}, '', 'document_sampleCode');
                                    f_dataTable_draw(macr_otable_upload, data_macr_upload, 'datatable_macr_upload', 6);
                                } else if (mup_otable == 'mbcr') {
                                    f_save_audit('415', $('#mup_document_sampleCode').val());
                                    data_mbcr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+$('#mbcr_bdtRep_no').val()+'%'}, {}, '', 'document_sampleCode');
                                    f_dataTable_draw(mbcr_otable_upload, data_mbcr_upload, 'datatable_mbcr_upload', 6);
                                } else if (mup_otable == 'mccr') {
                                    f_save_audit('515', $('#mup_document_sampleCode').val());
                                    data_mccr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+$('#mccr_ectRep_no').val()+'%'}, {}, '', 'document_sampleCode');
                                    f_dataTable_draw(mccr_otable_upload, data_mccr_upload, 'datatable_mccr_upload', 6);
                                }
                                $('#modal_upload').modal('hide');
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
            } else {
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }
        }); 
        
    });
    
    function f_mup_delete_file(document_id, otable) {
        $.SmartMessageBox({
            title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
            content : "Are you sure?",
            buttons : '[No][Yes]'
        }, function(ButtonPressed) {
            if (ButtonPressed === "Yes") {
                $('#modal_waiting').on('shown.bs.modal', function(e){
                    if (f_submit_normal('delete_file', {document_id:document_id}, 'p_upload', 'Document successfully deleted.')) {
                        var document = f_get_general_info('document', {document_id:document_id});
                        if (otable == 'mpcr') {         
                            f_save_audit('216', document.document_sampleCode);
                            data_mpcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:$('#mpcr_wfTrans_id').val(), document_sampleCode:$('#mpcr_phyLab_code').val()}, {}, '', 'document_sampleCode');
                            f_dataTable_draw(mpcr_otable_upload, data_mpcr_upload, 'datatable_mpcr_upload', 6);
                        } else if (otable == 'mfcr') {
                            f_save_audit('316', document.document_sampleCode);
                            data_mfcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:$('#mfcr_wfTrans_id').val(), document_sampleCode:$('#mfcr_effLab_code').val()}, {}, '', 'document_sampleCode');
                            f_dataTable_draw(mfcr_otable_upload, data_mfcr_upload, 'datatable_mfcr_upload', 6);
                        } else if (otable == 'macr') {
                            f_save_audit('116', document.document_sampleCode);
                            data_macr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+$('#macr_atsCert_no').val()+'%'}, {}, '', 'document_sampleCode');
                            f_dataTable_draw(macr_otable_upload, data_macr_upload, 'datatable_macr_upload', 6);
                        } else if (otable == 'mbcr') {
                            f_save_audit('416', document.document_sampleCode);
                            data_mbcr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+$('#mbcr_bdtRep_no').val()+'%'}, {}, '', 'document_sampleCode');
                            f_dataTable_draw(mbcr_otable_upload, data_mbcr_upload, 'datatable_mbcr_upload', 6);
                        } else if (otable == 'mccr') {
                            f_save_audit('516', document.document_sampleCode);
                            data_mccr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+$('#mccr_ectRep_no').val()+'%'}, {}, '', 'document_sampleCode');
                            f_dataTable_draw(mccr_otable_upload, data_mccr_upload, 'datatable_mccr_upload', 6);
                        }
                    }
                    $('#modal_waiting').modal('hide');
                    $(this).unbind(e);
                }).modal('show');
            }
        });
    }
    
    function f_mup_load_upload(load_type, ids, wfTrans_id, otable, sample_code) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_upload').trigger('reset');
            $('#form_upload').bootstrapValidator('resetForm', true);
            mup_otable = otable;
            mup_load_type = load_type;
            $('#mup_ids').val(ids);
            $('#mup_wfTrans_id').val(wfTrans_id);
            sample_code = (typeof sample_code === 'undefined') ? '' : sample_code;
            get_option('mup_documentName_id', '1', 'document_name', 'documentName_id', 'documentName_desc', 'documentName_status', ' ', 'ref_id', 'documentName_type', 'Workbook');
            if (mup_otable == 'mpcr') {
                get_option('mup_document_sampleCode', ids, 'phy_sample_info', 'phyLab_code', 'phyLab_code', 'phyRep_no', ' ');
                $('#modal_phy_certificate').addClass('darken');
            } else if (mup_otable == 'mfcr') {
                get_option('mup_document_sampleCode', ids, 'eff_sample_info', 'effLab_code', 'effLab_code', 'effRep_no', ' ');
                $('#modal_eff_certificate').addClass('darken');
            } else if (mup_otable == 'macr') {
                get_option('mup_document_sampleCode', ids, 'ats_sample_info', 'atsLab_code', 'atsLab_code', 'atsCert_id', ' ');
                $('#modal_ats_certificate').addClass('darken');
            } else if (mup_otable == 'mbcr') {
                get_option('mup_document_sampleCode', ids, 'bdt_sample_info', 'bdtLab_code', 'bdtLab_code', 'bdtRep_no', ' ');
                $('#modal_bdt_certificate').addClass('darken');
            } else if (mup_otable == 'mccr') {
                get_option('mup_document_sampleCode', ids, 'ect_sample_info', 'ectLab_code', 'ectLab_code', 'ectRep_no', ' ');
                $('#modal_eco_certificate').addClass('darken');
            } else {
                f_notify(2, 'Error', errMsg_default);   
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
                return false;
            }
            $('#mup_document_sampleCode').val(sample_code);
            $('#modal_upload').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
        
        
</script>