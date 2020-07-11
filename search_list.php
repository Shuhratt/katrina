<?php

$numb_prem_search = osc_get_preference('premium_num_search', 'katrina');
osc_get_premiums($max = $numb_prem_search, true);
    if(osc_count_premiums() > 0) {
?>
<div class="search-list prerium">
        <?php while(osc_has_premiums()) { ?>
            <div class="item premium" id="<?php if(function_exists('rupayments_premium_get_class_color')){echo rupayments_premium_get_class_color(osc_premium_id()); } ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                 <div class="photo-item left">
                     <?php if(osc_count_premium_resources()) { ?>
                        <a href="<?php echo osc_premium_url(); ?>" class="img-item"><img src="<?php echo osc_resource_thumbnail_url(); ?>" title="<?php echo osc_esc_html(osc_premium_title()); ?>" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
                    <?php } else { ?>
                        <img class="not-photo" src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
                    <?php } ?>
					   <?php if(osc_count_item_resources() >= 1) { ?>
      	          <span class="photo-icons-item"><i class="i i-photo"><?php echo osc_count_premium_resources(); ?></i></span>
      	                <?php } ?>
                 </div>
                 <?php } ?>
                <div class="text">
					<div class="space rel">
						<h3 class="itemxl">
							<a href="<?php echo osc_premium_url(); ?>"><strong><?php echo osc_highlight( strip_tags( osc_premium_title() ) ); ?></strong></a>
						</h3>
					</div>

						<p class="category">
							   <a class="category" href="<?php echo osc_search_url(array('sCategory' => osc_premium_category_id())); ?>"><?php echo osc_premium_category(); ?></a>
						</p>
						<span class="premium_search_list border-radius"><?php _e("Premium", "katrina"); ?></span>
						<span class="city"><?php echo osc_premium_city(); ?> (<?php echo osc_premium_region(); ?>)</span>
						<span class="date"><?php echo osc_format_date(osc_premium_pub_date()); ?></span>
				</div>
				<div class="space-price">
						<p class="price">
						<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled(osc_premium_category_id()) ) { echo osc_premium_formated_price(); ?>
						<?php // if( osc_price_enabled_at_items() && osc_item_category_price_enabled(osc_premium_category_id()) ) { echo osc_premium_formated_price().osc_premium_currency_symbol(); //?>  <?php } ?></p>
						<?php if(function_exists('watchlist_prem')) { ?>
						<p class="watchlist">
						   <?php watchlist_prem(); ?>
						</p>
						<?php } ?>
				</div>
             </div>

        <?php } ?>
</div>
<?php } ?>

<div class="search-list">

        <?php while(osc_has_items()) { $i++; ?>
            <div class="item <?php if(osc_item_is_premium()) { ?>premium<?php } ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                 <div class="photo-item left">

                     <?php if(osc_count_item_resources()) { ?>
                        <a href="<?php echo osc_item_url(); ?>" class="img-item"><img src="<?php echo osc_resource_thumbnail_url(); ?>"  title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
                    <?php } else { ?>
                        <img class="not-photo" src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
                    <?php } ?>
					 <?php if(osc_count_item_resources() >= 1) { ?>
      	          <span class="photo-icons-item"><i class="i i-photo"><?php echo osc_count_premium_resources(); ?></i></span>
      	                <?php } ?>
                 </div>
                 <?php } ?>
                 <div class="text">
				 	 	<div class="space">
							<h3 class="itemxl">
								 <a href="<?php echo osc_item_url(); ?>"><strong><?php echo osc_highlight( strip_tags( osc_item_title() ) ); ?></strong></a>
							 </h3>
						</div>
						<p class="category">
							   <a class="category" href="<?php echo osc_search_url(array('sCategory' => osc_item_category_id())); ?>"><?php echo osc_item_category(); ?></a>
						</p>

						<?php if(osc_item_is_premium()) { ?><span class="premium_search_list border-radius"><?php _e("Premium", "katrina"); ?></span>  <?php } ?>
						<span class="city"><?php echo osc_item_city(); ?> (<?php echo osc_item_region(); ?>)</span>
						<span class="date"><?php echo osc_format_date(osc_item_pub_date()); ?></span>
				</div>
				<div class="space-price">
						<p class="price"><?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled(osc_item_category_id()) ) { echo osc_item_formated_price(); ?>  <?php } ?></p>
						<p class="watchlist"> <?php if(function_exists('watchlist')) { watchlist(); } ?></p>
				</div>

             </div>
           <?php } ?>
</div>
<?php osc_run_hook('search_ads_listing_medium'); ?>
