<footer class="content-info bottom" role="contentinfo">
      <div class="container">

        <div class="row">
          <div class="col-lg-3 col-md-3">
               <?php dynamic_sidebar('sidebar-footer-1'); ?>
          </div>
          <div class="col-lg-3 col-md-3">
            <?php dynamic_sidebar('sidebar-footer-2'); ?>
          </div>
          
          <div class="col-lg-3 col-md-3">
             <?php dynamic_sidebar('sidebar-footer-3'); ?>
          </div>

          <div class="col-lg-3 col-md-3">
            <?php dynamic_sidebar('sidebar-footer-4'); ?>
          </div>
        </div><!-- /.row -->

      </div><!-- /.container -->
    </footer>

    <div class="footer-after">
      <div class="container">
        <div class="row">
          <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
        </div><!-- /.row -->
      </div>
    </div>
    <?php wp_footer(); ?>