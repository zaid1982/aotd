<?
include 'view/js/j_modal_icert_list.php';
?>
<script type="text/javascript">
    var acl_summary_id = '42';
    
    $(document).ready(function () {
        var datatable_acl = undefined; var cnt_acl = 1;
        dataNew = $('#datatable_acl').DataTable({

           "sDom": "<'dt-toolbar'<'col-sm-5 hidden-xs'l><'col-sm-7 col-xs-12'CT>r>" + "t" +
                    "<'dt-toolbar-footer'<'col-xs-5'i><'col-xs-7'p>>",
            "autoWidth": true,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "preDrawCallback": function () {
                if (!datatable_acl) {
                    datatable_acl = new ResponsiveDatatablesHelper($('#datatable_acl'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_acl.createExpandIcon(nRow);
                var info = dataNew.page.info();
                $('td', nRow).eq(0).html(info.page * info.length + (index + 1));
            },
            "drawCallback": function (oSettings) {
                datatable_acl.respond();
            },
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "sTitle": "iRemote_xls",
                        "sPdfMessage": "iRemote Excel Export",
                        "sPdfSize": "letter",
                        "fnCellRender": function ( sValue, iColumn, nTr, iDataIndex ) {
                            if (datas.length < cnt_acl)
                                cnt_acl = 1;
                            if ( iColumn === 0 )
                                return cnt_acl++;
                            else if ( iColumn === 9 )
                                return '';
                            return sValue;
                        }
                    },
                    {
                        "sExtends": "pdf",
                        "sTitle": "iRemote_pdf",
                        "sPdfMessage": "iRemote PDF Export",
                        "sPdfSize": "letter",
                        "fnCellRender": function ( sValue, iColumn, nTr, iDataIndex ) {                            
                            if (datas.length < cnt_acl)
                                cnt_acl = 1;
                            if ( iColumn === 0 )
                                return cnt_acl++;
                            else if ( iColumn === 9 )
                                return '';
                            return sValue;
                        }
                    },
                    {
                        "sExtends": "print",
                        "sTitle": "iRemote_print",
                        "sMessage": "iRemote System"
                    }
                ],
                "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "aoColumns":
                    [
                        {mData: null, bSortable: false, sClass: 'text-center'},
                        {mData: 'atsCert_no', sClass: 'text-center'},
                        {mData: 'atsCert_totalSample'},
                        {mData: 'client_organisation'},
                        {mData: 'client_pic'},
                        {mData: 'atsCert_timeReceived'},
                        {mData: 'null', bSortable: false, sClass: 'text-center',
                            mRender: function (data, type, row) {
                                $label = '<button type="button" class=".btn btn-info btn-xs" id="" title="Detail First Validation" onclick="f_load_info_cert_list (1, ' + row.atsCert_id + ',\'lmism\');"><i class="fa fa-info-circle"></i></button>';
//                                $label += ' <button type="button" class=".btn btn-warning btn-xs" id="" title="View" onclick="f_load_inspection_report_1 (1,\'tnm\');"><i class="fa fa-info-circle"></i></button>';
//                                $label += ' <button type="button" class=".btn btn-danger btn-xs" id="" title="Delete" onclick="f_load_ (1,\'tnm\');"><i class="fa fa-trash-o"></i></button>';
                               return $label;
                            }
                        }
                    ]
        });
        //filter
        $('#acl_certificate_no').on('keyup', function () {
            dataNew.column('1:visible').search(this.value).draw();
        });
        $('#acl_sample_no').on('keyup', function () {
            dataNew.column('2:visible').search(this.value).draw();
        });
        $('#acl_cust_name').on('keyup', function () {
            dataNew.column('3:visible').search(this.value).draw();
        });
        $('#acl_attention').on('keyup', function () {
            dataNew.column('4:visible').search(this.value).draw();
        });
        $('#acl_date').on('keyup', function () {
            dataNew.column('5:visible').search(this.value).draw();
        });
        
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_acl_summary();
            f_acl_process (acl_summary_id, 'Completed Certificate');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
//        datas = [{data1:'QEA/ATS/INT/NAC/120-17', data2:'3', data3:'CHUA SIAW KIM', data4:'Ms. Chua Siaw Kim', data5:'2017/7/20'},
//                 {data1:'QEA/ATS/INT/NAC/119-17', data2:'12', data3:'CHUA SIAW KIM', data4:'Ms. Chua Siaw Kim', data5:'2017/7/14'},
//                 {data1:'QEA/ATS/EXT/NAC/106-17', data2:'1', data3:'Kilang Makanan Mamee Sdn Bhd', data4:'Ms Siti Hanim Binti Naim', data5:'2017/7/11'},
//                 {data1:'QEA/ATS/INT/NAC/105-17', data2:'4', data3:'Pejabat Pelabuhan Pasir Gudang', data4:'Tn. Haji Zulkarnaen Ahmad', data5:'2017/7/10'},
//                 {data1:'QEA/ATS/INT/NAC/104-17', data2:'2', data3:'Hong Seng Soi', data4:'Dr. Hong Seng Soi', data5:'2017/6/19'},
//                 {data1:'QEA/ATS/EXT/NAC/100-17', data2:'1', data3:'Kilang Makanan Mamee Sdn Bhd', data4:'Ms Siti Hanim Binti Naim', data5:'2017/6/7'}];
//                 
//        f_dataTable_draw(dataNew, datas, 'datatable_acl', 7);
        
    });
    
    function f_acl_process(summary_id, title) {
        acl_summary_id = summary_id;
        datas = f_get_general_info_multiple('dt_ats_cert', {atsCert_status:summary_id});
        f_dataTable_draw(dataNew, datas);
    }
    
    function f_acl_summary() {
        $('.lacl_summary').html(0);
        var total = 0;
        var arr_status = f_get_general_info_multiple('vw_count_atsCert_info'); 
        $.each(arr_status, function(u){
            if (jQuery.inArray(arr_status[u].atsCert_status, ['42']) !== -1) {
                $('#lacl_summary_'+arr_status[u].aclCert_status).html(formattedNumber(arr_status[u].total));
                total += parseInt(arr_status[u].total);
            }
        });
        $('#lacl_summary_').html(formattedNumber(total));
    }
</script>

