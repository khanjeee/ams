




<h1 class="heading-sty-1"><?php echo CRM; ?></h1>

<div class="c-box">
    <form  action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1">
        <div class="row">
			<div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Choose a field :</label>
                    <select id="metafields" name="data[metafields]" class="select--no-search full-width" data-init-plugin="select2" required onchange="changeMetaFields();">

					<option value=''>---Select---</option>
						<?php foreach ($aMetaFields as $sMetaField): ?>
	                        <option value='<?php echo $sMetaField['crm_meta_field_id']; ?>'><?php echo ucfirst($sMetaField['html_control_type']); ?></option>
						<?php endforeach; ?>
                    </select>
                </div>
            </div>
		</div>
		<div id="user_meta">
			<div class="row">
	            <div class="col-md-6 col-lg-4">
	                <div class="form-group form-group-default">
	                    <label id="label">Enter field name :</label>
	                    <input required type="text" id="txtbox" placeholder="e.g : Interests" class="form-control" name="data[label]"  value="" >
					 </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-md-6 col-lg-4" id="options">
	                <div class="form-group form-group-default">
	                    <label id="label">Provide Options :</label>
	                    <textarea class="form-control" placeholder="Option A, Option 2, Option 3, Option 4" name="data[options]" id="option"></textarea>
	                </div>
	            </div>
	        </div>
        </div>
        <div class="row">
             <div class="col-md-10">
                <input type="submit" class="btn btn-success tablet-m-t-10" value="Add Field" onclick="">
             </div>
        </div>
    </form>
</div>



<script>
$('#user_meta').hide();

function changeMetaFields()
{
	$('#user_meta').show();
	var metafields = $("#metafields option:selected").text();

	if (metafields == 'Textbox')
	{
		$('#label').text('Add Label');
		$('#options').hide();
		$("#option").prop('required',false);
		$("#option").val("");
		
	}
	else if (metafields == 'Select')
	{
		$('#label').text('Add Label');
		$('#options').show();
	}
	else if (metafields == '---Select---')
	{
		$('#user_meta').hide();
			
	}
}

</script>