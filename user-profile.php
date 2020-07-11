<?php
  $locales   = __get('locales');
    $user = osc_user();
    osc_enqueue_style('jquery-ui-custom', osc_current_web_theme_styles_url('jquery-ui/jquery-ui-1.8.20.custom.css'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
		
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content user_account">
            <h1>
                <strong><?php _e('User account manager', 'katrina'); ?></strong>
            </h1>
            <div id="sidebar">
                <?php echo osc_private_user_menu(); ?>
            </div>
            <div id="main" class="modify_profile">
     
                <?php UserForm::location_javascript(); ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#delete_account").click(function(){
                            $("#dialog-delete-account").dialog('open');
                        });

                        $("#dialog-delete-account").dialog({
                            autoOpen: false,
                            modal: true,
                            buttons: {
                                "<?php echo osc_esc_js(__('Delete', 'katrina')); ?>": function() {
                                    window.location = '<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>';
                                },
                                "<?php echo osc_esc_js(__('Cancel', 'katrina')); ?>": function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                    });
                </script>
                <form action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="profile_post" />
                    <fieldset>
				
					<div class="contact kat">
						<h2> <?php _e('Contacts', 'katrina'); ?></h2>
							<div class="row">
								<label for="name"><?php _e('Name', 'katrina'); ?></label>
								<?php UserForm::name_text(osc_user()); ?>
							</div>
							<div class="row">
								<label for="email"><?php _e('Username', 'katrina'); ?></label>
								<span class="update">
									<?php echo osc_user_username(); ?>
									<?php if(osc_user_username()==osc_user_id()) { ?>
										<a href="<?php echo osc_change_user_username_url(); ?>"><?php _e('Modify username', 'katrina'); ?></a>
									<?php }; ?>
								</span>
							</div>
							  <div class="row">
								<label for="phoneMobile"><?php _e('Cell phone', 'katrina'); ?></label>
								<?php UserForm::mobile_text(osc_user()); ?>
							</div>
							<div class="loc">
								<div class="row">
								<label for="country"><?php _e('Country', 'katrina'); ?> *</label>
								<?php UserForm::country_select(osc_get_countries(), osc_user()); ?>
								</div>
								<div class="row">
									<label for="region"><?php _e('Region', 'katrina'); ?> *</label>
									<?php UserForm::region_select(osc_get_regions(), osc_user()); ?>
								</div>
								<div class="row">
									<label for="city"><?php _e('City', 'katrina'); ?> *</label>
									<?php UserForm::city_select(osc_get_cities(), osc_user()); ?>
								</div>
								<div class="row">
									<label for="address"><?php _e('Address', 'katrina'); ?></label>
									<?php UserForm::address_text(osc_user()); ?>
								</div>
							</div>
						<button type="submit"><?php _e('Update', 'katrina'); ?></button>
					</div>
					
					<div class="business kat">
					<h2> <?php _e('Business', 'katrina'); ?></h2>
                        <div class="row">
                            <label for="user_type"><?php _e('User type', 'katrina'); ?></label>
                            <?php UserForm::is_company_select(osc_user()); ?>
                        </div>
                         <div class="row">
                            <label for="city_area"><?php _e('Phone', 'katrina'); ?></label>
                            <?php UserForm::city_area_text(osc_user()); ?>
                        </div>
	
                        <div class="row">
                            <label for="webSite"><?php _e('Website', 'katrina'); ?></label>
                            <?php UserForm::website_text(osc_user()); ?>
                        </div>
						 <div class="row" style="width: 100%;">
							<label for="Info"><?php _e('Info', 'katrina'); ?></label>
                            <?php UserForm::multilanguage_info($locales, osc_user()); ?>
                        </div>
                      <button type="submit"><?php _e('Update', 'katrina'); ?></button>
					</div>
					
					<div class="email kat">
					<h2> <?php _e('Email', 'katrina'); ?></h2>
								<div class="row">
									<label for="email"><?php _e('E-mail', 'katrina'); ?></label>
									<span class="update">
										<?php echo osc_user_email(); ?><br />
										<a href="<?php echo osc_change_user_email_url(); ?>"><?php _e('Modify e-mail', 'katrina'); ?></a> 
									</span>
								</div>
					</div>
					
					<div class="pass kat">
					<h2> <?php _e('Password', 'katrina'); ?></h2>
								<div class="row">
									
									<span class="update">
							
									<a href="<?php echo osc_change_user_password_url(); ?>" ><?php _e('Modify password', 'katrina'); ?></a>
									</span>
								</div>
					</div>
                       
						<button id="delete_account" type="button"><?php _e('Delete my account', 'katrina'); ?></button>
                        <?php osc_run_hook('user_form'); ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <div id="dialog-delete-account" title="<?= osc_esc_html(__('Delete account', 'katrina')); ?>" class="has-form-actions hide">
            <div class="form-horizontal">
                <div class="form-row">
                    <p><?php _e('All your listings and alerts will be removed, this action can not be undone.', 'katrina');?></p>
                </div>
            </div>
        </div>
		  </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>