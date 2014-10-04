<header>
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

		if ( is_front_page() ) {

		}

		echo '</div><!-- .section-image-overlay -->'
		.'</div><!-- .section-image -->'
		.'</header><!-- content-image-header -->';

	?> 
	</header><!-- .content-header -->

	<?php endif; // has_post_thumbnail() ?>
