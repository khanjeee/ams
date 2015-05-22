<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 5/14/15
 * Time: 7:10 PM
 */
?>
<script data-require="angular.js@1.2.x" src="<?php echo getAssetsPath(); ?>js/angular/angular.js" data-semver="1.2.15"></script>
<script src="<?php echo getAssetsPath(); ?>js/custom/dashboard.js"></script>

<div class="c-box">
    <div class="c-box__head">
        <div class="fl">
            <h4 class="heading">Orders <span>Ready For Printing</span></h4>
        </div>
        <div class="fr">
            <?php
            global $aBatchStatus;

            $iTotalBatches = count($aCutOffBatches);

            ?>

            <div class="count"><?php echo $iTotalBatches; ?></div>
        </div>
    </div>
    <div class="c-box__body " >
        <div ng-app="ams" ng-controller="DownloadContent">
            <ul class="c-box__list">

                <?php
                if($iTotalBatches > 0)
                {
                    for($b=0; $b <$iTotalBatches; $b++ )
                    {
                        $aBatch                 = (object) $aCutOffBatches[$b];
                        //debug($aBatch);
                        $PreviewImages          = json_decode($aBatch->last_preview_images);
                        $TemplateDefaultImage   = $aBatch->folds[0]['default_fold_image'];
                        ?>

                        <li class="sty-1">
                            <div class="t-layout">
                                <div class="t-row">
                                    <div class="t-col col-1">


                                        <!-- Previe Images -- START-->

                                        <script type="text/javascript">

                                            $(window).ready(function ()
                                            {
                                                $('.magnific-popup-<?php echo $b; ?>').magnificPopup
                                                ({
                                                    items:
                                                        [
                                                            <?php

                                                            if($PreviewImages)
                                                            {
                                                                $Script ='';
                                                                for($p=0; $p<count($PreviewImages);$p++)
                                                                {
                                                                    $src    = site_url($PreviewImages[$p]->file_server_path);
                                                                    $title  = $PreviewImages[$p]->fold_title;

                                                                    echo $Script = <<<DATA

                                                                    {
                                                                        src     : '$src',
                                                                        title   : '$title'
                                                                    },
DATA;
                                                                }
                                                            }

                                                            ?>
                                                        ],
                                                    gallery: {
                                                        enabled: true
                                                    },
                                                    type: 'image' // this is a default type
                                                });
                                            });
                                        </script>


                                        <div data-img="<?php echo site_url($TemplateDefaultImage); ?>" class="img cover-img pos-rel">
                                            <a href="<?php echo site_url($TemplateDefaultImage); ?>" class="fa img-preview magnific-popup-<?php echo $b; ?>"></a>
                                        </div>


                                        <!-- Previe Images -- END -->

                                    </div>
                                    <div class="t-col col-2">
                                        <div class="title">
                                            <a href="#"><?php echo $aBatch->batch_title; ?></a>
                                            <div class="info">Campaign: <a href="<?php echo site_url('campaigns/show/'.$aBatch->campaign_id); ?>"><?php echo $aBatch->campaign_title; ?></a>, User: <a ><?php echo $aBatch->first_name; ?> <?php echo $aBatch->last_name; ?></a></div>
                                        </div>
                                        <div id="edit-section-1" class="editable show">
                                            <div class="status">
                                                <div class="value">
                                                    <strong>Status</strong>
                                                    <span>Ready for printing</span>
                                                </div>
                                            </div>
                                        </div>
                                        <strong>Product:</strong> <span><?php echo $aBatch->product_title; ?></span> (<?php echo $aBatch->template_title; ?>)
                                        <br>
                                        <strong>Cost:</strong> <span><?php echo formatAmount($aBatch->total_printing_cost); ?></span>
                                        <br>
                                        <strong>Scheduled For:</strong> <span><?php echo displayDate($aBatch->schedule_date); ?></span>
                                        <br>
                                        <strong>Created On:</strong> <span><?php echo displayDate($aBatch->created_on); ?></span>
                                        <br>
                                        <strong>Cutoff Date:</strong> <span><?php echo displayDate($aBatch->cut_off_date); ?></span>
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-primary edit is-editable-section m-t-10" data-target="edit-section-<?php echo $b; ?>">Edit Status</a>
                                        <a href="#" class="btn btn-success m-t-10" ng-click="DownloadBatchContent('<?php echo $aBatch->campaign_batch_id; ?>')">Download Content</a>
                                    </div>
                                    <div class="t-col text-right t-col--mid col-3">
                                        <a href= "#" class="fa arrow"></a>
                                    </div>
                                </div>
                            </div>

                            <div id="edit-section-<?php echo $b; ?>-target" class="edit-mode hide">
                                <div class="edit">
                                    <!-- <h5>Change Status</h5> -->
                                    <div class="form-group form-group-default form-group-default-select2">
                                        <label>status</label>
                                        <?php echo form_dropdown('status', $aBatchStatus, "$aBatch->current_status", "class='select--no-search full-width status$b'");  ?>
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label class="address_mailing">Notes:</label>
                                        <div class="controls">
                                            <textarea type='text' class='comment<?php echo $b; ?> form-control h-90' placeholder="Write a note to keep track of changes in status."></textarea>
                                        </div>
                                    </div>

                                    <a onclick="cancelEdit('edit-section-<?php echo $b; ?>');" href="javascript:void(0);" class="btn btn-danger">Cancel</a>
                                    <input type="button" name="btnSubmit" value="Update Status" ng-click="updateBatchStatus('<?php echo $aBatch->campaign_batch_id; ?>','<?php echo $b; ?>')" class="create_campagin btn btn-success m-btn-full w-auto">
                                </div>
                            </div>

                        </li>
                    <?php
                    }
                }else{

                    ?>
                    <li>
                        <p>No orders ready for printing.</p>
                    </li>
                <?php

                }

                ?>
            </ul>
        </div>
    </div>
</div>


