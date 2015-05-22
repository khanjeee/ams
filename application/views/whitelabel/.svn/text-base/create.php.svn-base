<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/angular/bootstrap-colorpicker-module.js"></script>
<script src="<?php echo getAssetsPath(); ?>js/custom/whitelabel.js"></script>
<link href="<?php echo getAssetsPath(); ?>/css/colorpicker.css" rel="stylesheet">

<?php if(isset($aWhiteLabelInfo['selected_theme']))
        {
    
        $aColors = json_decode($aWhiteLabelInfo['selected_theme']);
        
        }
    ?>
	<h1 class="heading-sty-1"><?php echo $sHeading; ?></h1>
	<?php echo $htmlErrorMessages; ?>
<form  enctype="multipart/form-data" class="form-validate-whitelabel navbar-form form-sty-1 m-0" action="<?php print $sFormAction; ?>" method="post" id="create-whitelabel-form">
    <div id="whitelabel_add_top" class="c-box">



        <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="title">Title:</label>
                    <div class="controls">
                        <input required name="whitelabel[title]" type="text" class="form-control" value="<?php echo (isset($aWhiteLabelInfo['title'])) ? $aWhiteLabelInfo['title'] : '' ; ?>" placeholder="Name">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="description">Description:</label>
                    <div class="controls">
                        <textarea required rows="6" cols="80" name="whitelabel[description]" class="form-control" placeholder="Add some white label details..."><?php echo (isset($aWhiteLabelInfo['description'])) ? $aWhiteLabelInfo['description'] : ''; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
		
		  <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="title">Email:</label>
                    <div class="controls">
                        <input required name="whitelabel[email_address]" type="text" class="form-control" value="<?php echo (isset($aWhiteLabelInfo['email_address'])) ? $aWhiteLabelInfo['email_address'] : ''; ?>" placeholder="example@ams.com">
                    </div>
                </div>
            </div>
        </div>
		    <div class="row">
		      <div class="col-lg-6">
            <div class="form-group form-group-default form-group-default-select2">
                <label>Solution Type:</label>
                <select required name="whitelabel[solution_type]" class="select--no-search full-width" data-init-plugin="select2">
      						<?php global $gSolutionType;
      						if(is_array($gSolutionType) && !empty($gSolutionType)) :
      							foreach($gSolutionType  as $iKey  => $solution_type): 
      									  $htmlSelected  = '';
                                         if($aWhiteLabelInfo['solution_type'] == $iKey) :
      									  $htmlSelected = ' selected="selected" ';                           
                                        endif ;?>
      								<option <?php echo $htmlSelected; ?> value='<?php echo $iKey; ?>'><?php echo $solution_type; ?></option>   
      						<?php endforeach; ?>
      						 <?php endif;  ?> 
      					</select>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="price">Promotion Code:</label>
                    <div class="controls">
                        <input required  name="whitelabel[promotion_code]" type="text" class="form-control"   value="<?php echo (isset($aWhiteLabelInfo['promotion_code'])) ? $aWhiteLabelInfo['promotion_code'] : ''; ?>"  placeholder="Promotion Code">
                    </div>
                </div>
            </div>
        </div>

        <div ng-app='ColorApp'>
            <div class="row">
              <div class="col-md-12">
                <br>
                <h3 class="m-t-20">Select Colors</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row" >
                  <div class="col-lg-12">
                    <div class="form-group form-group-default">
                        <label class="price">Choose Logo BackGround:</label>
                        <div class="controls" ng-controller='ColorCtrl'>
                            <input colorpicker
                                   maxlength="7"
                                   required="required"
                                   ng-model="hexPicker"
                                   name="whitelabel[selected_theme][logo_background]"
                                   type="text" class="form-control"
                                   ng-init="hexPicker='<?php echo (isset($aColors->logo_background)) ? $aColors->logo_background : ''; ?>'" 
                                    placeholder="Color Code">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group form-group-default">
                        <label class="price">Choose Menu Color:</label>
                        <div class="controls" ng-controller='ColorCtrl'>
                            <input colorpicker
                                   required="required"
                                   maxlength="7"
                                   ng-model="hexPicker"
                                   name="whitelabel[selected_theme][menu_color]"
                                   type="text" class="form-control"
                                   ng-init="hexPicker='<?php echo (isset($aColors->menu_color)) ? $aColors->menu_color : ''; ?>'" 
                     placeholder="Color Code">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row" >
                  <div class="col-lg-12">
                    <div class="form-group form-group-default">
                        <label class="price">Theme Primary Color:</label>
                        <div class="controls" ng-controller='ColorCtrl'>
                            <input colorpicker
                                   required="required"
                                   ng-model="hexPicker"
                                   maxlength="7"
                                   name="whitelabel[selected_theme][theme_primary_color]"
                                   type="text" class="form-control"
                                   ng-init="hexPicker='<?php echo (isset($aColors->theme_primary_color)) ? $aColors->theme_primary_color : ''; ?>'" 
                     placeholder="Color Code">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group form-group-default">
                        <label class="price">Theme Secondary Color:</label>
                        <div class="controls" ng-controller='ColorCtrl'>
                            <input colorpicker
                                   required="required"
                                   maxlength="7"
                                   ng-model="hexPicker"
                                   name="whitelabel[selected_theme][theme_secondary_color]"
                                   type="text" class="form-control"
                                   ng-init="hexPicker='<?php echo (isset($aColors->theme_secondary_color)) ? $aColors->theme_secondary_color : ''; ?>'" 
                     placeholder="Color Code">
                        </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="col-md-6">
                <img src="<?php echo getAssetsPath(); ?>img/theme_color_guide.jpg" alt="color guide" style="border: 1px solid #ededed; max-width:100%;" class="m-b-20">
              </div>
            </div>
        </div>
		<?php   
		#d($aWhiteLabelInfo);
		
				
		?>
			
    <div class="row">
      <div class="col-md-12">
        <h3 class="m-t-20">Select Logo</h3>
      </div>
    </div>
    <!-- Current Logo -->
		<?php /*if($bisEditMode)  :*/ ?>
        
        <!-- <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="logo">Current Logo:</label>
                    <div class="controls">
                              <img src="<?php echo site_url(COMPANY_LOGO_PATH.$aWhiteLabel['logo']); ?>" class="brand" width="220"  >
                    </div>
                </div>
            </div>
        </div> -->

		<?php  /*else :*/ ?>  
	<!-- <div class="row">
              <div class="col-lg-6">
                  <div class="form-group form-group-default">
                      <label class="logo">Current Logo:</label>
                      <div class="controls">
            <img src="<?php echo site_url(DEFAULT_COMPANY_LOGO_PATH); ?>" class="brand" width="50"  height="50">
                        
                      </div>
                  </div>
              </div>
          </div> -->
		
		<?php /*endif;*/ ?>
    <!-- END - Current Logo -->
	<div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="logo">Choose Logo:</label>
                    <div class="controls">
                         <input <?php echo ($bisEditMode) ? '' : 'required';  ?> name="<?php echo MEDIA_FILE_UPLOAD_FIELD; ?>" type="file" class="form-control m-t-10" id="company_logo">
                         <p>Logo size should be under 414x160 resolution.</p>
                    </div>
                </div>
            </div>
        </div>
        
	<div class="row">
			<div class="col-md-12 m-t-20 m-m-t-0">
        <input type="hidden" name="whitelabel[whitelabel_id]"   value="<?php echo (isset($aWhiteLabelInfo['whitelabel_id'])) ? $aWhiteLabelInfo['whitelabel_id'] : ''; ?>">
        <input type="submit" class="btn btn-success m-btn-full btn-cons" value="Save" name="btnSubmit">
			</div>
	</div>
    </div>

</form>







