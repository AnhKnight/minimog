<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Minimog
 * @since   1.0
 */

get_header( 'blank' );

$image = Minimog::setting( 'error404_page_image' );
$title = Minimog::setting( 'error404_page_title' );
$text  = Minimog::setting( 'error404_page_text' );
?>
	<div class="page-404-content">
		<div class="container">
			<div class="row row-xs-center full-height">
				<div class="branding__logo">
					<?php
					$logo_dark = Minimog::setting( 'logo_dark' );

					if ( isset( $logo_dark['id'] ) ) {
						$logo_width    = Minimog::setting( 'logo_width' );
						$logo_dark_url = Minimog_Image::get_attachment_url_by_id( array(
							'id'   => $logo_dark['id'],
							'size' => "{$logo_width}x9999",
							'crop' => false,
						) );
					} else {
						$logo_dark_url = $logo_dark['url'];
					}

					$alt = get_bloginfo( 'name', 'display' );
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo esc_url( $logo_dark_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
						     class="dark-logo">
					</a>
				</div>

				<div class="col-md-12">
					<?php if ( $image !== '' ): ?>
						<div class="error-image">
							<img src="<?php echo esc_url( $image ); ?>"
							     alt="<?php esc_attr_e( 'Not Found Image', 'minimog' ); ?>"/>
						</div>
					<?php endif; ?>

					<?php if ( $title !== '' ): ?>
						<h3 class="error-404-title">
							<?php echo wp_kses( $title, 'minimog-default' ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $text !== '' ): ?>
						<div class="error-404-text">
							<?php echo wp_kses( $text, 'minimog-default' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( Minimog::setting( 'error404_page_search_enable' ) ): ?>
						<div class="error-search-form">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>

					<?php if ( '1' === Minimog::setting( 'error404_page_buttons_enable' ) ): ?>
						<div class="error-buttons">
							<?php
							Minimog_Templates::render_button( [
								'text' => esc_html__( 'Go back', 'minimog' ),
								'link' => [
									'url' => 'javascript:void(0)',
								],
								'icon' => 'far fa-history',
								'id'   => 'btn-go-back',
							] );

							Minimog_Templates::render_button( [
								'text' => esc_html__( 'Homepage', 'minimog' ),
								'link' => [
									'url' => esc_url( home_url( '/' ) ),
								],
								'icon' => 'far fa-home',
								'id'   => 'btn-return-home',
							] );
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer( 'blank' );
