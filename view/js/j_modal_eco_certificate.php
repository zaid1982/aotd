<script src="js/plugin/summernote/summernote.min.js"></script>

<script type="text/javascript">
    
    var mccr_otable;
    var mccr_load_type;
    var mccr_otable_history;
    var data_mccr_history;
    var mccr_otable_sample;
    var data_mccr_sample;
    var mccr_otable_sampleView;
    var data_mccr_sampleView;
    var mccr_otable_workbook_10;
    var data_mccr_workbook_10;
    var mccr_otable_workbook_11;
    var data_mccr_workbook_11;
    var mccr_otable_workbook_20;
    var data_mccr_workbook_20;
    var mccr_otable_workbook_21;
    var data_mccr_workbook_21;
    var mccr_otable_workbook_22;
    var data_mccr_workbook_22;
    var mccr_otable_workbook_23;
    var data_mccr_workbook_23;
    var mccr_otable_workbook_24;
    var data_mccr_workbook_24;
    var mccr_current_day;
    var mccr_ectRep_cycle = 0;
    
    $(document).ready(function () {
        
        $('#form_mccr_form').bootstrapValidator({
            excluded: ':disabled',
            fields: { 
            }
        });
        
        $('#mccr_snote_ectLab_results').summernote({
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
        
        var datatable_mccr_sample = undefined; 
        mccr_otable_sample = $('#datatable_mccr_sample').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_sample) {
                    datatable_mccr_sample = new ResponsiveDatatablesHelper($('#datatable_mccr_sample'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_sample.createExpandIcon(nRow);
                var info = mccr_otable_sample.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_sample.respond();
                var api = this.api();
                var visibleRows=api.rows().data();
                if(visibleRows.length >= 1){
                    for(var j=0;j<visibleRows.length;j++){
                        var bootstrapValidator = $("#form_mccr_form").data('bootstrapValidator');
                        bootstrapValidator.addField('mccr_ectLab_sampleCode_'+visibleRows[j].ectLab_code, {validators:{notEmpty:{message:'Required'},stringLength:{max:100, message:'Max 100 words'}}});
                    }
                }
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'ectLab_code'},
                    {mData: 'ectLab_sampleCode', sClass: 'padding-5 text-center',
                        mRender: function (data, type, row) {
                            $label = '<div class="form-group margin-bottom-0" style="width:100%">' +
                                '<input type="text" class="form-control" style="width:100%" name="mccr_ectLab_sampleCode_'+row.ectLab_code+'" id="mccr_ectLab_sampleCode_'+row.ectLab_code+'" value="'+(data!=null?data:'')+'"/>' +
                                '</div>';
                            return $label;
                        }
                    }
                ]
        });
        
        var datatable_mccr_sampleView = undefined; 
        mccr_otable_sampleView = $('#datatable_mccr_sampleView').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_sampleView) {
                    datatable_mccr_sampleView = new ResponsiveDatatablesHelper($('#datatable_mccr_sampleView'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_sampleView.createExpandIcon(nRow);
                var info = mccr_otable_sampleView.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_sampleView.respond();
            },
            "aoColumns":
                [
                    {mData: null},
                    {mData: 'ectLab_code'},
                    {mData: 'ectLab_sampleCode'},
                    {mData: 'ectLab_results'},
                    {mData: "ectRep_no", bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.ectLab_code + '\',\'' + row.ectLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                            return $label;
                        }
                    }
                ]
        });
        $('#datatable_mccr_sampleView tbody').delegate('tr', 'mouseenter', function (evt) {
            var $cell=$(evt.target).closest('td');
            $cell.css( 'cursor', 'pointer' ); 
        });
        $('#datatable_mccr_sampleView tbody').delegate('tr', 'click', function (evt) {
            var data = mccr_otable_sampleView.row( this ).data();
            var $cell=$(evt.target).closest('td');
            if (data_mccr_sampleView.length > 1) {
                $("#datatable_mccr_sampleView tbody tr").removeClass('bg-color-yellow txt-color-white');		
                $(this).addClass('bg-color-yellow txt-color-white');
                f_mccr_workbook(data['ectLab_code'], mccr_ectRep_cycle);
                $('#mccr_snote_ectLab_results').summernote('code', data['ectLab_results']);
                $('#mccr_ectLab_results').val(data['ectLab_results']);
            }
        }); 
        
        var datatable_mccr_workbook_10 = undefined; 
        mccr_otable_workbook_10 = $('#datatable_mccr_workbook_10').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_10) {
                    datatable_mccr_workbook_10 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_10'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_10.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_10.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_workbook_11 = undefined; 
        mccr_otable_workbook_11 = $('#datatable_mccr_workbook_11').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_11) {
                    datatable_mccr_workbook_11 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_11'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_11.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_11.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_workbook_20 = undefined; 
        mccr_otable_workbook_20 = $('#datatable_mccr_workbook_20').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_20) {
                    datatable_mccr_workbook_20 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_20'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_20.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_20.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_workbook_21 = undefined; 
        mccr_otable_workbook_21 = $('#datatable_mccr_workbook_21').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_21) {
                    datatable_mccr_workbook_21 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_21'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_21.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_21.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_workbook_22 = undefined; 
        mccr_otable_workbook_22 = $('#datatable_mccr_workbook_22').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_22) {
                    datatable_mccr_workbook_22 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_22'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_22.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_22.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_workbook_23 = undefined; 
        mccr_otable_workbook_23 = $('#datatable_mccr_workbook_23').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_23) {
                    datatable_mccr_workbook_23 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_23'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_23.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_23.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_workbook_24 = undefined; 
        mccr_otable_workbook_24 = $('#datatable_mccr_workbook_24').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_workbook_24) {
                    datatable_mccr_workbook_24 = new ResponsiveDatatablesHelper($('#datatable_mccr_workbook_24'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_workbook_24.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_workbook_24.respond();
            },
            "aoColumns":
                [
                    {mData: 'ectRes_tank', sClass: 'text-center'},
                    {mData: 'ectRes_concentration', sClass: 'text-right'},
                    {mData: 'ectRes_ph', sClass: 'text-right'},
                    {mData: 'ectRes_oxy', sClass: 'text-right'},
                    {mData: 'ectRes_temp', sClass: 'text-right'},
                    {mData: 'ectRes_observation', sClass: 'text-right'}
                ]
        });
        
        var datatable_mccr_history = undefined; 
        mccr_otable_history = $('#datatable_mccr_history').DataTable({
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "info": false,
            "bFilter": false,
            "preDrawCallback": function () {
                if (!datatable_mccr_history) {
                    datatable_mccr_history = new ResponsiveDatatablesHelper($('#datatable_mccr_history'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_mccr_history.createExpandIcon(nRow);
                var info = mccr_otable_history.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_mccr_history.respond();
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
        
        $('#modal_ect_certificate').on('hide.bs.modal', function() {
            if (mccr_load_type == 2) {
                if (mccr_otable == 'elg') {
                    $.each(data_mccr_sample, function(u){
                        var bootstrapValidator = $("#form_mccr_form").data('bootstrapValidator');
                        bootstrapValidator.removeField('mccr_ectLab_sampleCode_'+data_mccr_sample[u].ectLab_code); 
                    });
                }
            }
        }); 
        
        $('#mccr_btn_save').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){   
                if (mccr_load_type == 2 && mccr_otable == 'elg') {
                    $('#mccr_funct').val('save_ect_sample_info');
                    if (f_submit_forms('form_mccr,#form_mccr_form', 'p_aotd', 'Data successfully saved.')) {
                        data_mccr_sample = f_get_general_info_multiple('ect_sample_info', {ectRep_no:$('#mccr_ectRep_no').val()}, {}, '', 'ectLab_code');
                        f_dataTable_draw(mccr_otable_sample, data_mccr_sample, 'datatable_mccr_sample', 3);
                    }
                }
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');                 
        }); 
        
        $('#mccr_btn_submit').on('click', function () {
            if (mccr_load_type == 2 && mccr_otable == 'elg' && $('#mccr_wfTaskType_id').val() == '21') {
                var bootstrapValidator = $("#form_mccr_form").data('bootstrapValidator');
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
                            $('#mccr_funct').val('save_ect_sample_info');
                            if (f_submit_forms('form_mccr,#form_mccr_form', 'p_aotd')) {
                                data_mccr_sample = f_get_general_info_multiple('ect_sample_info', {ectRep_no:$('#mccr_ectRep_no').val()}, {}, '', 'ectLab_code');
                                f_dataTable_draw(mccr_otable_sample, data_mccr_sample, 'datatable_mccr_sample', 3);
                                if (f_submit($('#mccr_wfTask_id').val(), $('#mccr_wfTaskType_id').val(), '10', 'Sample Registration successfully submitted.', '', '', '', '', 'ectRep_no', $('#mccr_ectRep_no').val())) {
                                    f_elg_summary();
                                    f_elg_process (elg_summary_id);
                                    $('#modal_eco_certificate').modal('hide');
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
    
    function f_mccr_workbook(lab_code, ectRep_cycle) {
        var ectLab_code = lab_code != null ? lab_code : '-';
        data_mccr_workbook_10 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'1', ectRes_day:'0', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_10, data_mccr_workbook_10, 'datatable_mccr_workbook_10', 6);
        data_mccr_workbook_11 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'1', ectRes_day:'1', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_11, data_mccr_workbook_11, 'datatable_mccr_workbook_11', 6);
        data_mccr_workbook_20 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'2', ectRes_day:'0', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_20, data_mccr_workbook_20, 'datatable_mccr_workbook_20', 6);
        data_mccr_workbook_21 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'2', ectRes_day:'1', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_21, data_mccr_workbook_21, 'datatable_mccr_workbook_21', 6);
        data_mccr_workbook_22 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'2', ectRes_day:'2', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_22, data_mccr_workbook_22, 'datatable_mccr_workbook_22', 6);
        data_mccr_workbook_23 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'2', ectRes_day:'3', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_23, data_mccr_workbook_23, 'datatable_mccr_workbook_23', 6);
        data_mccr_workbook_24 = f_get_general_info_multiple('ect_test_res', {ectLab_code:ectLab_code, ectTest_id:'2', ectRes_day:'4', ectRes_cycle:ectRep_cycle}, {}, '', 'ectRes_tank');
        f_dataTable_draw(mccr_otable_workbook_24, data_mccr_workbook_24, 'datatable_mccr_workbook_24', 6);
    }
    
    function f_mccr_load_certificate(load_type, ectRep_no, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            $('#form_mccr, #form_mccr_form, #form_mccr_workbook').trigger('reset'); 
            $('#form_mccr_form').bootstrapValidator('resetForm', true); 
            $('#form_mccr_workbook').bootstrapValidator('resetForm', true); 
            $('#form_mccr_workbook').find('input, textarea, select').prop('disabled',false);
            mccr_otable = otable;
            mccr_load_type = load_type;
            $('.mccr_viewOnly').prop('disabled',true);
            $('.mccr_editView, .mccr_div_sample, .mccr_div_sampleView, .mccr_div_workbook').hide();
            f_get_general_info('aotd_lab', {lab_id:'ECT'}, 'mccr');
            var cert_info = f_get_general_info('vw_ect_cert', {ectRep_no:ectRep_no}, 'mccr');
            if (cert_info.ectRep_status != '2') {
                $('.mccr_div_sampleView, .mccr_div_workbook').show();
                data_mccr_sampleView = f_get_general_info_multiple('ect_sample_info', {ectRep_no:ectRep_no}, {}, '', 'ectLab_code');
                f_dataTable_draw(mccr_otable_sampleView, data_mccr_sampleView, 'datatable_mccr_sampleView', 4);
                if (data_mccr_sampleView.length > 1) 
                    $('#datatable_mccr_sampleView tbody tr').eq(0).addClass('bg-color-yellow txt-color-white');
                mccr_ectRep_cycle = cert_info.ectRep_cycle;
                f_mccr_workbook(data_mccr_sampleView[0].ectLab_code, mccr_ectRep_cycle);
                $('#mccr_snote_ectLab_results').summernote('code', data_mccr_sampleView[0].ectLab_results);
                $('#mccr_ectLab_results').val(data_mccr_sampleView[0].ectLab_results);
            }
            var task_turn = 1;
            var wf_task;
            if (cert_info.wfTrans_id != null) {
                wf_task = f_get_general_info('wf_task', {wfTrans_id:cert_info.wfTrans_id, wfTask_partition:'1'}, 'mccr');
                var wf_task_type = f_get_general_info('wf_task_type', {wfTaskType_id:wf_task.wfTaskType_id});
                task_turn = wf_task_type.wfTaskType_turn;
            } else {
                if (cert_info.ectRep_status == '4')
                    task_turn = '2';
                else if (cert_info.ectRep_status == '48')
                    task_turn = '3';
                else if (cert_info.ectRep_status == '42')
                    task_turn = '4';
            }
            var arr_steps = f_get_general_info_multiple('wf_task_type', {wfFlow_id:'3'});
            f_steps (arr_steps, task_turn, 'mccr_steps');
            if (wfTask_id != null && mccr_load_type == 2) {
                $('.mccr_editView').show();
                if (mccr_otable == 'elg') {
                    $('.mccr_div_sample').show();
                    data_mccr_sample = f_get_general_info_multiple('ect_sample_info', {ectRep_no:ectRep_no}, {}, '', 'ectLab_code');
                    f_dataTable_draw(mccr_otable_sample, data_mccr_sample, 'datatable_mccr_sample', 3);
                }
            } else if (mccr_load_type == 3) {
                $('#form_mccr_workbook').find('input, textarea, select').prop('disabled',true);
                $('#mccr_snote_ectLab_results').summernote('disable');
            }
            data_mccr_history = f_get_general_info_multiple('dt_task_history', {wfTrans_id:(cert_info.wfTrans_id!=null?cert_info.wfTrans_id:'0')}, '', '', 'wfTask_id');
            f_dataTable_draw(mccr_otable_history, data_mccr_history, 'datatable_mccr_history', 6);
            $('#mccr_wfTask_id').val(wfTask_id);
            $('#modal_eco_certificate').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>    