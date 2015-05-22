<?php //d($aRegistrationInfo); ?>
<div class="text-error">
<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['message'] : '';  ?>    
</div>
<!-- Code for Angular -->
<link rel="stylesheet" href="<?php echo getAssetsPath(); ?>css/angular/ng-tags-input.min.css" />
<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/angular/ng-tags-input.min.js"></script>
<!-- END - Code for Angular -->

<div id="response"></div>

<?php 

if(!isUserLoggedIn())
{

?>

<div style="" class="logo-header">
	<a href="<?php echo site_url(); ?>">
		<img width="168" height="36" alt="Automation Mailing System" src="<?php echo getAssetsPath(); ?>img/logo-horizontal-black.svg" style="opacity: 0.7">
	</a>
</div>

<?php 

}

?>

<!-- START PAGE-CONTAINER -->
<div class="login-wrapper h-auto bg-grey"  ng-app="" ng-controller="registerController">
	<!-- START Login Right Container-->
	<div class="container">
		<div class="p-l-50 p-r-50 p-t-10 sm-p-l-15 sm-p-r-15 sm-p-t-40 m-auto">

			<h2 class="text-center">Sign Up</h2>

			<div id="formErrorWrap">
				<button data-dismiss="alert" class="close"></button>
			</div>

			<!-- START Sign Up -->
			<form enctype="multipart/form-data" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="" id="user_register">

				<div class="row">
					<div class="col-md-12">
						<div class="select-package-outer">
							<div class="select-package">
								<div class="title-with-checkbox">
									<legend>Select Package</legend>
									<div class="checkbox check-success checkbox--inline">
										<input type="checkbox" value="havePromotionCode" name="havePromotionCode" id="havePromotionCode">
										<label for="havePromotionCode">I have a promotion code.</label>
									</div>
								</div>
								<hr class="m-t-0 m-b-10">
								<div id="enterPromotion" style="display:none;">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label class="promotion_code">Promotion Code</label>
												<div class="controls">
													<input name="data[promotion_code]" value="" type="text" placeholder="Promotion Code" class="form-control" id="promotion_code" onkeypress="return event.keyCode != 13;">
												</div>											
											</div>
											<div class="promotion_code_error"></div>
										</div>
										<div class="col-md-6">
											<a ng-click="JsPromoCodePackages()" href="#" class="btn btn-primary m-t-10 m-m-t-0">Submit Code</a>
										</div>
									</div>
									<ul class="select-package__list selected" id="packagePromotionList">
										<li ng-repeat="package in jsPromotionCodePackages">
											<div class="wrap">
												<div class="radio radio-success">
												  <input type="radio" name="data[package_id]" id="select-promoted-package-id-{{ package.package_id }}" value="{{ package.package_id }}" required>
												  <label for="select-promoted-package-id-{{ package.package_id }}">
													<div class="cover-img package-img" style="background-image: url({{ package.image }}); "></div>
													<div class="label-wrap">
														<div class="title">
															{{ package.title }}
														</div>
														<div class="description">
															{{ package.description }}
														</div>
														<div class="price">
															<Strong>Price:</Strong>
															${{ package.price }}
														</div>
													</div>
												  </label>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<ul class="select-package__list selected" id="packageList">
									<?php foreach ($aPackages as $data): ?>
										<li>
											<div class="wrap">
												<div class="radio radio-success">
												  <input type="radio" name="data[package_id]" id="select-package-id-<?php echo $data->package_id; ?>" value="<?php echo $data->package_id; ?>">
												  <label for="select-package-id-<?php echo $data->package_id; ?>">
													<div class="cover-img package-img" data-img="<?php echo $data->image; ?>"></div>
													<div class="label-wrap">
														<div class="title">
															<?php echo $data->title; ?>
														</div>
														<div class="description">
															<?php echo $data->description; ?>
														</div>
														<div class="price">
															<Strong>Price:</Strong> $<?php echo $data->price; ?>
														</div>
													</div>
												  </label>
												</div>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>					
							</div>
							<label for="data[package_id]" class="error m-b-0 m-t-10"></label>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<legend>General Info</legend>
						<hr class="m-t-0 m-b-10">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="first_name">First Name</label>
							<div class="controls">
								<input ng-model="first_name" required type="text" placeholder="Name" class="form-control" name="data[first_name]" value="" id="first_name">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="last_name">Last Name</label>
							<div class="controls">
								<input ng-model="last_name" required name="data[last_name]"   value="" type="text" placeholder="Last Name" class="form-control" id="last_name">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="email">Email</label>
							<div class="controls">
								<input ng-model="email" required name="data[email]"   value="" type="email" placeholder="Email" class="form-control" id="email">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default form-group-default-select2">
							<label>Gender</label>
							<select ng-model="gender" required name="data[gender]" class="select--no-search full-width" data-init-plugin="select2">
								<?php global $gGender;
									if(is_array($gGender) && !empty($gGender)) :
										foreach($gGender  as $iKey  => $gender): ?>
											<option  value='<?php echo $iKey; ?>'><?php echo $gender; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
<!--								<option value='male'>Male</option>
								<option value='female'>Female</option>-->
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="email">Password</label>
							<div class="controls">
								<input required name="data[password]"   value="" type="password" placeholder="Password" class="form-control" id="password">
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="email">Confirm Password</label>
							<div class="controls">
								<input required name="data[confirm_password]" value="" type="password" placeholder="Confirm Password" class="form-control" id="data[confirm_password]">
							</div>
						</div>
					</div>
				</div>
				
				
		<div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="logo">Profile Image:</label>
                    <div class="controls">
                         <input name="<?php echo MEDIA_FILE_UPLOAD_FIELD; ?>" type="file" class="form-control" id="profile_image">
                    </div>
                </div>
            </div>
        </div>



				<div id="mailingAddress">
					
					<div class="row">
						<div class="col-md-12">
							<legend>Mailing</legend>
							<hr class="m-t-0 m-b-10">
						</div>
					</div>
					

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-group-default">
								<label class="address_mailing">Address</label>
								<div class="controls">
									<textarea ng-model="mailing_address" required name="mailing[address]" value="" type="text" placeholder="Mailing Address" class="form-control h-90" id="address_mailing"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default form-group-default-select2">
								<label>Country</label>
								<select ng-model="mailing_country"  required name="mailing[country]" class="full-width" data-init-plugin="select2" id="country_mailing">
									<?php global $gCountries;
									if(is_array($gCountries) && !empty($gCountries)) :
										foreach($gCountries  as $iKey  => $country):  ?>
											<option value='<?php echo $country; ?>'><?php echo $country; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
								</select>
							</div>
							<div class="form-group form-group-default form-group-default-select2">
								<label>State</label>
								<select ng-model="mailing_state"  required name="mailing[state]" class="full-width" data-init-plugin="select2" id="state_mailing">
										<?php global $gStates;
									if(is_array($gStates) && !empty($gStates)) :
										foreach($gStates  as $iKey  => $state): ?>
											<option value='<?php echo $iKey; ?>'><?php echo $state; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">                
							<div class="form-group form-group-default">
								<label class="zip_code">Zip Code</label>
								<div class="controls">
									<input  ng-model="mailing_zip" required name="mailing[zip_code]"   value="" type="text" placeholder="Zip Code" class="form-control" id="zip_code_mailing">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default form-group-default-select2">
								<label>City</label>
								<select required name="mailing[city]" class="full-width" data-init-plugin="select2" id="city_mailing">
									<?php global $gCities;
									if(is_array($gCities) && !empty($gCities)) :
										foreach($gCities  as $iKey  => $city): ?>
											<option  value='<?php echo $iKey; ?>'><?php echo $city; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
								</select>
							</div>
						</div>
					</div>
				</div>

				<div id="billingAddress">

					<div class="row">
						<div class="col-md-12">
							<div class="title-with-checkbox">
								<legend>Billing</legend>
								<div class="checkbox check-success checkbox--inline">
								  <input name="data[same_as_billing]" type="checkbox" ng-checked="same_as_billing"  id="billingMailingAddressSame">
								  <label for="billingMailingAddressSame">Same as Mailing Address.</label>
								</div>
							</div>
							<hr class="m-t-0 m-b-10">
						</div>
					</div>

					<div class="billing-address-wrap" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label class="address_billing">Address</label>
									<div class="controls">
										<textarea ng-model="billing_address" required name="billing[address]" value="" type="text" placeholder="Billing Address" class="form-control h-90" id="address_billing" tabindex="-1"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default form-group-default-select2">
									<label>Country</label>
									<select ng-model="billing_country" required name="billing[country]" class="full-width" data-init-plugin="select2" id="country_billing" tabindex="-1">
										<?php global $gCountries;
									if(is_array($gCountries) && !empty($gCountries)) :
										foreach($gCountries  as $iKey  => $country):  ?>
											<option value='<?php echo $country; ?>'><?php echo $country; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
									</select>
								</div>
								<div class="form-group form-group-default form-group-default-select2">
									<label>State</label>
									<select ng-model="billing_state" required name="billing[state]" class="full-width" data-init-plugin="select2" id="state_billing" tabindex="-1">
											<?php global $gStates;
									if(is_array($gStates) && !empty($gStates)) :
										foreach($gStates  as $iKey  => $state): ?>
											<option value='<?php echo $iKey; ?>'><?php echo $state; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-group-default">
									<label class="zip_code">Zip Code</label>
									<div class="controls">
										<input ng-model="billing_zip" required name="billing[zip_code]" value="" type="text" placeholder="Zip Code" class="form-control" id="zip_code_billing" tabindex="-1">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default form-group-default-select2">
									<label>City</label>
									<select required name="billing[city]" class="full-width" data-init-plugin="select2" id="city_billing" tabindex="-1">
											
									<?php global $gCities;
									if(is_array($gCities) && !empty($gCities)) :
										foreach($gCities  as $iKey  => $city): ?>
											<option  value='<?php echo $iKey; ?>'><?php echo $city; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12 this-center">
						<!-- <div class="checkbox check-success">
						  <input type="checkbox" name="data[terms]" value="1" id="terms-conditions">
						  <label for="terms-conditions">I agree with <a href="<?php echo site_url(); ?>/terms" target="_blank">Terms & Conditions</a>.</label>
						</div>
						<div id="termsError"></div> -->
						<label for="terms-conditions">By clicking Register, you agree to our <a href="<?php echo site_url('terms'); ?>" target="_blank">Terms & Conditions</a>.</label>
					</div>
				</div>

				<div class="row mobile-m-0">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6"><button type="submit" class="btn btn-primary btn-block btn-cons m-t-10" onclick="">Register</button></div>
							<div class="col-md-3"></div>
						</div>
						<?php 
						if(!isUserLoggedIn())
						{
						?>
						<div class="text-center m-t-20 d-b">
							Already have an account? 
							<a class="m-l-3 small" href="<?php echo site_url(); ?>">Login.</a>                            
						</div>
						<?php 
						}
						?>
					</div>
				</div>
			</form>
			<!-- END Sign Up -->
			<?php 
			if(!isUserLoggedIn())
			{
			?>
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
			<?php 
			}
			?>
		</div>
	</div>
	<!-- END Login Right Container-->
</div>
<!-- END PAGE CONTAINER -->

<script>

function registerController($scope,$http)
{
    $scope.first_name = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['data']['first_name'] : '';  ?>'
    $scope.last_name = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['data']['last_name'] : '';  ?>'
    $scope.email = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['data']['email'] : '';  ?>'
    $scope.gender = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['data']['gender'] : 'male';  ?>'
    
    $scope.mailing_address = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['mailing']['address'] : '';  ?>'
    $scope.mailing_country = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['mailing']['country'] : 'United States';  ?>'
    $scope.mailing_state = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['mailing']['state'] : 'AL';  ?>'
    $scope.mailing_zip = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['mailing']['zip_code'] : '';  ?>'
    
    $scope.billing_address = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['billing']['address'] : '';  ?>'
    $scope.billing_country = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['billing']['country'] : 'United States';  ?>'
    $scope.billing_state = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['billing']['state'] : 'AL';  ?>'
    $scope.billing_zip = '<?php echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['billing']['zip_code'] : '';  ?>'
    
    $scope.same_as_billing =  '<?php echo (isset($aRegistrationInfo['data']['same_as_billing'])) ? $aRegistrationInfo['data']['same_as_billing'] : false;  ?>';
    
    
    //$scope.package_id = '<?php //echo (!empty($aRegistrationInfo)) ? $aRegistrationInfo['data']['package_id'] : '';  ?>'
    
	
    $scope.JsPromoCodePackages = function()
    {
    	var PromoCode = $("#promotion_code").val();

    	if(PromoCode){
			$http.post('<?php echo site_url('ajax/package/'); ?>', {call_from:'getPromoCodePackages', iPromotionCode:PromoCode, method:'getPromoCodePackages'}).
	        success(function(data, status, headers, config)
			{
				if(isEmpty(data)){
					if($(".promotion_code_error").html()){
						$('.promotion_code_error').animate({opacity:0},200, function(){
							$(".promotion_code_error").html('Promotion code is invalid!');
							$('.promotion_code_error').animate({opacity:1},200);
						});
					}else{
						$(".promotion_code_error").html('Promotion code is invalid!');
					}
				}else{
					$(".promotion_code_error").html('');
				}

				$scope.jsPromotionCodePackages = data;
			}).
	        error(function(data, status, headers, config)
	        {
	            console.log(data);
	        });
        }else{
        	$("#promotion_code").parent().parent().addClass('has-error');
        }
    };

	$scope.example = function(CampaignId)
    {
        var CampaignTitle   = $("#campaign_title_"+CampaignId).val();
        var CampaignDesc    = $("#campaign_desc_"+CampaignId).val();

        if(CampaignTitle && CampaignDesc)
        {
            $http.post('<?php echo site_url('ajax/campaign/'); ?>', {call_from:'UpdateCampaign',campaign_id:CampaignId,description:CampaignDesc,title:CampaignTitle,method:'updateCampaign'}).
            success(function(data, status, headers, config)
            {
                $(".camp_title_"+CampaignId).text(CampaignTitle);
                $(".camp_desc_"+CampaignId).text(CampaignDesc);
                $("#campaign_title_"+CampaignId).val(CampaignTitle);
                $("#campaign_desc_"+CampaignId).val(CampaignDesc);
                cancelEdit('edit-section-'+CampaignId);
            }).
            error(function(data, status, headers, config)
            {
                console.log(data);
            });
        }
        else
        {
            alert("Please fill the form correctly.");
        }
    };
    return false;
}


$(function(){

	// Submit Promotion Code when pressed enter from text field.
	$("#promotion_code").keyup(function(event){
	    if(event.keyCode == 13){
			event.preventDefault();
			JsPromoCodePackages();
	    }
	});

	var userRegisterValidateRules ={
	  rules: {
	  'data[password]': { 
		  required: true,
		  minlength: 8,
		  maxlength: 10,
		},
		'data[confirm_password]': { 
		  equalTo: "#password",
		  required: true,
		  minlength: 8,
		  maxlength: 10
	   },
	   'data[package_id]': {
		  required: true
	   }
	 },	
	// highlight: function(element) {
	//  	$(element).closest('.form-group').addClass('has-error');	 	
	// },
	// unhighlight: function(element) {		
	// 	$(element).closest('.form-group').removeClass('has-error');
	// },
	// errorElement: 'label',
	// errorClass: 'error',
	// errorPlacement: function(error, element) {
	// 	if (element.attr("name") == "data[package_id]" ) {
	// 		error.appendTo("#package_error");
	// 		// error.insertAfter(element.parent());
	// 	}else{
	// 		error.insertAfter(element);
	// 	}
	// }
	 
	 messages: {
	    'data[package_id]': {
	      required: "Please select a package.",
	    }
	  }
	};

	$('#user_register').validate(userRegisterValidateRules);

	/* ============================== */
	/* Mailing & Billing Address Same */

	// Monitor Input & Textarea
	$('#mailingAddress input, #mailingAddress textarea').on('input', function () {
		if($('#billingMailingAddressSame:checked').length > 0){
			var target = $(this).attr('name');
			target = target.substr(target.indexOf("[") + 1);
			$('#billingAddress [name="billing['+target+'"]').val($(this).val());
		}
	});

	// Monitor Select
	$('#mailingAddress select').select2().on("change", function(e) {
		if($('#billingMailingAddressSame:checked').length > 0){
			var target = $(this).attr('name');
			target = target.substr(target.indexOf("[") + 1);
			$('#billingAddress [name="billing['+target+'"]').select2("val", e.val);
		}
	});


	// Switching between same address or not.

	var tabindex = 1;
        
        toggleBillingMailingAddressTrigger();
        
	$('#billingMailingAddressSame').on('change', function () {
            toggleBillingMailingAddressTrigger();
	});
        
        function toggleBillingMailingAddressTrigger(){
            // Toggle Tabindex
		if(tabindex == 0){
			$('#billingAddress input, #billingAddress textarea, #billingAddress select').each(function () {
				$(this).attr('tabindex', -1);
			});
			tabindex = 1;
		}else{
			$('#billingAddress input, #billingAddress textarea, #billingAddress select').each(function () {
				$(this).removeAttr('tabindex');
			});
			tabindex = 0;
		}
		
		if($('#billingMailingAddressSame').prop( "checked" )){			
			$('#billingAddress .billing-address-wrap').stop().slideUp("slow", function () {
				$('#billingAddress .billing-address-wrap').addClass('disable');
			});
		}else{
			$('#billingAddress .billing-address-wrap').removeClass('disable');
			$('#billingAddress .billing-address-wrap').stop().slideDown("slow", function () {
			});
		}

		// Input Field
		$('#mailingAddress input').each(function () {
			var target = $(this).prop('name');
			target = target.substr(target.indexOf("[") + 1);
			$('#billingAddress [name="billing['+target+'"]').val($(this).val()).trigger('change');

			// To Validate
			if($('#billingAddress [name="billing['+target+'"]').val()!=''){
				$('#billingAddress [name="billing['+target+'"]').trigger('focus');
				$('#billingAddress [name="billing['+target+'"]').trigger('blur');
			}
		});

		// Textarea
		$('#mailingAddress textarea').each(function () {

			var target = $(this).prop('name');            
			target = target.substr(target.indexOf("[") + 1);
			$('#billingAddress [name="billing['+target+'"]').val($(this).val()).trigger('change');

			// To Validate
			if($('#billingAddress [name="billing['+target+'"]').val()!=''){
				$('#billingAddress [name="billing['+target+'"]').trigger('focus');
				$('#billingAddress [name="billing['+target+'"]').trigger('blur');
			}

			
		});

		//Select
		$('#mailingAddress select').each(function () {
			var target = $(this).attr('name');
			target = target.substr(target.indexOf("[") + 1);
			$('#billingAddress [name="billing['+target+'"]').select2("val", $(this).val());
		});
        }

	/* END - Mailing & Billing Address Same */
	/* ============================== */


	/* ============================== */
	/* Promotion */

	// Promotion Toggle.	
	var enterPromotion 	= $('#enterPromotion');
	var packageList 	= $('#packageList');

	enterPromotion.hide();

	$('#havePromotionCode').on('change', function () {
		switcher_NoPause(packageList);
		switcher_NoPause(enterPromotion);
	});

	/* END - Promotion */
	/* ============================== */

})
</script>
