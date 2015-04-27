<?php if(isset($aMessages))
    {
     echo getFormValidationSuccessMessage($aMessages);
    }
    
?>

<!-- <form action="<?php echo $sFormAction; ?>" method="post" role="form" class="form-sty-1"> -->
    <div class="row">
        <div class="col-md-2">
            <h1 class="heading-sty-1">List Contacts</h1>
        </div>
        <div class="col-md-10">
            <div class="contact-search-n-actions-panel">
                <!-- <a href="<?php echo site_url(); ?>contacts/import" class="btn btn-primary btn--import"><i class="fa m-r-10"></i> <span>Add</span></a> -->
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                        if($aLists)
                        {
                            $this->load->helper('text');
                            
                            foreach($aLists as $contacts)
                            {
                                
                                $EditUrl        =   $sEditAction.'/'.$contacts->contact_id;
                                $DeleteUrl      =   $sDeleteAction.'/'.$contacts->contact_id;
                                
                        ?>
                            <tr>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->first_name; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->last_name; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->printed_name; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->business_name; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->address; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->city; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->state; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->zip; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->country; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->email; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->dob; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->phone; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  $contacts->website; ?></div></div></td>
                                    <td><div class="td-wrap"><div class="td-wrap-inner"><?php echo  word_limiter($contacts->notes,4); ?></div></div></td>
                                    <td>
                                        <ul class="actions-sty-1 no-line-break">
                                            <li><a class="fa" href="<?php echo $EditUrl; ?>"></a></li>
                                            <li><a class="fa remove" onclick="return confirmDelete('<?php echo $sCallFrom; ?>','<?php echo $DeleteUrl; ?>');" href="#"></a></li>
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
                                <td colspan="15"><?php echo MSG_NO_RECORD_FOUND; ?></td>
                            </tr> --><?php
                        } 
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

<!-- </form> -->