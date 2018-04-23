<?php 
    include 'view/js/j_modal_lab_edit.php';
    include 'view/js/j_modal_eff_cat.php';
    include 'view/js/j_modal_eff_test.php';
    include 'view/js/j_modal_eff_field.php';
?>
<script type="text/javascript">  

    $(document).ready(function () {

        pageSetUp();      
            
        get_option('flm_statusName', '(1,2,41)', 'ref_status', 'status_desc', 'status_desc', 'status_id', ' ');
        get_option('flm_category', '', 'eff_cat', 'effCat_filter', 'effCat_name', 'effCat_status', ' ');
        
        var datatable_flm = undefined;  var cnt_flm = 1;
        dataNew = $('#datatable_flm').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [2,'asc'],
            "autoWidth": true,
            "pageLength": 50,
            "preDrawCallback": function () {
                if (!datatable_flm) {
                    datatable_flm = new ResponsiveDatatablesHelper($('#datatable_flm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_flm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_flm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'effTest_id'},
                    {mData: 'effTest_name'},
                    {mData: 'effCat_name'},
                    {mData: 'field_list'},
                    {mData: 'effTest_cost', sClass: 'text-right',
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
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_mflt_load_test (3, '+row.effTest_id+',\'flm\');" data-toggle="tooltip" data-original-title="Test Information"><i class="fa fa-info-circle"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_flm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_flm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search(this.value, true, false, false).draw();
        }); 
        
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_get_general_info('vw_aotd_lab', {lab_id:'EFF'}, 'flm');
            f_flm_table_test();
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show'); 
        
    });    
    
    function f_flm_table_test() {
        datas = f_get_general_info_multiple('dt_eff_test', {effTest_status:'(1,2,41)'});
        f_dataTable_draw(dataNew, datas);
    }
        
</script>