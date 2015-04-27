
<div class="row">
    <div class="col-md-2">
        <h1 class="heading-sty-1"><?php  echo USERS; ?></h1>
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
        <div class="table-responsive-from-start">
            <table class="table table-hover demo-table-search table-sty-1" id="tableWithSearch">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>     
                <?php 

                    if($aUsers)
                    {
                      //  d($aUsers);
                        global $aUserStatus;
                        global $aRoles;

                        $this->load->helper('text');
                        $iTotalUsers = count($aUsers);


                        for($p=0; $p < $iTotalUsers; $p++)
                        {
                            $oUserInfo  =   $aUsers[$p];
                         //   $EditUrl        =   site_url('packages/save/'.$oUserInfo->package_id);
                    $DeleteUrl      =   $sDeleteAction.'/'.$oUserInfo->user_id;
                            
                ?>
                            <tr>
                                <!-- <td><?php echo $oUserInfo->user_id; ?></td> -->
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php if(array_key_exists($oUserInfo->role_id, $aRoles)){ echo $aRoles[$oUserInfo->role_id]; }else{ echo 'Undefined'; } ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $oUserInfo->first_name; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $oUserInfo->last_name; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $oUserInfo->email; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo ucfirst($oUserInfo->gender); ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo $aUserStatus[$oUserInfo->is_active]; ?></div></div></td>
                                <td>
                                    <ul class="actions-sty-1 no-line-break">
                                        <!-- <li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li> -->
                                        <li><a class="fa remove" onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $DeleteUrl; ?>');" href="#"></a></li>
                                    </ul>
                                </td>
                            </tr>

                        <?php
                        }
                    }
                    else
                    {
                        ?><!-- <tr>
                            <td colspan="9"><?php echo MSG_NO_RECORD_FOUND; ?></td>
                          </tr> --><?php
                    } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>