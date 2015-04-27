<div class="tab-pane active" id="template-tab-3">
                <div class="row column-seperation">
                    <div class="col-md-12">
                        <ul class="list-sty-2">


                            <?php

                            $iTotalTemplates = count($aTemplates);

                            for($t=0; $t < $iTotalTemplates; $t++)
                            {
                                $aTemplate          = (object) $aTemplates[$t];
                            ?>

                            <li>
                                <script type="text/javascript">
                                    $('.magnific-popup-<?php echo $aTemplate->template_id;?>').magnificPopup({
                                        items: [
                                            {
                                                src: '<?php echo site_url('assets/img/front.png'); ?>',
                                                title: 'Front'
                                            },
                                            {
                                                src: '<?php echo site_url('assets/img/back.png'); ?>',
                                                title: 'Back'
                                            },

                                        ],
                                        gallery: {
                                            enabled: true
                                        },
                                        type: 'image' // This is a default type
                                    });
                                </script>

                                <div data-img="<?php echo site_url('assets/img/front.png'); ?>" class="img cover-img" style="background-image: url(<?php echo site_url('assets/img/front.png'); ?>);">
                                    <a href="<?php echo site_url('assets/img/back.png'); ?>" class="fa img-preview magnific-popup-<?php echo $aTemplate->template_id;?>"></a>
                                </div>
                                <div class="select">
                                    <input type="radio" id="template_checkbox_<?php echo $aTemplate->template_id;?>" ng-model="selected_template_id" name="template_checkbox" ng-value="<?php echo $aTemplate->template_id;?>">
                                    <label for="template_checkbox_<?php echo $aTemplate->template_id;?>">
                                        <span class="btn">Select</span>
                                        <span class="btn btn-complete">Selected</span>
                                    </label>
                                </div>
                                <div class="title">
                                    <h4><?php echo $aTemplate->title;?></h4>
                                </div>
                                <p><?php echo $aTemplate->description;?></p>
                                <ul class="details">
                                    <li>
                                        <div class="field">
                                            specs
                                        </div>
                                        <!--<div class="value">One Sided</div>-->
                                        <div class="value"><?php echo $aTemplate->width;?>x<?php echo $aTemplate->height;?> inches</div>
                                    </li>
                                    <li>
                                        <div class="field">
                                            Printing Price
                                        </div>
                                        <div class="value">
                                            <?php echo formatAmount($aTemplate->printing_price);?>
                                        </div>
                                    </li>
                                </ul>
                                <input type="hidden" class="temp_name" name="template_id" value="<?php echo $aTemplate->template_id;?>">
                            </li>

                            <?php
                            }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
