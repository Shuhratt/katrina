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
            <h1><strong><?php _e('User account manager', 'katrina'); ?></strong></h1>
            <div id="sidebar">
                <?php echo osc_private_user_menu(); ?>
            </div>
            <div id="main">
                <h2><?php _e('Your alerts', 'katrina'); ?></h2>
                <?php if(osc_count_alerts() == 0) { ?>
                    <h3><?php _e('You do not have any alerts yet', 'katrina'); ?>.</h3>
                <?php } else { ?>
                    <?php while(osc_has_alerts()) { ?>
                        <div class="userItem" >
                            <div class="buttons_alert"><?php _e('Alert', 'katrina'); ?> | <a onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can\'t be undone. Are you sure you want to continue?', 'katrina')); ?>');" href="<?php echo osc_user_unsubscribe_alert_url(); ?>"><?php _e('Delete this alert', 'katrina'); ?></a></div>
                            <div>

                            <?php while(osc_has_items()) { ?>

                                <div class="userItem">



									   <div class="blios">
									<?php if(osc_count_item_resources()) { ?>
										<a href="<?php echo osc_item_url(); ?>" class="thumb"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
									<?php } else { ?>
										<img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
									<?php } ?>
									</div>
                                    <div class="userItemData">
									<div><a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a></div>
									<?php _e('Publication date', 'katrina'); ?>: <?php echo osc_format_date(osc_item_pub_date()); ?><br />
                                    <?php if( osc_price_enabled_at_items() ) { _e('Price', 'katrina'); ?>: <?php echo osc_format_price(osc_item_price()); } ?>
                                    </div>
                                </div>

                            <?php } ?>
                            <?php if(osc_count_items() == 0) { ?>
                                    <br />
                                    0 <?php _e('Listings', 'katrina'); ?>
                            <?php } ?>
                            </div>
                        </div>
                        <br />
                    <?php } ?>
                <?php  } ?>
            </div>
        </div>
		  </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
