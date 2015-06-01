<!-- Code for Angular -->
<link rel="stylesheet" href="<?php echo getAssetsPath(); ?>css/angular/ng-tags-input.min.css" />
<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/angular/ng-tags-input.min.js"></script>
<!-- END - Code for Angular -->

<div class="row">
    <div class="col-md-2">
        <h1 class="heading-sty-1">
            <?php if(!isSuperAdmin()){
                echo PLURAL_CAMPAIGNS;
            }else{
                echo ORDER_PLURAL;
            }
            ?>
            
        </h1>
    </div>
    <div class="col-md-10">
        <div class="contact-search-n-actions-panel">
            <!-- <a class="btn btn-primary btn--import" href="http://localhost/ams/contacts/import"><i class="fa m-r-10"></i> <span>Import</span></a>
            <a class="btn btn-primary btn--create" href="http://localhost/ams/contacts/create"><i class="fa m-r-10"></i> <span>Create</span></a>
            <input type="text" placeholder="Search" class="form-control pull-right search-field" id="search-table"> -->
            <?php

            if(!isSuperAdmin())
            {

            ?>

            <a  href="<?php echo site_url('campaigns/create'); ?>" class="btn btn-complete btn-cons">Create New Campaign</a>

            <?php 

            }

            ?>

        </div>
    </div>
</div>

    <?php

    if($aCampaigns)
    {
       # d($aCampaigns);

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
                        $DeleteUrl          = site_url('campaigns/delete/'.$oCampaign->campaign_id);
                        $ViewDetailsUrl     = site_url('campaigns/show/'.$oCampaign->campaign_id);
                        $iCampaignId        = $oCampaign->campaign_id;

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
                                <a href="<?php echo $ViewDetailsUrl; ?>" class="name">
                                    <span id="camp_title_<?php echo $iCampaignId; ?>" class="heading-sty-3">
                                        <?php echo $oCampaign->title; ?>
                                    </span>
                                    <?php
                                    if(isset($oCampaign->is_predefined_campaign))
                                    {
                                        echo "(".TEMPLATE_SINGULAR.")";
                                    }
                                    ?>
                                </a>

                                <?php

                                if(!isSuperAdmin())
                                {
                                    if(!isset($oCampaign->is_predefined_campaign))
                                    {
                                        ?>

                                        <div class="actions">
                                            <a href="javascript:void(0)" class="fa edit is-editable-section" data-target="edit-section-<?php echo $iCampaignId; ?>"></a>

                                            <?php
                                            if($oCampaign->canBeDeleted)
                                            {
                                                ?>
                                                <a href="javascript:void(0)" onclick="return confirmDelete('delete_campaign','<?php echo $DeleteUrl; ?>');" class="fa delete"></a>
                                            <?php
                                            }
                                            ?>

                                        </div>

                                        <?php
                                    }
                                }

                                ?>

                            </div>
                            <p><span class="camp_desc_<?php echo $iCampaignId; ?>"><?php echo  word_limiter($oCampaign->description,75); ?></span></p>
                        </div>


                        <!-- ============================ -->
                        <!-- Edit Mode -->
                        <div id="edit-section-<?php echo $iCampaignId; ?>-target" class="edit-mode hide m-b-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group form-group-default" ng-class="{ 'has-error':error_batch_name }">
                                        <label class="campaign-name" for="campaign-name">Title:</label>
                                        <input ng-init="campaign_title_<?php echo $iCampaignId; ?>='<?php echo $oCampaign->title; ?>'" ng-model="campaign_title_<?php echo $iCampaignId; ?>" id="campaign_title_<?php echo $iCampaignId; ?>" required type="text" value="<?php echo $oCampaign->title; ?>" class="form-control" placeholder="Title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group form-group-default" ng-class="{ 'has-error':error_batch_name }">
                                        <label class="campaign-description" for="campaign-description">Description:</label>
                                        <textarea ng-init="campaign_desc_<?php echo $iCampaignId; ?>='<?php echo $oCampaign->description; ?>'" ng-model="campaign_desc_<?php echo $iCampaignId; ?>" required class="form-control m-t-4" id="campaign_desc_<?php echo $iCampaignId; ?>" placeholder="Add some campaigns details..."><?php echo $oCampaign->description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a onclick="cancelEdit('edit-section-<?php echo $iCampaignId; ?>');" href="javascript:void(0);" class="btn">Cancel</a>
                                    <input type="button" name="btnSubmit" value="Update Info" ng-click="JsUpdateCampaign(<?php echo $iCampaignId; ?>)" class="create_campagin btn btn-success m-btn-full w-auto">
                                </div>
                            </div>
                        </div>

                            <hr>
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <h3 class="m-t-0"><?php echo BATCHES; ?> <span class="font-sty-1">(<?php echo $iTotalBatchesCount; ?>)</span></h3>
                                </div>
                                <div class="col-md-10 text-right m-text-left">
                                    <?php if(!isSuperAdmin())
                                    {
                                        $AddMailerUrl = site_url('batches/create/'.$oCampaign->campaign_id);
                                        if(isset($oCampaign->is_predefined_campaign))
                                        {
                                            $AddMailerUrl = site_url('batches/whitelabel_create/'.$oCampaign->campaign_id);
                                        }
                                        ?>

                                        <a href="<?php echo $AddMailerUrl; ?>" class="btn btn-success btn-cons">Add <?php echo BATCH; ?></a>

                                        <?php
                                    }
                                    ?>
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
                                                            <?php
                                                                if(isSuperAdmin())
                                                                {
                                                            ?>
                                                            <a class="fa img-preview magnific-popup-1" href="http://localhost/ams/assets/img/back.png"></a>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>

                                                        <?php
                                                            if(isSuperAdmin())
                                                            {
                                                        ?>
                                                        <script type="text/javascript">
                                                            $(document).ready(function () {
                                                                $('.magnific-popup-1').magnificPopup({
                                                                    items: [
                                                                        {
                                                                            src: '<?php echo site_url('assets/img/front.png'); ?>',
                                                                            title: 'Front <a href="#" class="fa fa-print"></a>',
                                                                        },
                                                                        {
                                                                            src: '<?php echo site_url('assets/img/back.png'); ?>',
                                                                            title: 'Back <a href="#" class="fa fa-print"></a>',
                                                                        },

                                                                    ],
                                                                    gallery: {
                                                                        enabled: true
                                                                    },
                                                                    type: 'image', // This is a default type
                                                                    callbacks: {
                                                                        open: function() {
                                                                            console.log('Popup is opened');
                                                                            console.log(this.content); // Direct reference to your popup element
                                                                        },
                                                                        change: function() {
                                                                            console.log('Content changed');
                                                                            console.log(this.content); // Direct reference to your popup element
                                                                        },
                                                                    }
                                                                });
                                                            });
                                                            
                                                        </script>
                                                        <?php
                                                        }
                                                        ?>
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
                                                                <li><strong>List : </strong>
                                                                    <?php
                                                                    $Lists = array();
                                                                    $thisBatchListCount  = count($thisBatch ['BatchLists']);
                                                                    for($z=0; $z < $thisBatchListCount; $z++)
                                                                    {
                                                                        $Lists[] = $thisBatch ['BatchLists'][$z]['text'];
                                                                    }
                                                                    echo implode(' , ',$Lists);
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
                                                                    if($thisBatch ['pkg_template_cost'])
                                                                    {
                                                                        echo formatAmount($thisBatch ['pkg_template_cost']);
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
                                                    <?php if(!isSuperAdmin())
                                                    {
                                                        if($thisBatch ['current_status'] == BATCH_IS_IN_EDIT_MODE)
                                                        {
                                                            $EditMailerUrl = site_url('batches/edit/'.$thisBatch ['campaign_batch_id']);
                                                            if(isset($oCampaign->is_predefined_campaign))
                                                            {
                                                                $EditMailerUrl = site_url('batches/whitelabel_edit/'.$thisBatch ['campaign_batch_id']);
                                                            }
                                                            ?>
                                                            <a href="<?php echo $EditMailerUrl; ?>" class="btn btn-primary">Edit</a>
                                                            <a href="javascript:void(0)" onclick="return confirmDelete('delete_batch','<?php echo site_url('batches/delete/'.$thisBatch ['campaign_batch_id']);?>');"  class="btn btn-danger">Delete</a>

                                                        <?php
                                                        }
                                                    }
                                                    ?>
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



<script type="text/javascript">
    function UpdateCampaign($scope,$http)
    {
        $scope.JsUpdateCampaign = function(CampaignId)
        {
            var CampaignTitle   = $("#campaign_title_"+CampaignId).val();
            var CampaignDesc    = $("#campaign_desc_"+CampaignId).val();

            if(CampaignTitle && CampaignDesc)
            {
                $http.post('<?php echo site_url('ajax/campaign/'); ?>', {call_from:'UpdateCampaign',campaign_id:CampaignId,description:CampaignDesc,title:CampaignTitle,method:'updateCampaign'}).
                success(function(data, status, headers, config)
                {
                    $("#camp_title_"+CampaignId).text(CampaignTitle);
                    $(".camp_desc_"+CampaignId).text(CampaignDesc);
                    $("#campaign_title_"+CampaignId).val(CampaignTitle);
                    $("#campaign_desc_"+CampaignId).val(CampaignDesc);
                    cancelEdit('edit-section-'+CampaignId);
                }).
                error(function(data, status, headers, config)
                {
                    console.log(data);
                });
            }
            else
            {
                alert("Please fill the form correctly.");
            }
        };
        return false;
    }
</script>