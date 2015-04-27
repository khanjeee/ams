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
                        <select required name="data[flags]" class="select--no-search full-width" data-init-plugin="select2">
                            <option value='Important'>Important</option>
                                <option value='Very Important'>Very Important</option>
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
            
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-cons  m-btn-full" value="Update" onclick="">
                </div>    
            </div>  
        </div>
    </form>

    <!-- <form id="formID" enctype="multipart/form-data" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form">
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <label class="first_name">First Name</label>
                    <input id="first_name"  type="form-field text" placeholder="Name" class="validate[required] form-control" name="data[first_name]" value="<?php echo $Contact->first_name; ?>" id="first_name">
                </div>
            </div>
            
            
            <div class="row">    
                <div class="col-md-3">
                    <label class="last_name">Last Name</label>
                    <input name="data[last_name]"   value="<?php echo $Contact->last_name; ?>" type="text" placeholder="Last Name" class="form-control" id="last_name">
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-3">
                    <label class="last_name">Printed Name</label>
                    <input name="data[printed_name]"   value="<?php echo $Contact->printed_name; ?>" type="text" placeholder="Printed Name" class="form-control" id="last_name">
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-3">
                    <label class="last_name">Business Name</label>
                    <input  name="data[business_name]"   value="<?php echo $Contact->business_name; ?>" type="text" placeholder="Business Name" class="form-control" id="last_name">
                </div>
            </div>
            
            
             
            <div class="row">    
                <div class="col-md-3">
                    <label class="address_billing"> Address</label>
                    <textarea name="data[address]"  type="text"  class="validate[required] form-control"><?php echo $Contact->address; ?></textarea>
                </div>
            </div>
            
            
            <div class="row">    
                <div class="col-md-3">
                    <label class="email">Email</label>
                    <input  name="data[email]"   value="<?php echo $Contact->email; ?>" type="text" placeholder="email" class="validate[required,custom[email]] form-control" id="email">
                </div>
            </div>
            
           
              <div class="row">  
    
                <div class="col-md-2">
                    <div class="data">
                        <label>Country</label>
                        <div>
                                <select required name="data[country]" class="form-control">
                                    <?php foreach($aCountries as $country): ?>
                                     <option value='<?php echo $country['title']; ?>'><?php echo $country['title']; ?></option>   
                                    <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <div class="row">  
    
                <div class="col-md-2">
                    <div class="data">
                        <label>City</label>
                        <div>
                                <select required name="data[city]" class="form-control">
                                    <option value='New York'>New York</option>
                                    <option value='New Jersy'>New Jersy</option>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            
                
          
            <div class="row">  
    
                <div class="col-md-2">
                    <div class="data">
                        <label>State</label>
                        <div>
                                <select required name="data[state]" class="form-control">
                                    <option value='Alabama'>Alabama</option>
                                    <option value='Alaska'>Alaska</option>
                                    <option value='Arizona'>Arizona</option>
                                     
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            
            
             
            <div class="row">    
                <div class="col-md-3">
                    <label class="zip_code">Zip Code </label>
                    <input  name="data[zip_code]"   value="<?php echo $Contact->zip; ?>" type="text" placeholder="Zip Code" class="form-control" id="zip_code">
                </div>
            </div>
             
            
        
            <div class="row">    
                <div class="col-md-3">
                    <label>Dob</label>
                    <input id="datepicker" required name="data[dob]" value="<?php echo $Contact->dob; ?>" type="text" placeholder="D.o.b" class="form-control">
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-3">
                    <label>Phone</label>
                    <input  name="data[phone]"   value="<?php echo $Contact->phone; ?>" type="text" placeholder="Phone" class="form-control">
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-3">
                    <label>Website</label>
                    <input  name="data[website]"   value="<?php echo $Contact->website; ?>" type="text" placeholder="Website" class="form-control">
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-3">
                    <label>Notes</label>
                    <textarea  name="data[notes]" type="text" class="form-control" ><?php echo $Contact->notes; ?></textarea>
                </div>
            </div>
            
            <br>
    
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-success" value="update" onclick="">
                </div>    
            </div>
            
       </div>
    </form> -->

<!--Custom Javascript -->
<script>
    <?php  $date = strtotime($Contact->dob); $formatedDate = date('m/d/Y', $date); ?>
        
$( document ).ready(function() {
        $('.datepicker').datepicker('update', '<?php echo $formatedDate ?>');
});

</script>
<?php endif; ?>

    
<?php echo $custom_js;  ?>

