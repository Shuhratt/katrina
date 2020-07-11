<div class="contarrr">
<div class="catico">
	<div class="col">
		<?php $i=0;?>
          <?php while ( osc_has_categories() ) { ?>
			<div class="dropdown-header maincategories-list ">
			     <div style="background:url(<?php echo osc_current_web_theme_url('images/category/') . osc_category_id() .'.png' ?>) no-repeat center center;" class="icos <?php echo osc_category_slug() ; ?>"></div>

				  <a class="bottom" data-id="<?php echo osc_category_id() ; ?>">
				  <span><?php echo osc_category_name() ; ?> </span>
				  </a>

                <?php View::newInstance()->_erase('subcategories'); ?>

				 <div class="dropdown-header-2 subcategories-list" data-subcategory="<?php echo osc_category_id() ; ?>" style="display:none">
					<div class="subcategories-title">
						<ul>
						<li class="one-category">
							<a href="<?php echo osc_search_category_url() ; ?>">
							<h2><?php _e("View all items", 'katrina'); ?></h2></a>
							 <span><?php _e("in", 'katrina'); ?> <?php echo osc_category_name(); ?> </span>
						</li>
						<?php if ( osc_count_subcategories() > 1 ) ; ?>
						<?php while ( osc_has_subcategories() ){?>
						<?php if( osc_category_total_items() > 1 ) { ?>
							<li class="sub-category">
							<i class="fa fa-chevron-right" aria-hidden="true"></i><a data-id="<?php echo osc_category_id() ; ?>" class="category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>" >
							<?php echo osc_category_name() ; ?> (<?php echo osc_category_total_items() ; ?>) </a></li>
							<?php } else { ?>
							<li class="sub-category">

							  <i class="fa fa-chevron-right" aria-hidden="true"></i><a class="category  <?php echo osc_category_slug() ; ?>" data-id="<?php echo osc_category_id() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?> (<?php echo osc_category_total_items() ; ?>)</a> </li>
						<?php } ?>
						<?php } ?>
							<li class="clear"></li>
						</ul>
					</div>
				</div>

			</div>
		   <?php } ?>
	</div>
</div>
</div>
