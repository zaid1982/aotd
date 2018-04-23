<script type="text/javascript">
    
    var mer_otable;
    var mer_load_type;
    var mer_otable_history;
    var data_mer_history;
    var mer_otable_sample;
    var data_mer_sample;
    var mer_otable_sampleView;
    var data_mer_sampleView;
    var mer_otable_workbook;
    var data_mer_workbook = '';
    var mer_otable_upload;
    var data_mer_upload;
        
    $(document).ready(function () {
        
    });
    
    function f_mer_load_certificate(load_type, effRep_no, wfTask_id, otable) {
        $('#modal_waiting').on('shown.bs.modal', function(e){
            mer_otable = otable;
            mer_load_type = load_type;
            $('.mer_viewOnly').prop('disabled',true);
            f_get_general_info('aotd_lab', {lab_id:'EFF'}, 'mer');
            f_get_general_info('vw_aotd_lab', {lab_id:'EFF'}, 'mer');
            var cert_info = f_get_general_info('vw_eff_cert', {effRep_no:effRep_no}, 'mer');
            if (cert_info.clientType_id == "EXT") {
                $('#effCover').show();
                $('#effMemo').show();
            } else {
                $('#effCover').hide();
                $('#effMemo').hide();
            }
            $('#mer_wfTask_id').val(wfTask_id);
            $('#modal_eff_report').modal('show');
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show');
    }
    
</script>    