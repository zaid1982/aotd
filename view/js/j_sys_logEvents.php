<script type="text/javascript"> 
    
    $(document).ready(function () {
        
        pageSetUp();
        
        $('#slg_dateReceived').datepicker({
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
        
        get_option('slg_srchdt_module', '', 'audit_module', 'auditModule_desc', 'auditModule_desc', 'auditModule_id', ' ', 'ref_id');
        get_option('slg_srchdt_action', '', 'audit_action', 'auditAction_desc', 'auditAction_desc', 'auditAction_id', ' ');
        
        var datatable_slg = undefined;  
        dataNew = $('#datatable_slg').DataTable({
            "sDom": "<'dt-toolbar'<'col-sm-12 hidden-xs'l>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [1,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_slg) {
                    datatable_slg = new ResponsiveDatatablesHelper($('#datatable_slg'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_slg.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_slg.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'audit_timestamp'},
                    {mData: 'profile_name'},
                    {mData: 'auditModule_desc'},
                    {mData: 'auditAction_desc'},
                    {mData: 'audit_ip'},
                    {mData: 'audit_place'},
                    {mData: 'audit_transNo'}
                ]
        });
        $("#datatable_slg thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_slg thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_slg thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_slg_process ();
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
    });
    
    function f_slg_process() {
        datas = f_get_general_info_multiple('dt_audit');
        f_dataTable_draw(dataNew, datas);
    }
    
</script>