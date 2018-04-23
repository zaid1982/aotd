<script type="text/javascript">
    
    $(document).ready(function () {

        pageSetUp();
        
        $('#urp_srch_order1').on('change', function () {
            if ($('#urp_srch_order2').val() != '') {
                $('#urp_srch_order1').val($('#urp_srch_order2').val());
                $('#urp_srch_order2').val('');  
                if ($('#urp_srch_order3').val() != '') {
                    $('#urp_srch_order2').val($('#urp_srch_order3').val());
                    $('#urp_srch_order3').val(''); 
                }
            }
        });
        
        $('#urp_srch_order2').on('change', function () {
            if ($('#urp_srch_order1').val() == '') {
                $('#urp_srch_order1').val($('#urp_srch_order2').val());
                $('#urp_srch_order2').val('');
            }
            if ($('#urp_srch_order2').val() == '') {
                if ($('#urp_srch_order3').val() != '') {
                    $('#urp_srch_order2').val($('#urp_srch_order3').val());
                    $('#urp_srch_order3').val('');
                }
            }
            else if ($('#urp_srch_order2').val() == $('#urp_srch_order1').val()) {
                $('#urp_srch_order2').val('');
            }
            else {
                
            }
        });
        
        $('#urp_srch_order3').on('change', function () {
            if ($('#urp_srch_order1').val() == '') {
                $('#urp_srch_order1').val($('#urp_srch_order3').val());
                $('#urp_srch_order3').val('');
            }
            else if ($('#urp_srch_order2').val() == '') {
                $('#urp_srch_order2').val($('#urp_srch_order3').val());
                $('#urp_srch_order3').val('');
            }
            else if ($('#urp_srch_order3').val() == $('#urp_srch_order1').val()) {
                $('#urp_srch_order3').val('');
            }
            else if ($('#urp_srch_order3').val() == $('#urp_srch_order2').val()) {
                $('#urp_srch_order3').val('');
            }
            else {
                
            }
        });

    });

</script>