<?php 
    include 'view/js/j_modal_lab_edit.php';
    include 'view/js/j_modal_phy_test.php';
    include 'view/js/j_modal_phy_field.php';
?>
<script type="text/javascript">  

    $(document).ready(function () {

        pageSetUp();      
            
        get_option('plm_statusName', '(1,2,41)', 'ref_status', 'status_desc', 'status_desc', 'status_id', ' ');
        
        var datatable_plm = undefined;  
        dataNew = $('#datatable_plm').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [2,'asc'],
            "autoWidth": true,
            "pageLength": 50,
            "preDrawCallback": function () {
                if (!datatable_plm) {
                    datatable_plm = new ResponsiveDatatablesHelper($('#datatable_plm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_plm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_plm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'phyTest_id'},
                    {mData: 'phyTest_name'},
                    {mData: 'phyTest_parameters'},
                    {mData: 'phyTest_cat'},
                    {mData: 'phyTest_equipment'},
                    {mData: 'field_list'},
                    {mData: 'phyTest_cost', sClass: 'text-right',
                        mRender: function (data, type, row) {
                            return formattedNumber(data, 2);
                        }
                    },
                    {mData: 'status_desc', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mplt_load_test (3, '+row.phyTest_id+',\'plm\');" data-toggle="tooltip" data-original-title="Test Information"><i class="fa fa-info-circle"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_plm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_plm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search(this.value, true, false, false).draw();
        }); 
        
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_get_general_info('vw_aotd_lab', {lab_id:'PHY'}, 'plm');
            f_plm_table_test();
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show'); 
        
    });    
    
    function f_plm_table_test() {
        datas = f_get_general_info_multiple('dt_phy_test', {phyTest_status:'(1,2,41)'});
        f_dataTable_draw(dataNew, datas);
    }
        
</script>