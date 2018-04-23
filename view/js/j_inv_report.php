<script type="text/javascript">
    
    get_option('itr_srch_usrnme', '', 'user', 'user_id', 'user_name', 'user_id', 'All Users');
    get_option('itr_srch_category', '', 'aotd_inventory_type', 'inventory_type_id', 'inventory_type', 'inventory_type_id', 'All Inventory Categories');
    get_option('itr_srch_item', '', 'aotd_inventory', 'inventory_id', 'item_name', 'inventory_id', 'All Items');
      
    $(document).ready(function () {

        pageSetUp();
        $('#form_itr_search').bootstrapValidator({
            excluded: ':disabled', 
            fields: {
                itr_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                itr_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                itr_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                itr_srch_year2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                itr_srch_day1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                itr_srch_day2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                }
            }
        });
        
        $('#itr_srch_order1').on('change', function () {
            if ($('#itr_srch_order2').val() != '') {
                $('#itr_srch_order1').val($('#itr_srch_order2').val());
                $('#itr_srch_order2').val('');  
                if ($('#itr_srch_order3').val() != '') {
                    $('#itr_srch_order2').val($('#itr_srch_order3').val());
                    $('#itr_srch_order3').val(''); 
                }
            }
        });
        
        $('#itr_srch_order2').on('change', function () {
            if ($('#itr_srch_order1').val() == '') {
                $('#itr_srch_order1').val($('#itr_srch_order2').val());
                $('#itr_srch_order2').val('');
            }
            if ($('#itr_srch_order2').val() == '') {
                if ($('#itr_srch_order3').val() != '') {
                    $('#itr_srch_order2').val($('#itr_srch_order3').val());
                    $('#itr_srch_order3').val('');
                }
            }
            else if ($('#itr_srch_order2').val() == $('#itr_srch_order1').val()) {
                $('#itr_srch_order2').val('');
            }
            else {
                
            }
        });
        
        $('#itr_srch_order3').on('change', function () {
            if ($('#itr_srch_order1').val() == '') {
                $('#itr_srch_order1').val($('#itr_srch_order3').val());
                $('#itr_srch_order3').val('');
            }
            else if ($('#itr_srch_order2').val() == '') {
                $('#itr_srch_order2').val($('#itr_srch_order3').val());
                $('#itr_srch_order3').val('');
            }
            else if ($('#itr_srch_order3').val() == $('#itr_srch_order1').val()) {
                $('#itr_srch_order3').val('');
            }
            else if ($('#itr_srch_order3').val() == $('#itr_srch_order2').val()) {
                $('#itr_srch_order3').val('');
            }
            else {
                
            }
        });

    });

</script>