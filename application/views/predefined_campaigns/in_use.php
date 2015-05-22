<div class="row">
    <div class="col-md-4">
        <h1 class="heading-sty-1">
            <?php echo PREDEFINED_CAMPAIGNS_PLURAL; ?>
        </h1>
    </div>
</div>

    <?php

    if($aCampaigns)
    {

    ?>

	<div class="m-t-20 m-b-20">
        <div ng-app="" ng-controller="UpdateCampaign">
            <ul class="list-sty-3 t-list-sty-a">

                <?php

                    $iTotalCampaigns = count($aCampaigns);
                    $this->load->helper('text');

                    for($c=0; $c < $iTotalCampaigns; $c++)
                    {
                        $oCampaign          = (object) $aCampaigns[$c];
                        $DeleteUrl          = site_url('predefined_campaigns/delete/'.$oCampaign->predefined_campaign_id);
                        $ViewDetailsUrl     = site_url('predefined_campaigns/details/'.$oCampaign->predefined_campaign_id);
                        $iCampaignId        = $oCampaign->predefined_campaign_id;

                        $iTotalBatchesCount = 0;
                        if(isset($oCampaign->aBatches) and !empty($oCampaign->aBatches))
                        {
                            $iTotalBatchesCount = count($oCampaign->aBatches);
                        }

                ?>

                        <li>

                        <!-- ============================ -->
                        <!-- Editable Content -->
                        <div id="edit-section-<?php echo $iCampaignId; ?>" class="editable">
                            <div class="name-and-actions">
                                <a  class="name">
                                    <span id="camp_title_<?php echo $iCampaignId; ?>" class="heading-sty-3">
                                        <?php echo $oCampaign->title; ?>
                                    </span>
                                </a>
                            </div>
                            <p><span class="camp_desc_<?php echo $iCampaignId; ?>"><?php echo  word_limiter($oCampaign->description,75); ?></span></p>
                        </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-2">
                                    <h3 class="m-t-0"><?php echo BATCHES; ?> <span class="font-sty-1">(<?php echo $iTotalBatchesCount; ?>)</span></h3>
                                </div>
                            </div>

                            <div class="batch-preview"  style="height: auto;">

                            <!-- PHP by Imran -->
                            <?php

                            if($iTotalBatchesCount)
                            {
                                $aBatchesArray  = $oCampaign->aBatches;

                                foreach ($aBatchesArray as $iBatchId => $oBatch)
                                {
                                    $thisBatch          = (array) $oBatch;

                                    $aPreviewImages     = array();
                                    $PreviewImage       = BATCH_DEFAULT_IMAGE;

                                    // Last Generated Images
                                    if(isset($thisBatch['last_preview_images']) and $thisBatch['last_preview_images'])
                                    {
                                        $aPreviewImages = json_decode($thisBatch['last_preview_images']);
                                        $PreviewImage   = $aPreviewImages[0]->file_server_path;
                                    }
                                    ?>

                                    <div class="batch">
                                        <div class="t-layout">
                                            <div class="t-row">
                                                <div class="t-col t-col-compress t-col--align-top p-r-20">
                                                    <div class="product">
                                                        <div class="cover-img img pos-rel" data-img="<?php echo site_url($PreviewImage); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="t-col t-col--align-top">
                                                    <h4 class="m-t-0">
                                                        <?php
                                                        if($thisBatch ['batch_title']){
                                                            echo $thisBatch ['batch_title'];
                                                        }
                                                        ?>
                                                    </h4>
                                                    <p><?php echo $thisBatch ['batch_description']; ?></p>
                                                    <div class="row">
                                                        <div class="col-md-4 bor-r-1">
                                                            <ul class="meta">
                                                                <li><strong>Cut Off Date : </strong>
                                                                    <?php if($thisBatch ['cut_off_date'])
                                                                    {
                                                                        echo displayDate($thisBatch ['cut_off_date'], DATE_FORMAT_DISPLAY); }else{ echo 'Not Set!';
                                                                    }
                                                                    ?>
                                                                </li>
                                                                <li><strong>Created on: </strong>

                                                                    <?php if($thisBatch ['created_on'])
                                                                    {
                                                                        echo displayDate($thisBatch ['created_on'], DATE_FORMAT_DISPLAY); }else{ echo 'Not schedule yet!';
                                                                    }
                                                                    ?>
                                                                </li>
                                                                <li><strong>Schedule on : </strong>

                                                                    <?php if($thisBatch ['schedule_date'] && $thisBatch ['schedule_time'])
                                                                    {
                                                                        echo displayDate($thisBatch ['schedule_date'], DATE_FORMAT_DISPLAY); }else{ echo 'Not schedule yet!';
                                                                    }
                                                                    ?>

                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4 bor-r-1">
                                                            <ul class="meta">
                                                                <li><strong>Product : </strong>
                                                                    <?php
                                                                    if($thisBatch ['product_title'])
                                                                    {
                                                                        echo $thisBatch ['product_title'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo TXT_NOT_SELECTED;
                                                                    }
                                                                    ?>
                                                                </li>
                                                                <li><strong>Template : </strong>
                                                                    <?php
                                                                    if($thisBatch ['template_title'])
                                                                    {
                                                                        echo $thisBatch ['template_title'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo TXT_NOT_SELECTED;
                                                                    }
                                                                    ?>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="meta">
                                                                <li><strong>Template Cost : </strong>
                                                                    <?php
                                                                    if($thisBatch ['template_printing_price'])
                                                                    {
                                                                        echo formatAmount($thisBatch ['template_printing_price']);
                                                                    }
                                                                    else
                                                                    {
                                                                        echo TXT_NOT_SELECTED;
                                                                    }
                                                                    ?></li>
                                                                <li><strong>Total Printing Cost : </strong>
                                                                    <?php
                                                                    if($thisBatch ['total_printing_cost'])
                                                                    {
                                                                        echo formatAmount($thisBatch ['total_printing_cost']);
                                                                    }
                                                                    else
                                                                    {
                                                                        echo TXT_NOT_SELECTED;
                                                                    }
                                                                    ?>
                                                                </li>
                                                                <li><strong>Card : </strong> {Card, i.e: xxxx-xxxx-xxxx-8888}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <a href="<?php echo site_url('predefined_batches/edit_save/'.$thisBatch['predefined_user_batch_id']); ?>"  class="btn btn-success">Edit</a>
                                                    <a href="javascript:void(0)" onclick="return confirmDelete('delete_user_batch','<?php echo site_url('predefined_batches/user_batch_delete/'.$thisBatch['predefined_user_batch_id']); ?>');"
                                                       class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                            }
                            ?>
                            <!-- / PHP by Imran -->

                            </div>
                        </li>

                <?php
                    }
                ?>
            </ul>
        </div>
	</div>

<?php
}
else
{   ?>

<div class="no_record"><p><?php echo MSG_NO_RECORD_FOUND; ?></p></div>

<?php } ?>
