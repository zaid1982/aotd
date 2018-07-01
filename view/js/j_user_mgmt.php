<script type="text/javascript">  

    var umg_summary_id = '';
    
    $(document).ready(function () {
        
        pageSetUp();
                
        var datatable_umg = undefined;  
        dataNew = $('#datatable_umg').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-5 hidden-xs'l><'col-xs-7'p>>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "aaSorting": [6,'desc'],
            "autoWidth": true,
            "preDrawCallback": function () {
                if (!datatable_umg) {
                    datatable_umg = new ResponsiveDatatablesHelper($('#datatable_umg'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_umg.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_umg.respond();
                $('[data-toggle="tooltip"]').tooltip({ placement: 'left', container: 'body', html: true });
            },
            "aoColumns":
                [
                    {mData: null, bSortable: false},
                    {mData: 'user_name'},
                    {mData: 'combine_name'},
                    {mData: 'profile_designation'},
                    {mData: 'wfGroup_names'},
                    {mData: 'role_list'},
                    {mData: 'status_desc',
                        mRender: function (data, type, row) {
                            return '<b class="label bg-color-'+row.status_color+'"> '+data+' </b>';
                        }
                    },
                    {mData: null, bSortable: false, sClass: 'text-center',
                        mRender: function (data, type, row) {
                            $label = '<a href="javascript:void(0)" class="btn btn-warning btn-xs" style="width:24px" onclick="f_mus_load_user (2, '+row.user_ids+',\'umg\');" data-toggle="tooltip" data-original-title="Edit user profile"><i class="fa fa-edit"></i></a>';
//                            $label += ' <button type="button" class="btn btn-danger btn-xs" id="umg_btn_password" title="Reset Password" onclick="f_reset_password ('+row.user_id+');"><i class="fa fa-key"></i></button>';
                            return $label;
                        }
                    }
                ]
        });
        $("#datatable_umg thead th input[type=text]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
        });
        $("#datatable_umg thead th input[type=number]").on('keyup change', function () {
            dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        });
        $("#datatable_umg thead th select").on('change', function () {
            if (this.value == '')
                dataNew.column($(this).parent().index() + ':visible').search(this.value).draw();
            else
                dataNew.column($(this).parent().index() + ':visible').search('^'+this.value+'$', true, false, true).draw();
        }); 
          
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_umg_summary();
            f_umg_process (umg_summary_id, 'All Users');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        $('#umg_btn_search').on('click', function () {
            $('#modal_waiting').on('shown.bs.modal', function(e){
                datas = f_get_general_info_multiple('dt_user_mgmt', {combine_name:'%'+$('#umg_srch_name').val()+'%'});
                f_dataTable_draw(dataNew, datas);
                $('.umg_lbl_summary').removeClass('text-bold');
                $('#umg_table_header').html('Name contain \''+$('#umg_srch_name').val()+'\'');
                umg_summary_id = '';
                $('#modal_waiting').modal('hide');
                $(this).unbind(e);
            }).modal('show');
        });
                
    });
            
    function f_umg_process(summary_id, title) {
        datas = f_get_general_info_multiple('dt_user_mgmt', {status_id:summary_id});
        f_dataTable_draw(dataNew, datas);
        $('.umg_lbl_summary').removeClass('text-bold');
        $('.umg_lbl_summary_'+summary_id).addClass('text-bold');
        if (typeof title !== 'undefined')
            $('#umg_table_header').html(title);
        $('#umg_srch_name').val('');
        umg_summary_id = summary_id;
    }
    
    function f_umg_summary_click(summary_id, title) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_umg_process (summary_id, title);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
    function f_umg_summary() {
        $('.lumg_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_user'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].user_status, ['1','0']) !== -1) {
                $('#lumg_summary_'+arr_status[u].user_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lumg_summary_').html(formattedNumber(total));
    }
            
</script>