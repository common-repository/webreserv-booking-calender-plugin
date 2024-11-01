<?php

/*

Plugin Name: WebReserv Booking Calendar 2.0

Plugin URI: http://wordpress.org/plugins/webreserv-booking-calender-plugin/

Description: WebReserv just developed a new version of its booking calendar. This plugin lets you embed the new booking calendar 2.0 directly in any PAGE or POST. The installation includes the code for a demo account so you can see how it works without a WebReserv account. Works for nearly any type of business, RV or Car Rentals, property rentals, B&B, meeting rooms etc. Remember to create a free WebReserv account to try it out with your bookable product. To use it, activate the plugin, then click "Settings" and select WebReserv plugin. 

Version: 4
 */

/*  Copyright 2013 Mishel Naguib (email : admin@applicationsbook.com)
 */

register_activation_hook(__FILE__,'WebReserv_install'); 
register_deactivation_hook( __FILE__, 'WebReserv_remove' );
/*
add_filter('the_content','webreserv_insert');

$url =  'wp-content/plugins/WebReserv/';
 		  
//////////////////////////////////

function webreserv_insert($content)
{
  if (preg_match('{WEBRESERV}',$content))
    {
    $content = str_replace('{WEBRESERV}',webreserv(),$content);
    }
  return $content;
}
function webreserv()
{
   global  $userdata, $table_prefix, $wpdb, $webreserv_installed;
   get_currentuserinfo();
   $str='';
 	$webreserv_code = get_option('webreserv_code');
	$str.='<div class="wrap">';

$str.='<center>';
$str.='<div id="CalendarDiv">';
$str.=  $webreserv_code;
$str.='</div>';
$str.='</center>';
$str.='</div>';
return $str;
}
////////////////////////

*/
if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'WebReserv_admin');

function WebReserv_admin() {
add_options_page('WebReserv', 'WebReserv 2.0', 'administrator',
'WebReserv', 'WebReserv_html_page');
}
}

function WebReserv_html_page() {
$url =  '../wp-content/plugins/WebReserv';
if($_REQUEST['action']=='updatenew'){
	//echo "<pre>";
	//print_r($_REQUEST);
	//echo "</pre>";
	
	
	$webreserv_reg_site=$_REQUEST['webreserv_reg_site']; 
	$webreserv_business_id=$_REQUEST['webreserv_business_id']; 
	
	if(isset($_REQUEST['webreserv_cal_version']) && $_REQUEST['webreserv_cal_version'] != '' && $_REQUEST['webreserv_cal_version'] == 1){
	
		 $webreserv_cal_style=$_REQUEST['webreserv_cal_style']; 
		 $webreserv_search_date=$_REQUEST['webreserv_search_date']; 
		 $webreserv_inc_list=$_REQUEST['webreserv_inc_list']; 

		if($_REQUEST['webreserv_cal_style']=='Link'){
			if($webreserv_inc_list=='y'){
			$url="https://".$webreserv_reg_site."/services/bookonline.do?businessid=".$webreserv_business_id."&search=".$webreserv_search_date;
			}else{
			$url="https://".$webreserv_reg_site."/services/bookonline.do?businessid=".$webreserv_business_id."&search=".$webreserv_search_date."&list=n";
			}
			$webreserv_code="<a href='".$url."'>Make Reservation</a>";

		}elseif($_REQUEST['webreserv_cal_style']=='embedded'){
			if($webreserv_inc_list=='y'){
			$urlembed="https://".$webreserv_reg_site."/services/bookonline.do?businessid=".$webreserv_business_id."&embedded=y&search=".$webreserv_search_date;
			}else{
			$urlembed="https://".$webreserv_reg_site."/services/bookonline.do?businessid=".$webreserv_business_id."&embedded=y&search=".$webreserv_search_date."&list=n";
			}
			$webreserv_code='<iframe src="'.$urlembed.'" width="700px" height="900px" scrolling="auto" frameborder="0"></iframe>';

		}elseif($_REQUEST['webreserv_cal_style']=='button'){
			if($webreserv_inc_list=='y'){
			 $urlbutton="window.location='https://".$webreserv_reg_site."/services/bookonline.do?businessid=".$webreserv_business_id."&search=".$webreserv_search_date."'";
			}else{
			 $urlbutton="window.location='https://".$webreserv_reg_site."/services/bookonline.do?businessid=".$webreserv_business_id."&search=".$webreserv_search_date."&list=n'";
			}
			$webreserv_code='<input type="button" value="Make Reservation" onclick="'.$urlbutton.'">';

			
		}
		//echo "<br>".$updatequery="update wp_options set webreserv_code='".$webreserv_code."'";
		
		update_option("webreserv_cal_version", '1', '', 'yes');
		update_option("webreserv_code", $webreserv_code, '', 'yes');
		update_option("webreserv_reg_site",$webreserv_reg_site, '', 'yes');
		update_option("webreserv_business_id", $webreserv_business_id, '', 'yes');
		update_option("webreserv_cal_style", $webreserv_cal_style, '', 'yes');
		update_option("webreserv_search_date", $webreserv_search_date, '', 'yes');
		update_option("webreserv_inc_list", $webreserv_inc_list, '', 'yes');
	
	}
	elseif(isset($_REQUEST['webreserv_cal_version']) && $_REQUEST['webreserv_cal_version'] != '' && $_REQUEST['webreserv_cal_version'] == 2){
		$webreserv_cal_style_v2=$_REQUEST['webreserv_cal_style_v2'];
		$webreserv_search_v2=$_REQUEST['webreserv_search_v2'];
		$webreserv_avail_rate_grid_v2=$_REQUEST['webreserv_avail_rate_grid_v2']; 
		$webreserv_color_theme_v2=$_REQUEST['webreserv_color_theme_v2']; 
		$webreserv_color_bg=$_REQUEST['webreserv_color_bg']; 
		$webreserv_color_txt=$_REQUEST['webreserv_color_txt']; 
		$webreserv_color_border=$_REQUEST['webreserv_color_border']; 
		$webreserv_width=$_REQUEST['webreserv_width']; 
		$webreserv_height=$_REQUEST['webreserv_height']; 
		
		if(empty($webreserv_width)){
			$webreserv_width = 700;
		}
		if(empty($webreserv_height)){
			$webreserv_height = 900;
		}
		if($webreserv_color_theme_v2 == 'custom'){
			$css = '&color='.$webreserv_color_txt;
			$css .= '&bgcolor='.$webreserv_color_bg;
			$css .= '&bcolor='.$webreserv_color_border;
		}else{
			$css = '&css='.$webreserv_color_theme_v2;
		}
		if($_REQUEST['webreserv_cal_style_v2']=='Link'){
			$url="https://".$webreserv_reg_site."/services/bookingcalendar.do?businessid=".$webreserv_business_id."&embedded=n&search=".$webreserv_search_v2."&avgrid=".$webreserv_avail_rate_grid_v2 . $css;
			$webreserv_code="<a href='".$url."'>Make Reservation</a>";
			
		}elseif($_REQUEST['webreserv_cal_style_v2']=='embedded'){
			$urlembed="https://".$webreserv_reg_site."/services/bookingcalendar.do?businessid=".$webreserv_business_id."&embedded=y&search=".$webreserv_search_v2."&avgrid=".$webreserv_avail_rate_grid_v2 . $css;
			$webreserv_code='<iframe src="'.$urlembed.'" width="'.$webreserv_width.'px" height="'.$webreserv_height.'px" scrolling="auto" frameborder="0"></iframe>';
		}elseif($_REQUEST['webreserv_cal_style_v2']=='button'){
			$urlbutton="window.location='https://".$webreserv_reg_site."/services/bookingcalendar.do?businessid=".$webreserv_business_id."&embedded=n&search=".$webreserv_search_v2."&avgrid=".$webreserv_avail_rate_grid_v2 . $css ."'";
			$webreserv_code='<input type="button" value="Make Reservation" onclick="'.$urlbutton.'">';
		}
		
		update_option("webreserv_cal_version", '2', '', 'yes');
		update_option("webreserv_code", $webreserv_code, '', 'yes');
		update_option("webreserv_reg_site",$webreserv_reg_site, '', 'yes');
		update_option("webreserv_business_id", $webreserv_business_id, '', 'yes');
		update_option("webreserv_cal_style_v2", $webreserv_cal_style_v2, '', 'yes');
		update_option("webreserv_search_v2", $webreserv_search_v2, '', 'yes');
		update_option("webreserv_avail_rate_grid_v2", $webreserv_avail_rate_grid_v2, '', 'yes');
		update_option("webreserv_color_theme_v2", $webreserv_color_theme_v2, '', 'yes');
		update_option("webreserv_color_bg", $webreserv_color_bg, '', 'yes');
		update_option("webreserv_color_txt", $webreserv_color_txt, '', 'yes');
		update_option("webreserv_color_border", $webreserv_color_border, '', 'yes');
		update_option("webreserv_width", $webreserv_width, '', 'yes');
		update_option("webreserv_height", $webreserv_height, '', 'yes');
		
	}
}	

?>
<h2>WebReserv Options</h2>

<form method="post" action="">
<?php wp_nonce_field('update-options'); ?>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
	<td valign="top" width="40%">
	   <table border="0" cellspacing="5" cellpadding="5" >
		<tr>
			<td valign="top">Your Registration Site</td>
			<td>
			<?php $bcssite=get_option('webreserv_reg_site')?>
				<select name="webreserv_reg_site">
				<option value="www.webreserv.eu" <?php if($bcssite=="www.webreserv.eu") echo "selected='selected'";?>>www.webreserv.eu</option>
				<option value="www.webreserv.com" <?php if($bcssite=="www.webreserv.com") echo "selected='selected'";?>>www.webreserv.com</option>
			</select>
			</td>
		</tr>
		<tr>
		<style>
		.tooltip {
			display:none;
			background:#ccc;
			font-size:12px;
			height:70px;
			width:500px;
			padding:25px;
			color:#f00;
			border:3px solid #000;
			border-radius:5px;
		  }
		  #demo{
			float:left;
		  }
		  #demo img {
			border:0;
			cursor:pointer;
			margin:0 1px;
		  }
		</style>
		<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
		<script src="<?php echo plugins_url( 'jscolor/jscolor.js', __FILE__ ); ?>"></script>
		<script type="text/javascript">

		$(document).ready(function() {
		 
		  $("#demo img[title]").tooltip();
		 
		  });
		</script>
			<td valign="top"><span style="float:left; width:120px;">Your Buisness ID</span></td>
			<td><input style="float:left; width:150px;" type="text" name="webreserv_business_id" value="<?php echo get_option('webreserv_business_id'); ?>" size="19"/><div id="demo"><img src="/webreserv/dev/wordpress/wp-content/plugins/webreserv-booking-calender-plugin/help.png" width="20" title="To find your Business ID, log into your WebReserv account and click on Website in the top menu. Locate the link to your business listing on WebReserv in the first section. The information that is at the end of that link, after the last / mark, is your business ID. Ex: <a href='http://www.webreserv.eu/businessid'>http://www.webreserv.eu/businessid</a>." alt="Help"/></div>
			</td>
		</tr>
		<tr>
			<td valign="top">Version:</td>
			<td>	<?php  $bcsversion=get_option('webreserv_cal_version')?>
			<select id="webreserv_cal_version" name="webreserv_cal_version" onchange="versionChanged()">
				<option value="1" <?php if($bcsversion=="1") echo "selected='selected'";?>>Calendar 1.0</option>
				<option value="2" <?php if($bcsversion=="2") echo "selected='selected'";?>>Calendar 2.0</option>
			</select>
			</td>
		</tr>
</table>
<!--V1 Starts here-->
<div  id="v1Settings">
<table  border="0" cellspacing="5" cellpadding="5">
 <tr>
    <td valign="top">Booking Calendar Style</td>
    <td>
    		<?php $bcs=get_option('webreserv_cal_style')?>
		<select name="webreserv_cal_style">
			<option value="Link" <?php if($bcs=="Link") echo "selected='selected'";?>>Link</option>
			<option value="embedded" <?php if($bcs=="embedded") echo "selected='selected'";?>>Embedded</option>
			<option value="button" <?php if($bcs=="button") echo "selected='selected'";?>>Button</option>
		</select>
    </td>
</tr>

 <tr>
    <td valign="top">Include Search dates</td>
    <td>
    
   		<?php $bcssearch=get_option('webreserv_search_date')?>
		<select name="webreserv_search_date">
			<option value="y" <?php if($bcssearch=="y") echo "selected='selected'";?>>Yes</option>
			<option value="n" <?php if($bcssearch=="n") echo "selected='selected'";?>>No</option>
			
		</select>
    </td>
</tr>

<tr>
    <td valign="top">Include Listing</td>
    <td>
    	<?php  $bcslist=get_option('webreserv_inc_list')?>
   	<select name="webreserv_inc_list">
		<option value="y" <?php if($bcslist=="y") echo "selected='selected'";?>>Yes</option>
		<option value="n" <?php if($bcslist=="n") echo "selected='selected'";?>>No</option>
	</select>
    </td>
</tr>


</table>
<!--V1 Ends here-->
</div>
<!--V2 Starts here-->
<div id="v2Settings">
<table border="0" cellspacing="5" cellpadding="5">

<tr>
    <td valign="top">Booking Calendar Style</td>
    <td>
    		<?php $bcs2=get_option('webreserv_cal_style_v2')?>
		<select name="webreserv_cal_style_v2">
			<option value="Link" <?php if($bcs2=="Link") echo "selected='selected'";?>>Link</option>
			<option value="embedded" <?php if($bcs2=="embedded") echo "selected='selected'";?>>Embedded</option>
			<option value="button" <?php if($bcs2=="button") echo "selected='selected'";?>>Button</option>
		</select>
    </td>
</tr>
<tr>
    <td valign="top">Search:</td>
    <td>
   		<?php $bcssearch2=get_option('webreserv_search_v2')?>
		<select name="webreserv_search_v2">
			<option value="0" <?php if($bcssearch2=="0") echo "selected='selected'";?>>No Search</option>
			<option value="1" <?php if($bcssearch2=="1") echo "selected='selected'";?>>Start/end date</option>
			<option value="2" <?php if($bcssearch2=="2") echo "selected='selected'";?>>No. Nights</option>
			<option value="3" <?php if($bcssearch2=="3") echo "selected='selected'";?>>No. Days</option>
		</select>
    </td>
</tr>
<tr>
    <td valign="top">Availability/Rate Grid:</td>
    <td>
    	<?php  $bcsgrid=get_option('webreserv_avail_rate_grid_v2')?>
   	<select name="webreserv_avail_rate_grid_v2">
		<option value="y" <?php if($bcsgrid=="y") echo "selected='selected'";?>>Yes</option>
		<option value="n" <?php if($bcsgrid=="n") echo "selected='selected'";?>>No</option>
	</select>
    </td>
</tr>
</tr>
	<td valign="top">Calendar Height(px):</td>
	<td>
		<input style="float:left; width:150px;" type="text" name="webreserv_height" value="<?php echo get_option('webreserv_height'); ?>" size="19"/>
	</td>
<tr>
</tr>
	<td valign="top">Calendar Width(px):</td>
	<td>
		<input style="float:left; width:150px;" type="text" name="webreserv_width" value="<?php echo get_option('webreserv_width'); ?>" size="19"/>
	</td>
<tr>
<tr>
	<td valign="top">Color Theme:</td>
    <td>
    	<?php  $bcscolor=get_option('webreserv_color_theme_v2')?>
   	<select name="webreserv_color_theme_v2" id="webreserv_color_theme_v2" onchange="colorThemeChanged()">
	
		<option value="" <?php if($bcscolor=="") echo "selected='selected'";?>>Default</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-earthtones.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-earthtones.css") echo "selected='selected'";?>>Earthtones (Brown/Green)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-spa.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-spa.css") echo "selected='selected'";?>>Spa (Blue)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-light-grey.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-light-grey.css") echo "selected='selected'";?>>Rain (Lightgrey)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-grey.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-grey.css") echo "selected='selected'";?>>Silver (Grey)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-dark-grey.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-dark-grey.css") echo "selected='selected'";?>>Traditional (Darkgrey)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-grey-red.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-grey-red.css") echo "selected='selected'";?>>Traditional Red (Grey/Red)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-white-red.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-white-red.css") echo "selected='selected'";?>>Holiday (White/Red)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-white-red.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-white-red.css") echo "selected='selected'";?>>Sky (White/Lightblue)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-white-blue.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-white-blue.css") echo "selected='selected'";?>>Aqua (White/Blue)</option>
		<option value="/assets/css/bookingcalendar-2.0/theme-white-green.css" <?php if($bcscolor=="/assets/css/bookingcalendar-2.0/theme-white-green.css") echo "selected='selected'";?>>Green (White/Green)</option>
		<option value="custom" <?php if($bcscolor=="custom") echo "selected='selected'";?>>Choose your own</option>
		
	</select>
    </td>
</tr>
</table>
<table id="v2ColorPicker" style="display: none; margin-left: 12px;">
	<tr>
		<td width="150">Background Color:</td>
		<td><input style="text-align: center" class="color" size="6" name="webreserv_color_bg" id="webreserv_color_bg" value="<?php  echo get_option('webreserv_color_bg')?>" onclick="changeColor()"></td>
	</tr>
	<tr>
		<td width="150">Text Color:</td>
		<td><input style="text-align: center" class="color" size="6" name="webreserv_color_txt" id="webreserv_color_txt" value="<?php  echo get_option('webreserv_color_txt')?>" onclick="changeColor()"></td>
	</tr>
	<tr>
		<td width="150">Border Color:</td>
		<td><input style="text-align: center" class="color" size="6" name="webreserv_color_border" id="webreserv_color_border" value="<?php  echo get_option('webreserv_color_border')?>" onclick="changeColor()"></td>
	</tr>
</table>
<!-- V2 ends here-->
</div>

<table>
	<tr>
		<td valign="top"><textarea style="float:left; width:300px;" readonly name="webreserv_code" id="webreserv_code" cols="35" rows="6"><?php echo get_option('webreserv_code'); ?></textarea><br /><input type="submit" value="<?php _e('Save Changes') ?>" />
<input type="hidden" name="action" value="updatenew" />
<input type="hidden" name="page_options" value="webreserv_reg_site,webreserv_business_id,webreserv_cal_style,webreserv_search_date,webreserv_inc_list,webreserv_code" /></td>
	</tr>
</table>
</td>
<td width="60%" align="left" valign="top">
<table border="0" cellspacing="10" cellpadding="10" >
	<tr>
   	<td  valign="top">
		<b>1 -Create your FREE WebReserv account </b><br>
		Before you use the plugin, it is necessary that you sign up for a WebReserv free account. If your business is based in Europe, create your account on WebReserv.eu. If your business is based in Americas, Asia, or Australia, create your account on WebReserv.com<br><br>
		<!--[Create button “<a href="http://www.webreserv.eu/signup.do" target="_new">Get FREE account on WebReserv.EU</a>”]--><a class="button" target="_blank" href="http://www.webreserv.eu/signup.do">&nbsp;&nbsp;Get FREE account on WebReserv.EU&nbsp;&nbsp;</a><br><br>
<!--[Create button “<a href="http://www.webreserv.com/signup.do" target="_new">Get FREE account on WebReserv.COM</a>”]--><a class="button" target="_blank" href="http://www.webreserv.com/signup.do">&nbsp;&nbsp;Get FREE account on WebReserv.COM&nbsp;&nbsp;</a>
	</td>
	<td  valign="top">
		<b>2 -Setup your Webreserv account</b><br>
      Your next step is to set up your account in WebReserv.  To begin setup, log into your WebReserv account and follow the initial setup steps. After the initial setup, you can also customize your setup, rates, and templates, by clicking the "SETUP" tab. The set up will include your business information, all your products/inventory, descriptions, pictures, and prices. You can check our online help by clicking the "HELP" button.<p></p><a href ="http://www.webreserv.eu/login.do" target="_blank" class="button">&nbsp;&nbsp;Log Into WebReserv.EU Back Office&nbsp;&nbsp;</a><p></p><a href ="http://www.webreserv.com/login.do" target="_blank" class="button">&nbsp;&nbsp;Log Into WebReserv.COM Back Office&nbsp;&nbsp;</a>
	</td>
	</tr>
	<tr>
	  <td  valign="top">
		<b>3 - Add the WebReserv code<br>
   		 </b>Once the setup is complete, select the calendar options and click "Save changes" to see the preview. If you are happy with the result, insert the HTML code that has been generated into any POST or PAGE to have the calendar showing.
	 </td>
  	  <td   valign="top">
			<b>4 -Start using WebReserv</b><br />Once you have successfully set up your WebReserv account and added the calendar using the Wordpress plugin, you can start receiving and managing your reservations. If you have any question, click the "HELP" button in your account or send an Email to <a href="mailto:support@webreserv.eu">support@webreserv.eu</a> for Europe or <a href="mailto:support@webreserv.com">support@webreserv.com</a> for America, Asia, and Australia.

	</td>
	
 	</tr>
	
	
  <!--<tr>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    </tr>-->
</table>
</td>
</tr>
</table>
</form>
<div><fieldset style="border:1px solid;padding:30px;min-height:100px;">
    <legend>Preview:</legend>
    <?php echo get_option('webreserv_code'); ?>
  </fieldset>
</div>
<div style="display:none;">
<div style="margin-bottom:20px;"><h2>WebReserv Embedded Booking Calendar</h2></div>
	<div style="float:left;">
	<b>Example Booking Component Screenshots</b><br>
	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=accomodation_9_large.PNG" target="_blank"><img src="<?php echo $url; ?>/accomodation_9_small.PNG" border="0" /></a>&nbsp;&nbsp;
     	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=accomodation_5_large.PNG" target="_blank"><img src="<?php echo $url; ?>/accomodation_5_small.PNG" border="0" /></a>&nbsp;&nbsp;
	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=boat_hire_3_large.PNG" target="_blank"><img src="<?php echo $url; ?>/boat_hire_3_small.PNG" border="0" /></a><br>
	<br>
	<b>Back-Office Screenshots</b><br>
	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=navigation_1_large.PNG" target="_blank"><img src="<?php echo $url; ?>/navigation_1_small.PNG" border="0" /></a>&nbsp;&nbsp;
     	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=bookings_overview_1_large.PNG" target="_blank"><img src="<?php echo $url; ?>/bookings_overview_1_small.PNG" border="0" /></a>&nbsp;&nbsp;
	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=bookings_overview_2_large.PNG" target="_blank"><img src="<?php echo $url; ?>/bookings_overview_2_small.PNG" border="0" /></a><br>
	<br>
	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=reports_1_large.PNG" target="_blank"><img src="<?php echo $url; ?>/reports_1_small.PNG" border="0" /></a>&nbsp;&nbsp;
     	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=widget_1_large.PNG" target="_blank"><img src="<?php echo $url; ?>/widget_1_small.PNG" border="0" /></a>&nbsp;&nbsp;
	<a href="http://tasks.webreserv.eu/webreserv_screenshots/show_large_screenshot.html?image=help_1_large.PNG" target="_blank"><img src="<?php echo $url; ?>/help_1_small.PNG" border="0" /></a>
	<br />
	<span style="float:left;width:400px;padding-left:0px;">
<hr>
<strong>Sign Up for a WebReserv Account</strong><br>
<p style="font-size:10px;">Create a FREE account on either WebReserv .EU or .COM</p>
<b>Sign Up for a WebReserv.EU Account</b><br>
<p style="font-size:10px;">If your business is located in Europe (Not just EU, but any country in Europe), then you can sign up for a WebReserv.EU account.<br>
<a href ="http://www.webreserv.eu/signup.do" target="_new">Click here to create a <b>.EU</b> account</a></p>
<b>Sign Up for a WebReserv.COM Account</b><br>
<p style="font-size:10px;">If your business is located in any other country in the world, then you can sign up for a WebReserv.COM account.<br>
<a href ="http://www.webreserv.com/signup.do?referralID=x1013" target="_new">Click here to create a <b>.COM</b> account</a></p>
	<br />
	</span>
</div>
<script>
function versionChanged()
{
	//alert($('#webreserv_cal_version').val());
	var v = $('#webreserv_cal_version').val();
	if (v == 1)
	{
		$('#v2Settings').hide();
		$('#v1Settings').show();
	} else
	if (v == 2)
	{
		$('#v1Settings').hide();
		$('#v2Settings').show();
	}	

}
function colorThemeChanged()
{
	var theme = $('#webreserv_color_theme_v2').val();
	if (theme == 'custom')
	{
		$('#v2ColorPicker').show();
	} else
	{
		$('#v2ColorPicker').hide();
	}
}
$(document).ready(function()
{
	versionChanged();
	colorThemeChanged();
});
</script>	
<?php
}
function WebReserv_install() {
	/* Creates new database field */
	add_option("webreserv_code", '<iframe src=http://www.webreserv.com/services/bookonline.do?businessid=DCSA&embedded=y&list=n width=700px height=900px scrolling=auto frameborder=0></iframe>', '', 'yes');
	add_option("webreserv_reg_site", 'www.webreserv.com', '', 'yes');
	add_option("webreserv_business_id", 'DCSA', '', 'yes');
	add_option("webreserv_cal_version", '1', '', 'yes');
	/*v1 options*/
	add_option("webreserv_cal_style", 'embedded', '', 'yes');
	add_option("webreserv_search_date", 'n', '', 'yes');
	add_option("webreserv_inc_list", 'n', '', 'yes');
	/*v2 options*/
	add_option("webreserv_cal_style_v2", 'embedded', '', 'yes');
	add_option("webreserv_search_v2", '0', '', 'yes');
	add_option("webreserv_avail_rate_grid_v2", 'y', '', 'yes');
	add_option("webreserv_width", '700', '', 'yes');
	add_option("webreserv_height", '900', '', 'yes');
	add_option("webreserv_color_theme_v2", 'Default', '', 'yes');
	add_option("webreserv_color_bg", 'EBEBE8', '', 'yes');
	add_option("webreserv_color_txt", '000000', '', 'yes');
	add_option("webreserv_color_border", '6F6FFF', '', 'yes');
}
function WebReserv_remove() {
	/* Deletes the database field */
	delete_option("webreserv_code");
	delete_option("webreserv_reg_site");
	delete_option("webreserv_business_id");
	delete_option("webreserv_cal_version");
	/*v1 options*/
	delete_option("webreserv_cal_style");
	delete_option("webreserv_search_date");
	delete_option("webreserv_inc_list");
	/*v2 options*/
	delete_option("webreserv_cal_style_v2");
	delete_option("webreserv_search_v2");
	delete_option("webreserv_avail_rate_grid_v2");
	delete_option("webreserv_color_theme_v2");
	delete_option("webreserv_color_bg");
	delete_option("webreserv_color_txt");
	delete_option("webreserv_color_border");
}

function my_admin_notice() {
	global $hook_suffix;
	
	if ( $hook_suffix == 'plugins.php'){
    ?>
		<style type="text/css">
			.webreserv-notice{
				background:#83AF24!important;
				color:#fff;
				background-image:-moz-linear-gradient(80% 100% 120deg,#83AF24,#4F800D)!important;
				}
		</style>
		<div class="webreserv-notice updated">
			<p>Almost done – Go to <strong>Settings – WebReserv 2.0</strong> to select your calendar options</p>
		</div>
    <?php
	}
}
add_action( 'admin_notices', 'my_admin_notice' );