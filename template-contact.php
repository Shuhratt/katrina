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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="" style="float:left; width: 550px;">
            <h1><?php echo osc_static_page_title() ; ?></h1>
            <div><?php echo osc_static_page_text() ; ?></div>
        </div>
        <div class="user_forms" style="float:right;">
            <div class="inner">
                <h1><?php _e('Contact us', 'katrina') ; ?></h1>
                <ul id="error_list"></ul>
                <form action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact" id="contact">
                    <input type="hidden" name="page" value="contact" />
                    <input type="hidden" name="action" value="contact_post" />
                    <fieldset>
                        <label for="subject"><?php _e('Subject', 'katrina') ; ?> (<?php _e('optional', 'katrina'); ?>)</label> <?php ContactForm::the_subject() ; ?><br />
                        <label for="message"><?php _e('Message', 'katrina') ; ?></label> <?php ContactForm::your_message() ; ?><br />
                        <label for="yourName"><?php _e('Your name', 'katrina') ; ?> (<?php _e('optional', 'katrina'); ?>)</label> <?php ContactForm::your_name() ; ?><br />
                        <label for="yourEmail"><?php _e('Your e-mail address', 'katrina') ; ?></label> <?php ContactForm::your_email(); ?><br />
                        <?php osc_show_recaptcha(); ?>
                        <button type="submit"><?php _e('Send', 'katrina') ; ?></button>
                        <?php osc_run_hook('user_register_form') ; ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>
