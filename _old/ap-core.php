<?php

function ap_check_param( $variable ) {if ( $variable == true || $variable == 1 || is_null( $variable ) ) {return true;} else {return false;}}

/** ---------------------------------------------------------------------------
 * ASYNC and DEFER LOAD SCRIPTS | v4.9 | 3.2018
 * # https://matthewhorne.me/defer-async-wordpress-scripts/
 * # https://ikreativ.com/async-with-wordpress-enqueue/
 * --------------------------------------------------------------------------- */
add_filter( 'clean_url', 'argbr_async_scripts', 11, 1 );
function argbr_async_scripts( $url ) {
	if ( strpos( $url, '#asyncload' ) === false ) {
		return $url;
	} else if ( is_admin() ) {
		return str_replace( '#asyncload', '', $url );
	} else {
		return str_replace( '#asyncload', '', $url ) . "' async='async";
	}
}

add_filter( 'clean_url', 'argbr_defer_scripts', 11, 1 );
function argbr_defer_scripts( $url ) {
	if ( strpos( $url, '#defer' ) === false ) {
		return $url;
	} else if ( is_admin() ) {
		return str_replace( '#defer', '', $url );
	} else {
		return str_replace( '#defer', '', $url ) . "' defer='defer";
	}
}

if ( ! function_exists( 'ap_sanitize_file_name_chars' ) ) {
	function ap_sanitize_file_name_chars( $special_chars = array() ) {
		$special_chars = array_merge( array(
			'’', '‘', '“', '”', '«', '»', '‹', '›', '—', 'æ', 'œ', '€'
		), $special_chars );

		return $special_chars;
	}

	add_filter( 'sanitize_file_name', 'remove_accents', 10, 1 );
	add_filter( 'sanitize_file_name_chars', 'ap_sanitize_file_name_chars', 10, 1 );

}

if ( ! function_exists( 'ap_the_image' ) ) {
	function ap_the_image( $image_id = null, $size = 'full', $link = null, $class = null, $pure_url = null ) {
		$the_image = ap_get_image( $image_id, $size, $link, $class, $pure_url );
		echo $the_image;
	}
}

if ( ! function_exists( 'ap_get_image' ) ) {
	function ap_get_image( $image_id = null, $size = null, $link = null, $class = null, $pure_url = null ) {
		if ( ! $image_id ) {
//			throw new Exception( 'Missing Image Id at ap_get_image()' );
			$image_url = ALPHA_PROJEKT_THEME_ENGINE_URI . '/img/no-image.png';

			if ( empty( $pure_url ) ) {
				return '<img src="' . $image_url . '" alt="" />';
			} else {
				return $image_url;
			}

		} else {

			if ( empty($size) ) { // ===================================================================== SIZE
				$image_size = 'full';
			} else {
				$image_size = $size;
			}

			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			$image_url = wp_get_attachment_image_src( $image_id, $image_size );
			$image_url = $image_url[ 0 ];

			if ( empty($image_alt) ) { // ===================================================================== ALT
				$image_alt = get_bloginfo( 'name' );
			}

			if ( ap_check_param($class) ) { // ===================================================================== CLASS
				$class = ' class="' . $class . '"';
			} else {
				$class = '';
			}

			if ( ap_check_param($link) ) { // ===================================================================== LINK
				if ( is_array( $link ) ) {
					$href   = $link[ 'url' ];
					$target = $link[ 'target' ];
					if ( $target ) {
						$target = 'target="' . $target . '"';
					}
				} else {
					$href   = $link;
					$target = '';
				}

				$a_open  = '<a href="' . $href . '" ' . $target . '>';
				$a_close = '</a>';
			} else {
				$a_open  = '';
				$a_close = '';
			}

			if ( empty( $pure_url ) ) {
				return $a_open . '<img src="' . $image_url . '" alt="' . $image_alt . '"' . $class . ' />' . $a_close;
			} else {
				return $image_url;
			}

		}
	}
}

if ( ! function_exists( 'ap_the_custom_content' ) ) {
	function ap_the_custom_content( $excerpt_length = 40, $show_more_link = true, $ignore_existing_excerpt = true ) {
		$the_content = ap_get_custom_content( $excerpt_length, $show_more_link, $ignore_existing_excerpt );
		echo $the_content;
	}
}

if ( ! function_exists( 'ap_get_custom_content' ) ) {

	/**
	 * @since 19.07.2018
	 * @param integer $excerpt_length  default 40
	 * @param bool $show_more_link  default TRUE
	 * @param bool $ignore_existing_excerpt  default TRUE
	 * @return mixed  custom length of content
	 */

	function ap_get_custom_content( $excerpt_length = 40, $show_more_link = true, $ignore_existing_excerpt = true ) {
		global $post;

		if ( empty( $excerpt_length ) ) {
			$excerpt_l = 40;
		} else {
			$excerpt_l = $excerpt_length;
		}

		if ( ap_check_param($ignore_existing_excerpt) ) {
			$post_excerpt = strip_tags( $post->post_content );
		} else {
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags( $post->post_content );
		}

		$clean_excerpt      = strpos( $post_excerpt, '...' ) ? strstr( $post_excerpt, '...', true ) : $post_excerpt;
		$clean_excerpt      = strip_shortcodes( remove_vc_from_excerpt( $clean_excerpt ) );
		$excerpt_word_array = explode( ' ', $clean_excerpt );
		$excerpt_word_array = array_slice( $excerpt_word_array, 0, $excerpt_l );

		$excerpt = implode( ' ', $excerpt_word_array ) . '...';

		if (  ap_check_param($show_more_link) ) {
			$more_link = ' <a href="' . get_the_permalink() . '">' . __( 'mehr', 'ap_strings' ) . '</a>';
		} else {
			$more_link = '';
		}

		return '' . $excerpt . $more_link;

	}
}

if ( ! function_exists( 'remove_vc_from_excerpt' ) ) {
	/**
	 * @return mixed  custom length of content
	 * @since 19.07.2018
	 */
	function remove_vc_from_excerpt( $excerpt ) {
		$patterns     = "/\[[\/]?vc_[^\]]*\]/";
		$replacements = "";

		return preg_replace( $patterns, $replacements, $excerpt );
	}
}

if ( ! function_exists( 'apgbr_print_wpml_langswitch' ) ) {
	function apgbr_print_wpml_langswitch() {
		$languages   = apply_filters( 'wpml_active_languages', null, 'skip_missing=1&orderby=code&order=desc' );
		$lang_middle = "";

		$lang_before = '<div class="ap-langswitch">';

		foreach ( $languages as $l ) {
			if ( $l[ 'active' ] == 1 ) {
				$class = ' class="active-lang"';
			} else {
				$class = ' ';
			}

			$lang_middle .= "<a href='{$l['url']}' {$class}>{$l['code']}</a>";
		}

		$lang_after = '</div>';

		return $lang_before . $lang_middle . $lang_after;
	}
}

//https://www.kvcodes.com/2015/04/wordpress-clone-user-role-to-create-new-role/
//https://nazmulahsan.me/clone-or-add-new-user-roles/
add_action('init', 'cloneUserRole');
function cloneUserRole()
{
	global $wp_roles;
	if (!isset($wp_roles))
		$wp_roles = new WP_Roles();
	$adm = $wp_roles->get_role('administrator');
	// Adding a new role with all admin caps.
	$wp_roles->add_role('client', 'Client', $adm->capabilities);
}

// https://www.wpmayor.com/how-to-remove-menu-items-in-admin-depending-on-user-role/
//add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
	global $user_ID;
	if ( current_user_can( 'client' ) ) {
		remove_menu_page( 'tools.php' ); // Tools
		remove_menu_page( 'users.php' ); // Users

		remove_submenu_page( 'index.php', 'update-core.php' ); // Dashboard - Updates
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // Posts - Tags

		remove_submenu_page( 'themes.php', 'theme-editor.php' ); // Appearance - Editor
		remove_submenu_page( 'plugins.php', 'plugin-editor.php' ); // Plugins - Editor
	}
}

function apgbr_php_in_widgets( $text ) {
	if ( strpos( $text, '<' . '?' ) !== false ) {
		ob_start();
		eval( '?' . '>' . $text );
		$text = ob_get_contents();
		ob_end_clean();
	}

	return $text;
}
add_filter( 'widget_text', 'apgbr_php_in_widgets', 99 );

function apgbr_check_referer($domain = null) {
	$referer = parse_url($_SERVER['HTTP_REFERER']);
	$referer = $referer['host'];

	echo '<pre>';
	print_r( $referer );
	echo '</pre>';
}

/**
 * @param bool $svg_mime
 * @return mixed  SVG MIME
 */
function ap_svg( $svg_mime ) {
	$svg_mime[ 'svg' ] = 'image/svg+xml';
	return $svg_mime;
}
add_filter( 'upload_mimes', 'ap_svg' );

function ap_ignore_upload_ext( $checked, $file, $filename, $mimes ) {
	if ( ! $checked[ 'type' ] ) {
		$wp_filetype     = wp_check_filetype( $filename, $mimes );
		$ext             = $wp_filetype[ 'ext' ];
		$type            = $wp_filetype[ 'type' ];
		$proper_filename = $filename;

		if ( $type && 0 === strpos( $type, 'image/' ) && $ext !== 'svg' ) {
			$ext = $type = false;
		}

		$checked = compact( 'ext', 'type', 'proper_filename' );
	}

	return $checked;
}

add_filter( 'wp_check_filetype_and_ext', 'ap_ignore_upload_ext', 10, 4 );