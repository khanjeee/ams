<?php if(!isUserLoggedIn()){ ?>

<div style="" class="logo-header">
    <a href="<?php echo site_url(); ?>">
        <img width="168" height="36" alt="Automation Mailing System" src="<?php echo getAssetsPath(); ?>img/logo-horizontal-black.svg" style="opacity: 0.7">
    </a>
</div>

<?php } ?>

<div class="login-wrapper h-auto bg-grey">
    <?php if(!isUserLoggedIn()){
    	echo '<div class="container">';
    } ?>
        <div class="p-l-50 p-r-50 p-t-10 sm-p-l-15 sm-p-r-15 m-auto">
            <br>
            <br>
            <div class="m-t-20 m-b-20 text-center">
                <h1 class="error-number">404</h1>
                <h2 class="semi-bold">Sorry but we couldnt find this page</h2>
                <p>
                    This page you are looking for does not exsist. Go to <a href="<?php echo site_url(); ?>">Home.</a>
                </p>
            </div>
            <br>
            <br>

			<?php if(!isUserLoggedIn()){ ?>          
            <div class="sm-pull-bottom before-login-bot-footer">
                <div class="p-b-30 p-t-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                    <div class="col-sm-12 no-padding m-t-10">
                        <p class="small no-margin sm-pull-reset">
                            <span class="hint-text">Copyright &copy; 2015</span>
                            <span class="font-montserrat"><a href="<?php echo site_url(); ?>">AMS</a></span>.
                            <span class="hint-text">All rights reserved.</span>
                        </p>
                    </div>
                </div>
            </div>
			<?php } ?>

        </div>
    <?php if(!isUserLoggedIn()){
    	echo '</div>';
    } ?>
</div>