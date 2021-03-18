<?php
defined( 'ABSPATH' ) || exit;

class Minimog_Image {

	public static function get_attachment_info( $attachment_id ) {
		$attachment     = get_post( $attachment_id );
		$attachment_url = wp_get_attachment_url( $attachment_id );

		if ( $attachment === null ) {
			return false;
		}

		$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

		if ( '' === $alt ) {
			$alt = $attachment->post_title;
		}

		return array(
			'alt'         => $alt,
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment_url,
			'title'       => $attachment->post_title,
		);
	}

	/**
	 * Get post thumbnail in loop.
	 *
	 * @param array $args
	 *
	 * @return string HTML img tag.
	 */
	public static function get_the_post_thumbnail( $args = array() ) {
		if ( ! empty( $args['post_id'] ) ) {
			$args['id'] = get_post_thumbnail_id( $args['post_id'] );
		} else {
			$args['id'] = get_post_thumbnail_id( get_the_ID() );
		}

		$attachment = self::get_attachment_by_id( $args );

		return $attachment;
	}

	/**
	 * Print post thumbnail in loop.
	 *
	 * @param array $args
	 */
	public static function the_post_thumbnail( $args = array() ) {
		$image = self::get_the_post_thumbnail( $args );

		echo "{$image}";
	}

	/**
	 * Get post thumbnail url in loop.
	 *
	 * @param array $args
	 *
	 * @return string $attachment_url post thumbnail url
	 */
	public static function get_the_post_thumbnail_url( $args = array() ) {
		if ( isset( $args['post_id'] ) ) {
			$args['id'] = get_post_thumbnail_id( $args['post_id'] );
		} else {
			$args['id'] = get_post_thumbnail_id( get_the_ID() );
		}

		$attachment_url = self::get_attachment_url_by_id( $args );

		return $attachment_url;
	}

	/**
	 * Print post thumbnail url in loop.
	 *
	 * @param array $args
	 */
	public static function the_post_thumbnail_url( $args = array() ) {
		$url = self::get_the_post_thumbnail_url( $args );

		echo esc_url( $url );
	}

	public static function get_attachment_by_id( $args = array() ) {
		$defaults = array(
			'id'     => '',
			'size'   => 'full',
			'width'  => '',
			'height' => '',
			'crop'   => true,
			'class'  => '',
			'retina' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		$image_full = self::get_attachment_info( $args['id'] );

		if ( $image_full === false ) {
			return false;
		}

		$url           = $image_full['src'];
		$cropped_image = self::get_image_cropped_url( $url, $args );

		if ( $cropped_image[0] === '' ) {
			return '';
		}

		$cropped_image_w = isset( $cropped_image[1] ) ? $cropped_image[1] : '';
		$cropped_image_h = isset( $cropped_image[2] ) ? $cropped_image[2] : '';

		if ( '' === $cropped_image_w ) {
			$cropped_image_size = getimagesize( $cropped_image['0'] );

			if ( ! empty( $cropped_image_size ) ) {
				$cropped_image_w = $cropped_image_size[0];
				$cropped_image_h = $cropped_image_size[1];
			}
		}

		$image_attributes = array(
			'src' => $cropped_image[0],
			'alt' => $image_full['alt'],
		);

		if ( '' !== $cropped_image_w ) {
			$image_attributes['width'] = $cropped_image_w;
		}

		if ( '' !== $cropped_image_h ) {
			$image_attributes['height'] = $cropped_image_h;
		}

		if ( ! empty( $args['retina'] ) && Minimog::setting( 'retina_display_enable' ) ) {
			$args['class'] .= ' ll-image unload';

			$cropped_image_info = pathinfo( $cropped_image['0'] );
			// Check retina version exist.
			$retina_image = $cropped_image_info['dirname'] . '/' . $cropped_image_info['filename'] . '@2x.' . $cropped_image_info['extension'];

			if ( self::remote_image_file_exists( $retina_image ) ) {
				$image_attributes['data-src-retina'] = $retina_image;
			}

			// Override src.
			$image_attributes['src']      = MINIMOG_THEME_IMAGE_URI . '/placeholder-transparent.png';
			$image_attributes['data-src'] = $cropped_image[0];
		}

		if ( ! empty( $args['class'] ) ) {
			$image_attributes['class'] = $args['class'];
		}

		$image = self::build_img_tag( $image_attributes );

		// Wrap img with caption tags.
		if ( isset( $args['caption_enable'] ) && $args['caption_enable'] === true && $image_full['caption'] !== '' ) {
			$before = '<figure>';
			$after  = '<figcaption class="wp-caption-text gallery-caption">' . $image_full['caption'] . '</figcaption></figure>';

			$image = $before . $image . $after;
		}

		return $image;
	}

	public static function the_attachment_by_id( $args = array() ) {
		$attachment = self::get_attachment_by_id( $args );

		echo "{$attachment}";
	}

	public static function get_attachment_url_by_id( $args = array() ) {
		$id = $size = $width = $height = $crop = '';

		$defaults = array(
			'id'      => '',
			'size'    => 'full',
			'width'   => '',
			'height'  => '',
			'crop'    => true,
			'details' => false,
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		if ( $id === '' ) {
			return '';
		}

		if ( $details === false ) {
			$url           = wp_get_attachment_image_url( $id, 'full' );
			$image_cropped = self::get_image_cropped_url( $url, $args );

			return $image_cropped[0];
		} else {
			$image_full = self::get_attachment_info( $id );
			$url        = $image_full['src'];

			$image_cropped = self::get_image_cropped_url( $url, $args );

			$full_details                  = $image_full;
			$full_details['cropped_image'] = $image_cropped[0];

			return $full_details;
		}
	}

	public static function the_attachment_url_by_id( $args = array() ) {
		$url = self::get_attachment_url_by_id( $args );

		echo esc_url( $url );
	}

	/**
	 * @param string $url  Original image url.
	 * @param array  $args Array attributes.
	 *
	 * @return array|bool|string
	 */
	public static function get_image_cropped_url( $url, $args = array() ) {
		extract( $args );
		if ( $url === false ) {
			return array( 0 => '' );
		}

		if ( $size === 'full' ) {
			return array( 0 => $url );
		}

		if ( $size !== 'custom' && ! preg_match( '/(\d+)x(\d+)/', $size ) ) {
			$attachment_url = wp_get_attachment_image_url( $args['id'], $size );

			if ( ! $attachment_url ) {
				return array( 0 => $url );
			} else {
				return array( 0 => $attachment_url );
			}
		}

		if ( $size !== 'custom' ) {
			$_sizes = explode( 'x', $size );
			$width  = $_sizes[0];
			$height = $_sizes[1];
		} else {
			if ( $width === '' ) {
				$width = 9999;
			}

			if ( $height === '' ) {
				$height = 9999;
			}
		}

		$width  = (int) $width;
		$height = (int) $height;

		if ( $width === 9999 || $height === 9999 ) {
			$crop = false;
		}

		if ( $width !== '' && $height !== '' && function_exists( 'aq_resize' ) ) {
			$crop_image = aq_resize( $url, $width, $height, $crop, false );

			if ( ! empty( $crop_image ) && is_array( $crop_image ) && $crop_image[0] !== '' ) {
				return $crop_image;
			}
		}

		return array( 0 => $url );
	}

	public static function elementor_parse_image_size( $settings = null, $default = 'full', $image_size_key = 'thumbnail' ) {
		if ( empty( $settings ) ) {
			return $default;
		}

		if ( isset( $settings['thumbnail_default_size'] ) && '1' === $settings['thumbnail_default_size'] ) {
			return $default;
		}

		if ( isset( $settings["{$image_size_key}_size"] ) ) {
			if ( $settings["{$image_size_key}_size"] === 'custom' ) {
				$width  = $settings["{$image_size_key}_custom_dimension"]['width'];
				$height = $settings["{$image_size_key}_custom_dimension"]['height'];

				if ( $width === '' ) {
					$width = 9999;
				}

				if ( $height === '' ) {
					$height = 9999;
				}

				return "{$width}x{$height}";
			} else {
				return $settings["{$image_size_key}_size"];
			}
		}

		return $default;
	}

	/**
	 * @param array $args
	 *
	 * @var array   $settings       Elementor settings or repeater item settings.
	 * @var string  $image_key      Name if image control.
	 * @var array   $size_settings  Elementor settings or custom array or null to use $settings.
	 * @var string  $image_size_key Name if image size control. Default same name with image key.
	 * @var array   $attributes     An array attributes that add to img tag.
	 *
	 * @return bool|string HTML img tag || false if errors.
	 */
	public static function get_elementor_attachment( array $args ) {
		$defaults = array(
			'settings'       => [],
			'image_key'      => 'image',
			'size_settings'  => [],
			'image_size_key' => '',
			'attributes'     => [],
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		if ( empty( $settings ) ) {
			return '';
		}

		if ( empty( $settings["{$image_key}"] ) ) {
			return '';
		}

		$image = $settings["{$image_key}"];

		// Default same name with $image_key
		if ( empty( $image_size_key ) ) {
			$image_size_key = $image_key;
		}

		// If image has no both id & url.
		if ( empty( $image['url'] ) && empty( $image['id'] ) ) {
			return '';
		}

		// If image has id.
		if ( ! empty( $image['id'] ) ) {
			$attachment_args = array(
				'id' => $image['id'],
			);

			// If not override. then use from $settings.
			if ( empty( $size_settings ) ) {
				$size_settings = $settings;
			}

			// Check if image has custom size.
			// Usage: `{name}_size` and `{name}_custom_dimension`, default `image_size` and `image_custom_dimension`.
			if ( isset( $size_settings["{$image_size_key}_size"] ) ) {
				$image_size = $size_settings["{$image_size_key}_size"];

				// Get get image size.
				if ( 'custom' === $image_size ) {
					$width  = $size_settings["{$image_size_key}_custom_dimension"]['width'];
					$height = $size_settings["{$image_size_key}_custom_dimension"]['height'];

					if ( empty( $width ) ) {
						$width = 9999;

						$attachment_args['crop'] = false;
					}

					if ( empty( $height ) ) {
						$height = 9999;

						$attachment_args['crop'] = false;
					}

					$attachment_args['size'] = "{$width}x{$height}";

				} else {
					// WP Image Size like: full, thumbnail, large...
					$attachment_args['size'] = $image_size;
				}
			}

			$attachment = self::get_attachment_by_id( $attachment_args );
		} else {
			$attributes['src'] = $image['url'];

			$attachment = self::build_img_tag( $attributes );
		}

		return $attachment;
	}

	/**
	 * @param array $attributes
	 *
	 * @return string HTML img tag.
	 */
	public static function build_img_tag( $attributes = array() ) {
		if ( empty( $attributes['src'] ) ) {
			return '';
		}

		$attributes_str = '';

		if ( ! empty( $attributes ) ) {
			foreach ( $attributes as $attribute => $value ) {
				$attributes_str .= ' ' . $attribute . '="' . esc_attr( $value ) . '"';
			}
		}

		$image = '<img ' . $attributes_str . ' />';

		return $image;
	}

	/**
	 * Check if a remote image file exists.
	 *
	 * @param  string $url The url to the remote image.
	 *
	 * @return bool        Whether the remote image exists.
	 */
	public static function remote_image_file_exists( $url ) {
		$response = wp_remote_head( $url );

		return 200 === wp_remote_retrieve_response_code( $response );
	}
}
