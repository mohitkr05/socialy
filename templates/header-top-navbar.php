<?php
/*
*
*	@package : socialy
* 	@version : 1.1
*
*/
?>

<header class="header">

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<!-- ========= ====================== LOGO ====================== ============ -->
<div class="logo text-md-center">
	<h1>
		  <a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
	</h1>
</div><!-- /.logo -->
<!-- ==== ========== LOGO : END =============== ========= -->			</div><!-- /.col -->

			<div class="col-md-3 col-sm-3 col-xs-12">
<!-- ===== =================== SEARCH BAR ================ ================== -->
 <?php get_search_form(); ?>

<!-- ======= === SEARCH BAR : END  ======== ============ -->			</div><!-- /.col -->

			<div class="col-md-5 col-sm-5 col-xs-12">
				<!-- ========= ========== BLOCK HEADER LINKS ============= ======== -->
				
 
	 
		 <?php if ( !is_user_logged_in() ) { ?>
				
					<div class=" block-header-links pull-right">
					 
						 <a class="btn btn-default" href="#" data-toggle="modal" data-target="#loginModal"><i class="icon-profile"></i>  Login </a>
						<a href='<?php echo bp_get_signup_page() ?>' class="btn btn-default">Signup</a>
					</div>
				<?php	} else { ?>
					<div class="btn-group block-header-links pull-right">
						<a href='<?php echo bp_loggedin_user_domain(); ?>' class="btn btn-default">Profile</a>
						<a class="btn btn-default" href="<?php echo wp_logout_url( wp_guess_url() ); ?>"><?php _e( 'Log Out', 'buddypress' ); ?></a>
					</div>
				<?php	} ?>
 
	
<!-- = =========== BLOCK HEADER LINKS : END ========= ========== -->			</div><!-- /.col -->		
		</div><!-- /.row -->
		 
	</div><!-- /.container -->

	<!-- = ====== NAVBAR PRIMARY ========= -->
	
<nav class="navbar navbar-primary animate-dropdown" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button id="btn-navbar-primary-collapse" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div><!-- /.navbar-header -->
         <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav '));
        endif;
      ?>
    </nav>
    </div><!-- /.container -->
</nav><!-- /.yamm -->
<!-- ============================================================= NAVBAR PRIMARY : END ============================================================= -->
	
<?php do_action( 'bp_header' ); ?>
</header><!-- /.header -->
<!-- ============================================================= HEADER : END ============================================================= -->


<?php do_action( 'bp_after_header'     ); ?>
<?php do_action( 'bp_before_container' ); ?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/login', 'modal'); ?>