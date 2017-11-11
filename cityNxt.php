<?php
/**
 * Plugin Name: cityNxt
 * Plugin URI: http://google.com
 * Description: Allows you to add cities/locations to your wordpress page.
 * Version: 1.0.0
 * Author: Professor X
 * Author URI: http://prox.com
 * License: A short license name. Example: GPL2
 */

add_action('admin_menu', 'cityNxt_options');
 
function cityNxt_options(){
        add_menu_page( 'cityNxt Options', 'cityNxt Options', 'manage_options', 'test-plugin', 'cityNxt_init');
}
function cityNxt_init(){
        include dirname(__FILE__)."/manage_city_info.php";
}

?>