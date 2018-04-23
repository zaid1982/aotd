<script src="js/plugin/summernote/summernote.min.js"></script>

<script type="text/javascript">
    
    var mfcr_otable;
    var mfcr_load_type;
    var mfcr_otable_history;
    var data_mfcr_history;
    var mfcr_otable_sample;
    var data_mfcr_sample;
    var mfcr_otable_sampleView;
    var data_mfcr_sampleView;
    var mfcr_otable_workbook;
    var data_mfcr_workbook = '';
    var mfcr_otable_upload;
    var data_mfcr_upload;
        
    $(document).ready(function () {
        
        $('#mfcr_snote_wfTask_remark').summernote({
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
        
        $('#mfcr_effRep_timeStarted').datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: '0',
            changeMonth: true,
            changeYear: true,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: true,
            closeText:'Clear',
            beforeShow: function( input ) {
		setTimeout(function() {
                    var clearButton = $(input ).datepicker( "widget" ).find( ".ui-datepicker-close" );
                    clearButton.unbind("click").bind("click",function(){$.datepicker._clearDate( input );});
                    }, 1 );
            },
            onSelect: function( input ) {
                $('#form_mfcr_starting').bootstrapValidator('revalidateField', 'mfcr_effRep_timeStarted');
            }
        });
        
        $('#form_mfcr_form').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#form_mfcr_starting').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mfcr_effRep_timeStarted : {
                    validators : {
                        notEmpty: {
                            message: 'Starting Date is required'
                        }                     
                    }
                }    
            }
        });        
        
        $('#form_mfcr_workbook').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#form_mfcr_action').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mfcr_action : {
                    validators : {
                        notEmpty: {
                            message: 'Action/Result is required'
                        }                     
                    }
                }                
            }
        });
        
        var datatable_mfcr_sample = undefined; 
        mfcr_otable_sample = $('#datatable_mfcr_sample').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mfcr_sample) {
                    datatable_mfcr_sample = new ResponsiveDatatablesHelper($('#datatable_mfcr_sample'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mfcr_sample.createExpandIcon(nRow);
                var info = mfcr_otable_sample.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mfcr_sample.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_mfcr_form").data('bootstrapValidator');
                        bootstrapValidator.addField('mfcr_effLab_sampleCode_'+visibleRows[j].effLab_code, {validators:{notEmpty:{message:'Required'},stringLength:{max:100, message:'Max 100 words'}}});
                        bootstrapValidator.addField('mfcr_effLab_cost_'+visibleRows[j].effLab_code, {validators:{notEmpty:{message:'Required'}, numeric:{message:'Invalid',thousandsSeparator:'',decimalSeparator:'.'},callback:{message:'Can\'t be negative',callback:function(value,validator,$field){return(value==''||isNaN(value)||parseFloat(value)>=0);}}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'effLab_code'},
                    {mData: 'effLab_sampleCode', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mfcr_effLab_sampleCode_'+row.effLab_code+'" id="mfcr_effLab_sampleCode_'+row.effLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: 'effLab_sampleDesc', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mfcr_effLab_sampleDesc_'+row.effLab_code+'" id="mfcr_effLab_sampleDesc_'+row.effLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: 'effLab_cost', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mfcr_effLab_cost_'+row.effLab_code+'" id="mfcr_effLab_cost_'+row.effLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mfcr_sampleView = undefined; 
        mfcr_otable_sampleView = $('#datatable_mfcr_sampleView').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mfcr_sampleView) {
                    datatable_mfcr_sampleView = new ResponsiveDatatablesHelper($('#datatable_mfcr_sampleView'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mfcr_sampleView.createExpandIcon(nRow);
                var info = mfcr_otable_sampleView.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mfcr_sampleView.respond();
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'effLab_code'},
                    {mData: 'effLab_sampleCode'},
                    {mData: 'effLab_sampleDesc'},
                    {mData: 'effLab_cost', sClass: 'padding-5 text-right',
                        mRender: function (data, type, row) {
                            return formattedNumber(data, 2);
                        }
                    },
                    {mData: "effRep_no", bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.effLab_code + '\',\'' + row.effLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                            return $label;
                        }
                    }
                ]
        });
        $('#datatable_mfcr_sampleView tbody').delegate('tr', 'mouseenter', function (evt) {
            var $cell=$(evt.target).closest('td');
            $cell.css( 'cursor', 'pointer' ); 
        });
        $('#datatable_mfcr_sampleView tbody').delegate('tr', 'click', function (evt) {
            var data = mfcr_otable_sampleView.row( this ).data();
            var $cell=$(evt.target).closest('td');
            if (data_mfcr_sampleView.length > 1) {
                $("#datatable_mfcr_sampleView tbody tr").removeClass('bg-color-yellow txt-color-white');		
                $(this).addClass('bg-color-yellow txt-color-white');
                if (mfcr_load_type == 2 && mfcr_otable == 'fwb')
                    f_mfcr_save_workbook(0);
                $('#mfcr_effLab_code').val(data['effLab_code']);
                f_mfcr_workbook();
            }
        }); 
        
        var datatable_mfcr_workbook = undefined; 
        mfcr_otable_workbook = $('#datatable_mfcr_workbook').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mfcr_workbook) {
                    datatable_mfcr_workbook = new ResponsiveDatatablesHelper($('#datatable_mfcr_workbook'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mfcr_workbook.createExpandIcon(nRow);
                var info = mfcr_otable_workbook.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mfcr_workbook.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_mfcr_workbook").data('bootstrapValidator');
                        bootstrapValidator.addField('mfcr_effRes_res_'+visibleRows[j].effRes_id, {validators:{notEmpty:{message:'Required'},stringLength:{max:255, message:'Max 255 words'}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'effField_name'},
                    {mData: 'effRes_res'},
                    {mData: null, sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mfcr_effRes_res_'+row.effRes_id+'" id="mfcr_effRes_res_'+row.effRes_id+'" value="'+(row.effRes_res!=null?row.effRes_res:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mfcr_upload = undefined; 
        mfcr_otable_upload = $('#datatable_mfcr_upload').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mfcr_upload) {
                    datatable_mfcr_upload = new ResponsiveDatatablesHelper($('#datatable_mfcr_upload'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mfcr_upload.createExpandIcon(nRow);
                var info = mfcr_otable_upload.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mfcr_upload.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_mfcr_upload_paginate')[0].style.display = "block";
                    $('#datatable_mfcr_upload_info')[0].style.display = "block";
                } else {
                    $('#datatable_mfcr_upload_paginate')[0].style.display = "none";
                    $('#datatable_mfcr_upload_info')[0].style.display = "none";
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
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mvd_load_view_document (1, '+row.document_id+',\'mfcr\');" data-toggle="tooltip" data-original-title="View Attachment"><i class="fa fa-file-o"></i></a> ';
                            $label += '<a href="javascript:void(0)" class="btn btn-danger btn-xs mfcr_attachEdit" style="width:24px" onclick="f_mup_delete_file ('+row.document_id+', \'mfcr\');" data-toggle="tooltip" data-original-title="Delete Attachment"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mfcr_history = undefined; 
        mfcr_otable_history = $('#datatable_mfcr_history').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mfcr_history) {
                    datatable_mfcr_history = new ResponsiveDatatablesHelper($('#datatable_mfcr_history'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mfcr_history.createExpandIcon(nRow);
                var info = mfcr_otable_history.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mfcr_history.respond();
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
        
        $('#modal_eff_certificate').on('hide.bs.modal', function() {
            if (mfcr_load_type == 2) {
                if (mfcr_otable == 'flg') {
                    $.each(data_mfcr_sample, function(u){
                        var bootstrapValidator = $("#form_mfcr_form").data('bootstrapValidator');
                        bootstrapValidator.removeField('mfcr_effLab_sampleCode_'+data_mfcr_sample[u].effLab_code); 
                        bootstrapValidator.removeField('mfcr_effLab_cost_'+data_mfcr_sample[u].effLab_code); 
                    });
                } else if (mfcr_otable == 'fwb') {
                    $.each(data_mfcr_workbook, function(u){
                        var bootstrapValidator = $("#form_mfcr_workbook").data('bootstrapValidator');
                        bootstrapValidator.removeField('mfcr_effRes_res_'+data_mfcr_workbook[u].effRes_id); 
                    });
                    data_mfcr_workbook = '';
                }
            }
        }); 
        
        $('#mfcr_btn_save').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){   
                if (mfcr_load_type == 2 && mfcr_otable == 'flg' && $('#mfcr_wfTaskType_id').val() == '41') {
                    $('#mfcr_funct').val('save_eff_sample_info');
                    if (f_submit_forms('form_mfcr,#form_mfcr_form', 'p_aotd', 'Data successfully saved.')) {
                        data_mfcr_sample = f_get_general_info_multiple('eff_sample_info', {effRep_no:$('#mfcr_effRep_no').val()}, {}, '', 'effLab_code');
                        f_dataTable_draw(mfcr_otable_sample, data_mfcr_sample, 'datatable_mfcr_sample', 3);
                    }
                } else if (mfcr_load_type == 2 && mfcr_otable == 'fsd' && $('#mfcr_wfTaskType_id').val() == '42') {
                    $('#mfcr_funct').val('save_eff_starting_date');
                    if (f_submit_forms('form_mfcr,#form_mfcr_starting', 'p_aotd', 'Data successfully saved.')) {
                        var cert_info = f_get_general_info('vw_eff_cert', {effRep_no:$('#mfcr_effRep_no').val()}, 'mfcr');
                        var date_started = cert_info.effRep_timeStarted;
                        $('#mfcr_effRep_timeStarted').val(date_started!=null?date_started.substr(0,10):'');
                    }
                } else if (mfcr_load_type == 2 && mfcr_otable == 'fwb') {
                    f_mfcr_save_workbook(0);
                } else if (mfcr_load_type == 2 && ((mfcr_otable == 'fvf' && $('#mfcr_wfTaskType_id').val() == '44') ||(mfcr_otable == 'fvs' && $('#mfcr_wfTaskType_id').val() == '45'))) {
                    $('#mfcr_funct').val('save_eff_action');
                    $('#mfcr_wfTask_remark').val($('[name="mfcr_snote_wfTask_remark"]').summernote('code'));
                    f_submit_forms('form_mfcr,#form_mfcr_action', 'p_aotd', 'Data successfully saved.');
                }
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');                 
        }); 
        
        $('#mfcr_btn_submit').on('click', function () {
            if (mfcr_load_type == 2 && mfcr_otable == 'flg' && $('#mfcr_wfTaskType_id').val() == '41') {
                var bootstrapValidator = $("#form_mfcr_form").data('bootstrapValidator');
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
                            $('#mfcr_funct').val('save_eff_sample_info');
                            if (f_submit_forms('form_mfcr,#form_mfcr_form', 'p_aotd')) {
                                data_mfcr_sample = f_get_general_info_multiple('eff_sample_info', {effRep_no:$('#mfcr_effRep_no').val()}, {}, '', 'effLab_code');
                                f_dataTable_draw(mfcr_otable_sample, data_mfcr_sample, 'datatable_mfcr_sample', 3);
                                if (f_submit($('#mfcr_wfTask_id').val(), $('#mfcr_wfTaskType_id').val(), '10', 'Sample Registration successfully submitted.', '', '', '', '', 'effRep_no', $('#mfcr_effRep_no').val())) {
                                    f_flg_summary();
                                    f_flg_process (flg_summary_id);
                                    $('#modal_eff_certificate').modal('hide');
                                }
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else if (mfcr_load_type == 2 && mfcr_otable == 'fsd' && $('#mfcr_wfTaskType_id').val() == '42') {
                var bootstrapValidator = $("#form_mfcr_starting").data('bootstrapValidator');
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
                            $('#mfcr_funct').val('save_eff_starting_date');
                            if (f_submit_forms('form_mfcr,#form_mfcr_starting', 'p_aotd')) {
                                var cert_info = f_get_general_info('vw_eff_cert', {effRep_no:$('#mfcr_effRep_no').val()}, 'mfcr');
                                var date_started = cert_info.effRep_timeStarted;
                                $('#mfcr_effRep_timeStarted').val(date_started!=null?date_started.substr(0,10):'');
                                if (f_submit($('#mfcr_wfTask_id').val(), $('#mfcr_wfTaskType_id').val(), '10', 'Starting Date successfully submitted.', '', '', '', '', 'effRep_no', $('#mfcr_effRep_no').val())) {
                                    f_fsd_summary();
                                    f_fsd_process (fsd_summary_id);
                                    $('#modal_eff_certificate').modal('hide');
                                }
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else if (mfcr_load_type == 2 && mfcr_otable == 'fwb' && $('#mfcr_wfTaskType_id').val() == '43') {
                $.SmartMessageBox({
                    title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                    content : "Are you sure?",
                    buttons : '[No][Yes]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "Yes") {
                        $('#modal_waiting').on('shown.bs.modal', function(e){  
                            var check_workbook = '0';  
                            if (f_mfcr_save_workbook(1)) {
                                if (f_submit_normal('validate_eff_workbook', {effRep_no:$('#mfcr_effRep_no').val(), effRes_cycle:$('#mfcr_effRep_cycle').val()}, 'p_aotd')) {
                                    check_workbook = result_submit; 
                                }
                            }
                            if (check_workbook == '1') {
                                var submit_status = $('#mfcr_wfTask_status').val() == '22' ? '13' : '10'; 
                                if (f_submit($('#mfcr_wfTask_id').val(), $('#mfcr_wfTaskType_id').val(), submit_status, 'Workbook successfully submitted.', '', '', '', '', 'effRep_no', $('#mfcr_effRep_no').val())) {
                                    f_fwb_summary();
                                    f_fwb_process (fwb_summary_id);
                                    $('#modal_eff_certificate').modal('hide');
                                }
                            } else {
                                $('#mfcr_effLab_code').val(check_workbook);
                                f_mfcr_workbook();
                                $("#datatable_mfcr_sampleView tbody tr").removeClass('bg-color-yellow txt-color-white');
                                for (var i=0; i<data_mfcr_sampleView.length; i++) {
                                    if (data_mfcr_sampleView[i].effLab_code == check_workbook)
                                        $('#datatable_mfcr_sampleView tbody tr').eq(i).addClass('bg-color-yellow txt-color-white');
                                }
                                var bootstrapValidator = $('#form_mfcr_workbook').data('bootstrapValidator');
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
            } else if (mfcr_load_type == 2 && ((mfcr_otable == 'fvf' && $('#mfcr_wfTaskType_id').val() == '44') ||(mfcr_otable == 'fvs' && $('#mfcr_wfTaskType_id').val() == '45'))) {
                var bootstrapValidator = $("#form_mfcr_action").data('bootstrapValidator');
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
                            var submit_status = $('input[name="mfcr_action"]:checked').val() == '10' ? ($('#mfcr_wfTask_status').val() == '22' ? '13' : '10') : $('input[name="mfcr_action"]:checked').val(); 
                            $('#mfcr_wfTask_remark').val($('[name="mfcr_snote_wfTask_remark"]').summernote('code'));
                            var submit_remark = $('#mfcr_wfTask_remark').val();
                            var condition_no = submit_status == '12' ? '1' : '';
                            if (f_submit($('#mfcr_wfTask_id').val(), $('#mfcr_wfTaskType_id').val(), submit_status, 'Physical Certificate validation successfully submitted.', submit_remark, condition_no, '', '', 'effRep_no', $('#mfcr_effRep_no').val())) {
                                if (mfcr_otable == 'fvf') {
                                    f_fvf_summary();
                                    f_fvf_process(fvf_summary_id);
                                } else if (mfcr_otable == 'fvs') {
                                    f_fvs_summary();
                                    f_fvs_process(fvs_summary_id);
                                }
                                $('#modal_eff_certificate').modal('hide');
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
    
    function f_mfcr_workbook() {
        if ($('#mfcr_effLab_code').val() == '') {
            f_notify(2, 'Error', errMsg_validation);    
            return false;
        }
        if (data_mfcr_workbook != '') {
            $.each(data_mfcr_workbook, function(u){
                var bootstrapValidator = $("#form_mfcr_workbook").data('bootstrapValidator');
                bootstrapValidator.removeField('mfcr_effRes_res_'+data_mfcr_workbook[u].effRes_id); 
            });
        }
        $('#form_mfcr_workbook').trigger('reset'); 
        $('#form_mfcr_workbook').bootstrapValidator('resetForm', true); 
        f_get_general_info('eff_sample_info', {effLab_code:$('#mfcr_effLab_code').val()}, 'mfcr');
        var effField_status = (mfcr_load_type == 2 && mfcr_otable == 'pwb') ? '1' : '';
        data_mfcr_workbook = f_get_general_info_multiple('dt_eff_test_res', {effLab_code:$('#mfcr_effLab_code').val(), effField_status:effField_status, effRes_cycle:$('#mfcr_effRep_cycle').val()}, {}, '', 'effRes_id');
        f_dataTable_draw(mfcr_otable_workbook, data_mfcr_workbook, 'datatable_mfcr_workbook', 4);
    }
    
    function f_mfcr_save_workbook(is_submit) {
        var is_workbook_saved = false;
        $('#mfcr_funct').val('save_eff_workbook');
        var msg_success = is_submit == 0 ? 'Wookbook successfully saved.' : '';
        if (f_submit_forms('form_mfcr,#form_mfcr_workbook', 'p_aotd', msg_success)) {
            f_mfcr_workbook();
            is_workbook_saved = true;
        }
        return is_workbook_saved;
    }
    
    function f_mfcr_load_certificate(load_type, effRep_no, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mfcr, #form_mfcr_form, #form_mfcr_workbook, #form_mfcr_starting').trigger('reset'); 
            $('#form_mfcr_form').bootstrapValidator('resetForm', true); 
            $('#form_mfcr_workbook').bootstrapValidator('resetForm', true); 
            $('#form_mfcr_starting').bootstrapValidator('resetForm', true); 
            $('#form_mfcr_workbook').find('input, textarea, select').prop('disabled',false);
            mfcr_otable = otable;
            mfcr_load_type = load_type;
            $('.mfcr_viewOnly').prop('disabled',true);
            $('.mfcr_editView, .mfcr_div_sample, .mfcr_div_sampleView, .mfcr_div_workbook, .mfcr_div_starting, .mfcr_attachEdit, .mfcr_div_action').hide();
            f_get_general_info('aotd_lab', {lab_id:'EFF'}, 'mfcr');
            var cert_info = f_get_general_info('vw_eff_cert', {effRep_no:effRep_no}, 'mfcr');
            $('#mfcr_effRep_cycle').val(cert_info.effRep_cycle);
            if (cert_info.effRep_status != '2') {
                $('.mfcr_div_sampleView').show();
                data_mfcr_sampleView = f_get_general_info_multiple('eff_sample_info', {effRep_no:effRep_no}, {}, '', 'effLab_code');
                f_dataTable_draw(mfcr_otable_sampleView, data_mfcr_sampleView, 'datatable_mfcr_sampleView', 5);
                if (data_mfcr_sampleView.length > 1) 
                    $('#datatable_mfcr_sampleView tbody tr').eq(0).addClass('bg-color-yellow txt-color-white');
                if (cert_info.effRep_status != '51') {
                    $('.mfcr_div_workbook').show();
                    $('#mfcr_effLab_code').val(data_mfcr_sampleView[0].effLab_code);
                    f_mfcr_workbook();
                    mfcr_otable_workbook.columns(2).visible(true);
                    mfcr_otable_workbook.columns(3).visible(false);
                    var mfcr_wfTrans_id = cert_info.wfTrans_id != null ? cert_info.wfTrans_id : '0';
                    data_mfcr_upload = f_get_general_info_multiple('dt_document', {wfTrans_id:mfcr_wfTrans_id}, {}, '', 'document_sampleCode');
                    f_dataTable_draw(mfcr_otable_upload, data_mfcr_upload, 'datatable_mfcr_upload', 6);
                    $('.mfcr_attachEdit').hide();
                }
            }
            var task_turn = 1;
            var wf_task;
            if (cert_info.wfTrans_id != null) {
                wf_task = f_get_general_info('wf_task', {wfTrans_id:cert_info.wfTrans_id, wfTask_partition:'1'}, 'mfcr');
                var wf_task_type = f_get_general_info('wf_task_type', {wfTaskType_id:wf_task.wfTaskType_id});
                task_turn = wf_task_type.wfTaskType_turn;
            } else {
                if (cert_info.effRep_status == '4')
                    task_turn = '2';
                else if (cert_info.effRep_status == '48')
                    task_turn = '4';
                else if (cert_info.effRep_status == '49')
                    task_turn = '5';
                else if (cert_info.effRep_status == '42')
                    task_turn = '6';
            }
            var arr_steps = f_get_general_info_multiple('wf_task_type', {wfFlow_id:'5'});
            f_steps (arr_steps, task_turn, 'mfcr_steps');
            if (wfTask_id != null && mfcr_load_type == 2) {
                $('.mfcr_editView').show();
                if (mfcr_otable == 'flg') {
                    $('.mfcr_div_sample').show();
                    data_mfcr_sample = f_get_general_info_multiple('eff_sample_info', {effRep_no:effRep_no}, {}, '', 'effLab_code');
                    f_dataTable_draw(mfcr_otable_sample, data_mfcr_sample, 'datatable_mfcr_sample', 5);
                } else if (mfcr_otable == 'fsd') {
                    var date_started = cert_info.effRep_timeStarted;
                    $('#mfcr_effRep_timeStarted').val(date_started!=null?date_started.substr(0,10):'');
                    $('.mfcr_div_starting').show();
                } else if (mfcr_otable == 'fwb') {
                    mfcr_otable_workbook.columns(2).visible(false);
                    mfcr_otable_workbook.columns(3).visible(true);
                    $('.mfcr_attachEdit').show();
                } else if (mfcr_otable == 'fvf' || mfcr_otable == 'fvs') {
                    $('.mfcr_div_action').show(); 
                    if (wf_task.wfTask_statusSave != null)
                        $("input[name='mfcr_action'][value="+wf_task.wfTask_statusSave+"]").prop('checked', true);
                    $('#mfcr_snote_wfTask_remark').summernote('code', wf_task.wfTask_remark);
                }
            } else if (mfcr_load_type == 3) {
                //
            }
            data_mfcr_history = f_get_general_info_multiple('dt_task_history', {wfTrans_id:(cert_info.wfTrans_id!=null?cert_info.wfTrans_id:'0')}, '', '', 'wfTask_id');
            f_dataTable_draw(mfcr_otable_history, data_mfcr_history, 'datatable_mfcr_history', 6);
            $('#mfcr_wfTask_id').val(wfTask_id);
            $('#modal_eff_certificate').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>    