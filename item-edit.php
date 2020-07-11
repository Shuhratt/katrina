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

        <!-- only item-edit.php -->
        <?php ItemForm::location_javascript_new(); ?>
        <?php
        if(osc_images_enabled_at_items() && !katrina_is_fineuploader()) {
            ItemForm::photos_javascript();
        }
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
        <!-- end only item-edit.php -->
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
        <div class="content add_item">
            <h1><strong><?php _e('Update your listing', 'katrina'); ?></strong></h1>
            <ul id="error_list"></ul>
                <form name="item" action="<?php echo osc_base_url(true)?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <input type="hidden" name="action" value="item_edit_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id();?>" />
                    <input type="hidden" name="secret" value="<?php echo osc_item_secret();?>" />
                        <div class="box general_info">
                            <h2><?php _e('General Information', 'katrina'); ?></h2>
                            <div class="row">
                                <label><?php _e('Category', 'katrina'); ?> *</label>
                                <?php ItemForm::category_multiple_selects(null, null, __('Select a category', 'katrina')); ?>
                            </div>
							 <?php ItemForm::plugin_edit_item(); ?>
                            <div class="row">
                                <?php ItemForm::multilanguage_title_description(osc_get_locales()); ?>
                            </div>
                            <?php if( osc_price_enabled_at_items() ) { ?>
                            <div class="row price">
                                <label><?php _e('Price', 'katrina'); ?></label>
                                <?php ItemForm::price_input_text(); ?>
                                <?php ItemForm::currency_select(); ?>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if( osc_images_enabled_at_items() ) { ?>
                        <div class="box photos">
                            <?php
                            if(osc_images_enabled_at_items()) {
                                if(katrina_is_fineuploader()) {
                                    // new ajax photo upload
                                    ItemForm::ajax_photos();
                                }
                            } else { ?>
                            <h2><?php _e('Photos', 'katrina'); ?></h2>
                            <?php ItemForm::photos(); ?>
                            <div id="photos">
                                <?php if(osc_max_images_per_item()==0 || (osc_max_images_per_item()!=0 && osc_count_item_resources()<  osc_max_images_per_item())) { ?>
                                <div class="row">
                                    <input type="file" name="photos[]" />
                                </div>
                                <?php }; ?>
                            </div>
                            <a href="#" onclick="addNewPhoto(); uniform_input_file(); return false;"><?php _e('Add new photo', 'katrina'); ?></a>
                        <?php
                            }
                        }
                        ?>

                        <div class="box location">
                            <h2><?php _e('Listing Location', 'katrina'); ?></h2>
                            <?php if(count(osc_get_countries()) > 1) { ?>
                            <div class="row">
                                <label for="countryId"><?php _e('Country', 'katrina'); ?></label>
                                <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
                            </div>
                            <div class="row">
                                <label for="regionId"><?php _e('Region', 'katrina'); ?></label>
                                <?php ItemForm::region_select(osc_get_regions(osc_user_field('fk_c_country_code')), osc_user()); ?>
                            </div>
                            <?php
                                } else {
                                    $aCountries = osc_get_countries();
                                    $aRegions = osc_get_regions($aCountries[0]['pk_c_code']);
                                    ?>
                            <input type="hidden" id="countryId" name="countryId" value="<?php echo osc_esc_html($aCountries[0]['pk_c_code']); ?>"/>
                            <div class="row">
                                <label for="regionId"><?php _e('Region', 'katrina'); ?></label>
                                <?php ItemForm::region_select($aRegions, osc_user()); ?>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <label for="city"><?php _e('City', 'katrina'); ?></label>
                                <?php
										ItemForm::city_select(osc_get_cities(osc_user_region_id()), osc_user());

                                ?>
                            </div>
                            <div class="row">
                                <label for="city"><?php _e('Phone', 'katrina'); ?></label>
                                <?php ItemForm::city_area_text(osc_user()); ?>
                            </div>
                            <div class="row">
                                <label for="address"><?php _e('Address', 'katrina'); ?></label>
                                <?php ItemForm::address_text(osc_user()); ?>
                            </div>
                        </div>

                        <?php if( osc_recaptcha_items_enabled() ) {?>
                        <div class="box">
                            <div class="row">
                                <?php osc_show_recaptcha(); ?>
                            </div>
                        </div>
                        <?php }?>
                    <button class="itemFormButton" type="submit"><?php _e('Update', 'katrina'); ?></button>
                    <a href="javascript:history.back(-1)" class="go_back"><?php _e('Cancel', 'katrina'); ?></a>
                </fieldset>
            </form>
        </div>
		  </div>
        <?php osc_current_web_theme_path('footer.php'); ?>
    </body>
</html>
