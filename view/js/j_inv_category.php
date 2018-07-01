<?php
    include 'view/js/j_modal_inv_category.php';
?>
<script type="text/javascript">  

    var vct_summary_id = '';
    
    $(document).ready(function () {
        
        pageSetUp();
                
        var datatable_vct = undefined;  
        dataNew = $('#datatable_vct').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [1,'asc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_vct) {
                    datatable_vct = new ResponsiveDatatablesHelper($('#datatable_vct'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_vct.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_vct.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'inventory_type'},
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_mvc_load_inventory_category (2, '+row.inventory_type_id+',\'vct\');" data-toggle="tooltip" data-original-title="Edit inventory type"><i class="fa fa-edit"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_vct thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_vct thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_vct thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_vct_summary();
            f_vct_process (vct_summary_id, 'All Category');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#vct_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_inventory_type', {inventory_type:'%'+$('#vct_srch_name').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.vct_lbl_summary').removeClass('text-bold');
                $('#vct_table_header').html('Category contain \''+$('#vct_srch_name').val()+'\'');
                vct_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
                
    });
            
    function f_vct_process(summary_id, title) {
        datas = f_get_general_info_multiple('dt_inventory_type', {status_id:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.vct_lbl_summary').removeClass('text-bold');
        $('.vct_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#vct_table_header').html(title);
        $('#vct_srch_name').val('');
        vct_summary_id = summary_id;
    }
    
    function f_vct_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_vct_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_vct_summary() {
        $('.lvct_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_inventory_type'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].inventory_type_status, ['1','0']) !== -1) {
                $('#lvct_summary_'+arr_status[u].inventory_type_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lvct_summary_').html(formattedNumber(total));
    }
            
</script>