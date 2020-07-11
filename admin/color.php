<?php if ((!defined('ABS_PATH'))) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if (!OC_ADMIN) exit('User access is not allowed.'); ?>
<script type="text/javascript" src="<?php echo osc_current_web_theme_url(). 'js/jscolor/jscolor.js?1'; ?>"></script>
	
<style>
.form-horizontal .form-label{width: 201px!important;padding-right: 13px!important;}
form h3 {border-bottom: 1px solid #eee;padding: 4px 0}
</style>
*<?php _e ('If the field is empty, will be set to the standard color theme', 'katrina'); ?>
		<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/katrina/admin/color.php'); ?>" method="post" class="nocsrf">
		<input type="hidden" name="action_specific" value="colorized" /> 
<div class="form-horizontal">
			<h3><?php _e('Header', 'katrina'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Color button Post (main)', 'katrina'); ?></div>
				<div class="form-controls">
					<input class="jscolor {hash:true, required:false}" type="text" name="but_post_main" id="but_post_main" value="<?php echo osc_esc_html(osc_get_preference('but_post_main', 'katrina')); ?>" />
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-label"><?php _e('Color button Post (general)', 'katrina'); ?></div>
				<div class="form-controls">
					<input class="jscolor {hash:true, required:false}" type="text" name="but_post_gen" id="but_post_gen" value="<?php echo osc_esc_html(osc_get_preference('but_post_gen', 'katrina')); ?>" />
				</div>
			</div>
			
			<h3><?php _e('Home', 'katrina'); ?></h3>
			
			<div class="form-row">
				<div class="form-label"><?php _e('Color block Search in main and bootom line', 'katrina'); ?></div>
				<div class="form-controls">
					<input class="jscolor {hash:true, required:false}" type="text" name="searchbar" id="searchbar" value="<?php echo osc_esc_html(osc_get_preference('searchbar', 'katrina')); ?>" />
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-label"><?php _e('Button search in main', 'katrina'); ?></div>
				<div class="form-controls">
					<input class="jscolor {hash:true, required:false}" type="text" name="button_search_main" id="button_search_main" value="<?php echo osc_esc_html(osc_get_preference('button_search_main', 'katrina')); ?>" />
				</div>
			</div>
			<h3><?php _e('Search', 'katrina'); ?></h3>
			
			<div class="form-row">
				<div class="form-label"><?php _e('Search bar in search.php', 'katrina'); ?></div>
				<div class="form-controls">
					<input class="jscolor {hash:true, required:false}" type="text" name="search_bar" id="search_bar" value="<?php echo osc_esc_html(osc_get_preference('search_bar', 'katrina')); ?>" />
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-label"><?php _e('Alert button in search.php', 'katrina'); ?></div>
				<div class="form-controls">
					<input class="jscolor {hash:true, required:false}" type="text" name="alert_but" id="alert_but" value="<?php echo osc_esc_html(osc_get_preference('alert_but', 'katrina')); ?>" />
				</div>
			</div>
			
			
			<h3><?php _e('User login and User register', 'katrina'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Background block', 'katrina'); ?></div>
				<div class="form-controls">
				<input class="jscolor {hash:true, required:false}" type="text" name="back_us_lr" id="back_us_lr" value="<?php echo osc_esc_html(osc_get_preference('back_us_lr', 'katrina')); ?>" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Button color', 'katrina'); ?></div>
				<div class="form-controls">
				<input class="jscolor {hash:true, required:false}" type="text" name="but_us_lr" id="but_us_lr" value="<?php echo osc_esc_html(osc_get_preference('but_us_lr', 'katrina')); ?>" />
				</div>
			</div>
			
			
			<h3><?php _e('Item post', 'katrina'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Button color', 'katrina'); ?></div>
				<div class="form-controls">
				<input class="jscolor {hash:true, required:false}" type="text" name="but_itpost" id="but_itpost" value="<?php echo osc_esc_html(osc_get_preference('but_itpost', 'katrina')); ?>" />
				</div>
			</div>
			
			
			<h3><?php _e('Item', 'katrina'); ?></h3>
			<div class="form-row">
				<div class="form-label"><?php _e('Header block title', 'katrina'); ?></div>
				<div class="form-controls">
				<input class="jscolor {hash:true, required:false}" type="text" name="titl_bl" id="titl_bl" value="<?php echo osc_esc_html(osc_get_preference('titl_bl', 'katrina')); ?>" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Phone block', 'katrina'); ?></div>
				<div class="form-controls">
				<input class="jscolor {hash:true, required:false}" type="text" name="phon_bl" id="phon_bl" value="<?php echo osc_esc_html(osc_get_preference('phon_bl', 'katrina')); ?>" />
				</div>
			</div>
			<div class="form-row">
				<div class="form-label"><?php _e('Contact block', 'katrina'); ?></div>
				<div class="form-controls">
				<input class="jscolor {hash:true, required:false}" type="text" name="mes_bl" id="mes_bl" value="<?php echo osc_esc_html(osc_get_preference('mes_bl', 'katrina')); ?>" />
				</div>
			</div>
			
			
			
			
			
</div>
<div class="form-actions">
                <input type="submit" value="<?php _e('Save changes', 'katrina'); ?>" class="btn btn-submit">
</div>
	
	</form>