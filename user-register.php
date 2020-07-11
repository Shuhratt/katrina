<?php
	/*
     *       Katrina Osclass Themes
     *
     *       Copyright (C) 2017 https://san-osclass.com/
     *
     *       This is Katrina Osclass Themes with Single License
     *
     *       This program is a commercial software. Copying or distribution without a license is not allowed.
     *
     */
    osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php UserForm::js_validation(); ?>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_forms">
            <div class="inner">
                <h1><?php _e('Register an account for free', 'katrina'); ?></h1>
                <ul id="error_list"></ul>
                <form name="register" id="register" action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="register" />
                    <input type="hidden" name="action" value="register_post" />

                    <fieldset>
						<span class="label"><?php _e('Name', 'katrina'); ?></span>
                        <label id="s_name_lab" for="name"></label> <?php UserForm::name_text(); ?><br />
						<span class="label"><?php _e('Password', 'katrina'); ?></span>
                        <label id="pas_lab" for="password"></label> <?php UserForm::password_text(); ?><br />
						<span class="label"><?php _e('Re-type password', 'katrina'); ?></span>
                        <label id="pas_lab_2" for="password"></label> <?php UserForm::check_password_text(); ?><br />
                        <p id="password-error" style="display:none;">
                        <span class="label"><?php _e('Passwords don\'t match', 'katrina'); ?>.
                        </p>
						<span class="label"><?php _e('E-mail', 'katrina'); ?></span>
                        <label id="email_lab" for="email"></label> <?php UserForm::email_text(); ?><br />
                        <?php osc_run_hook('user_register_form'); ?>
                        <?php osc_show_recaptcha('register'); ?>
                        <button type="submit"><?php _e('Create', 'katrina'); ?></button>
                    </fieldset>
                </form>
            </div>
			  </div>

				  <script type="text/javascript">
		    $(document).ready(function(){
		   $("#s_name").attr('placeholder', '<?php echo osc_esc_js(__('Name', 'katrina')); ?>');
		   $("#s_password").attr('placeholder', '<?php echo osc_esc_js(__('Password', 'katrina')); ?>');
		    $("#s_password2").attr('placeholder', '<?php echo osc_esc_js(__('Re-type password', 'katrina')); ?>');
		    $("#s_email").attr('placeholder', '<?php echo osc_esc_js(__('E-mail', 'katrina')); ?>');

		   });

			</script>
	  </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
