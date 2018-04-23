<?php 
    include 'view/js/j_modal_inv.php';
    include 'view/js/j_modal_inv_transaction.php';
?>
<script type="text/javascript">  

    var vtr_summary_id = '';
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#vtr_dateReceived').datepicker({
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
        
        get_option('vtr_srchdt_cate', '', 'aotd_inventory_type', 'inventory_type', 'inventory_type', 'inventory_type_status', ' ');
        get_option('vtr_srch_cate', '', 'aotd_inventory_type', 'inventory_type', 'inventory_type', 'inventory_type_status', 'All Category');
        $('#vtr_srch_cate').select2().val('').trigger('change');
        
        var datatable_vtr = undefined;  
        dataNew = $('#datatable_vtr').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [5,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_vtr) {
                    datatable_vtr = new ResponsiveDatatablesHelper($('#datatable_vtr'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_vtr.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_vtr.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'transaction_no'},
                    {mData: 'item_name'},
                    {mData: 'inventory_type'},
                    {mData: 'transaction_type', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+(data=='2'?'red':'green')+'"> '+(data=='2'?'Consumed':'Purchased')+' </b>';
                        }
                    },
                    {mData: 'date_trans', sClass: 'text-center'},
                    {mData: 'total_stock'},
                    {mData: null, 
                        mRender: function (data, type, row) {
                            return row.transaction_type=='2'?row.quantity_taken:row.stock_purchased;
                        }
                    },
                    {mData: 'balance'},
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mvt_load_inventory_trans (3, '+row.transaction_id+', \'\', \'vtr\');" data-toggle="tooltip" data-original-title="Inventory Transaction Information"><i class="fa fa-info"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_vtr thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_vtr thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_vtr thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_vtr_summary();
            f_vtr_process (vtr_summary_id, 'All Items');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#vtr_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_inventory_transaction', {transaction_no:'%'+$('#vtr_srch_no').val()+'%', item_name:'%'+$('#vtr_srch_item').val()+'%', inventory_type:$('#vtr_srch_cate').val()});
                f_dataTable_draw(dataNew, datas);
                $('.vtr_lbl_summary').removeClass('text-bold');
                $('#vtr_table_header').html('[Searched...]');
                vtr_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
                
    });
            
    function f_vtr_process(summary_id, title) {
        datas = f_get_general_info_multiple('dt_inventory_transaction', {transaction_type:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.vtr_lbl_summary').removeClass('text-bold');
        $('.vtr_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#vtr_table_header').html(title);
        $('#vtr_srch_no, #vtr_srch_item').val('');
        $('#vtr_srch_cate').select2().val('').trigger('change');
        vtr_summary_id = summary_id;
    }
    
    function f_vtr_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_vtr_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_vtr_summary() {
        $('.lvtr_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_inventory_transaction'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].transaction_type, ['1','2']) !== -1) {
                $('#lvtr_summary_'+arr_status[u].transaction_type).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lvtr_summary_').html(formattedNumber(total));
    }
            
</script>