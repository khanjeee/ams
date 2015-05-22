<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 4/2/15
 * Time: 1:33 PM
 */

if($aPackages)
{
    $options = "<option value='0'>Select</option>";

    for($o=0; $o<count($aPackages);$o++ )
    {
        $sId        = $aPackages[$o]['package_id'];
        $sTitle     = $aPackages[$o]['title'];

        
      $options .="<option value='$sId'>$sTitle</option>";
    
        
    }
    
    ?>

<div class="row">
    <div class="col-md-12">
        <label class="status">Choose a Package:</label>
        <div class="form-group form-group-default">
            
            <select  required  name="package[package_id]"  ng-model="selected_package_id" class="full-width select--no-search">
                
                    <?php echo $options; ?>
            </select>
       </div>
        <label style='position:static !important' ng-show="error_package"  class="error r-25">Please Select Package</label>  
    </div>
</div>   








<?php

}
else
{
    ?>
    <div >No Packages found.<a href="<?php echo site_url('packages/create'); ?>">Create one from here.</div>
<?php
}

?>

