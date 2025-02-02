<?php
/**
 * Main plugin file.
 *
 * @package Bootstrap
 * @author  Pierre Lannoy <https://pierre.lannoy.fr/>.
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       OPcache Manager
 * Plugin URI:        https://perfops.one/opcache-manager
 * Description:       OPcache statistics and management right in the WordPress admin dashboard.
 * Version:           2.11.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Pierre Lannoy / PerfOps One
 * Author URI:        https://perfops.one
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Network:           true
 * Text Domain:       opcache-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once __DIR__ . '/init.php';
require_once __DIR__ . '/includes/system/class-option.php';
require_once __DIR__ . '/includes/system/class-environment.php';
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/includes/libraries/class-libraries.php';
require_once __DIR__ . '/includes/libraries/autoload.php';
require_once __DIR__ . '/includes/features/class-wpcli.php';

/**
 * The code that runs during plugin activation.
 *
 * @since 1.0.0
 */
function opcm_activate() {
	OPcacheManager\Plugin\Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 *
 * @since 1.0.0
 */
function opcm_deactivate() {
	OPcacheManager\Plugin\Deactivator::deactivate();
}

/**
 * The code that runs during plugin uninstallation.
 *
 * @since 1.0.0
 */
function opcm_uninstall() {
	OPcacheManager\Plugin\Uninstaller::uninstall();
}

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
function opcm_run() {
	\DecaLog\Engine::initPlugin( OPCM_SLUG, OPCM_PRODUCT_NAME, OPCM_VERSION, \OPcacheManager\Plugin\Core::get_base64_logo() );
	$plugin = new OPcacheManager\Plugin\Core();
	$plugin->run();
}

register_activation_hook( __FILE__, 'opcm_activate' );
register_deactivation_hook( __FILE__, 'opcm_deactivate' );
register_uninstall_hook( __FILE__, 'opcm_uninstall' );
opcm_run();
