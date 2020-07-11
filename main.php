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
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
		<section id="searchmain">
		<?php osc_current_web_theme_path('inc.search.php'); ?>
		<?php if( osc_get_preference('text-header', 'katrina') != '') {?>
		<h1 class="text-top"><?php echo osc_get_preference('text-header', 'katrina'); ?></h1><?php } ?>
		<?php osc_current_web_theme_path('inc.main.php') ; ?>
        </section>
		<?php $numb_prem = osc_get_preference('premium_num_main', 'katrina');
          $numb_latest = osc_get_preference('latest_num_main', 'katrina');
     ?>
        <div class="content home">
			    <!-- Extra Premiums Block -->
						<?php if (osc_get_preference('premium_home', 'katrina') == 1) { ?>
						<div class="container">
							<?php if(osc_premium_is_inactive( ) > 0 ) { ?>
							<div id="latest" class="white prem">
								<span class="leftline"></span>
								<h2 ><?php _e('Premium listings', 'katrina'); ?></h2>
								<span class="rightline"></span>
								<div class="clear"></div>
							<?php osc_get_premiums($max = $numb_prem, true); ?>
							<?php while(osc_has_premiums()) { if(osc_premium_is_active() == 1){ ?>
						<div class="item premium border-radius" id="<?php if(function_exists('rupayments_get_class_color')){echo rupayments_get_class_color(osc_premium_id()); } ?>">
							<?php if( osc_images_enabled_at_items() ) { ?>
							<div class="photo-item">
							<?php if(osc_count_premium_resources()) { ?>
							<a href="<?php echo osc_premium_url(); ?>" class="thumb"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_esc_html(osc_premium_title()); ?>" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
							<?php } else { ?>
							<img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
								<?php } ?>
							</div>
						<?php } ?>
							 <div  class="text">
								<h3 class="normal">
									 <span style="float:left;"><a href="<?php echo osc_premium_url(); ?>"><?php echo osc_premium_title(); ?></a></span>
								 </h3>
								   <p class="price">
								  <?php echo osc_premium_formated_price(); ?>
								 </p>
									<?php if(function_exists('watchlist_prem')) { ?>
										<p class="watchlist"> <?php echo watchlist_prem();?> </p>
									<?php } ?>
							 </div >
						</div>
					<?php } } ?>

					<?php //View::newInstance()->_erase('items') ; ?>
					</div>
				  <?php } ?>
			</div>
     <?php } ?>

       <div class="container">
	       <div class="latest_ads">
	          <?php if(osc_get_preference('latest_home_katrina', 'katrina') == 'latest') { ?>
	          <!-- Latest Block -->
						<span class="leftline"></span>
						<h2><strong>  <?php _e('Latest Listings', 'katrina'); ?></strong></h2>
						<span class="rightline"></span>
							<div class="clear"></div>
							<?php if( osc_count_latest_items() == 0) { ?>
								<p class="empty"><?php _e('No Latest Listings', 'katrina'); ?></p>
							<?php } else { ?>
						    <?php while ( osc_has_latest_items()) { ?>
							<div class="item <?php if(osc_item_is_premium()) { ?>premium <?php } ?>border-radius">
							<?php if( osc_images_enabled_at_items() ) { ?>
							<div class="photo-item">
								 <?php if(osc_count_item_resources()) { ?>
									<a href="<?php echo osc_item_url(); ?>" class="thumb"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
								<?php } else { ?>
									<img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
								<?php } ?>

							</div>
							<?php } ?>
							<?php if(osc_item_is_premium()) { ?>
							<div class="prem-lab">
								<span class="premium"></span>
							</div >
							 <?php } ?>
							 <div class="text">
								 <h3 class="normal">
									 <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>
								 </h3>
									<p class="price"> <?php echo osc_item_formated_price(); ?> </p>
									<?php if(function_exists('watchlist')) { ?>
										<p class="watchlist"> <?php echo watchlist();?> </p>
									<?php } ?>
							 </div >
							</div>
							<?php } ?>
              <?php View::newInstance()->_erase('items'); } ?>

	           <?php } else { ?>

          <!-- Latest Listings Block Category -->
          <div class="home-container hc-latest">
            <div class="inner">
              <div id="latest" class="white">
                <?php osc_goto_first_category(); ?>
                  <?php while( osc_has_categories() ) { ?>
                    <?php $search_params['sCategory'] = osc_category_id(); ?>
                    <div id="ct<?php echo osc_category_id(); ?>" class="cat-tab">
                      <?php $cat_id = osc_category_id(); ?>
                      <div class="right">
                        <?php osc_query_item(array("category" => $cat_id, "results_per_page" => $numb_latest)); ?>
                        <?php if(osc_count_custom_items() > 0) { ?>
                          <div class="head">
                            <span class="leftline"></span>
                              <h2><a class="category_latest" href="<?php echo osc_search_url($search_params); ?>"><?php echo osc_category_name(); ?></a></h2>
                            <span class="rightline"></span>
                          </div>
                          <?php $c_i = 0; ?>
                          <div id="cat-items" class="dark">
                            <?php while( osc_has_custom_items() && $c_i < $numb_latest) { ?>
                              <div class="item <?php if(osc_item_is_premium()) { ?>premium <?php } ?>border-radius">
                              <?php if( osc_images_enabled_at_items() ) { ?>
                              <div class="photo-item">
                                 <?php if(osc_count_item_resources()) { ?>
                                  <a href="<?php echo osc_item_url(); ?>" class="thumb"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
                                <?php } else { ?>
                                  <img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
                                <?php } ?>
                              </div>
                              <?php } ?>
                              <?php if(osc_item_is_premium()) { ?>
                              <div class="prem-lab">
                                <span class="premium"></span>
                              </div >
                               <?php } ?>
                               <div class="text">
                                 <h3 class="normal">
                                   <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>
                                 </h3>
                                  <p class="price"> <?php echo osc_item_formated_price(); ?> </p>
                                  <?php if(function_exists('watchlist')) { ?>
                                    <p class="watchlist"> <?php echo watchlist();?> </p>
                                  <?php } ?>
                               </div >
                              </div>
                              <?php $c_i++; ?>
                            <?php } ?>
                          </div>
                        <?php } ?>
                    </div>
                     </div>
                  <?php } ?>

              </div>
            </div>
          </div>
        	<?php } ?>
          </div>

					<div class="clear"></div>
					<span onclick="location.href='<?php echo osc_search_show_all_url();?>';" class="see_more_link"><strong><?php _e("See all offers", 'katrina'); ?> &raquo;</strong></span>
					<?php if( osc_get_preference('homepage-728x90', 'katrina') != '') { ?>
					<!-- homepage ad 728x60-->
					<div class="ads_728">
						<?php echo osc_get_preference('homepage-728x90', 'katrina'); ?>
					</div>
					<!-- /homepage ad 728x60-->
					<?php } ?>
        </div>
		</div>

</div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>
