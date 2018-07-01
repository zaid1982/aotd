<script src="js/plugin/summernote/summernote.min.js"></script>
<script src="js/plugin/x-editable/x-editable.min.js"></script>

<script type="text/javascript">
        
    var macr_otable;
    var macr_load_type;
    var macr_otable_history;
    var data_macr_history;
    var macr_otable_costing;
    var data_macr_costing;
    var macr_otable_result;
    var data_macr_result;
    var macr_otable_sample;
    var data_macr_sample;
    var macr_otable_workSummary;
    var data_macr_workSummary;
    var macr_otable_book;
    var data_macr_book;
    var macr_otable_upload;
    var data_macr_upload;
    var macr_1st_load = true; 
    var ats_formula_vars;
    var macr_load_direct;
    
    $(document).ready(function () {       
                            
        $('#macr_snote_wfTask_remark').summernote({
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
//                    $('#form_macr_action').bootstrapValidator('revalidateField', 'macr_snote_wfTask_remark');
//                    $('#macr_snote_wfTask_remark').val(contents);
//                }
//            }
        });   
        
        $('#form_macr_form').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#form_macr_action').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
                macr_action : {
                    validators : {
                        notEmpty: {
                            message: 'Action/Result is required'
                        }                     
                    }
                }                
            }
        });

        var datatable_macr_sample = undefined; 
        macr_otable_sample = $('#datatable_macr_sample').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_macr_sample) {
                    datatable_macr_sample = new ResponsiveDatatablesHelper($('#datatable_macr_sample'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_sample.createExpandIcon(nRow);
                var info = macr_otable_sample.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_macr_sample.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_macr_form").data('bootstrapValidator');
                        bootstrapValidator.addField('macr_atsLab_sampleCode_'+visibleRows[j].atsLab_id, {validators:{notEmpty:{message:'Required'},stringLength:{max:100, message:'Max 100 words'}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'atsLab_code'},
                    {mData: 'atsLab_sampleCode', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="macr_atsLab_sampleCode_'+row.atsLab_id+'" id="macr_atsLab_sampleCode_'+row.atsLab_id+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    },
                    { "data": "atsLab_code", bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {     
                            $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.atsLab_code + '\',\'' + row.atsLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                            return $label;
                        }
                    } 
                ]
        });
        
        var datatable_macr_costing = undefined; 
        macr_otable_costing = $('#datatable_macr_costing').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_macr_costing) {
                    datatable_macr_costing = new ResponsiveDatatablesHelper($('#datatable_macr_costing'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_costing.createExpandIcon(nRow);
                var info = macr_otable_costing.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_macr_costing.respond();
                $('.macr_editable_overrid').editable({
                    validate: function (value) {
                        if ($.trim(value) == '')
                            return 'Required';
                        else if (isNaN(value))
                            return 'Must be number';
                    },
                    success: function(response, newValue) {
                        var certTest_id = this.id;
                        certTest_id = certTest_id.slice(13);
                        if (f_submit_normal('save_ats_overrid', {atsCertTest_id:certTest_id, atsCertTest_overrid:newValue}, 'p_aotd')) {
                            data_macr_costing = f_get_general_info_multiple('dt_ats_cert_test', {atsCert_id:$('#macr_atsCert_id').val()}, {}, '', 'atsTest_name');
                            f_dataTable_draw(macr_otable_costing, data_macr_costing, 'datatable_macr_costing', 7);
                        }
                    }
                });
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api();
                var total = api.column(6).data()
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);
                $(api.column(6).footer()).html(formattedNumber(total, 2));
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'atsTest_name'},
                    {mData: 'atsTest_overrids', bSortable: false, sClass: 'text-right',
                        mRender: function (data, type, row) {     
//                            $label = '<a href="javascript:void(0)" class="text-underline" id="" onclick="f_maov_load_overrid (2, '+row.atsCertTest_id+',\'macr\');" data-toggle="tooltip" data-original-title="Edit Overrid Value" title="Edit Overrid Value">'+data+'</a>';
//                            return (macr_otable == 'awb' && macr_load_type == '2') ? $label : data;
                            return '<a href="form-x-editable.html#" class="macr_editable_overrid" id="macr_overrid_'+row.atsCertTest_id+'" data-type="text" data-pk="1" data-value="'+formattedNumber(data)+'" data-placement="right" data-placeholder="Required" data-original-title="Enter your firstname"></a>';
                        }
                    },
                    {mData: 'atsTest_cost', sClass: 'text-right'},
                    {mData: 'atsCert_totalSample', sClass: 'text-right', mRender: function (data, type, row) { return formattedNumber(data)}},
                    {mData: 'atsTest_ujian', sClass: 'text-right'},
                    {mData: 'atsCertTest_cost', sClass: 'text-right', mRender: function (data, type, row) { return formattedNumber(data,2)}}
                ]
        });
        
        function f_macr_result_format (d) {
            var test_result = f_get_general_info_multiple('dt_ats_lab_result', {}, {atsCert_id:$('#macr_atsCert_id').val(), atsLab_id:d.atsLab_id}, '', 'atsTest_name');
            var html = '<table cellpadding="5" cellspacing="0" border="0" class="table table-hover table-condensed">';
            $.each(test_result, function(u){
                var test_name = test_result[u].atsTest_name;
                var field_name = test_result[u].atsField_name == null ? '' : test_result[u].atsField_name;
                var test_res = test_result[u].atsRes_res == null ? '' : test_result[u].atsRes_res;
                if (field_name == '' || test_name.toUpperCase() == field_name.toUpperCase()) {
                    html += '<tr>'+
                        '<td class="padding-left-15" width="30%">'+test_name+'</td>'+
                        '<td width="3%">:</td>'+
                        '<td>'+test_res+'</td>'+
                    '</tr>';
                } else {
                    html += '<tr>'+
                        '<td class="padding-left-15" width="45%">'+test_name+' - '+field_name+'</td>'+
                        '<td width="3%">:</td>'+
                        '<td>'+test_res+'</td>'+
                    '</tr>';
                }
            });
            html += '</table>';
            return html;
        }

        var datatable_macr_result = undefined; 
        macr_otable_result = $('#datatable_macr_result').DataTable( {
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-12'f>>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "aaSorting": [1,'asc'],
            "ordering": false,
            "bDestroy": true,
            "iDisplayLength": 10,
            "preDrawCallback": function () {
                if (!datatable_macr_result) {
                    datatable_macr_result = new ResponsiveDatatablesHelper($('#datatable_macr_result'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_result.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_macr_result.respond();
            },
            "columns": [
                {
                    "class":          'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "atsLab_code" },
                { "data": "atsLab_sampleCode" },
                { "data": "atsLab_code", bSortable: false, sClass: 'text-center',
                    mRender: function (data, type, row) {     
                        $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.atsLab_code + '\',\'' + row.atsLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                        return $label;
                    }
                }                
            ]
        } );

        $('#datatable_macr_result tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = macr_otable_result.row( tr );
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child( f_macr_result_format(row.data()) ).show();
                tr.addClass('shown');
            }
        });
                
        var datatable_macr_book = undefined; 
        macr_otable_book = $('#datatable_macr_book').DataTable({
            "aaSorting": [1,'asc'],
            "ordering": false,
            "autoWidth": false,
            "lengthChange": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_macr_book) {
                    datatable_macr_book = new ResponsiveDatatablesHelper($('#datatable_macr_book'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_book.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_macr_book.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_macr_book_paginate')[0].style.display = "block";
                    $('#datatable_macr_book_info')[0].style.display = "block";
                } else {
                    $('#datatable_macr_book_paginate')[0].style.display = "none";
                    $('#datatable_macr_book_info')[0].style.display = "none";
                }
            },
            "aoColumns":
                [
                    {mData: 'atsLab_code'},
                    {mData: 'a0'},
                    {mData: 'a1'},
                    {mData: 'a2'},
                    {mData: 'a3'},
                    {mData: 'a4'},
                    {mData: 'a5'},
                    {mData: 'a6'},
                    {mData: 'a7'},
                    {mData: 'a8'},
                    {mData: 'a9'},
                    {mData: 'atsRes_res'}
                ]
        });
        $('#datatable_macr_book tbody').delegate('tr', 'mouseenter', function (evt) {
            var $cell=$(evt.target).closest('td');
            if(macr_load_type == 2 && macr_otable == 'awb') {
                $cell.css( 'cursor', 'pointer' );    
            }
        });
        $('#datatable_macr_book tbody').delegate('tr', 'click', function (evt) {
            if(macr_load_type == 2 && macr_otable == 'awb') {
                var data = macr_otable_book.row( this ).data();
                if (data['atsRes_id'] == null)
                    f_marw_load_raw(1, data['atsLab_id'], data['atsField_id'], '', 'macr');
                else
                    f_marw_load_raw(2, data['atsLab_id'], data['atsField_id'], data['atsRes_id'], 'macr');
            }
        });
                
        var datatable_macr_workSummary = undefined; 
        macr_otable_workSummary = $('#datatable_macr_workSummary').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "aaSorting": [[1,'asc'],[2,'asc']],
            "iDisplayLength": 10,
            "preDrawCallback": function () {
                if (!datatable_macr_workSummary) {
                    datatable_macr_workSummary = new ResponsiveDatatablesHelper($('#datatable_macr_workSummary'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_workSummary.createExpandIcon(nRow);
                var info = macr_otable_workSummary.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_macr_workSummary.respond();
                if (typeof macr_load_direct !== 'undefined' && macr_load_direct != '') {
                    var api = this.api();
                    var visibleRows=api.rows().data();
                    if(visibleRows.length >= 1){
                        for(var j=0;j<visibleRows.length;j++){
                            if (visibleRows[j].atsField_id == macr_load_direct) {
                                $('#datatable_macr_workSummary tbody tr').eq(j).addClass('bg-color-yellow txt-color-white');
                                alert(macr_load_direct);
                                f_macr_generate_workbook(macr_load_direct);
                                macr_load_direct = '';
                                break;
                            }
                        }
                    }
                }                
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'atsTest_name'},
                    {mData: 'atsField_name'},
                    {mData: 'atsFormula_img',
                        mRender: function (data, type, row) {
                            $label = data==null?'':'<img src="img/aotd-formula/'+data+'" alt=" " >';
                            return $label;
                        }
                    },
                    {mData: 'total', sClass: 'text-right',
                        mRender: function (data, type, row) {  
                            $label = row.atsCertField_id==null?'':data+' / '+row.total_lab;
                            return $label;
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {     
                            if (row.atsCertField_id == null)
                                $label = '<a href="javascript:void(0)" class="btn btn-danger btn-xs" style="width:24px" onclick="f_masf_load_formula (2, '+row.atsCert_id+', '+row.atsField_id+', '+row.atsCertField_id+',\'macr\');" data-toggle="tooltip" data-original-title="Set Formula" title="Set Formula"><i class="fa fa-superscript"></i></a>';
                            else
                                $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_masf_load_formula (2, '+row.atsCert_id+', '+row.atsField_id+', '+row.atsCertField_id+',\'macr\');" data-toggle="tooltip" data-original-title="Change Formula" title="Change Formula"><i class="fa fa-superscript"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $('#datatable_macr_workSummary tbody').delegate('tr', 'mouseenter', function (evt) {
            var $cell=$(evt.target).closest('td');
            if( $cell.index()<5) {
                $cell.css( 'cursor', 'pointer' );    
            }
        });
        $('#datatable_macr_workSummary tbody').delegate('tr', 'click', function (evt) {
            var data = macr_otable_workSummary.row( this ).data();
            var $cell=$(evt.target).closest('td');
            if( $cell.index()<5) {                
                if (data['atsCertField_id'] == null && macr_otable == 'awb' && macr_load_type == 2) {
                    f_masf_load_formula (1, data['atsCert_id'], data['atsField_id'], data['atsCertField_id'] , 'macr');   
                } else {
                    $('#modal_waiting').on('shown.bs.modal', function(e){   
                        f_macr_generate_workbook(data['atsField_id']);
                        $('#modal_waiting').modal('hide');
                        $(this).unbind(e);
                    }).modal('show');                    		
                    $("#datatable_macr_workSummary tbody tr").removeClass('bg-color-yellow txt-color-white');
                    $(this).addClass('bg-color-yellow txt-color-white');
                }
            }
        });
        
        var datatable_macr_upload = undefined; 
        macr_otable_upload = $('#datatable_macr_upload').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_macr_upload) {
                    datatable_macr_upload = new ResponsiveDatatablesHelper($('#datatable_macr_upload'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_upload.createExpandIcon(nRow);
                var info = macr_otable_upload.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_macr_upload.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_macr_upload_paginate')[0].style.display = "block";
                    $('#datatable_macr_upload_info')[0].style.display = "block";
                } else {
                    $('#datatable_macr_upload_paginate')[0].style.display = "none";
                    $('#datatable_macr_upload_info')[0].style.display = "none";
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
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mvd_load_view_document (1, '+row.document_id+',\'macr\');" data-toggle="tooltip" data-original-title="View Attachment"><i class="fa fa-file-o"></i></a> ';
                            $label += '<a href="javascript:void(0)" class="btn btn-danger btn-xs macr_attachEdit" style="width:24px" onclick="f_mup_delete_file ('+row.document_id+', \'macr\');" data-toggle="tooltip" data-original-title="Delete Attachment"><i class="fa fa-trash-o"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_macr_history = undefined; 
        macr_otable_history = $('#datatable_macr_history').DataTable({
            "ordering": false,
            "lengthChange": false,
            "autoWidth": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_macr_history) {
                    datatable_macr_history = new ResponsiveDatatablesHelper($('#datatable_macr_history'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_history.createExpandIcon(nRow);
                var info = macr_otable_history.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_macr_history.respond();
                if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
                    $('#datatable_macr_history_paginate')[0].style.display = "block";
                    $('#datatable_macr_history_info')[0].style.display = "block";
                } else {
                    $('#datatable_macr_history_paginate')[0].style.display = "none";
                    $('#datatable_macr_history_info')[0].style.display = "none";
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
        
        $('#modal_ats_certificate').on('hide.bs.modal', function() {
            if (macr_load_type == 2) {
                if (macr_otable == 'clg') {
                    $.each(data_macr_sample, function(u){
                        var bootstrapValidator = $("#form_macr_form").data('bootstrapValidator');
                        bootstrapValidator.removeField('macr_atsLab_sampleCode_'+data_macr_sample[u].atsLab_id); 
                    });
                }
            }
        }); 
        
        $('#macr_btn_save').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){   
                if (macr_load_type == 2 && macr_otable == 'clg') {
                    $('#macr_funct').val('save_ats_sample_info');
                    if (f_submit_forms('form_macr,#form_macr_form', 'p_aotd', 'Data successfully saved.')) {
                        data_macr_sample = f_get_general_info_multiple('ats_sample_info', {atsCert_id:$('#macr_atsCert_id').val()}, {}, '', 'atsLab_code');
                        f_dataTable_draw(macr_otable_sample, data_macr_sample, 'datatable_macr_sample', 4);
                    }
                } else if (macr_load_type == 2 && ((macr_otable == 'avf' && $('#macr_wfTaskType_id').val() == '3') ||(macr_otable == 'avs' && $('#macr_wfTaskType_id').val() == '4'))) {
                    $('#macr_funct').val('save_ats_action');
                    $('#macr_wfTask_remark').val($('[name="macr_snote_wfTask_remark"]').summernote('code'));
                    f_submit_forms('form_macr,#form_macr_action', 'p_aotd', 'Data successfully saved.');
                }
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');                 
        }); 
        
        $('#macr_btn_submit').on('click', function () {
            if (macr_load_type == 2 && macr_otable == 'clg' && $('#macr_wfTaskType_id').val() == '1') {
                var bootstrapValidator = $("#form_macr_form").data('bootstrapValidator');
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
                            $('#macr_funct').val('save_ats_sample_info');
                            if (f_submit_forms('form_macr,#form_macr_form', 'p_aotd')) {
                                data_macr_sample = f_get_general_info_multiple('ats_sample_info', {atsCert_id:$('#macr_atsCert_id').val()}, {}, '', 'atsLab_code');
                                f_dataTable_draw(macr_otable_sample, data_macr_sample, 'datatable_macr_sample', 4);
                                if (f_submit($('#macr_wfTask_id').val(), $('#macr_wfTaskType_id').val(), '10', 'Sample Registration successfully submitted.', '', '', '', '', 'atsCert_id', $('#macr_atsCert_id').val())) {
                                    f_clg_summary();
                                    f_clg_process (clg_summary_id);
                                    $('#modal_ats_certificate').modal('hide');
                                }
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else if (macr_load_type == 2 && macr_otable == 'awb' && $('#macr_wfTaskType_id').val() == '2') {
                var is_incomplete = false;
                $.each(data_macr_workSummary,function(u) {
                    if (data_macr_workSummary[u].total !== data_macr_workSummary[u].total_lab) {
                        f_notify(2, 'Error', 'Analysis <strong>'+data_macr_workSummary[u].atsTest_name+'</strong> still don\'t complete test for all samples. Please make sure all tests completed for all samples.');
                        is_incomplete = true;
                        return false;
                    }
                });
                if (is_incomplete)
                    return false;
                $.SmartMessageBox({
                    title : "<i class='fa fa-exclamation-circle'></i> Confirmation!",
                    content : "Are you sure?",
                    buttons : '[No][Yes]'
                }, function(ButtonPressed) {
                    if (ButtonPressed === "Yes") {
                        $('#modal_waiting').on('shown.bs.modal', function(e){   
                            var submit_status = $('#macr_wfTask_status').val() == '22' ? '13' : '10'; 
                            if (f_submit($('#macr_wfTask_id').val(), $('#macr_wfTaskType_id').val(), submit_status, 'ATS Workbook successfully submitted.', '', '', '', '', 'atsCert_id', $('#macr_atsCert_id').val())) {
                                f_awb_summary();
                                f_awb_process(awb_summary_id);
                                $('#modal_ats_certificate').modal('hide');
                            }
                            $('#modal_waiting').modal('hide');
                            $(this).unbind(e);
                        }).modal('show'); 
                    }                            
                });
            } else if (macr_load_type == 2 && ((macr_otable == 'avf' && $('#macr_wfTaskType_id').val() == '3') ||(macr_otable == 'avs' && $('#macr_wfTaskType_id').val() == '4'))) {
                var bootstrapValidator = $("#form_macr_action").data('bootstrapValidator');
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
                            var submit_status = $('input[name="macr_action"]:checked').val() == '10' ? ($('#macr_wfTask_status').val() == '22' ? '13' : '10') : $('input[name="macr_action"]:checked').val(); 
                            $('#macr_wfTask_remark').val($('[name="macr_snote_wfTask_remark"]').summernote('code'));
                            var submit_remark = $('#macr_wfTask_remark').val();
                            var condition_no = submit_status == '12' ? '1' : '';
                            if (f_submit($('#macr_wfTask_id').val(), $('#macr_wfTaskType_id').val(), submit_status, 'ATS Certificate validation successfully submitted.', submit_remark, condition_no, '', '', 'atsCert_id', $('#macr_atsCert_id').val())) {
                                if (macr_otable == 'avf') {
                                    f_avf_summary();
                                    f_avf_process(avf_summary_id);
                                } else if (macr_otable == 'avs') {
                                    f_avs_summary();
                                    f_avs_process(avs_summary_id);
                                }
                                $('#modal_ats_certificate').modal('hide');
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
    
    function f_macr_generate_workbook(field_id) {
        if (f_submit_normal('get_formula_id', {atsField_id:field_id}, 'p_aotd')) {
            $('#macr_atsFormula_id').val(result_submit.atsFormula_id);
            for (var i=1; i<=10; i++) {
                macr_otable_book.columns(i).visible(false);
            }
            var arr_var_id = [];
            var arr_lab_id = [];
            ats_formula_vars = f_get_general_info_multiple('ats_formula_vars', {atsformula_id:$('#macr_atsFormula_id').val()});
            var th_width = 10 - ats_formula_vars.length + 7;
            $.each(ats_formula_vars,function(u) {
                macr_otable_book.columns(u+1).visible(true);
                $(macr_otable_book.columns(u+1).header()).html(ats_formula_vars[u].atsVar_name);
                $('#datatable_macr_book thead th:eq(' + (u+1) + ')').width(th_width+'%');
                arr_var_id.push(ats_formula_vars[u].atsVar_id);
            });
            data_macr_book = f_get_general_info_multiple('dt_ats_res_wb', {}, {atsCert_id:$('#macr_atsCert_id').val(), atsRes_cycle:$('#macr_atsCert_cycle').val(), atsField_id:field_id});
            $.each(data_macr_book,function(u) {
                arr_lab_id.push(data_macr_book[u].atsLab_id);
            });
            ats_raw = f_get_general_info_multiple('dt_ats_raw', {}, {atsCert_id:$('#macr_atsCert_id').val(), atsField_id:field_id});
            $.each(ats_raw,function(u) {
                var index_var = jQuery.inArray(ats_raw[u].atsVar_id, arr_var_id);
                var index_lab = jQuery.inArray(ats_raw[u].atsLab_id, arr_lab_id);
                data_macr_book[index_lab]['a'+index_var] = ats_raw[u].atsRaw_value;
            });                        
//            '<div class="form-group margin-bottom-0" style="width:100%">' +
//                '<input type="text" class="form-control" style="width:100%" name="macr_atsRes_a0_'+row.atsLab_code+'" id="macr_atsRes_a0_'+row.atsLab_code+'" value="'+(data!=null?data:'')+'"/>' +
//                '</div>'
            f_dataTable_draw(macr_otable_book, data_macr_book, 'datatable_macr_book', 12);
            $('.macr_div_workbook2').show();
        }
    }
            
    function f_macr_load_certificate(load_type, atsCert_id, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_macr, #form_macr_form').trigger('reset'); 
            $('#form_macr_form').bootstrapValidator('resetForm', true);           
            $('#form_macr_action').bootstrapValidator('resetForm', true);   
            $('#form_macr_form').find('input, textarea, select').prop('disabled',false);
            macr_otable = otable;
            macr_load_type = load_type;
            $('.macr_viewOnly').prop('disabled',true);
            $('.macr_editView, .macr_div_costing, .macr_div_result, .macr_div_sample, .macr_div_workbook, .macr_div_workbook2, .macr_div_action, .macr_attachEdit, .macr_div_upload').hide();
            fa_get_general_info('aotd_lab', {lab_id:'ATS'}, 'macr');
            var cert_info = f_get_general_info('vw_ats_cert', {atsCert_id:atsCert_id}, 'macr');
            fa_get_general_info('vw_ats_analyst', {}, 'macr', '', {atsCert_id:atsCert_id});
            $('#macr_atsCert_cycle').val(cert_info.atsCert_cycle);
            if (cert_info.atsCert_status != '2') {
                $('.macr_div_workbook, .macr_div_costing, .macr_div_result').show();
                data_macr_costing = fa_get_general_info_multiple(macr_otable_costing, 'datatable_macr_costing', 7, 'dt_ats_cert_test', {atsCert_id:atsCert_id}, {}, 'atsTest_name');
                //f_dataTable_draw(macr_otable_costing, data_macr_costing, 'datatable_macr_costing', 7);
                data_macr_result = fa_get_general_info_multiple(macr_otable_result, 'datatable_macr_result', 3, 'ats_sample_info', {atsCert_id:atsCert_id});
                //f_dataTable_draw(macr_otable_result, data_macr_result, 'datatable_macr_result', 3);
                data_macr_workSummary = f_get_general_info_multiple('dt_ats_list_test', {}, {atsCert_id:atsCert_id});
                f_dataTable_draw(macr_otable_workSummary, data_macr_workSummary, 'datatable_macr_workSummary', 5);
                macr_otable_workSummary.columns(5).visible(false);
                if (data_macr_workSummary.length > 0 && data_macr_workSummary[0].atsField_id != null) {
                    if (data_macr_workSummary.length > 1)
                        $('#datatable_macr_workSummary tbody tr').eq(0).addClass('bg-color-yellow txt-color-white');
                    f_macr_generate_workbook(data_macr_workSummary[0].atsField_id);
                }
                data_macr_upload = fa_get_general_info_multiple(macr_otable_upload, 'datatable_macr_upload', 6, 'dt_document', {document_sampleCode:'%'+cert_info.atsCert_no+'%'}, {}, 'document_sampleCode');
                //f_dataTable_draw(macr_otable_upload, data_macr_upload, 'datatable_macr_upload', 6);
                $('.macr_div_upload').show();
            } 
            var task_turn = 1;
            var wf_task;
            if (cert_info.wfTrans_id != null) {
                wf_task = f_get_general_info('wf_task', {wfTrans_id:cert_info.wfTrans_id, wfTask_partition:'1'}, 'macr');
                var wf_task_type = f_get_general_info('wf_task_type', {wfTaskType_id:wf_task.wfTaskType_id});
                task_turn = wf_task_type.wfTaskType_turn;
            } else {
                if (cert_info.atsCert_status == '4')
                    task_turn = '2';
                else if (cert_info.atsCert_status == '48')
                    task_turn = '3';
                else if (cert_info.atsCert_status == '49')
                    task_turn = '4';
                else if (cert_info.atsCert_status == '42')
                    task_turn = '5';
            }
            var arr_steps = f_get_general_info_multiple('wf_task_type', {wfFlow_id:'1'});
            f_steps (arr_steps, task_turn, 'macr_steps');  
            if (wfTask_id != null && macr_load_type == 2) {
                $('.macr_editView').show();
                if (macr_otable == 'clg') {
                    $('.macr_div_sample').show();
                    data_macr_sample = f_get_general_info_multiple('ats_sample_info', {atsCert_id:atsCert_id}, {}, '', 'atsLab_code');
                    f_dataTable_draw(macr_otable_sample, data_macr_sample, 'datatable_macr_sample', 4);
                } else if (macr_otable == 'awb') {
                    $('#macr_btn_save').hide();
                    macr_otable_workSummary.columns(5).visible(true);
                    $('.macr_attachEdit').show();
                } else if (macr_otable == 'avf' || macr_otable == 'avs') {
                    $('.macr_div_action').show();                    
                    if (wf_task.wfTask_statusSave != null)
                        $("input[name='macr_action'][value="+wf_task.wfTask_statusSave+"]").prop('checked', true);
                    $('#macr_snote_wfTask_remark').summernote('code', wf_task.wfTask_remark);
                }
            }            
            data_macr_history = f_get_general_info_multiple('dt_task_history', {wfTrans_id:(cert_info.wfTrans_id!=null?cert_info.wfTrans_id:'0')}, '', '', 'wfTask_id');
            f_dataTable_draw(macr_otable_history, data_macr_history, 'datatable_macr_history', 6);
            $('#lmacr_atsCert_condition').html(cert_info.atsCondition_desc!=null?cert_info.atsCondition_desc:cert_info.atsCert_condition);
            $('#macr_wfTask_id').val(wfTask_id);
            $('#modal_ats_certificate').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
       
</script>