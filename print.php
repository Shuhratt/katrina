<?php

// Enable OSClass functions
define('ABS_PATH', dirname(dirname(dirname(dirname(__FILE__)))) . '/');
require_once ABS_PATH . 'oc-load.php'; 

// Get posted data
$image_id = explode(",",$_POST['image_id']);
$image_path = explode(",",$_POST['image_path']);
$image_ext = explode(",",$_POST['image_ext']);

$phone = osc_item_city_area();
$contact_name = $_POST['contact_name'];
$contact_email = $_POST['contact_email'];
$contact_address = $_POST['contact_address'];

$site_title = $_POST['site_title'];
$site_url = $_POST['site_url'];
$desc = stripslashes($_POST['desc']);
$title = stripslashes($_POST['title']);
$price = $_POST['price'];
$pub_date = $_POST['pub_date'];
$country = $_POST['country'];
$region = $_POST['region'];
$city = $_POST['city'];
$zip = $_POST['zip'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php _e('Print','katrina'); ?></title>
		
		<script type="text/javascript">function printpage(){window.print();}</script>
		
		<script type="text/javascript"> 
			function toggle() {
				var ele = document.getElementById("pics");
				var text = document.getElementById("displayText");
				if(ele.style.display == "none") {
					ele.style.display = "block";
					text.innerHTML = "<?php echo osc_esc_js(__('Hide Pictures','katrina')); ?>";
				}
				else {
					ele.style.display = "none";
					text.innerHTML = "<?php echo osc_esc_js(__('Show Pictures','katrina')); ?>";
				}
			} 
		</script>
		
		
		<style type="text/css">
			
			
			body {width:700px;}
			#pics { clear:both; display: block; float:left; width: 100%; padding:2px;}
			#pics li { list-style:none; display:inline-table; position:relative; float: left; width: 100px; height: 80px; padding:4px; margin:4px; border: 1px solid lightgray; background-color: white;}
			.box { border: 1px dotted #ccc; padding:5px; }
			
			.price { display:inline-block;background-color: white; margin-left:15px; font-size:1.5em; font-weight:bold; border: 1px solid #ccc; padding: 5px;float:right;}
			
			#print {display:block; margin-bottom:10px; text-align:center; }
			#print a{text-decoration:none; padding:5px; border:1px solid #B0CCE2; border-radius:3px;background: #F4F7FA;}
			#print a:hover{background:#EEF3F8 ;}
			#showhide {float:right; }
			
			#title { float:left; width:700px; padding:5px; border-bottom: 1px solid #ccc; }
			#title .tt{font-size:18px; font-weight:bold;display:inline-block;width:500px;}
			#pictures { float:left; width:700px; padding:5px; border-top: 1px solid #ccc;}
			#displayText {font-size:10px; text-decoration:none; color: gray;}
			
			#info {float:left; width:300px; border-right: 1px solid #ccc; padding:5px;}
			#desc {float:left; width:300px; border-left: 1px solid #ccc; padding:5px; margin-left:-1px;}
			#footer {float:left; width:700px;  border-top: 1px dotted #ccc;}
		</style>
		
		
	</head>
	<body>
		
		<div id="print"><a href="#" onclick="printpage();"><font color="blue"><b><?php _e('Print','katrina'); ?></b></font></a></div>
		
		
		<div id="title">
			<span class="tt"><?php echo $title; ?></span><span class="price"><?php echo $price; ?></span>
		</div>
		
		<div id="info">
			<b><?php _e('Location','katrina'); ?>:</b><br><?php if($contact_address!='') echo $contact_address.'<br>'; ?><?php echo $city.', '.$region.' - '.$country; ?><br>
			<br>
			<b><?php _e('Published','katrina'); ?>:</b><br><?php echo $pub_date; ?><br>
			<br>
			<b><?php _e('Contact Info','katrina'); ?>:</b><br>
			<?php if($contact_name!='') echo $contact_name.'<br>'; ?>
		<?php if($phone!='')echo $phone.'<br>'; ?>
			
		</div>
		
		<div id="desc">
			<b><?php _e('Description','katrina'); ?>:</b> <?php echo $desc; ?>
		</div>
		
		<?php if($image_id[0]!=''){ ?>
			
			<div id="pictures">
				<a id="displayText" href="javascript:toggle();"><?php _e('Hide Pictures','katrina'); ?></a>
				<div id="pics">
					<?php for($index=0; $index<count($image_id); $index++){ ?>
						<li><img src="<?php echo $image_path[$index].$image_id[$index].'_thumbnail.'.$image_ext[$index]; ?>" width="140"></li>
					<?php  } ?>
				</div>
			</div>
		<?php } ?>
		
		<div id="footer">
			<?php _e('This ad was generated by','katrina'); ?>: <b><?php echo $site_title.'</b> - <i>'.$site_url; ?></i>
		</div>
		
		
	</body>
</html>