<script type="text/javascript">
    
    $(document).ready(function () {

        pageSetUp();
        
        $('#form_ssr_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                ssr_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ssr_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ssr_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ssr_srch_year2: {
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