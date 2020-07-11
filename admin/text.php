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
<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>

  <h2 class="render-title"><b><i class="fa fa-file-text"></i> <?php _e('Title and description', 'katrina'); ?></b></h2>
<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/katrina/admin/text.php');?>" method="post" class="nocsrf">
    <input type="hidden" name="action_specific" value="text-input-theme" />
   <fieldset>
   <div class="form-horizontal">
		     <div class="form-row">
                <div class="form-label"><?php _e('Title in header', 'katrina'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 59px; width: 500px;"name="text-header"><?php echo osc_esc_html( osc_get_preference('text-header', 'katrina') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('This text will be placed in the header theme ', 'katrina'); ?></div>
                </div>
            </div>
			<div class="form-row">
                <div class="form-label"><?php _e('Description in footer ', 'katrina'); ?></div>
                <div class="form-controls">
                    <textarea style="height: 115px; width: 500px;"name="text-footer"><?php echo osc_esc_html( osc_get_preference('text-footer', 'katrina') ); ?></textarea>
                    <br/><br/>
                    <div class="help-box"><?php _e('Description site in footer', 'katrina'); ?></div>
                </div>
            </div>
			</div>


			<div class="form-actions">
				<input id="button" type="submit" value="<?php echo osc_esc_html(__('Save changes','katrina')); ?>" class="btn btn-submit">
			</div>

	</fieldset>
</form>
