<?php if(isset($aMessages))
    {
     echo getFormValidationSuccessMessage($aMessages);
    } 
#d($aLists);
?> 
<div class="row">
    <div class="col-md-2">
        <h1 class="heading-sty-1"><?php  echo FLAGS; ?></h1>
    </div>
    <div class="col-md-10">
        <div class="contact-search-n-actions-panel">
            <a href="<?php echo site_url(); ?>flags/create" class="btn btn-primary btn--create"><i class="fa m-r-10"></i> <span>Create</span></a>
            <!-- <input type="text" id="search-table" class="form-control pull-right search-field" placeholder="Search"> -->
        </div>
    </div>
</div>

<?php  if($aFlags) { ?>

<form action="<?php echo $sFormAction; ?>" method="post" role="form">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive-from-start">
			
					     <table class="table table-hover demo-table-search table-sty-1" id="">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                       
						   foreach($aFlags as $flag)
                           {        
                                $EditUrl            =   $sEditAction.'/'.$flag->flag_id;
								$DeleteUrl          =   $sDeleteAction.'/'.$flag->flag_id;
                                ?>
                            <tr>
                                <td><?php echo  $flag->title; ?></td>
                                <td><?php echo  displayDateTime($flag->created_on); ?></td>
                                <td>
                                    <ul class="actions-sty-1 no-line-break">
                                       
                                     
                                       
										 <li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li>
										<li><a class="fa remove"  onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $DeleteUrl; ?>');" href="#"></a></li>   
										
                                    </ul>
                                </td>
                            </tr>
                            <?php
                            }?>
                        
                    </tbody>
                </table>
			  
            </div>
        </div>
    </div>
    <div style="margin-left: 50%;"><?php echo $this->pagination->create_links(); ?></div> 
<?php 	}
                        else
                        { ?>
                            <div class="no_record"><p>There are no Flags in your flag list, <a href="<?php echo site_url('flags/create'); ?>">Create a Flag</a>.</p></div>
                       <?php
                        } 
                        ?>		
			