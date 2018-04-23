<?php 
    include 'view/js/j_modal_cust_category.php';
?>
<script type="text/javascript">  

    var ccm_summary_id = '';
    
    $(document).ready(function () {
        
        pageSetUp();
                
        var datatable_ccm = undefined;  
        dataNew = $('#datatable_ccm').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [1,'asc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_ccm) {
                    datatable_ccm = new ResponsiveDatatablesHelper($('#datatable_ccm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_ccm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_ccm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'clientGrp_name'},
                    {mData: 'clientType_id',
                        mRender: function (data, type, row) {
                            return data == 'EXT' ? 'External' : 'Internal';
                        }
                    },
                    {mData: 'clientGrp_desc'},
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px"  onclick="f_mcc_load_custCate (2, '+row.clientGrp_id+',\'ccm\');" data-toggle="tooltip" data-original-title="Edit Customer Category"><i class="fa fa-edit"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_ccm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_ccm thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_ccm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_ccm_summary();
            f_ccm_process (ccm_summary_id, 'All Types');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#ccm_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('aotd_client_group', {clientGrp_name:'%'+$('#ccm_srch_name').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.ccm_lbl_summary').removeClass('text-bold');
                $('#ccm_table_header').html('Category Name contain \''+$('#ccm_srch_name').val()+'\'');
                ccm_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
                
    });
            
    function f_ccm_process(summary_id, title) {
        datas = f_get_general_info_multiple('aotd_client_group', {clientType_id:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.ccm_lbl_summary').removeClass('text-bold');
        $('.ccm_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#ccm_table_header').html(title);
        $('#ccm_srch_name').val('');
        ccm_summary_id = summary_id;
    }
    
    function f_ccm_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_ccm_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_ccm_summary() {
        $('.lccm_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_client_group'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].clientType_id, ['INT','EXT']) !== -1) {
                $('#lccm_summary_'+arr_status[u].clientType_id).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lccm_summary_').html(formattedNumber(total));
    }
            
</script>