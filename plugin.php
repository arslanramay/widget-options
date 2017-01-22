<?php
/**
 * Plugin Name: Widget Options
 * Plugin URI: https://widget-options.com/
 * Description: Additional Widget options for better widget control. Get <strong><a href="http://widget-options.com/" target="_blank" >Extended Widget Options for WordPress</a></strong> for complete widget controls. Thanks!
 * Version: 3.2
 * Author: Phpbits Creative Studio
 * Author URI: https://phpbits.net/
 * Text Domain: widget-options
 * Domain Path: languages
 *
 * @category Widgets
 * @author Jeffrey Carandang
 * @version 3.2
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'WP_Widget_Options' ) ) :

/**
 * Main WP_Widget_Options Class.
 *
 * @since  3.2
 */
final class WP_Widget_Options {
	/**
	 * @var WP_Widget_Options The one true WP_Widget_Options
	 * @since  3.2
	 */
	private static $instance;

	/**
	 * Main WP_Widget_Options Instance.
	 *
	 * Insures that only one instance of WP_Widget_Options exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since  3.2
	 * @static
	 * @staticvar array $instance
	 * @uses WP_Widget_Options::setup_constants() Setup the constants needed.
	 * @uses WP_Widget_Options::includes() Include the required files.
	 * @uses WP_Widget_Options::load_textdomain() load the language files.
	 * @see WIDGETOPTS()
	 * @return object|WP_Widget_Options The one true WP_Widget_Options
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WP_Widget_Options ) ) {
			self::$instance = new WP_Widget_Options;
			self::$instance->setup_constants();

			// add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
			// self::$instance->roles         = new WIDGETOPTS_Roles();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access private
	 * @since 4.1
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'WIDGETOPTS_PLUGIN_NAME' ) ) {
			define( 'WIDGETOPTS_PLUGIN_NAME', 'Widget Options' );
		}

		// Plugin version.
		if ( ! defined( 'WIDGETOPTS_VERSION' ) ) {
			define( 'WIDGETOPTS_VERSION', ' 3.2' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'WIDGETOPTS_PLUGIN_DIR' ) ) {
			define( 'WIDGETOPTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'WIDGETOPTS_PLUGIN_URL' ) ) {
			define( 'WIDGETOPTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'WIDGETOPTS_PLUGIN_FILE' ) ) {
			define( 'WIDGETOPTS_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 4.1
	 * @return void
	 */
	private function includes() {
		global $widget_options, $extended_license, $widgetopts_taxonomies, $widgetopts_pages, $widgetopts_categories, $pagenow;

		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/register-settings.php';
		$widget_options = widgetopts_get_settings();

		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/extras.php';
		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/scripts.php';

		//call admin only resources
		if ( is_admin() ) {

			//other global variables to prevent duplicate and faster calls
			$widgetopts_taxonomies 	= widgetopts_global_taxonomies();
			$widgetopts_pages 		= widgetopts_global_pages();
			$widgetopts_categories 	= widgetopts_global_categories();

			//admin settings
			require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/welcome.php';
			require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/display-settings.php';

			if( in_array( $pagenow, array( 'options-general.php' ) ) ){
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/visibility.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/devices.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/alignment.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/title.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/classes.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/logic.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/links.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/fixed.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/columns.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/roles.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/dates.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/styling.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/animation.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/taxonomies.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/disable_widgets.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/permission.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/shortcodes.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/cache.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/siteorigin.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/sidebar-upsell_pro.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/sidebar-opt_in.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/sidebar-more_plugins.php';
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/admin/settings/modules/sidebar-support_box.php';
			}

			// if( in_array( $pagenow, array( 'widgets.php' ) ) ){
				//widget callbacks
				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/widgets.php';

				//add visibility tab if activated
				if( $widget_options['visibility'] == 'activate' ){
					require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/option-tabs/visibility.php';
				}
				//add devices tab if activated
				if( $widget_options['devices'] == 'activate' ){
					require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/option-tabs/devices.php';
				}

				//add alignment tab if activated
				if( $widget_options['alignment'] == 'activate' ){
					require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/option-tabs/alignment.php';
				}

				//add settings tab if activated
				if( 'activate' == $widget_options['hide_title'] ||
			        'activate' == $widget_options['classes'] ||
			        'activate' == $widget_options['logic'] ){
					require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/option-tabs/settings.php';
				}

				require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/option-tabs/upsell.php';
			// }

		} //end is_admin condition

		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/extras.php';
		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/widgets/display.php';
		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/ajax-functions.php';

		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/pagebuilders/siteorigin.php';
		require_once WIDGETOPTS_PLUGIN_DIR . 'includes/install.php';
	}

}

endif; // End if class_exists check.


/**
 * The main function for that returns WP_Widget_Options
 *
 * The main function responsible for returning the one true WP_Widget_Options
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $widgetopts = WP_Widget_Options(); ?>
 *
 * @since 3.2
* @return object|WP_Widget_Options The one true WP_Widget_Options Instance.
 */
function WIDGETOPTS() {
	return WP_Widget_Options::instance();
}
// Get Plugin Running.
WIDGETOPTS();
?>
