<script type="text/javascript">
    
    get_option('crp_srch_group', '', 'aotd_client_group', 'clientGrp_id', 'clientGrp_name', 'clientType_id', 'All Categories');
      
    $(document).ready(function () {

        pageSetUp();
        
        $('#crp_srch_order1').on('change', function () {
            if ($('#crp_srch_order2').val() != '') {
                $('#crp_srch_order1').val($('#crp_srch_order2').val());
                $('#crp_srch_order2').val('');  
                if ($('#crp_srch_order3').val() != '') {
                    $('#crp_srch_order2').val($('#crp_srch_order3').val());
                    $('#crp_srch_order3').val(''); 
                }
            }
        });
        
        $('#crp_srch_order2').on('change', function () {
            if ($('#crp_srch_order1').val() == '') {
                $('#crp_srch_order1').val($('#crp_srch_order2').val());
                $('#crp_srch_order2').val('');
            }
            if ($('#crp_srch_order2').val() == '') {
                if ($('#crp_srch_order3').val() != '') {
                    $('#crp_srch_order2').val($('#crp_srch_order3').val());
                    $('#crp_srch_order3').val('');
                }
            }
            else if ($('#crp_srch_order2').val() == $('#crp_srch_order1').val()) {
                $('#crp_srch_order2').val('');
            }
            else {
                
            }
        });
        
        $('#crp_srch_order3').on('change', function () {
            if ($('#crp_srch_order1').val() == '') {
                $('#crp_srch_order1').val($('#crp_srch_order3').val());
                $('#crp_srch_order3').val('');
            }
            else if ($('#crp_srch_order2').val() == '') {
                $('#crp_srch_order2').val($('#crp_srch_order3').val());
                $('#crp_srch_order3').val('');
            }
            else if ($('#crp_srch_order3').val() == $('#crp_srch_order1').val()) {
                $('#crp_srch_order3').val('');
            }
            else if ($('#crp_srch_order3').val() == $('#crp_srch_order2').val()) {
                $('#crp_srch_order3').val('');
            }
            else {
                
            }
        });

    });

</script>