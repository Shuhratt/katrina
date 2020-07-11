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
    osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />

        <?php
        if(osc_images_enabled_at_items() && !katrina_is_fineuploader()) {
            ItemForm::photos_javascript();
        }
        ?>
		<?php
          $user = osc_user();

          $usercab = array();
          $usercab['s_contact_name'] = osc_user_name();
          $usercab['s_contact_email'] = osc_user_email();
          $usercab['s_city_area'] = osc_user_city_area();
        ?>

        <script type="text/javascript">

            $(document).ready(function(){
                $('body').on("created", '[name^="select_"]',function(evt) {
                    $(this).uniform();
                });
                $('body').on("removed", '[name^="select_"]',function(evt) {
                    $(this).parent().remove();
                });
            });

            function uniform_input_file(){
                photos_div = $('div.photos');
                $('div',photos_div).each(
                    function(){
                        if( $(this).find('div.uploader').length == 0  ){
                            divid = $(this).attr('id');
                            if(divid != 'photos'){
                                divclass = $(this).hasClass('box');
                                if( !$(this).hasClass('box') & !$(this).hasClass('uploader') & !$(this).hasClass('row')){
                                    $("div#"+$(this).attr('id')+" input:file").uniform({fileDefaultText: fileDefaultText,fileBtnText: fileBtnText});
                                }
                            }
                        }
                    }
                );
            }

            setInterval("uniform_plugins()", 250);
            function uniform_plugins() {

                var content_plugin_hook = $('#plugin-hook').text();
                content_plugin_hook = content_plugin_hook.replace(/(\r\n|\n|\r)/gm,"");
                if( content_plugin_hook != '' ){

                    var div_plugin_hook = $('#plugin-hook');
                    var num_uniform = $("div[id*='uniform-']", div_plugin_hook ).size();
                    if( num_uniform == 0 ){
                        if( $('#plugin-hook input:text').size() > 0 ){
                            $('#plugin-hook input:text').uniform();
                        }
                        if( $('#plugin-hook select').size() > 0 ){
                            $('#plugin-hook select').uniform();
                        }
                    }
                }
            }
            <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
            $().ready(function(){
                $("#price").blur(function(event) {
                    var price = $("#price").prop("value");
                    <?php if(osc_locale_thousands_sep()!='') { ?>
                    while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
                        price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
                    }
                    <?php }; ?>
                    <?php if(osc_locale_dec_point()!='') { ?>
                    var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
                    if(tmp.length>2) {
                        price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
                    }
                    <?php }; ?>
                    $("#price").prop("value", price);
                });
            });
            <?php }; ?>


        </script>
			<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.limit.js'); ?>"></script>
        <!-- end only item-post.php -->
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>

        <div class="content add_item">

            <ul id="error_list"></ul>
            <form name="item" id="item_post"action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="item_add_post" />
                <input type="hidden" name="page" value="item" />

					<div class="box-add box">
                    <div class="general_info">
						<a href="javascript:history.back(-1)" class="go_back"><i class="fa fa-angle-left" aria-hidden="true"></i>
						<?php _e('Cancel', 'katrina'); ?></a>
					 <h1 class="border-bottom"><strong><?php _e('Publish a listing', 'katrina'); ?></strong></h1>
                        <h2><?php _e('General Information', 'katrina'); ?></h2>
                        <div class="row">
                            <label for="catId"><?php _e('Category', 'katrina'); ?> *</label>
                            <?php ItemForm::category_multiple_selects(null, null, __('Select a category', 'katrina')); ?>

                        </div>
						 <div id="post-hooks">
						<?php ItemForm::plugin_post_item(); ?>
						</div>



                        <div class="row">
                            <?php ItemForm::multilanguage_title_description(); ?>

                        </div>
                    </div>
					 <?php if( osc_images_enabled_at_items() ) { ?>
                    <div class="photos">
					 <h2><?php _e('Photos', 'katrina'); ?></h2>

                        <?php
                            if(osc_images_enabled_at_items()) {
                                if(katrina_is_fineuploader()) {
                                    // new ajax photo upload
                                    ItemForm::ajax_photos();
                                }
                            } else { ?>

                        <div id="photos">
                            <div class="row">

                                <input type="file" name="photos[]" />
                            </div>
                        </div>

                        <a href="#" onclick="addNewPhoto(); uniform_input_file(); return false;"><?php _e('Add new photo', 'katrina'); ?></a>

                        <?php } } ?>
						 <span class="text"><?php _e('You can upload up to', 'katrina'); ?> <?php echo osc_max_images_per_item(); ?> <?php _e('pictures per listing', 'katrina'); ?></span>
						 	</div>
                    <?php if( osc_price_enabled_at_items() ) { ?>
						<h2><?php _e('Price', 'katrina'); ?></h2>
                    <div class="row price">

                        <label for="price"><?php _e('Price', 'katrina'); ?></label>
						     <div class="controls" id="number">
                        <?php ItemForm::price_input_text(); ?>
                        <?php ItemForm::currency_select(); ?>
						 </div>
                    </div>
                    <?php } ?>


                    <div class="location">
                        <h2><?php _e('Listing Location', 'katrina'); ?></h2>
                        <?php if(count(osc_get_countries()) > 1) { ?>
                            <div class="row">
                                <label class="control-label" for="country"><?php _e('Country', 'katrina'); ?></label>
                                <div class="controls">
                                    <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="control-label" for="regionId"><?php _e('Region', 'katrina'); ?></label>
                                <div class="controls">
                                    <?php

                                        ItemForm::region_select(osc_get_regions(osc_user_field('fk_c_country_code')), osc_user());

                                    ?>
                                </div>
                            </div>
                            <?php
                            } else {
                                $aCountries = osc_get_countries();
                                $aRegions = osc_get_regions($aCountries[0]['pk_c_code']);
                                ?>
                            <input type="hidden" id="countryId" name="countryId" value="<?php echo osc_esc_html($aCountries[0]['pk_c_code']); ?>"/>
                            <div class="row">
                                <label class="control-label" for="region"><?php _e('Region', 'katrina'); ?></label>
                                <div class="controls">
                                  <?php

                                        ItemForm::region_select($aRegions, osc_user());

                                    ?>
                                </div>
                            </div>
                            <?php } ?>

                            <div class="row">
                                <label class="control-label" for="city"><?php _e('City', 'katrina'); ?></label>
                                <div class="controls">
                                    <?php ItemForm::city_select(osc_get_cities(osc_user_region_id()), osc_user()); ?>
                                </div>
                            </div>

                        <div class="row">
                            <label for="address"><?php _e('Address', 'katrina'); ?></label>
                            <?php ItemForm::address_text(osc_user()); ?>
                        </div>
                    </div>
                    <!-- seller info -->

                    <div class="box seller_info">
                        <h2><?php _e("Seller's information", 'katrina'); ?></h2>
                        <div class="row">
                            <label for="contactName"><?php _e('Name', 'katrina'); ?></label>
                            <?php ItemForm::contact_name_text($usercab); ?>
                        </div>
                        <div class="row">
                            <label for="contactEmail"><?php _e('E-mail', 'katrina'); ?> *</label>
                            <?php ItemForm::contact_email_text($usercab); ?>
                        </div>
						<div class="row">
                            <label for="city"><?php _e('Phone', 'katrina'); ?></label>
                            <?php ItemForm::city_area_text(osc_user($usercab)); ?>
                        </div>
                        <div class="row">
                            <div class="checkbox_add">
                                <?php ItemForm::show_email_checkbox(); ?>
								   <label id="showEmaillab" for="showEmail" style="width: 100%;"><?php _e('Show e-mail on the listing page', 'katrina'); ?></label>
                            </div>

                        </div>
                    </div>

                    <?php if( osc_recaptcha_items_enabled() ) {?>
                    <div class="box">
                        <div class="row">
                            <?php osc_show_recaptcha(); ?>
                        </div>
                    </div>
                    <?php }?>
                <div class="clear"></div>
                <button type="submit"><?php _e('Publish', 'katrina'); ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
				    </div>
            </form>


        </div>
		     </div>
			   <script>
    $(document).ready(function(){
      $("#countryId").live("change",function(){
        var pk_c_code = $(this).val();
        var url = '<?php echo osc_base_url(true)."?page=ajax&action=regions&countryId="; ?>' + pk_c_code;
        var result = '';

        if(pk_c_code != '') {
          $("#regionId").attr('disabled',false);
          $("#uniform-regionId").removeClass('disabled');
          $("#cityId").attr('disabled',true);
          $("#uniform-cityId").addClass('disabled');

          $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            success: function(data){
              var length = data.length;

              if(length > 0) {

                result += '<option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option>';
                for(key in data) {
                  result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
                }

                $("#region").before('<div class="selector" id="uniform-regionId"><span><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></span><select name="regionId" id="regionId" ></select></div>');
                $("#region").remove();

                $("#city").before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="cityId" id="cityId" ></select></div>');
                $("#city").remove();

                $("#regionId").val("");
                $("#uniform-regionId").find('span').text('<?php echo osc_esc_js(__('Select a region', 'katrina')); ?>');
              } else {

                $("#regionId").parent().before('<input placeholder="<?php echo osc_esc_js(__('Enter a region', 'katrina')); ?>" type="text" name="sRegion" id="region" />');
                $("#regionId").parent().remove();

                $("#cityId").parent().before('<input placeholder="<?php echo osc_esc_js(__('Enter a city', 'katrina')); ?>" type="text" name="sCity" id="city" />');
                $("#cityId").parent().remove();

                $("#city").val('');
              }

              $("#regionId").html(result);
              $("#cityId").html('<option selected value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option>');
              $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');
              $("#cityId").attr('disabled',true);
              $("#uniform-cityId").addClass('disabled');
            }
           });

         } else {

           // add empty select
           $("#region").before('<div class="selector" id="uniform-regionId"><span><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></span><select name="regionId" id="regionId" ><option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option></select></div>');
           $("#region").remove();

           $("#city").before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="cityId" id="cityId" ><option value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option></select></div>');
           $("#city").remove();

           if( $("#regionId").length > 0 ){
             $("#regionId").html('<option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option>');
           } else {
             $("#region").before('<div class="selector" id="uniform-regionId"><span><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></span><select name="regionId" id="regionId" ><option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option></select></div>');
             $("#region").remove();
           }

           if( $("#cityId").length > 0 ){
             $("#cityId").html('<option value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option>');
           } else {
             $("#city").parent().before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="cityId" id="cityId" ><option value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option></select></div>');
             $("#city").parent().remove();
           }

           $("#regionId").attr('disabled',true);
           $("#uniform-regionId").addClass('disabled');
           $("#uniform-regionId").find('span').text('<?php echo osc_esc_js(__('Select a region', 'katrina')); ?>');
           $("#cityId").attr('disabled',true);
           $("#uniform-cityId").addClass('disabled');
           $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');

        }
      });

      $("#regionId").live("change",function(){
        var pk_c_code = $(this).val();
        var url = '<?php echo osc_base_url(true)."?page=ajax&action=cities&regionId="; ?>' + pk_c_code;
        var result = '';

        if(pk_c_code != '') {

          $("#cityId").attr('disabled',false);
          $("#uniform-cityId").removeClass('disabled');

          $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            success: function(data){
              var length = data.length;
              if(length > 0) {
                result += '<option selected value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option>';
                for(key in data) {
                  result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
                }

                $("#city").before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="cityId" id="cityId" ></select></div>');
                $("#city").remove();

                $("#cityId").val("");
                $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');
              } else {
                result += '<option value=""><?php echo osc_esc_js(__('No cities found', 'katrina')); ?></option>';
                $("#cityId").parent().before('<input type="text" placeholder="<?php echo osc_esc_js(__('Enter a city', 'katrina')); ?>" name="sCity" id="city" />');
                $("#cityId").parent().remove();
              }
              $("#cityId").html(result);
            }
          });
        } else {
          $("#cityId").attr('disabled',true);
          $("#uniform-cityId").addClass('disabled');
          $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');
        }
      });

      if( $("#regionId").attr('value') == "")  {
        $("#cityId").attr('disabled',true);
        $("#city").attr('disabled',true);
        $("#uniform-cityId").addClass('disabled');
      }

      if($("#countryId").length != 0) {
        if( $("#countryId").attr('value') == "")  {
          $("#regionId").attr('disabled',true);
          $("#uniform-regionId").addClass('disabled');
        }
      }

      //Make sure when select loads after input, span wrap is correctly filled
      $(".row").on('change', '#cityId, #regionId', function() {
        $(this).parent().find('span').text($(this).find("option:selected" ).text());
      });


      //DISABLE NAME & EMAIL INPUTS FOR LOGGED IN USER
      $('.add_item .seller_info.logged input#contactName, .add_item .seller_info.logged input#contactEmail').prop('disabled', true);

    });
  </script>
<script type="text/javascript">

$(document).ready(function(){
$('.title').append('<div class="title_char"><span id="charsLefttitle"></span>&nbsp;<?php echo osc_esc_js(__('characters', 'katrina')); ?> </div>');
$('.description').append('<div class="descp_char"><span id="charsLeftdesc"></span>&nbsp;<?php echo osc_esc_js(__('characters', 'katrina')); ?></div>');
$('.description textarea').limit('<?php echo osc_esc_js(osc_max_characters_per_description()); ?>','#charsLeftdesc');
$('.title input').limit('<?php echo osc_esc_js(osc_max_characters_per_title()); ?>','#charsLefttitle');

$(".title input").attr('maxlength','<?php echo osc_esc_js(osc_max_characters_per_title()); ?>');
$(".description textarea").attr('maxlength', '<?php echo osc_esc_js(osc_max_characters_per_description()); ?>');

$("#item_post").validate({
       rules:{

            "title[<?php echo osc_current_user_locale(); ?>]":{
                required: true,
                minlength: 1,
                maxlength: <?php echo osc_max_characters_per_title(); ?>,
            },

            "description[<?php echo osc_current_user_locale(); ?>]":{
                required: true,
                minlength: 1,
                maxlength: <?php echo osc_max_characters_per_description(); ?>,
            },
			catId:{
				required: true,
				digits: true
            },
			 regionId:{
				required: true,
				digits: true
            },

			cityId:{
				required: true,
				digits: true
            },

			contactEmail:{
                required: true,
                email: true
            },
       },

       messages:{

            "title[<?php echo osc_current_user_locale(); ?>]":{
                required: '<?php echo osc_esc_js(__('This field is required.', 'katrina')); ?>',
                minlength: '<?php echo osc_esc_js(__('Name must have at least 1 character', 'katrina')); ?>',
                maxlength: '<?php echo osc_esc_js(__('Maximum number of characters for the name', 'katrina')); ?> <?php echo osc_max_characters_per_title(); ?>',
            },

            "description[<?php echo osc_current_user_locale(); ?>]":{
                 required: '<?php echo osc_esc_js(__('This field is required.', 'katrina')); ?>',
                minlength: ' <?php echo osc_esc_js(__('Password must have at least 1 character', 'katrina')); ?>',
                maxlength: ' <?php echo osc_esc_js(__('Maximum number of characters', 'katrina')); ?> <?php echo osc_max_characters_per_description(); ?>',
            },
			catId:{
				 required: '<?php echo osc_esc_js(__('This field is required.', 'katrina')); ?>',
			},
			regionId:{
                 required: '<?php echo osc_esc_js(__('This field is required.', 'katrina')); ?>',
            },
			cityId:{
                required: '<?php echo osc_esc_js(__('This field is required.', 'katrina')); ?>',

            },
			contactEmail:{
                required: '<?php echo osc_esc_js(__('This field is required.', 'katrina')); ?>',
				email: '<?php echo osc_esc_js(__('Invalid format of email address.', 'katrina')); ?>',

            },

       }

    });

});
</script>

        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
