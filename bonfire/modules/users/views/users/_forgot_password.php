<div class="az-signin-wrapper">
    <div class="az-card-signin">
        <table width="100%">
            <tr>
                <td align="left"><img src="<?php echo Template::theme_url('images/trt_manufacturing_logo.png');?>" align="left" width="70%" class="pull-left" alt=""></td>
            </tr>
        </table>
        <div class="az-signin-header">
            <h1 class="az-logo"><span>TRT</span> Manufacturing Planner</h1>
            <h4><?php echo lang('us_reset_password'); ?></h4>
            <a href="<?php echo site_url(); ?>">&larr; <?php echo lang('us_back_to') . $this->settings_lib->item('site.title'); ?></a>
            <?php echo Template::message(); ?>
            <?php if (validation_errors()) : ?>
                <div class="alert alert-error">
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="alert alert-info">
                <?php echo lang('us_reset_note'); ?>
            </div>
            <?php echo form_open($this->uri->uri_string(), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo iif( form_error('email') , 'error'); ?>">
                <label><?php echo lang('bf_email'); ?></label>
                <input type="email" class="form-control" required name="email" id="email" value="<?php echo set_value('email') ?>" />
            </div><!-- form-group -->

            <input class="btn btn-az-secondary btn-block" type="submit" name="send" value="<?php e(lang('us_send_password')); ?>" />
            <?php echo form_close(); ?>
        </div><!-- az-signin-header -->

    </div><!-- az-card-signin -->
</div><!-- az-signin-wrapper -->



