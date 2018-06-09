<script type="text/javascript">
    
    $(document).ready(function () {

        $('#btn_issr_reset').click(function () {
            $("#form_issr_search").data('bootstrapValidator').resetForm();  
        });
        
        $('#form_issr_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                issr_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                issr_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                issr_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                issr_srch_year2: {
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