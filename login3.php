<?php
session_start();
session_unset();
session_destroy();
$activation_code = isset($_GET['activationCode']) ? $_GET['activationCode'] : '';
?>
<style>* {
        margin:0;
        padding:0;
        font-family: 'Source Sans Pro', sans-serif;
    }

    body {
        background:#2c3e50; /*From http://flatuicolors.com/ */
    }

    form {
        position:relative;
        width:360px;
        height:250px;
        margin:50px auto;
        text-align:center;
        background:#ecf0f1;
        padding:40px;
        -webkit-border-radius:20px 0 0 0;
        -moz-border-radius:20px 0 0 0;
        border-radius:20px 0 0 0;
        -webkit-box-shadow: 0px 1px 0px #ad392d, inset 0px 1px 0px white;
        -moz-box-shadow: 0px 1px 0px #ad392d, inset 0px 1px 0px white;
        box-shadow: 0px 1px 0px #ad392d, inset 0px 1px 0px white;
        box-shadow: 20px 20px 20px;
    }

    h4 {
        font-family: 'Source Sans Pro', sans-serif;
        font-size:2em;
        font-weight:300;
        margin-bottom:25px;
        color:#7f8c8d;
        text-shadow:1px 1px 0px white;
    }

    input {
        display:block;
        width:315px;
        padding:14px;
        -webkit-border-radius:6px;
        -moz-border-radius:6px;
        border-radius:6px;
        border:0;
        margin-bottom:12px;
        color:#7f8c8d;
        font-weight:600;
        font-size:16px;
    }

    input:focus {
        background:#fafafa;
    }


    li {
        position:absolute;
        right:40px;
        bottom:62px;
        list-style:none;
    }

    a, a:visited {
        text-decoration:none;
        color:#7f8c8d;
        font-weight:400;
        text-shadow:1px 1px 0px white;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out;
    }

    .button {
        position:relative;
        float:left;
        width:145px;
        margin-top:10px;
        background:#3498db;
        color:#fff;
        font-weight:400;
        text-shadow:1px 1px 0px #2d7baf;
        box-shadow:0px 3px 0px #2d7baf;
        -webkit-transition: all .3s ease-in-out;
        -moz-transition: all .3s ease-in-out;
        transition: all .3s ease-in-out;
    }
</style>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Login Form</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>


        <form action="index.php" id="login-form" class="smart-form client-form" method="post">
            <h4> Login Information </h4>
            <input type="text" name="txt_email" placeholder="Enter Username"/>
            <input type="password" name="txt_password" id="txt_password" placeholder="Enter Password"/>
            <li><a href="#">Forgot your password?</a></li>
            <input class="button" type="submit" id="but_submit" value="Log in"/>
            <input type="hidden" name="funct" value="login">
            <input type="hidden" name="mid" id="mid" value="1">
            <input type="hidden" name="m2id" value="0">
            <input type="hidden" name="m3id" value="0">
            <input type="hidden" id="activation_code" value="<?= $activation_code ?>">
        </form>
        



        <script type="text/javascript">

            

            $(document).ready(function () {

                get_option('mfp_secQues_id', '1', 'ref_security_question', 'secQues_id', 'secQues_desc', 'secQues_status', ' ', 'ref_id');
                get_option('mrg_secQues_id', '1', 'ref_security_question', 'secQues_id', 'secQues_desc', 'secQues_status', ' ', 'ref_id');

                $('#modal_register').on('shown.bs.modal', function () {
                    $('#form_mrg').trigger('reset');
                    $("input[name='mrg_jenis_permohonan'][value=0]").prop('checked', true);
                    $('.hideIndustri').show();
                    $('.hideConsultant').hide();
                });

                if ($('#activation_code').val() != '') {
                    $.ajax({
                        url: "process/p_login.php",
                        type: "POST",
                        dataType: "json",
                        data: {'funct': 'activate_user', 'activation_code': $('#activation_code').val()},
                        async: false,
                        success: function (resp) {
                            if (resp.success == true) {
                                f_notify(1, 'Activation Success', 'Your user ID successfully activated. Please log in to the system.');
                            } else {
                                f_notify(2, 'Error', resp.errors);
                                return false;
                            }
                        },
                        error: function () {
                            f_notify(2, 'Error', errMsg_default);
                            return false;
                        }
                    });
                }
                // Validation
                $("#login-form").validate({
                    // Rules for form validation
                    rules: {
                        txt_email: {
                            required: true
                        },
                        txt_password: {
                            required: true,
                            minlength: 3,
                            maxlength: 20
                        }
                    },
                    // Messages for form validation
                    messages: {
                        txt_email: {
                            required: 'Please enter your email address'
                        },
                        txt_password: {
                            required: 'Please enter your password'
                        }
                    },
                    // Do not change code below
                    errorPlacement: function (error, element) {
                        error.insertAfter(element.parent());
                    }
                });

                $('#but_submit').click(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "process/p_login.php",
                        type: "POST",
                        dataType: "json",
                        data: $("#login-form").serializeArray(),
                        async: false,
                        success: function (resp) {
                            if (resp.success == true) {
                                $("#mid").val(resp.result);
                                $("#login-form").submit();
                            } else {
                                f_notify(2, 'Error', resp.errors);
                                return false;
                            }
                        },
                        error: function () {
                            f_notify(2, 'Error', errMsg_default);
                            return false;
                        }
                    });
                });

                $('#form_mrg').find('[name="mrg_jenis_permohonan"]').on('click', function () {
                    $(this).val() == 0 ? $('.hideIndustri').show() : $('.hideIndustri').hide();
                    $(this).val() == 0 ? $('.hideConsultant').hide() : $('.hideConsultant').show();
                });

                $('#form_mfp').bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    excluded: ':disabled',
                    fields: {
                        mfp_username: {
                            validators: {
                                notEmpty: {
                                    message: 'IC No. / Username is required'
                                },
                                stringLength: {
                                    max: 12,
                                    message: 'IC No. / Username must be not more than 12 characters long'
                                }
                            }
                        },
                        mfp_secQues_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Security Question is required'
                                }
                            }
                        },
                        mfp_user_security_answer: {
                            validators: {
                                notEmpty: {
                                    message: 'Security Answer is required'
                                }
                            }
                        }
                    }
                });

                $('#form_mrg').bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    excluded: ':disabled',
                    fields: {
                        mrg_doeFile_no: {
                            validators: {
                                callback: {
                                    message: 'JAS File No. is required',
                                    callback: function (value, validator, $field) {
                                        var check = $('#form_mrg').find('[name="mrg_jenis_permohonan"][value=0]').is(':checked');
                                        return (check === false) ? true : (value !== '');
                                    }
                                },
                                stringLength: {
                                    min: 5,
                                    message: 'JAS File No. is not valid'
                                }
                            }
                        },
                        mrg_company_name: {
                            validators: {
                                callback: {
                                    message: 'Company Name is required',
                                    callback: function (value, validator, $field) {
                                        var check = $('#form_mrg').find('[name="mrg_jenis_permohonan"][value=1]').is(':checked');
                                        return (check === false) ? true : (value !== '');
                                    }
                                },
                                stringLength: {
                                    max: 80,
                                    message: 'Company Name must be not more than 80 characters long'
                                }
                            }
                        },
                        mrg_company_regNo: {
                            validators: {
                                callback: {
                                    message: 'Company Registration No. is required',
                                    callback: function (value, validator, $field) {
                                        var check = $('#form_mrg').find('[name="mrg_jenis_permohonan"][value=1]').is(':checked');
                                        return (check === false) ? true : (value !== '');
                                    }
                                },
                                stringLength: {
                                    max: 20,
                                    message: 'Company Registration No. must be not more than 20 characters long'
                                }
                            }
                        },
                        mrg_profile_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                },
                                stringLength: {
                                    max: 80,
                                    message: 'Name must be not more than 80 characters long'
                                }
                            }
                        },
                        mrg_profile_icNo: {
                            validators: {
                                notEmpty: {
                                    message: 'Identification No. is required'
                                },
                                stringLength: {
                                    min: 12,
                                    max: 12,
                                    message: 'Identification No. must be 12 digits long'
                                },
                                digits: {
                                    message: 'Identification No. must be digits'
                                }
                            }
                        },
                        mrg_profile_mobileNo: {
                            validators: {
                                notEmpty: {
                                    message: 'Mobile No. is required'
                                },
                                stringLength: {
                                    max: 11,
                                    message: 'Mobile No. must be not more than 11 characters long'
                                },
                                digits: {
                                    message: 'Mobile No. must be digits'
                                }
                            }
                        },
                        mrg_profile_email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email is required'
                                },
                                stringLength: {
                                    max: 80,
                                    message: 'Email must be not more than 80 characters long'
                                },
                                emailAddress: {
                                    message: 'Email is not valid'
                                }
                            }
                        },
                        mrg_designation: {
                            validators: {
                                notEmpty: {
                                    message: 'Position is required'
                                },
                                stringLength: {
                                    max: 50,
                                    message: 'Position must be not more than 50 characters long'
                                }
                            }
                        },
                        mrg_password: {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 20,
                                    message: 'Password must be not less than 6 and not more than 20 characters long'
                                }
                            }
                        },
                        mrg_user_password: {
                            validators: {
                                notEmpty: {
                                    message: 'Confirm Password is required'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 20,
                                    message: 'Confirm Password must be not less than 6 and not more than 20 characters long'
                                },
                                identical: {
                                    field: 'mrg_password',
                                    message: 'Confirm Password not same as Password'
                                }
                            }
                        },
                        mrg_secQues_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Security Question is required'
                                }
                            }
                        },
                        mrg_user_security_answer: {
                            validators: {
                                notEmpty: {
                                    message: 'Security Answer is required'
                                },
                                stringLength: {
                                    max: 100,
                                    message: 'Security Answer must be not less than 100 characters long'
                                }
                            }
                        }
                    }
                }).on('change', '[name="mrg_jenis_permohonan"]', function (e) {
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_doeFile_no');
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_company_name');
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_company_regNo');
                }).on('change', '[name="mrg_password"]', function (e) {
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_user_password');
                });

                $('#mfp_btn_modal_reset').click(function () {
                    var bootstrapValidator = $("#form_mfp").data('bootstrapValidator');
                    bootstrapValidator.validate();
                    if (bootstrapValidator.isValid()) {
                        if (f_submit_normal('email_forgot_password', {user_name: $('#mfp_username').val(), secQues_id: $('#mfp_secQues_id').val(), user_security_answer: $('#mfp_user_security_answer').val()}, 'p_email')) {
                            var message = 'Email Notification has been sent to ' + result_submit + ' with the temporary password. Please login and reset your password immediately!';
                            f_notify(1, 'Notification', message);
                            $('#modal_forgot_password').modal('hide');
                        }
                    } else
                        f_notify(2, 'Error', 'Please fill in the mandatory fields.');
                });

                $('#mrg_btn_modal_save').click(function () {
                    var bootstrapValidator = $("#form_mrg").data('bootstrapValidator');
                    bootstrapValidator.validate();
                    if (bootstrapValidator.isValid()) {
                        f_submit_forms('form_mrg', 'p_login', 'Your registration success. Please check your email and click the activation link to proceed.', '', 'modal_register');
                    } else
                        f_notify(2, 'Error', 'Please fill in the mandatory fields.');
                });


            });

            function f_load_forgot_password() {
                $('#form_mfp').trigger('reset');
                $('#form_mfp').bootstrapValidator('resetForm', true);
                $('#modal_forgot_password').modal('show');
            }

            particlesJS("particles-js", {
                "particles": {
                    "number": {
                        "value": 88,
                        "density": {
                            "enable": true,
                            "value_area": 700
                        }
                    },
                    "color": {
                        "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#000000"
                        },
                        "polygon": {
                            "nb_sides": 15
                        }
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 1.5,
                            "opacity_min": 0.15,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 2.5,
                        "random": false,
                        "anim": {
                            "enable": true,
                            "speed": 2,
                            "size_min": 0.15,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 110,
                        "color": "#33b1f8",
                        "opacity": 0.25,
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 1.6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 1200
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": false,
                            "mode": "repulse"
                        },
                        "onclick": {
                            "enable": false,
                            "mode": "push"
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 400,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            });
            var count_particles, stats, update;
            stats = new Stats;
            stats.setMode(0);
            stats.domElement.style.position = 'absolute';
            stats.domElement.style.left = '0px';
            stats.domElement.style.top = '0px';
            document.body.appendChild(stats.domElement);
            count_particles = document.querySelector('.js-count-particles');
            update = function () {
                stats.begin();
                stats.end();
                if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
                    count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
                }
                requestAnimationFrame(update);
            };
            requestAnimationFrame(update);
            ;



        </script>
    </body>
</html>
