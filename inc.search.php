<?php
$result_country = osc_get_countries();
$placeholder=(count($result_country) == 1 ? osc_esc_html(__('Select a region...','katrina')) : osc_esc_html(__('Select your Country', 'katrina')) );
if(isset($_COOKIE['region']) && isset($_COOKIE['city']))
    $placeholder= Region::newInstance()->findByPrimaryKey($_COOKIE['region'])['s_name'];
if(isset($_COOKIE['city']))
    $placeholder= City::newInstance()->findByPrimaryKey($_COOKIE['city'])['s_name'];
?>

<?php echo Params::getParam('sCountry'); ?>
 <?php
      $sQuery = __('Search in', 'katrina') . ' ' . osc_total_items() . ' ' .  __('listings', 'katrina');
    ?>
<script type="text/javascript">
    var countries = <?= (count($result_country) == 1) ? 'false' : json_encode($result_country) ?>;
    var placeholders = {
        country: '<?php echo osc_esc_js(__('Select your Country', 'katrina')); ?>',
        region: '<?php echo osc_esc_js(__('Select a region', 'katrina')); ?>',
        city: '<?php echo osc_esc_js(__('Select a city', 'katrina')); ?>'
    };

</script>
<script>
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
<form action="<?php echo osc_base_url(true); ?>" method="get" class="search nocsrf" onsubmit="javascript:return doSearch();">
<input type="hidden" name="page" value="search" />
<input type="hidden" id="country" name="sCountry" value="<?php echo count($result_country) == 1 ? osc_esc_html($result_country[0]['pk_c_code']) : osc_esc_html($_COOKIE['country']) ?>">
<input type="hidden" id="region" name="sRegion" value="<?php if(isset($_COOKIE['region'])){ ?><?php echo osc_esc_html(__($_COOKIE['region'])); ?><?php } ?>">
<input type="hidden" id="city" name="sCity" value="<?php if(isset($_COOKIE['city'])){ ?><?php echo osc_esc_html(__($_COOKIE['city'])); ?><?php } ?>">
    <fieldset class="main">
        <div class="search-line border-radius">
		<div class="valuess border-radius"><input class="border-radius" type="text" name="sPattern" id="query" placeholder="<?php echo osc_esc_html(__($sQuery));  ?>" value="" /></div>
            <div class="flex input_visibile border-radius">
                <i class="fa fa-map-marker" aria-hidden="true"></i><span id = "location-selector" data-select="<?php echo (count($result_country) == 1 ? 'region' : 'country') ?>"><?php echo $placeholder;  ?></span>
		            <span id="click-val" title="<?php echo osc_esc_html(__('Clear box', 'katrina')); ?>"> <i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            <div id="items-place" class="regionselect"></div>
		         <span class="сlose"> </span>
        </div>
        <div class="search_button_main">
            <input class="clicc" type="submit" value=""/>
            <span class="icon"></span><span class="clic"><?php _e('Search', 'katrina'); ?></span>
        </div>

    </fieldset>
</form>
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
                result = '<div class="flexin"><span id="back-link" data-target="' + type + '"><i class="fa fa-arrow-left" aria-hidden="true"></i> </span>W</div>';
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
