<?php
$numb_prem_search = osc_get_preference('premium_num_search', 'katrina');
osc_get_premiums($max = $numb_prem_search, true);
    if(osc_count_premiums() > 0) {
?>
<div class="search-galery prerium">
        <?php while(osc_has_premiums()) { ?>
             <div class="item premium" id="<?php if(function_exists('rupayments_premium_get_class_color')){echo rupayments_premium_get_class_color(osc_premium_id()); } ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                 <div class="photo-item">
                     <?php if(osc_count_premium_resources()) { ?>
                        <a href="<?php echo osc_premium_url(); ?>" class="thumb"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_esc_html(osc_premium_title()); ?>" alt="<?php echo osc_esc_html(osc_premium_title()); ?>" /></a>
                    <?php } else { ?>
                        <img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
                    <?php } ?>
                </div>
                 <?php } ?>
                 <div class="text">
                    <h3 class="normal">
                         <span><a href="<?php echo osc_premium_url(); ?>"><?php echo osc_highlight(osc_premium_title(), 20); ?></a></span>

                     </h3>
                       <p class="price">
                      <?php echo osc_premium_formated_price(); ?>
                     </p>
					<?php if(function_exists('watchlist_prem')) { ?>
						<p class="watchlist"> <?php echo watchlist_prem();?> </p>
					<?php } ?>
					   <div class="prem-lab">
							 <span class="premium"></span>
							 </div >
                 </div>
             </div>

        <?php } ?>
</div>
<?php } ?>

<div class="search-galery">
        <?php while(osc_has_items()) { ?>
            <div class="item <?php if(osc_item_is_premium()) { ?>premium<?php } ?>" id="<?php if(function_exists('rupayments_get_class_color')){echo rupayments_get_class_color(osc_item_id()); } ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                <div class="photo-item">
                     <?php if(osc_count_item_resources()) { ?>
                        <a href="<?php echo osc_item_url(); ?>" class="thumb"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" height="56" title="<?php echo osc_esc_html(osc_item_title()); ?>" alt="<?php echo osc_esc_html(osc_item_title()); ?>" /></a>
                    <?php } else { ?>
                        <img src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
                    <?php } ?>
                   </div>
                 <?php } ?>
                 <div class="text">
                     <h3 class="normal">
                         <a href="<?php echo osc_item_url(); ?>"><?php echo osc_highlight(osc_item_title(), 20); ?></a>
                     </h3>


                      <p class="price"> <?php echo osc_item_formated_price(); ?> </p>
						<?php if(function_exists('watchlist')) { ?>
							<p class="watchlist"> <?php echo watchlist();?> </p>
						<?php } ?>
					   	<div class="prem-lab">
							  <?php if(osc_item_is_premium()) { ?><span class="premium"></span>  <?php } ?>
						</div >

                 </div >
             </div>

        <?php } ?>
</div>
