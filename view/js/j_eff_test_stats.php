<script type="text/javascript">
    
    var arr_field = f_get_general_info_multiple('vw_eff_group');
    get_option_data('ets_srch_test', arr_field, 'effCat_id', 'effCat_name', 'All Evaluation');
          
    $(document).ready(function () {
        
        $('#form_ets_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                ets_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ets_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ets_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ets_srch_year2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ets_srch_day1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ets_srch_day2: {
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