<?php
    $address = '';
    if(osc_user_address()!='') {
        if(osc_user_city_area()!='') {
            $address = osc_user_address().", ".osc_user_city_area();
        } else {
            $address = osc_user_address();
        }
    } else {
        $address = osc_user_city_area();
    }
    $location_array = array();
    if(trim(osc_user_city()." ".osc_user_zip())!='') {
        $location_array[] = trim(osc_user_city()." ".osc_user_zip());
    }
    if(osc_user_region()!='') {
        $location_array[] = osc_user_region();
    }
    if(osc_user_country()!='') {
        $location_array[] = osc_user_country();
    }
    $location = implode(", ", $location_array);
    unset($location_array);

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
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content item user_public_profile">
        
			<div id="main" class="border-radius">
					<h1><?php echo osc_user_name(); ?></h1>
							<?php if(function_exists('profile_picture_show')) { ?>
									<?php if(osc_item_user_id() <> 0 and osc_item_user_id() <> '') { ?>
									<a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>" title="<?= osc_esc_html(__('Check profile of this user', 'katrina')); ?>">
									
									  <?php profile_picture_show(null, 'item', 200); ?>
									</a>
								  <?php } else { ?>
									<?php profile_picture_show(null, 'item', 200); ?>
								  <?php } ?>
							
							<?php } ?>
			
					<h2><?php _e('Profile', 'katrina'); ?></h2>
						<ul id="user_data">
							
							<?php  if($address!=''){ ?><li><i class="fa fa-map-marker" aria-hidden="true"></i><?php _e('Address', 'katrina'); ?>: <?php echo $address; ?></li><?php } ?>
						   <?php  if($location!=''){ ?> <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php _e('Location', 'katrina'); ?>: <?php echo $location; ?></li><?php } ?>
							<?php  if(osc_user_website()!=''){ ?><li><i class="fa fa-share" aria-hidden="true"></i><?php _e('Website', 'katrina'); ?>: <?php echo osc_user_website(); ?></li><?php } ?>
							<?php  if(osc_user_info()!=''){ ?><li><i class="fa fa-info" aria-hidden="true"></i><?php _e('User Description', 'katrina'); ?>: <?php echo osc_user_info(); ?></li><?php } ?>
						</ul>
						
						<?php if(osc_logged_user_id()!=  osc_user_id()) { ?>
            <div id="sidebar">
                
                <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
                <div id="contact">
                    <h2><?php _e("Contact publisher", 'katrina'); ?></h2>
                    <ul id="error_list"></ul>
                    <?php ContactForm::js_validation(); ?>
                    <form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form">
                        <input type="hidden" name="action" value="contact_post" />
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="id" value="<?php echo osc_user_id();?>" />
                        <?php osc_prepare_user_info(); ?>
                        <fieldset>
                            <label for="yourName"><?php _e('Your name', 'katrina'); ?>:</label> <?php ContactForm::your_name(); ?>
                            <label for="yourEmail"><?php _e('Your e-mail address', 'katrina'); ?>:</label> <?php ContactForm::your_email(); ?>
                            <label for="phoneNumber"><?php _e('Phone number', 'katrina'); ?> (<?php _e('optional', 'katrina'); ?>):</label> <?php ContactForm::your_phone_number(); ?>
                            <label for="message"><?php _e('Message', 'katrina'); ?>:</label> <?php ContactForm::your_message(); ?>
                            <?php if( osc_recaptcha_public_key() ) { ?>
                            <script type="text/javascript">
                                var RecaptchaOptions = {
                                    theme : 'custom',
                                    custom_theme_widget: 'recaptcha_widget'
                                };
                            </script>
                            <style type="text/css"> div#recaptcha_widget, div#recaptcha_image > img { width:280px; } </style>
                            <div id="recaptcha_widget">
                                <div id="recaptcha_image"><img /></div>
                                <span class="recaptcha_only_if_image"><?php _e('Enter the words above','katrina'); ?>:</span>
                                <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                                <div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'katrina'); ?></a></div>
                            </div>
                            <?php } ?>
                            <?php osc_show_recaptcha(); ?>
                            <button type="submit"><?php _e('Send', 'katrina'); ?></button>
                        </fieldset>
                    </form>
                </div>
                <?php     } ?>
              <?php } ?>
			     
            </div>
			
		    </div>
					 <div id="latads">
                <div class="latest_ads border-radius">
                    <h2><?php _e('Latest listings', 'katrina'); ?></h2> 
                            <?php while(osc_has_items()) { ?>
                                <div class="item" >
									<?php if( osc_images_enabled_at_items() ) { ?>
										<div class="photo-item left">
										
											<?php if(osc_count_item_resources()) { ?>
											<a href="<?php echo osc_item_url(); ?>" class="img-item"><img src="<?php echo osc_resource_thumbnail_url(); ?>"  title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
											<?php } else { ?>
											<img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
											<?php } ?>
								
									</div>
										<?php } ?>
										<div class="text">
											<div class="space">
												<h3 class="itemxl">
													 <a href="<?php echo osc_item_url(); ?>"><strong><?php echo osc_highlight( strip_tags( osc_item_title() ) ); ?></strong></a>
												 </h3>
											</div>

											<span class="city"><?php echo osc_item_city(); ?> (<?php echo osc_item_region(); ?>)</span>
											<span class="date"><?php echo osc_format_date(osc_item_pub_date()); ?></span>
											
											
										</div>
										<div class="space-price">
													<p class="price"><?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled(osc_item_category_id()) ) { echo osc_item_formated_price(); ?>  <?php } ?></p>
													
											</div>
								</div>
                     <?php     } ?>
			
                    <?php if(osc_search_total_pages() > osc_max_results_per_page_at_search() ) { ?>
                    <p class="see_more_link"><a href="<?php echo osc_base_url(true).'&page=search&sUser[]='.osc_user_id(); ?>"><strong>See all offers »</strong></a></p>
                
                   <?php } ?>
      
			
				</div>
				</div>
		   </div>
		  
			     </div>

        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
