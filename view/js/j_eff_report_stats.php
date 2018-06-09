<script type="text/javascript">
    
    $(document).ready(function () {

        $('#btn_ers_reset').click(function () {
            $("#form_ers_search").data('bootstrapValidator').resetForm();  
        });
        
        $('#form_ers_search').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                ers_srch_month1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ers_srch_month2: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ers_srch_year1: {
                    validators: {
                        notEmpty: {
                            message: '  '
                        }
                    }
                },
                ers_srch_year2: {
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