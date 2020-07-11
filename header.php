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
<div class="header-mobile">
		<header class="header-line-mobile-one">
			<div class="logo-mobile">
			<a id="logo" href="<?php echo osc_base_url(); ?>">
				<?php echo logo_header(); ?>
			</a>
			</div>
			<div class="itemnew-mobile">
			<?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
				<a class="button-additem" href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'katrina');?></a>
			<?php } ?>
			</div>
		</header>

		<?php if(!osc_is_publish_page()) { ?>
			<nav class="header-line-mobile-next">
				<div class="search-mobile tab<?php if(function_exists('watchlist_header')) { ?> s33<?php } ?>">
					<a class="button-searchm" href="<?= osc_search_url() ?>"><?php _e("Search", 'katrina');?></a>
				</div>
				<?php if(function_exists('watchlist_header')) {?>
				<div class="watchlist-mobile tab s33">
					 <?php watchlist_header();?>
				</div>
				 <?php } ?>
				<div class="user-items-mobile tab<?php if(function_exists('watchlist_header')) { ?> s33<?php } ?>">
					<a class="log-button" href="<?php echo osc_user_list_items_url(); ?>"><?php _e('My listings', 'katrina'); ?></a>
				</div>
			</nav>
		<?php } ?>


	</div>
<header id="header">
<div class="inside">
	<div class="left-block <?php if (!osc_is_home_page()) { ?>search-logo <?php } ?>">
		<a id="logo" href="<?php echo osc_base_url(); ?>">
		<?php echo logo_header(); ?>
		</a>
	 </div>

	 <?php if (!osc_is_home_page()) { ?>
		 <div id= "login_menu">
	 	 <ul>
            <?php if(osc_users_enabled()) { ?>
                <?php if( osc_is_web_user_logged_in() ) { ?>
				<?php if(!osc_is_search_page()) { ?>
					<li class="search_link logged" style="float: left;padding: 0;">
						<a class="log-button" href="<?php echo osc_search_url(); ?>"><?php _e('Search', 'katrina'); ?></a>
					</li>
				<?php } ?>
                    <li class="first logged">
						<a class="log-button"href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'katrina'); ?></a>
						<a class="log-button" href="<?php echo osc_user_alerts_url(); ?>"><?php _e('My alerts', 'katrina'); ?></a>
						<a class="log-button" href="<?php echo osc_user_list_items_url(); ?>"><?php _e('My listings', 'katrina'); ?></a>
						<?php if(function_exists('watchlist_header')) { watchlist_header(); } ?>
						<a href="<?php echo osc_user_profile_url(); ?>" title="<?= osc_esc_html(__('My personal info', 'katrina')); ?>"><i class="fa fa-cogs" aria-hidden="true"></i></a>
						<a class="logout" title="<?= osc_esc_html(__('Logout', 'katrina')); ?>" href="<?php echo osc_user_logout_url(); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </li>
                <?php } else { ?>
				<?php if(!osc_is_search_page()) { ?>
					<li class="search_link logged" style="float: left;padding: 0;">
						<a class="log-button" href="<?php echo osc_search_url(); ?>"><?php _e('Search', 'katrina'); ?></a>
					</li>
				<?php } ?>
					<li class="first logged">
                        <a class="log-button" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'katrina'); ?></a>
                        <?php if(osc_user_registration_enabled()) { ?>
                        <a class="log-button" href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'katrina'); ?></a>
						 <?php } ?>
					</li>
                <?php } } ?>
            <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                <?php osc_goto_first_locale(); ?>
                <li class="last with_sub">
                    <?php _e("Language", 'katrina'); ?>
                    <ul>
                        <?php $i = 0;  ?>
                        <?php while ( osc_has_web_enabled_locales() ) { ?>
                            <li <?php if( $i == 0 ) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code(); ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ); ?>"><?php echo osc_locale_name(); ?></a></li>
                            <?php $i++; ?>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
	</div>
        <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
		 	 <div id="publish">
	      		<a class="button-additem" href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'katrina');?></a>
			</div>
        <?php } ?>

	 <?php } ?>


	<?php if (osc_is_home_page()) { ?>
	  <?php if(osc_users_enabled()) { ?>
	   <div id="login_menu_main">
	   	   <div class="top-my">
	   	    <a class="block" href="<?php echo osc_user_dashboard_url(); ?>"><?php _e('My account', 'katrina'); ?></a>
		  </div>
	   <?php if( osc_is_web_user_logged_in() ) { ?>
	   <div class="first logged log_main">
                     <p class="userinfo-details"><?php echo osc_logged_user_email() ; ?></p>
					<span id="none">
						 <span class="tail"></span>
						<a class="log-button" href="<?php echo osc_user_alerts_url(); ?>" class="elem"><?php _e('My alerts', 'katrina'); ?></a>
						<a class="log-button" href="<?php echo osc_user_profile_url(); ?>" class="elem"><?php _e('My personal info', 'katrina'); ?></a>
						<a class="log-button" href="<?php echo osc_user_list_items_url(); ?>" class="elem"><?php _e('My listings', 'katrina'); ?></a>
						<?php if(function_exists('watchlist_header')) { watchlist_header(); } ?>
						<a class="log-button logout" href="<?php echo osc_user_logout_url(); ?>"><?php _e('Logout', 'katrina'); ?></a>
					</span>
        </div>
	    <?php } else { ?>
		 <div class="first logged log_main">
			<?php if(osc_user_registration_enabled()) { ?>
			<p class="userinfo-details"><?php _e('Login and register', 'katrina'); ?></p>
				<span id="none">
				<span class="tail"></span>
				<a class="log-button yellow" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'katrina'); ?></a>
				<a class="log-button" href="<?php echo osc_register_account_url(); ?>"><?php _e('Register account', 'katrina'); ?></a>
			</span>
			<?php } ?>
         </div>
         <?php } ?>
	    </div>
	 	 <div id="publish">
	        <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
	               <a class="button-additem" href="<?php echo osc_item_post_url_in_category(); ?>"><?php _e("Publish your ad for free", 'katrina');?></a>
	        <?php } ?>
		</div>

	   <?php } ?>
	 <?php } ?>
</div>
</header>
<div class="clear"></div>
<div class="container">
<!-- /header -->
<?php
    osc_show_widgets('header');

    $breadcrumb = osc_breadcrumb(' ', false);
    if( $breadcrumb != '') { ?>
    <div class="breadcrumb">
        <?php echo $breadcrumb; ?>
        <div class="clear"></div>
    </div>
<?php } ?>
<?php if(osc_show_flash_message()){ ?>
<div class="forcemessages-inline">
    <?php osc_show_flash_message(); ?>
</div>
<?php } ?>
