<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
	  <hr>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
		
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
	  <h3>Related Events:</h3>
	 <?php display_related_events($post);?>
  </article>
<?php endwhile; ?>
