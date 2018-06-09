<script type="text/javascript">

    var macl_otable;
    var macl_load_type;
    var macl_otable_history;
    var data_macl_history;
    var macl_otable_sample;
    var data_macl_sample;
    var macl_otable_sampleView;
    var data_macl_sampleView;
    var macl_otable_workbook;
    var data_macl_workbook = '';
    var macl_otable_upload;
    var data_macl_upload;
        
    $(document).ready(function () {
        
    });
    
    function f_macl_load_certificate(load_type, atsCert_id, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            macl_otable = otable;
            macl_load_type = load_type;
            $('.macl_viewOnly').prop('disabled',true);
            f_get_general_info('aotd_lab', {lab_id:'ATS'}, 'macl');
            f_get_general_info('vw_aotd_lab', {lab_id:'ATS'}, 'macl');
            var cert_info = f_get_general_info('vw_ats_cert', {atsCert_id:atsCert_id}, 'macl');
            if (cert_info.clientType_id == "EXT") {
                $('#anaCover').show();
                $('#anaMemo').show();
            } else {
                $('#anaCover').hide();
                $('#anaMemo').hide();
            }
            $('#atsCert_no1').val(cert_info.atsCert_no);
            $('#client_organisation1').val(cert_info.client_organisation);
            $('#macl_wfTask_id').val(wfTask_id);
            $('#modal_ana_cert').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    

</script>