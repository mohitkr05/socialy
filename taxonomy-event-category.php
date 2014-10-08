<?php
 
 
 if ( have_posts() ) : ?>

			
  
    <div class="section" id="recent-projects" style="position: relative;">

      <div class="container">


		  
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-title">Current Events</h2>
          </div>
	<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
          <div class="col-lg-4 col-md-4 col-sm-6">
			  
			  
            <a href="<?php the_permalink(); ?>" class="link-portfolio">
				
								
				<?php if (has_post_thumbnail()) :
		
    the_post_thumbnail( 'eventthumb', array( 'class' => 'img-responsive thumbnail img-home-portfolio' ) );  
 
	endif; 
	?>
              <div class="overlay-portfolio">
                <h3><?php the_title(); ?></h3>
                <small class="text-muted">
                
					<button type="button" class="btn btn-small">View</button> </small>
              </div><!-- /.overlay-portfolio -->

            </a>
          </div>
			
			
            <?php endwhile; ?>
		 
        </div><!-- /.row -->

      </div><!-- /.container -->

    </div><!-- /.section -->
  <?php endif; ?>
