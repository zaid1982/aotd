<?php
    include 'view/js/j_modal_customer.php';
?>
<script type="text/javascript">
    
    var cmg_summary_id = '';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        get_option('cmg_srchdt_group', '', 'aotd_client_group', 'clientGrp_name', 'clientGrp_name', 'clientGrp_id', ' ');
        get_option('cmg_srch_group', '', 'aotd_client_group', 'clientGrp_id', 'clientGrp_name', 'clientGrp_id', 'All Category');
        $('#cmg_srch_group').select2().val('').trigger('change');
        
        var datatable_cmg = undefined;  
        dataNew = $('#datatable_cmg').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [1,'asc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_cmg) {
                    datatable_cmg = new ResponsiveDatatablesHelper($('#datatable_cmg'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_cmg.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_cmg.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'client_organisation'},
                    {mData: 'clientGrp_name'},
                    {mData: 'clientType_id',
                        mRender: function (data, type, row) {
                            return data == 'EXT' ? 'External' : 'Internal';
                        }
                    },
                    {mData: 'client_pic'},
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px"  onclick="f_mcu_load_customer (2, '+row.client_id+',\'cmg\');" data-toggle="tooltip" data-original-title="Edit Customer"><i class="fa fa-edit"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_cmg thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_cmg thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_cmg thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_cmg_summary();
            f_cmg_process (cmg_summary_id, 'All Types');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#cmg_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('vw_client_info', {client_organisation:'%'+$('#cmg_srch_customer').val()+'%', client_pic:'%'+$('#cmg_srch_pic').val()+'%', clientGrp_id:$('#cmg_srch_group').val()});
                f_dataTable_draw(dataNew, datas);
                $('.cmg_lbl_summary').removeClass('text-bold');
                $('#cmg_table_header').html('[Searched...]');
                cmg_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
        
    });
    
    function f_cmg_process(summary_id, title) {
        datas = f_get_general_info_multiple('vw_client_info', {clientType_id:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.cmg_lbl_summary').removeClass('text-bold');
        $('.cmg_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#cmg_table_header').html(title);
        $('#cmg_srch_customer, #cmg_srch_pic').val('');
        $('#cmg_srch_group').select2().val('').trigger('change');
        cmg_summary_id = summary_id;
    }
    
    function f_cmg_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_cmg_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_cmg_summary() {
        $('.lcmg_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_client_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].clientType_id, ['INT','EXT']) !== -1) {
                $('#lcmg_summary_'+arr_status[u].clientType_id).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lcmg_summary_').html(formattedNumber(total));
    }

</script>

