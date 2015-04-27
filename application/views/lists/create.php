<h1 class="heading-sty-1">Create Lists</h1>
<form id="formID" action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1">

    <div class="c-box">
        
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group form-group-default">
                        <label for="title">Title</label>
                        <input  id="title" type="text" placeholder="Title" class="validate[required] form-control" name="data[title]" value="" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group form-group-default">
                        <label for="description">Description</label>
                        <textarea id="description" required name="data[description]" value="" type="text" placeholder="Description" class="m-t-4 validate[required] form-control" ></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-success m-t-20" value="Create" onclick="">
                </div>    
            </div>
    </div>

</form>

<!--javacript custom-->
<?php //echo $custom_js;  ?> 


	





