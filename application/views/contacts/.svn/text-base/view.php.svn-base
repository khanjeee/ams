<?php
if (isset($aMessages)) {
	echo getFormValidationSuccessMessage($aMessages);
}
?>

<form action="<?php echo $sFormAction; ?>" method="post"   role="form" class="form-sty-1">
    <div class="row">
        <div class="col-md-2">
            <h1 class="heading-sty-1"><?php echo CONTACTS; ?></h1>
        </div>
        <div class="col-md-10">
            <div class="contact-search-n-actions-panel">
                <a href="<?php echo site_url(); ?>contacts/import" class="btn btn-primary btn--import"><i class="fa m-r-10"></i> <span>Import</span></a>
                <a href="<?php echo site_url(); ?>contacts/create" class="btn btn-primary btn--create"><i class="fa m-r-10"></i> <span>Create</span></a>
<!--                <input type="text" id="search-table" class="form-control pull-right search-field" placeholder="Search">-->
				<div class="col-md-6 col-lg-4">
					<div class="form-group form-group-default form-group-default-select2">
						<label>Search by Flag</label>
						<select required name="data[flags]" class="select--no-search full-width" data-init-plugin="select2">
							<?php if (is_array($aFlag) && !empty($aFlag)) :
								foreach ($aFlag as $flag):
									?>
									<option  value='<?php echo $flag->flag_id; ?>'><?php echo $flag->title; ?></option>   
								<?php endforeach; ?>
<?php endif; ?> 
						</select>
					</div>
					<button name="btnSubmit" type="submit" class="btn btn-success">Search</button>
					<?php
					if ($bSearch) {
						?>
						<button name="btnReset" type="submit" class="btn btn-danger">Reset</button>
						<?php }
					?>
				</div>

            </div>
        </div>

    </div>

</form>

<div class="row">
    <div class="col-md-12">

		<?php
		if ($aContacts) {
			?>

			<div class="table-responsive-from-start">
			<?php	if ($bSearch) { ?>
						<p class="select_box">Select
							   <a href="#" onclick="return selectAll('all','contacts');"><?php echo 'All'; ?></a> |
							   <a href="#" onclick="return selectAll('none','contacts');"> <?php  echo 'None'; ?></a>
						   </p>
					  		 <a href="#" class="btn btn-primary" id="createListModal">Create List</a>
					       <!-- Modal -->
						    <div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
						      <div class="modal-dialog ">
						        <div class="modal-content-wrapper">
						          <div class="modal-content">
						            <div class="modal-header clearfix text-left">
						              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
						              </button>
						              <h1 class="heading-sty-1">Create Lists</h1>
						            </div>
						            <div class="modal-body">
										<form id="formID" action="<?php echo site_url('contacts/createlist'); ?>" method="post" accept-charset="utf-8"  role="form" class="form-sty-1">

										    <div class="">
										        
										            <div class="row">
										                <div class="col-md-12">
										                    <div class="form-group form-group-default">
										                        <label for="title">Title</label>
										                        <input  id="title" type="text" placeholder="Title" class="validate[required] form-control" name="data[title]" value="" >
										                    </div>
										                </div>
										            </div>
										            <div class="row">
										                <div class="col-md-12">
										                    <div class="form-group form-group-default">
										                        <label for="description">Description</label>
										                        <textarea id="description" required name="data[description]" value="" type="text" placeholder="Description" class="m-t-4 validate[required] form-control" ></textarea>
										                    </div>
										                </div>
										            </div>
										            
										            <div class="row">
										                <div class="col-md-12">
										                    <input type="submit" class="btn btn-success m-t-20" value="Create" onclick="">
										                </div>    
										            </div>
										    </div>

										</form>
						            </div>
						          </div>
						        </div>
						        <!-- /.modal-content -->
						      </div>
						    </div>
						    <!-- /.modal-dialog -->
						
						   <?php }?>
							<div class="scroll-x">
					<table class="table table-hover demo-table-search table-sty-1" id="">
						<thead>
							<tr>
							<?php	if ($bSearch) { ?>	<th>List Option</th><?php }?>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Printed Name</th>
								<th>Business Name</th>
								<th>Address</th>
								<!-- <th>City</th>
								<th>State</th>
								<th>Zip</th>
								<th>Country</th> -->
								<th>Email</th>
								<th>DOB</th>
								<th>Phone</th>
								<th>Website</th>
								<th>Notes</th>
								<th>Flag</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$this->load->helper('text');

							foreach ($aContacts as $contacts) {

								$EditUrl = $sEditAction . '/' . $contacts->contact_id;
								$DeleteUrl = $sDeleteAction . '/' . $contacts->contact_id;
								?>
								<tr>
									<?php	if ($bSearch) { ?>
									<td><input  type="checkbox" name="contacts[]" checked="checked" value="<?php echo $contacts->contact_id; ?>" class="contacts" id="checkbox-<?php echo $contacts->contact_id; ?>"></td>
					<?php }?>
									
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->first_name; ?>   </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->last_name; ?>    </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->printed_name; ?> </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->business_name; ?></div></div></td>

									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->address; ?>, <?php echo $contacts->city; ?>, <?php echo $contacts->state; ?>, <?php echo $contacts->country; ?> - <?php echo $contacts->zip; ?></div></div></td>

									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->email; ?>        </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->dob; ?>          </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->phone; ?>        </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->website; ?>      </div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo word_limiter($contacts->notes, 4); ?></div></div></td>
									<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo getFlag($contacts->flag_id); ?>      </div></div></td>
									<td>
										<ul class="actions-sty-1 no-line-break">
											<li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li>
											<li><a class="fa remove" onclick="return confirmDelete('<?php echo $sCallFrom; ?>', '<?php echo $DeleteUrl; ?>');" href="#"></a></li>
										</ul>
									</td>
								</tr>

								<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="no_record"><p>There are no contacts in your contact list, <a href="<?php echo site_url('contacts/import'); ?>">Add Contacts</a>.</p></div>
			<?php
		}
		?>
    </div>
</div>
<!-- 
 <ul class="contacts-list">
<?php
if ($aContacts) {
	$this->load->helper('text');

	foreach ($aContacts as $contacts) {

		$EditUrl = $sEditAction . '/' . $contacts->contact_id;
		$DeleteUrl = $sDeleteAction . '/' . $contacts->contact_id;
		?>
					 <li>
						 <div class="limit-it">
							 <div class="single-line">
								 <div class="data prominent">
									 <label>First Name</label>
									 <span><?php echo $contacts->first_name; ?></span>
								 </div>
								 <div class="data prominent">
									 <label>Last Name</label>
									 <span><?php echo $contacts->last_name; ?></span>
								 </div>
							 </div>
							 <div class="data">
								 <label>Printed Name</label>
								 <span><?php echo $contacts->printed_name; ?></span>
							 </div>
							 <div class="data">
								 <label>Business Name</label>
								 <span><?php echo $contacts->business_name; ?></span>
							 </div>
							 <div class="data">
								 <label>Address</label>
								 <span><?php echo $contacts->address; ?></span>
							 </div>
							 <div class="single-line">
								 <div class="data">
									 <label>City</label>
									 <span><?php echo $contacts->city; ?></span>
								 </div>
								 <div class="data">
									 <label>Country</label>
									 <span><?php echo $contacts->country; ?></span>
								 </div>
							 </div>
							 <div class="t-layout">
								 <div class="t-row">
									 <div class="t-col">
										 <div class="data">
											 <label>State</label>
											 <span><?php echo $contacts->state; ?></span>
										 </div>
									 </div>
									 <div class="t-col">
										 <div class="data">
											 <label>Zip</label>
											 <span><?php echo $contacts->zip; ?></span>
										 </div>                        
									 </div>
								 </div>
							 </div>
							 <div class="data">
								 <label>Email</label>
								 <span><?php echo $contacts->email; ?></span>
							 </div>
							 <div class="data">
								 <label>DOB</label>
								 <span><?php echo displayDate($contacts->dob); ?></span>
							 </div>
							 <div class="data">
								 <label>Phone</label>
								 <span><?php echo $contacts->phone; ?></span>
							 </div>
							 <div class="data">
								 <label>Website</label>
								 <span><?php echo $contacts->website; ?></span>
							 </div>
							 <div class="data">
								 <label>Notes</label>
								 <span><?php echo word_limiter($contacts->notes, 4); ?></span>
							 </div>
							 <div class="data">
								 <label>Flag</label>
								 <span>[Important]</span>
							 </div>
							 <ul class="actions-sty-1 no-line-break">
								 <li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li>
								 <li><a class="fa remove" onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $DeleteUrl; ?>');" href="#"></a></li>
							 </ul>
						 </div>
					 </li>

		<?php
	}
	?>
		 </ul>
	<?php
} else {
	?>

		 <div class="no_record"><p>There are no contacts in your contact list, <a href="<?php echo site_url('contacts/import'); ?>">Add Contacts</a>.</p></div>

	<?php
}
?>
-->



<div style="margin-left: 50%;"><?php echo $this->pagination->create_links(); ?></div>


<script>
$('#createListModal').click(function() {
	var size = $('input[name=slideup_toggler]:checked').val()
	var modalElem = $('#modalSlideUp');
	if (size == "mini") {
		$('#modalSlideUpSmall').modal('show')
	} else {
		$('#modalSlideUp').modal('show')
		if (size == "default") {
			modalElem.children('.modal-dialog').removeClass('modal-lg');
		} else if (size == "full") {
			modalElem.children('.modal-dialog').addClass('modal-lg');
		}
	}
});
</script>