<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_Top_Bar' ) ) {

	class Minimog_Top_Bar {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {

		}

		/**
		 * @return array List top bar types include id & name.
		 */
		public function get_type() {
			return array(
				'01' => esc_html__( '01', 'minimog' ),
//				'02' => esc_html__( '02', 'minimog' ),
//				'03' => esc_html__( '03', 'minimog' ),
//				'04' => esc_html__( '04', 'minimog' ),
			);
		}

		/**
		 * @param bool   $default_option Show or hide default select option.
		 * @param string $default_text   Custom text for default option.
		 *
		 * @return array A list of options for select field.
		 */
		public function get_list( $default_option = false, $default_text = '' ) {
			$top_bars = array(
				'none' => esc_html__( 'Hide', 'minimog' ),
			);

			$top_bars += $this->get_type();

			if ( $default_option === true ) {
				if ( $default_text === '' ) {
					$default_text = esc_html__( 'Default', 'minimog' );
				}

				$top_bars = array( '' => $default_text ) + $top_bars;
			}

			return $top_bars;
		}

		public function get_support_components() {
			$list = [
				'widget'            => esc_html__( 'Widget', 'minimog' ),
				'text'              => esc_html__( 'Text', 'minimog' ),
				'language_switcher' => esc_html__( 'Language Switcher', 'minimog' ),
				'info_list'         => esc_html__( 'Info List', 'minimog' ),
				'user_link'         => esc_html__( 'User Link', 'minimog' ),
			];

			return $list;
		}

		/**
		 * Add classes to the top barr.
		 *
		 * @var string $class Custom class.
		 */
		public function get_wrapper_class( $class = '' ) {
			$classes = array( 'page-top-bar' );

			$type = Minimog_Global::instance()->get_top_bar_type();

			$classes[] = "top-bar-{$type}";

			if ( ! empty( $class ) ) {
				if ( ! is_array( $class ) ) {
					$class = preg_split( '#\s+#', $class );
				}
				$classes = array_merge( $classes, $class );
			} else {
				// Ensure that we always coerce class to being an array.
				$class = array();
			}

			$classes = apply_filters( 'minimog_top_bar_class', $classes, $class );

			echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
		}

		public function render() {
			$type = Minimog_Global::instance()->get_top_bar_type();

			if ( 'none' !== $type ) {
				get_template_part( 'template-parts/top-bar/top-bar', $type );
			}
		}

		public function print_components( $position = 'left' ) {
			$type       = Minimog_Global::instance()->get_top_bar_type();
			$components = Minimog::setting( "top_bar_style_{$type}_{$position}_components" );

			if ( empty( $components ) ) {
				return;
			}

			foreach ( $components as $component ) {
				switch ( $component ) {
					case 'text' :
						$this->print_text();
						break;
					case 'widget' :
						$this->print_widgets();
						break;
					case 'language_switcher' :
						$this->print_language_switcher();
						break;
					case 'info_list' :
						$this->print_info_list();
						break;
					case 'user_link' :
						$this->print_user_link();
						break;
				}
			}
		}

		public function print_text() {
			$type = Minimog_Global::instance()->get_top_bar_type();
			$text = Minimog::setting( "top_bar_style_{$type}_text" );

			echo '<div class="top-bar-text">' . $text . '</div>';
		}

		/**
		 * Print WPML switcher html template.
		 *
		 * @var string $class Custom class.
		 */
		public function print_language_switcher() {
			do_action( 'minimog_before_add_language_selector_top_bar' );

			if ( ! defined( 'ICL_SITEPRESS_VERSION' ) ) {
				return;
			}
			?>
			<div id="switcher-language-wrapper" class="switcher-language-wrapper">
				<?php do_action( 'wpml_add_language_selector' ); ?>
			</div>
			<?php
		}

		public function print_button( $type = '01' ) {
			$button_text        = Minimog::setting( "top_bar_style_{$type}_button_text" );
			$button_link        = Minimog::setting( "top_bar_style_{$type}_button_link" );
			$button_link_target = Minimog::setting( "top_bar_style_{$type}_button_link_target" );
			$button_classes     = 'top-bar-button';
			?>
			<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
				<a class="<?php echo esc_attr( $button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif;
		}

		public function print_user_link() {
			// Default WP login.
			$login_url = wp_login_url();

			// Use Woocommerce login page.
			if ( Minimog_Woo::instance()->is_activated() ) {
				$login_url = wc_get_page_permalink( 'myaccount' );
			}
			?>
			<?php if ( ! is_user_logged_in() ) { ?>
				<a href="<?php echo esc_url( $login_url ); ?>"
				   title="<?php esc_attr_e( 'Log In / Sign Up', 'minimog' ); ?>"><?php esc_html_e( 'Log In / Sign Up', 'minimog' ); ?></a>
			<?php } else { ?>
				<?php if ( Minimog_Woo::instance()->is_activated() ) : ?>
					<a href="<?php echo esc_url( $login_url ); ?>"
					   title="<?php esc_attr_e( 'My Account', 'minimog' ); ?>"><?php esc_html_e( 'My Account', 'minimog' ); ?></a>
				<?php endif; ?>
			<?php } ?>
			<?php
		}

		public function print_social_networks() {
			$type   = Minimog_Global::instance()->get_top_bar_type();
			$enable = Minimog::setting( "top_bar_style_{$type}_social_networks_enable" );

			if ( $enable !== '1' ) {
				return;
			}
			?>
			<div class="top-bar-social-network">
				<?php Minimog_Templates::social_icons( array(
					'display'        => 'icon',
					'tooltip_enable' => false,
				) ); ?>
			</div>
			<?php
		}

		public function print_widgets() {
			?>
			<div class="top-bar-widgets">
				<?php Minimog_Templates::generated_sidebar( 'top_bar_widgets' ); ?>
			</div>
			<?php
		}

		public function print_info_list() {
			$type      = Minimog_Global::instance()->get_top_bar_type();
			$info_list = Minimog::setting( "top_bar_style_{$type}_info_list" );

			if ( empty( $info_list ) ) {
				return;
			}
			?>
			<div class="top-bar-info">
				<ul class="info-list">
					<?php
					foreach ( $info_list as $item ) {
						$url  = isset( $item['url'] ) ? $item['url'] : '';
						$icon = isset( $item['icon_class'] ) ? $item['icon_class'] : '';
						$text = isset( $item['text'] ) ? $item['text'] : '';
						?>
						<li class="info-item">
							<?php if ( $url !== '' ) : ?>
							<a href="<?php echo esc_url( $url ); ?>" class="info-link">
								<?php endif; ?>

								<?php if ( $icon !== '' ) : ?>
									<i class="info-icon <?php echo esc_attr( $icon ); ?>"></i>
								<?php endif; ?>

								<?php echo '<span class="info-text">' . $text . '</span>'; ?>

								<?php if ( $url !== '' ) : ?>
							</a>
						<?php endif; ?>
						</li>
					<?php } ?>
				</ul>
			</div>
			<?php
		}
	}

	Minimog_Top_Bar::instance()->initialize();
}
