<?php 
	// CHECK FOR FEATURED IMAGE AND USE IT IF ITS FULL-WIDTH
	global $content_width;
	$image_width = null;
	if ( ( is_page() OR is_single() ) ) {
		
		if(has_post_thumbnail() ) {
		
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
		$image_width = $featured_image[1];
			
		$image_url = $featured_image[0];
		
		 
	}
	else
	{
		$featured_image =  get_template_directory_uri() . '/assets/img/event_bg.jpg';
		$size = getimagesize($featured_image);
		$image_width = $size[0];
		$image_url = $featured_image;
		 	
	}
	
}

	if ( $content_width AND $image_width >= $content_width ) :
		echo '<header class="content-header-image">';

		// If no title or description, get them from the page or post and custom fields
		$title 	= get_the_title();
		
		// For home page only, use special image classes for taller image
		if ( !is_front_page() ) {
			
			echo '<div class="section-image" style="background-image: url(\'' . $image_url . '\');">'
				.'<div class="section-image-overlay">';
		}

		echo '<h1 class="header-image-title">' . $title . '</h1>';
	
		// Only for home page, show a scroll down icon
		if ( is_front_page() ) {

		}

		echo '</div><!-- .section-image-overlay -->'
		.'</div><!-- .section-image -->'
		.'</header><!-- content-image-header -->';

	?> 

		<header class="content-header">
		<div class="container">

		<h1 class="page-title">		
		<?php
		if ( is_page() OR is_single() ) :
			the_title();
						
		elseif ( is_category() ) :
			single_cat_title();

		elseif ( is_tag() ) :
			single_tag_title();

		elseif ( is_author() ) :
			// Queue the first post, that way we know what author we're dealing with
			the_post();
			printf( __( 'Author: %s', 'flat-bootstrap' ), '<span class="vcard">' . get_the_author() . '</span>' );
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			rewind_posts();

		elseif ( is_search() ) :
			printf( __( 'Search Results for: %s', 'flat-bootstrap' ), '<span>' . get_search_query() . '</span>' );

		elseif ( is_day() ) :
			printf( __( 'Day: %s', 'flat-bootstrap' ), '<span>' . get_the_date() . '</span>' );

		elseif ( is_month() ) :
			printf( __( 'Month: %s', 'flat-bootstrap' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

		elseif ( is_year() ) :
			printf( __( 'Year: %s', 'flat-bootstrap' ), '<span>' . get_the_date( 'Y' ) . '</span>' );
		/*
		elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
			_e( 'Asides', 'flat-bootstrap' );

		elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
			_e( 'Images', 'flat-bootstrap');

		elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
			_e( 'Videos', 'flat-bootstrap' );

		elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
			_e( 'Quotes', 'flat-bootstrap' );

		elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
			_e( 'Links', 'flat-bootstrap' );
		*/
		elseif ( is_post_type_archive( 'jetpack-portfolio' ) OR is_tax ( 'jetpack-portfolio-type' ) ) :
			_e( 'Portfolio', 'flat-bootstrap' );
			
		elseif ( is_home() ) : //ONLY if home page is static and we are on the blog page
		//elseif ( is_home() AND ! is_front_page() ) : //ONLY if home page is static and we are on the blog page
			$home_page = get_option ( 'page_for_posts' );
			if ( $home_page ) $post = get_post( $home_page );
			if ( $post ) {
				echo $post->post_title;
			} else {
				_e( 'Blog', 'flat-bootstrap' );
			}

		else :
		//elseif ( ! is_front_page() ) :
			_e( 'Archives', 'flat-bootstrap' );
		endif;
		?>
		</h1>
		
		<?php
		// NOW LOOK FOR AN OPTIONAL SUBTITLE

		// If home page, display the subtitle if there is one
		//if ( is_home() ) {
		if ( is_home() AND ! is_front_page() ) {
			$subtitle = get_post_meta( $home_page, '_subtitle', $single = true );
			if ( $subtitle ) printf( '<h3 class="page-subtitle taxonomy-description">%s</h3>', $subtitle );

		// If not home page, then display the term description or custom subtitle
		} else {
			$term_description = term_description();
			if ( ! empty( $term_description ) ) {
				printf( '<h3 class="page-subtitle taxonomy-description">%s</h3>', $term_description );

			// Show an optional custom page field named "subtitle"
			} else {
				$subtitle = get_post_meta( get_the_ID(), '_subtitle', $single = true );
				if ( $subtitle ) printf( '<h3 class="page-subtitle taxonomy-description">%s</h3>', $subtitle );
			} // term_description
		} // is_home()
		?>

		</div><!-- .container -->

	</header><!-- .content-header -->

	<?php endif; // has_post_thumbnail() ?>
