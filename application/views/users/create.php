
<h1 class="heading-sty-1">Add User</h1>

<form enctype="multipart/form-data" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1 form-validate-1">
   <div class="c-box">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="first_name">First Name</label>
                    <div class="controls">
                        <input type="form-field text" placeholder="Name" class="form-control" name="data[first_name]" value="" id="first_name" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="last_name">Last Name</label>
                    <div class="controls">
                        <input required name="data[last_name]"   value="" type="text" placeholder="Last Name" class="form-control" id="last_name">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="email">Email</label>
                    <div class="controls">
                        <input required name="data[email]"   value="" type="email" placeholder="email" class="form-control" id="email">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="email">Password</label>
                    <div class="controls">
                        <input required name="data[password]"   value="" type="password" placeholder="email" class="form-control" id="email">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Gender</label>
                    <select required name="data[gender]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='male'>Male</option>
                        <option value='female'>Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4"></div>
        </div>
        
        <hr class="m-b-0">

        <div class="row">
            <div class="col-md-12">
                <h4>Mailing</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="address_billing"> Address</label>
                    <div class="controls">
                        <textarea required name="mailing[address]"   value="" type="text" placeholder="Mailing Address" class="form-control" id="mailing_address"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Country</label>
                    <select required name="mailing[country]" class="select--no-search full-width" data-init-plugin="select2">
                        <?php foreach($aCountries as $country): ?>
                         <option value='<?php echo $country['title']; ?>'><?php echo $country['title']; ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>City</label>
                    <select required name="mailing[city]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='New York'>New York</option>
                        <option value='New Jersy'>New Jersy</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>State</label>
                    <select required name="mailing[state]" class="select--no-search full-width" data-init-plugin="select2">
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
                    <div class="controls">
                        <input required name="mailing[zip_code]" value="" type="text" placeholder="Zip Code" class="form-control" id="zip_code">
                    </div>
                </div>                
            </div>
            <div class="col-md-6 col-lg-4"></div>
        </div>
        
        <hr class="m-b-0">

        <div class="row">
            <div class="col-md-12">
                <h4>Billing</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>City</label>
                    <select required name="mailing[city]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='New York'>New York</option>
                        <option value='New Jersy'>New Jersy</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>State</label>
                    <select required name="mailing[state]" class="select--no-search full-width" data-init-plugin="select2">
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
                    <label class="address_billing">Address</label>
                    <div class="controls">
                        <textarea required name="billing[address]"   value="" type="text" placeholder="Billing Address" class="form-control" id="address_billing"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Country</label>
                    <select required name="billing[country]" class="select--no-search full-width" data-init-plugin="select2">
                        <?php foreach($aCountries as $country): ?>
                         <option value='<?php echo $country['title']; ?>'><?php echo $country['title']; ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>City</label>
                    <select required name="billing[city]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='New York'>New York</option>
                        <option value='New Jersy'>New Jersy</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>State</label>
                    <select required name="billing[state]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='Alabama'>Alabama</option>
                        <option value='Alaska'>Alaska</option>
                        <option value='Arizona'>Arizona</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label class="zip_code">Zip Code </label>
                    <select required name="billing[city]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='New York'>New York</option>
                        <option value='New Jersy'>New Jersy</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default">
                    <label class="promotion_code">Promotion Code</label>
                    <div class="controls">
                        <input required name="data[promotion_code]" value="" type="text" placeholder="Promotion Code" class="form-control" id="promotion_code">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Roles</label>
                    <select required name="data[role_id]" class="select--no-search full-width" data-init-plugin="select2">
                        <?php foreach($aRoles as $role): ?>
                         <option value='<?php echo $role['role_id']; ?>'><?php echo $role['title']; ?></option>   
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Status</label>
                    <select required name="data[is_active]" class="select--no-search full-width" data-init-plugin="select2">
                       <option value='0'>In Active</option>
                       <option value='1'>Active</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-success m-t-20 m-m-t-0 btn-cons m-w-100-p" value="Save" onclick="">
            </div>
        </div>
   </div>
</form>