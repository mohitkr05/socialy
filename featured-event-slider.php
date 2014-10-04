<?php
$args = array( 'post_type'=>'event');
$sliders = get_posts( $args );


$total_sliders = count($sliders);
?>
 
 <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
	 
	 <ol class="carousel-indicators">
           <?php for($i = 0; $i<$total_sliders; $i++){ ?>
		    <li data-target="#main-slider" data-slide-to="<?php echo $i ?>" class="<?php echo ($i==0)?'active':'' ?>"></li>
		 <?php } ?>

        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
			<?php foreach ($sliders as $key => $slider) { 
			 $feat_bg_image          =   wp_get_attachment_image_src( get_post_thumbnail_id( $slider->ID ), 'full');
	 
	?>
          <div class="item <?php echo ($key==0) ? 'active' : '' ?>">
            <div class="fill" style="background-image:url('<?php echo ( $feat_bg_image[0] ) ? $feat_bg_image[0] : '' ?>');"></div>
            <div class="carousel-caption">
             <a href="<?php echo $slider->guid; ?>"> <h2><?php echo $slider->post_title; ?></h2></a>
            </div>
          </div>
			
		<?php	}?>
			
			
                        </div>
                   

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <i class="fa fa-angle-left"></i>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <i class="fa fa-angle-right"></i>
        </a>
    </div>