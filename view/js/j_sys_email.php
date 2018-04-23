<?php 
    include 'view/js/j_modal_email_noti.php';
?>
<script type="text/javascript"> 
    
    $(document).ready(function () {
        
        pageSetUp();
        
        var datatable_smc = undefined;  
        dataNew = $('#datatable_smc').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",            
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_smc) {
                    datatable_smc = new ResponsiveDatatablesHelper($('#datatable_smc'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_smc.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_smc.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'emailType_desc'},
                    {mData: 'emailType_title'},
                    {mData: 'emailType_text'},
                    {mData: 'emailType_status', sClass: 'text-center',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+(data=='1'?'green':'red')+'"> '+(data=='1'?'Active':'Inactive')+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_mmc_load_email (2, '+row.emailType_id+',\'smc\');" data-toggle="tooltip" data-original-title="Edit email description"><i class="fa fa-edit"></i></a>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_smc thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_smc thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_smc thead th select").on('change', function () {
            if (this.value == '' || $(this).parent().index() == 4)
                dataNew.column($(this).parent().index() + ':visible').search(this.value, false, true, false).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_smc_process ();
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
    });
    
    function f_smc_process() {
        datas = f_get_general_info_multiple('email_type');
        f_dataTable_draw(dataNew, datas);
    }
    
</script>