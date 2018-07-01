<?php
    include 'view/js/j_modal_eff_certificate.php';
    include 'view/js/j_modal_eff_sample_login.php';
?>
<script type="text/javascript">
    
    var flg_summary_id = '2';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#flg_srch_test').select2().val('').trigger('change');
        
        $('#flg_dateReceived').datepicker({
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
        
        var datatable_flg = undefined;  
        dataNew = $('#datatable_flg').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_flg) {
                    datatable_flg = new ResponsiveDatatablesHelper($('#datatable_flg'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_flg.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_flg.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'effRep_no'},
                    {mData: 'effRep_totalSample'},                    
                    {mData: 'client_organisation'},
                    {mData: 'client_pic'},
                    {mData: 'effRep_timeReceived', sClass: 'text-center'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            var load_type = row.wfTask_id != null ? 2 : 3;
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px"  onclick="f_mfcr_load_certificate ('+load_type+', \''+row.effRep_no+'\', '+row.wfTask_id+',\'flg\');" data-toggle="tooltip" data-original-title="Certificate Info"><i class="fa fa-certificate"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_flg thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_flg thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_flg thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_flg_summary();
            f_flg_process (flg_summary_id, 'Draft');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#flg_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_eff_cert_login', {effRep_no:'%'+$('#flg_srch_no').val()+'%', client_organisation:'%'+$('#flg_srch_customer').val()+'%', client_pic:'%'+$('#flg_srch_pic').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.flg_lbl_summary').removeClass('text-bold');
                $('#flg_table_header').html('[Searched...]');
                flg_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_flg_process(summary_id, title) {
        flg_summary_id = summary_id;
        datas = f_get_general_info_multiple('dt_eff_cert_login', {effRep_status:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.flg_lbl_summary').removeClass('text-bold');
        $('.flg_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#flg_table_header').html(title);
        $('flg_srch_customer, #flg_srch_pic').val('');
        $('#flg_srch_test').select2().val('').trigger('change');
    }
    
    function f_flg_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_flg_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_flg_summary() {
        $('.lflg_summary').html(0);
        var arr_status = f_get_general_info_multiple('vw_count_effCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].effRep_status, ['2', '42', '48', '49', '51', '4']) !== -1) {
                $('#lflg_summary_'+arr_status[u].effRep_status).html(formattedNumber(arr_status[u].total));
            }
        });
    }

</script>

