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
<?php

    osc_enqueue_style('fancybox', osc_assets_url('js/fancybox/jquery.fancybox.css'));
    osc_enqueue_script('jquery-validate');
    osc_register_script('jquery', osc_current_web_theme_js_url('jquery.js'));

    osc_enqueue_script('jquery');
    osc_enqueue_script('fancybox');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>

        <script type="text/javascript">
            $(document).ready(function(){
           	$("a.gallery").fancybox(
			{
          "padding" : 20,
          "imageScale" : false,
			"zoomOpacity" : false,
			"zoomSpeedIn" : 1000,
			"zoomSpeedOut" : 1000,
			"zoomSpeedChange" : 1000,
			"frameWidth" : 700,
			"frameHeight" : 600,
			"overlayShow" : true,
			"overlayOpacity" : 0.8,
			"hideOnContentClick" :false,
			"centerOnScroll" : false

			});

            });
        </script>
<script type="text/javascript">
$(document).ready(function() {
$('.click-tel').textToggle(".hide-tail","<?php echo osc_esc_js(__('ХХХХХХХХ', 'katrina')); ?>");
$('.click-ema').textToggle(".hide-ema","<?php echo osc_esc_js(__('ХХХХ@ХХХХ', 'katrina')); ?>");
});
</script>
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<span itemscope itemtype="http://schema.org/Product">
<meta itemprop="name" content="<?php echo osc_esc_html(osc_item_title()); ?>" />
<meta itemprop="description" content="<?php echo osc_esc_html(osc_highlight(osc_item_description(), 500)); ?>" />
<?php if(osc_count_item_resources() > 0) { ?><meta itemprop="image" content="<?php echo osc_resource_url(); ?>" /><?php } ?>
</span>
</head>
<body class="item-page">
	<?php osc_current_web_theme_path('header.php'); ?>
	</div>
	<div class="shad">
	<div class="wrapper">
		<div class="block_tt border-radius">
				<div class="item_title"><h1><?php echo osc_item_title(); ?></h1></div>
				<div class="stat_item">
						<span> <strong><?php echo osc_item_views(); ?></strong>, <?php _e('today', 'katrina'); ?>
						<strong><?php if (item_views_today() >= 1) { echo '+'; } ?><?php echo item_views_today(); ?></strong>
						</span>
						<i class="post_views_icon" title="<?= osc_esc_html(__('views', 'katrina')); ?>"></i>


				</div>
		</div>
        <div class="content item" id="itemm">

            <div id="main" class="left rel">
			<div class="offercontentinner offer__innerbox">
			<?php if(osc_item_is_premium()) { ?><span class="premium_item"><i class="fa fa-star-o" aria-hidden="true"></i> <?php _e("Premium", "katrina"); ?></span>  <?php } ?>



       <?php if( osc_images_enabled_at_items() ) { ?>
            <?php if( osc_count_item_resources() == 1 ) { ?>
            <div id="photos" >
                <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
                      <a id="all_photo" class="gallery" href="<?php echo osc_resource_url(); ?>" rel="image_group" title="<?php _e('Image', 'katrina'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
        							<img src="<?php echo osc_resource_url(); ?>" class="all-img one" alt="<?php echo osc_esc_html(osc_item_title()); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>" /> </a>
                  <?php } ?>
              </div>
			   <?php } else if ( osc_count_item_resources() > 1 ) { ?>
				<div id="photos" class="photoss">
					<?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
						  <a id="all_photo" class="gallery" href="<?php echo osc_resource_url(); ?>" rel="image_group" title="<?php _e('Image', 'katrina'); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>">
										<img src="<?php echo osc_resource_url(); ?>" class="all-img" alt="<?php echo osc_esc_html(osc_item_title()); ?>" title="<?php echo osc_esc_html(osc_item_title()); ?>" /> </a>
					  <?php } ?>
				</div>
              <?php } else { ?>
              <div id="photos">
                  <img class="stand" src="<?php echo osc_current_web_theme_url('images/no_photo.png'); ?>" title="" alt="" />
              </div>
            <?php } } ?>
				<div class="offer-titlebox">
							<div class="offer-titlebox__details">
								<span class="show-map-link"><i class="fa fa-map-marker" aria-hidden="true"></i>
									<?php if ( osc_item_country() != "" ) { ?><?php echo osc_item_country(); ?><?php } ?>
									<?php if ( osc_item_region() != "" ) { ?> <?php echo osc_item_region(); ?><?php } ?>
									<?php if ( osc_item_city() != "" ) { ?><?php echo osc_item_city(); ?><?php } ?>
								</span >
								 <?php if (osc_item_mod_date() == '') { ?>

                  <span title="<?php echo osc_esc_html(osc_format_date(osc_item_pub_date())); ?>"> <i class="fa fa-calendar-o" aria-hidden="true"></i> <?php _e('Published', 'katrina'); ?> <?php echo osc_format_date( osc_item_pub_date()); ?></span>
                <?php } else { ?>
                  <span title="<?php echo osc_esc_html(osc_format_date(osc_item_mod_date())); ?>"> <i class="fa fa-calendar-o" aria-hidden="true"></i> <?php _e('Modified', 'katrina'); ?> <?php echo osc_format_date( osc_item_mod_date()); ?></span>
                <?php } ?>

						<span><?php _e('ID', 'katrina'); ?> #<?php echo osc_item_id(); ?></span>

				</div>
                <div id="description" class="clr descriptioncontent">
				   <?php osc_run_hook('item_detail', osc_item() ); ?>
                    <p><?php echo osc_item_description(); ?></p>
                    <div id="custom_fields">
                        <?php if( osc_count_item_meta() >= 1 ) { ?>
                            <br />
                            <div class="meta_list">
                                <?php while ( osc_has_item_meta() ) { ?>
                                    <?php if(osc_item_meta_value()!='') { ?>
                                        <div class="meta">
                                            <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>


                   	 </div>


        <div class="share">
          <?php osc_reset_resources(); ?>
		      <?php /*
			<a class="social vk" href="http://vk.com/share.php?url=<?=  osc_item_url(); ?>" title="<?= osc_esc_html(__('Share on Vkontakte', 'katrina')); ?>" target="_blank"><i class="fa fa-vk"></i></a>
			<a class="social ok" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=  osc_item_url(); ?>&st." title="<?=  osc_esc_html(__('Share on Ok', 'katrina')); ?>" target="_blank"><i class="fa fa-odnoklassniki-square"></i></a> **/ ?>
          <a class="social facebook" title="<?= osc_esc_html(__('Share on Facebook', 'katrina')); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo osc_item_url(); ?>">
		  <i class="fa fa-facebook-square"></i></a>
          <a class="social google" title="<?=  osc_esc_html(__('Share on Google Plus', 'katrina')); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo osc_item_url(); ?>">
		  <i class="fa fa-google-plus-square"></i></a>
          <a class="social twitter" title="<?=  osc_esc_html(__('Share on Twitter', 'katrina')); ?>" target="_blank" href="https://twitter.com/home?status=<?php echo osc_esc_html(osc_item_title()); ?>">
		  <i class="fa fa-twitter-square"></i></a>
		 <p class="watchlist"> <?php if(function_exists('watchlist')) { watchlist(); } ?></p>

        </div>
                </div>

				      </div>
                  <div class="tabs" id="contact" >
					<?php if( !osc_item_is_expired () ) { ?>
                        <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
	                           <?php if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
	                              <input id="tab1" type="radio" name="tabs" checked>
                                  <label for="tab1"><?php _e("Contact publisher", 'katrina'); ?></label>
		                         <?php } ?>
                         <?php } ?>
                    <?php } ?>
					<?php if( osc_comments_enabled() ) { ?>
	                   <input id="tab2" type="radio" name="tabs" >
                       <label for="tab2"><?php _e('Comments', 'katrina'); ?>
	                      <?php if(osc_count_item_comments() >0){ ?>(<?= (osc_count_item_comments()) ?>)   <?php } ?>
                        </label>
					<?php } ?>
					<input id="tab3" type="radio" name="tabs">
					<label for="tab3"><?php _e('Send to a friend', 'katrina'); ?></label>
                    <ul id="error_list"></ul>
               <section id="content-tab1">
				<p>
				<?php if( !osc_item_is_expired () ) { ?>
                        <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
                            <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
						 <div id="contact" class="contact_item">
                    <?php if( osc_item_is_expired () ) { ?>
                        <p>
                            <?php _e("The listing is expired. You can't contact the publisher.", 'katrina'); ?>
                        </p>
                    <?php } else if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) { ?>
                        <p>
                            <?php _e("It's your own listing, you can't contact the publisher.", 'katrina'); ?>
                        </p>
                    <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
                        <p>
                            <?php _e("You must log in or register a new account in order to contact the advertiser", 'katrina'); ?>
                        </p>
                        <p class="contact_button">
                            <strong><a href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'katrina'); ?></a></strong>
                            <strong><a href="<?php echo osc_register_account_url(); ?>"><?php _e('Register for a free account', 'katrina'); ?></a></strong>
                        </p>
                    <?php } else { ?>
                        <?php if( osc_item_user_id() != null ) { ?>
                            <p class="name"><?php _e('Name', 'katrina') ?>: <a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a></p>
                        <?php } else { ?>
                            <p class="name"><?php _e('Name', 'katrina') ?>: <?php echo osc_item_contact_name(); ?></p>
                        <?php } ?>

						 <?php if(osc_item_show_email()) { ?>
						    <p class="name">
                     <span class="hide-ema"><?php echo osc_item_contact_email(); ?></span>
					<a href="#" class="click-ema"><span class="textem"><?php _e('Show email', 'katrina'); ?></span></a>
					 </p>

                            <?php } ?>
                        <?php ContactForm::js_validation(); ?>
                        <form <?php if( osc_item_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form">
                            <?php osc_prepare_user_info(); ?>
                            <fieldset>
                                <label for="yourName"></label> <?php ContactForm::your_name(); ?>
                                <label for="yourEmail"></label> <?php ContactForm::your_email(); ?>
                                <label for="phoneNumber"></label> <?php ContactForm::your_phone_number(); ?>
                                <?php if( osc_item_attachment() ) { ?>
                                <label for="contact-attachment"><?php _e('Attachments', 'katrina') ; ?></label><?php ContactForm::your_attachment() ; ?>
                                <?php } ?>
                                <?php osc_run_hook('item_contact_form', osc_item_id()); ?>
                                <label for="message"></label> <?php ContactForm::your_message(); ?>
                                <input type="hidden" name="action" value="contact_post" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
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
                    <?php } ?>
                </div>
						<?php } } } ?>
        </p>
    </section>
	 <?php if( osc_comments_enabled() ) { ?>
    <section id="content-tab2">
        <p>

                    <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
                    <div id="comments">
						    <div>
                        <ul id="comment_error_list"></ul>
                        <?php CommentForm::js_validation(); ?>
                        <?php if( osc_count_item_comments() >= 1 ) { ?>
                            <div class="comments_list">
                                <?php while ( osc_has_item_comments() ) { ?>
                                    <div class="comment">
                                        <h3><strong><?php echo osc_comment_title(); ?></strong> <em><?php _e("by", 'katrina'); ?> <?php echo osc_comment_author_name(); ?>:</em></h3>
                                        <p><?php echo nl2br( osc_comment_body() ); ?> </p>
                                        <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                                        <p>
                                            <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?= osc_esc_html(__('Delete your comment', 'katrina')); ?>"><?php _e('Delete', 'katrina'); ?></a>


                                        </p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <div class="paginate" style="text-align: right;">
                                    <?php echo osc_comments_pagination(); ?>
                                </div>
                            </div>
                        <?php } ?>
							 </div>



                        <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
                            <fieldset>
                                <h3><?php _e('Leave your comment (spam and offensive messages will be removed)', 'katrina'); ?></h3>
                                <input type="hidden" name="action" value="add_comment" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                                <?php if(osc_is_web_user_logged_in()) { ?>
                                    <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                                    <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
                                <?php } else { ?>
                                    <label for="authorName"></label> <?php CommentForm::author_input_text(); ?><br />
                                    <label for="authorEmail"></label> <?php CommentForm::email_input_text(); ?><br />
                                <?php }; ?>
                                <label for="title"></label><?php CommentForm::title_input_text(); ?><br />
                                <label for="body"></label><?php CommentForm::body_input_textarea(); ?><br />
                                <button type="submit"><?php _e('Send', 'katrina'); ?></button>
                            </fieldset>
                        </form>
                    </div>

                    <?php } ?>

        </p>
    </section>
	  <?php } ?>
    <section id="content-tab3">
        <p>
          	  <div id="sent_friend" class="inner">
                <form id="sendfriend" name="sendfriend" action="<?php echo osc_base_url(true); ?>" method="post">
                    <fieldset>
                        <input type="hidden" name="action" value="send_friend_post" />
                        <input type="hidden" name="page" value="item" />
                        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                        <label><?php _e('Listing', 'katrina'); ?>: <a href="<?php echo osc_item_url( ); ?>"><?php echo osc_item_title(); ?></a></label><br />
                        <?php if(osc_is_web_user_logged_in()) { ?>
                            <input type="hidden" name="yourName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
                            <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
                        <?php } else { ?>
                            <label for="yourName"></label> <?php SendFriendForm::your_name(); ?> <br />
                            <label for="yourEmail"></label> <?php SendFriendForm::your_email(); ?> <br />
                        <?php }; ?>
                        <label for="friendName"></label> <?php SendFriendForm::friend_name(); ?> <br />
                        <label for="friendEmail"></label> <?php SendFriendForm::friend_email(); ?> <br />
                        <label for="message"></label> <?php SendFriendForm::your_message(); ?> <br />
                        <?php osc_show_recaptcha(); ?>
                        <br />
                        <button type="submit"><?php _e('Send', 'katrina'); ?></button>
                    </fieldset>
                </form>
				  <?php SendFriendForm::js_validation(); ?>
            </div>
		</p>
    </section>
</div>
		</div>
            <div id="sidebar" class="right rel">
			<div  class="offer-sidebar__inner offeractions">
			 <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
					<div class="inner">
						<p id="edit_item_view">
                            <strong>
                                <i class="fa fa-pencil" aria-hidden="true"></i> <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'katrina'); ?></a>
                            </strong>
                        </p>
					</div>
			<?php } ?>

					<?php if( osc_price_enabled_at_items() && osc_item_category_price_enabled() ) { ?>
					<div class="price-label">
						<span class="price"><?php echo osc_item_formated_price(); ?></span>
					</div>
					<?php } ?>
							<?php if ( osc_item_city_area() != "" ) { ?>
								<div class="contact-button link-phone">
								   <i class="fa fa-phone" aria-hidden="true"></i>
								   <span class="hide-tail"><?php echo osc_item_city_area(); ?></span>
									<a href="#" class="click-tel"><span class="textm"><?php _e('Show phone', 'katrina'); ?></span></a>

								</div>
							<?php } ?>

							<?php if( !osc_item_is_expired () ) { ?>
							<?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
                            <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
							<p class="contact_button" >
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
								<a href="#contact"><?php _e('Contact seller', 'katrina'); ?></a>
							</p>

                            <?php } ?>
							<?php } ?>
							<?php } ?>




					<div class="offer-sidebar__box">
							<div class="offer-user__profile">
							</div>
							<div class="offer-user__location">
										<div class="offer-user__address">
												<?php if (osc_item_city() != "") { ?>
												<?php echo osc_item_city(); ?>, <?php } ?>
												<?php if(osc_item_address() != "") { ?>
												<?php echo osc_item_address(); ?><?php } ?>
												  <?php if(function_exists('google_maps_location')){ ?>
												  <span class="showmap"><?php _e("Show on map", 'katrina'); ?><span><?php } ?>
										</div>
							</div>


										<div class="maps">
												<div class="inbox">
												<span class="close" style="display:none"></span>
													<div class="maplocitem">
													<?php osc_run_hook('location'); ?>
													</div>
												</div>
											</div>

						<div class="offer-user__details">
							<div class="offer-user__name">
							<a href="<?php echo osc_user_public_profile_url( osc_item_user_id() ); ?>" ><?php echo osc_item_contact_name(); ?></a>
							</div>
							<div class="offer-user__image">
								<?php if(osc_item_user_id() <> 0 and osc_item_user_id() <> '') { ?>
								<a href="<?php echo osc_user_public_profile_url(osc_item_user_id()); ?>" title="<?php _e('Check profile of this user', 'katrina'); ?>">
								<?php } ?>
								<?php if(function_exists('profile_picture_show')) { ?>
									<?php profile_picture_show(null, 'item', 200); ?>
								<?php } else {?>
								<img src="<?php echo osc_current_web_theme_url()?>/images/no_picture.jpg" width="" height="">
								<?php } ?>
								</a>
							</div>
						</div>
					</div>
					<div class="offer-sidebar__links">
						<p id="report">
								<strong><?php _e('Mark as', 'katrina'); ?></strong>
								<span class="closes_a">
									<a id="item_spam" href="<?php echo osc_item_link_spam(); ?>" rel="nofollow"><?php _e('spam', 'katrina'); ?></a>
									<a id="item_bad_category" href="<?php echo osc_item_link_bad_category(); ?>" rel="nofollow"><?php _e('misclassified', 'katrina'); ?></a>
									<a id="item_repeated" href="<?php echo osc_item_link_repeated(); ?>" rel="nofollow"><?php _e('duplicated', 'katrina'); ?></a>
									<a id="item_expired" href="<?php echo osc_item_link_expired(); ?>" rel="nofollow"><?php _e('expired', 'katrina'); ?></a>
									<a id="item_offensive" href="<?php echo osc_item_link_offensive(); ?>" rel="nofollow"><?php _e('offensive', 'katrina'); ?></a>
								</span>
						</p>
					</div>

			   <?php if( osc_get_preference('sidebar-300x250', 'katrina') != '') {?>
                <!-- sidebar ad 350x250 -->
                <div class="ads_300">
                    <?php echo osc_get_preference('sidebar-300x250', 'katrina'); ?>
                </div>
                <!-- /sidebar ad 350x250 -->
                <?php } ?>


				 </div>
            </div>
			<?php if (function_exists('related_ads_start')) {related_ads_start();} ?>
			  </div>

<script type="text/javascript">
$(document).ready(function() {

 jQuery(function($){
	$(document).mouseup(function (e){
		var div = $("");
		if (!div.is(e.target)
		    && div.has(e.target).length === 0) {
			div.hide();
			$("11").removeClass("11")
		}
	});
	});
});
 // scrollTop contact seller
$(document).ready(function() {
  $(".contact_button").on('click','a', '[href*="#"]', function(e){
  var fixed_offset = 100;
  $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
  e.preventDefault();
});

// Placeholder
$(document).ready(function() {
$("#itemm input#yourName, input#authorName").attr('placeholder', '<?php echo osc_esc_js(__('Your name', 'katrina')); ?>');
$("#itemm input#yourEmail, input#authorEmail").attr('placeholder', '<?php echo osc_esc_js(__('Your e-mail address', 'katrina')); ?>');
$("#itemm input#phoneNumber").attr('placeholder', '<?php echo osc_esc_js(__('Phone number', 'katrina')); ?>');
$("#itemm textarea#message").attr('placeholder', '<?php echo osc_esc_js(__('Message', 'katrina')); ?>');
$("#itemm input#title").attr('placeholder', '<?php echo osc_esc_js(__('Title', 'katrina')); ?>');
$("#itemm textarea#body").attr('placeholder', '<?php echo osc_esc_js(__('Comment', 'katrina')); ?>');
$("#itemm input#friendName").attr('placeholder', '<?php echo osc_esc_js(__('Your friend name', 'katrina')); ?>');
$("#itemm input#friendEmail").attr('placeholder', '<?php echo osc_esc_js(__('Your friends e-mail address', 'katrina')); ?>');
});

});
</script>

<script>jQuery(document).ready(function(){
  jQuery('.photoss').bxSlider({
    minSlides: 1,
	maxSlides: 1,
    pager: false, // отключаем индикатор количества слайдов
    nextText: '', // отключаем текст кнопки Next
    prevText: '' // отключаем текст кнопки Prev
  });
});</script>
</div>
</div>
<?php osc_current_web_theme_path('footer.php'); ?>
</body>
</html>
