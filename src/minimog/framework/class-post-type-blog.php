<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_Post' ) ) {
	class Minimog_Post extends Minimog_Post_Type {

		protected static $instance  = null;
		protected static $post_type = 'post';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_action( 'wp_ajax_post_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'infinite_load' ) );

			add_filter( 'post_class', array( $this, 'post_class' ) );
		}

		public function is_archive() {
			global $post;
			$post_type = get_post_type( $post );

			if ( $post_type == 'post' && ( is_archive() || is_home() ) ) {
				return true;
			}

			return false;
		}

		function post_class( $classes ) {
			if ( ! has_post_thumbnail() ) {
				$classes[] = 'post-no-thumbnail';
			}

			return $classes;
		}

		function infinite_load() {
			$source     = isset( $_POST['source'] ) ? $_POST['source'] : '';
			$query_vars = $_POST['query_vars'];

			if ( 'custom_query' === $source ) {
				$query_vars = $this->build_extra_terms_query( $query_vars, $query_vars['extra_tax_query'] );
			}

			$minimog_query = new WP_Query( $query_vars );

			$settings = isset( $_POST['settings'] ) ? $_POST['settings'] : array();

			$response = array(
				'max_num_pages' => $minimog_query->max_num_pages,
				'found_posts'   => $minimog_query->found_posts,
				'count'         => $minimog_query->post_count,
			);

			ob_start();

			if ( $minimog_query->have_posts() ) :
				set_query_var( 'minimog_query', $minimog_query );
				set_query_var( 'settings', $settings );

				get_template_part( 'loop/widgets/blog/style', $settings['layout'] );

				wp_reset_postdata();
			endif;

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		function get_related_posts( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}

			$categories = get_the_category( $args['post_id'] );

			if ( ! $categories ) {
				return false;
			}

			foreach ( $categories as $category ) {
				if ( $category->parent === 0 ) {
					$term_ids[] = $category->term_id;
				} else {
					$term_ids[] = $category->parent;
					$term_ids[] = $category->term_id;
				}
			}

			// Remove duplicate values from the array.
			$unique_array = array_unique( $term_ids );

			$query_args = array(
				'post_type'      => self::$post_type,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
				'tax_query'      => array(
					array(
						'taxonomy'         => 'category',
						'terms'            => $unique_array,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		function get_the_post_meta( $name = '', $default = '' ) {
			$post_meta = get_post_meta( get_the_ID(), 'insight_post_options', true );

			if ( ! empty( $post_meta ) ) {
				$post_options = maybe_unserialize( $post_meta );

				if ( $post_options !== false && isset( $post_options[ $name ] ) ) {
					return $post_options[ $name ];
				}
			}

			return $default;
		}

		function get_the_post_format() {
			$format = '';
			if ( get_post_format() !== false ) {
				$format = get_post_format();
			}

			return $format;
		}

		function the_categories( $args = array() ) {
			if ( ! has_category() ) {
				return;
			}

			$defaults = array(
				'classes'    => 'post-categories',
				'separator'  => ', ',
				'show_links' => true,
				'single'     => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<div class="<?php echo esc_attr( $args['classes'] ); ?>">
				<?php
				$categories = get_the_category();
				$loop_count = 0;
				foreach ( $categories as $category ) {
					if ( $loop_count > 0 ) {
						echo "{$args['separator']}";
					}

					if ( true === $args['show_links'] ) {
						printf(
							'<a href="%1$s"><span>%2$s</span></a>',
							esc_url( get_category_link( $category->term_id ) ),
							$category->name
						);
					} else {
						echo "<span>{$category->name}</span>";
					}

					$loop_count++;

					if ( true === $args['single'] ) {
						break;
					}
				}
				?>
			</div>
			<?php
		}

		/**
		 * @param array $args
		 *
		 * Render first category template of the post.
		 */
		function the_category( $args = array() ) {
			if ( ! has_category() ) {
				return;
			}

			$defaults = array(
				'classes'    => 'post-categories',
				'show_links' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<div class="<?php echo esc_attr( $args['classes'] ); ?>">
				<?php
				$categories = get_the_category();
				$category   = $categories[0];

				if ( $args['show_links'] ) {
					$link = get_term_link( $category );
					printf( '<a href="%1$s" rel="category tag"><span>%2$s</span></a>', $link, $category->name );
				} else {
					echo "<span>{$category->name}</span>";
				}
				?>
			</div>
			<?php
		}

		function nav_page_links() {
			$thumbnail_size = '370x120';
			?>
			<div class="blog-nav-links">
				<div class="nav-list">
					<div class="nav-item prev">
						<div class="inner">
							<?php
							$prev_post      = get_previous_post();
							$class          = 'hover-link';

							previous_post_link( '%link', '<div class="' . esc_attr( $class ) . '"></div><h6><span>Prev</span>%title</h6>' );
							?>
						</div>
					</div>

					<div class="nav-item next">
						<div class="inner">
							<?php
							$next_post      = get_next_post();
							$class          = 'hover-link';

							next_post_link( '%link', '<div class="' . esc_attr( $class )  . '"></div><h6><span>Next</span>%title</h6>' );
							?>
						</div>
					</div>
				</div>
			</div>

			<?php
		}

		function meta_author_template() {
			?>
			<span><?php esc_html_e('By'); ?></span>
			<div class="post-author">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
					<?php // echo get_avatar( get_the_author_meta( 'ID' ) ); ?>
					<?php the_author(); ?>
				</a>
			</div>
			<?php
		}

		function meta_date_template() {
			?>
			<span><?php esc_html_e('on'); ?></span>
			<div class="post-date">
				<?php // <span class="meta-icon"><i class="far fa-calendar"></i></span> ?>
				<?php echo get_the_date(); ?>
			</div>
			<?php
		}

		function meta_view_count_template() {
			if ( function_exists( 'the_views' ) ) : ?>
				<div class="post-view">
					<span class="meta-icon">
						<i class="far fa-eye"></i>
					</span>
					<?php the_views(); ?>
				</div>
			<?php
			endif;
		}

		function meta_comment_count_template() {
			?>
			<div class="post-comments">
				<span class="meta-icon">
					<i class="far fa-comment-alt-lines"></i>
				</span>
				<?php
				$comment_count = get_comments_number();
				printf( _n( '%s comment', '%s comments', $comment_count, 'minimog' ), number_format_i18n( $comment_count ) );
				?>
			</div>
			<?php
		}

		function entry_meta_comment_count_template() {
			?>
			<div class="post-comments">
				<a href="#comments" class="smooth-scroll-link">
				<span class="meta-icon">
					<i class="far fa-comment-alt-lines"></i>
				</span>
					<?php
					$comment_count = get_comments_number();
					printf( _n( '%s comment', '%s comments', $comment_count, 'minimog' ), number_format_i18n( $comment_count ) );
					?>
				</a>
			</div>
			<?php
		}

		function entry_categories() {
			if ( '1' !== Minimog::setting( 'single_post_categories_enable' ) || ! has_category() ) {
				return;
			}
			?>
			<div class="entry-post-categories">
				<?php the_category( ' ' ); ?>
			</div>
			<?php
		}

		function entry_tags() {
			if ( '1' !== Minimog::setting( 'single_post_tags_enable' ) || ! has_tag() ) {
				return;
			}
			?>
			<div class="entry-post-tags">
				<span class="tag-label">
					Tag:
				</span>
				<div class="tagcloud">
					<?php the_tags( '', ', ', '' ); ?>
				</div>
			</div>
			<?php
		}

		function entry_feature() {
			if ( '1' !== Minimog::setting( 'single_post_feature_enable' ) ) {
				return;
			}

			$post_format    = $this->get_the_post_format();
			$thumbnail_size = '770x400';

			if ( 'none' === Minimog_Global::instance()->get_sidebar_status() ) {
				$thumbnail_size = '1170x600';
			}

			switch ( $post_format ) {
				case 'gallery':
					$this->entry_feature_gallery( $thumbnail_size );
					break;
				case 'audio':
					$this->entry_feature_audio();
					break;
				case 'video':
					$this->entry_feature_video( $thumbnail_size );
					break;
				case 'link':
					$this->entry_feature_link();
					break;
				default:
					$this->entry_feature_standard( $thumbnail_size );
					break;
			}
		}

		private function entry_feature_standard( $size ) {
			if ( ! has_post_thumbnail() ) {
				return;
			}
			$text = $this->get_the_post_meta( 'post_description_text' );
			$name = $this->get_the_post_meta( 'post_description_name' );
			$url  = $this->get_the_post_meta( 'post_description_url' );
			?>
			<div class="entry-post-feature post-thumbnail">
				<?php Minimog_Image::the_post_thumbnail( [ 'size' => $size, ] ); ?>
				<?php if ( !empty($text)) { ?>
					<p style="text-align: center;line-height: 1.5em"><?php echo $text; ?><a href="<?php echo $url; ?>" style="text-decoration: underline;"><?php echo $name; ?></a></p>
				<?php } ?>
			</div>
			<?php
		}

		private function entry_feature_gallery( $size ) {
			$gallery = $this->get_the_post_meta( 'post_gallery' );
			if ( empty( $gallery ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-gallery tm-swiper tm-slider" data-nav="1" data-loop="1"
			     data-lg-gutter="30">
				<div class="swiper-inner">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ( $gallery as $image ) { ?>
								<div class="swiper-slide">
									<?php Minimog_Image::the_attachment_by_id( array(
										'id'   => $image['id'],
										'size' => $size,
									) ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		private function entry_feature_audio() {
			$audio = Minimog_Post::instance()->get_the_post_meta( 'post_audio' );
			if ( empty( $audio ) ) {
				return;
			}

			if ( strrpos( $audio, '.mp3' ) !== false ) {
				echo do_shortcode( '[audio mp3="' . $audio . '"][/audio]' );
			} else {
				?>
				<div class="entry-post-feature post-audio">
					<?php if ( wp_oembed_get( $audio ) ) { ?>
						<?php echo Minimog_Helper::w3c_iframe( wp_oembed_get( $audio ) ); ?>
					<?php } ?>
				</div>
				<?php
			}
		}

		private function entry_feature_video( $size ) {
			$video = $this->get_the_post_meta( 'post_video' );
			if ( empty( $video ) ) {
				return;
			}

			$text = $this->get_the_post_meta( 'post_description_text' );
			$name = $this->get_the_post_meta( 'post_description_name' );
			$url  = $this->get_the_post_meta( 'post_description_url' );
			?>
			<div class="entry-post-feature post-video tm-popup-video type-poster minimog-animation-zoom-in">
				<a href="<?php echo esc_url( $video ); ?>" class="video-link minimog-box link-secret">
					<div class="video-poster">
						<div class="minimog-image">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php Minimog_Image::the_post_thumbnail( [ 'size' => $size, ] ); ?>
							<?php } ?>
						</div>
						<div class="video-overlay"></div>

						<div class="video-button">
							<div class="video-play video-play-icon">
								<span class="icon"></span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php if ( empty($text)) { ?>
				<p style="text-align: center;"><?php echo $text; ?><span style="text-decoration: underline;"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></span></p>
			<?php } ?>
			<?php
		}

		private function entry_feature_link() {
			$link = $this->get_the_post_meta( 'post_link' );
			if ( empty( $link ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-link">
				<a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php echo esc_html( $link ); ?></a>
			</div>
			<?php
		}

		function entry_share( $args = array() ) {
			if ( '1' !== Minimog::setting( 'single_post_share_enable' ) || ! class_exists( 'InsightCore' ) ) {
				return;
			}

			$social_sharing = Minimog::setting( 'social_sharing_item_enable' );
			if ( empty( $social_sharing ) ) {
				return;
			}
			?>
			<div class="entry-post-share">
				<div class="post-share style-01">
					<div class="share-label heading-color">
						<?php esc_html_e( 'Share :', 'minimog' ); ?>
					</div>
					<div class="share-media">
						<div class="share-list">
							<?php Minimog_Templates::get_sharing_list( $args ); ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		function loop_share( $args = array() ) {
			if ( ! class_exists( 'InsightCore' ) ) {
				return;
			}

			$social_sharing = Minimog::setting( 'social_sharing_item_enable' );
			if ( empty( $social_sharing ) ) {
				return;
			}
			?>
			<div class="post-share style-01">
				<div class="share-label">
					<?php esc_html_e( 'Share this post', 'minimog' ); ?>
				</div>
				<div class="share-media">
					<span class="share-icon fas fa-share-alt"></span>

					<div class="share-list">
						<?php Minimog_Templates::get_sharing_list( $args ); ?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	Minimog_Post::instance()->initialize();
}
