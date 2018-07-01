<?php
    include 'view/js/j_modal_ats_certificate.php';
    include 'view/js/j_modal_ats_sample_login.php';
?>
<script type="text/javascript">
    
    var asm_summary_id = '42';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#asm_srch_test').select2().val('').trigger('change');
        
        $('#asm_dateReceived').datepicker({
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
        
        var datatable_asm = undefined;  
        dataNew = $('#datatable_asm').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_asm) {
                    datatable_asm = new ResponsiveDatatablesHelper($('#datatable_asm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_asm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_asm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'atsCert_no'},
                    {mData: 'atsCert_totalSample'},                    
                    {mData: 'client_organisation'},
                    {mData: 'client_pic'},
                    {mData: 'atsCert_timeReceived', sClass: 'text-center'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px"  onclick="f_macr_load_certificate (3, '+row.atsCert_id+', \'\',\'asm\');" data-toggle="tooltip" data-original-title="Certificate Info"><i class="fa fa-certificate"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_asm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_asm thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_asm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_asm_summary();
            f_asm_process (asm_summary_id, 'Completed Certificate');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#asm_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_no:'%'+$('#asm_srch_no').val()+'%', client_organisation:'%'+$('#asm_srch_customer').val()+'%', client_pic:'%'+$('#asm_srch_pic').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.asm_lbl_summary').removeClass('text-bold');
                $('#asm_table_header').html('[Searched...]');
                asm_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
        $('#asm_btn_scan').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){                
                var ats_sample_info = f_get_general_info('ats_sample_info', {atsLab_barCode:$('#asm_barcode_no').val()});
                datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_id:ats_sample_info.atsCert_id});
                f_dataTable_draw(dataNew, datas);
                $('.asm_lbl_summary').removeClass('text-bold');
                $('#asm_table_header').html('[Scanned = ' + ats_sample_info.atsLab_code + ']');
                asm_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_asm_process(summary_id, title) {
        asm_summary_id = summary_id;
        datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_status:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.asm_lbl_summary').removeClass('text-bold');
        $('.asm_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#asm_table_header').html(title);
        $('asm_srch_customer, #asm_srch_pic').val('');
        $('#asm_srch_test').select2().val('').trigger('change');
    }
    
    function f_asm_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_asm_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_asm_summary() {
        $('.lasm_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_atsCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].atsCert_status, ['42', '48', '49', '4']) !== -1) {
                $('#lasm_summary_'+arr_status[u].atsCert_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lasm_summary_').html(formattedNumber(total));
    }

</script>

