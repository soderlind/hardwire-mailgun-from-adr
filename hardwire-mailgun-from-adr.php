<?php declare( strict_types = 1 );

/**
 * Hardwire Mailgun FROM address.
 *
 * @package     Soderlind\Plugin\Mailgun
 * @author      Per Soderlind
 * @copyright   2020 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Hardwire Mailgun FROM address.
 * Plugin URI: https://github.com/soderlind/hardwire-mailgun-from-adr
 * GitHub Plugin URI: https://github.com/soderlind/hardwire-mailgun-from-adr
 * Description: Set the Mailgun from address using the MAILGUN_FROM_ADDRESS constant. Will override other from addresses. Will also hardwire the Ninja Forms email from name and address.
 * Version:     1.1.0
 * Author:      Per Soderlind
 * Author URI:  https://soderlind.no
 * Text Domain: hardwire-mailgun-from-adr
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

 namespace Soderlind\Plugin\Mailgun;

if ( ! defined( 'ABSPATH' ) ) {
	wp_die();
}


/**
 * Filters the email address to send from.
 *
 * Mailgun set the address resolution order in this order:
 *  1. From address given by headers - {@param $from_addr_header}
 *  2. From address set in Mailgun settings
 *  3. From `MAILGUN_FROM_ADDRESS` constant
 *  4. From address constructed as `wordpress@<your_site_domain>`
 *
 * So, if 1 or 2 above is true, the from address will not be set by the MAILGUN_FROM_ADDRESS constant
 * @link https://github.com/mailgun/wordpress-plugin/blob/9da7978246a3983159c8577c1ac09cedc075a2da/includes/mg-filter.php#L142-L148
 *
 *
 * This filter will override these and use the MAILGUN_FROM_ADDRESS constant.
 *
 * @param string $from_email Email address to send from.
 * @return string Email address to send from.
 */
add_filter( 'wp_mail_from', function( string $from_email ) : string {

	if ( defined( 'MAILGUN_FROM_ADDRESS' ) ) {
		$from_email = \MAILGUN_FROM_ADDRESS;
	}

	return $from_email;
} );

/**
 * Filters the email name.
 *
 * Mailgun set the from name resolution in this order:
 *  1. From name given by headers - {@param $from_name_header}
 *  2. From name set in Mailgun settings
 *  3. From `MAILGUN_FROM_NAME` constant
 *  4. From name constructed as `<your_site_title>` or "WordPress"
 *
 * So, if 1 or 2 above is true, the from address will not be set by the MAILGUN_FROM_NAME constant
 * @link https://github.com/mailgun/wordpress-plugin/blob/9da7978246a3983159c8577c1ac09cedc075a2da/includes/mg-filter.php#L75-L79
 *
 *
 * This filter will override these and use the MAILGUN_FROM_NAME constant.
 *
 * @param string $from_email Email address to send from.
 * @return string Email address to send from.
 */
add_filter( 'wp_mail_from_name',function( string $from_name ) : string {

	if ( defined( 'MAILGUN_FROM_NAME' ) ) {
		$from_name = \MAILGUN_FROM_NAME;
	}

	return $from_name;
} );

/**
 * Hardwire Ninja Forms from name and from address.
 */
add_filter( 'ninja_forms_run_action_settings', function ( $action_settings, $form_id, $action_id, $form_settings ) {

	if ( 'email' === $action_settings['type'] ) {
		if ( defined( 'MAILGUN_FROM_NAME' ) ) {
			$action_settings['from_name'] = \MAILGUN_FROM_NAME;
		}

		if ( defined( 'MAILGUN_FROM_ADDRESS' ) ) {
			$action_settings['from_address'] = \MAILGUN_FROM_ADDRESS;
		}
	}

  return $action_settings;
},  10, 4 );

