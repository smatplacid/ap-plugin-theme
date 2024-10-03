<div class="anwaltsprofil-loop">
	<?php
	// Posts are found
	if ( $posts->have_posts() ) {

		$popup = "";

		echo '<div id="anwaltsprofil" style="display: none; visibility: hidden">';

            while ( $posts->have_posts() ) :
                $posts->the_post();
                global $post;
                $image_id = get_post_thumbnail_id();
                $ra_branchen = get_field( 'ra_branche', $post->ID );
                $ra_rechtgebiet = get_field( 'ra_rechtgebiet', $post->ID, false );
                ?>

                <div id="anwaltsprofil-<?php echo $post->ID; ?>" data-id="<?php echo $post->ID; ?>" class="anwaltsprofil-post image-has-name-inside anwaltsprofil-<?php echo $post->ID; ?>">

                    <?php
                    ap_the_image($image_id,'profil-pictures','','anwaltsprofil-image');
                    //                echo '<p class="name"><span>' . get_the_title() . '</span><i>' . $ra_rechtgebiet . '</i></p>';
                    echo '<p class="name"><span>' . get_the_title() . '</span></p>';
                    ?>

                    <?php
                    $popup .= '<div id="anwaltsprofil-popup-' . get_the_ID() . '" class="anwaltsprofil-popup anwaltsprofil-popup-id-' . get_the_ID() . '">';
                    ?>

                        <?php
                        $popup .= '<div class="su-row anwalt-scrollbar-wrapper">';

                            $popup .= '[su_column size="1/3" center="no" class=""]';
                            $popup .= ap_get_image( $image_id, 'profil-pictures', '', 'anwaltsprofil-image' );
                            $popup .= '[/su_column]';

                            $popup .= '[su_column size="3/5" center="no" class="tac put-single-anwalt-scrollbar-here"]';
                            $popup .= get_field( 'ra_text', $post->ID );
                            $popup .= '[/su_column]';

                            $popup .= '<div class="su-column su-column-size-1-6 close-button" data-popid="' . $post->ID . '"><div class="su-column-inner su-clearfix">';
                            $popup .= '<span class="close_anwalt">' . close_icon() . '</span>';
                            $popup .= '</div></div>';

                        $popup .= '</div>'; ?>

                        <?php
                        $popup .= '<div class="su-row uppercase">'; ?>

                            <?php
                            $popup .= '[su_column size="1/3" center="no" class=""]';

                            $popup .= '<p class="anwalt-name">';
                            $popup .= '<span class="lac-bold">'.get_the_title().'</span>';
                            $var = get_field( 'ra_berufsbezeichnung', $post->ID );
                            if ( $var ) $popup .= '<br />' . $var;
                            $popup .= '</p>';


                            if ( have_rows( 'ra_kontaktdaten' ) ) :
                                $contacts = array();
                                while( have_rows('ra_kontaktdaten') ) : the_row();
                                    $contacts[] = array(
                                        get_sub_field('ra_bezeichner') => get_sub_field('ra_wert'),
                                    );
                                endwhile;
                                $popup .= '<dl>';
                                foreach ( $contacts as $contact ) { foreach ( $contact as $key => $data ) {
                                    if ($data) {
                                        if ( $key == 'fon' ) $data = '<a href="tel:' . str_replace( ' ', '', $data ) . '">' . $data . '</a>';
                                        if ( $key == 'mail' ) $data = '<a href="mailto:' . $data . '">' . $data . '</a>';
                                        $popup .= '<dt class="lac-bold">' . __( $key, 'lacore' ) . ':</dt><dd>' . $data . '</dd>';
                                    }
                                } }
                                $popup .= '</dl>';
                            endif;


                            $sprachbezeichnung = get_field_object( 'ra_sprachen' );
                            $ra_sprachen       = $sprachbezeichnung [ 'value' ];

                            if ( $ra_sprachen ) {
                                $i = 0;
                                $popup .= "<p class=\"lac-bold\">" . __( 'Korrespondenzsprachen', 'lacore' ) . "</p>";
                                $popup .= '<ul class="ra_sprachen">';
                                foreach ( $ra_sprachen as $ra_sprache ):
                                    $popup .= '<li class="' . $sprachbezeichnung[ 'value' ][ $i ] . '" title="' . __( $sprachbezeichnung[ 'choices' ][ $ra_sprache ], 'lacore' ) . '"></li>';
                                    $i++;
                                endforeach;
                                $popup .= '</ul>';
                            }

                            $popup .= '[/su_column]'; ?>

                            <?php
                            $popup .= '[su_column size="1/3" center="no" class="center link-underline plr-2"]';

                            if ( $ra_branchen ) {
                                $popup .= "<p class='pb-1 lac-bold'>" . __( 'Branchen', 'ap_strings' ) . "</p>";
                                $branchen = 0;
                                foreach ( $ra_branchen as $ra_branche ):
                                    if ($branchen > 0) $popup .= '<br />';
                                    $popup .= '<a class="open-branchen-popup open-branchen-id-' . $ra_branche->ID . '" href="' . $ra_branche->post_name . '">' . $ra_branche->post_title . '</a>';
                                    $branchen++;
                                endforeach;
                            }



                            if ( $ra_rechtgebiet ) {
                                $popup .= "<p class='ptb-1 lac-bold'>" . __( 'Rechtsgebiet', 'ap_strings' ) . "</p>";
                                $popup .= '<p>' . $ra_rechtgebiet . '</p>';
                            }

                            $popup .= '[/su_column]';
                            ?>

                            <?php
                            $popup .= '[su_column size="1/3" center="no" class="center plr-2"]';

                            $ra_schwerpunkte = get_field( 'ra_schwerpunkte', $post->ID );
                            if ($ra_schwerpunkte) {
                                $popup .= "<p class='pb-1'><strong>" . __( 'Schwerpunkte', 'ap_strings' ) . "</strong></p>";
                                $popup .= '<p>' . strip_tags( $ra_schwerpunkte ) . '</p>';
                            }

                            $popup .= '[/su_column]'; ?>

                            <?php
                        $popup .= '</div>'; // su-row uppercase

                    $popup .= '</div>' // anwaltsprofil-popup-;
                    ?>


                </div> <!--anwaltsprofil-->

                <?php
            endwhile;

		echo '</div> <!--anwaltsprofil-->';

		echo '<div id="anwaltsprofil-popup-wrapper">';

		echo do_shortcode( $popup );

		echo '</div> <!--anwaltsprofil-popup-wrapper-->';

	}
	// Posts not found
	else {
		echo '<h4>' . __( 'Posts not found', 'shortcodes-ultimate' ) . '</h4>';
	}
	?>
</div> <!--anwaltsprofil-loop-->