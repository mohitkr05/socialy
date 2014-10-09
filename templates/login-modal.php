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
'redirect' => home_url(),
'id_username' => 'user',
'id_password' => 'pass',
'form_id'        => 'loginform'	
)
;?>

<?php wp_login_form( $args ); ?>

 

          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
