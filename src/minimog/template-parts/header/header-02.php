<header id="page-header" <?php Minimog_Header::instance()->get_wrapper_class(); ?>">
	<div class="page-header-place-holder"></div>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="header-wrap">
						<?php Minimog_THA::instance()->header_wrap_top(); ?>
						<div class="header-left">
							<?php get_template_part( 'template-parts/branding' ); ?>
							<?php get_template_part( 'template-parts/navigation' ); ?>
						</div>
						<div class="header-right">
							<div id="header-right-inner" class="header-right-inner">

								<?php Minimog_Header::instance()->print_currency_switcher(); ?>

								<?php Minimog_Header::instance()->print_account(); ?>

								<?php Minimog_THA::instance()->header_right_top(); ?>

								<?php Minimog_Header::instance()->print_language_switcher(); ?>

								<?php Minimog_Header::instance()->print_social_networks(); ?>

								<?php Minimog_Header::instance()->print_search(); ?>

								<?php Minimog_Header::instance()->print_wishlist_button(); ?>

								<?php Minimog_Woo::instance()->render_mini_cart(); ?>

								<?php Minimog_Header::instance()->print_login_button(); ?>


								<?php Minimog_Header::instance()->print_button( array( 'size' => 'xs' ) ); ?>

								<?php Minimog_THA::instance()->header_right_bottom(); ?>
							</div>

							<?php Minimog_Header::instance()->print_open_mobile_menu_button(); ?>

							<?php Minimog_Header::instance()->print_more_tools_button(); ?>
						</div>

						<?php Minimog_THA::instance()->header_wrap_bottom(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
