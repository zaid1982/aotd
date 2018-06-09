<script type="text/javascript">
    
    var arr_field = f_get_general_info_multiple('vw_phy_test_name');
    get_option_data('pts_srch_test', arr_field, 'phyTest_id', 'phyTest_name', 'All Test');
          
    $(document).ready(function () {
        
        $('#form_pts_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                pts_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                pts_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                pts_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                pts_srch_year2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                pts_srch_day1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                pts_srch_day2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                }
            }
        });

        $('#btn_pts_reset').click(function () {
            $("#form_pts_search").data('bootstrapValidator').resetForm();  
        });

    });

</script>