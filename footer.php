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
$n_google_lik = osc_get_preference('google_lik', 'katrina');
$n_twitter_lik = osc_get_preference('twitter_lik', 'katrina');
$n_fac_lik = osc_get_preference('fac_lik', 'katrina');
 ?>
<!-- footer -->
<div id="footer">
    <div class="container">
    <div class="inner">
			<div id="logofoo">
			<a id="logo" href="<?php echo osc_base_url(); ?>">
				<?php echo logo_header(); ?>
			</a>
			</div>
			<div id="social_foot">
				<?php _e('We social networks', 'katrina'); ?> :
				<a class="ff" href="<?php echo $n_fac_lik; ?>"><i class="fa fa-facebook" aria-hidden="true"></i> <?php _e('Facebook', 'katrina'); ?></a>
				<a class="tf" href="<?php echo $n_twitter_lik; ?>"><i class="fa fa-twitter" aria-hidden="true"></i> <?php _e('Twitter', 'katrina'); ?></a>
				<a class="gf" href="<?php echo $n_google_lik; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i> <?php _e('Google+', 'katrina'); ?></a>
			</div>
			 <div class="clear"></div>
			<p class="text-bot"><?php if( osc_get_preference('text-footer', 'katrina') != '') {?>
                    <?php echo osc_get_preference('text-footer', 'katrina'); ?>
				    <?php } ?>
			</p>
		    <div class="static_page">
					<?php osc_reset_static_pages(); ?>
					<ul>
					<?php while( osc_has_static_pages() ) { ?>
						<li><a href="<?php echo osc_static_page_url(); ?>"><?php echo osc_static_page_title(); ?></a></li>
					<?php } ?>
					<ul>
			</div>
			<div class="сategory-block">
				  <div class="info">
					<?php osc_goto_first_category(); $c = 1; ?>
					<?php while(osc_has_categories() and $c <= 8) { ?>
					  <span><a href="<?php echo osc_search_category_url() ; ?>" title="<?php echo osc_esc_html(osc_category_name()); ?>"><?php echo ucfirst(osc_category_name());?></a></span>
					<?php $c++; } ?>
				  </div>
			</div>
			<div class="cop">
			  <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'katrina'); ?></a>
			<?php _e('Copyright', 'katrina'); ?> &copy; <?php echo date("Y"); ?>
			</div>
    </div>
  </div>
</div>
<!-- /footer -->
</div>
<!-- /container -->


<?php osc_run_hook('footer'); ?>
