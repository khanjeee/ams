

<?php  #d($aCrm);die; ?>

<h1 class="heading-sty-1"><?php echo UPDATE_CRM; ?></h1>

<div class="c-box">
    <form  action="<?php echo $sFormAction; ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1">
        <div class="row">
			<div class="col-md-6 col-lg-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label>Choose a field :</label>
                    <select id="metafields" name="data[metafields]" class="select--no-search full-width" data-init-plugin="select2" required onchange="changeMetaFields();">

					<option value=''>---Select---</option>
						<?php foreach ($aMetaFields as $sMetaField): 
										$htmlSelected  = '';
									if($sMetaField['crm_meta_field_id'] == $aCrm['crm_meta_field_id']) :
									 $htmlSelected = 'selected="selected" ';                           
								   endif ;?>
	                        <option <?php echo $htmlSelected; ?> value='<?php echo $sMetaField['crm_meta_field_id']; ?>'><?php echo ucfirst($sMetaField['html_control_type']); ?></option>
						<?php endforeach; ?>
                    </select>
                </div>
            </div>
			
			<div class="row" id="user_meta">
                <div class="col-md-3">
                    <div class="form-group form-group-default">
                        <label id="label">Enter field name :</label>
                        <input required type="text" id="txtbox" placeholder="Add Value" class="form-control" name="data[label]"  value="<?php echo $aCrm['field_label']; ?>" >
					 </div>
                </div>
				<?php # if($aCrm['crm_meta_field_id'] == CRM_DROPDOWN) : ?>	
                <div class="row">
                    <div class="col-md-3" id="options">
                        <div class="form-group form-group-default">
                            <label id="label">Provide Options :</label>
                            <textarea class="form-control" placeholder="Option A, Option 2, Option 3, Option 4" name="data[options]" id="option"><?php echo $aCrm['field_default_value']; ?></textarea>
                        </div>
                    </div>
                </div>
				<?php #endif; ?>
				
            </div>
            <div class="row">
                 <div class="col-md-10">
                    <input type="submit" class="btn btn-success tablet-m-t-10" value="Update Field" onclick="">
                 </div>
            </div>
		</div>
		
		
    </form>
</div>



<script>
	
	
	// $('#user_meta').hide();

	function changeMetaFields()
	{
		$('#user_meta').show();
		var metafields = $("#metafields option:selected").text();
		//console.log(metafields);
		if (metafields == 'Textbox')
		{
			$('#label').text('Add Label');
			$('#options').hide().attr('disable',true);
			$('#option').val("");
		}
		else if (metafields == 'Select')
		{
			$('#label').text('Add Default Value');
			$('#options').show().attr('disable',false);
		}
		else if (metafields == '---Select---')
		{
			$('#user_meta').hide();
		}
	}

$(document).ready(function (){
	changeMetaFields();
	
});

</script>