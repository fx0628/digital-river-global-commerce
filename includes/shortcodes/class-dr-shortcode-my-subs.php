<?php
/**
 * My Subscriptions Shortcode
 *
 * Used on the My Subscriptions page, the My Subscriptions shortcode displays the user's subscriptions list.
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
class DR_Shortcode_My_Subs {

	/**
	 * Output the my subs shortcode.
	 *
   * @since    1.3.0
   * @access   public
	 * @param array $atts Shortcode attributes.
	 */
	public static function output( $atts ) {
		$subs = DRGC()->shopper->retrieve_subscriptions();

		drgc_get_template(
			'my-subscriptions/my-subscriptions.php',
			array(
				'subs' => $subs,
			)
		);
	}
}
