<script type="text/javascript">
    
    var arr_field = f_get_general_info_multiple('vw_test_name');
    get_option_data('tsr_srch_test', arr_field, 'atsTest_id', 'atsTest_name', 'All Test');
          
    $(document).ready(function () {
        
        $('#form_tsr_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                tsr_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                tsr_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                tsr_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                tsr_srch_year2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                tsr_srch_day1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                tsr_srch_day2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                }
            }
        });

    });

</script>