<div class="aktuelles-loop aktuelles-mobile">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {

			echo '<div id="aktuelles-slider">';

			    while ( $posts->have_posts() ) :
                    $posts->the_post();
                    global $post;
                    $image_id = get_post_thumbnail_id();
                    ?>

                        <div id="aktuelles-<?php echo $post->ID; ?>" data-id="<?php echo $post->ID; ?>" class="aktuelles-post slide">

                            <?php
                            ap_the_image($image_id,'','','branchen-image');
                            echo '<p class="name"><span>' . get_the_title() . '</span></p>';
                            echo '<div class="text-container">';
                            echo '<p class="text">' . get_the_content() . '</p>';
                            echo '</div>';
                            ?>

                        </div>

                    <?php
			    endwhile;

			echo '</div>';

		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
		}
	?>
</div>