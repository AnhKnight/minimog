<div id="page-title-bar" <?php Minimog_Title_Bar::instance()->the_wrapper_class(); ?>>
	<?php  get_template_part( 'template-parts/breadcrumb' ); ?>
	<div class="page-title-bar-inner">
		<div class="container">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<?php  Minimog_THA::instance()->title_bar_heading_before(); ?>
					<?php  Minimog_THA::instance()->title_bar_heading_after(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
