<div style="" class="logo-header">
    <a href="<?php echo site_url(); ?>">
        <img width="168" height="36" alt="Automation Mailing System" src="<?php echo getAssetsPath(); ?>img/logo-horizontal-black.svg" style="opacity: 0.7">
    </a>
</div>

<div class="login-wrapper h-auto bg-grey">
    <div class="container">
        <div class="p-l-50 p-r-50 p-t-10 sm-p-l-15 sm-p-r-15 sm-p-t-40 m-auto">
            <h2 class="text-center">Account Verification</h2>

            <form action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form">
                <div class="row">    
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-group form-group-default">
                            <label class="verification_code">Verification Code</label>
                            <div class="controls">
                                <input required name="v" value="" type="text" placeholder="Enter code here" class="form-control" id="verification_code">
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-success btn-block" value="Verify" onclick="">
                    </div>    
                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
    </div>
</div>
	





