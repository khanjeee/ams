<h1 class="heading-sty-1">Edit Lists</h1>

<?php if($aList) : 
    $list = $aList[0];
?>

<div class="c-box">
    <form id="formID" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form">
        <!-- Commenting this section and adding the same form from create list as they look similar - Imran -->
        <!-- <div class="row">
            <div class="col-md-3">
                <label>Title</label>
                <input type="text" placeholder="ROLE" class="validate[required] form-control" name="data[title]"                                                        value="<?php echo $list->title; ?>" >
            </div>
        </div> 
        
        <div class="row">
            <div class="col-md-3">
                <label>Description</label>
                <textarea required name="data[description]" class="validate[required] form-control"><?php echo $list->description; ?></textarea>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <label>Flags</label>
                    <div>
                            <select required name="data[flags]" class="form-control">
                                <option value='Important'>Important</option>
                                <option value='Very Important'>Very Important</option>
                            </select>
                    </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <input type="submit" class="btn btn-success" value="UPDATE" onclick="">
            </div>    
        </div> -->

        <div class="row">
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label for="title">Title</label>
                    <input  id="title" type="text" placeholder="Title" class="validate[required] form-control" name="data[title]" value="<?php echo $list->title; ?>" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label for="description">Description</label>
                    <textarea id="description" required name="data[description]" value="" type="text" placeholder="Description" class="m-t-4 validate[required] form-control" ><?php echo $list->description; ?></textarea>
                </div>
            </div>
        </div>
        
        <!-- <div class="row">
            <div class="col-md-3">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Flags</label>
                    <select required name="data[flags]" class="select--no-search full-width" data-init-plugin="select2">
                        <option value='Important'>Important</option>
                        <option value='Very Important'>Very Important</option>
                    </select>
                </div>
            </div>
        </div> -->
        
        <div class="row">
            <div class="col-md-3">
                <input type="submit" class="btn btn-success m-t-20" value="UPDATE" onclick="">
            </div>    
        </div>
    </form>
</div>

<?php endif; ?>

<!--Custom Javascript -->
<?php //echo $custom_js;  ?> 

