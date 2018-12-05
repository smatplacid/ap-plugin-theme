<div class="aktuelles-loop aktuelles-desktop">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {

		    $div_status = 'close';
		    $count = 1;
	        $out = '';

			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;
				$image_id = get_post_thumbnail_id();
				?>

                    <?php
                    if ($div_status == 'close') { $div_status = 'open';
                        $out1 .= '<div class="aktuelles-row">';
                     }

                            $out2 .= '<div class="aktuelles-post">';

                                if ( $image_id ) {
                                    $out2 .= ap_get_image( $image_id, 'aktuelles-pictures', '', 'aktuelles-image' );

                                }

                                $out2 .= '<p class="name">' . get_the_title() . '</p>';
                                $out2 .= '<a href="#aktuelles-'.$post->ID.'" class="button">MEHR</a>';

                            $out2 .= '</div>';

                            $out3 .= '<div class="aktuelles-popup aktuelles-popup-'.$post->ID.'">';
                                $out3 .= wpautop( $post->post_content );
                                $out3 .= '<p class="strong uppercase">'.get_the_date('l, j.n.Y').'</p>';
                            $out3 .= '<a class="close_aktuelles">' . close_icon() . '</a>';
                            $out3 .= '</div>';

                    $count ++;
                    if ( $count == 3 ) {
                        $count      = 1;
                        $div_status = 'close';
                        $out4       .= '</div>';

                        $out  .= $out1 . $out2 . $out3 . $out4;
                        $out1 = $out2 = $out3 = $out4 = '';
                    }
					?>


				<?php
			endwhile;

			echo do_shortcode( $out );

		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
		}
	?>
</div>