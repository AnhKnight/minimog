<?php

defined('ABSPATH') || exit;

global $post, $product;

$is_quick_view = apply_filters('minimog_content_quick_view', false);

$feature_style = Minimog_Woo::instance()->get_single_product_style();

$classes = "feature-style-$feature_style";

$open_gallery = apply_filters('woocommerce_single_product_open_gallery', true);
if ($open_gallery) {
	$classes .= ' minimog-light-gallery';
}

$main_slider_slides_html = '';
$thumbs_slider_slides_html = '';

$attachment_ids = $product->get_gallery_image_ids();

if (has_post_thumbnail()) {
	$thumbnail_id = (int)get_post_thumbnail_id();
	array_unshift($attachment_ids, $thumbnail_id);
}

$number_attachments = count($attachment_ids);

if ($number_attachments > 1) {
	$wrapper_classes = 'minimog-gallery-image';
}
?>
<div class="<?php echo esc_attr($wrapper_classes); ?>">
	<?php
	foreach ($attachment_ids as $attachment_id) {
		$props = wc_get_product_attachment_props($attachment_id, $post);
		if (!$props['url']) {
			continue;
		}
		$main_slider_slide_image_classes = array('zoom minimog-thumbnail__item');

		if (isset($thumbnail_id) && $attachment_id == $thumbnail_id) {
			$main_slider_slide_image_classes[] = 'product-main-image';
		}

		$attributes_string = 'class="' . esc_attr(implode(' ', $main_slider_slide_image_classes)) . '"';

		if ($open_gallery) {
			$sub_html = '';
			if (!empty($props['title'])) {
				$sub_html .= "<h4>{$props['title']}</h4>";
			}
			if (!empty($props['caption'])) {
				$sub_html .= "<p>{$props['caption']}</p>";
			}
			if (!empty($sub_html)) {
				$attributes_string .= ' data-sub-html="' . $sub_html . '"';
			}
			$attributes_string .= ' data-src="' . $props['url'] . '"';

			$attributes_string .= ' data-image-id="' . $attachment_id . '"';
		}

		$main_image_html = Minimog_Image::get_attachment_by_id(array(
				'id' => $attachment_id,
				'size' => '570x570',
		));
		$main_slider_slides_html .= sprintf('<div %s>%s</div>', $attributes_string, $main_image_html);
		$thumbs_image_html = Minimog_Image::get_attachment_by_id([
				'id' => $attachment_id,
				'size' => '120x120',
		]);
		$thumbs_slider_slides_html .= '<div class="minimog-thumbs-image__item">' . $thumbs_image_html . '</div>';
	}
	?>
	<?php if ($number_attachments > 1) { ?>
		<div class="minimog-thumbs-images">
			<?php echo '' . $thumbs_slider_slides_html; ?>
		</div>
	<?php } ?>
	<div class="minimog-thumbanils">
		<?php echo '' . $main_slider_slides_html; ?>
	</div>
</div>
