<?php
/*
Plugin Name: Cookie Law
Plugin URI: /
Description: V.1.0 - Display a notification bar to show how your site complies with the UK & EU Cookie Law. Custom design settings are available.
Author: johnsond503
Version: 1.0
Author URI: /
*/

define ('CPLUGIN_PLUGIN_BASE_DIR', WP_PLUGIN_DIR, true);

function cookieplugin(){
echo '<link rel="stylesheet" type="text/css" href="'; echo get_option('siteurl'); echo '/wp-content/plugins/cookie-plugin/style.min.css"/>';
echo '<script type="text/javascript" src="'; echo get_option('siteurl'); echo '/wp-content/plugins/cookie-plugin/plugin.min.js"></script>';
echo '<script type="text/javascript">';
// <![CDATA[
echo 'cc.initialise({';
echo 'cookies: {';
		echo 'social: {},';
		echo 'analytics: {},';
		echo 'advertising: {}';
	echo '},';
	echo 'settings: {';
		echo 'consenttype: "implicit"';
	echo '}';
echo '});';
// ]]>
echo '</script>';
}


function oscimp_admin() {
			include('import_admin.php');
		}

		function oscimp_admin_actions() {
    add_options_page("cookie-law-free", "cookie-law-free", 1, "cookie-law-free", "oscimp_admin");  
		}

		add_action('admin_menu', 'oscimp_admin_actions');
	
register_activation_hook(__FILE__, 'cp_plugin_activate');
add_action('admin_init', 'cp_plugin_redirect');

function cp_plugin_activate() {
    add_option('cp_plugin_do_activation_redirect', true);
}

function cp_plugin_redirect() {
    if (get_option('cp_plugin_do_activation_redirect', false)) {
        delete_option('cp_plugin_do_activation_redirect');
        wp_redirect('../wp-admin/options-general.php?page=cookie-law-free');
    }
}
?>