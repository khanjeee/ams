<h1 class="heading-sty-1">Edit Flag</h1>

<?php if($aFlags) : 
    $flag = $aFlags[0];
?>

<div class="c-box">
    <form id="formID" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label for="title">Title</label>
                    <input  id="title" type="text" placeholder="Title" class="validate[required] form-control" name="data[title]" value="<?php echo $flag->title; ?>" >
                </div>
            </div>
        </div>
       
        
       
       
        <div class="row">
            <div class="col-md-3">
                <input type="submit" class="btn btn-success m-t-20" value="UPDATE" onclick="">
            </div>    
        </div>
    </form>
</div>
<?php endif; ?>

