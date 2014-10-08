<!--Login Modal-->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h2>Login / <a href="register.html">Register</a> or </h2>
           <?php do_action( 'wordpress_social_login' ); ?> 
          </div>
          <div class="modal-body">
           <?php 
				 $args = array(
        'redirect' => '/events', 
        'form_id' => 'loginform-custom',
        'label_username' => __( 'Your Username' ),
        'label_password' => __( 'Your Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'remember' => true
    );
    wp_login_form( $args );
  ?>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
