<!-- Code for Angular -->
<link rel="stylesheet" href="<?php echo getAssetsPath(); ?>css/angular/ng-tags-input.min.css" />
<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/angular/ng-tags-input.min.js"></script>
<!-- END - Code for Angular -->

<div id="response"></div>
	<?php echo $htmlErrorMessages; ?>
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

<?php if($aUserInfo) : ?>
<!-- START PAGE-CONTAINER -->
<div class="login-wrapper h-auto bg-grey"  ng-app="" ng-controller="registerController">
	<!-- START Login Right Container-->
	<div class="container">
		<div class="p-l-50 p-r-50 p-t-10 sm-p-l-15 sm-p-r-15 sm-p-t-40 m-auto">

			<h2 class="text-center">User Profile</h2>

			<div id="formErrorWrap">
				<button data-dismiss="alert" class="close"></button>
			</div>

			<!-- START Sign Up -->
			<form enctype="multipart/form-data" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="" id="user_register">

		
				
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
								<input required type="text" placeholder="Name" class="form-control" name="data[first_name]" value="<?php echo $aUserInfo['first_name']; ?>" id="first_name">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="last_name">Last Name</label>
							<div class="controls">
								<input required name="data[last_name]"   value="<?php echo $aUserInfo['last_name']; ?>" type="text" placeholder="Last Name" class="form-control" id="last_name">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="email">Email</label>
							<div class="controls">
								<input readonly="readonly" name="data[email]"   value="<?php echo $aUserInfo['email']; ?>" type="email" placeholder="Email" class="form-control" id="email">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group-default form-group-default-select2">
							<label>Gender</label>
							<select required name="data[gender]" class="select--no-search full-width" data-init-plugin="select2">
								
							<?php 
									
									 global $gGender;
									
									if(is_array($gGender) && !empty($gGender)) :
										foreach($gGender  as $iKey  => $gender): 
										
												  $htmlSelected  = '';
											   if($aUserInfo['gender']== $iKey) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $iKey; ?>'><?php echo $gender; ?></option>   
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
							<label class="old_password">Old Password</label>
							<div class="controls">
								<input  name="data[old_password]"   value="" type="password" placeholder="Old Password" class="form-control" id="old_password">
							</div>
						</div>
					</div>
					
					
					<div class="col-md-6">
						<div class="form-group form-group-default">
							<label class="email">Password</label>
							<div class="controls">
								<input  name="data[password]"   value="" type="password" placeholder="Password" class="form-control" id="">
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
				
	<?php if(!empty($aUserInfo['image']))  : ?>
				
				<div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                   
                    <div class="controls">
						
					
						<img src="<?php echo site_url(GET_USER_IMAGE_UPLOAD_PATH.$aUserInfo['image']); ?>" class="brand" width="50"  height="50">
                      
                    </div>
                </div>
            </div>
        </div>
	<?php  else : ?>
				
		<div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                   
                    <div class="controls">
						<img src="<?php echo site_url(DEFAULT_COMPANY_LOGO_PATH); ?>" class="brand" width="50"  height="50">
                      
                    </div>
                </div>
            </div>
        </div>
		
		
	
				
		<?php endif; ?>		
				


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
									<textarea required name="mailing[address]" value="" type="text" placeholder="Mailing Address" class="form-control h-90" id="address_mailing"><?php echo $aUserInfo['aAddress'][0]->address; ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
						 <div class="form-group form-group-default form-group-default-select2">
								<label>Country</label>
								<select required name="mailing[country]" class="select--no-search full-width" data-init-plugin="select2" id="country_mailing">
									<?php global $gCountries;
									if(is_array($gCountries) && !empty($gCountries)) :
										foreach($gCountries  as $iKey  => $country): 
												  $htmlSelected  = '';
											   if($aUserInfo['aAddress'][0]->country == $country) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $country; ?>'><?php echo $country; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
							</select>
						</div>
							
							
							
							<div class="form-group form-group-default form-group-default-select2">
								<label>State</label>
								<select required name="mailing[state]" class="select--no-search full-width" data-init-plugin="select2" id="state_mailing">
										<?php global $gStates;
									if(is_array($gStates) && !empty($gStates)) :
										foreach($gStates  as $iKey  => $state): 
												  $htmlSelected  = '';
											   if($aUserInfo['aAddress'][0]->state == $iKey) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $iKey; ?>'><?php echo $state; ?></option>   
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
									<input required name="mailing[zip_code]"   value="<?php echo $aUserInfo['aAddress'][0]->zip_code; ?>" type="text" placeholder="Zip Code" class="form-control" id="zip_code_mailing">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-group-default form-group-default-select2">
								<label>City</label>
								<select required name="mailing[city]" class="select--no-search full-width" data-init-plugin="select2" id="city_mailing">
									
									
									<?php global $gCities;
									if(is_array($gCities) && !empty($gCities)) :
										foreach($gCities  as $iKey  => $city): 
										
												  $htmlSelected  = '';
											   if($aUserInfo['aAddress'][0]->city == $iKey) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $iKey; ?>'><?php echo $city; ?></option>   
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
								<div class="checkbox check-success fl m-t-20">
								  <input type="checkbox"  value="1" id="billingMailingAddressSame">
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
										<textarea required name="billing[address]" value="" type="text" placeholder="Billing Address" class="form-control h-90" id="address_billing" tabindex="-1"><?php echo $aUserInfo['aAddress'][1]->address; ?></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default form-group-default-select2">
									<label>Country</label>
									<select required name="billing[country]" class="select--no-search full-width" data-init-plugin="select2" id="country_billing" tabindex="-1">
									<?php global $gCountries;
									if(is_array($gCountries) && !empty($gCountries)) :
										foreach($gCountries  as $iKey  => $country): 
												  $htmlSelected  = '';
											   if($aUserInfo['aAddress'][1]->country == $country) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $country; ?>'><?php echo $country; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
								</select>
								</div>
								<div class="form-group form-group-default form-group-default-select2">
									<label>State</label>
									<select required name="billing[state]" class="select--no-search full-width" data-init-plugin="select2" id="state_billing" tabindex="-1">
										<?php global $gStates;
									if(is_array($gStates) && !empty($gStates)) :
										foreach($gStates  as $iKey  => $state): 
												  $htmlSelected  = '';
											   if($aUserInfo['aAddress'][1]->state == $iKey) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $iKey; ?>'><?php echo $state; ?></option>   
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
										<input required name="billing[zip_code]" value="<?php echo $aUserInfo['aAddress'][1]->zip_code; ?>" type="text" placeholder="Zip Code" class="form-control" id="zip_code_billing" tabindex="-1">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-group-default form-group-default-select2">
									<label>City</label>
									<select required name="billing[city]" class="select--no-search full-width" data-init-plugin="select2" id="city_billing" tabindex="-1">
										<?php global $gCities;
									if(is_array($gCities) && !empty($gCities)) :
										foreach($gCities  as $iKey  => $city): 
												  $htmlSelected  = '';
											   if($aUserInfo['aAddress'][1]->city == $iKey) :
												  $htmlSelected = ' selected="selected" ';                           
											  endif ;?>
											<option <?php echo $htmlSelected; ?> value='<?php echo $iKey; ?>'><?php echo $city; ?></option>   
									<?php endforeach; ?>
									 <?php endif;  ?> 
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br>
			

				<div class="row mobile-m-0">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6"><button type="submit" class="btn btn-primary btn-block btn-cons m-t-10" onclick="">Update</button></div>
							<div class="col-md-3"></div>
						</div>
						
					</div>
				</div>
			</form>
			<!-- END Sign Up -->
			
		</div>
	</div>
	<!-- END Login Right Container-->
</div>

<?php else :  ?>

 <p><?php echo MSG_NO_RECORD_FOUND; ?></p>
<?php endif;  ?>
<!-- END PAGE CONTAINER -->

<script>




$(function(){

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

	$('#billingMailingAddressSame').on('change', function () {

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
	});

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
