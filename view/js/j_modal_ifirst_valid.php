<script type="text/javascript">

    var mism_otable_laboratory;

    $(document).ready(function () {

        pageSetUp();
        $('#form_mcm').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            excluded: ':disabled',
            fields: {
                mez_zone_code: {
                    validators: {
                        notEmpty: {
                            message: 'Sila isikan Kod!!!'
                        },
                        stringLength: {
                            max: 10,
                            message: 'Sila pastikan Kod tidak melebihi 10 huruf!!'
                        }
                    }
                },
                datetimepicker: {
                    todayBtn: 'linked',
                    weekStart: 1
                }
            }
        });

        $("#form_mcm").on('submit', function (event) {
            event.preventDefault();
        });




    });
    function f_mism_edit(edit_type) {
        if (edit_type == 1) {
            $('.mism_editView').show();
            $('.mism_infoView').hide();
            mism_otable_laboratory.columns(3).visible(true);
        } else {
            $('.mism_editView').hide();
            $('.mism_infoView').show();
            mism_otable_laboratory.columns(3).visible(false);
        }
        $('#modal_ifirst_valid').scrollTop(0);
    }
    function f_load_info_first_valid() {
        $('#modal_ifirst_valid').modal('show');
        
    }

</script>