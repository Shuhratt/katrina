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
            <div id="main">

                <h2><?php _e('Your listings', 'katrina'); ?> <a href="<?php echo osc_item_post_url(); ?>">+ <?php _e('Post a new listing', 'katrina'); ?></a></h2>
                <?php if(osc_count_items() == 0) { ?>
                    <h3><?php _e("You don't have any listings yet", 'katrina'); ?></h3>
                <?php } else { ?>
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

									<h3><a href="<?php echo osc_item_url(); ?>"><?php echo osc_highlight(osc_item_title(), 50); ?></a></h3>
									<div class="info_user_items">

                                    <?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?>
    									<span class="price">
    			                                 <?php echo osc_format_price(osc_item_price());?>
    									</span>
                                    <?php } ?>
									<div class="stat">

                                        <?php if(osc_item_is_active()) { echo '<span class="user-listing-active">'.__('Active', 'katrina').'</span>'; } else { echo '<span class="user-listing-inactive">'.__('Inactive', 'katrina').'</span>'; }; ?>
										 <?php if(osc_item_is_expired()) { echo '<span class="user-listing-expired">'.__('Expired', 'katrina').'</span>';}; ?>

                                        <?php if(osc_item_is_premium()) { echo '<span class="user-listing-premium">'.__('Premium', 'katrina').'</span>'; }; ?>
                                        <?php if(osc_item_is_spam()) { echo '<span class="user-listing-spam">'.__('Spam', 'katrina').'</span>'; }; ?>
										</div>
                                    <span class="date">
                                    <?php _e('Publication date', 'katrina'); ?>: <?php echo osc_format_date(osc_item_pub_date()); ?>,
									 <?php _e('Expiration date', 'katrina'); ?>: <?php echo osc_format_date(osc_item_dt_expiration()); ?>

                                    </span>
                                    <span class="options">
									<p class="edit">
                                      <i class="fa fa-pencil" aria-hidden="true"></i><a href="<?php echo osc_item_edit_url(); ?>"><?php _e('Edit', 'katrina'); ?></a>
                                        </p>
										<p class="delete">
										<i class="fa fa-ban" aria-hidden="true"></i>
                                        <a onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'katrina')); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'katrina'); ?></a>
										  </p>

                                    </span>
									  </div>

									<span class="views">
										<?php _e('views', 'katrina'); ?> (<?php echo osc_item_views(); ?> <?php _e('today', 'katrina'); ?> <?php if (item_views_today() >= 1) { ?>+ <?php } ?><?php echo item_views_today(); ?>)
									</span>

                            </div>



                    <?php } ?>
                    <br />
                    <div class="paginate" >
                    <?php for($i = 0; $i < osc_list_total_pages(); $i++) {
                        if($i == osc_list_page()) {
                            printf('<a class="searchPaginationSelected" href="%s">%d</a>', osc_user_list_items_url($i+1), ($i + 1));
                        } else {
                            printf('<a class="searchPaginationNonSelected" href="%s">%d</a>', osc_user_list_items_url($i+1), ($i + 1));
                        }
                    } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
		  </div>



        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
