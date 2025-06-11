<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Advocate Office Management System | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/ionicons.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/AdminLTE.css')?>" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url('assets/img/favicon.ico')?>" type="image/x-icon">
    <link href="<?php echo base_url('assets/css/login.css')?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
	<div class="app-copyright-footer">
        &copy; <?php echo date("Y"); ?> Sohrevard Online System (SOS). All rights reserved.<br>
        Programmed by Amid Ahadi
    </div>

    <script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
</head>
<body>
    <?php
        $message = ($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';
        $error = ($this->session->flashdata('error')) ? $this->session->flashdata('error') : '';

        $captcha_answer_for_js = ($this->session->userdata('captcha_answer')) ? $this->session->userdata('captcha_answer') : '';
    ?>

    <?php if(!empty($error) || !empty($message)): ?>
    <div class="container" style="margin-top:20px;">
        <div class="row">
            <div class="col-md-12">
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($message)): ?>
                <div class="alert alert-info alert-dismissable">
                    <i class="fa fa-info"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <?php echo $message; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="login-container" id="loginContainer">
        <div class="login-teaser">
            <?php echo lang('sign_in')?>
        </div>

        <div class="login-form-content">
            <div class="header">
                <?php echo lang('sign_in')?>
            </div>
            <form action="<?php echo site_url('admin/login')?>" method="post" id="loginForm">
                <div class="body bg-gray">
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="<?php echo lang('username')?>"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="<?php echo lang('password')?>"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label for="captcha_input" style="display: block; text-align: left; margin-bottom: 5px; font-weight: 600;">Solve this simple math problem:</label>
                        <div class="captcha-box">
                            <?php echo $captcha_question; ?>
                        </div>
                        <input type="text" id="captcha_input" name="captcha_input" class="form-control" placeholder="Your answer" required>
                        <div id="captcha-error">Incorrect CAPTCHA. Please try again.</div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="pull-left checkbox">
                            <label>
                                <input type="checkbox" name="remember_me"/> <?php echo lang('remember_me')?>
                            </label>
                        </div>
                        <input type="hidden" value="admin/login" name="redirect">
                        <input type="hidden" value="submitted" name="submitted">
                        <input type="hidden" id="captcha_answer_js" value="<?php echo htmlspecialchars($captcha_answer_for_js); ?>">
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block" id="loginSubmitBtn">
                        <?php echo lang('sign_in')?>
                    </button>

                    <p><a href="<?php echo site_url('forgot/forgot_password')?>"><?php echo lang('i_forgot_my_password')?></a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>

    <script>
        $(function () {
            var $loginContainer = $('#loginContainer');
            var $loginForm = $('#loginForm');
            var $loginSubmitBtn = $('#loginSubmitBtn');
            var $captchaInput = $('#captcha_input');
            var $captchaError = $('#captcha-error');
            var correctCaptchaAnswer = $('#captcha_answer_js').val();

            // --- Hover to Expand/Collapse Logic ---
            $loginContainer.on('mouseenter', function() {
                $(this).addClass('expanded');
            });

            $loginContainer.on('mouseleave', function() {
                // Only collapse if no input field is focused
                if (!$loginForm.find('input').is(':focus')) {
                    $(this).removeClass('expanded');
                }
            });

            // Keep expanded if an input is focused
            $loginForm.find('input').on('focus', function() {
                $loginContainer.addClass('expanded');
            });

            // Re-collapse when focus leaves all inputs and mouse leaves container
            $loginForm.find('input').on('blur', function() {
                setTimeout(function() {
                    if (!$loginForm.find('input').is(':focus') && !$loginContainer.is(':hover')) {
                        $loginContainer.removeClass('expanded');
                    }
                }, 100);
            });

            // --- Client-Side Captcha Validation and Button Animation ---
            $loginForm.on('submit', function(event) {
                var userCaptchaInput = $captchaInput.val();

                if (parseInt(userCaptchaInput) !== parseInt(correctCaptchaAnswer)) {
                    event.preventDefault();
                    $captchaError.fadeIn();
                    $loginSubmitBtn.addClass('shake');

                    $loginSubmitBtn.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function() {
                        $(this).removeClass('shake');
                    });
                } else {
                    $captchaError.fadeOut();
                    $loginSubmitBtn.removeClass('shake');

                    $loginSubmitBtn.html('<i class="fa fa-spinner fa-spin"></i> <?php echo lang("signing_in"); ?>...');
                    $loginSubmitBtn.prop('disabled', true);
                    $('.alert-danger, .alert-info').fadeOut();

                    this.submit();
                }
            });

            // Hide captcha error when user starts typing again
            $captchaInput.on('input', function() {
                $captchaError.fadeOut();
                $loginSubmitBtn.removeClass('shake');
            });
        });
    </script>
</body>
</html>