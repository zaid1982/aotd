<?php
    include 'view/js/j_modal_phy_certificate.php';
    include 'view/js/j_modal_phy_sample_login.php';
?>
<script type="text/javascript">
    
    var psm_summary_id = '42';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#psm_srch_test').select2().val('').trigger('change');
        
        $('#psm_dateReceived').datepicker({
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
        
        var datatable_psm = undefined;  
        dataNew = $('#datatable_psm').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_psm) {
                    datatable_psm = new ResponsiveDatatablesHelper($('#datatable_psm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_psm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_psm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'phyRep_no'},
                    {mData: 'phyRep_totalSample'},                    
                    {mData: 'client_organisation'},
                    {mData: 'client_pic'},
                    {mData: 'phyRep_timeReceived', sClass: 'text-center'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px"  onclick="f_mpcr_load_certificate (3, \''+row.phyRep_no+'\', \'\',\'psm\');" data-toggle="tooltip" data-original-title="Certificate Info"><i class="fa fa-certificate"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_psm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_psm thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_psm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_psm_summary();
            f_psm_process (psm_summary_id, 'Completed Certificate');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#psm_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_phy_cert', {phyRep_no:'%'+$('#psm_srch_no').val()+'%', client_organisation:'%'+$('#psm_srch_customer').val()+'%', client_pic:'%'+$('#psm_srch_pic').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.psm_lbl_summary').removeClass('text-bold');
                $('#psm_table_header').html('[Searched...]');
                psm_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_psm_process(summary_id, title) {
        datas = f_get_general_info_multiple('dt_phy_cert', {phyRep_status:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.psm_lbl_summary').removeClass('text-bold');
        $('.psm_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#psm_table_header').html(title);
        $('psm_srch_customer, #psm_srch_pic').val('');
        $('#psm_srch_test').select2().val('').trigger('change');
        psm_summary_id = summary_id;
    }
    
    function f_psm_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_psm_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_psm_summary() {
        $('.lpsm_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_phyCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].phyRep_status, ['42', '48', '49', '4']) !== -1) {
                $('#lpsm_summary_'+arr_status[u].phyRep_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lpsm_summary_').html(formattedNumber(total));
    }

</script>

