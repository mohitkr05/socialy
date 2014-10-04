
<?php


//Meta data values
	$start_time = get_post_meta( get_the_ID(), 'event_start_time' ,true );
	$end_time = get_post_meta( get_the_ID(), 'event_end_time' ,true ); 
	$booking_url=get_post_meta( get_the_ID(), 'event_url' ,true ); 
	$price=get_post_meta( get_the_ID(), 'event_price' ,true ); 

	?>
 
<?php if(( ! empty( $price ) ) OR (! empty($booking_url))) {?>
<div  class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Event Details</h3></div>
<div class="panel-body">
	<?php if( ! empty( $price ) ) { ?>
	<h5>
	Tickets From  :  <i class="fa fa-inr"></i><?php echo $price; ?> </h5>
	<?php } ?>
	<br/>
	<?php if( ! empty( $booking_url ) ) { ?>
<a class="btn btn-primary btn-lg" href="<?php echo $booking_url; ?>">Book Tickets</a>
	<?php } ?>
 </div>
 </div>
<?php }?>

<?php if( ! empty( $start_time ) ) { ?>
<div  class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Timings</h3></div>
<div class="panel-body">
		<?php if( ! empty( $start_time ) ) { ?>
	<h5>
	Event Start <i class="fa fa-calendar"></i> : <?php echo gmdate("d-M-Y \ H:i", $start_time);?> <hr>	<br/>
			<?php } ?>
		<?php if( ! empty( $end_time ) ) { ?>
		Event end
		<i class="fa fa-calendar"></i> :  <?php echo gmdate("d-M-Y \ H:i", $end_time);?>
		<hr>	
		<?php } ?>
	</h5>
 </div>
 </div>

<?php }?>
<?php
// Find Location
$connected = new WP_Query( array(
  'connected_type' => 'events_to_locations',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );

// Display connected pages
if ( $connected->have_posts() ) :
?>
		
 	
<div  class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Location</h3></div>
<div class="panel-body">

<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
 <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<p><?php echo get_post_meta($post->ID, 'geo_address', true);?></p>
	
<?php// echo GeoMashup::map() ?>
<?php endwhile; ?>

	
<?php 
// Prevent weirdness
wp_reset_postdata();

endif;
?>
</div>
</div>

<?php dynamic_sidebar('sidebar-event'); ?>

