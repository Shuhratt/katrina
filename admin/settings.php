
<h2 class="render-title <?php echo (osc_get_preference('footer_link', 'katrina') ? '' : 'separate-top'); ?>"><?php _e('Theme settings', 'katrina'); ?></h2>

<?php if ( (!defined('ABS_PATH')) ) exit('ABS_PATH is not loaded. Direct access is not allowed.'); ?>
<?php if ( !OC_ADMIN ) exit('User access is not allowed.'); ?>
<div class="content">
  <div class="head">
      <?php include 'head.php'; ?>
  </div>
  <div class="tabadmin" id="tabContainer">
    <ul>
      <li><a href="#setting"><i class="fa fa-home" aria-hidden="true"></i> <?php _e('Setting', 'selena'); ?></a></li>
      <li><a href="#category_icons"><i class="fa fa-file-image-o" aria-hidden="true"></i> <?php _e('Category images', 'selena'); ?></a></li>
      <li><a href="#text"><i class="fa fa-search" aria-hidden="true"></i> <?php _e('Text', 'selena'); ?></a></li>
      <li><a href="#color"><?php _e('Color', 'selena'); ?></a></li>
    </ul>
    <div id="setting">
        <h2 class="admin-title" ><a href="https://san-osclass.com/product-category/themes/premium_themes" target="_blank"><?php _e('Try premium themes', 'pioneer'); ?></a></h2>
        <div class="iframe_block">
            <iframe src="https://san-osclass.com/product-category/themes/premium_themes/#main" width="100%" height="350"  scrolling="no" class="iframe_class"></iframe>
        </div>

      <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/katrina/admin/settings.php'); ?>" method="post">

          <input type="hidden" name="action_specific" value="settings" />
      	  <h2 class="render-title"><?php _e('Global settings', 'katrina'); ?></h2>
      	 <div class="form-horizontal">
          <fieldset>
      			 <div class="form-row">
                      <div class="form-label"><?php _e('Show lists as:', 'katrina'); ?></div>
                      <div class="form-controls">
                          <select name="defaultShowAs@all">
                              <option value="gallery" <?php if(katrina_default_show_as() == 'gallery'){ echo 'selected="selected"' ; } ?>><?php _e('Gallery','katrina'); ?></option>
                              <option value="list" <?php if(katrina_default_show_as() == 'list'){ echo 'selected="selected"' ; } ?>><?php _e('List','katrina'); ?></option>
                          </select>
                      </div>
                  </div>
  			          <div class="form-row">
                      <div class="form-label"><?php _e('Show category search:', 'katrina'); ?></div>
                      <div class="form-controls">
                          <select name="cat_search_katrina">
                              <option value="select" <?php if(cat_search() == 'select'){ echo 'selected="selected"' ; } ?>><?php _e('Standart select','katrina'); ?></option>
                              <option value="select_katrina" <?php if(cat_search() == 'select_katrina'){ echo 'selected="selected"' ; } ?>><?php _e('Advanced select','katrina'); ?></option>
                          </select>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-label"><?php _e('Latest Listings:', 'katrina'); ?></div>
                      <div class="form-controls">
                          <select name="latest_home_katrina">
                              <option value="latest" <?php if(latest_home() == 'latest'){ echo 'selected="selected"' ; } ?>><?php _e('Standart latest list','katrina'); ?></option>
                              <option value="latest_katrina" <?php if(latest_home() == 'latest_katrina'){ echo 'selected="selected"' ; } ?>><?php _e('Latest list by category','katrina'); ?></option>
                          </select>
                      </div>
                      <?php if(latest_home() == 'latest_katrina') { ?>
                          <div class="form-label"><?php _e('max number in block', 'katrina'); ?></div>
                          <div class="form-controls">
                             <input type="number" name="latest_num_main" id="latest_num_main" value="<?php echo osc_esc_html(osc_get_preference('latest_num_main', 'katrina')); ?>" />
                          </div>

                      <?php } ?>
                  </div>
          </fieldset>
        <fieldset>

      			<div class="form-row">
      				<div class="form-label"><?php _e('Numder premium items on main', 'katrina'); ?></div>
      				<div class="form-controls">
      					<input type="text" name="premium_num_main" id="premium_num_main" value="<?php echo osc_esc_html(osc_get_preference('premium_num_main', 'katrina')); ?>" />
      				</div>
      			</div>

      		<div class="form-row">
      				<div class="form-label"><?php _e('Numder premium items in search list, galery', 'katrina'); ?></div>
      				<div class="form-controls">
      					<input type="text" name="premium_num_search" id="premium_num_search" value="<?php echo osc_esc_html(osc_get_preference('premium_num_search', 'katrina')); ?>" />
      				</div>
      			</div>


      			<div class="form-row">
      				<div class="form-label"><?php _e('Premium home', 'katrina'); ?></div>
      				<div class="form-controls">
                <div class="form-label-checkbox">
          				<input name="premium_home" id="premium_home" type="checkbox" <?php echo (osc_get_preference('premium_home', 'katrina') == 1 ? 'checked' : ''); ?> />
                  <label for="premium_home"></label>
                </div>
            </div>
      			</div>

      			<div class="form-row">
      					<div class="form-label"><?php _e('Link on facebook', 'katrina'); ?></div>
      					<div class="form-controls">
      					<input type="text" name="fac_lik" id="fac_lik" value="<?php echo osc_esc_html(osc_get_preference('fac_lik', 'katrina')); ?>" />
      					<div class="help-box">Example: https://www.facebook.com/companyname</div>
      					</div>
      			</div>

      			<div class="form-row">
      					<div class="form-label"><?php _e('Link on twitter', 'katrina'); ?></div>
      					<div class="form-controls">
      					<input type="text" name="twitter_lik" id="twitter_lik" value="<?php echo osc_esc_html(osc_get_preference('twitter_lik', 'katrina')); ?>" />
      					<div class="help-box">Example: https://twitter.com/companyname</div>
      					</div>
      			</div>
      			<div class="form-row">
      					<div class="form-label"><?php _e('Link on google', 'katrina'); ?></div>
      					<div class="form-controls">
      					<input type="text" name="google_lik" id="google_lik" value="<?php echo osc_esc_html(osc_get_preference('google_lik', 'katrina')); ?>" />
      					<div class="help-box">Example: https://plus.google.com/companyname</div>
      					</div>

      			</div>

      			   </fieldset>
      			   <div class="form-actions">
                      <input type="submit" value="<?php _e('Save changes', 'katrina'); ?>" class="btn btn-submit">
                  </div>
      			   </div>
          <fieldset>

          <h2 class="render-title"><?php _e('Ads management', 'katrina'); ?></h2>
          <div class="form-row">
              <div class="form-label"></div>
              <div class="form-controls">
                  <p><?php _e('In this section you can configure your site to display ads and start generating revenue.', 'katrina'); ?><br/><?php _e('If you are using an online advertising platform, such as Google Adsense, copy and paste here the provided code for ads.', 'katrina'); ?></p>
              </div>
          </div>

      	    </fieldset>
          <fieldset>
              <div class="form-horizontal">
                  <div class="form-row">
                      <div class="form-label"><?php _e('Header 728x90', 'katrina'); ?></div>
                      <div class="form-controls">
                          <textarea style="height: 115px; width: 500px;"name="header-728x90"><?php echo osc_esc_html( osc_get_preference('header-728x90', 'katrina') ); ?></textarea>
                          <br/><br/>
                          <div class="help-box"><?php _e('This ad will be shown at the top of your website, next to the site title and above the search results. Note that the size of the ad has to be 728x90 pixels.', 'katrina'); ?></div>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-label"><?php _e('Homepage 728x90', 'katrina'); ?></div>
                      <div class="form-controls">
                          <textarea style="height: 115px; width: 500px;" name="homepage-728x90"><?php echo osc_esc_html( osc_get_preference('homepage-728x90', 'katrina') ); ?></textarea>
                          <br/><br/>
                          <div class="help-box"><?php _e('This ad will be shown on the main site of your website. It will appear both at the top and bottom of your site homepage. Note that the size of the ad has to be 728x90 pixels.', 'katrina'); ?></div>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-label"><?php _e('Search results 728x90 (top of the page)', 'katrina'); ?></div>
                      <div class="form-controls">
                          <textarea style="height: 115px; width: 500px;" name="search-results-top-728x90"><?php echo osc_esc_html( osc_get_preference('search-results-top-728x90', 'katrina') ); ?></textarea>
                          <br/><br/>
                          <div class="help-box"><?php _e('This ad will be shown on top of the search results of your site. Note that the size of the ad has to be 728x90 pixels.', 'katrina'); ?></div>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-label"><?php _e('Search results 728x90 (middle of the page)', 'katrina'); ?></div>
                      <div class="form-controls">
                          <textarea style="height: 115px; width: 500px;" name="search-results-middle-728x90"><?php echo osc_esc_html( osc_get_preference('search-results-middle-728x90', 'katrina') ); ?></textarea>
                          <br/><br/>
                          <div class="help-box"><?php _e('This ad will be shown among the search results of your site. Note that the size of the ad has to be 728x90 pixels.', 'katrina'); ?></div>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-label"><?php _e('Sidebar 300x250', 'katrina'); ?></div>
                      <div class="form-controls">
                          <textarea style="height: 115px; width: 500px;" name="sidebar-300x250"><?php echo osc_esc_html( osc_get_preference('sidebar-300x250', 'katrina') ); ?></textarea>
                          <br/><br/>
                          <div class="help-box"><?php _e('This ad will be shown at the right sidebar of your website, on the product detail page. Note that the size of the ad has to be 300x350 pixels.', 'katrina'); ?></div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <input type="submit" value="<?php _e('Save changes', 'katrina'); ?>" class="btn btn-submit">
                  </div>
              </div>
          </fieldset>
      </form>
    </div>
    <div id="category_icons">
      <?php include 'category_icons.php'; ?>
    </div>
    <div id="text">
      <?php include 'text.php'; ?>
    </div>
    <div id="color">
      <?php include 'color.php'; ?>
    </div>
  </div>
<script src="<?php echo osc_current_web_theme_url('admin/js/admin.js');?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo osc_current_web_theme_url('admin/css/style.css');?>">
<link type="text/css" rel="stylesheet" href="<?php echo osc_current_web_theme_url('css/font-awesome-4.7.0/css/font-awesome.css');?>">
