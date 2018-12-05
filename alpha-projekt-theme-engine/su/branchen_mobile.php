<div class="branchen-loop branchen-mobile">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {

			$branchen_nav_top = "";
			$branchen_content_bottom = "";

			$branchen_nav_top .= '<div id="branchen_nav_top">';
			$branchen_content_bottom .= '<div id="branchen_content_bottom">';

			    while ( $posts->have_posts() ) :
                    $posts->the_post();
                    global $post;
                    $image_id  = get_post_thumbnail_id();
                    $image_url = ap_get_image( $image_id, '', '', 'branchen-image', true );
                    $the_title = get_the_title();
                    $the_title = explode( '&', $the_title );
                        if ( count( $the_title ) > 1 ) {
                            $the_title = $the_title[ 0 ] . '<br />' . str_replace( '#038;', '&', $the_title[ 1 ] );
                        } else {
                            $the_title = $the_title[ 0 ];
                        }

				    $branchen_nav_top .= '
                        <div class="slide-nav">
                         <img src="' . $image_url . '" />
                        </div>
				    ';
				    $branchen_content_bottom .= '
				    <div class="slide-for">
                        <div class="accordion-wrapper">
                        <p>' . get_the_content() . '</p>
                        </div>
                        <div class="more-switcher">
                        ^
                        </div>
				    </div>
				    ';

			    endwhile;

			$branchen_nav_top .= '</div>';
			$branchen_content_bottom .= '</div>';

			    echo do_shortcode( $branchen_nav_top );
			    echo do_shortcode( $branchen_content_bottom );

		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
		}
	?>

</div>