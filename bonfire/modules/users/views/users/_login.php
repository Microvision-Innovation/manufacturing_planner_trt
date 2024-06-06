<?php
$site_open = $this->settings_lib->item('auth.allow_register');
?>
<div class="az-signin-wrapper">
    <div class="az-card-signin">
        <table width="100%">
            <tr>
                <td align="left"><img src="<?php echo Template::theme_url('images/trt_manufacturing_logo.png');?>" align="left" width="70%" class="pull-left" alt=""></td>
            </tr>
        </table>


        <div class="az-signin-header">

            <h1 class="az-logo"><span>Welcome Back!</span></h1>
            <h4><?php echo lang('us_login'); ?></h4>
            <?php echo Template::message(); ?>
            <?php
            if (validation_errors()) :
                ?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="alert alert-danger mg-b-0" role="alert">
                            <a data-dismiss="alert" class="close">&times;</a>
                            <?php echo validation_errors(); ?>sadsa
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>
            <div class="form-group <?php echo iif( form_error('login') , 'error') ;?>">
                <label>Username/Email</label>
                <input type="text" class="form-control" data-parsley-class-handler="#fnWrapper" required name="username" value="<?php echo set_value('login'); ?>" id="login_value" tabindex="1" placeholder="Enter your <?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" >
            </div><!-- form-group -->
            <div class="form-group <?php echo iif( form_error('password') , 'error') ;?>">
                <label>Password</label>
                <input type="password" class="form-control" required name="password" id="password" value="" tabindex="2" placeholder="Enter your <?php echo lang('bf_password'); ?>" >
            </div><!-- form-group -->
            <?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
                <div class="form-group">
                    <label class="ckbox">
                        <input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3"><span><?php echo lang('us_remember_note'); ?></span>
                    </label>

                </div>
            <?php endif; ?>
            <input class="btn btn-az-secondary btn-block" type="submit" name="log-me-in" id="submit" value="<?php e(lang('us_let_me_in')); ?>" tabindex="5" />
            <?php echo form_close(); ?>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
            <?php // show for Email Activation (1) only
            if ($this->settings_lib->item('auth.user_activation_method') == 1) : ?>
                <!-- Activation Block -->
                <p style="text-align: left" class="well">
                    <?php echo lang('bf_login_activate_title'); ?><br />
                    <?php
                    $activate_str = str_replace('[ACCOUNT_ACTIVATE_URL]',anchor('/activate', lang('bf_activate')),lang('bf_login_activate_email'));
                    $activate_str = str_replace('[ACTIVATE_RESEND_URL]',anchor('/resend_activation', lang('bf_activate_resend')),$activate_str);
                    echo $activate_str; ?>
                </p>
            <?php endif; ?>
            <p><?php echo anchor('/forgot_password', lang('us_forgot_your_password')); ?></p>
            <?php if ( $site_open ) : ?>
                <p>Don't have an account? <?php echo anchor(REGISTER_URL, lang('us_sign_up')); ?></p>
            <?php endif; ?>

        </div><!-- az-signin-footer -->
    </div><!-- az-card-signin -->
</div><!-- az-signin-wrapper -->