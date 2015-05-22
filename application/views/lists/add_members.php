<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 2/2/15
 * Time: 6:36 PM
 */

?>

<h2 class="fz-26">Add/Remove Contacts</h2>

<!--
<h1 class="heading-sty-1">[List Name]</h1>
<h2 class="fz-26">Add/Remove Contacts</h2>

<p class="select_box">Select:
    <a href="#" onclick="return selectAll('all','contacts');"><?php /*echo 'All'; */?></a> |
    <a href="#" onclick="return selectAll('none','contacts');"> <?php /* echo 'None'; */?></a>
</p>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive-from-start">
            <table class="table table-hover demo-table-search table-sty-1" id="tableWithSearch">
              <thead>
                <tr>
                    <th>Select</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Printed Name</th>
                    <th>Business Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>
                        <div class="checkbox check-success">
                            <input type="checkbox" checked="checked" value="1" id="checkbox2">
                            <label for="checkbox2" class="h-13"></label>
                        </div>
                    </td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>

                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>

                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td>
                        <ul class="actions-sty-1 no-line-break">
                            <li><a class="fa" href=""></a></li>
                            <li><a class="fa remove" onclick="" href="#"></a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox check-success">
                            <input type="checkbox" checked="checked" value="1" id="checkbox3">
                            <label for="checkbox3" class="h-13"></label>
                        </div>
                    </td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>

                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>

                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td><div class="td-wrap"><div class="td-wrap-inner">a</div></div></td>
                    <td>
                        <ul class="actions-sty-1 no-line-break">
                            <li><a class="fa" href=""></a></li>
                            <li><a class="fa remove" onclick="" href="#"></a></li>
                        </ul>
                    </td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input class="btn btn-success" type="submit" value="Save Changes">
    </div>
</div>

<br>
<br>-->
<?php

if($aContacts)
{
    ?>

    <div class="c-box">
        <form method="post" action="<?php echo $sFormAction; ?>" accept-charset="utf-8"  role="form">

            <p class="select_box">Select
                <a href="#" onclick="return selectAll('all','contacts');"><?php echo 'All'; ?></a> |
                <a href="#" onclick="return selectAll('none','contacts');"> <?php  echo 'None'; ?></a>
            </p>

    <?php

    $iTotalCounts  = count($aContacts);

    for($c=0; $c < $iTotalCounts; $c++)
    {
        $iContactId     = $aContacts[$c]->contact_id;
        $sBusinessName  = $aContacts[$c]->business_name;

        $disabled= $sAlreadyAdded = '';
        if(in_array($iContactId,$aPreviousContacts))
        {
            $disabled       = 'disabled';
            $sAlreadyAdded  = ' (Already in List)';
        }

    ?>
        <div class="row">

            <div class="col-md-4">
                <div class="data">
                    <div class="checkbox check-success  ">
                      <input <?php echo $disabled; ?> type="checkbox" name="contacts[]" checked="checked" value="<?php echo $iContactId; ?>" class="contacts" id="checkbox-<?php echo $c; ?>">
                      <label for="checkbox-<?php echo $c; ?>"><?php echo $sBusinessName; ?> <span style="color: red"><?php echo $sAlreadyAdded; ?></span></label>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }

    ?>
                <br/>
                <input type="hidden" value="some_value">
                <input class="btn btn-success" type="submit" value="Add to List"><br/>
            </div>
    </form>

    <?php

}
else
{

    redirect('contacts/import');
}

/*
*/?><!--

<div class="no_record"><p>There are no contacts in your contact list, <a href="<?php /*echo site_url('contacts/import'); */?>">Add Contacts</a>.</p></div>

--><?php
/*}
*/?>


