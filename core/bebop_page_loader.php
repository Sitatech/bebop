<?php
//File used to load pages

function bebop_admin_menu() {

    if (!is_super_admin()) {
	    return false;
    }
    add_menu_page(
    	__('Bebop Admin', 'bebop'), 
    	__('Bebop', 'bebop'), 
    	'manage_options',
    	'bebop_admin', 
    	'bebop_welcome',
    	WP_PLUGIN_URL . "/bebop/core/includes/images/bebop_icon.png"
     );
     
     add_submenu_page( 'bebop_admin', 'Admin', 'Admin', 'manage_options', 'bebop_admin', 'bebop_welcome' );
	 add_submenu_page( 'bebop_admin', 'random_function', 'random_function', 'random_function', 'random_function', 'random_function' ); 

    function bebop_welcome() {
    	echo "Helloz?";
	     /*if (!isset($_GET["settings"])) {
	        include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/Dashboard.php";
	     } else if ($_GET["settings"] == "admin") {
	        include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/Dashboard.php";
	     } else if ($_GET["settings"] == "cronjob") {
	         include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/Cronjob.php";
	     } else if ($_GET["settings"] == "powercentral") {
	         include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/Powercentral.php";
	     } else if ($_GET["settings"] == "general") {
	         include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/General.php";
	     } else if ($_GET["settings"] == "log") {
	         include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/Log.php";
	     } else if ($_GET["settings"] == "version2") {
	         include WP_PLUGIN_DIR . "/buddystream/extentions/default/templates/Version2.php";
	     }   */
	}
}
function random_function() {
	echo "random function....";
}

add_action('admin_menu', 'bebop_admin_menu');
add_action('network_admin_menu', 'bebop_admin_menu');
?> 