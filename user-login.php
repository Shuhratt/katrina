
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_forms">
            <div class="inner">
                <h1><?php _e('Access to your account', 'katrina'); ?></h1>
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="login_post" />
                    <fieldset>
						<span class="label"><?php _e('E-mail', 'katrina'); ?></span>
                        <label id="email_lab" for="email"></label> <?php UserForm::email_login_text(); ?><br />
						<span class="label"><?php _e('Password', 'katrina'); ?></span>
                        <label id="pas_lab" for="password"></label> <?php UserForm::password_login_text(); ?><br />
                        <p class="checkbox"><?php UserForm::rememberme_login_checkbox();?> <label id="remember_log" for="remember"><?php _e('Remember me', 'katrina'); ?></label>
						<a class="forgot" href="<?php echo osc_recover_user_password_url(); ?>"><?php _e("Forgot password?", 'katrina'); ?></a>
						</p>
                        <button type="submit"><?php _e("Log in", 'katrina');?></button>
                        <div class="more-login">
                            <a href="<?php echo osc_register_account_url(); ?>"><?php _e("Register for a free account", 'katrina'); ?></a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

<script type="text/javascript">
	$(document).ready(function(){
	$("#email").attr('placeholder', '<?php echo osc_esc_js(__('E-mail', 'katrina')); ?>');
	$("#password").attr('placeholder', '<?php echo osc_esc_js(__('Password', 'katrina')); ?>');
});
</script>
	  </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
