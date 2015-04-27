<?php if(isset($aMessages))
    {
     echo getFormValidationSuccessMessage($aMessages);
    }
    
?> 

<div class="row">
    <div class="col-md-2">
        <h1 class="heading-sty-1"><?php  echo ROLES; ?></h1>
    </div>
    <div class="col-md-10">
        <div class="contact-search-n-actions-panel">
            <!-- <a href="<?php echo site_url(); ?>contacts/import" class="btn btn-primary btn--import"><i class="fa m-r-10"></i> <span>Import</span></a>
            <a href="<?php echo site_url(); ?>contacts/create" class="btn btn-primary btn--create"><i class="fa m-r-10"></i> <span>Create</span></a> -->
            <input type="text" id="search-table" class="form-control pull-right search-field" placeholder="Search">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="<?php echo $sFormAction; ?>" method="post" role="form">
            <div class="table-responsive-from-start">
                <table class="table table-hover demo-table-search table-sty-1" id="tableWithSearch">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if($aRoles)
                        {
                            foreach($aRoles as $role)
                            {
                                
                                $EditUrl        =   $sEditAction.'/'.$role->role_id;
                                $DeleteUrl      =   $sDeleteAction.'/'.$role->role_id;

                    ?>
                            <tr>
                                    <!-- <td><?php echo  $role->role_id; ?></td> -->
                                    <td><?php echo  $role->title; ?></td>
                                    <td>
                                        <ul class="actions-sty-1 no-line-break">                                            
                                            <li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li>
                                            <?php
                                            if($role->role_id > 1)
                                            {
                                                ?>
                                                <li><a class="fa remove" onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $DeleteUrl; ?>');" href="#"></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </td>
                             </tr>

                            <?php
                            }
                        }
                        else
                        {
                    ?>
                        <!-- <tr>
                            <td colspan="2"><?php echo MSG_NO_RECORD_FOUND; ?></td>
                          </tr> -->
                    <?php 
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
        </form>
        
    </div>
</div>