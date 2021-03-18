<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  Minimog
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php html_class(); ?>>
<head>
	<?php Minimog_THA::instance()->head_top(); ?>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset', 'display' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url', 'display' ) ); ?>">
	<?php endif; ?>
	<?php Minimog_THA::instance()->head_bottom(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Minimog::body_attributes(); ?>>

<?php wp_body_open(); ?>

<?php Minimog_Templates::pre_loader(); ?>

<div id="page" class="site">
	<div class="content-wrapper">
		<?php Minimog_Templates::slider( 'above' ); ?>
		<?php Minimog_Top_Bar::instance()->render(); ?>

		<?php get_template_part( 'template-parts/header/entry' ); ?>

		<?php Minimog_Templates::slider( 'below' ); ?>
		<?php Minimog_Title_Bar::instance()->render(); ?>
