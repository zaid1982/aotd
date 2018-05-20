<script src="js/plugin/summernote/summernote.min.js"></script>

<script type="text/javascript">
    
    var mbcr_otable;
    var mbcr_load_type;
    var mbcr_otable_history;
    var data_mbcr_history;
    var mbcr_otable_sample;
    var data_mbcr_sample;
    var mbcr_otable_sampleView;
    var data_mbcr_sampleView;
    var mbcr_otable_workSummary;
    var data_mbcr_workSummary;
    var mbcr_otable_workbook_1;
    var data_mbcr_workbook_1;
    var mbcr_otable_workbook_2;
    var data_mbcr_workbook_2;
    var mbcr_otable_workbook_3;
    var data_mbcr_workbook_3;
    var mbcr_otable_upload;
    var data_mbcr_upload;
    var mbcr_current_day;
    var mbcr_bdtRep_cycle = 0;
    
    $(document).ready(function () {
        
        $('#mbcr_snote_bdtLab_result').summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']]
            ]//,
//            callbacks: {
//                onChange: function(contents, $editable) {
//                    $('#form_marc_action').bootstrapValidator('revalidateField', 'marc_snote_wfTask_remark');
//                    $('#marc_snote_wfTask_remark').val(contents);
//                }
//            }
        });   
        
        $('#mbcr_snote_wfTask_remark').summernote({
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
        
        $('#form_mbcr_form').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#form_mbcr_action').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                mbcr_action : {
                    validators : {
                        notEmpty: {
                            message: 'Final Test Status is required'
                        }                     
                    }
                }                
            }
        });
        
        var datatable_mbcr_sample = undefined; 
        mbcr_otable_sample = $('#datatable_mbcr_sample').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_sample) {
                    datatable_mbcr_sample = new ResponsiveDatatablesHelper($('#datatable_mbcr_sample'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_sample.createExpandIcon(nRow);
                var info = mbcr_otable_sample.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_sample.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_mbcr_form").data('bootstrapValidator');
                        bootstrapValidator.addField('mbcr_bdtLab_sampleCode_'+visibleRows[j].bdtLab_code, {validators:{notEmpty:{message:'Required'},stringLength:{max:100, message:'Max 100 words'}}});
                        bootstrapValidator.addField('mbcr_bdtLab_thod_'+visibleRows[j].bdtLab_code, {validators:{notEmpty:{message:'Required'},numeric:{max:100, message:'Invalid number', thousandsSeparator:'', decimalSeparator: '.'}}});
                        bootstrapValidator.addField('mbcr_bdtLab_result_'+visibleRows[j].bdtLab_code, {validators:{notEmpty:{message:'Required'},stringLength:{max:255, message:'Max 255 words'}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'bdtLab_code'},
                    {mData: 'bdtLab_sampleCode', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mbcr_bdtLab_sampleCode_'+row.bdtLab_code+'" id="mbcr_bdtLab_sampleCode_'+row.bdtLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: 'bdtLab_thod', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mbcr_bdtLab_thod_'+row.bdtLab_code+'" id="mbcr_bdtLab_thod_'+row.bdtLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: 'bdtLab_result', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mbcr_bdtLab_result_'+row.bdtLab_code+'" id="mbcr_bdtLab_result_'+row.bdtLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    {mData: "bdtRep_no", sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.bdtLab_code + '\',\'' + row.bdtLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mbcr_sampleView = undefined; 
        mbcr_otable_sampleView = $('#datatable_mbcr_sampleView').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_sampleView) {
                    datatable_mbcr_sampleView = new ResponsiveDatatablesHelper($('#datatable_mbcr_sampleView'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_sampleView.createExpandIcon(nRow);
                var info = mbcr_otable_sampleView.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_sampleView.respond();
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'bdtLab_code'},
                    {mData: 'bdtLab_sampleCode'},
                    {mData: 'bdtLab_thod'},
                    {mData: 'bdtLab_result'},
                    {mData: "bdtRep_no", bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.bdtLab_code + '\',\'' + row.bdtLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                            return $label;
                        }
                    }
                ]
        });
        $('#datatable_mbcr_sampleView tbody').delegate('tr', 'mouseenter', function (evt) {
            var $cell=$(evt.target).closest('td');
            $cell.css( 'cursor', 'pointer' ); 
        });
        $('#datatable_mbcr_sampleView tbody').delegate('tr', 'click', function (evt) {
            var data = mbcr_otable_sampleView.row( this ).data();
            var $cell=$(evt.target).closest('td');
            if (data_mbcr_sampleView.length > 1) {
                $("#datatable_mbcr_sampleView tbody tr").removeClass('bg-color-yellow txt-color-white');		
                $(this).addClass('bg-color-yellow txt-color-white');
                f_mbcr_workbook(data['bdtLab_code'], mbcr_bdtRep_cycle);
                $('#mbcr_snote_bdtLab_result').summernote('code', data['bdtLab_result']);
                $('#mbcr_bdtLab_result').val(data['bdtLab_result']);
                $('#mbcr_bdtLab_thod').val(data['bdtLab_thod']);
            }
        }); 
        
        var datatable_mbcr_workSummary = undefined; 
        mbcr_otable_workSummary = $('#datatable_mbcr_workSummary').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_workSummary) {
                    datatable_mbcr_workSummary = new ResponsiveDatatablesHelper($('#datatable_mbcr_workSummary'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_workSummary.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_workSummary.respond();
            },
            "aoColumns":
                [
                    {mData: 'bdtBiod_day', sClass: 'text-center'},
                    {mData: 'bdtBiod_ref', sClass: 'text-right'},
                    {mData: 'bdtBiod_sample', sClass: 'text-right'},
                    {mData: 'bdtBiod_tox', sClass: 'text-right'},
                    {mData: 'bdtBiod_statusMin', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = 'Completed';
                            if (row.bdtBiod_day == mbcr_current_day)
                                $label = 'Testing';
                            else if (data == '2')
                                $label = 'Waiting';
                            return $label;
                        }
                    },
                    {mData: null, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '';
                            if (row.bdtBiod_day == mbcr_current_day)
                                $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="" data-toggle="tooltip" data-original-title="Edit Workbook"><i class="fa fa-pencil-square-o"></i></a>';
                            else if (row.bdtBiod_statusMin == '1')
                                $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="" data-toggle="tooltip" data-original-title="Record Workbook"><i class="fa fa-pencil"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mbcr_workbook_1 = undefined; 
        mbcr_otable_workbook_1 = $('#datatable_mbcr_workbook_1').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_workbook_1) {
                    datatable_mbcr_workbook_1 = new ResponsiveDatatablesHelper($('#datatable_mbcr_workbook_1'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_workbook_1.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_workbook_1.respond();
            },
            "aoColumns":
                [
                    {mData: 'bdtRes_day', sClass: 'text-center'},
                    {mData: 'bdtRes_flask1_1', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_1', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_1', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_2', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_2', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_2', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_3', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_3', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_3', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_4', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_4', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_4', sClass: 'text-right'}
                ]
        });
        
        var datatable_mbcr_workbook_2 = undefined; 
        mbcr_otable_workbook_2 = $('#datatable_mbcr_workbook_2').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_workbook_2) {
                    datatable_mbcr_workbook_2 = new ResponsiveDatatablesHelper($('#datatable_mbcr_workbook_2'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_workbook_2.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_workbook_2.respond();
            },
            "aoColumns":
                [
                    {mData: 'bdtRes_day', sClass: 'text-center'},
                    {mData: 'bdtRes_flask1_1', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_1', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_1', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_2', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_2', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_2', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_3', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_3', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_3', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_4', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_4', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_4', sClass: 'text-right'}
                ]
        });
        
        var datatable_mbcr_workbook_3 = undefined; 
        mbcr_otable_workbook_3 = $('#datatable_mbcr_workbook_3').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_workbook_3) {
                    datatable_mbcr_workbook_3 = new ResponsiveDatatablesHelper($('#datatable_mbcr_workbook_3'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_workbook_3.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_workbook_3.respond();
            },
            "aoColumns":
                [
                    {mData: 'bdtRes_day', sClass: 'text-center'},
                    {mData: 'bdtRes_flask1_1', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_1', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_1', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_2', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_2', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_2', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_3', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_3', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_3', sClass: 'text-right'},
                    {mData: 'bdtRes_flask1_4', sClass: 'text-right'},
                    {mData: 'bdtRes_flask2_4', sClass: 'text-right'},
                    {mData: 'bdtRes_mean_4', sClass: 'text-right'}
                ]
        });
        
        var datatable_mbcr_upload = undefined; 
        mbcr_otable_upload = $('#datatable_mbcr_upload').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_upload) {
                    datatable_mbcr_upload = new ResponsiveDatatablesHelper($('#datatable_mbcr_upload'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_upload.createExpandIcon(nRow);
                var info = mbcr_otable_upload.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_upload.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_mbcr_upload_paginate')[0].style.display = "block";
                    $('#datatable_mbcr_upload_info')[0].style.display = "block";
                } else {
                    $('#datatable_mbcr_upload_paginate')[0].style.display = "none";
                    $('#datatable_mbcr_upload_info')[0].style.display = "none";
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
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mvd_load_view_document (1, '+row.document_id+',\'mbcr\');" data-toggle="tooltip" data-original-title="View Attachment"><i class="fa fa-file-o"></i></a> ';
                            $label += '<a href="javascript:void(0)" class="btn btn-danger btn-xs mbcr_attachEdit" style="width:24px" onclick="f_mup_delete_file ('+row.document_id+', \'mbcr\');" data-toggle="tooltip" data-original-title="Delete Attachment"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mbcr_history = undefined; 
        mbcr_otable_history = $('#datatable_mbcr_history').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mbcr_history) {
                    datatable_mbcr_history = new ResponsiveDatatablesHelper($('#datatable_mbcr_history'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mbcr_history.createExpandIcon(nRow);
                var info = mbcr_otable_history.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mbcr_history.respond();
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
        
        $('#modal_bdt_certificate').on('hide.bs.modal', function() {
            if (mbcr_load_type == 2) {
                if (mbcr_otable == 'blg') {
                    $.each(data_mbcr_sample, function(u){
                        var bootstrapValidator = $("#form_mbcr_form").data('bootstrapValidator');
                        bootstrapValidator.removeField('mbcr_bdtLab_sampleCode_'+data_mbcr_sample[u].bdtLab_code); 
                        bootstrapValidator.removeField('mbcr_bdtLab_thod_'+data_mbcr_sample[u].bdtLab_code); 
                        bootstrapValidator.removeField('mbcr_bdtLab_result_'+data_mbcr_sample[u].bdtLab_code); 
                    });
                }
            }
        }); 
        
        $('#mbcr_btn_save').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){   
                if (mbcr_load_type == 2 && mbcr_otable == 'blg') {
                    $('#mbcr_funct').val('save_bdt_sample_info');
                    $('#mbcr_wfTask_remark').val($('[name="mbcr_snote_wfTask_remark"]').summernote('code'));
                    if (f_submit_forms('form_mbcr,#form_mbcr_form,#form_mbcr_action', 'p_aotd', 'Data successfully saved.')) {
                        data_mbcr_sample = f_get_general_info_multiple('bdt_sample_info', {bdtRep_no:$('#mbcr_bdtRep_no').val()}, {}, '', 'bdtLab_code');
                        f_dataTable_draw(mbcr_otable_sample, data_mbcr_sample, 'datatable_mbcr_sample', 6);
                    }
                }
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');                 
        }); 
        
        $('#mbcr_btn_submit').on('click', function () {
            if (mbcr_load_type == 2 && mbcr_otable == 'blg' && $('#mbcr_wfTaskType_id').val() == '11') {
                var bootstrapValidator = $("#form_mbcr_form").data('bootstrapValidator');
                bootstrapValidator.validate();
                if (!bootstrapValidator.isValid()) {         
                    f_notify(2, 'Error', errMsg_validation);    
                    return false;
                }
                var bootstrapValidator2 = $("#form_mbcr_action").data('bootstrapValidator');
                bootstrapValidator2.validate();
                if (!bootstrapValidator2.isValid()) {         
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
                            $('#mbcr_funct').val('save_bdt_sample_info');
                            $('#mbcr_wfTask_remark').val($('[name="mbcr_snote_wfTask_remark"]').summernote('code'));
                            if (f_submit_forms('form_mbcr,#form_mbcr_form,#form_mbcr_action', 'p_aotd')) {
                                data_mbcr_sample = f_get_general_info_multiple('bdt_sample_info', {bdtRep_no:$('#mbcr_bdtRep_no').val()}, {}, '', 'bdtLab_code');
                                f_dataTable_draw(mbcr_otable_sample, data_mbcr_sample, 'datatable_mbcr_sample', 6);
                                if (f_submit($('#mbcr_wfTask_id').val(), $('#mbcr_wfTaskType_id').val(), $('input[name="mbcr_action"]:checked').val(), 'Sample Registration successfully submitted.', $('#mbcr_wfTask_remark').val(), '', '', '', 'bdtRep_no', $('#mbcr_bdtRep_no').val())) {
                                    f_blg_summary();
                                    f_blg_process (blg_summary_id);
                                    $('#modal_bio_certificate').modal('hide');
                                }
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else {
                f_notify(2, 'Error', errMsg_validation);    
                return false;
            }
        }); 
        
    });
    
    function f_mbcr_workbook(lab_code, bdtRep_cycle) {
        var bdtLab_code = lab_code != null ? lab_code : '-';
        data_mbcr_workSummary = f_get_general_info_multiple('dt_bdt_biod', {}, {bdtLab_code:bdtLab_code}, '', 'bdtBiod_day');;
        f_dataTable_draw(mbcr_otable_workSummary, data_mbcr_workSummary, 'datatable_mbcr_workSummary', 6);
        data_mbcr_workbook_1 = f_get_general_info_multiple('dt_bdt_workbook', {}, {bdtLab_code:bdtLab_code, bdtTest_id:'1', bdtRes_cycle:bdtRep_cycle}, '', 'bdtRes_day');
        f_dataTable_draw(mbcr_otable_workbook_1, data_mbcr_workbook_1, 'datatable_mbcr_workbook_1', 13);
        data_mbcr_workbook_2 = f_get_general_info_multiple('dt_bdt_workbook', {}, {bdtLab_code:bdtLab_code, bdtTest_id:'2', bdtRes_cycle:bdtRep_cycle}, '', 'bdtRes_day');
        f_dataTable_draw(mbcr_otable_workbook_2, data_mbcr_workbook_2, 'datatable_mbcr_workbook_2', 13);
        data_mbcr_workbook_3 = f_get_general_info_multiple('dt_bdt_workbook', {}, {bdtLab_code:bdtLab_code, bdtTest_id:'3', bdtRes_cycle:bdtRep_cycle}, '', 'bdtRes_day');
        f_dataTable_draw(mbcr_otable_workbook_3, data_mbcr_workbook_3, 'datatable_mbcr_workbook_3', 13);
    }
    
    function f_mbcr_load_certificate(load_type, bdtRep_no, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mbcr, #form_mbcr_form, #form_mbcr_workbook, #form_mbcr_action').trigger('reset'); 
            $('#form_mbcr_form').bootstrapValidator('resetForm', true); 
            $('#form_mbcr_workbook').bootstrapValidator('resetForm', true); 
            $('#form_mbcr_action').bootstrapValidator('resetForm', true); 
            $('#form_mbcr_workbook, #form_mbcr_action').find('input, textarea, select').prop('disabled',false);
            mbcr_otable = otable;
            mbcr_load_type = load_type;
            $('.mbcr_viewOnly').prop('disabled',true);
            $('.mbcr_editView, .mbcr_div_sample, .mbcr_div_sampleView, .mbcr_div_workbook').hide();
            f_get_general_info('aotd_lab', {lab_id:'BDT'}, 'mbcr');
            var cert_info = f_get_general_info('vw_bdt_cert', {bdtRep_no:bdtRep_no}, 'mbcr');
            mbcr_current_day = cert_info.bdtRep_days;
            if (cert_info.bdtRep_status != '2') {
                $('.mbcr_div_sampleView, .mbcr_div_workbook').show();
                data_mbcr_sampleView = f_get_general_info_multiple('bdt_sample_info', {bdtRep_no:bdtRep_no}, {}, '', 'bdtLab_code');
                f_dataTable_draw(mbcr_otable_sampleView, data_mbcr_sampleView, 'datatable_mbcr_sampleView', 5);
                if (data_mbcr_sampleView.length > 1) 
                    $('#datatable_mbcr_sampleView tbody tr').eq(0).addClass('bg-color-yellow txt-color-white');
                mbcr_bdtRep_cycle = cert_info.bdtRep_cycle;
                f_mbcr_workbook(data_mbcr_sampleView[0].bdtLab_code, mbcr_bdtRep_cycle);                
                $('#mbcr_snote_bdtLab_result').summernote('code', data_mbcr_sampleView[0].bdtLab_result);
                $('#mbcr_bdtLab_result').val(data_mbcr_sampleView[0].bdtLab_result);
                $('#mbcr_bdtLab_thod').val(data_mbcr_sampleView[0].bdtLab_thod);
                mbcr_otable_workSummary.columns(5).visible(false);
            }
            var task_turn = 1;
            var wf_task;
            if (cert_info.wfTrans_id != null) {
                wf_task = f_get_general_info('wf_task', {wfTrans_id:cert_info.wfTrans_id, wfTask_partition:'1'}, 'mbcr');
                var wf_task_type = f_get_general_info('wf_task_type', {wfTaskType_id:wf_task.wfTaskType_id});
                task_turn = wf_task_type.wfTaskType_turn;
            } else {
                if (cert_info.bdtRep_status == '4')
                    task_turn = '2';
                else if (cert_info.bdtRep_status == '48')
                    task_turn = '3';
                else if (cert_info.bdtRep_status == '42')
                    task_turn = '4';
            }
            var arr_steps = f_get_general_info_multiple('wf_task_type', {wfFlow_id:'2'});
            f_steps (arr_steps, task_turn, 'mbcr_steps');
            if (wfTask_id != null && mbcr_load_type == 2) {
                $('.mbcr_editView').show();
                if (mbcr_otable == 'blg') {
                    $('.mbcr_div_sample').show();
                    data_mbcr_sample = f_get_general_info_multiple('bdt_sample_info', {bdtRep_no:bdtRep_no}, {}, '', 'bdtLab_code');
                    f_dataTable_draw(mbcr_otable_sample, data_mbcr_sample, 'datatable_mbcr_sample', 6);
                    if (wf_task.wfTask_statusSave != null)
                        $("input[name='mbcr_action'][value="+wf_task.wfTask_statusSave+"]").prop('checked', true);
                    $('#mbcr_snote_wfTask_remark').summernote('code', wf_task.wfTask_remark);
                    $('#mbcr_snote_wfTask_remark').summernote('enable');
                } else if (mbcr_otable == 'bwb') {    
                    mbcr_otable_workSummary.columns(5).visible(true);
                }
            } else if (mbcr_load_type == 3) {
                $('#form_mbcr_workbook, #form_mbcr_action').find('input, textarea, select').prop('disabled',true);
                $("input[name='mbcr_action'][value="+cert_info.bdtRep_status+"]").prop('checked', true);
                $('#mbcr_snote_wfTask_remark').summernote('code', cert_info.bdtRep_conclusion);
                $('#mbcr_snote_bdtLab_result').summernote('disable');
                $('#mbcr_snote_wfTask_remark').summernote('disable');
                if (cert_info.bdtRep_isEntry == '1') {
                    $('.mbcr_div_workbook').hide();
                    $('#datatable_mbcr_sampleView tbody tr').eq(0).removeClass('bg-color-yellow txt-color-white');
                }
            }
            data_mbcr_upload = f_get_general_info_multiple('dt_document', {document_sampleCode:'%'+cert_info.bdtRep_no+'%'}, {}, '', 'document_sampleCode');
            f_dataTable_draw(mbcr_otable_upload, data_mbcr_upload, 'datatable_mbcr_upload', 6);
            data_mbcr_history = f_get_general_info_multiple('dt_task_history', {wfTrans_id:(cert_info.wfTrans_id!=null?cert_info.wfTrans_id:'0')}, '', '', 'wfTask_id');
            f_dataTable_draw(mbcr_otable_history, data_mbcr_history, 'datatable_mbcr_history', 6);
            $('#mbcr_wfTask_id').val(wfTask_id);
            $('#modal_bio_certificate').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>    