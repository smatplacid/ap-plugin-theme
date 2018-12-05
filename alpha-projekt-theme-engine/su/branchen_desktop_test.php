<div class="branchen-loop branchen-desktop">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {

            $popup = "";
            $popupTrigger = array();

            echo '<div id="branchen">';

                while ( $posts->have_posts() ) :
                    $posts->the_post();
                    global $post;
                    $image_id = get_post_thumbnail_id();
                    $image_url = ap_get_image( $image_id, '', '', 'branchen-image', true );
                    $the_title = get_the_title();
                    $the_title = explode( '&', $the_title );
                    if ( count( $the_title ) > 1 ) {
                    $the_title = $the_title[ 0 ] . '<br />' . str_replace( '#038;', '&', $the_title[ 1 ] );
                    } else {
                    $the_title = $the_title[ 0 ];
                    }

                    $popupTrigger[] = $post->ID;
                    ?>

                    <div id="branchen-<?php echo $post->ID; ?>" data-id="<?php echo $post->ID; ?>" class="branchen-post">

                        <a class="branchen-post-link branchen-post-id-<?php echo $post->ID; ?>">
                            <?php
                            ap_the_image( $image_id, '', '', 'branchen-image' );
                            echo '<p class="name"><span>' . get_the_title() . '</span></p>';
                            ?>
                        </a>

                    </div> <!--branchen-post-->

                    <?php
                    $popup .= '<div id="branchen-popup-' . $post->ID . '" class="branche-popup-' . $post->ID . ' branchen-popup has-fill" style="display: none;">'; ?>

                        <?php
                        $popup .= '<div class="branchen-content">';

                            $popup .= '
                                <div class="su-row">
                                    <div class="su-column su-column-size-1-4">
                                        <div class="su-column-inner su-clearfix">
                                        &nbsp;
                                        </div>
                                    </div>
                                    <div class="su-column su-column-size-1-2">
                                        <div class="su-column-inner su-clearfix">';

                                        $popup .= '<div class="svg-mask">';
                                            $popup .= '<img class="inject-me svg" data-src="' . $image_url . '" src="' . $image_url . '" />';
                                            $popup .= '<p class="title">' . $the_title . '</p>';
                                        $popup .= '</div>';

	                        $popup .= '</div>
                                    </div>
                                    <div class="su-column su-column-size-1-4 tar">
                                        <div class="su-column-inner su-clearfix">
                                            <a class="close_branchen branchen-close-id-' . $post->ID . '">
                                                <span class="close_button">' . close_icon() . '</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ';

                            $popup .= wpautop(get_the_content());

                        $popup .= '</div> <!-- branchen-content -->'; ?>

                        <?php
                        $popup .= '<div class="branchen-related-wrapper">';
                            $popup .= '<div class="branchen-related-inner">';

                            $popup .= '<div class="ansprechpartner tac uppercase custom-strong">';
                                $popup .= '<p>' . __( 'Ansprechpartner in<br />diesem Bereich', 'lacore' ) . '</p>';
                            $popup .= '</div> <!-- ansprechpartner -->';

                                $rechtsanwaelte = get_posts( array(
                                    'post_type'  => 'rechtsanwalt',
                                    'posts_per_page' => -1,

                                    'meta_query' => array(
                                        array(
                                            'key'     => 'ra_ansprechpartner',
                                            // name of custom field
                                            'value'   => '"' . $post->ID . '"',
                                            // matches exactly "123", not just 123. This prevents a match for "1234"
                                            'compare' => 'LIKE'
                                        )
                                    )
                                ) );

//                                if ( count( $rechtsanwaelte ) > 5 ) {
//                                    $popup .= '<div class="ra-related slider">';
//                                } else {
                                    $popup .= '<div class="ra-related count-'.count($rechtsanwaelte).'">';
//                                }
                                        foreach ( $rechtsanwaelte as $rechtsanwalt ):
                                            $image_id = get_post_thumbnail_id( $rechtsanwalt->ID );
	                                        $image_url = ap_get_image( $image_id, 'profil-pictures', '', '', true ); // anwaltsprofil-image

//                                        echo '<pre>';
//                                        print_r( $image_url );
//                                        echo '</pre>';

                                            $popup .= '<div id="branchen-anwaltsprofil-' . $rechtsanwalt->ID . '" data-id="' . $rechtsanwalt->ID . '" class="anwaltsprofil-post">';
                                                $popup .= '<div class="anwaltsprofil-image-holder" style="background-image: url(' . $image_url . ')">';
                                                    $popup .= '<div class="anwaltsprofil-name-hover">';
//	                                        $popup .= ;
                                                    //                echo '<p class="name"><span>' . get_the_title() . '</span><i>' . $ra_rechtgebiet . '</i></p>';
                                                    $popup .= '<p class="name"><span>' . get_the_title( $rechtsanwalt->ID ) . '</span></p>';
                                                    $popup .= '</div>';
                                                $popup .= '</div>';
                                            $popup .= '</div>';

                                        endforeach;

                                    $popup .= '</div>';
    //
                            $popup .= '</div> <!-- branchen-related-inner -->';
                        $popup .= '</div> <!-- branchen-related-wrapper -->';

                    $popup .= '</div> <!-- branchen-popup -->';

                endwhile;

            echo '</div>'; //#branchen

			echo do_shortcode( $popup );

		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
		}

	?>

    <script>
        (function ($) {
            $(document).on('ready', function () {

            });
        })(jQuery);



    </script>

</div>