<script type="text/javascript">
    
    $(document).ready(function () {
        
        $('#form_prs_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                prs_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                prs_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                prs_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                prs_srch_year2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                }
            }
        });

        $('#btn_prs_reset').click(function () {
            $("#form_prs_search").data('bootstrapValidator').resetForm();  
        });

    });

</script>