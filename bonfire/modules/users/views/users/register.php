<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);

?>
<div class="az-signup-wrapper">
    <div class="az-column-signup-left">
        <div>
            <table width="100%">
                <tr>
                    <td align="left"><img src="<?php echo Template::theme_url('images/trt_manufacturing_logo.png');?>" align="left" width="60%" class="pull-left" alt=""></td>
               </tr>
            </table><br>
            <h1 class="az-logo"><span>Manufacturing</span> Planner </h1>
            <h5>A platform for planning and scheduling of manufacturing processes</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <a href="#" target="_blank" class="btn btn-outline-primary">Learn More</a>
        </div>
    </div><!-- az-column-signup-left -->
    <div class="az-column-signup">
        <h1 class="az-logo"><span>Welcome to the</span> Planner <i class="fa fa-calendar-alt"></i></h1>
        <div class="az-signup-header">
            <h2><?php echo lang('us_sign_up'); ?></h2>
            <h6>Your new account will need to be activated before you can login.</h6>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-error">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="alert alert-info">
                <h5 class="alert-heading"><?php echo lang('bf_required_note'); ?></h5>
                <?php
                if (isset($password_hints)) {
                    echo $password_hints;
                }
                ?>
            </div>
            <?php echo form_open(site_url(REGISTER_URL), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
            <div class="form-group">
                <label><b>User Name</b></label>
                <input type="text" class="form-control" required placeholder="Enter your username" id="username" name="username">
            </div><!-- form-group -->
            <div class="form-group">
                <label>Firstname &amp; Lastname</label>
                <input type="text" class="form-control" placeholder="Enter your firstname and lastname" id="display_name" name="display_name">
            </div><!-- form-group -->
            <div class="form-group">
                <label><b>Email</b></label>
                <input type="email" class="form-control" required placeholder="Enter your email" id="email" name="email" required >
            </div><!-- form-group -->
            <div class="form-group">
                <label>Phone</label>
                <input id="phoneMask" type="text" class="form-control" placeholder="Enter your phone number" name="phone" >
            </div><!-- form-group -->
            <table width="100%">
                <tr>
                    <td>
                        <div class="form-group">
                            <label><b>Password</b></label>
                            <input type="password" class="form-control" required placeholder="Enter your password (Min 8 Characters)" id="password" name="password">
                        </div><!-- form-group -->
                    </td>
                    <td>
                        <div class="form-group">
                            <label><b>Password </b>(again)</label>
                            <input type="password" class="form-control" required placeholder="Confirm your password" id="pass_confirm" name="pass_confirm">
                            <input type="hidden" class="form-control"  id="role_id" name="role_id" value="7">
                            <input type="hidden" class="form-control"  id="language" name="language" value="english">
                            <input type="hidden" class="form-control"  id="timezones" name="timezones" value="UP3">
                            <input type="hidden" class="form-control"  id="state" name="state" value="AK">
                            <input type="hidden" class="form-control"  id="country" name="country" value="KE">
                        </div><!-- form-group -->
                    </td>
                </tr>
            </table>


            <input type="submit" class="btn btn-az-secondary btn-block" name="register" id="submit" value="Create Account">

            <?php echo form_close(); ?>
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
            <p>Already have an account? <a href="<?php echo base_url(); ?>login">Sign In</a></p>

        </div><!-- az-signin-footer -->
    </div><!-- az-column-signup -->
</div><!-- az-signup-wrapper -->



