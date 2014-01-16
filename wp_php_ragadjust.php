<?php
/*
Plugin Name: PHP Ragadjust
Plugin URI: https://github.com/arnoesterhuizen/wp_php_ragadjust
Description: Declares a plugin that will adjust copy rag on save as per http://markboulton.co.uk/journal/twenty-four-ways-run-ragged.
Version: 1.0
Author: Arno Esterhuizen
Author URI: https://www.facebook.com/arno.esterhuizen
License: GPLv2
*/

if(!class_exists('WP_PHP_Ragadjust'))
{
	class WP_PHP_Ragadjust
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$WP_PHP_Ragadjust_Settings = new WP_PHP_Ragadjust_Settings();

			// Register ragadjust
			require_once(sprintf("%s/actions.php", dirname(__FILE__)));
			$Ragadjust = new Ragadjust();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
		} // END public static function deactivate

		// Add the settings link to the plugins page
		public function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_php_ragadjust">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		} // END public function plugin_settings_link
	} // END class WP_PHP_Ragadjust
} // END if(!class_exists('WP_PHP_Ragadjust'))

if(class_exists('WP_PHP_Ragadjust'))
{
	// instantiate the plugin class
	$wp_php_ragadjust = new WP_PHP_Ragadjust();

	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('WP_PHP_Ragadjust', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_PHP_Ragadjust', 'deactivate'));
}
