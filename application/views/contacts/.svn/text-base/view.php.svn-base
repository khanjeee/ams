<?php

if (isset($aMessages))
{
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
				
				
				<?php if(isset($aUserData->PackageModule) && !empty($aUserData->PackageModule)){?>
					 <a href="<?php echo site_url(); ?>crm/create" class="btn btn-primary btn--create"><span><?php echo CRM; ?> + </span></a>
				<?php } ?>
				<!--<input type="text" id="search-table" class="form-control pull-right search-field" placeholder="Search">-->
            </div>
        </div>
    </div>
    <div class="row">
			<?php if (is_array($aFlag) && !empty($aFlag)) { ?>
		<div class="col-md-5 col-lg-3">
			<div class="form-group">
				<label>Filter contacts by flags:</label>
				<select  name="data[flags]" class="select--no-search full-width" data-init-plugin="select2">
					<option selected="selected" value=''>-- Select --</option>
						<?php foreach ($aFlag as $flag): 
							 $htmlSelected           = '';
							if($flag->flag_id == $sQuery) 
							{
							   $htmlSelected = ' selected="selected" ';
							}
							
							?>
							<option  <?php echo $htmlSelected;  ?>  value='<?php echo $flag->flag_id; ?>'><?php echo $flag->title; ?></option>   
						<?php endforeach; ?>
					
				</select>
			</div>
		</div>
		
			<div class="col-md-7 col-lg-9">
		<button name="btnSubmit" type="submit" class="btn btn-success m-t-26 m-m-t-0">Filter</button>	
			<?php if ($bSearch) { ?>
					<button name="btnReset" type="submit" class="btn btn-danger m-t-26 m-m-t-0">Reset</button>
			<?php } ?>
		</div>
		<?php } ?> 
		
    </div>

</form>
<div class="row">
    <div class="col-md-12">

		<?php
		if ($aContacts) { ?>
			
			<div class="table-responsive-from-start">
			<?php	if ($bSearch) { ?>
							<hr>

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
										                        <input  id="title" type="text" placeholder="Title"  class="validate[required] form-control" name="data[title]" value="" >
										                    </div>
										                </div>
										            </div>
										            <div class="row">
										                <div class="col-md-12">
										                    <div class="form-group form-group-default">
										                        <label for="description">Description</label>
										                        <textarea id="description"  name="data[description]" value="" type="text" placeholder="Description" class="m-t-4 validate[required] form-control" ></textarea>
										                    </div>
										                </div>
										            </div>
<!--									            <input type="hidden" name="data[buttontype]" id="buttontype" />-->
										            <div class="row">
										                <div class="col-md-12">
													 <input type="submit" class="btn btn-success m-t-20" value="Create" id="createlist">
										                </div>    
										            </div>
										    </div>
<!--										</form>-->																            
									</div>
						          </div>
						        </div>
						        <!-- /.modal-content -->
						      </div>
						    </div>
						    <!-- /.modal-dialog -->

<!--							<form  action="<?php #echo site_url('contacts/contactassigntolist'); ?>" method="post" class="form-sty-1">-->
								<div class="row">
									<div class="col-md-6 col-lg-5">
										<div class="row">
											<div class="col-md-5 col-lg-5">
												<div class="form-group">
													<label>Select Contacts:</label>
													<a href="#" onclick="return selectAll('all','contacts');" 	class="btn btn-complete m-r-10"><?php echo 'All'; ?></a>
													<a href="#" onclick="return selectAll('none','contacts');" 	class="btn btn-complete m-r-10"> <?php  echo 'None'; ?></a>
												</div>
												
											</div>
											
											<a href="#" class="btn btn-primary m-t-26 m-m-t-10" id="createListModal" onclick="javascript:disableButton();">Create List</a>
											
<!--									List Drop down	
										<div class="col-md-7 col-lg-7">
												<div class="form-group">
													<label>Add contacts to list:</label>
													<select name="data[iListId]" class="full-width" data-init-plugin="select2" required id="listtag">
														<?php #foreach($aList as $key => $list): ?>
														<option value='<?php #echo $list['list_id']; ?>'><?php #echo $list['title']; ?></option>
														<?php #endforeach; ?>
													</select>
												</div>
											</div>

<input type="submit" class="btn btn-success m-t-26 m-m-t-0" value="Add contact to list" >
										<div class="txt-bw-btns">- OR -</div>
												end list dropdown
-->
										</div>
									</div>
									<div class="col-md-6 col-lg-7">
									
									</div>
								</div>
						
						   <?php }?>
					<div class="scroll-x">
						<table class="table table-hover demo-table-search table-sty-1" id="">
							<thead>
								<tr>
								<?php	if ($bSearch) { ?>	<th>List Option</th><?php }?>
									<th>Name </th>
									<!--<th>Last Name</th>-->
									<!--<th>Printed Name</th>
									<th>Business Name</th>
									<th>Address</th>-->
									<!-- <th>City</th>
									<th>State</th>
									<th>Zip</th>
									<th>Country</th> -->
									<th>Email</th>
									<!--<th>DOB</th>
									<th>Phone</th>
									<th>Website</th>-->
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
								$DeleteUrl = $sDeleteAction . '/' . $contacts->contact_id; ?>
								<tr>
								<?php	if ($bSearch) { ?>
									<td>
										<div class="checkbox ">
					                      <input type="checkbox" name="contacts[]" checked="checked"  value="<?php echo $contacts->contact_id; ?>" class="contacts" id="checkbox-<?php echo $contacts->contact_id; ?>">
					                      <label for="checkbox-<?php echo $contacts->contact_id; ?>">&nbsp;</label>
					                    </div>
									</td>
								<?php } ?>
								
			<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->first_name . ' '.$contacts->last_name; ?>   </div></div></td>

           <!--
            <td><div class="td-wrap"><div class="td-wrap-inner"><?php /*echo $contacts->printed_name; */?> </div></div></td>
			<td><div class="td-wrap"><div class="td-wrap-inner"><?php /*echo $contacts->business_name; */?></div></div></td>
			<td><div class="td-wrap"><div class="td-wrap-inner"><?php /*echo $contacts->address; */?>, <?php /*echo $contacts->city; */?>, <?php /*echo $contacts->state; */?>, <?php /*echo $contacts->country; */?> - <?php /*echo $contacts->zip; */?></div></div></td>
-->

			<td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $contacts->email; ?>        </div></div></td>

<!--                                    -->
<!--			<td><div class="td-wrap"><div class="td-wrap-inner">--><?php //echo $contacts->dob; ?><!--          </div></div></td>-->
<!--			<td><div class="td-wrap"><div class="td-wrap-inner">--><?php //echo $contacts->phone; ?><!--        </div></div></td>-->
<!--			<td><div class="td-wrap"><div class="td-wrap-inner">--><?php //echo $contacts->website; ?><!--      </div></div></td>-->
<!--                                    -->

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
				</div><!-- /.scroll-x -->
				</form>
			</div>
			<?php
		} else {
			?>
			<div class="no_record"><p>There are no contacts in your contact list, <a href="<?php echo site_url('contacts/import'); ?>">Import Contacts</a>.</p></div>
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

	</form>

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

$.ready(function(){
	function disableButton(){
		$("#createlist").attr('disabled','disabled');
	}	
});

</script>