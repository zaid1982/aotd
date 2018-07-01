<?php
    include 'view/js/j_modal_ats_certificate.php';
    include 'view/js/j_modal_ats_sample_login.php';
    include 'view/js/j_modal_ats_formula_set.php';
    include 'view/js/j_modal_ats_raw.php';
?>

<script type="text/javascript">
    
    var awb_summary_id = '1';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#awb_dateReceived').datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: '0',
            changeMonth: true,
            changeYear: true,
            maxDate: '0', 
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            showButtonPanel: true,
            closeText:'Clear',
            beforeShow: function( input ) {
		setTimeout(function() {
                    var clearButton = $(input ).datepicker( "widget" ).find( ".ui-datepicker-close" );
                    clearButton.unbind("click").bind("click",function(){$.datepicker._clearDate( input );});
                    }, 1 );
            }
        });
        
        var datatable_awb = undefined;  
        dataNew = $('#datatable_awb').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_awb) {
                    datatable_awb = new ResponsiveDatatablesHelper($('#datatable_awb'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_awb.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_awb.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'atsCert_no'},
                    {mData: 'atsCert_totalSample'},                    
                    {mData: 'client_organisation'},
                    {mData: 'client_pic'},
                    {mData: 'wfTask_timeCreated', sClass: 'text-center'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {  
                            $label = '<a href="javascript:void(0)" class="btn btn-success btn-xs" style="width:24px" onclick="f_macr_load_certificate ('+(awb_summary_id=='1'?2:3)+', '+row.atsCert_id+', '+row.wfTask_id+',\'awb\');" data-toggle="tooltip" data-original-title="Certificate Workbook"><i class="fa fa-columns"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_awb thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_awb thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_awb thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
        
        $('#modal_waiting').on('shown.bs.modal', function(e){
            if (f_check_task_user (2)) {
                f_awb_summary();
                f_awb_process(awb_summary_id, 'Incoming Task');
            }
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#awb_btn_scan').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){                
                f_awb_process(awb_summary_id, '', $('#awb_barcode_no').val());
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_awb_process(summary_id, title, scanned) {
        awb_summary_id = summary_id;
        scanned = typeof scanned === 'undefined' ? '' : scanned;
        var cert_id = '';
        if (scanned != '') {
            var ats_sample_info = f_get_general_info('ats_sample_info', {atsLab_barCode:scanned});
            cert_id = ats_sample_info.atsCert_id;
            title = $('#awb_table_header').text()+' [Scanned = ' + ats_sample_info.atsLab_code + ']';
        } else {
            $('#awb_barcode_no').val('');
        }
        if (summary_id == '1') {
            datas = f_get_general_info_multiple('dt_ats_incoming', {atsCert_id:cert_id}, {wfTaskType_id:'2'});
            f_dataTable_draw(dataNew, datas);
            $(dataNew.columns(5).header()).text('Received Time');
            $(dataNew.columns(6).header()).text('Status');
        } else if (summary_id == '2') {
            datas = f_get_general_info_multiple('dt_ats_outgoing', {atsCert_id:cert_id}, {wfTaskType_id:'2'});
            f_dataTable_draw(dataNew, datas);
            $(dataNew.columns(5).header()).text('Submitted Time');
            $(dataNew.columns(6).header()).text('Action');
        } 
        $('.awb_lbl_summary').removeClass('text-bold');
        $('.awb_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#awb_table_header').html(title);
    }        
    
    function f_awb_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_awb_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_awb_summary() {
        $('.lawb_summary').html(0);
        var arr_status = f_get_general_info_multiple('vw_count_task', {}, {wfTaskType_id:'2'}); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].wfTask_partition, ['1', '2']) !== -1) {
                $('#lawb_summary_'+arr_status[u].wfTask_partition).html(formattedNumber(arr_status[u].total));
            }
        });
    }
    
</script>