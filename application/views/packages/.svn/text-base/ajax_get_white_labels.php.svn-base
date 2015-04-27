<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 4/2/15
 * Time: 1:33 PM
 */

if($aSolutions)
{
    $options = '';

    for($o=0; $o<count($aSolutions);$o++ )
    {
        $sPromotionCode     = $aSolutions[$o]->promotion_code;
        $iSolutionTitle     = $aSolutions[$o]->title;

        $options .= <<<OPTIONS

                <option value="$sPromotionCode">$iSolutionTitle</option>
OPTIONS;

    }
    ?>


    <div class="col-lg-2 col-md-4">
        <div class="form-group form-group-default ">
            <label class="status">Choose a Solution:</label>
            <select required  name="package[whitelabel]"  class="full-width select--no-search " data-init-plugin="select2">
                <?php echo $options; ?>
            </select>
        </div>
    </div>

    <?php

}
else
{
?>
    <div >No WhiteLabelSolutions found.<a href="<?php echo site_url('whitelabel/create'); ?>">Create one from here.</div>
<?php
}

?>

