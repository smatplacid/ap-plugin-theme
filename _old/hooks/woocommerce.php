<?php
/**
 * @snippet       Add CSS to WooCommerce Emails
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=20648
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 2.6.2
 */

add_action( 'woocommerce_email_header', 'bbloomer_add_css_to_emails' );

function bbloomer_add_css_to_emails() {
	?>
    <style type="text/css">
        .order_total *, .order_total p span, .order_total span {
            color: #009CBE !important;
            font-weight: bold;
        }
    </style>
	<?php
}

//add_action( 'woocommerce_email_footer', 'bbloomer_woocommerce_email_footer' );
function bbloomer_woocommerce_email_footer() {
	?>
    jkdhcf

	<?php
}
