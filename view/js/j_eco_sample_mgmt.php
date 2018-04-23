<?php
    include 'view/js/j_modal_eco_certificate.php';
    include 'view/js/j_modal_eco_sample_login.php';
?>
<script type="text/javascript">
    
    var esm_summary_id = '42';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#esm_srch_test').select2().val('').trigger('change');
        
        $('#esm_dateReceived').datepicker({
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
        
        var datatable_esm = undefined;  
        dataNew = $('#datatable_esm').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_esm) {
                    datatable_esm = new ResponsiveDatatablesHelper($('#datatable_esm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_esm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_esm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'ectRep_no'},
                    {mData: 'ectRep_totalSample'},                    
                    {mData: 'client_organisation'},
                    {mData: 'client_pic'},
                    {mData: 'ectRep_timeReceived', sClass: 'text-center'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mccr_load_certificate (3, \''+row.ectRep_no+'\', \'\',\'esm\');" data-toggle="tooltip" data-original-title="Certificate Info"><i class="fa fa-certificate"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_esm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_esm thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_esm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_esm_summary();
            f_esm_process (esm_summary_id, 'Completed Certificate');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#esm_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_ect_cert', {ectRep_no:'%'+$('#esm_srch_no').val()+'%', client_organisation:'%'+$('#esm_srch_customer').val()+'%', client_pic:'%'+$('#esm_srch_pic').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.esm_lbl_summary').removeClass('text-bold');
                $('#esm_table_header').html('[Searched...]');
                esm_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_esm_process(summary_id, title) {
        datas = f_get_general_info_multiple('dt_ect_cert', {ectRep_status:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.esm_lbl_summary').removeClass('text-bold');
        $('.esm_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#esm_table_header').html(title);
        $('esm_srch_customer, #esm_srch_pic').val('');
        $('#esm_srch_test').select2().val('').trigger('change');
        esm_summary_id = summary_id;
    }
    
    function f_esm_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_esm_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_esm_summary() {
        $('.lesm_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_ectCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].ectRep_status, ['42', '48', '50', '4']) !== -1) {
                $('#lesm_summary_'+arr_status[u].ectRep_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lesm_summary_').html(formattedNumber(total));
    }

</script>

