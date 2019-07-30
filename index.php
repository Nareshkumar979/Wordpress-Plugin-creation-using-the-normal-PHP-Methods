<?php
/*
Plugin Name:Sermons
Plugin URI: http://www.sdkattech.com/
Description: This plugin will be able to list all the properties based the Sermon Archives and the Locations.
Author: Naresh Kumar .P
Author URI: http://www.sdkattech.com/
*/
error_reporting (0);
ob_start();
session_start();
wp_enqueue_script('jquery-ui-datepicker');
$siteurl = get_option('siteurl');
define('ICT_SE_FOLDER', dirname(plugin_basename(__FILE__)));
define('ICT_SE_URL', $siteurl.'/wp-content/plugins/'.ICT_SE_FOLDER);
define('ICT_SE_FILE_PATH', dirname(__FILE__));
define('ICT_SE_DIR_NAME', basename(ICT_JE_FILE_PATH));
// this is the table prefix
global $wpdb;
$se_prefix=$wpdb->prefix.'ictse_';
define('ICT_SE', $se_prefix);
$table1 = ICT_SE."sermons";
define('SE_SERMONS', $table1);
$table2 = ICT_SE."sermon_events";
define('SE_SERMONS_EVENT', $table2);
$table3 = ICT_SE."sermon_category";
define('SE_SERMONS_CATEGORY', $table3);
$table4 = ICT_SE."location";
define('SE_SERMONS_LOCATION', $table4);
$table5 = ICT_SE."tag";
define('SE_SERMONS_TAG', $table5);
register_activation_hook(__FILE__,'ict_se_install');   
function ict_se_install()
{
   global $wpdb;
  $ictpl = "CREATE TABLE IF NOT EXISTS ".SE_SERMONS." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sermons_category_id` varchar(5000) NOT NULL,
  `sermons_desc` LONGTEXT  NOT NULL,
   `featured_img` VARCHAR( 100000 ) NOT NULL,
   `sermons_category` VARCHAR( 5000 ) NOT NULL,
   `sermons_date` VARCHAR( 5000 ) NOT NULL,
   `sermons_slug` VARCHAR( 5000 ) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
$wpdb->query($ictpl);
$ictp2 = "CREATE TABLE IF NOT EXISTS ".SE_SERMONS_EVENT." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(5000) NOT NULL,
  `event_title_slug` varchar(5000) NOT NULL,
  `event_desc` LONGTEXT  NOT NULL,
   `event_organisers` varchar(5000) NOT NULL,
   `event_date` varchar(5000) NOT NULL,
   `event_categories` varchar(5000) NOT NULL,
   `categories_id` varchar(5000) NOT NULL,
   `categories_tag` varchar(5000) NOT NULL,
   `categories_images` LONGTEXT  NOT NULL,
   `youtube_url` LONGTEXT  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
$wpdb->query($ictp2);
$ictp3 = "CREATE TABLE IF NOT EXISTS ".SE_SERMONS_CATEGORY." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(5000) NOT NULL,
  `category_slug` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
$wpdb->query($ictp3);
$ictp4 = "CREATE TABLE IF NOT EXISTS ".SE_SERMONS_LOCATION." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_title` varchar(5000) NOT NULL,
  `location_desc` LONGTEXT  NOT NULL,
  `location_day` LONGTEXT  NOT NULL,
  `location_time` LONGTEXT  NOT NULL,
   `fetcher_img` VARCHAR( 100000 ) NOT NULL,
   `special` LONGTEXT  NOT NULL,
   `special_img` LONGTEXT  NOT NULL,
   `header_img` LONGTEXT  NOT NULL,
   `youtube` LONGTEXT  NOT NULL,
   `location_address` LONGTEXT  NOT NULL,
   `location_title_slug` VARCHAR(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
$wpdb->query($ictp4);
$ictp5 = "CREATE TABLE IF NOT EXISTS ".SE_SERMONS_TAG." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(5000) NOT NULL,
  `tag_slug` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	$wpdb->query($ictp5);
}
add_action('admin_menu','ictje_admin_menu');
function ictje_admin_menu()
{
add_menu_page(
		"Sermons",
		"Sermons",
		"8",
		"sermons_file",
		"add_sermon",
		ICT_SE_URL."/images/logo.png"
	); 
add_submenu_page(sermons_file,'Categories','Categories','8','categories','add_category');
add_submenu_page(sermons_file,'Tags','Tags','8','tags','add_tags');
add_submenu_page(sermons_file,'Sermon Event','Sermon Event','8','sermonevent','add_sermon_event');
add_submenu_page(sermons_file,'Locations','Locations','8','locations','add_locations');
}
function add_sermon()
{
	include'seromons.php';
}
function add_category(){
	
	include'categories.php';
}
function add_tags(){
	include'tags.php';
}
function add_sermon_event(){
	include'sermonevent.php';
}
function add_locations()
{
	include'locations.php';
}
?>