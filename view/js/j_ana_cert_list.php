<?php
    include 'view/js/j_modal_ats_certificate.php';
    include 'view/js/j_modal_ats_sample_login.php';
    include 'view/js/j_modal_ana_cert.php';
?>
<script type="text/javascript">
    
    var acl_summary_id = '42';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#acl_srch_test').select2().val('').trigger('change');
        
        $('#acl_dateReceived').datepicker({
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
        
        var datatable_acl = undefined;  
        dataNew = $('#datatable_acl').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_acl) {
                    datatable_acl = new ResponsiveDatatablesHelper($('#datatable_acl'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_acl.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_acl.respond();
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
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            // $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px"  onclick="f_macr_load_certificate (3, '+row.atsCert_id+', \'\',\'acl\');" data-toggle="tooltip" data-original-title="Certificate Info"><i class="fa fa-certificate"></i></a>';
                            // $label = '<button type="button" class="btn btn-info btn-xs" id="" title="Detail First Validation" onclick="f_load_info_cert_list (1, ' + row.atsCert_id + ',\'lmism\');"><i class="fa fa-certificate"></i></button>';
                            $label = '<button type="button" class="btn btn-info btn-xs" id="" title="Detail" onclick="f_macl_load_certificate (3, \''+row.atsCert_id+'\', \'\',\'acl\');"><i class="fa fa-certificate"></i></button>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_acl thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_acl thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_acl thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_acl_summary();
            f_acl_process (acl_summary_id, 'Completed Certificate');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#acl_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_no:'%'+$('#acl_srch_no').val()+'%', client_organisation:'%'+$('#acl_srch_customer').val()+'%', client_pic:'%'+$('#acl_srch_pic').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.acl_lbl_summary').removeClass('text-bold');
                $('#acl_table_header').html('[Searched...]');
                acl_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
        $('#acl_btn_scan').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){                
                var ats_sample_info = f_get_general_info('ats_sample_info', {atsLab_barCode:$('#acl_barcode_no').val()});
                datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_id:ats_sample_info.atsCert_id});
                f_dataTable_draw(dataNew, datas);
                $('.acl_lbl_summary').removeClass('text-bold');
                $('#acl_table_header').html('[Scanned = ' + ats_sample_info.atsLab_code + ']');
                acl_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_acl_process(summary_id, title) {
        acl_summary_id = summary_id;
        datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_status:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.acl_lbl_summary').removeClass('text-bold');
        $('.acl_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#acl_table_header').html(title);
        $('acl_srch_customer, #acl_srch_pic').val('');
        $('#acl_srch_test').select2().val('').trigger('change');
    }
    
    function f_acl_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_acl_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_acl_summary() {
        $('.lacl_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_atsCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].atsCert_status, ['42', '48', '49', '4']) !== -1) {
                $('#lacl_summary_'+arr_status[u].atsCert_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lacl_summary_').html(formattedNumber(total));
    }

</script>

