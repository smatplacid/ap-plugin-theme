<?php

add_action( 'wp_footer', 'ap_footer_hook', 50 );
function ap_footer_hook() {

	echo "
	<script>
		$('.slick-ul-inside ul').slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 4,
			nextArrow: '<i class=\"fa fa-arrow-right\"></i>',
			prevArrow: '<i class=\"fa fa-arrow-left\"></i>',
		});
	</script>
	";

}