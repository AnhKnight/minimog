<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h2 class="entry-product-section-heading woocommerce-Reviews-title">
			Ratings and Reviews
		</h2>
		<div class="entry-product-detail-star"><span class="fas fa-star"></span><span class="fas fa-star"></span><span class="fas fa-star"></span><span class="fas fa-star"></span><span class="fas fa-star"></span></div>
		<div class="entry-product-detail-review">
			<?php $count = $product->get_review_count(); ?>
			<?php if ( $count && wc_review_ratings_enabled() ) : ?>
				<?php
				$_rating_count   = $product->get_rating_count();
				$_rating_average = $product->get_average_rating();
				?>

				<div class="woocommerce-review-rating-template">
					<?php printf( '<span class="rating-average">%1$s</span> see %2$s Reviews.', $_rating_average, $_rating_count ) ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist comment-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'minimog' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<a href="#" class="button-review">
			Write a Review
		</a>
		<div id="review_form_wrapper" style="display: none">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'minimog' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'minimog' ), get_the_title() ),
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'minimog' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'minimog' ),
					'logged_in_as'        => '',
					'comment_field'       => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" required placeholder="' . esc_attr__( 'Your review', 'minimog' ) . '"></textarea></p>',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'minimog' ), // WPCS: XSS OK.
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
						'before'   => '<div class="row">',
					),
					'email'  => array(
						'label'    => __( 'Email', 'minimog' ),  // WPCS: XSS OK.
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
						'after'    => '</div>',
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html = '';

					if ( ! empty( $field['before'] ) ) {
						$field_html .= $field['before'];
					}

					$field_html .= '<div class="col-sm-6">';
					$field_html .= '<p class="comment-form-' . esc_attr( $key ) . '">';
					//$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . ( $field['required'] ? '&nbsp;<span class="required">*</span>' : '' ) . '</label>';
					$field_html .= '<input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' placeholder="' . esc_attr( sprintf( __( '%s *', 'minimog' ), $field['label'] ) ) . '" /></p>';
					$field_html .= '</div>'; // End .col-sm-6

					if ( ! empty( $field['after'] ) ) {
						$field_html .= $field['after'];
					}

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'minimog' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
					$rating_template = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating:', 'minimog' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'minimog' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'minimog' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'minimog' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'minimog' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'minimog' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'minimog' ) . '</option>
						</select></div>';

					if ( is_user_logged_in() ) {
						$comment_form['comment_field'] = $rating_template . $comment_form['comment_field'];
					} else {
						$comment_form['fields']['author'] = $rating_template . $comment_form['fields']['author'];
					}
				}

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'minimog' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
