<script type="text/javascript">

    var lmism_otable;
    var lmism_load_type;
    var macr_otable_result;
    var data_macr_result;

    $(document).ready(function () {

        pageSetUp();
        var datatable_macr_result = undefined; 
        macr_otable_result = $('#datatable_macr_result').DataTable( {
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-12'f>>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "aaSorting": [1,'asc'],
            "ordering": false,
            "bDestroy": true,
            "iDisplayLength": 10,
            "preDrawCallback": function () {
                if (!datatable_macr_result) {
                    datatable_macr_result = new ResponsiveDatatablesHelper($('#datatable_macr_result'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow, aData, index) {
                datatable_macr_result.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                datatable_macr_result.respond();
            },
            "columns": [
                {
                    "class":          'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "atsLab_code" },
                { "data": "atsLab_sampleCode" },
                { "data": "atsLab_code", bSortable: false, sClass: 'text-center',
                    mRender: function (data, type, row) {                        
//                        var ids = row.atsLab_id;
//                        var k = '';
//                        for (var j=0;j<(12-ids.length);j++){
//                            k += '0';
//                        }
//                        ids = k+ids;
                        $label = '<button type="button" class="btn btn-primary btn-xs" title="Print Barcode" onclick="getBarCode(\'' + row.atsLab_code + '\',\'' + row.atsLab_barCode + '\')"><span class="glyphicon glyphicon-print"></span></button>';
                        return $label;
                    }
                }
                
            ]
        } );
        
        
    });
    
    function f_load_info_cert_list(load_type, atsCert_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
        $('#form_lmism').trigger('reset');
        $('#form_lmism').bootstrapValidator('resetForm', true);    
        $('#lmism_atsCert_id').val(atsCert_id);
        lmism_otable = otable;
        lmism_load_type = load_type;
        var cert_info = f_get_general_info('vw_ats_cert', {'atsCert_id': atsCert_id}, 'lmism');
         $('#atsCert_no').html(cert_info.atsCert_no);
         $('#atsCert_no1').val(cert_info.atsCert_no);
         $('#lmism_status_desc').html(cert_info.status_desc);
         $('#client_organisation').html(cert_info.client_organisation);
         $('#client_organisation1').val(cert_info.client_organisation);
         $('#client_pic').html(cert_info.client_pic);
         $('#lmism_atsCert_accrediteds').html(cert_info.atsCert_accrediteds);
         $('#lmism_profile_fullname').html(cert_info.profile_fullname);
         $('#lmism_atsCert_equipments').html(cert_info.atsCert_equipments);
         $('#lmism_atsCert_chemicals').html(cert_info.atsCert_chemicals);
         $('#lmism_atsCert_condition').html(cert_info.atsCert_condition);
         $('#lmism_atsCert_remark').html(cert_info.atsCert_remark);
         $('#lmism_atsCert_totalSample').html(cert_info.atsCert_totalSample);
         $('#lmism_atsCert_timeReceived').html(cert_info.atsCert_timeReceived);
         $('#lmism_atsCert_days').html(cert_info.atsCert_days);
         $('#atsCert_timeReported').html(cert_info.atsCert_timeReported);
         var test_info = f_get_general_info ('dt_ats_cert_test', {'atsCert_id': atsCert_id}, 'lmism');
         data_macr_result = f_get_general_info_multiple('ats_sample_info', {atsCert_id:atsCert_id});
         f_dataTable_draw(macr_otable_result, data_macr_result, 'datatable_macr_result', 3);
            $('#modal_icert_list').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
        
        
    }

</script>