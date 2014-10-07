
<?php dynamic_sidebar('sidebar-event'); ?>
<?php


//Meta data values
	$start_time = get_post_meta( get_the_ID(), 'event_start_time' ,true );
	$end_time = get_post_meta( get_the_ID(), 'event_end_time' ,true ); 
	$booking_url=get_post_meta( get_the_ID(), 'event_url' ,true ); 
	$price=get_post_meta( get_the_ID(), 'event_price' ,true ); 
	$venue=get_post_meta( get_the_ID(), 'geo_address' ,true ); 
	$organiser=get_post_meta( get_the_ID(), 'event_organiser' ,true ); 
	$video=get_post_meta( get_the_ID(), 'event_embed' ,true ); 

	?>
<?php if(( ! empty( $venue ) ) OR (! empty($organiser))) {?>
<div  class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Venue</h3></div>
	
	
<div class="panel-body">
<?php echo $venue; ?>
</div>
	
	<div class="panel-heading"><h3 class="panel-title">Organised by</h3></div>
	
	
<div class="panel-body">
<?php echo $organiser; ?>
</div>
 </div> 

<?php  } ?>


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
 



