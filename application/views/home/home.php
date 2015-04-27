<?php
$sSiteTitle     =   SITE_TITLE;
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 12/22/14
 * Time: 5:00 PM
 */
?>

<!-- START PAGE-CONTAINER -->
  <div class="login-wrapper ">
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 p-r-50 p-t-50 sm-p-l-15 sm-p-r-15 sm-p-t-40 m-auto">
          <div class="text-center">
            <a href="<?php echo site_url(); ?>">
              <img width="168" height="36" style="opacity: 0.7" src="assets/img/logo-horizontal-black.svg" alt="<?php echo $sSiteTitle; ?>">
            </a>
          </div>
          <p class="p-t-35">Sign into your <?php echo $sSiteTitle; ?> account</p>
          <!-- START Login Form -->
          <form method="post" action="<?php echo site_url('home/login'); ?>" id="form-login" class="p-t-15" role="form" action="index.html">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Login</label>
              <div class="controls">
                <input type="email" name="data[login_key]"  placeholder="Email" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Password</label>
              <div class="controls">
                <input type="password" name="data[secret]" class="form-control"  placeholder="Password" required>
              </div>
            </div>
            <!-- START Form Control-->
             <div class="row mobile-m-0">
              <div class="no-padding col-md-6">
                <!-- <div class="checkbox ">
                  <input type="checkbox" value="1" id="checkbox1">
                  <label for="checkbox1">Keep Me Signed in</label>
                </div> -->
              </div>
              <div class="col-md-12 text-left m-t-10 tablet-text-left mobile-p-0 m-b-10"> 
                <a href="<?php echo site_url('home/forgotpassword'); ?>" class="small">Forgot password</a> 
              </div>
            </div>
            <!-- END Form Control-->
            <div class="row mobile-m-0">
              <div class="col-md-12">
                <button class="btn btn-primary btn-block btn-cons m-t-10" type="submit">Sign in</button>
                <div class="text-center m-t-20 d-b">
                  Dont have an account?
                  <a class="m-l-3 small" href="<?php echo site_url('register/save'); ?>">Get Registered.</a>
                </div>
              </div>
            </div>            
          </form>
          <!--END Login Form-->
          <div class="pull-bottom sm-pull-bottom before-login-bot-footer">
            <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
              <div class="col-sm-12 no-padding m-t-10">
                <p class="small no-margin sm-pull-reset">
                    <span class="hint-text">Copyright &copy; 2015</span>
                    <span class="font-montserrat"><a href="<?php echo site_url(); ?>">AMS</a></span>.
                    <span class="hint-text">All rights reserved.</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END Login Right Container-->
    </div>
    <!-- END PAGE CONTAINER -->

