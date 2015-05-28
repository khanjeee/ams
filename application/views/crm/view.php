<?php 
#d($aCrm);
?> 
<div class="row">
    <div class="col-md-2">
        <h1 class="heading-sty-1"><?php  echo 'CRM'; ?></h1>
    </div>
    <div class="col-md-10">
        <div class="contact-search-n-actions-panel">
            <a href="<?php echo site_url(); ?>crm/create" class="btn btn-primary btn--create"><span><?php echo CRM; ?> + </span></a>
            <!-- <input type="text" id="search-table" class="form-control pull-right search-field" placeholder="Search"> -->
        </div>
    </div>
</div>

<?php  if($aCrm) { ?>

<form action="<?php echo $sFormAction; ?>" method="post" role="form">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive-from-start">
			
					     <table class="table table-hover demo-table-search table-sty-1" id="">
                    <thead>
                        <tr>
                            <th>Control Type</th>
                            <th>Control Label</th>
                            <th>Default Value</th>
							<th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  foreach($aCrm as $crm) {        
                                $EditUrl            =   $sEditAction.'/'.$crm['user_crm_meta_field_id'];
								$DeleteUrl          =   $sDeleteAction.'/'.$crm['user_crm_meta_field_id']; ?>
                            <tr>
                                <td><?php echo  ucfirst($crm['html_control_type']); ?></td>
                                <td><?php echo  ucfirst($crm['field_label']); ?></td>
                                <td><?php echo  ($crm['field_default_value'])? $crm['field_default_value']:' -- '; ?></td>
                                <td>
                                    <ul class="actions-sty-1 no-line-break">                                       
										 <li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li>
										<li><a class="fa remove"  onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $DeleteUrl; ?>');" href="#"></a></li>   
										
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>                        
                    </tbody>
                </table>			  
            </div>
        </div>
    </div>
    <div style="margin-left: 50%;"><?php echo $this->pagination->create_links(); ?></div> 
<?php 	} else { ?>
                            <div class="no_record"><p>There are no CRM, <a href="<?php echo site_url('crm/create'); ?>">Add a Crm Fields</a>.</p></div>
                       <?php
                        } 
                        ?>		
			