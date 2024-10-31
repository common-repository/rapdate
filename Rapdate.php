<?php
/*
Plugin Name: Rapdate
Plugin URI: http://wordpress.freeall.org/?p=372&lang=en
Description: Adding an attribute to post and 
Author: Asaf Chertkoff (FreeAllWeb GUILD)
Author URI: http://wordpress.freeall.org
Version: 1.0
Text Domain:Rapdate
*/

/*  Copyright 2009  Asaf Chertkoff  (email : asaf@freeallweb.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'Rapdate_create_menu');
add_action('init','Rapdate_loadlang');

$opt = get_option('rapdate_opt_check'); 
$opt2 = get_option('rapdate_opt2_check'); 

if($opt=='checked') add_action('publish_post','Rapdate_save_post');
if($opt2=='checked') add_action('publish_page','Rapdate_save_page');
   
function Rapdate_create_menu() {
	add_submenu_page('plugins.php','Rapdate','Rapdate','administrator','Rapdate','Rapdate_show_menu_page');
}

function Rapdate_loadlang() {
	load_plugin_textdomain('Rapdate','',plugin_basename( dirname( __FILE__ ).'/translation'));
}

function Rapdate_show_menu_page() {
	$Rapdate_check_val = get_option('Rapdate_opt_check');
	$Rapdate_check2_val = get_option('Rapdate_opt2_check');
	$hidden_field_name = 'hiddensubmit'; 			// hidden input name
	
	if( $_POST[ $hidden_field_name ] == 'Y' ) {
		$Rapdate_check_val = $_POST[ 'Rapdate_check_name_field'];	
		$Rapdate_check2_val = $_POST[ 'Rapdate_check2_name_field'];		
		update_option('Rapdate_opt_check', $Rapdate_check_val); 
		update_option('Rapdate_opt2_check', $Rapdate_check2_val); 
	} 				
	
 	echo '<div class="wrap">';
 	echo '<h1>'.__('Rapdate 1.0','Rapdate').'</h1>';
 	echo '<p>'.__('Rapdate is a simple plugin for wordpress sites that need to edit and re-edit a lot of different posts and/or pages. It overcomes the irritating core behavior that binding you to stay inside the post or page after pressing the "update" button.','Rapdate').'</p>';
 	echo '<p>'.__('When this plugin is on and the checkbox below is checked, after clicking the "update" button, it will send you directly to the list of posts or pages, accordingly.','Rapdate').'</p><hr/>';
 	 	
 	echo '<form name="Rapdate_form" method="post" action="">';
	echo '<input type="hidden" name="'.$hidden_field_name.'" value="Y">';
	echo '<p>'.__('Rapid check out from posts?','Rapdate');
	echo '<input type="checkbox" name="Rapdate_check_name_field" value="checked" '.$Rapdate_check_val.' size="15"><br/>';
	echo '</p>';
	echo '<p>'.__('Rapid check out from pages?','Rapdate');
	echo '<input type="checkbox" name="Rapdate_check2_name_field" value="checked" '.$Rapdate_check2_val.' size="15"><br/>';
	echo '</p>';
	echo '<p class="submit">';
	echo '<input type="submit" name="Submit" value="'. __('save settings','Rapdate').'" />';
	echo '</p></form>';
	
  	echo '</div><hr/>';
 	echo '<div class="warp"><h3>'.__('If you want to give something back:','Rapdate').'</h3>';
	echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="9810099"><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>';
	echo '<p><a href="http://www.amazon.com/wishlist/21SEN5UC15V17/ref=reg_hu-wl_goto-registry?_encoding=UTF8&sort=date-added" alt="'.__('My Amazon Wishlist','Rapdate').'">'.__('My Amazon Wishlist','Rapdate').'</a></p></div>';
}

function Rapdate_save_post() {
		wp_redirect('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		exit;
}

function Rapdate_save_page() { 
		wp_redirect('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		exit;
}

?>