<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 2/23/15
 * Time: 6:32 PM
 */
$oSummary       = (object) $aSummaryData['BatchDetails'];
?>


<!-- Upload Content  -->
<div class="row row-same-height">
<div class="col-md-8">
<h4><?php echo $oSummary->batch_title; ?></h4>
<p><?php echo $oSummary->batch_description; ?></p>
<hr>
<div class="form-group">
    <label>Schedule On </label>
    <p><?php echo displayDate($oSummary->schedule_date); ?></p>
    <!-- <p><strong>Note: </strong>Template " <?php echo $oSummary->template_title; ?> " requires at-least <strong class="c-blue"> <?php echo $oSummary->cut_off_period; ?> day(s).</strong> for Printing.</p> -->
</div>
<hr>
<div class="form-group">
    <label>Lists</label>

    <?php
    for($l=0; $l < count($aSummaryData['BatchLists']); $l++)
    {
        $sList = (object) $aSummaryData['BatchLists'][$l];
        ?>
    <span class="tag label"><?php echo $sList->list_title; ?></span>
    <?php
    }
    ?>
</div>
<hr>
<div class="form-group">
    <label>Product</label>
    <p><?php echo $oSummary->product_title; ?></p>
</div>
<div class="form-group">
    <label>Template</label>
    <p><?php echo $oSummary->template_title; ?></p>
</div>





    <!-- Preview -->
    <div class="t-layout batch-preview-layout">
        <div class="t-row">

    <?php

    if($oSummary->last_preview_images)
    {
        $aLastGeneratedImages = json_decode($oSummary->last_preview_images);
    }

    if($aLastGeneratedImages)
    {
        $iTotalImages = count($aLastGeneratedImages);

        if($iTotalImages)
        {
            for($p=0; $p < $iTotalImages; $p ++)
            {
                $sFoldTitle         = $aLastGeneratedImages[$p]->fold_title;
                $sFileServerPath    = $aLastGeneratedImages[$p]->file_server_path;

                ?>
                    <div class="t-col batch-preview">
                        <label><?php echo $sFoldTitle; ?></label>

                        <div class="front-view">
                            <img src="<?php echo site_url($sFileServerPath); ?>" width="350" height="200">
                        </div>
                    </div>
    <?php
            }
        }
    }
    ?>
</div>
</div>

    <!-- Preview -->



<hr>
<div class="payment-calculation t-layout">
    <div class="t-row">
        <div class="t-col">
            <strong>Template Cost</strong>
        </div>
        <div class="t-col cost">
            <span><?php echo formatAmount($aSummaryData['pkg_template_cost']); ?></span>
        </div>
    </div>
    <div class="t-row total">
        <div class="t-col">
            <strong>Total Printing Cost</strong>
        </div>
        <div class="t-col cost">
            <span><?php echo formatAmount($aSummaryData['BatchTotalPrintingPrice']); ?></span>
        </div>
    </div>
<!--    <div class="t-row total">
        <div class="t-col">
            <strong>Total</strong>
        </div>
        <div class="t-col cost">
            <span><?php //echo formatAmount($oSummary->template_printing_price); ?></span>
        </div>
    </div>-->
</div>
<hr>
</div>
</div>
<!-- Upload Content -->
