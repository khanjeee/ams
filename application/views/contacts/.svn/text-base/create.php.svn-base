<?php //d($aCrmFields); ?>
<script>
$(function() {
    $('.datepicker__year').on('changeDate', function(ev) {
        var parent = $(this).closest('.form-group');
        if ($(this).valid()) {
            parent.removeClass('has-error');
            parent.next('.error').remove();
        }
    });
    $('.datepicker__year').on('hide', function(ev) {
        $('.datepicker__year').valid();
    });
});
</script>

<h1 class="heading-sty-1">Create Contact</h1>

<form id="formID" enctype="multipart/form-data" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1 form-validate-1">
    <div class="c-box">

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="first_name">First Name</label>
                    <div class="controls">
                        <input id="first_name" required type="text" placeholder="Name" class="validate[required] form-control" name="data[first_name]" value=""  >						
                    </div>
                </div>
            </div>    
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="last_name">Last Name</label>
                    <div class="controls">
                        <input name="data[last_name]"   value="" type="text" placeholder="Last Name" class="validate[required] form-control" id="last_name" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="last_name">Printed Name</label>
                    <div class="controls">
                        <input name="data[printed_name]" value="" type="text" placeholder="Printed Name" class="validate[required] form-control" id="last_name" required>
                    </div>
                </div>
            </div>    
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="last_name">Business Name</label>
                    <div class="controls">
                        <input name="data[business_name]"   value="" type="text" placeholder="Business Name" class="form-control" id="last_name">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="email">Email</label>
                    <div class="controls">
                        <input name="data[email]"   value="" type="email" placeholder="email" class="validate[required,custom[email]] form-control" id="email" required>
                    </div>
                </div>
            </div>    
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label>Website</label>
                    <input name="data[website]" value="" type="text" placeholder="Website" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="address_billing">Address</label>
                    <div class="controls">
                        <textarea  name="data[address]"   value="" type="text" placeholder="Address" class="validate[required] form-control" required></textarea>
                    </div>
                </div>
            </div>    
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Country</label>
                    <select name="data[country]" class="select--no-search full-width" data-init-plugin="select2" required>
                        <?php foreach($aCountries as $country): ?>
                        <option value='<?php echo $country['title']; ?>'><?php echo $country['title']; ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group form-group-default form-group-default-select2">
                    <label>State</label>
                    <select required name="data[state]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='Alabama'>Alabama</option>
                        <option value='Alaska'>Alaska</option>
                        <option value='Arizona'>Arizona</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="zip_code">Zip Code </label>
                    <input  name="data[zip_code]"   value="" type="text" placeholder="Zip Code" class="form-control" id="zip_code">
                </div>
            </div>    
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>City</label>
                    <select required name="data[city]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='New York'>New York</option>
                        <option value='New Jersy'>New Jersy</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label>Dob</label>
                    <input id="dob_datepicker" type="text" placeholder="D.o.b" class="validate[required] form-control has-datepicker datepicker__year" name="data[dob]" value="" required>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>    
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label>Phone</label>
                    <input  name="data[phone]"   value="" type="text" placeholder="Phone" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label>Notes</label>
                    <textarea  name="data[notes]"   value="" type="text" placeholder="Notes" class="form-control" ></textarea>
                </div>
            </div>  
			
			<?php if(is_array($aFlag) && !empty($aFlag)): ?>
		    <div class="col-md-6 col-lg-4">
				<div class="form-group form-group-default form-group-default-select2">
					  <label>Flag</label>
                    <select  name="data[flags]" class="select--no-search full-width" data-init-plugin="select2">
							<?php foreach($aFlag  as  $flag): ?>
      								<option  value='<?php echo $flag->flag_id; ?>'><?php echo $flag->title; ?></option>        								<?php endforeach; ?>
					</select>
				</div>
			<?php else : ?>	
			<div class="col-md-6 col-lg-4">
					 <div class="form-group form-group-default">
						   <label>Flag</label>
						   <a href="<?php echo site_url('flags/create'); ?>">Create a Flag</a>
					 </div>
			<?php endif;  ?>

		<div class="form-group form-group-default form-group-default-select2">
                    <label>List</label>
                    <select name="data[list]" class="full-width" data-init-plugin="select2" required>
                        <?php foreach($aList as $key => $list): ?>
                        <option value='<?php echo $list['list_id']; ?>'><?php echo $list['title']; ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
			</div>
           <br>             
        <?php if(!empty($aCrmFields))
            {
        foreach ($aCrmFields as $data)
            {
                if($data['field_type']== "textbox" )
                    { ?>
                    <div class="row">
        
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group form-group-default">
                                <label><?php echo $data['field_label']; ?></label>
                                <div class="controls">
                                    <input id="first_name" 
                                           type="text" 
                                           placeholder="Name" 
                                           class="validate[required] form-control" 
                                           name="custom[<?php echo $data['field_id']; ?>]" 
                                           required 
                                           value=""  >						
                                </div>
                            </div>
                        </div>    

                    </div>    
                    <?php 
                    }
                    else if($data['field_type']=="select")
                    {
                     $aOptions = explode(',', $data['field_default_value']);   
                        ?>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">    
                        <div class="form-group form-group-default form-group-default-select2">
                        <label><?php echo $data['field_label']; ?></label>
                        <select name="custom[<?php echo $data['field_id']; ?>]" class="full-width" data-init-plugin="select2" required>
                            <?php foreach($aOptions as $key => $value): ?>
                            <option value='<?php echo $value; ?>'><?php echo $value; ?></option>   
                            <?php endforeach; ?>
                        </select>
                        </div>
                        </div>
                    </div>
                    
                        
              <?php }     
            }
            ?>   
           
           
	
        <?php } ?>     

			<br>
                        
	<div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-cons  m-btn-full" value="Create" onclick="">
            </div>    
        </div>
        
   </div>
            
</form>

<!--javacript custom-->
<!-- Commenting custom js, it was stoping left menu from working properly ~ Imran -->
<?php echo $custom_js;  ?>