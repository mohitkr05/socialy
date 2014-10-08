<div class="container">
	<div class="row">
		<h2 class="text-center">Event Categories</h2>
        <hr/>
	</div>
    
	
<?php
		
$terms = apply_filters( 'taxonomy-images-get-terms', '', array('taxonomy' => 'event-category',
															   'term_args' => 'hide_empty=0',
															   'image_size' => 'medium'
															  ) );
?>
	
	
	<div class="row">
		
		<?php foreach( (array) $terms as $term){ ?>
        <div class="col-sm-6 col-md-4">
			<a href="<?php echo esc_url( get_term_link( $term, $term->taxonomy ) ); ?>">
            <div class="thumbnail">
                <h4>
                    <?php echo $term->name; ?>
                    <span class="label label-info info">
                        
                        <span data-toggle="tooltip" title="number of events"><?php echo $term->count; ?></span>
                    </span>
                </h4>
               <?php echo wp_get_attachment_image( $term->image_id, 'large' ); ?>
               
                <div class="clearfix"></div>
            </div>
        </div>
        
		<?php 	} ?>
    </div>
</div>