<div id="page-title-bar" <?php Minimog_Title_Bar::instance()->the_wrapper_class(); ?>>
	<div class="product-single-title-bar">
		<div class="product-single-title-bar__before">
			<?php  get_template_part( 'template-parts/breadcrumb' ); ?>
		</div>
		<div class="product-single-title-bar__after">
			<?php
				$product_prev = wc_get_product(get_previous_post()->ID);
				$product_next = wc_get_product(get_next_post()->ID);
			?>
			<?php if ($product_prev) : ?>
			<div class="product-single-more">
				<a href="<?php echo get_permalink( $product_prev->get_id() ); ?>" class="product-single-more__arrow">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 447.243 447.243"><path d="M420.361 192.229a31.967 31.967 0 00-5.535-.41H99.305l6.88-3.2a63.998 63.998 0 0018.08-12.8l88.48-88.48c11.653-11.124 13.611-29.019 4.64-42.4-10.441-14.259-30.464-17.355-44.724-6.914a32.018 32.018 0 00-3.276 2.754l-160 160c-12.504 12.49-12.515 32.751-.025 45.255l.025.025 160 160c12.514 12.479 32.775 12.451 45.255-.063a32.084 32.084 0 002.745-3.137c8.971-13.381 7.013-31.276-4.64-42.4l-88.32-88.64a64.002 64.002 0 00-16-11.68l-9.6-4.32h314.24c16.347.607 30.689-10.812 33.76-26.88 2.829-17.445-9.019-33.88-26.464-36.71z"/></svg>
				</a>
				<div class="product-single-more__item">
					<div class="product-single-more__thumbnail">
						<?php echo $product_prev->get_image(); ?>
					</div>
					<div class="product-single-more__info">
						<h3 class="product-single-more__title"><?php echo $product_prev->get_name(); ?></h3>
						<span class="product-single-more__price">
							<?php echo $product_prev->get_price(); ?>
						</span>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php if ($product_next) : ?>
			<div class="product-single-more">
				<a href="<?php echo get_permalink( $product_next->get_id() ); ?>" class="product-single-more__arrow">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492.004 492.004"><path d="M484.14 226.886L306.46 49.202c-5.072-5.072-11.832-7.856-19.04-7.856-7.216 0-13.972 2.788-19.044 7.856l-16.132 16.136c-5.068 5.064-7.86 11.828-7.86 19.04 0 7.208 2.792 14.2 7.86 19.264L355.9 207.526H26.58C11.732 207.526 0 219.15 0 234.002v22.812c0 14.852 11.732 27.648 26.58 27.648h330.496L252.248 388.926c-5.068 5.072-7.86 11.652-7.86 18.864 0 7.204 2.792 13.88 7.86 18.948l16.132 16.084c5.072 5.072 11.828 7.836 19.044 7.836 7.208 0 13.968-2.8 19.04-7.872l177.68-177.68c5.084-5.088 7.88-11.88 7.86-19.1.016-7.244-2.776-14.04-7.864-19.12z"/></svg>
				</a>
				<div class="product-single-more__item">
					<div class="product-single-more__thumbnail">
						<?php echo $product_next->get_image(); ?>
					</div>
					<div class="product-single-more__info">
						<h3 class="product-single-more__title"><?php echo $product_next->get_name(); ?></h3>
						<span class="product-single-more__price">
							<?php echo $product_next->get_price(); ?>
						</span>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
