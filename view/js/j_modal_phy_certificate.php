<script src="js/plugin/summernote/summernote.min.js"></script>

<script type="text/javascript">
    
    var mpcr_otable;
    var mpcr_load_type;
    var mpcr_otable_history;
    var data_mpcr_history;
    var mpcr_otable_sample;
    var data_mpcr_sample;
    var mpcr_otable_sampleView;
    var data_mpcr_sampleView;
    var mpcr_otable_workbook;
    var data_mpcr_workbook = '';
    var mpcr_otable_upload;
    var data_mpcr_upload;
    
    $(document).ready(function () {
        
        $('#mpcr_snote_wfTask_remark').summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']]
            ]
        });   
        
        $('#form_mpcr_form').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#form_mpcr_workbook').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#form_mpcr_action').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mpcr_action : {
                    validators : {
                        notEmpty: {
                            message: 'Action/Result is required'
                        }                     
                    }
                }                
            }
        });
        
        var datatable_mpcr_sample = undefined; 
        mpcr_otable_sample = $('#datatable_mpcr_sample').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mpcr_sample) {
                    datatable_mpcr_sample = new ResponsiveDatatablesHelper($('#datatable_mpcr_sample'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mpcr_sample.createExpandIcon(nRow);
                var info = mpcr_otable_sample.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mpcr_sample.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_mpcr_form").data('bootstrapValidator');
                        bootstrapValidator.addField('mpcr_phyLab_sampleCode_'+visibleRows[j].phyLab_code, {validators:{notEmpty:{message:'Required'},stringLength:{max:100, message:'Max 100 words'}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'phyLab_code'},
                    {mData: 'phyLab_sampleCode', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mpcr_phyLab_sampleCode_'+row.phyLab_code+'" id="mpcr_phyLab_sampleCode_'+row.phyLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: 'phyLab_sampleDesc', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mpcr_phyLab_sampleDesc_'+row.phyLab_code+'" id="mpcr_phyLab_sampleDesc_'+row.phyLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: 'phyLab_testCondition', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mpcr_phyLab_testCondition_'+row.phyLab_code+'" id="mpcr_phyLab_testCondition_'+row.phyLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mpcr_sampleView = undefined; 
        mpcr_otable_sampleView = $('#datatable_mpcr_sampleView').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mpcr_sampleView) {
                    datatable_mpcr_sampleView = new ResponsiveDatatablesHelper($('#datatable_mpcr_sampleView'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mpcr_sampleView.createExpandIcon(nRow);
                var info = mpcr_otable_sampleView.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mpcr_sampleView.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_mpcr_sampleView_paginate')[0].style.display = "block";
                    $('#datatable_mpcr_sampleView_info')[0].style.display = "block";
                } else {
                    $('#datatable_mpcr_sampleView_paginate')[0].style.display = "none";
                    $('#datatable_mpcr_sampleView_info')[0].style.display = "none";
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'phyLab_code'},
                    {mData: 'phyLab_sampleDesc'},
                    {mData: 'phyLab_testCondition'},
                    {mData: "phyRep_no", bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.phyLab_code + '\',\'' + row.phyLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                            return $label;
                        }
                    }
                ]
        });
        $('#datatable_mpcr_sampleView tbody').delegate('tr', 'mouseenter', function (evt) {
            var $cell=$(evt.target).closest('td');
            $cell.css( 'cursor', 'pointer' ); 
        });
        $('#datatable_mpcr_sampleView tbody').delegate('tr', 'click', function (evt) {
            var data = mpcr_otable_sampleView.row( this ).data();
            var $cell=$(evt.target).closest('td');
            if (data_mpcr_sampleView.length > 1) {
                $("#datatable_mpcr_sampleView tbody tr").removeClass('bg-color-yellow txt-color-white');		
                $(this).addClass('bg-color-yellow txt-color-white');
                if (mpcr_load_type == 2 && mpcr_otable == 'pwb')
                    f_mpcr_save_workbook(0);
                $('#mpcr_phyLab_code').val(data['phyLab_code']);
                f_mpcr_workbook();
                data_mpcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:$('#mpcr_wfTrans_id').val(), document_sampleCode:$('#mpcr_phyLab_code').val()}, {}, '', 'document_sampleCode');
                f_dataTable_draw(mpcr_otable_upload, data_mpcr_upload, 'datatable_mpcr_upload', 5);
            }
        }); 
        
        var datatable_mpcr_workbook = undefined; 
        mpcr_otable_workbook = $('#datatable_mpcr_workbook').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mpcr_workbook) {
                    datatable_mpcr_workbook = new ResponsiveDatatablesHelper($('#datatable_mpcr_workbook'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mpcr_workbook.createExpandIcon(nRow);
                var info = mpcr_otable_workbook.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mpcr_workbook.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_mpcr_workbook").data('bootstrapValidator');
                        bootstrapValidator.addField('mpcr_phyRes_res_'+visibleRows[j].phyRes_id, {validators:{notEmpty:{message:'Required'},stringLength:{max:255, message:'Max 255 words'}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'phyField_name'},
                    {mData: 'phyRes_res'},
                    {mData: null, sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mpcr_phyRes_res_'+row.phyRes_id+'" id="mpcr_phyRes_res_'+row.phyRes_id+'" value="'+(row.phyRes_res!=null?row.phyRes_res:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mpcr_upload = undefined; 
        mpcr_otable_upload = $('#datatable_mpcr_upload').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mpcr_upload) {
                    datatable_mpcr_upload = new ResponsiveDatatablesHelper($('#datatable_mpcr_upload'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mpcr_upload.createExpandIcon(nRow);
                var info = mpcr_otable_upload.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mpcr_upload.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_mpcr_upload_paginate')[0].style.display = "block";
                    $('#datatable_mpcr_upload_info')[0].style.display = "block";
                } else {
                    $('#datatable_mpcr_upload_paginate')[0].style.display = "none";
                    $('#datatable_mpcr_upload_info')[0].style.display = "none";
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'document_name'},
                    {mData: 'document_sampleCode'},
                    {mData: 'documentName_desc'},
                    {mData: 'document_remarks'},
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mvd_load_view_document (1, '+row.document_id+',\'mpcr\');" data-toggle="tooltip" data-original-title="View Attachment"><i class="fa fa-file-o"></i></a> ';
                            $label += '<a href="javascript:void(0)" class="btn btn-danger btn-xs mpcr_attachEdit" style="width:24px" onclick="f_mup_delete_file ('+row.document_id+', \'mpcr\');" data-toggle="tooltip" data-original-title="Delete Attachment"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mpcr_history = undefined; 
        mpcr_otable_history = $('#datatable_mpcr_history').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mpcr_history) {
                    datatable_mpcr_history = new ResponsiveDatatablesHelper($('#datatable_mpcr_history'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mpcr_history.createExpandIcon(nRow);
                var info = mpcr_otable_history.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mpcr_history.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_mpcr_history_paginate')[0].style.display = "block";
                    $('#datatable_mpcr_history_info')[0].style.display = "block";
                } else {
                    $('#datatable_mpcr_history_paginate')[0].style.display = "none";
                    $('#datatable_mpcr_history_info')[0].style.display = "none";
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'wfTaskType_name'},
                    {mData: 'status_desc'},
                    {mData: 'claimed_by'},
                    {mData: 'wfTask_timeSubmitted'},
                    {mData: 'wfTask_remark'}
                ]
        });
        
        $('#modal_phy_certificate').on('hide.bs.modal', function() {
            if (mpcr_load_type == 2) {
                if (mpcr_otable == 'plg') {
                    $.each(data_mpcr_sample, function(u){
                        var bootstrapValidator = $("#form_mpcr_form").data('bootstrapValidator');
                        bootstrapValidator.removeField('mpcr_phyLab_sampleCode_'+data_mpcr_sample[u].phyLab_code); 
                    });
                } else if (mpcr_otable == 'pwb') {
                    $.each(data_mpcr_workbook, function(u){
                        var bootstrapValidator = $("#form_mpcr_workbook").data('bootstrapValidator');
                        bootstrapValidator.removeField('mpcr_phyRes_res_'+data_mpcr_workbook[u].phyRes_id); 
                    });
                    data_mpcr_workbook = '';
                }
            }
        }); 
        
        $('#mpcr_btn_save').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){   
                if (mpcr_load_type == 2 && mpcr_otable == 'plg') {
                    $('#mpcr_funct').val('save_phy_sample_info');
                    if (f_submit_forms('form_mpcr,#form_mpcr_form', 'p_aotd', 'Data successfully saved.')) {
                        data_mpcr_sample = f_get_general_info_multiple('phy_sample_info', {phyRep_no:$('#mpcr_phyRep_no').val()}, {}, '', 'phyLab_code');
                        f_dataTable_draw(mpcr_otable_sample, data_mpcr_sample, 'datatable_mpcr_sample', 3);
                    }
                } else if (mpcr_load_type == 2 && mpcr_otable == 'pwb') {
                    f_mpcr_save_workbook(0);
                } else if (mpcr_load_type == 2 && ((mpcr_otable == 'pvf' && $('#mpcr_wfTaskType_id').val() == '33') ||(mpcr_otable == 'pvs' && $('#mpcr_wfTaskType_id').val() == '34'))) {
                    $('#mpcr_funct').val('save_phy_action');
                    $('#mpcr_wfTask_remark').val($('[name="mpcr_snote_wfTask_remark"]').summernote('code'));
                    f_submit_forms('form_mpcr,#form_mpcr_action', 'p_aotd', 'Data successfully saved.');
                }
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');                 
        }); 
        
        $('#mpcr_btn_submit').on('click', function () {
            if (mpcr_load_type == 2 && mpcr_otable == 'plg' && $('#mpcr_wfTaskType_id').val() == '31') {
                var bootstrapValidator = $('#form_mpcr_form').data('bootstrapValidator');
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
                            $('#mpcr_funct').val('save_phy_sample_info');
                            if (f_submit_forms('form_mpcr,#form_mpcr_form', 'p_aotd')) {
                                data_mpcr_sample = f_get_general_info_multiple('phy_sample_info', {phyRep_no:$('#mpcr_phyRep_no').val()}, {}, '', 'phyLab_code');
                                f_dataTable_draw(mpcr_otable_sample, data_mpcr_sample, 'datatable_mpcr_sample', 3);
                                if (f_submit($('#mpcr_wfTask_id').val(), $('#mpcr_wfTaskType_id').val(), '10', 'Sample Registration successfully submitted.', '', '', '', '', 'phyRep_no', $('#mpcr_phyRep_no').val())) {
                                    f_plg_summary();
                                    f_plg_process (plg_summary_id);
                                    $('#modal_phy_certificate').modal('hide');
                                }
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else if (mpcr_load_type == 2 && mpcr_otable == 'pwb' && $('#mpcr_wfTaskType_id').val() == '32') {
                $.SmartMessageBox({
                    title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                    content : "Are you sure?",
                    buttons : '[No][Yes]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "Yes") {
                        $('#modal_waiting').on('shown.bs.modal', function(e){  
                            var check_workbook = '0';  
                            if (f_mpcr_save_workbook(1)) {
                                if (f_submit_normal('validate_phy_workbook', {phyRep_no:$('#mpcr_phyRep_no').val(), phyRes_cycle:$('#mpcr_phyRep_cycle').val()}, 'p_aotd')) {
                                    check_workbook = result_submit; 
                                }
                            }
                            if (check_workbook == '1') {
                                var submit_status = $('#mpcr_wfTask_status').val() == '22' ? '13' : '10'; 
                                if (f_submit($('#mpcr_wfTask_id').val(), $('#mpcr_wfTaskType_id').val(), submit_status, 'Workbook successfully submitted.', '', '', '', '', 'phyRep_no', $('#mpcr_phyRep_no').val())) {
                                    f_pwb_summary();
                                    f_pwb_process (pwb_summary_id);
                                    $('#modal_phy_certificate').modal('hide');
                                }
                            } else {
                                $('#mpcr_phyLab_code').val(check_workbook);
                                f_mpcr_workbook();
                                $("#datatable_mpcr_sampleView tbody tr").removeClass('bg-color-yellow txt-color-white');
                                for (var i=0; i<data_mpcr_sampleView.length; i++) {
                                    if (data_mpcr_sampleView[i].phyLab_code == check_workbook)
                                        $('#datatable_mpcr_sampleView tbody tr').eq(i).addClass('bg-color-yellow txt-color-white');
                                }
                                var bootstrapValidator = $('#form_mpcr_workbook').data('bootstrapValidator');
                                bootstrapValidator.validate();
                                if (!bootstrapValidator.isValid()) {         
                                    f_notify(2, 'Error', errMsg_validation);  
                                } else {
                                    f_notify(2, 'Error', errMsg_default);    
                                }
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);                                
                        }).modal('show');
                    }
                });
            } else if (mpcr_load_type == 2 && ((mpcr_otable == 'pvf' && $('#mpcr_wfTaskType_id').val() == '33') ||(mpcr_otable == 'pvs' && $('#mpcr_wfTaskType_id').val() == '34'))) {
                var bootstrapValidator = $("#form_mpcr_action").data('bootstrapValidator');
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
                            var submit_status = $('input[name="mpcr_action"]:checked').val() == '10' ? ($('#mpcr_wfTask_status').val() == '22' ? '13' : '10') : $('input[name="mpcr_action"]:checked').val(); 
                            $('#mpcr_wfTask_remark').val($('[name="mpcr_snote_wfTask_remark"]').summernote('code'));
                            var submit_remark = $('#mpcr_wfTask_remark').val();
                            var condition_no = submit_status == '12' ? '1' : '';
                            if (f_submit($('#mpcr_wfTask_id').val(), $('#mpcr_wfTaskType_id').val(), submit_status, 'Physical Certificate validation successfully submitted.', submit_remark, condition_no, '', '', 'phyRep_no', $('#mpcr_phyRep_no').val())) {
                                if (mpcr_otable == 'pvf') {
                                    f_pvf_summary();
                                    f_pvf_process(pvf_summary_id);
                                } else if (mpcr_otable == 'pvs') {
                                    f_pvs_summary();
                                    f_pvs_process(pvs_summary_id);
                                }
                                $('#modal_phy_certificate').modal('hide');
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else {
                f_notify(2, 'Error', errMsg_default);    
                return false;
            }
        }); 
        
    });
    
    function f_mpcr_workbook() {
        if ($('#mpcr_phyLab_code').val() == '') {
            f_notify(2, 'Error', errMsg_validation);    
            return false;
        }
        if (data_mpcr_workbook != '') {
            $.each(data_mpcr_workbook, function(u){
                var bootstrapValidator = $("#form_mpcr_workbook").data('bootstrapValidator');
                bootstrapValidator.removeField('mpcr_phyRes_res_'+data_mpcr_workbook[u].phyRes_id); 
            });
        }
        $('#form_mpcr_workbook').trigger('reset'); 
        $('#form_mpcr_workbook').bootstrapValidator('resetForm', true); 
        f_get_general_info('phy_sample_info', {phyLab_code:$('#mpcr_phyLab_code').val()}, 'mpcr');
        var phyField_status = (mpcr_load_type == 2 && mpcr_otable == 'pwb') ? '1' : '';
        data_mpcr_workbook = f_get_general_info_multiple('dt_phy_test_res', {phyLab_code:$('#mpcr_phyLab_code').val(), phyField_status:phyField_status, phyRes_cycle:$('#mpcr_phyRep_cycle').val()}, {}, '', 'phyRes_id');
        f_dataTable_draw(mpcr_otable_workbook, data_mpcr_workbook, 'datatable_mpcr_workbook', 4);
    }
    
    function f_mpcr_save_workbook(is_submit) {
        var is_workbook_saved = false;
        $('#mpcr_funct').val('save_phy_workbook');
        var msg_success = is_submit == 0 ? 'Wookbook successfully saved.' : '';
        if (f_submit_forms('form_mpcr,#form_mpcr_workbook', 'p_aotd', msg_success)) {
            f_mpcr_workbook();
            is_workbook_saved = true;
        }
        return is_workbook_saved;
    }
        
    function f_mpcr_load_certificate(load_type, phyRep_no, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mpcr, #form_mpcr_form, #form_mpcr_workbook').trigger('reset'); 
            $('#form_mpcr_form').bootstrapValidator('resetForm', true); 
            $('#form_mpcr_workbook').bootstrapValidator('resetForm', true); 
            mpcr_otable = otable;
            mpcr_load_type = load_type;
            $('.mpcr_viewOnly').prop('disabled',true);
            $('.mpcr_editView, .mpcr_div_sample, .mpcr_div_sampleView, .mpcr_div_workbook, .mpcr_attachEdit, .mpcr_div_action').hide();
            f_get_general_info('aotd_lab', {lab_id:'PHY'}, 'mpcr');
            var cert_info = f_get_general_info('vw_phy_cert', {phyRep_no:phyRep_no}, 'mpcr');
            $('#mpcr_phyRep_cycle').val(cert_info.phyRep_cycle);
            if (cert_info.phyRep_status != '2') {
                $('.mpcr_div_sampleView, .mpcr_div_workbook').show();
                data_mpcr_sampleView = f_get_general_info_multiple('phy_sample_info', {phyRep_no:phyRep_no}, {}, '', 'phyLab_code');
                f_dataTable_draw(mpcr_otable_sampleView, data_mpcr_sampleView, 'datatable_mpcr_sampleView', 5);
                if (data_mpcr_sampleView.length > 1) 
                    $('#datatable_mpcr_sampleView tbody tr').eq(0).addClass('bg-color-yellow txt-color-white');
                $('#mpcr_phyLab_code').val(data_mpcr_sampleView[0].phyLab_code);
                f_mpcr_workbook();
                mpcr_otable_workbook.columns(2).visible(true);
                mpcr_otable_workbook.columns(3).visible(false);
                data_mpcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:cert_info.wfTrans_id != null ? cert_info.wfTrans_id : '', document_sampleCode:$('#mpcr_phyLab_code').val()}, {}, '', 'document_sampleCode');
                f_dataTable_draw(mpcr_otable_upload, data_mpcr_upload, 'datatable_mpcr_upload', 5);
            }
            var task_turn = 1;
            var wf_task;
            if (cert_info.wfTrans_id != null) {
                wf_task = f_get_general_info('wf_task', {wfTrans_id:cert_info.wfTrans_id, wfTask_partition:'1'}, 'mpcr');
                var wf_task_type = f_get_general_info('wf_task_type', {wfTaskType_id:wf_task.wfTaskType_id});
                task_turn = wf_task_type.wfTaskType_turn;
            } else {
                if (cert_info.phyRep_status == '4')
                    task_turn = '2';
                else if (cert_info.phyRep_status == '48')
                    task_turn = '3';
                else if (cert_info.phyRep_status == '49')
                    task_turn = '4';
                else if (cert_info.phyRep_status == '42')
                    task_turn = '5';
            }
            var arr_steps = f_get_general_info_multiple('wf_task_type', {wfFlow_id:'4'});
            f_steps (arr_steps, task_turn, 'mpcr_steps');
            if (wfTask_id != null && mpcr_load_type == 2) {
                $('.mpcr_editView').show();
                if (mpcr_otable == 'plg') {
                    $('.mpcr_div_sample').show();
                    data_mpcr_sample = f_get_general_info_multiple('phy_sample_info', {phyRep_no:phyRep_no}, {}, '', 'phyLab_code');
                    f_dataTable_draw(mpcr_otable_sample, data_mpcr_sample, 'datatable_mpcr_sample', 5);
                } else if (mpcr_otable == 'pwb') {
                    mpcr_otable_workbook.columns(2).visible(false);
                    mpcr_otable_workbook.columns(3).visible(true);
                    $('.mpcr_attachEdit').show();
                } else if (mpcr_otable == 'pvf' || mpcr_otable == 'pvs') {
                    $('.mpcr_div_action').show(); 
                    if (wf_task.wfTask_statusSave != null)
                        $("input[name='mpcr_action'][value="+wf_task.wfTask_statusSave+"]").prop('checked', true);
                    $('#mpcr_snote_wfTask_remark').summernote('code', wf_task.wfTask_remark);
                }
            } else if (mpcr_load_type == 3) {
                //
            }
            data_mpcr_history = f_get_general_info_multiple('dt_task_history', {wfTrans_id:(cert_info.wfTrans_id!=null?cert_info.wfTrans_id:'0')}, '', '', 'wfTask_id');
            f_dataTable_draw(mpcr_otable_history, data_mpcr_history, 'datatable_mpcr_history', 6);
            $('#mpcr_wfTask_id').val(wfTask_id);
            $('#modal_phy_certificate').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>    