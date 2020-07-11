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
                <h2><?php echo sprintf(__('Listings from %s', 'katrina') ,osc_logged_user_name()); ?></h2>
                <?php if(osc_count_items() == 0) { ?>
                    <h3><?php _e('No listings have been added yet', 'katrina'); ?></h3>
                <?php } else { ?>
                    
				<div class="all-con">
						 <a class="gridstat" href="<?php echo osc_user_list_items_url($active = '?itemType=active'); ?>">
						<span class="count"><?php echo Item::newInstance()->countItemTypesByUserID(osc_logged_user_id(), 'active'); ?>		</span>
						<i class="fa fa-check-circle" aria-hidden="true"></i>
					
						<p><?php _e('Active', 'katrina'); ?></p>
					
						</a>
						
						<a class="gridstat" href="<?php echo osc_user_list_items_url($pending = '?itemType=expired'); ?>">
						<span class="count"><?php echo Item::newInstance()->countItemTypesByUserID(osc_logged_user_id(), 'expired'); ?>	</span>
						<i class="fa fa-clock-o" aria-hidden="true"></i>
					
						<p><?php _e('Expired', 'katrina'); ?></p>
						
						</a>
						
						<a class="gridstat" href="<?php echo osc_user_list_items_url($expired = '?itemType=pending_validate'); ?>">
						<span class="count"><?php echo Item::newInstance()->countItemTypesByUserID(osc_logged_user_id(), 'pending_validate'); ?></span>
						<i class="fa fa-toggle-off" aria-hidden="true"></i>
					
						<p><?php _e('Not active', 'katrina'); ?></p>
					
						</a>
						
				</div>
						
						<?php while(osc_has_items()) { ?>
						
							<div class="dash-item active">
								<div class="listitem">
										<a href="<?php echo osc_item_url(); ?>"><?php echo osc_highlight(osc_item_title(), 25); ?></a>
										<p class="options"> <a href="<?php echo osc_item_edit_url(); ?>"><?php _e('Edit', 'katrina'); ?></a></p>
								</div>
							</div>
							<?php  } ?>
							
				 <?php } ?>			
			</div>
		</div>

      	</div>
       
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
