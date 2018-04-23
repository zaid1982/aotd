<script type="text/javascript">
    
    var mpr_otable;
    var mpr_load_type;
    var mpr_otable_history;
    var data_mpr_history;
    var mpr_otable_sample;
    var data_mpr_sample;
    var mpr_otable_sampleView;
    var data_mpr_sampleView;
    var mpr_otable_workbook;
    var data_mpr_workbook = '';
    var mpr_otable_upload;
    var data_mpr_upload;
    
    $(document).ready(function () {
        
    });
        
    function f_mpr_load_certificate(load_type, phyRep_no, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            mpr_otable = otable;
            mpr_load_type = load_type;
            $('.mpr_viewOnly').prop('disabled',true);
            f_get_general_info('aotd_lab', {lab_id:'PHY'}, 'mpr');
            f_get_general_info('vw_aotd_lab', {lab_id:'PHY'}, 'mpr');
            var cert_info = f_get_general_info('vw_phy_cert', {phyRep_no:phyRep_no}, 'mpr');
            if (cert_info.clientType_id == "EXT") {
                $('#phyCover').show();
                $('#phyMemo').show();
            } else {
                $('#phyCover').hide();
                $('#phyMemo').hide();
            }
            $('#mpr_phyRep_cycle').val(cert_info.phyRep_cycle);
            $('#mpr_wfTask_id').val(wfTask_id);
            $('#modal_phy_report').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>    