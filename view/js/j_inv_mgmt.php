<?php 
    include 'view/js/j_modal_inv.php';
    include 'view/js/j_modal_inv_transaction.php';
?>
<script type="text/javascript">  

    var vmg_summary_id = '';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        get_option('vmg_srchdt_cate', '', 'aotd_inventory_type', 'inventory_type', 'inventory_type', 'inventory_type_status', ' ');
        
        var datatable_vmg = undefined;  
        dataNew = $('#datatable_vmg').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [1,'asc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_vmg) {
                    datatable_vmg = new ResponsiveDatatablesHelper($('#datatable_vmg'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_vmg.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_vmg.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'item_name'},
                    {mData: 'inventory_type'},
                    {mData: 'form'},
                    {mData: 'packing_size'},
                    {mData: 'price'},
                    {mData: 'balance', mRender: function (data, type, row) { return formattedNumber(data)} },
                    {mData: 'min_level'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_mvi_load_inventory (2, '+row.inventory_id+',\'vmg\');" data-toggle="tooltip" data-original-title="Edit Inventory Type"><i class="fa fa-edit"></i></a>';
                            $label += ' <a href="javascript:void(0)" class="btn btn-primary btn-xs" style="width:24px" onclick="f_mvt_load_inventory_trans (1, \'\', '+row.inventory_id+',\'vmg\');" data-toggle="tooltip" data-original-title="Add Purchase / Consume"><i class="fa fa-plus"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_vmg thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_vmg thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_vmg thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_vmg_summary();
            f_vmg_process (vmg_summary_id, 'All Items');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#vmg_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_inventory', {item_name:'%'+$('#vmg_srch_name').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.vmg_lbl_summary').removeClass('text-bold');
                $('#vmg_table_header').html('Item contain \''+$('#vmg_srch_name').val()+'\'');
                vmg_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
                
    });
            
    function f_vmg_process(summary_id, title) {
        datas = f_get_general_info_multiple('dt_inventory', {status_id:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.vmg_lbl_summary').removeClass('text-bold');
        $('.vmg_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#vmg_table_header').html(title);
        $('#vmg_srch_name').val('');
        vmg_summary_id = summary_id;
    }
    
    function f_vmg_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_vmg_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_vmg_summary() {
        $('.lvmg_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_inventory'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].inventory_status, ['1','0']) !== -1) {
                $('#lvmg_summary_'+arr_status[u].inventory_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lvmg_summary_').html(formattedNumber(total));
    }
            
</script>