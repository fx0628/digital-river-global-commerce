<?php
/**
 * Subscription Details Shortcode
 *
 * Used on the Subscription Details page, the Subs Details shortcode displays the subscription details.
 *
 * @link       https://www.digitalriver.com
 * @since      1.3.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/includes/shortcodes
 */

defined( 'ABSPATH' ) || exit;

/**
 * Shortcode cart class.
 */
class DR_Shortcode_Subs_Details {

	/**
	 * Output the subs details shortcode.
	 *
   * @since    1.3.0
   * @access   public
	 * @param array $atts Shortcode attributes.
	 */
	public static function output( $atts ) {
		$subs_details = DRGC()->shopper->get_subscription_details();

		drgc_get_template(
			'subscription-details/subscription-details.php',
			array(
				'subs_details' => $subs_details,
			)
		);
	}
}
