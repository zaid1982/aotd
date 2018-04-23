<?php
session_start();
session_unset();
session_destroy();
$activation_code = isset($_GET['activationCode']) ? $_GET['activationCode'] : '';
?>
<!DOCTYPE html>
<html lang="en-us" id="extr-page">
    <head>
        <meta charset="utf-8">
        <title> MPOB System</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- #CSS Links -->
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">

        <!-- SmartAdmin RTL Support -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css"> 

        <!-- We recommend you use "your_style.css" to override SmartAdmin
             specific styles this will also ensure you retrain your customization with each SmartAdmin update.
        <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">

        <!-- #FAVICONS -->
        <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

        <!-- #GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- #APP SCREEN / ICONS -->
        <!-- Specifying a Webpage Icon for Web Clip 
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="screen and (max-device-width: 320px)">

    </head>
    
<body class="animated">
        <header id="header" style="min-height:120px">
            <div id="logo-group" class="hidden-xs">
                <span class="about-heading txt-color-gray" id="logo"> <img src="img/mpob-header.png" alt="SmartAdmin"></span>
            </div>
            <div>  
                <img src="img/logo-aotd.png" alt="SmartAdmin" height="140px" width="400px">
            </div>
            <div class="pull-right hidden-mobile hidden-md hidden-sm hidden-xs">  
                <br>
                <h12 class="about-heading txt-color-gray" style="text-align:center">Malaysian Palm Oil Board</h12><br>

                <h12 class="about-heading txt-color-gray" style="text-align:center">No 6, Persiaran Institusi, Bandar Baru Bangi <br>43000 Kajang, Selangor Malaysia</h12>          <br>
                <h12 class="about-heading txt-color-gray" style="text-align:center">General Line: 603 - 8769 4400 <br>Fax Number  : 603 - 8925 9446</h12>
            </div>
        </header>
    <style>
       body canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 105%; top: -5%; background-color: #050514; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 60% 40%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
</style>
        <div id="main" role="main">
            <div id="particles-js"></div>
            <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>  
            <!--<script src="https://threejs.org/examples/js/libs/stats.min.js"></script>-->
            <!-- MAIN CONTENT -->
            <div id="content" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
                        <!-- well -->
                        <div class="">
                            <div id="myCarousel" class="carousel fade" >
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <!-- Slide 1 -->
                                    <div class="item active">
                                        <img src="img/demo/a1.png" alt="center">
                                        <div class="carousel-caption caption-right">
                                            <h4></h4>
                                            <p>
                                            </p>
                                            <br>
                                            <!--<a href="javascript:void(0);" class="btn btn-sm bg-color-blueLight txt-color-white">Application of CEMS/PEMS Installation</a>-->
                                        </div>
                                    </div>
                                    <!-- Slide 2 -->
                                    <div class="item">
                                        <img src="img/demo/a2.png" alt="center">
                                        <div class="carousel-caption caption-left">
                                            <h4></h4>
                                            <p>
                                            </p>
                                            <br>
                                            <!--<a href="javascript:void(0);" class="btn btn-sm bg-color-blueLight txt-color-white">Application of Consultant Registration</a>-->
                                        </div>
                                    </div>
                                    <!-- Slide 3 -->
                                    <div class="item">
                                        <img src="img/demo/a3.png" alt="center">
                                        <div class="carousel-caption">
                                            <h4></h4>
                                            <p>
                                            </p>
                                            <br>
                                            <!--<a href="javascript:void(0);" class="btn btn-sm bg-color-blueLight txt-color-white">Contact Us</a>-->
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                            </div>
                        </div>
                        
                        <!-- end well -->
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h7 style="font-family: verdana; font-style: italic; 
                                    font-weight:bold; letter-spacing: 1px; background-color: gold">About A.O.T.D</h7></br>
                                <h7 class="txt-color-black" style="color: white">
                                    Sistem Labotary Informatioin Management System (AOTD)
                                    developed to help MPOB to .......</br></br>
                                </h7>
                            </div>
<!--                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <h7 style="font-family: verdana; font-style: italic; 
                                    font-weight:bold; letter-spacing: 1px; background-color: gold">User Manual!</h7></br>
                                <h7 class="txt-color-black" style="color: white">
                                    We'd like your navigation through our system to be hassle free. Download our manual <a href="">here</a> to learn more.</br></br>
                                </h7>
                            </div>-->
                        </div>                         
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                        <div class="well no-padding">
                            <form action="index.php" id="login-form" class="smart-form client-form" method="post">
                                <header>
                                    Sign In
                                </header>
                                <fieldset>


                                    <section>
                                        <label class="label">IC Number</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" type="txt_email" name="txt_email">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-blue"></i> Please enter IC Number</b></label>
                                    </section>
                                    <section>
                                        <label class="label">Password</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="txt_password" id="txt_password">
                                            <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-blue"></i> Enter your Password</b> </label>
<!--                                        <div class="note" >
                                            <a href="#" data-toggle="modal" onclick="f_load_forgot_password();">Forgot password?</a>
                                        </div>-->
                                    </section>
                                </fieldset>
                                <footer>
                                    <button type="submit" id="but_submit" class="btn btn-success active">
                                        Sign in
                                    </button>
                                    <a class="btn btn-danger" data-toggle="modal" data-target="#modal_register">Sign Up</a>
                                </footer>
                                <input type="hidden" name="funct" value="login">
                                <input type="hidden" name="mid" id="mid" value="1">
                                <input type="hidden" name="m2id" value="0">
                                <input type="hidden" name="m3id" value="0">
                                <input type="hidden" id="activation_code" value="<?= $activation_code ?>">
                            </form>
                        </div>
                        <h5 class="text-center"></h5>
                        <br>
<!--                       <center>
                            <div class="well">
                                <a href="javascript:void(0);" class="btn btn-success active btn-group-justified btn">User Manual</a>
                                <br>
                                <a href="javascript:void(0);" class="btn btn-success active btn-group-justified btn">Guideline</a>
                                <br>
                                <a href="javascript:void(0);" class="btn btn-success active btn-group-justified btn">Complience Table</a>
                                <br>
                                <a href="javascript:void(0);" class="btn btn-success active btn-group-justified btn" data-toggle="modal" data-target="#myModal">Inquiry</a>
                                <br>
                            </div>
                        </center>-->
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">            
                        <div class="modal-header bg-color-blueLight txt-color-white">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; New User Registration</h4>
                        </div>
                        <div class="modal-body padding-gutter">
                            <form class="form-horizontal" id="form_mrg">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Application Type</label>
                                        <div class="col-md-8">
                                            <label class="radio radio-inline">
                                                <input type="radio" class="radiobox" name="mrg_jenis_permohonan" value="0">
                                                <span>Industrial Premise</span> 
                                            </label>
                                            <label class="radio radio-inline">
                                                <input type="radio" class="radiobox" name="mrg_jenis_permohonan" value="1">
                                                <span>Consultant</span>  
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group hideIndustri">
                                        <label class="col-md-4 control-label"><font color="red">*</font> JAS File No.</label>
                                        <div class="col-md-8">   
                                            <input type="text" name="mrg_doeFile_no" id="mrg_doeFile_no" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group hideConsultant">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Company Name</label>
                                        <div class="col-md-8">   
                                            <input type="text" name="mrg_company_name" id="mrg_company_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group hideConsultant">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Company Registration No.</label>
                                        <div class="col-md-8">   
                                            <input type="text" name="mrg_company_regNo" id="mrg_company_regNo" class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Name</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mrg_profile_name" id="mrg_profile_name" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-user "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> IC / Passport No.</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mrg_profile_icNo" id="mrg_profile_icNo" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-credit-card "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Mobile No.</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mrg_profile_mobileNo" id="mrg_profile_mobileNo" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-phone "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Email</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="email" name="mrg_profile_email" id="mrg_profile_email" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-envelope "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Position</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mrg_designation" id="mrg_designation" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-briefcase "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Password</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="password" name="mrg_password" id="mrg_password" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Confirm Password</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="password" name="mrg_user_password" id="mrg_user_password" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Security Question</label>
                                        <div class="col-md-8 selectContainer">
                                            <select class="form-control" name="mrg_secQues_id" id="mrg_secQues_id"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Security Answer</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mrg_user_security_answer" id="mrg_user_security_answer" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>                    
                                <input type="hidden" name="funct" id="mrg_funct" value="register_user" />
                                <div class="form-actions margin-top-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-labeled btn-danger" id="mrg_btn_modal_cancel" data-dismiss="modal">
                                                <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                                            </button>
                                            <button type="button" class="btn btn-labeled btn-success" id="mrg_btn_modal_save">
                                                <span class="btn-label"><i class="fa fa-save"></i></span>Register
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>                
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="modal fade" id="modal_forgot_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">            
                        <div class="modal-header bg-color-blueLight txt-color-white">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title"><i class='fa fa-edit'></i>&nbsp; Forgot Password</h4>
                        </div>
                        <div class="modal-body padding-gutter">
                            <form class="form-horizontal" id="form_mfp">
                                <fieldset>                                   
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> IC / Username</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mfp_username" id="mfp_username" class="form-control" maxlength="20">
                                                <span class="input-group-addon"><i class="fa fa-credit-card "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Security Question</label>
                                        <div class="col-md-8 selectContainer">
                                            <select class="form-control" name="mfp_secQues_id" id="mfp_secQues_id"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><font color="red">*</font> Security Answer</label>
                                        <div class="col-md-8">   
                                            <div class="input-group">
                                                <input type="text" name="mfp_user_security_answer" id="mfp_user_security_answer" class="form-control" maxlength="50">
                                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>       
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-actions margin-top-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-labeled btn-danger" id="mfp_btn_modal_cancel" data-dismiss="modal">
                                                <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                                            </button>
                                            <button type="button" class="btn btn-labeled btn-success" id="mfp_btn_modal_reset">
                                                <span class="btn-label"><i class="fa fa-refresh"></i></span>Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>                
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

                            
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">            
                        <div class="modal-header bg-color-blueLight txt-color-white">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title" id="myModal"><i class='fa fa-question-circle'></i>&nbsp; Inquiry</h4>

                        </div>
                        <div class="modal-body padding-gutter">
                            <form class="form-horizontal" id="form_mes">
                                <fieldset>

                                 <div class="form-group">
                                     <div class="col-md-9" style="height: 27px">

                                        <h7 class="about-heading txt-color-black" style="position:absolute; TOP:0px; 
                                        LEFT:162px; HEIGHT:0px; text-align:justify">
                                        <b>Support Center:</b> 03-8889 1972
                                        <br>
                                        <b>Hotline:</b> 1-800-88-2727<br>
                                        <a href="#" data-toggle="modal" data-target="#modal_pegawai" class="view">Senarai Meja Bantuan CEMS Negeri</a> 
                                    </h7>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><font color="red">*</font> Name</label>
                                <div class="col-md-9">   
                                    <div class="input-group">
                                        <input type="text" name="nama" id="nama" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-user "></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><font color="red">*</font> Email</label>
                                <div class="col-md-9">   
                                    <div class="input-group">
                                        <input type="email" name="email" id="email" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-envelope "></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><font color="red">*</font> Contact No.</label>
                                <div class="col-md-9">   
                                    <div class="input-group">
                                        <input type="text" name="nama" id="nama" class="form-control">
                                        <span class="input-group-addon"><i class="fa fa-phone "></i></span>       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><font color="red">*</font> Category</label>
                                <div class="col-md-9 selectContainer">   
                                    <select id="" class="form-control">
                                        <option></option>
                                        <option>Inquiry about iRemote System</option>
                                        <option>Inquiry about CEMS Installation</option>
                                        <option>Inquiry about PEMS Installation</option>
                                        <option>Inquiry about CEMS/PEMS Consultant Registration</option>
                                        <option>Complaint</option>
                                        <option>Suggestion</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><font color="red">*</font> <font color="red"></font> Message</label>
                                <div class="col-md-9">   
                                    <div class="input-group">
                                        <textarea type="text" name="message" id="message" rows="3" placeholder="Type your message here..." class="form-control"></textarea>
                                        <span class="input-group-addon"><i class="fa fa-comment"  data-placement="top" data-trigger="manual"></i></span>  
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions margin-top-10">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-danger" id="mes_btn_modal_cancel" data-dismiss="modal">
                                            <i class="fa fa-ban"></i><span class="hidden-mobile">&nbsp;Cancel</span>
                                        </button>
                                        <button type="submit" class="btn btn-success active" id="mes_btn_modal_save">
                                            <i class="fa fa-save"></i><span class="hidden-mobile">&nbsp;Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="page-footer">
            <div class="row">
                <span class="txt-color-white">
                    <span>MPOB - Laboratory Information Management System 2.0 © 2017</span>
            </div>
        </div>

        <!--================================================== -->	

        <!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
        <script src="js/plugin/pace/pace.min.js"></script>

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script> if (!window.jQuery) {
                document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
            }</script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script> if (!window.jQuery.ui) {
                document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
            }</script>

        <!-- IMPORTANT: APP CONFIG -->
        <script src="js/app.config.js"></script>

        <!-- JS TOUCH : include this plugin for mobile drag / drop touch events  -->		
        <script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
        
        <!-- JARVIS WIDGETS -->
        <script src="js/smartwidgets/jarvis.widget.min.js"></script>
        
        <!-- BOOTSTRAP JS -->		
        <script src="js/bootstrap/bootstrap.min.js"></script>

        <!-- CUSTOM NOTIFICATION -->
        <script src="js/notification/SmartNotification.min.js"></script>
        
        <!-- JQUERY VALIDATE -->
        <script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>

        <!-- JQUERY MASKED INPUT -->
        <script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>
        
        <!-- JQUERY SELECT2 INPUT -->
        <script src="js/plugin/select2/select2.min.js"></script>
        
        <!-- JQUERY UI + Bootstrap Slider -->
        <script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

        <!-- browser msie issue fix -->
        <script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

        <!-- FastClick: For mobile devices -->
        <script src="js/plugin/fastclick/fastclick.min.js"></script>
        
        <script src="js/plugin/bootstrapvalidator/bootstrapValidator.min.js"></script>
        <!--[if IE 8]>
                
                <h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
                
        <![endif]-->

        <!-- MAIN APP JS FILE -->
        <script src="js/app.min.js"></script>
        
        <script src="library/general.js"></script>
        
        
        <script type="text/javascript">
    

            runAllForms();
            //pageSetUp();
            /*
             * CONVERT DIALOG TITLE TO HTML
             * REF: http://stackoverflow.com/questions/14488774/using-html-in-a-dialogs-title-in-jquery-ui-1-10
             */
            $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
                _title: function (title) {
                    if (!this.options.title) {
                        title.html("&#160;");
                    } else {
                        title.html(this.options.title);
                    }
                }
            }));
            
            $(document).ready(function () {
                
                get_option('mfp_secQues_id', '1', 'ref_security_question', 'secQues_id', 'secQues_desc', 'secQues_status', ' ', 'ref_id');
                get_option('mrg_secQues_id', '1', 'ref_security_question', 'secQues_id', 'secQues_desc', 'secQues_status', ' ', 'ref_id');
                
                $('#modal_register').on('shown.bs.modal', function() {
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
                        mfp_username : {
                            validators: {
                                notEmpty: {
                                    message: 'IC No. / Username is required'
                                },
                                stringLength : {
                                    max : 12,
                                    message : 'IC No. / Username must be not more than 12 characters long'
                                }
                            }
                        },
                        mfp_secQues_id : {
                            validators: {
                                notEmpty: {
                                    message: 'Security Question is required'
                                }
                            }
                        },
                        mfp_user_security_answer : {
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
                        mrg_doeFile_no : {
                            validators: {
                                callback: {
                                    message: 'JAS File No. is required',
                                    callback: function (value, validator, $field) {
                                        var check = $('#form_mrg').find('[name="mrg_jenis_permohonan"][value=0]').is(':checked');
                                        return (check === false) ? true : (value !== '');
                                    }
                                },
                                stringLength : {
                                    min : 5,
                                    message : 'JAS File No. is not valid'
                                }
                            }
                        },
                        mrg_company_name : {
                            validators: {
                                callback: {
                                    message: 'Company Name is required',
                                    callback: function (value, validator, $field) {
                                        var check = $('#form_mrg').find('[name="mrg_jenis_permohonan"][value=1]').is(':checked');
                                        return (check === false) ? true : (value !== '');
                                    }
                                },
                                stringLength : {
                                    max : 80,
                                    message : 'Company Name must be not more than 80 characters long'
                                }
                            }
                        },
                        mrg_company_regNo : {
                            validators: {
                                callback: {
                                    message: 'Company Registration No. is required',
                                    callback: function (value, validator, $field) {
                                        var check = $('#form_mrg').find('[name="mrg_jenis_permohonan"][value=1]').is(':checked');
                                        return (check === false) ? true : (value !== '');
                                    }
                                },
                                stringLength : {
                                    max : 20,
                                    message : 'Company Registration No. must be not more than 20 characters long'
                                }
                            }
                        },
                        mrg_profile_name : {
                            validators: {
                                notEmpty: {
                                    message: 'Name is required'
                                },
                                stringLength : {
                                    max : 80,
                                    message : 'Name must be not more than 80 characters long'
                                }
                            }
                        },
                        mrg_profile_icNo : {
                            validators: {
                                notEmpty: {
                                    message: 'Identification No. is required'
                                },
                                stringLength : {
                                    min : 12,
                                    max : 12,
                                    message : 'Identification No. must be 12 digits long'
                                },
                                digits : {
                                    message : 'Identification No. must be digits'
                                }
                            }
                        },                        
                        mrg_profile_mobileNo : {
                            validators: {
                                notEmpty: {
                                    message: 'Mobile No. is required'
                                },
                                stringLength : {
                                    max : 11,
                                    message : 'Mobile No. must be not more than 11 characters long'
                                },
                                digits : {
                                    message : 'Mobile No. must be digits'
                                }
                            }
                        },
                        mrg_profile_email : {
                            validators: {
                                notEmpty: {
                                    message: 'Email is required'
                                },
                                stringLength : {
                                    max : 80,
                                    message : 'Email must be not more than 80 characters long'
                                },
                                emailAddress : {
                                    message : 'Email is not valid'
                                }
                            }
                        },
                        mrg_designation : {
                            validators: {
                                notEmpty: {
                                    message: 'Position is required'
                                },
                                stringLength : {
                                    max : 50,
                                    message : 'Position must be not more than 50 characters long'
                                }
                            }
                        },
                        mrg_password : {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                },
                                stringLength: {
                                    min : 6,
                                    max : 20,
                                    message : 'Password must be not less than 6 and not more than 20 characters long'
                                }
                            }
                        },
                        mrg_user_password : {
                            validators: {
                                notEmpty: {
                                    message: 'Confirm Password is required'
                                },
                                stringLength: {
                                    min : 6,
                                    max : 20,
                                    message : 'Confirm Password must be not less than 6 and not more than 20 characters long'
                                },
                                identical: {
                                    field : 'mrg_password',
                                    message : 'Confirm Password not same as Password'
                                }
                            }
                        },
                        mrg_secQues_id : {
                            validators: {
                                notEmpty: {
                                    message: 'Security Question is required'
                                }
                            }
                        },
                        mrg_user_security_answer : {
                            validators: {
                                notEmpty: {
                                    message: 'Security Answer is required'
                                },
                                stringLength: {
                                    max : 100,
                                    message : 'Security Answer must be not less than 100 characters long'
                                }
                            }
                        }
                    }
                }).on('change', '[name="mrg_jenis_permohonan"]', function(e) {
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_doeFile_no');
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_company_name');
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_company_regNo');
                }).on('change', '[name="mrg_password"]', function(e) {
                    $('#form_mrg').bootstrapValidator('revalidateField', 'mrg_user_password');
                }); 
        
                $('#mfp_btn_modal_reset').click(function () {
                    var bootstrapValidator = $("#form_mfp").data('bootstrapValidator');
                    bootstrapValidator.validate();
                    if (bootstrapValidator.isValid()) {                        
                        if (f_submit_normal('email_forgot_password', {user_name:$('#mfp_username').val(), secQues_id:$('#mfp_secQues_id').val(), user_security_answer:$('#mfp_user_security_answer').val()}, 'p_email')) {
                            var message = 'Email Notification has been sent to '+result_submit+' with the temporary password. Please login and reset your password immediately!';
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
update = function() {
  stats.begin();
  stats.end();
  if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
    count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
  }
  requestAnimationFrame(update);
};
requestAnimationFrame(update);;

  
  
        </script>
        
    </body>
</html>