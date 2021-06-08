<?php declare( strict_types = 1 );

/**
 * Set Mailgun FROM address.
 *
 * @package     Soderlind\Plugin\Mailgun
 * @author      Per Soderlind
 * @copyright   2020 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Hardwire the MAILGUN_FROM_ADDRESS as the email FROM address.
 * Plugin URI: https://github.com/soderlind/hardwire-mailgun-from-adr
 * GitHub Plugin URI: https://github.com/soderlind/hardwire-mailgun-from-adr
 * Description: Set the Mailgun from address using the MAILGUN_FROM_ADDRESS constant. Will override other from addresses.
 * Version:     0.0.1
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