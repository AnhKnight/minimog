<?php
// Check post meta off all pages
add_action( 'init', 'test' );
function test() {
	$pages   = get_pages();
	if ( $pages ) {
		foreach ( $pages as $page ) {
			if ( strpos( $page->post_content, 'tm_product_categories' ) !== false) {
				Minimog_Debug::d( $page->post_title );
			}
			/*$post_options = unserialize( get_post_meta( $page->ID, 'insight_page_options', true ) );
			if ( $post_options !== false && isset( $post_options['custom_logo'] ) && $post_options['custom_logo'] !== '' ) {
				Minimog_Debug::d( $page->post_title );
			}*/

		}
	}
}

add_action( 'init', 'test2' );
function test2() {
	$types = array(
		'page',
		'service',
		'case_study',
	);

	foreach ( $types as $type ) {
		$query = new WP_Query( array(
			'post_type'      => $type,
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
		) );

		while ( $query->have_posts() ) {
			$query->the_post();


			if ( strpos( get_the_content(), 'tm_button style="text"' ) !== false ) {
				Minimog_Debug::d( get_the_title() );
			}

		}

		wp_reset_query();
	}
}


add_action( 'init', 'test' );
function test() {
	$args  = array(
		'post_type'  => 'page',//it is a Page right?
		'meta_query' => array(
			array(
				'key'   => '_wp_page_template',
				'value' => 'portfolio-fullscreen-type-hover.php',
				'compare' => 'LIKE',
			),
		),
		'posts_per_page' => -1,
		'no_found_rows'  => true,
	);
	$query = new WP_Query( $args );

	Minimog_Debug::d( $query );

	while ( $query->have_posts() ) {
		$query->the_post();


		Minimog_Debug::d( get_the_title() );
		Minimog_Debug::d( get_the_ID() );

	}

	wp_reset_query();
}


// Check Page Title Bar Used

add_action( 'init', 'test' );
function test() {
	$pages   = get_pages();
	$results = array();
	if ( $pages ) {
		foreach ( $pages as $page ) {
			$post_options = unserialize( get_post_meta( $page->ID, 'insight_page_options', true ) );
			if ( $post_options !== false && isset( $post_options['page_title_bar_layout'] ) && $post_options['page_title_bar_layout'] !== '' ) {
				//Minimog_Debug::d( $page->post_title . ' - ' . $post_options['header_type'] );
				$type = $post_options['page_title_bar_layout'];

				if ( ! isset( $results[ $type ] ) ) {
					$results[ $type ] = [];
				}

				$results[ $type ][] = $page->post_title;
			}
		}
	}

	Minimog_Debug::d( $results );
	ksort( $results );
	Minimog_Debug::d( $results );
}


// Multi site query

/*add_action( 'init', 'test' );
function test() {
	$results = array();
	$sites   = get_sites();
	Minimog_Debug::d( $sites );
	$sites = object_to_array( $sites );
	Minimog_Debug::d( $sites );


	foreach ( $sites as $site ) {
		switch_to_blog( $site['blog_id'] );


		$pages = get_pages();
		if ( $pages ) {
			foreach ( $pages as $page ) {
				if ( strpos( $page->post_content, 'tm_list list_style="manual-numbered-01"' ) !== false ) {
					if ( ! isset( $results[ $site['blog_id'] ] ) ) {
						$results[ $site['blog_id'] ]   = array();
						$results[ $site['blog_id'] ][] = $site['path'];
					}

					$results[ $site['blog_id'] ][] = $page->post_title;
				}
//				$post_options = unserialize( get_post_meta( $page->ID, 'insight_page_options', true ) );
//				if ( $post_options !== false && isset( $post_options['custom_logo'] ) && $post_options['custom_logo'] !== '' ) {
//					Minimog_Debug::d( $page->post_title );
//				}

			}
		}

		restore_current_blog();
	}

	Minimog_Debug::d( $results );
}

function object_to_array( $object ) {
	if ( ! is_object( $object ) && ! is_array( $object ) ) {
		return $object;
	}

	return array_map( 'object_to_array', (array) $object );
}*/
