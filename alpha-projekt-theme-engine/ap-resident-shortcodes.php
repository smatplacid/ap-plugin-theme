<?php

function ap_output_date() {
	return date( 'Y' );
}
add_shortcode( 'ap_date', 'ap_output_date' );