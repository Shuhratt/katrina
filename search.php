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

        <?php if( osc_count_items() == 0 || Params::getParam('iPage') > 0 || stripos($_SERVER['REQUEST_URI'], 'search') )  { ?>
            <meta name="robots" content="noindex, nofollow" />
            <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
        <?php } ?>
    </head>
<?php
$result_country = osc_get_countries();
$placeholder=(count($result_country) == 1 ? osc_esc_html(__('Select a region...','katrina')) : osc_esc_html(__('Select your Country', 'katrina')) );
if(isset($_COOKIE['region']) && isset($_COOKIE['city']))
    $placeholder= Region::newInstance()->findByPrimaryKey($_COOKIE['region'])['s_name'];
if(isset($_COOKIE['city']))
    $placeholder= City::newInstance()->findByPrimaryKey($_COOKIE['city'])['s_name'];


?>
<?php $sQuery = __('Search in', 'katrina') . ' ' . osc_total_active_items() . ' ' .  __('listings', 'katrina');?>
<script type="text/javascript">
    var countries = <?php echo (count($result_country) == 1) ? 'false' : json_encode($result_country) ?>;
    var placeholders = {
        country: '<?php echo osc_esc_js(__('Select your Country', 'katrina')); ?>',
        region: '<?php echo osc_esc_js(__('Select a region', 'katrina')); ?>',
        city: '<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>'
    };
</script>
    <body>
        <?php osc_current_web_theme_path('header.php'); ?>
<!-- mobile  -->
<script type="text/javascript">
$(document).ready(function(){
		$('#filtr-mobile').click(function() {
			$("#tab-search-mobile").slideToggle();
	});
});
</script>
        <div class="mobile_bar">
            <div id="filtr-mobile" class="btnm">
            <i class="fa fa-sliders" aria-hidden="true"></i>
            <span><?php _e('Search', 'katrina'); ?></span>
            </div>
    	</div>
		<nav id="tab-search-mobile" style="display:none">
				<div>
                <div class="filters">
                    <form action="<?php echo osc_base_url(true); ?>" class="search nocsrf" method="get">
                        <input type="hidden" name="page" value="search" />
                        <input type="hidden" name="sOrder" value="<?php echo osc_esc_html(osc_search_order()); ?>" />
                        <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting(); echo osc_esc_html($allowedTypesForSorting[osc_search_order_type()]); ?>" />
                        <?php foreach(osc_search_user() as $userId) { ?>
                            <input type="hidden" name="sUser[]" value="<?php echo osc_esc_html($userId); ?>" />
                        <?php } ?>


                        <div class="row one_input">
							<span class="valuess border-radius">
                                <input type="text" name="sPattern" id="query" placeholder="<?php echo osc_esc_html(__($sQuery));  ?>" value="" />
                               	</span>

						</div>

						<fieldset class="box location">

            <?php $aCountries = Country::newInstance()->listAll(); ?>

						<div class="row" <?php if(count($aCountries) <= 1 ) {?>style="display:none;"<?php } ?>>
						  <h4><?php _e('Country', 'katrina') ; ?></h4>

						  <?php
							$s_country = Country::newInstance()->listAll();
							if(count($s_country) <= 1) {
							  $s_country = $s_country[0];
							}
						  ?>

						  <select id="countryId" name="sCountry">
							<option value=""><?php echo osc_esc_html(__('Select a country', 'katrina')); ?></option>

							<?php foreach ($aCountries as $country) {?>
							  <option value="<?php echo isset($country['pk_c_code']) ? $country['pk_c_code'] : ''; ?>" <?php if(Params::getParam('sCountry') <> '' && (Params::getParam('sCountry') == $country['pk_c_code'] or Params::getParam('sCountry') == $country['s_name']) or $s_country['pk_c_code'] <> '' && $s_country['pk_c_code'] == $country['pk_c_code']) { ?>selected="selected"<?php } ?>><?php echo osc_esc_html($country['s_name']) ; ?></option>

							  <?php
								if(Params::getParam('sCountry') <> '' && (Params::getParam('sCountry') == $country['pk_c_code'] or Params::getParam('sCountry') == $country['s_name']) or $s_country['pk_c_code'] <> '' && $s_country['pk_c_code'] == $country['pk_c_code']) {
								  $current_country_code = isset($country['pk_c_code']) ? $country['pk_c_code'] : '';
								}
							  ?>
							<?php } ?>
						  </select>
						</div>


						<?php
						  $current_country = Params::getParam('country') <> '' ? Params::getParam('country') : Params::getParam('sCountry');
						  if($current_country <> '') {
							$aRegions = Region::newInstance()->findByCountry($current_country_code);
						  } else {
							if(osc_count_countries() <= 1) {
							  $aRegions = Region::newInstance()->findByCountry($s_country['pk_c_code']);
							} else {
							  $aRegions = '';
							}
						  }
						?>

						<div class="row">
						  <h4><?php _e('Region', 'katrina') ; ?></h4>

						  <?php if(count($aRegions) >= 1 ) { ?>
							<select id="regionId" name="sRegion" <?php if(Params::getParam('sRegion') == '' && Params::getParam('region')) {?>disabled<?php } ?>>
							  <option value=""><?php osc_esc_html(__('Select a region', 'katrina')); ?></option>

							  <?php if(isset($aRegions) && !empty($aRegions) && $aRegions <> '' && count($aRegions) >= 1) { ?>
								<?php foreach ($aRegions as $region) {?>
								  <option value="<?php echo $region['pk_i_id']; ?>" <?php if(Params::getParam('sRegion') == $region['pk_i_id'] or Params::getParam('sRegion') == $region['s_name']) { ?>selected="selected"<?php } ?>><?php echo osc_esc_html($region['s_name']); ?></option>
								<?php } ?>
							  <?php } ?>
							</select>
						  <?php } else { ?>
							<input type="text" name="sRegion" id="sRegion-side" value="<?php echo Params::getParam('sRegion'); ?>" placeholder="<?php _e('Enter a region', 'katrina'); ?>" />
						  <?php } ?>
						</div>

						<?php
						  $current_region = Params::getParam('region') <> '' ? Params::getParam('region') : Params::getParam('sRegion');

						  if(!is_numeric($current_region) && $current_region <> '') {
							$reg = Region::newInstance()->findByName($current_region);
							$current_region = $reg['pk_i_id'];
						  }

						  if($current_region <> '' && !empty($current_region)) {
							$aCities = City::newInstance()->findByRegion($current_region);
						  } else {
							$aCities = '';
						  }
						?>

						<div class="row">
						  <h4><?php _e('City', 'katrina') ; ?></h4>

						  <?php if(count($aCities) >= 1 && !empty($aCities)) { ?>
							<select name="sCity" id="cityId" <?php if(Params::getParam('sCity') == '' && Params::getParam('city') == '') {?>disabled<?php } ?>>
							  <option value=""><?php osc_esc_html(__('Select a city', 'katrina')); ?></option>

							  <?php if(isset($aCities) && !empty($aCities) && $aCities <> '' && count($aCities) >= 1) { ?>
								<?php foreach ($aCities as $city) {?>
								  <option value="<?php echo $city['pk_i_id']; ?>" <?php if(Params::getParam('sCity') == $city['pk_i_id'] or Params::getParam('sCity') == $city['s_name']) { ?>selected="selected"<?php } ?>><?php echo osc_esc_html($city['s_name']); ?></option>
								<?php } ?>
							  <?php } ?>
							</select>
						  <?php } else { ?>
							<input type="text" name="sCity" id="sCity-side" value="<?php echo Params::getParam('sCity'); ?>" placeholder="<?php _e('Enter a city', 'katrina'); ?>" />
						  <?php } ?>
						</div>


					</fieldset>

						<?php osc_get_non_empty_categories(); ?>
                            <?php  if ( osc_count_categories() ) { ?>
                                <div class="row categories">
								 <h4><?php _e('Category', 'katrina') ; ?></h4>
                                    <div class="fix_width_cat">
								<?php  if ( osc_count_categories() ) { ?>
									<?php osc_cat_select('sCategory', osc_search_category_id(), __('Select a category', 'katrina')); ?>
								<?php  } ?>
									</div>
								</div>
                            <?php } ?>

					<fieldset class="box show_only row">
						<div class="price-checkboxes-box">
						<?php if( osc_price_enabled_at_items() ) { ?>
                            <h4><?php _e('Price', 'katrina') ; ?></h4>
                            <div class="two_input">

                                <input type="text" id="priceMin" name="sPriceMin" placeholder="<?php echo osc_esc_html(__('Price', 'katrina')); ?>, <?php echo osc_esc_html(__('Min', 'katrina')); ?>" value="<?php echo osc_esc_html(osc_search_price_min()); ?>" size="6" maxlength="6" /><i class="fa fa-arrows-h"></i>
                                <input type="text" id="priceMax" name="sPriceMax" placeholder="<?php echo osc_esc_html(__('Price', 'katrina')); ?>, <?php echo osc_esc_html(__('Max', 'katrina')); ?>" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" size="6" maxlength="6" />
                            </div>
						<?php } ?>
						</div>
					</fieldset>
						<?php if( osc_images_enabled_at_items() ) { ?>
                            <div class="checkboxes row">
								<input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked="checked"' : ''); ?> />
                                <label id="withPicture_lab" for="withPicture"><?php _e('Show only listings with pictures', 'katrina'); ?></label>
                            </div>
                        <?php } ?>

                        <button type="submit" class="searchlogo" id="yellow" title="<?= osc_esc_html(__('Search', 'katrina')); ?>"></button>


                    </form>

                </div>
			</div>
        </nav>
	<!-- end mobile  -->
        <div class="content list">
		<div id="sidebar">
                <div class="filters">

                    <form action="<?php echo osc_base_url(true); ?>" class="search"method="get" onsubmit="" class="nocsrf">
                        <input type="hidden" name="page" value="search" />
<input type="hidden" id="country" name="sCountry" value="<?php echo count($result_country) == 1 ? osc_esc_html($result_country[0]['pk_c_code']) : osc_esc_html($_COOKIE['country']) ?>">
<input type="hidden" id="region" name="sRegion" value="<?php if(isset($_COOKIE['region'])){ ?><?php echo osc_esc_html(__($_COOKIE['region'])); ?><?php } ?>">
<input type="hidden" id="city" name="sCity" value="<?php if(isset($_COOKIE['city'])){ ?><?php echo osc_esc_html(__($_COOKIE['city'])); ?><?php } ?>">
                        <input type="hidden" name="sOrder" value="<?php echo osc_esc_html(osc_search_order()); ?>" />
                        <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting(); echo osc_esc_html($allowedTypesForSorting[osc_search_order_type()]); ?>" />
                        <?php foreach(osc_search_user() as $userId) { ?>
                            <input type="hidden" name="sUser[]" value="<?php echo osc_esc_html($userId); ?>" />
                        <?php } ?>
                    <input type="hidden" class="sShowAs" id="sShowAs" name="sShowAs" value="<?php echo Params::getParam('sShowAs'); ?>" />

                    <div class="search-cat">
                            <div class="row one_input ">
							<span class="valuess border-radius">
                                <input type="text" name="sPattern" id="query" placeholder="<?php echo osc_esc_html(__($sQuery));  ?>" value="" />
                               	</span>

							</div>

					<fieldset class="box location">
						<div class="search-line border-radius">
							<div class="flex input_visibile border-radius">
								<div class="boxi icons">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <div class="boxi textlocation">
                  <span id = "location-selector" data-select="<?php echo (count($result_country) == 1 ? 'region' : 'country') ?>"><?php echo $placeholder;  ?></span>
                </div>
                <div class="boxi clearbox">
				          <span id="click-val" title="<?= osc_esc_html(__('Clear box', 'katrina')); ?>"> <i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
							</div>
              <div class="contenting">
    					    <div id="items-place" class="regionselect"></div>
              </div>
						</div>

					<?php if(osc_get_preference('cat_search_katrina', 'katrina') == 'select'){ ?>
						<?php osc_get_non_empty_categories(); ?>
              <?php  if ( osc_count_categories()) { ?>
                  <div class="row categories">
                      <div class="fix_width_cat">
									<?php osc_cat_select('sCategory', osc_search_category_id(), __('Select a category', 'katrina')); ?>
									</div>
								</div>
              <?php } ?>
			       <?php } else { ?>
								<?php osc_get_non_empty_categories(); ?>
								<?php  if ( osc_count_categories() ) { ?>
                  <div class="row categories">
									<?php $selected = ""; ?>
									<?php osc_cat_select_katrina('sCategory',$selected); ?>
								</div>
            <?php } ?>
					<?php } ?>

					</fieldset>
					</div>
					<fieldset class="box show_only">
						<div class="price-checkboxes-box">
						<?php if( osc_price_enabled_at_items() ) { ?>
                            <div class="two_input">

                                 <input type="text" id="priceMin" name="sPriceMin" placeholder="<?php echo osc_esc_html(__('Price', 'katrina')); ?>, <?php echo osc_esc_html(__('Min', 'katrina')); ?>" value="<?php echo osc_esc_html(osc_search_price_min()); ?>" size="6" maxlength="6" /><i class="fa fa-arrows-h"></i>
                                <input type="text" id="priceMax" name="sPriceMax" placeholder="<?php echo osc_esc_html(__('Price', 'katrina')); ?>, <?php echo osc_esc_html(__('Max', 'katrina')); ?>" value="<?php echo osc_esc_html(osc_search_price_max()); ?>" size="6" maxlength="6" />
                            </div>
						<?php } ?>
						</div>
					</fieldset>
						<?php if( osc_images_enabled_at_items() ) { ?>
                            <div class="checkboxes">
								<input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked="checked"' : ''); ?> />
                                <label id="withPicture_lab" for="withPicture"><?php _e('Show only listings with pictures', 'katrina'); ?></label>
                            </div>
                        <?php } ?>

						<div class="filter_plugin">
                      	<?php if(osc_search_category_id()) {
                                osc_run_hook('search_form', osc_search_category_id());
                            } else {
                                osc_run_hook('search_form');
                            }?>
						</div>
                        <button type="submit" class="searchlogo" id="yellow" title="<?= osc_esc_html(__('Search', 'katrina')); ?>"></button>
                    </form>
					<span class="circl"></span>
                </div>
						<div class="sidebar-bottom">
							<div class="search_num"><?php $search_number = katrina_search_number();printf(__('%1$d - %2$d of %3$d listings', 'katrina'), $search_number['from'], $search_number['to'], $search_number['of']); ?> </div>
							<div class="alert"><?php osc_alert_form(); ?></div>
						</div>
        </div>


            <div id="main">
                <div class="ad_list">
                    <div id="list_head">
						<ul>
							<li><?php foreach(get_subcategoriesKtr() as $subcat) { echo "<a href='".$subcat["url"]."'>".$subcat["s_name"]." <span>(".get_category_num_items($subcat).")</span> </a>" ; } ?> </li>
						</ul>
					</div>
                    <div class="inner">

                            <p class="see_by">
                                <span><?php _e('Sort by', 'katrina'); ?>:</span>
                                <?php $i = 0; ?>
                                <?php $orders = osc_list_orders();
                                foreach($orders as $label => $params) {
                                    $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                                    <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                                        <a class="current" href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a>
                                    <?php } else { ?>
                                        <a class="sort_n" href="<?php echo osc_esc_html(osc_update_search_url($params)); ?>"><?php echo $label; ?></a>
                                    <?php } ?>
                                    <?php if ($i != count($orders)-1) { ?>

                                    <?php } ?>
                                    <?php $i++; ?>
                                <?php } ?>
                            </p>
							 <span class="doublebutton">

							<?php if(katrina_show_as() == 'list'){
								$buttonClass = 'active';
								$buttanClass = 'deactive'; } ?>
							<?php if(katrina_show_as() == 'gallery'){
									$buttanClass = 'active';
									$buttonClass = 'deactive'; } ?>

							   <a href="<?php echo osc_esc_html(osc_update_search_url(array('sShowAs'=> 'list'))); ?>" class="list-button <?php echo $buttonClass; ?>" data-class-toggle="listing-grid" data-destination="#listing-card-list"><i class="fa fa-list" aria-hidden="true"></i><span><?php _e('List','katrina'); ?></span></a>
							   <a href="<?php echo osc_esc_html(osc_update_search_url(array('sShowAs'=> 'gallery'))); ?>" class="grid-button <?php echo $buttanClass; ?>" data-class-toggle="listing-grid" data-destination="#listing-card-list"><i class="fa fa-th" aria-hidden="true"></i><span><?php _e('Grid','katrina'); ?></span></a>
							</span>
                    </div>
                </div>
                    <?php if(osc_count_items() == 0) { ?>
                        <p class="empty" ><?php printf(__('There are no results matching "%s"', 'katrina'), osc_search_pattern()); ?></p>
                    <?php } else { ?>
                        <?php osc_run_hook('search_ads_listing_top'); ?>
                        <?php require(katrina_show_as() == 'list' ? 'search_list.php' : 'search_gallery.php'); ?>
                        <div class="paginate" >
                        <?php echo osc_search_pagination(); ?>
                        </div>
                    <?php } ?>

                <div class="clear"></div>
					<?php osc_get_latest_searches() ?>
					  <?php if(osc_count_latest_searches() > 0) { ?>
						<div id="latest-search">
						  <div class="inside">
							<span><?php _e('Recent Searches', 'katrina'); ?>:</span>

							<?php while( osc_has_latest_searches() ) { ?>
							  <a href="<?php echo osc_search_url(array('page' => 'search', 'sPattern' => osc_latest_search_text())); ?>"><?php echo osc_latest_search_text(); ?></a>
							<?php } ?>
						  </div>
						</div>
					  <?php } ?>
					<div class="block_loc_search">
							<?php if (osc_count_list_countries()== 1 && osc_count_list_regions() > 1) { ?>
							 <h3><strong><?php _e("Regions", 'katrina'); ?></strong></h3>

									<div class="ul_location_search">
											<ul>
												<?php while (osc_has_list_regions()) { ?>
													<li>
													<a href="<?php echo osc_search_url(array('sRegion' => osc_list_region_id())); ?>"><span><?php echo osc_list_region_name(); ?></span></a> (<?php echo osc_list_region_items(); ?>)
													</li>
												 <?php } ?>
											</ul>
									</div>

							<?php } else if (osc_count_list_countries()== 1 && osc_count_list_regions() == 1) { ?>
				<?php View::newInstance()->_exportVariableToView('list_cities', CityStats::newInstance()->listCities(XX, ">", "items DESC")); ?>
					<h3><strong><?php _e("Cities", 'katrina'); ?></strong></h3>
							<div class="ul_location_search">
											<ul>
											<?php while(osc_has_list_cities()) { ?>

												<li><a href="<?php echo osc_search_url(array('sCity' => osc_list_city_name()));?>"><?php echo osc_list_city_name();?></a> <em>(<?php echo osc_list_city_items();?>)</em></li>
											<?php } ?>

											</ul>
										</div>

							<?php } ?>

					</div>
            </div>
        </div>
        </div>
<script type="text/javascript">
    $(function() {
		function log( message ) {
		$( "<div/>" ).text( message ).prependTo( "#log" );
		$( "#log" ).attr( "scrollTop", 0 );
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('#click-val').click(function() {
var date = new Date(new Date().getTime() );
document.cookie = "country=''; path=/; expires=" + date.toUTCString();
document.cookie = "region=''; path=/; expires=" + date.toUTCString();
document.cookie = "city=''; path=/; expires=" + date.toUTCString();
location.reload();
	});

});
</script>
<script type="text/javascript">

    function locationinit() {
        type = 'country';
        if ($('#region').val() != '' || countries == false)
            type = 'region';

        if ($('#city').val() != '')
            type = 'city';


        $('#location-selector').attr('data-select', type);
        $('#items-place').on('click', 'span#back-link', function (event) {
            dtype = $(this).attr('data-target');
            if (dtype == 'city') {
                type = 'region';
            } else if (dtype == 'region' && country !== false) {
                type = 'country';
            } else {
                type = dtype;
            }
            $('#location-selector').html(placeholders[type]);

            var today = new Date();
            var date = today.getFullYear() + 1;
            //~ document.cookie = dtype + '=; path=/; expires=' + date.toUTCString();
            setCookie(dtype, '', {path: '/', expires: 365 * 24 * 3600});

            renderItems(type);
        });

        $('#items-place').on('click', 'span#link', function (event) {
            e = $(this);
            render = true;
            dtype = e.data('target');
            if (dtype == 'region') {
                type = 'city';
                $('#region').val(e.data('id'));
            } else if (dtype == 'country') {
                type = 'region';
                $('#country').val(e.data('id'));
            } else if (dtype == 'city') {
                type = 'city';
                $('#city').val(e.data('id'));
                render=false;
            } else {
                return null;
            }
            $('#location-selector').html(e.children('strong').html());
            $('#location-selector').attr('data-select', type);
            //$('#items-place').hide();
            //~ document.cookie = dtype + '=' + e.data('id') + '; path=/; expires=' + date.toUTCString();
            setCookie(dtype, e.data('id'), {path: '/', expires: 365 * 24 * 3600});

            if(render==true)
                renderItems(type);
            else
                $('#items-place').hide();

        });
        $('#location-selector').click(function (event) {
            type = $(this).attr('data-select');
            renderItems(type);
        });
    }

    function setCookie(name, value, options) {
      options = options || {};

      var expires = options.expires;

      if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
      }
      if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
      }

      value = encodeURIComponent(value);

      var updatedCookie = name + "=" + value;

      for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
          updatedCookie += "=" + propValue;
        }
      }

      document.cookie = updatedCookie;
    }

    function renderItems(type) {
        if (type == 'region') {
            action = 'regions';
            value = 'countryId';
            id = $('#country').val();
        } else if (type == 'country') {
            return renderCountries();
        } else if (type == 'city') {
            action = 'cities';
            value = 'regionId';
            id = $('#region').val();
        } else {
            return null;
        }
        $.ajax({
            dataType: 'json',
            url: '<?= osc_base_url(true) ?>?page=ajax&action=' + action + '&' + value + '=' + id,
            beforeSend: function(){
              $("body").find('.search-line .fa-map-marker').removeClass('fa-map-marker').addClass('fa-spinner fa-spin').show();
            },
            complete: function(){
              $("body").find('.search-line .fa-spinner.fa-spin').removeClass('fa-spinner fa-spin').addClass('fa-map-marker').show();
              if (type == 'city') {
                  $("body").find('.search .regionselect').addClass('city');
              } else {
                  $("body").find('.search .regionselect.city').removeClass('city');
              }

            },
            success: function (data) {
                result = '<div class="flexin"><span id="back-link" data-target="' + type + '"><i class="fa fa-arrow-left" aria-hidden="true"></i> </span></span> </div>';
                for (key in data) {
                    result += '<span id="link" data-target="' + type + '" data-id="' + data[key].pk_i_id + '"><strong>' + data[key].s_name + '</strong></span>';
                }
                $('#items-place').html(result);
                $('#items-place').show();
            }
        })
    }
    function renderCountries() {
        result = '';
        for (key in countries) {
            result += '<span id="link" data-target="country" data-id="' + countries[key].pk_c_code + '"><strong>' + countries[key].s_name + '</strong></span>'

        }
        $('#items-place').html(result);
        $('#items-place').show();
    }
    jQuery(document).ready(locationinit);

	$(document).ready(function() {
	jQuery(function($){
	$(document).mouseup(function (e){
		var div = $("#items-place");
    var place = $(".flexin #all_region");
		if (!div.is(e.target)
		    && div.has(e.target).length === 0 || place.is(e.target)) {
			div.hide();
		}
	});
});
});
</script>
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

              $("#sRegion-side").before('<span><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></span><select name="sRegion" id="regionId" ></select></div>');
              $("#sRegion-side").remove();

              $("#sCity-side").before('<span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="sCity" id="cityId" ></select></div>');
              $("#sCity-side").remove();

              $("#regionId").val("");
              $("#uniform-regionId").find('span').text('<?php echo osc_esc_js(__('Select a region', 'katrina')); ?>');
            } else {

              $("#regionId").parent().before('<input placeholder="<?php echo osc_esc_js(__('Enter a region', 'katrina')); ?>" type="text" name="sRegion" id="sRegion-side" />');
              $("#regionId").parent().remove();

              $("#cityId").parent().before('<input placeholder="<?php echo osc_esc_js(__('Enter a city', 'katrina')); ?>" type="text" name="sCity" id="sCity-side" />');
              $("#cityId").parent().remove();

              $("#sCity-side").val('');
            }

            $("#regionId").html(result);
            $("#cityId").html('<option selected="selected" value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option>');
            $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');
          }
         });

       } else {

         // add empty select
         $("#sRegion-side").before('<div class="selector" id="uniform-regionId"><span><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></span><select name="sRegion" id="regionId" ><option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option></select></div>');
         $("#sRegion-side").remove();

         $("#sCity-side").before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="sCity" id="cityId" ><option value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option></select></div>');
         $("#sCity-side").remove();

         if( $("#regionId").length > 0 ){
           $("#regionId").html('<option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option>');
         } else {
           $("#sRegion-side").before('<div class="selector" id="uniform-regionId"><span><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></span><select name="sRegion" id="regionId" ><option value=""><?php echo osc_esc_js(__('Select a region', 'katrina')); ?></option></select></div>');
           $("#sRegion-side").remove();
         }

         if( $("#cityId").length > 0 ){
           $("#cityId").html('<option value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option>');
         } else {
           $("#sCity-side").parent().before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="sCity" id="cityId" ><option value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option></select></div>');
           $("#sCity-side").parent().remove();
         }

         $("#regionId").attr('disabled',true);
         $("#uniform-regionId").addClass('disabled');
         $("#uniform-regionId").find('span').text('<?php echo osc_esc_js(__('Select a region', 'katrina')); ?>');
         $("#cityId").attr('disabled',true);
         $("#uniform-cityId").addClass('disabled');
         $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');

      }
    });

    $("#regionId").live("change", function(){
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
              result += '<option selected="selected" value=""><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></option>';
              for(key in data) {
                result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
              }

              $("#sCity-side").before('<div class="selector" id="uniform-cityId"><span><?php echo osc_esc_js(__('Select a city', 'katrina')); ?></span><select name="sCity" id="cityId" ></select></div>');
              $("#sCity-side").remove();

              $("#cityId").val("");
              $("#uniform-cityId").find('span').text('<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>');
            } else {
              result += '<option value=""><?php echo osc_esc_js(__('No cities found', 'katrina')); ?></option>';
              $("#cityId").parent().before('<input type="text" placeholder="<?php echo osc_esc_js(__('Enter a city', 'katrina')); ?>" name="sCity" id="sCity-side" />');
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
      $("#uniform-cityId").addClass('disabled');
    } else {
      $("#cityId").attr('disabled',false);
      $("#uniform-cityId").removeClass('disabled');
    }

    if($("#countryId").length != 0) {
      if( $("#countryId").attr('value') == "")  {
        $("#regionId").attr('disabled',true);
        $("#uniform-regionId").addClass('disabled');
      }
    }

    //Make sure when select loads after input, span wrap is correctly filled
    $("#countryId").live('change', function() {
      $(this).parent().find('span').text($(this).find("option:selected" ).text());
    });

    $("#regionId").live('change', function() {
      $(this).parent().find('span').text($(this).find("option:selected" ).text());
    });

    $("#cityId").live('change', function() {
      $(this).parent().find('span').text($(this).find("option:selected" ).text());
    });

  });
</script>
<?php osc_current_web_theme_path('footer.php'); ?>
</body>
</html>
