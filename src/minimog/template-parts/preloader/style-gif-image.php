<?php
$image = Minimog::setting( 'pre_loader_image' );
?>
<div>
	<?php if ( $image !== '' ): ?>
		<img src="<?php echo esc_url( $image ); ?>"
		     alt="<?php esc_attr_e( 'Minimog Preloader', 'minimog' ); ?>">
	<?php endif; ?>
</div>
