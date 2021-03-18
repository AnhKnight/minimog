<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Minimog_WP_Widget_Product_Brand_Nav' ) ) {
	class Minimog_WP_Widget_Product_Brand_Nav extends Minimog_Widget {
		public function __construct() {

			$this->widget_id          = 'minimog-wp-widget-product-brand-nav';
			$this->widget_cssclass    = 'minimog-wp-widget-product-brand-nav';
			$this->widget_name        = esc_html__( '[Minimog] Product Brand Layered Nav', 'minimog' );
			$this->widget_description = esc_html__( 'Shows brands in a widget which lets you narrow down the list of products when viewing products.', 'minimog' );
			$this->settings           = array(
				'title'        => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Brands', 'minimog' ),
					'label' => esc_html__( 'Title', 'minimog' ),
				),
				'display_type' => array(
					'type'    => 'select',
					'std'     => 'list',
					'label'   => esc_html__( 'Display type', 'minimog' ),
					'options' => array(
						'list'     => esc_html__( 'List', 'minimog' ),
						'dropdown' => esc_html__( 'Dropdown', 'minimog' ),
					),
				),
			);

			add_filter( 'woocommerce_product_subcategories_args', array( $this, 'filter_out_cats' ) );

			parent::__construct();
		}

		public function filter_out_cats( $cat_args ) {
			if ( ! empty( $_GET['filter_product_brand'] ) ) {
				return array( 'taxonomy' => '' );
			}

			return $cat_args;
		}

		public function widget( $args, $instance ) {
			$attribute_array      = array();
			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( ! empty( $attribute_taxonomies ) ) {
				foreach ( $attribute_taxonomies as $tax ) {
					if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
						$attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
					}
				}
			}

			if ( ! is_post_type_archive( 'product' ) && ! is_tax( array_merge( is_array( $attribute_array ) ? $attribute_array : array(), array(
					'product_cat',
					'product_tag',
				) ) ) ) {
				return;
			}

			$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();

			$current_term = $attribute_array && is_tax( $attribute_array ) ? get_queried_object()->term_id : '';
			$current_tax  = $attribute_array && is_tax( $attribute_array ) ? get_queried_object()->taxonomy : '';

			$taxonomy     = 'product_brand';
			$display_type = isset( $instance['display_type'] ) ? $instance['display_type'] : 'list';

			if ( ! taxonomy_exists( $taxonomy ) ) {
				return;
			}

			// Get only parent terms. Methods will recursively retrieve children.
			$terms = get_terms( $taxonomy, array(
				'hide_empty' => '1',
				'parent'     => 0,
			) );

			if ( empty( $terms ) ) {
				return;
			}

			ob_start();

			$this->widget_start( $args, $instance );

			if ( 'dropdown' === $display_type ) {
				$found = $this->layered_nav_dropdown( $terms, $taxonomy );
			} else {
				$found = $this->layered_nav_list( $terms, $taxonomy );
			}

			$this->widget_end( $args );

			// Force found when option is selected - do not force found on taxonomy attributes
			if ( ! is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) ) {
				$found = true;
			}

			if ( ! $found ) {
				ob_end_clean();
			} else {
				echo ob_get_clean();
			}
		}

		/**
		 * Return the currently viewed taxonomy name.
		 *
		 * @return string
		 */
		protected function get_current_taxonomy() {
			return is_tax() ? get_queried_object()->taxonomy : '';
		}

		/**
		 * Return the currently viewed term ID.
		 *
		 * @return int
		 */
		protected function get_current_term_id() {
			return absint( is_tax() ? get_queried_object()->term_id : 0 );
		}

		/**
		 * Return the currently viewed term slug.
		 *
		 * @return int
		 */
		protected function get_current_term_slug() {
			return absint( is_tax() ? get_queried_object()->slug : 0 );
		}

		/**
		 * Get current page URL for layered nav items.
		 *
		 * @param string $taxonomy
		 *
		 * @return string
		 */
		protected function get_page_base_url( $taxonomy ) {

			if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
				$link = home_url();
			} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
				$link = get_post_type_archive_link( 'product' );
			} elseif ( is_product_category() ) {
				$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
			} elseif ( is_product_tag() ) {
				$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
			} else {
				$queried_object = get_queried_object();
				$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
			}

			// Min/Max
			if ( isset( $_GET['min_price'] ) ) {
				$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
			}

			if ( isset( $_GET['max_price'] ) ) {
				$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
			}

			// Orderby
			if ( isset( $_GET['orderby'] ) ) {
				$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
			}

			/**
			 * Search Arg.
			 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
			 */
			if ( get_search_query() ) {
				$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
			}

			// Post Type Arg
			if ( isset( $_GET['post_type'] ) ) {
				$link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
			}

			// Min Rating Arg
			if ( isset( $_GET['rating_filter'] ) ) {
				$link = add_query_arg( 'rating_filter', wc_clean( $_GET['rating_filter'] ), $link );
			}

			// All current filters
			if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
				foreach ( $_chosen_attributes as $name => $data ) {
					if ( $name === $taxonomy ) {
						continue;
					}
					$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
					if ( ! empty( $data['terms'] ) ) {
						$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
					}
					if ( 'or' == $data['query_type'] ) {
						$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
					}
				}
			}

			return $link;
		}

		public function get_chosen_attributes() {
			if ( ! empty( $_GET['filter_product_brand'] ) ) {
				return array_map( 'intval', explode( ',', $_GET['filter_product_brand'] ) );
			}

			return array();
		}

		protected function layered_nav_dropdown( $terms, $taxonomy, $depth = 0 ) {
			$found = false;

			if ( $taxonomy !== $this->get_current_taxonomy() ) {
				$term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, 'or' );
				$_chosen_attributes = $this->get_chosen_attributes();

				if ( 0 == $depth ) {
					echo '<select class="wc-brand-dropdown-layered-nav-' . esc_attr( $taxonomy ) . '">';
					echo '<option value="">' . __( 'Any Brand', 'minimog' ) . '</option>';
				}

				foreach ( $terms as $term ) {
					// If on a term page, skip that term in widget list
					if ( $term->term_id === $this->get_current_term_id() ) {
						continue;
					}

					// Get count based on current view
					$current_values = ! empty( $_chosen_attributes ) ? $_chosen_attributes : array();
					$option_is_set  = in_array( $term->term_id, $current_values );
					$count          = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

					// Only show options with count > 0
					if ( 0 < $count ) {
						$found = true;
					} elseif ( 0 === $count && ! $option_is_set ) {
						continue;
					}

					echo '<option value="' . esc_attr( $term->term_id ) . '" ' . selected( $option_is_set, true, false ) . '>' . str_repeat( '&nbsp;', 2 * $depth ) . esc_html( $term->name ) . '</option>';

					$child_terms = get_terms( $taxonomy, array(
						'hide_empty' => 1,
						'parent'     => $term->term_id,
					) );

					if ( ! empty( $child_terms ) ) {
						$found |= $this->layered_nav_dropdown( $child_terms, $taxonomy, $depth + 1 );
					}

				}

				if ( 0 == $depth ) {
					echo '</select>';

					wc_enqueue_js( "
					jQuery( '.wc-brand-dropdown-layered-nav-" . esc_js( $taxonomy ) . "' ).change( function() {
						var slug = jQuery( this ).val();
						location.href = '" . preg_replace( '%\/page\/[0-9]+%', '', str_replace( array(
							'&amp;',
							'%2C',
						), array( '&', ',' ), esc_js( add_query_arg( 'filtering', '1', remove_query_arg( array(
							'page',
							'filter_' . $taxonomy,
						) ) ) ) ) ) . "&filter_" . esc_js( $taxonomy ) . "=' + jQuery( '.wc-brand-dropdown-layered-nav-" . esc_js( $taxonomy ) . "' ).val();
					});
				" );
				}
			}

			return $found;
		}

		protected function layered_nav_list( $terms, $taxonomy, $depth = 0 ) {
			// List display
			$found = false;
			if ( $taxonomy !== $this->get_current_taxonomy() ) {
				echo '<ul class="' . ( 0 == $depth ? '' : 'children ' ) . 'wc-brand-list-layered-nav-' . esc_attr( $taxonomy ) . '">';

				$term_counts        = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, 'or' );
				$_chosen_attributes = $this->get_chosen_attributes();
				$current_values     = ! empty( $_chosen_attributes ) ? $_chosen_attributes : array();
				$found              = false;

				$filter_name = 'filter_' . $taxonomy;

				foreach ( $terms as $term ) {
					$option_is_set = in_array( $term->term_id, $current_values );
					$count         = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

					// skip the term for the current archive
					if ( $this->get_current_term_id() === $term->term_id ) {
						continue;
					}

					// Only show options with count > 0
					if ( 0 < $count ) {
						$found = true;
					} elseif ( 0 === $count && ! $option_is_set ) {
						continue;
					}

					$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( $_GET[ $filter_name ] ) ) : array();
					$current_filter = array_map( 'intval', $current_filter );

					if ( ! in_array( $term->term_id, $current_filter ) ) {
						$current_filter[] = $term->term_id;
					}

					$link = $this->get_page_base_url( $taxonomy );

					// Add current filters to URL.
					foreach ( $current_filter as $key => $value ) {
						// Exclude query arg for current term archive term
						if ( $value === $this->get_current_term_id() ) {
							unset( $current_filter[ $key ] );
						}

						// Exclude self so filter can be unset on click.
						if ( $option_is_set && $value === $term->term_id ) {
							unset( $current_filter[ $key ] );
						}
					}

					if ( ! empty( $current_filter ) ) {
						$link = add_query_arg( array(
							'filtering'  => '1',
							$filter_name => implode( ',', $current_filter ),
						), $link );
					}

					$link = apply_filters( 'woocommerce_layered_nav_link', $link, $term, $taxonomy );

					echo '<li class="wc-layered-nav-term ' . ( $option_is_set ? 'chosen' : '' ) . '">';

					if ( $count > 0 || $option_is_set ) {
						echo '<a href="' . esc_url( $link ) . '">';
					} else {
						echo '<span>';
					}

					echo esc_html( $term->name );

					if ( $count > 0 || $option_is_set ) {
						echo '</a>';
					} else {
						echo '</span>';
					}

					echo apply_filters( 'woocommerce_layered_nav_count', '<span class="count">(' . absint( $count ) . ')</span>', $count, $term );

					$child_terms = get_terms( $taxonomy, array(
						'hide_empty' => 1,
						'parent'     => $term->term_id,
					) );

					if ( ! empty( $child_terms ) ) {
						$found |= $this->layered_nav_list( $child_terms, $taxonomy, $depth + 1 );
					}

					echo '</li>';
				}

				echo '</ul>';
			}

			return $found;
		}

		protected function get_filtered_term_product_counts( $term_ids, $taxonomy, $query_type = 'and' ) {
			global $wpdb;

			$tax_query  = WC_Query::get_main_tax_query();
			$meta_query = WC_Query::get_main_meta_query();

			if ( 'or' === $query_type ) {
				foreach ( $tax_query as $key => $query ) {
					if ( is_array( $query ) && $taxonomy === $query['taxonomy'] ) {
						unset( $tax_query[ $key ] );
					}
				}
			}

			$meta_query     = new WP_Meta_Query( $meta_query );
			$tax_query      = new WP_Tax_Query( $tax_query );
			$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
			$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

			// Generate query
			$query             = array();
			$query['select']   = "SELECT COUNT( DISTINCT {$wpdb->posts}.ID ) as term_count, terms.term_id as term_count_id";
			$query['from']     = "FROM {$wpdb->posts}";
			$query['join']     = "
			INNER JOIN {$wpdb->term_relationships} AS term_relationships ON {$wpdb->posts}.ID = term_relationships.object_id
			INNER JOIN {$wpdb->term_taxonomy} AS term_taxonomy USING( term_taxonomy_id )
			INNER JOIN {$wpdb->terms} AS terms USING( term_id )
			" . $tax_query_sql['join'] . $meta_query_sql['join'];
			$query['where']    = "
			WHERE {$wpdb->posts}.post_type IN ( 'product' )
			AND {$wpdb->posts}.post_status = 'publish'
			" . $tax_query_sql['where'] . $meta_query_sql['where'] . "
			AND terms.term_id IN (" . implode( ',', array_map( 'absint', $term_ids ) ) . ")
		";
			$query['group_by'] = "GROUP BY terms.term_id";
			$query             = apply_filters( 'woocommerce_get_filtered_term_product_counts_query', $query );
			$query             = implode( ' ', $query );
			$results           = $wpdb->get_results( $query );

			return wp_list_pluck( $results, 'term_count', 'term_count_id' );
		}
	}
}
