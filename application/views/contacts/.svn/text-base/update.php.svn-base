<?php //debug($aCrmFieldsValues);
      //d($aCrmFields);
?>
<h1 class="heading-sty-1">Update Contact</h1>

<?php if($aContact) : 
    $Contact = $aContact[0];



?>

    <form id="formID" enctype="multipart/form-data" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1 form-validate-1">
        <div class="c-box">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label class="first_name">First Name</label>
                        <div class="controls">
                            <input type="form-field text" placeholder="Name" class="validate[required] form-control" name="data[first_name]" value="<?php echo $Contact->first_name; ?>" id="first_name" id="first_name" required>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label class="last_name">Last Name</label>
                        <div class="controls">
                            <input name="data[last_name]" value="<?php echo $Contact->last_name; ?>" type="text" placeholder="Last Name" class="validate[required] form-control" id="last_name" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label class="last_name">Printed Name</label>
                        <div class="controls">
                            <input name="data[printed_name]" value="<?php echo $Contact->printed_name; ?>" type="text" placeholder="Printed Name" class="validate[required] form-control" id="last_name" required>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label class="last_name">Business Name</label>
                        <div class="controls">
                            <input name="data[business_name]" value="<?php echo $Contact->business_name; ?>" type="text" placeholder="Business Name" class="form-control" id="last_name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label class="email">Email</label>
                        <div class="controls">
                            <input name="data[email]" value="<?php echo $Contact->email; ?>" type="email" placeholder="email" class="validate[required,custom[email]] form-control" id="email" required>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label>Website</label>
                        <input name="data[website]" value="<?php echo $Contact->website; ?>" type="text" placeholder="Website" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label class="address_billing">Address</label>
                        <div class="controls">
                            <textarea  name="data[address]"   value="" type="text" placeholder="Address" class="validate[required] form-control" required><?php echo $Contact->address; ?></textarea>
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
                        <input  name="data[zip_code]" value="<?php echo $Contact->zip; ?>" type="text" placeholder="Zip Code" class="form-control" id="zip_code">
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
                    <div class="form-group form-group-default is-readonly">
                        <label>Dob</label>
                        
                        <input  id="datepicker" name="data[dob]" type="text" placeholder="D.o.b" class="validate[required] form-control datepicker" required>
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>    
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label>Phone</label>
                        <input  name="data[phone]" value="<?php echo $Contact->phone; ?>" type="text" placeholder="Phone" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group form-group-default">
                        <label>Notes</label>
                        <textarea  name="data[notes]" type="text" placeholder="Notes" class="form-control" ><?php echo $Contact->notes; ?></textarea>
                    </div>
                </div>    
                <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Flag</label>
                    <select  name="data[flags]" class="select--no-search full-width" data-init-plugin="select2">
							<?php 
      						if(is_array($aFlag) && !empty($aFlag)) :
                                echo '<option>-- Select --</option>';
      							foreach($aFlag  as  $flag): 
									$htmlSelected  = '';
									if($Contact->flag_id == $flag->flag_id) :
									 $htmlSelected = 'selected="selected" ';                           
								   endif ;?>
								
      								<option <?php echo $htmlSelected; ?>  value='<?php echo $flag->flag_id; ?>'><?php echo $flag->title; ?></option>   
      						<?php endforeach; ?>
      						 <?php endif;  ?> 
					</select>
                </div>
            </div>
            </div>
			<div class="col-md-6 col-lg-4">
				<div class="form-group form-group-default form-group-default-select2">
                    <label>List</label>
                    <select name="data[list]" class="full-width" data-init-plugin="select2" required>
                        <?php foreach($aList as $key => $list): 
							$htmlSelected  = '';
							if($aSelectedList->list_id == $list['list_id']) :
							 $htmlSelected = 'selected="selected" ';                           
						   endif ;?>
						
                        <option <?php echo $htmlSelected; ?> value='<?php echo $list['list_id']; ?>'><?php echo $list['title']; ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
			</div>
            
            <br>           
            <?php if(!empty($aCrmFields))
            {
        foreach ($aCrmFields as $key=>$data)
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
										   <?php if(isset($aCrmFieldsValues[$key])) { ?>
                                           value="<?php echo ($data['field_id'] == $aCrmFieldsValues[$key]['field_id']) ? $aCrmFieldsValues[$key]['field_value'] : "" ; ?>"  >
										   <?php } ?>
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
                            <option
				<?php 
                                        foreach ($aCrmFieldsValues as $aData)
                                                {
                                                    if($aData['field_value'] == $value && $data['field_id']== $aData['field_id']  ) 
                                                    {
                                                        echo "selected='selected'" ;
                                                    }
                                                }
                                            //echo ($value == $aCrmFieldsValues[$key]['field_value']) ? "selected='selected'" : "" ; 
                                         
                                ?>
                                value='<?php echo $value; ?>'><?php echo $value; ?></option>   
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
                    <input type="submit" class="btn btn-success btn-cons  m-btn-full" value="Update" onclick="">
                </div>    
            </div>  
        </div>
    </form>

   
<!--Custom Javascript -->
<script>
    <?php  $date = strtotime($Contact->dob); $formatedDate = date('m/d/Y', $date); ?>
        
$( document ).ready(function() {
        $('.datepicker').datepicker('update', '<?php echo $formatedDate ?>');
});

</script>
<?php endif; ?>

    
<?php echo $custom_js;  ?>

