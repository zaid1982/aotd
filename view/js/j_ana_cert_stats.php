<script type="text/javascript">
    
    $(document).ready(function () {

        $('#btn_csr_reset').click(function () {
            $("#form_csr_search").data('bootstrapValidator').resetForm();  
        });
        
        $('#form_csr_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                csr_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                csr_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                csr_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                csr_srch_year2: {
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