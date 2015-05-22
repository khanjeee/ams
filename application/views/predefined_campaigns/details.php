<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 3/2/15
 * Time: 3:47 PM
 */
?>
<div ng-app="" ng-controller="UpdateCampaign">

<?php


$oCampaign              = (object)$aCampaignData['aCampaign'];
$DeleteUrl              = site_url('campaigns/delete/'.$oCampaign->predefined_campaign_id);
$iCampaignId            = $oCampaign->predefined_campaign_id;

?>
<div class="c-box">
	<div class="row">
		<div class="col-md-12">

          <!-- ============================ -->
          <!-- Editable Content -->
          <div id="edit-section-<?php echo $iCampaignId; ?>" class="editable">
            <h1 class="heading-sty-1 m-t-0">
              <span class="camp_title_<?php echo $iCampaignId; ?>"><?php echo $oCampaign->title; ?></span>
            </h1>
            <p><span class="camp_desc_<?php echo $iCampaignId; ?>"><?php echo  $oCampaign->description; ?></span></p>
          </div>

        <hr>

	        <!-- START PANEL -->
            <div class="panel panel-transparent">
              <div class="panel-heading p-l-0 p-r-0">
                <div class="clearfix">
                  <div class="fl m-fn">
                    <h4 class="m-t-0"><?php echo BATCHES; ?></h4>
                  </div>
                </div>
              </div>
              <div class="panel-body p-l-0 p-r-0">

                    <?php

                    $iTotalBatches = 0;
                    if(isset($aCampaignData['aBatches']) and $aCampaignData['aBatches'])
                    {
                        $iTotalBatches = count($aCampaignData['aBatches']);
                    }

                    if($iTotalBatches > 0 )
                    {

                     ?>

                    <div class="accordion skin-1 m-b-20">
                        <div class="accordion-main-header t-layout">
                            <div class="t-row">
                                <div class="t-col"></div>
                                <div class="t-col">
                                    Title
                                </div>
                                <div class="t-col">
                                    Product
                                </div>
                                <div class="t-col">
                                    Date of delivery
                                </div>
                                <div class="t-col">
                                    Total Cost
                                </div>
                                <div class="t-col">
                                    Actions
                                </div>
                            </div>
                        </div>
                        <?php

                        foreach ($aCampaignData['aBatches'] as $iBatchId => $BatchObj)
                        {
                            $BatchObj = (object) $BatchObj;


                            $aPreviewImages     = $aLastGeneratedImages = array();
                            $PreviewImage       = BATCH_DEFAULT_IMAGE;

                            // Last Generated Images
                            if(isset($BatchObj->last_preview_images) and $BatchObj->last_preview_images)
                            {
                                $aLastGeneratedImages = json_decode($BatchObj->last_preview_images);
                            }

    ?>

                    <!--Row-->
                    <div class="accordion-header t-layout">
                        <div class="t-row">
                            <div class="t-col t-col--mid">
                                <!-- <i class="icon-arrow"></i> -->
                                <svg version="1.1" class="icon-arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     width="16.176px" height="16.175px" viewBox="-2.983 0 16.176 16.175" enable-background="new -2.983 0 16.176 16.175"
                                     xml:space="preserve">
									 <polygon fill="#707171" points="2.122,0 0,2.121 5.966,8.088 0,14.052 2.121,16.175 10.209,8.088 "/>
								</svg>
                            </div>
                            <div class="t-col t-col--mid">
                                <?php echo $BatchObj->batch_title; ?>
                            </div>
                            <div class="t-col t-col--mid">
                                <?php

                                if(!empty($BatchObj->product_title))
                                {
                                    echo $BatchObj->product_title;
                                }
                                else
                                {
                                    echo TXT_NOT_SELECTED;
                                }
                                ?>
                            </div>
                            <div class="t-col t-col--mid">
                                <?php echo (isset($BatchObj->schedule_date)) ?  displayDate($BatchObj->schedule_date) :  'Not Available'; ?>
                            </div>
                            <div class="t-col t-col--mid">
                                <?php echo formatAmount($BatchObj->total_printing_cost); ?>
                            </div>
                            <div class="t-col t-col--mid">

                                <?php

                                    if($BatchObj->current_status == BATCH_IS_IN_EDIT_MODE)
                                    {
                                        ?>
                                <ul class="actions-sty-1 no-line-break">
                                        <li><a href="<?php echo site_url('predefined_batches/save/'.$BatchObj->predefined_campaign_batch_id); ?>" class="btn btn-success">Use this <?php echo BATCH; ?></a></li>
                                </ul>
                                    <?php
                                    }
                                ?>




                            </div>
                        </div>
                    </div>


                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product</label>
                                        <h5 class="m-0">


                                            <?php

                                            if(!empty($BatchObj->product_title))
                                            {
                                                echo $BatchObj->product_title;
                                            }
                                            else
                                            {
                                                 echo TXT_NOT_SELECTED;
                                            }
                                            ?>

                                        </h5>
                                    </div>
                                    <div class="template-preview">
                                        <?php
                                        if ($aLastGeneratedImages)
                                        {
                                            $iTotalImages = count($aLastGeneratedImages);

                                            if ($iTotalImages)
                                            {
                                                for ($p = 0; $p < $iTotalImages; $p++)
                                                {
                                                    $sFoldTitle         = $aLastGeneratedImages[$p]->fold_title;
                                                    $sFileServerPath    = $aLastGeneratedImages[$p]->file_server_path;

                                                    ?>
                                                    <div class="template-preview__item">
                                                        <img src="<?php echo site_url($sFileServerPath) ?>"
                                                             width="150">

                                                        <div class="title"><?php echo $sFoldTitle; ?></div>
                                                    </div>

                                                <?php
                                                }
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="template-preview__item">
                                                <img src="<?php echo site_url(BATCH_DEFAULT_IMAGE) ?>"
                                                     width="150">

                                                <div class="title"><?php echo TXT_NOT_SELECTED; ?></div>
                                            </div>
                                            <?php
                                        }
?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4><?php echo $BatchObj->batch_title; ?></h4>
                                    <p><?php echo $BatchObj->batch_description; ?></p>
                                    <hr>
                                    <div class="form-group">
                                        <label>SCHEDULE Date/Time</label>
                                        <p><?php echo (isset($BatchObj->schedule_date)) ?  displayDate($BatchObj->schedule_date) :  'Not Available'; ?></p>
                                    </div>
                                    <hr>

                                    <hr>
                                    <div class="payment-calculation t-layout">
                                        <div class="t-row">
                                            <div class="t-col">
                                                <strong>Template Cost</strong>
                                            </div>
                                            <div class="t-col cost">
                                                <span><?php echo formatAmount($BatchObj->template_printing_price); ?></span>
                                            </div>
                                        </div>
                                        <div class="t-row total">
                                            <div class="t-col">
                                                <strong>Total Printing Cost</strong>
                                            </div>
                                            <div class="t-col cost">
                                                <span><?php echo formatAmount($BatchObj->total_printing_cost); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php

                    }
             }
                    else
                    {
                        ?>

                    <div class="no_record"><p><?php echo MSG_NO_RECORD_FOUND; ?></p></div>
                    <?php
                    }
    ?>




				</div>
<!--
				<div class="row">
					<div class="col-md-5 col-lg-4">
						<div class="payment-calculation payment-calculation--large t-layout">
		                	<div class="t-row">
		                		<div class="t-col">
		                			<strong>Template Cost</strong>
		                		</div>
		                		<div class="t-col cost">
		                			<span>$64.00</span>
		                		</div>
		                	</div>
		                	<div class="t-row">
		                		<div class="t-col">
		                			<strong>Printing Cost</strong>
		                		</div>
		                		<div class="t-col cost">
		                			<span>$28.00</span>
		                		</div>
		                	</div>
		                	<div class="t-row total">
		                		<div class="t-col">
		                			<strong>Total</strong>
		                		</div>
		                		<div class="t-col cost">
		                			<span>$92.00</span>
		                		</div>
		                	</div>
		                </div>
					</div>
					<div class="col-md-7 col-lg-8 tablet-m-t-30">

						<strong>Select Credit Card</strong>

	                    <div class="radio radio-success credit-card-selector">
	                    	<div class="m-b-10">
		                    	<input type="radio" value="card-1" name="credit-cards" id="card-1">
		                    	<label for="card-1">xxxx-xxxx-xxxx-8888</label>
		                    </div>
		                    <div class="m-b-10">
								<input type="radio" value="new-card" name="credit-cards" id="new-card" checked="check">
								<label for="new-card">Add Card</label>
							</div>
	                    </div>

                        <form role="form" class="max-w-700 new-card__form">
                          <div class="bg-master-light padding-30 b-rad-lg">
                            <h2 class="pull-left no-margin">Credit Card</h2>
                            <ul class="list-unstyled pull-right list-inline no-margin">
                              <li>
                                <a href="#">
                                  <img width="51" height="32" data-src-retina="<?php /*echo getAssetsPath(); */?>img/form-wizard/visa2x.png" data-src="<?php /*echo getAssetsPath(); */?>img/form-wizard/visa.png" class="brand" alt="logo" src="<?php /*echo getAssetsPath(); */?>img/form-wizard/visa.png">
                                </a>
                              </li>
                              <li>
                                <a href="#" class="hint-text">
                                  <img width="51" height="32" data-src-retina="<?php /*echo getAssetsPath(); */?>img/form-wizard/amex2x.png" data-src="<?php /*echo getAssetsPath(); */?>img/form-wizard/amex.png" class="brand" alt="logo" src="<?php /*echo getAssetsPath(); */?>img/form-wizard/amex.png">
                                </a>
                              </li>
                              <li>
                                <a href="#" class="hint-text">
                                  <img width="51" height="32" data-src-retina="<?php /*echo getAssetsPath(); */?>img/form-wizard/mastercard2x.png" data-src="<?php /*echo getAssetsPath(); */?>img/form-wizard/mastercard.png" class="brand" alt="logo" src="<?php /*echo getAssetsPath(); */?>img/form-wizard/mastercard.png">
                                </a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="form-group form-group-default required m-t-25">
                              <label>Card holder's name</label>
                              <input type="text" class="form-control" placeholder="Name on the card" required>
                            </div>
                            <div class="form-group form-group-default required">
                              <label>Card number</label>
                              <input type="text" class="form-control" placeholder="8888-8888-8888-8888" required>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <label>Expiration</label>
                                <br>
                                <select class="cs-select cs-skin-slide" data-init-plugin="cs-select">
                                  <option selected>Jan (01)</option>
                                  <option>Feb (02)</option>
                                  <option>Mar (03)</option>
                                  <option>Apr (04)</option>
                                  <option>May (05)</option>
                                  <option>Jun (06)</option>
                                  <option>Jul (07)</option>
                                  <option>Aug (08)</option>
                                  <option>Sep (09)</option>
                                  <option>Oct (10)</option>
                                  <option>Nov (11)</option>
                                  <option>Dec (12)</option>
                                </select>
                                <select class="cs-select cs-skin-slide" data-init-plugin="cs-select">
                                  <option value="2014">2014</option>
                                  <option value="2015">2015</option>
                                  <option value="2016">2016</option>
                                  <option value="2017">2017</option>
                                  <option value="2018">2018</option>
                                  <option value="2019">2019</option>
                                  <option value="2020">2020</option>
                                  <option value="2021">2021</option>
                                  <option value="2022">2022</option>
                                  <option value="2023">2023</option>
                                  <option value="2024">2024</option>
                                  <option value="2025">2025</option>
                                  <option value="2026">2026</option>
                                  <option value="2027">2027</option>
                                  <option value="2028">2028</option>
                                  <option value="2029">2029</option>
                                  <option value="2030">2030</option>
                                </select>
                              </div>
                              <div class="col-md-2 col-md-offset-4">
                                <div class="form-group required">
                                  <label>CVC Code</label>
                                  <input type="text" class="form-control" placeholder="000" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
					</div>
				</div>
-->
              </div>
            </div>
            <!-- END PANEL -->

		</div>
	</div>
</div>
</div>



<!-- ============================ -->
<!-- Editing Campaign - Ajax -->
<script type="text/javascript">
    function UpdateCampaign($scope,$http)
    {
        $scope.JsUpdateCampaign = function(CampaignId)
        {
            var CampaignTitle   = $("#campaign_title_"+CampaignId).val();
            var CampaignDesc    = $("#campaign_desc_"+CampaignId).val();

            if(CampaignTitle && CampaignDesc)
            {
                $http.post('<?php echo site_url('ajax/predefined_campaign/'); ?>', {call_from:'UpdateCampaign',predefined_campaign_id:CampaignId,description:CampaignDesc,title:CampaignTitle,method:'updateCampaign'}).
                success(function(data, status, headers, config)
                {
                    $(".camp_title_"+CampaignId).text(CampaignTitle);
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