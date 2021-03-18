<div <?php Minimog_Top_Bar::instance()->get_wrapper_class(); ?>>
	<div class="container">
		<div class="row row-eq-height">
			<div class="col-md-6 top-bar-left">
				<div class="top-bar-wrap">
					<?php Minimog_Top_Bar::instance()->print_components( 'left' ); ?>
				</div>
			</div>
			<div class="col-md-6 top-bar-right">
				<div class="top-bar-wrap">
					<?php Minimog_Top_Bar::instance()->print_components( 'right' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
