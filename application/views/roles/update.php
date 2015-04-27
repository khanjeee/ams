<h1 class="heading-sty-1">Edit Role</h1>
<?php if($aRole) : 
    $Role = $aRole[0];
?>

<form id="formID" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form">
    <div class="c-box">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label class="title">Title</label>
                    <div class="controls">
                        <input type="form-field text" placeholder="ROLE" class="validate[required] form-control" name="data[title]" value="<?php echo $Role->title; ?>" required>
                    </div>
                </div>
            </div>
        </div>
        
        <br>
        
        <div class="row">
            <div class="col-md-3">
                <input type="submit" class="btn btn-success" value="UPDATE" onclick="">
            </div>    
        </div>
   </div>
</form>

 <?php endif; ?>
 
<!--Custom Javascript -->
<?php //echo $custom_js;  ?> 

