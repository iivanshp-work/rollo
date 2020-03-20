<?php
/**
 * @link              https://morkva.co.ua?utm_source=woo-ukrposhta-pro
 * @since             1.0.0
 * @package           morkvaup-plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Ukrposhta
 * Plugin URI:        https://www.morkva.co.ua/woocommerce-plugins/woo-ukrposhta-plahin-dlia-woocommerce/?utm_source=woo-ukrposhta-pro
 * Description:       Генеруйте накладні просто зі сторінки замовлення і зекономте тонну часу на відділенні при відправці.
 * Version:           0.6
 * Author:            MORKVA
 * Author URI:        https://morkva.co.ua?utm_source=woo-ukrposhta-pro
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-ukrposhta-pro
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
defined( 'ABSPATH' ) or die( 'Ти що хакер?' );

require_once 'ukrposhta.php';



require_once ABSPATH . 'wp-admin/includes/plugin.php';
$plugData = get_plugin_data(__FILE__);

if ($plugData['Name'] == 'Woo Ukrposhta'){
  if(file_exists('freemius/freemiusimport.php') ){
    require_once 'freemius/freemiusimport.php';
  }
}
define( 'MUP_PLUGIN_VERSION', $plugData['Version'] );
define( 'MUP_PLUGIN_NAME', $plugData['Name'] );
define( 'MUP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'MUP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'MUP_TABLEDB', 'uposhta_invoices');

function activate_morkvaup_plugin() {
	require_once MUP_PLUGIN_PATH . 'includes/class-morkvaup-plugin-activator.php';
	MUP_Plugin_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-morkvaup-plugin-deactivator.php
 */
function deactivate_morkvaup_plugin() {
	require_once MUP_PLUGIN_PATH . 'includes/class-morkvaup-plugin-deactivator.php';
	MUP_Plugin_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_morkvaup_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_morkvaup_plugin' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-morkvaup-plugin.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_morkvaup_plugin() {
	$plugin = new MUP_Plugin();
	$plugin->run();
}
run_morkvaup_plugin();
 
