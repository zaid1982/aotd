<?php
    include 'view/js/j_modal_bio_certificate.php';
    include 'view/js/j_modal_bio_sample_login.php';
?>
<script type="text/javascript">
    
    var blg_summary_id = '2';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#blg_srch_test').select2().val('').trigger('change');
        
        $('#blg_dateReceived').datepicker({
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
        
        var datatable_blg = undefined;  
        dataNew = $('#datatable_blg').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_blg) {
                    datatable_blg = new ResponsiveDatatablesHelper($('#datatable_blg'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_blg.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_blg.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'bdtRep_no'},
                    {mData: 'bdtRep_totalSample'},                    
                    {mData: 'client_organisation'},
                    {mData: 'client_pic'},
                    {mData: 'bdtRep_timeReceived', sClass: 'text-center'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            var load_type = row.wfTask_id != null ? 2 : 3;
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px"  onclick="f_mbcr_load_certificate ('+load_type+', \''+row.bdtRep_no+'\', '+row.wfTask_id+',\'blg\');" data-toggle="tooltip" data-original-title="Certificate Info"><i class="fa fa-certificate"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_blg thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_blg thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_blg thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_blg_summary();
            f_blg_process (blg_summary_id, 'Draft');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#blg_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_bdt_cert_login', {bdtRep_no:'%'+$('#blg_srch_no').val()+'%', client_organisation:'%'+$('#blg_srch_customer').val()+'%', client_pic:'%'+$('#blg_srch_pic').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.blg_lbl_summary').removeClass('text-bold');
                $('#blg_table_header').html('[Searched...]');
                blg_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_blg_process(summary_id, title) {
        blg_summary_id = summary_id;
        datas = f_get_general_info_multiple('dt_bdt_cert_login', {bdtRep_status:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.blg_lbl_summary').removeClass('text-bold');
        $('.blg_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#blg_table_header').html(title);
        $('blg_srch_customer, #blg_srch_pic').val('');
        $('#blg_srch_test').select2().val('').trigger('change');
    }
    
    function f_blg_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_blg_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_blg_summary() {
        $('.lblg_summary').html(0);
        var arr_status = f_get_general_info_multiple('vw_count_bdtCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].bdtRep_status, ['2', '42', '48', '50', '4']) !== -1) {
                $('#lblg_summary_'+arr_status[u].bdtRep_status).html(formattedNumber(arr_status[u].total));
            }
        });
    }

</script>

