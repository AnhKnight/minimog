<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimog
 * @since   1.0
 */
get_header();

$post_type = get_post_type();

switch ( $post_type ) {
	default:
		get_template_part( 'template-parts/content-single', 'page' );
		break;
}

get_footer();
