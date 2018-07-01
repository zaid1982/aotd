<?php 
    include 'view/js/j_modal_lab_edit.php';
    include 'view/js/j_modal_ats_lab_test.php';
    include 'view/js/j_modal_ats_lab_component.php';
?>
<script type="text/javascript">  

    $(document).ready(function () {

        pageSetUp();      
            
        get_option('alm_statusName', '(1,2,41)', 'ref_status', 'status_desc', 'status_desc', 'status_id', ' ');
        
        var datatable_alm = undefined;  var cnt_alm = 1;
        dataNew = $('#datatable_alm').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [2,'asc'],
            "autoWidth": true,
            "pageLength": 50,
            "preDrawCallback": function () {
                if (!datatable_alm) {
                    datatable_alm = new ResponsiveDatatablesHelper($('#datatable_alm'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_alm.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_alm.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'atsTest_id'},
                    {mData: 'atsTest_name'},
                    {mData: 'atsTest_cat'},
                    {mData: 'total_field',
                        mRender: function (data, type, row) {
                            return formattedNumber(data);
                        }
                    },
                    {mData: 'atsTest_cost', sClass: 'text-right',
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
                            $label = '<a href="javascript:void(0)" class="btn btn-info btn-xs" style="width:24px" onclick="f_malt_load_test (3, '+row.atsTest_id+',\'alm\');" data-toggle="tooltip" data-original-title="Test Information"><i class="fa fa-info-circle"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_alm thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_alm thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search(this.selectedOptions[0].text, true, false, false).draw();
        }); 
        
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_get_general_info('vw_aotd_lab', {lab_id:'ATS'}, 'alm');
            f_alm_table_test();
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show'); 
        
    });    
    
    function f_alm_table_test() {
        datas = f_get_general_info_multiple('dt_ats_test', {atsTest_main:'1', atsTest_status:'(1,2,41)'});
        f_dataTable_draw(dataNew, datas);
    }
        
</script>