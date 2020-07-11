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
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php echo meta_title(); ?></title>
<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
<?php if( meta_description() != '' ) { ?>
<meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" />
<?php } ?>
<?php if( function_exists('meta_keywords') ) { ?>
<?php if( meta_keywords() != '' ) { ?>
<meta name="keywords" content="<?php echo osc_esc_html(meta_keywords()); ?>" />
<?php } ?>
<?php } ?>
<?php if( osc_get_canonical() != '' ) { ?>
<link rel="canonical" href="<?php echo osc_get_canonical(); ?>"/>
<?php } ?>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Mon, 01 Jul 1970 00:00:00 GMT" />
<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<script type="text/javascript">
    var fileDefaultText = '<?php echo osc_esc_js( __('No file selected', 'katrina') ); ?>';
    var fileBtnText     = '<?php echo osc_esc_js( __('Choose File', 'katrina') ); ?>';
</script>

<?php
osc_enqueue_style('style', osc_current_web_theme_url('css/style.css'));
osc_enqueue_style('tabs', osc_current_web_theme_url('css/tabs.css'));
osc_enqueue_style('responsive', osc_current_web_theme_url('css/responsive.css'));
osc_enqueue_style('jquery-ui-datepicker', osc_assets_url('css/jquery-ui/jquery-ui.css'));
osc_register_script('jquery-uniform', osc_current_web_theme_js_url('jquery.uniform.js'), 'jquery');
osc_register_script('jquery.bxslider', osc_current_web_theme_js_url('jquery.bxslider.js'));
osc_register_script('jquery', osc_current_web_theme_js_url('jquery.js'));

osc_register_script('global', osc_current_web_theme_js_url('global.js'));

osc_enqueue_script('jquery');

osc_enqueue_script('jquery-ui');
osc_enqueue_script('jquery-uniform');
osc_enqueue_script('tabber');
osc_enqueue_script('global');
osc_enqueue_script('jquery.bxslider');
osc_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');

osc_run_hook('header');

?>
<?php $searchbar = osc_get_preference('searchbar', 'katrina');
		$but = osc_get_preference('button_search_main', 'katrina');
		$but_main_post = osc_get_preference('but_post_main', 'katrina');
		$but_gen_post = osc_get_preference('but_post_main', 'katrina');
		$se_bar = osc_get_preference('search_bar', 'katrina');
		$alert_but = osc_get_preference('alert_but', 'katrina');
		$back_us_lr = osc_get_preference('back_us_lr', 'katrina');
		$but_us_lr = osc_get_preference('but_us_lr', 'katrina');
		$but_itpost = osc_get_preference('but_itpost', 'katrina');
		$titl_bl = osc_get_preference('titl_bl', 'katrina');
		$phon_bl = osc_get_preference('phon_bl', 'katrina');
		$mes_bl = osc_get_preference('mes_bl', 'katrina');
{ ?>
 <style type="text/css">
       .search fieldset,   .home .see_more_link {background: <?= $searchbar; ?> !important; }
	   .search .search_button_main {background: <?= $but; ?> !important; }
		#header #publish .button-additem {background: <?= $but_main_post; ?> !important; }
		#header  #publish-main {background: <?= $but_gen_post; ?> !important; }
		.list .filters, #sidebar .filters .filter_plugin, .content #sidebar .filters .circl:before, .content #sidebar .filters .circl:after {background: <?= $se_bar; ?> !important; }
		.alertbut {background: <?= $alert_but; ?> !important; }
		.user_forms .inner, .user_forms .inner {background: <?= $back_us_lr; ?> !important; }
		.user_forms button {background: <?= $but_us_lr; ?> !important; }
		.add_item button {background: <?= $but_itpost; ?> !important; }
		.wrapper .block_tt {background: <?= $titl_bl; ?> !important; }
		#itemm #sidebar .link-phone {background: <?= $phon_bl; ?> !important; }
		#itemm #sidebar .contact_button {background: <?= $mes_bl; ?> !important; }
</style>
<?php } ?>
