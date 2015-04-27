<form action="<?php echo $sFormAction; ?>" method="post"   role="form">
    <div class="row">
        <div class="col-md-2">
            <h1 class="heading-sty-1">Imported Contacts</h1>
        </div>
        <div class="col-md-10">
            <div class="contact-search-n-actions-panel">
                 <a href="<?php echo site_url(); ?>contacts/import" class="btn btn-danger"><!-- <i class="fa m-r-10"></i>  -->
                     <span>Cancel</span>
                 </a>
                
                <input type="submit" name="continue_import" class="btn btn-success" value="CONTINUE" onclick="">
<!--                <input type="text" id="search-table" class="form-control pull-right search-field" placeholder="Search">-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive-from-start">
                <table class="table table-hover demo-table-search table-sty-1" id="tableWithSearch">
                  <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Printed Name</th>
                        <th>Business Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Country</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Phone</th>
                        <th>Website</th>
                        <th>Notes</th>
                        <th>Flag</th>
                    </tr>
                  </thead>
                  <tbody>       
                    <?php 
                        if($aContacts)
                        {                            
                            foreach($aContacts as $contacts)
                            {
                    ?>
                            <tr>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[0]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[1]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[2]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[3]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[4]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[5]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[6]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[7]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[8]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[9]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[10]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[11]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[12]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts[13]; ?></div></div></td>
                                <td><div class="td-wrap"><div class="td-wrap-inner">Important</div></div></td>
                             </tr>
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                            <!-- <tr>
                                <td colspan="14"><?php echo MSG_NO_RECORD_FOUND; ?></td>
                            </tr> -->
                            <?php
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>    