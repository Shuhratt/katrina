<?php
define('KATRINA_THEME_VERSION', '2.1.3');

osc_enqueue_script('php-date');

if( !function_exists('osc_cat_select_katrina') ) {
/*
($_POST['sCategory'])
*/
	function osc_cat_select_katrina($name='sCategory',$selected=Null,$categories=null,$level=0) {
	$out="";
	if(isset($_GET['sCategory']))
	$selected = ($_GET['sCategory']);
		$_selected=null;
		if(empty($categories)){
			$categories = Category::newInstance()->toTree();
		}
        foreach ($categories as $category){
			if($selected==$category['pk_i_id'])
				$_selected=$category['s_name'];
			$out.="<li><a href='#'  data-cid='{$category['pk_i_id']}'>{$category['s_name']}</a>";
			if(count($category['categories'])>0){
				$sub=osc_cat_select_katrina($name,$selected,$category['categories'],$level+1);
				$out.=$sub[0];
				if(!empty($sub[1]))
					$_selected=$sub[1];
			}
			$out.="</li>";

		}
		if($level>0)
			return ["<ul>{$out}</ul>",$_selected];
		if(empty($_selected))
			$_selected= osc_esc_html(__('Select a category', 'katrina'));
			$_title_cat= osc_esc_html(__('All category', 'katrina'));
	echo "<div id='categories-selector' class='categories-selector'><input type='hidden' name='{$name}' value='{$selected}'><div id='placeholder' class='placeholder'>{$_selected}</div><ul class='closed'><li><a href='#' data-cid='0'>{$_title_cat}</a></li>{$out}</ul></div>";
    }
}

if( !function_exists('katrina_search_number') ) {

        function katrina_search_number() {
            $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
            $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
            if( $search_to > osc_search_total_items() ) {
                $search_to = osc_search_total_items();
            }

            return array(
                'from' => $search_from,
                'to'   => $search_to,
                'of'   => osc_search_total_items()
            );
        }
    }

function redirect_to_dashbord() {
osc_redirect_to('index.php?page=user&action=dashboard');
}
osc_add_hook('after_login', 'redirect_to_dashbord');

function ps_is_parent_category($catid='')
  {
   $conn = getConnection();
   $categoryTable=DB_TABLE_PREFIX."t_category";
   $query = 'SELECT count(*) as count FROM '.$categoryTable.' WHERE fk_i_parent_id = '.$catid;
   $arr = $conn->osc_dbFetchResult($query);
   if($arr['count']>0)
   return true;
   else return false;
  }

if( !function_exists('osc_cat_select') ) {

function osc_cat_select($name = 'sCategory', $category = null, $stan = null) {
 if ($stan == null) $stan = __('Select a category');

 if (is_array($category)&&isset($category[0]) )
 {
  $category['pk_i_id'] = $category[0];
 }
 else
 {
  $category['pk_i_id'] = 0;
 }
 CategoryForm::category_select(Category::newInstance()->toTree(), $category, $stan , $name);

}
}
 if( !function_exists('item_views_today') ) {
function item_views_today() {

    $views_today = ItemStats::newInstance();
    $views_today->dao->select('i_num_views');
    $views_today->dao->from(DB_TABLE_PREFIX.'t_item_stats');
    $views_today->dao->where('fk_i_item_id', osc_item_id());
    $views_today->dao->where('dt_date = DATE(NOW())');

    $result = $views_today->dao->get();
    $result = $result->row();

    if ($result) return $result['i_num_views'];
    else return 0;
}
}

if( !OC_ADMIN ) {
        if( !function_exists('add_close_button_action') ) {
            function add_close_button_action(){
                echo '<script type="text/javascript">';
                    echo '$(".flashmessage .ico-close").click(function(){';
                        echo '$(this).parent().hide();';
                    echo '});';
                echo '</script>';
            }
            osc_add_hook('footer', 'add_close_button_action');
        }
    }

if( !function_exists('get_subcategoriesKtr') ) {
         function get_subcategoriesKtr( ) {
             $location = Rewrite::newInstance()->get_location() ;
             $section  = Rewrite::newInstance()->get_section() ;

             if ( $location != 'search' ) {
                 return false ;
             }

             $category_id = osc_search_category_id() ;

             if(count($category_id) > 1) {
                 return false ;
             }

             if (isset($category_id[0]) ) {
             $category_id = (int) $category_id[0] ;}

             $subCategories = Category::newInstance()->findSubcategories($category_id) ;


             foreach($subCategories as &$category) {
                 $category['url'] = get_category_url($category) ;
             }

             return $subCategories ;
         }
     }
	      if ( !function_exists('get_category_url') ) {
         function get_category_url( $category ) {
             $path = '';
             if ( osc_rewrite_enabled() ) {
                if ($category != '') {
                    $category = Category::newInstance()->hierarchy($category['pk_i_id']) ;
                    $sanitized_category = "" ;
                    for ($i = count($category); $i > 0; $i--) {
                        $sanitized_category .= $category[$i - 1]['s_slug'] . '/' ;
                    }
                    $path = osc_base_url() . $sanitized_category ;
                }
            } else {
                $path = sprintf( osc_base_url(true) . '?page=search&sCategory=%d', $category['pk_i_id'] ) ;
            }

            return $path;
         }
     }

	if( !function_exists('cat_search') ){
        function cat_search(){
            return getPreference('cat_search_katrina','katrina');
        }
    }

		if( !function_exists('latest_home') ){
	        function latest_home(){
	            return getPreference('latest_home_katrina','katrina');
	        }
	    }

if ( !function_exists('get_category_num_items') ) {
         function get_category_num_items( $category ) {
            $category_stats = CategoryStats::newInstance()->countItemsFromCategory($category['pk_i_id']) ;

            if( empty($category_stats) ) {
                return 0 ;
            }

            return $category_stats;
         }
     }

    osc_add_hook('init_admin', 'theme_katrina_actions_admin');
    function theme_katrina_actions_admin() {
        if( Params::getParam('file') == 'oc-content/themes/katrina/admin/settings.php' ) {
            if( Params::getParam('donation') == 'successful' ) {
                osc_set_preference('donation', '1', 'katrina');
                osc_reset_preferences();
            }
        }

        switch( Params::getParam('action_specific') ) {
        case('settings'):
        $defaultLogo = Params::getParam('default_logo');
				$footerLink  = Params::getParam('footer_link');
				$premium_num_main = Params::getParam('premium_num_main');
				$latest_num_main = Params::getParam('latest_num_main');
				$premium_num_search = Params::getParam('premium_num_search');
				$premium_home = Params::getParam('premium_home');
				$fac_lik = Params::getParam('fac_lik');
				$twitter_lik = Params::getParam('twitter_lik');
				$google_lik = Params::getParam('google_lik');

				osc_set_preference('cat_search_katrina',trim(Params::getParam('cat_search_katrina', false, false, false)),'katrina');
				osc_set_preference('latest_home_katrina',trim(Params::getParam('latest_home_katrina', false, false, false)),'katrina');
				osc_set_preference('defaultShowAs@all', Params::getParam('defaultShowAs@all'), 'katrina');
        osc_set_preference('defaultShowAs@search', Params::getParam('defaultShowAs@all'), 'katrina');
				osc_set_preference('footer_link', ($footerLink ? '1' : '0'), 'katrina');
        osc_set_preference('default_logo', ($defaultLogo ? '1' : '0'), 'katrina');
				osc_set_preference('premium_num_main', ($premium_num_main), 'katrina');
				osc_set_preference('premium_num_search', ($premium_num_search), 'katrina');
				osc_set_preference('latest_num_main', ($latest_num_main), 'katrina');
				osc_set_preference('premium_home', ($premium_home ? '1' : '0'), 'katrina');
				osc_set_preference('fac_lik', ($fac_lik), 'katrina');
				osc_set_preference('twitter_lik', ($twitter_lik), 'katrina');
				osc_set_preference('google_lik', ($google_lik), 'katrina');



                osc_set_preference('header-728x90',         trim(Params::getParam('header-728x90', false, false, false)),                  'katrina');
                osc_set_preference('homepage-728x90',       trim(Params::getParam('homepage-728x90', false, false, false)),                'katrina');
                osc_set_preference('sidebar-300x250',       trim(Params::getParam('sidebar-300x250', false, false, false)),                'katrina');
                osc_set_preference('search-results-top-728x90',     trim(Params::getParam('search-results-top-728x90', false, false, false)),          'katrina');
                osc_set_preference('search-results-middle-728x90',  trim(Params::getParam('search-results-middle-728x90', false, false, false)),       'katrina');

                osc_add_flash_ok_message(__('Theme settings updated correctly', 'katrina'), 'admin');
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/katrina/admin/settings.php')); exit;
            break;
            case('upload_logo'):
                $package = Params::getFiles('logo');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                        osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'katrina'), 'admin');
                    } else {
                        osc_add_flash_error_message(__("An error has occurred, please try again", 'katrina'), 'admin');
                    }
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'katrina'), 'admin');
                }
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/katrina/admin/header.php')); exit;
            break;
            case('remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    @unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
                    osc_add_flash_ok_message(__('The logo image has been removed', 'katrina'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'katrina'), 'admin');
                }
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/katrina/admin/header.php')); exit;
            break;

			case('category_icons'):
					$catID = Params::getParam('category_id');
					$package = Params::getFiles('category_icon');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    $img = ImageResizer::fromFile($package['tmp_name']);
                    $path = osc_base_path().'oc-content/themes/katrina/images/category/'.$catID.'.png' ;
                    $img->saveToFile($path);
                    osc_add_flash_ok_message(__('The icon has been uploaded correctly', 'katrina'), 'admin');
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'katrina'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/katrina/admin/category_icons.php#icons'));
            break;
			case('remove-icon'):
				$catID = Params::getParam('category_id');
                $path = osc_base_path().'oc-content/themes/katrina/images/category/'.$catID.'.png' ;
                if(file_exists( $path ) ) {
                    @unlink( $path );
                    osc_add_flash_ok_message(__('The icon has been removed', 'katrina'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'katrina'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/katrina/admin/category_icons.php#icons'));
            break;
			case('text-input-theme'):
				osc_set_preference('text-header',trim(Params::getParam('text-header', false, false, false)),
				'katrina');
				osc_set_preference('text-footer',trim(Params::getParam('text-footer', false, false, false)),'katrina');
		        osc_add_flash_ok_message(__("Settings updated correctly", 'katrina'), 'admin');
				osc_redirect_to(osc_admin_render_theme_url( 'oc-content/themes/katrina/admin/text.php#text' ));
			break;

			case('colorized'):

            $searchbar = Params::getParam('searchbar');
			$button_search_main = Params::getParam('button_search_main');
			$but_post_main = Params::getParam('but_post_main');
			$but_post_gen = Params::getParam('but_post_gen');
			$search_bar = Params::getParam('search_bar');
			$alert_but = Params::getParam('alert_but');
			$back_us_lr = Params::getParam('back_us_lr');
			$but_us_lr = Params::getParam('but_us_lr');
			$but_itpost = Params::getParam('but_itpost');
			$titl_bl = Params::getParam('titl_bl');
			$phon_bl = Params::getParam('phon_bl');
			$mes_bl = Params::getParam('mes_bl');

            osc_set_preference('searchbar', ($searchbar), 'katrina');
			osc_set_preference('button_search_main', ($button_search_main), 'katrina');
			osc_set_preference('but_post_main', ($but_post_main), 'katrina');
			osc_set_preference('but_post_gen', ($but_post_gen), 'katrina');
			osc_set_preference('alert_but', ($alert_but), 'katrina');
			osc_set_preference('search_bar', ($search_bar), 'katrina');
			osc_set_preference('back_us_lr', ($back_us_lr), 'katrina');
			osc_set_preference('but_us_lr', ($but_us_lr), 'katrina');
			osc_set_preference('but_itpost', ($but_itpost), 'katrina');
			osc_set_preference('titl_bl', ($titl_bl), 'katrina');
			osc_set_preference('phon_bl', ($phon_bl), 'katrina');
			osc_set_preference('mes_bl', ($mes_bl), 'katrina');


			osc_add_flash_ok_message(__('Color updated correctly', 'katrina'), 'admin');
            osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/katrina/admin/color.php'));

            break;
        }
    }
	osc_add_hook('init_admin', 'theme_fino_actions_admin');

	if( !function_exists('katrina_show_as') ){
        function katrina_show_as(){

            $p_sShowAs    = Params::getParam('sShowAs');
            $aValidShowAsValues = array('list', 'gallery');
            if (!in_array($p_sShowAs, $aValidShowAsValues)) {
                $p_sShowAs = katrina_default_show_as();
            }

            return $p_sShowAs;
        }
    }
    if( !function_exists('katrina_default_show_as') ){
        function katrina_default_show_as(){
            return getPreference('defaultShowAs@all','katrina');
        }
    }

    if( !function_exists('logo_header') ) {
        function logo_header() {
            $html = '<img border="0" style="max-height: 40px;" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" />';
            if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                return $html;
            } else if( osc_get_preference('default_logo', 'katrina') && (file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/default-logo.jpg")) ) {
                return '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/default-logo.jpg') . '" />';
            } else {
                return osc_page_title();
            }
        }
    }

    // install update options
    if( !function_exists('katrina_theme_install') ) {
        function katrina_theme_install() {
            osc_set_preference('version', '2.1.1', 'katrina');
            osc_set_preference('default_logo', '1', 'katrina');
			osc_set_preference('searchbar', 'katrina');
			osc_set_preference('defaultShowAs@all', 'list', 'katrina');
			osc_set_preference('cat_search_katrina', 'select', 'katrina');
			osc_set_preference('latest_home_katrina', 'latest', 'katrina');
			osc_set_preference('button_search_main', 'katrina');
			osc_set_preference('but_post_main', 'katrina');
			osc_set_preference('but_post_gen', 'katrina');
			osc_set_preference('alert_but', 'katrina');
			osc_set_preference('back_us_lr', 'katrina');
			osc_set_preference('but_us_lr', 'katrina');
			osc_set_preference('but_itpost', 'katrina');
			osc_set_preference('titl_bl', 'katrina');
			osc_set_preference('phon_bl', 'katrina');
			osc_set_preference('mes_bl', 'katrina');
            osc_reset_preferences();
        }
    }

    if(!function_exists('check_install_katrina_theme')) {
        function check_install_katrina_theme() {
            $current_version = osc_get_preference('version', 'katrina');
            //check if current version is installed or need an update
            if( !$current_version ) {
                katrina_theme_install();
            }

        }
    }

    check_install_katrina_theme();

    /* ads  SEARCH */
    if (!function_exists('search_ads_listing_top_fn')) {
        function search_ads_listing_top_fn() {
            if(osc_get_preference('search-results-top-728x90', 'katrina')!='') {
                echo '<div class="clear"></div>' . PHP_EOL;
                echo '<div class="ads_728">' . PHP_EOL;
                echo osc_get_preference('search-results-top-728x90', 'katrina');
                echo '</div>' . PHP_EOL;
            }
        }
    }
    osc_add_hook('search_ads_listing_top', 'search_ads_listing_top_fn');

    if (!function_exists('search_ads_listing_medium_fn')) {
        function search_ads_listing_medium_fn() {
            if(osc_get_preference('search-results-middle-728x90', 'katrina')!='') {
                echo '<div class="clear"></div>' . PHP_EOL;
                echo '<div class="ads_728">' . PHP_EOL;
                echo osc_get_preference('search-results-middle-728x90', 'katrina');
                echo '</div>' . PHP_EOL;
            }
        }
    }
    osc_add_hook('search_ads_listing_medium', 'search_ads_listing_medium_fn');

	osc_add_hook('init_admin', 'theme_katrina_actions_admin');
if (katrina_is_fineuploader()) {
    if (!OC_ADMIN) {
        osc_enqueue_style('fine-uploader-css', osc_assets_url('js/fineuploader/fineuploader.css'));
    }
    osc_enqueue_script('jquery-fineuploader');
}

function katrina_is_fineuploader() {
    return Scripts::newInstance()->registered['jquery-fineuploader'] && method_exists('ItemForm', 'ajax_photos');
}
if (function_exists('osc_admin_menu_appearance')) {
    osc_admin_menu_appearance(__('Header logo', 'katrina'), osc_admin_render_theme_url('oc-content/themes/katrina/admin/header.php'), 'header_katrina');
    osc_admin_menu_appearance(__('Theme settings', 'katrina'), osc_admin_render_theme_url('oc-content/themes/katrina/admin/settings.php'), 'settings_katrina');
} else {

    function katrina_admin_menu() {
        echo '<h3><a href="#">' . __('Katrina theme', 'katrina') . '</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/katrina/admin/header.php') . '">&raquo; ' . __('Header logo', 'katrina') . '</a></li>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/katrina/admin/settings.php') . '">&raquo; ' . __('Theme settings', 'katrina') . '</a></li>

            </ul>';
    }

    osc_add_hook('admin_menu', 'katrina_admin_menu');
}

    /* remove theme */
	    function katrina_delete_theme() {
	Preference::newInstance()->delete(array('s_section' => 'katrina'));
    }
    osc_add_hook('theme_delete_katrina', 'katrina_delete_theme');

?>
