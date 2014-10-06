<?php get_template_part('featured-event-slider'); ?>
        <div class="section-colored home">

      <div class="container">

        <div class="row">
          <div class="col-md-9 col-sm-8">
            <h2>Break the ice... Socialize!!</h2>
          </div>
          <div class="col-md-3 col-sm-4">
            <a href="/register" class="btn btn-danger btn-lg">Join</a>
          </div>
        </div><!-- /.row -->
 
   </div><!-- /.container -->

  </div><!-- /.section-colored -->
 
    <div class="section">

      <div class="container">
	<div class="block-body">
<h2>How it works?</h2>
		  </div>
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <div class="block-icon">
              <i class="fa fa-rocket"></i>
            </div>

            <div class="block-body">
              <h2>Move Out</h2>
              <div class="line-subtitle"></div>
              <p>Move out and attend events that you really love.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="block-icon">
              <i class="fa fa-users"></i>
            </div>

            <div class="block-body">
              <h2> Meet new people</h2>
              <div class="line-subtitle"></div>
              <p>Meet new people, not online, but in real life. Break the Ice. Socialize.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="block-icon">
              <i class="fa fa-cog"></i>
            </div>

            <div class="block-body">
              <h2> Be Awesome	</h2>
              <div class="line-subtitle"></div>
              <p>Have some awesome time in your real life.</p>
            </div>
          </div>
        </div><!-- /.row -->

   </div><!-- /.container -->

     </div><!-- /.section -->
  

		 <?php 
global $post, $event;
query_posts( array ( 'post_type' => 'event' , 'event-category' => 'featured' ,'posts_per_page' => 3) ); ?>
 
 
<?php if ( have_posts() ) : ?>

			
  
    <div class="section" id="recent-projects" style="position: relative;">

      <div class="container">


		  
        <div class="row">
          <div class="col-lg-12">
            <h2 class="section-title">Featured Events</h2>
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

 
    <div class="section-colored">
		<?php get_template_part('templates/event-category-display'); ?>
     </div>

<!--       </div>/.container -->

 <!--   </div> /.section-colored -->

 