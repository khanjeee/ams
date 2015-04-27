<div style="" class="logo-header">
    <a href="<?php echo site_url(); ?>">
      <img width="168" height="36" alt="Automation Mailing System" src="../assets/img/logo-horizontal-black.svg" style="opacity: 0.7">
    </a>
</div>

<?php if(isset($sMessage)) {echo $sMessage;} ?>

<?php #pr($aUserInfo);die; ?>
<!-- START PAGE-CONTAINER -->
  <div class="login-wrapper bg-grey">
      <!-- START Login Right Container-->
      <div class="login-container">
        <div class="p-l-50 p-r-50 p-t-50 sm-p-l-15 sm-p-r-15 sm-p-t-40 m-auto">
			<h2 class="text-center">Forgot Password</h2>

          <!-- START Login Form -->
			<form action="<?php echo site_url('home/forgotpassword');?>" method="post" accept-charset="utf-8"  role="form" class="p-t-15">
	            <!-- START Form Control-->
	            <div class="form-group form-group-default">
	              <label>Email Address</label>
	              <div class="controls">
	                <input name="data[login_key]" value="<?php echo $aUserInfo['login_key']; ?>" type="text" required="required" class="form-control" id="login_key" placeholder="Email" required>
	              </div>
	            </div>
	            <div class="row mobile-m-0">
	              <div class="col-md-12">
	                <button class="btn btn-primary btn-block btn-cons m-t-10" name="data[login_btn]" type="submit">Reset</button>
	                <div class="text-center m-t-20 d-b">
	                	<a class="m-l-3 small" href="<?php echo site_url(); ?>">Login</a>
	                	or
	                	<a class="m-l-3 small" href="<?php echo site_url('register/save'); ?>">Register</a>
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

