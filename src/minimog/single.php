<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Minimog
 * @since   1.0
 */
get_header();

if ( is_singular( 'post' ) ):
	get_template_part( 'template-parts/blog-single/content-single' );
else:
	get_template_part( 'template-parts/content', 'single' );
endif;

get_footer();
