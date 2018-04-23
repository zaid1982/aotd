<?php 
    include 'view/js/j_modal_lab_edit2.php';
?>
<script type="text/javascript">  

    $(document).ready(function () {

        pageSetUp();  
        
        $('#modal_waiting').on('shown.bs.modal', function(e){
            f_get_general_info('vw_aotd_lab', {lab_id:'BDT'}, 'blm');
            var lab_cost = f_get_value_from_table('bdt_test', 'bdtTest_id', '1', 'bdtTest_price');
            $('#lblm_lab_cost').html('RM '+lab_cost);
            $('#modal_waiting').modal('hide');
            $(this).unbind(e);
        }).modal('show'); 
        
    });    
    
</script>    