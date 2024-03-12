<?php
    if (!empty($_SESSION['user_id']) && !empty($_SESSION['user_type']))
    {

        redirect('admin/dashboard');
    }
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>e-License</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <!-- App js -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-validate/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery-validate/additional-methods.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-show-password.min.js"></script>
    </head>

    <body class="authentication-bg">
        
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="offset-3 col-lg-5">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="cat__pages__login__block__form"  id="login-frm">
                                    <div class="text-center w-75 m-auto">
                                    <img src="<?php echo base_url() ?>/assets/images/login_logo.png">    
                                    <h1>
                                         <span class="logo-lg">
                                               E-License
                                                <!--<img src="" alt="">-->
                                            </span>
                                        </h1>
                                    </div>

                                    <?php
                                        $attributes = array('id' => 'login-form', 'class' => '');
                                        echo form_open_multipart('admin/user/validate/redirectForcefully', $attributes);
                                    ?>
                                    <!--                                    <div id="errorContainer">
                                                                            <p>Please correct the following errors and try again:</p>
                                                                            <ul></ul>
                                                                        </div>-->
                                    <?php
                                        if (!empty($message))
                                        {
                                            ?>
                                            <div class="alert alert-danger alert-bold-border alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $message; ?>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" required="" placeholder="Enter your Username" autofocus="autofocus" />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" required=""  placeholder="Enter your password" />
                                    </div>

                                    <!-- <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                            <a id="forgot_pwd" class="mr-3 col-xl-5" style="color: #017fe0;cursor: pointer;"><?php echo mlLang('forgot_password'); ?></a>
                                        </div>
                                    </div> -->

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>
                                </div>
                                <div class="cat__pages__login__block__form  hidden" id="forgot-password-login-form">
                                    <br>
                                    <h4 class="text-uppercase text-center">
                                        <!-- <strong>Forgot Password</strong> -->
                                    </h4>
                                    <br />

                                    <?php echo form_close(); ?>
                                    <?php
                                        $attributes = array('id' => 'forgot_password', 'class' => 'form login_form');
                                        echo form_open(base_url('forgot-password'), $attributes);
                                    ?>
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="text" name="forgot_password_email" id="forgot_password_email" class="form-control" required data-msg-required="Please provide email" autofocus="true" >

                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" name="button" class="btn btn-primary mr-3 col-xl-5" id="forgot_trigger">Send Password</button>

                                        <a id="cancel_button" class="btn btn-primary mr-3 col-xl-5">Cancel</a>
                                    </div>
                                    <?php
                                        echo form_close();
                                    ?>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->

                            <div class="row mt-3">
                                <div class="col-12 text-center">
    <!--                                <p class="text-muted"> <a href="pages-register.html" class="text-muted ml-1">Forgot your password?</a></p>-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
        </div>
        <!-- end page -->

        <style>
            .hidden{
                display:none!important;
            }    
        </style>
        <script type="text/javascript">

            $(document).ready(function ()
            {
                $("#forgot_pwd").click(function () {
                    $("#login-frm").addClass('hidden');
                    $("#forgot-password-login-form").removeClass('hidden');
                });
                $("#cancel_button").click(function () {
                    $("#login-frm").removeClass('hidden');
                    $("#forgot-password-login-form").addClass('hidden');
                });
                $("#login-form").validate({
//                    ignore: [],
//                    errorContainer: $('#errorContainer'),
//                    errorLabelContainer: $('#errorContainer ul'),
//                    wrapper: 'li',
//                    onfocusout: false,
//                    highlight: function (element, errorClass)
//                    {
//                        validation_highlight(element, errorClass);
//                    },
//                    unhighlight: function (element, errorClass)
//                    {
//                        validation_unhighlight(element, errorClass);
//                    },
                    rules: {
                        useremail: "required",
                        password: "required"
                    },
                    messages: {
                        useremail: "Please provide a username",
                        password: "Please provide a password"
                    }
                });

                // Show/Hide Password
                $('.password').password({
                    eyeClass: '',
                    eyeOpenClass: 'icmn-eye',
                    eyeCloseClass: 'icmn-eye-blocked'
                });

                $("#forgot_password").validate(
                        {
                            rules: {
                                "forgot_password_email": {
                                    "required": true,
                                    "email": true
                                }
                            },
                            messages: {
                                "forgot_password_email": {
                                    "required": "<?php echo mlLang('errorEmailRequired'); ?>",
                                    "email": "<?php echo mlLang('errorValidEmail'); ?>"
                                }
                            },

                            submitHandler: function (form)
                            {
                                var forgot_email = $('#forgot_password_email').val();
                                $.ajax({
                                    url: '<?php echo base_url(); ?>admin/user/forgot_password',
                                    method: 'POST',
                                    data: {
                                        email: forgot_email
                                    },
                                    dataType: 'json'
                                }).done(function (response)
                                {
                                    if (response.status === "false")
                                    {
                                        alert('Provided Email address not found');
                                    } else
                                    {
                                        alert('Your password has been reset. Please check your email for the new password.');

                                        window.location.reload();
                                    }
                                });
                            }
                        });
            });
        </script>
    </body>
</html>
