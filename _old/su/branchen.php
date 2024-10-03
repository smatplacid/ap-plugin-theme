<div class="branchen-loop">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {

			$popup = "";

			echo '<div id="branchen">';

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
				?>

                <div id="branchen-<?php echo $post-ID; ?>" data-id="<?php echo $post->ID; ?>" class="branchen-post">

	                <?php
                    echo '<a style="display: block" id="branchen-popup-68_open" class="branchen-popup-68_open initialism basic_open btn btn-success">';
	                ap_the_image($image_id,'','','branchen-image');
	                echo '<p class="name"><span>' . get_the_title() . '</span></p>';
	                echo '</a>';

	                $popup .= '<div id="branchen-popup-' . $post->ID . '" class="branche-popup-' . $post->ID . ' branchen-popup has-stroke has-fill">'; ?>

                        <?php
                        $popup .= '<div class="su-row content">';
                            $popup .= '[su_column size="1/1" center="no" class=""]';
                                $popup .= '<div class="svg-mask">';
                                $popup .= '<img class="inject-me svg" data-src="' . $image_url . '" src="' . $image_url . '" />';
                                $popup .= '<p class="title">' . $the_title . '</p>';
	                            $popup .= '</div>';
                              $popup .= get_the_content();
                            $popup .= '[/su_column]';
                        $popup .= '</div>'; // su-row ?>

                        <?php
	                    $popup .= '<div class="su-row related">';

	                        $rechtsanwaelte = get_posts( array(
                                'post_type'  => 'rechtsanwalt',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'ra_branche',
                                        // name of custom field
                                        'value'   => '"' . get_the_ID() . '"',
                                        // matches exactly "123", not just 123. This prevents a match for "1234"
                                        'compare' => 'LIKE'
                                    )
                                )
                            ) );

                            if ( $rechtsanwaelte ):
                                foreach ( $rechtsanwaelte as $rechtsanwalt ):

                                    $image_id = get_post_thumbnail_id( $rechtsanwalt->ID );

                                    $popup .= '<div id="branchen-anwaltsprofil-' . $rechtsanwalt->ID . '" data-id="' . $rechtsanwalt->ID . '" class="anwaltsprofil-post">';
                                    $popup .= ap_get_image( $image_id, 'profil-pictures', '', 'anwaltsprofil-image' );
                                    //                echo '<p class="name"><span>' . get_the_title() . '</span><i>' . $ra_rechtgebiet . '</i></p>';
                                    $popup .= '<p class="name"><span>' . get_the_title( $rechtsanwalt->ID ) . '</span></p>';
                                    $popup .= '</div>';

                                endforeach;
                            endif;

	                    $popup .= '</div>'; // su-row ?>

                    <?php
	                $popup .= '</div>'; // branchen-popup
                    ?>

                </div> <!--branchen-post-->

				<?php
			endwhile;

			echo '</div> <!--branchen-->';

			echo '<div id="branchen-popup-wrapper">';

			    echo do_shortcode( $popup );

			echo '</div> <!--anwaltsprofil-popup-wrapper-->';
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
		}
	?>

    <script>
        (function ($) {
            // $(document).ready(function () {
            // $(window).on("load", function () {
            //     $('#branchen-popup-68').popup();
            // });

            $('#branchen-popup-68').popup({
                type: 'tooltip',
                vertical: 'top',
                offsettop:'600',
                scrolllock:true,
                transition: '0.3s all 0.1s',
                tooltipanchor: $('#branchen')
            });

        })(jQuery);
    </script>

    <?php if (!is_admin()) : ?>
    <script>
        (function ($) {
            $(window).on("load", function () {
                $(document).ready(function () {
                    $.fn.popup.defaults.pagecontainer = '.inner-content';
                    $.fn.popup.defaults.transition = 'all 0.3s';
                });
            });
        })(jQuery);
    </script>
    <?php endif; ?>
</div>