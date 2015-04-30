<div class="row element_html_my">
    <div class="col-md-12">
        <h4><?php echo $aFold['title']; ?></h4>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?php

        /*if($i==0){
            echo "<hr>";
        }*/

        $iFoldId          = $aFold['fold_id'];
        $defaultFoldImage = $aFold['default_fold_image'];
        
        //d($aFold);
        for($e=0; $e < count($aElements); $e++)
        {
            
           // debug($aElements);
            # Single Element Entity
            $aElement               =   $aElements[$e];
            $ElementName            =   $aElement['element_name'];
            $ElementData            =   $aElement['provided_data'];            
            $sTitle                 =   $aElement['title'];
            $HtmlControlType        =   $aElement['html_control_type'];
            $iElementId             =   $aElement['element_id'];
            $iElementPosition       =   $aElement['element_position'];
            $sElementLabel          =   $aElement['element_label'];

            if($HtmlControlType == 'textbox')
            {
            // variable used as unique javascript array index in elements_html  view
            global $jsArrayIndex;
                   
                
                ?>
            <div class="form-group">
                <div class="controls" ng-class="{'has-error':error_<?php echo $ElementName.'_'.$jsArrayIndex; ?>}">
                    <label for="content_1" class="content_1"><?php echo $sElementLabel; ?> </label>
                    <?php

                    $afieldData               =  array   (
                                                            'name'                  =>  $ElementName,
                                                            'placeholder'           =>  $sElementLabel,
                                                            'ng-change'             =>  "setElementDetails({$ElementName}_{$jsArrayIndex},'$ElementName','$iElementId','$iElementPosition','$iFoldId','$jsArrayIndex')",
                                                            'element_id'            =>  "$iElementId",
                                                            'fold_id'               =>  "$iFoldId",
                                                            'position'              =>  "$iElementPosition",
                                                            'index'                 =>  "$jsArrayIndex",    
                                                            'value'                 =>  "$ElementData",          
                                                            'class'                 =>  'form-control custom-elements',
                                                            'ng-model'              =>  "{$ElementName}_{$jsArrayIndex}",
                                                            'ng-init'               =>  "{$ElementName}_{$jsArrayIndex}='$ElementData'"        
                                                                    
                    );
                                                            
                    echo form_input($afieldData);
                    echo "<label ng-show='error_{$ElementName}_{$jsArrayIndex}'  class='error'>".ERROR_FIELD_REQUIRED."</label>"; 
           //incrementing the varible after completion of the each iteration  
           $jsArrayIndex = $jsArrayIndex + 1 ; 
           ?>
                </div>
           </div>
            <?php       
                    
            }
            else if($HtmlControlType == 'image')
            {
                $id = rand(1,12312321);
                ?>

                <div class="form-group">
                    <div class="controls">
                        <label><?php echo $sElementLabel; ?></label>
                        <div  id="element_img_<?php echo $id; ?>"></div>
                        <div class="ajax_uploaded_image" id="element_<?php echo $id; ?>"></div>
                        <script type="text/javascript">
                            $('#element_<?php echo $id; ?>').JSAjaxFileUploader
                            ({
                                uploadUrl           :   '<?php echo site_url('ajax/upload'); ?>',
                                beforesend          :   function(file){
                                                            $('#element_<?php echo $id; ?>').addClass('disable');
                                                        },
                                complete            :   function(file,xhr){
                                                            $('#element_<?php echo $id; ?>').removeClass('disable');
                                                        }, 
                                inputText           :   'Upload Image',
                                fileName            :   '<?php echo FILE_UPLOAD_FIELD; ?>',
                                formData            :   {   call_from:'<?php echo (isset($isPredefined))? PD_BATCH_UPLOAD_CONTENT : BATCH_UPLOAD_CONTENT;  ?>',
                                                            campaign_batch_id:'<?php echo $iCampaignBatchId; ?>',
                                                            template_id:'<?php echo $iTemplateId; ?>',
                                                            template_fold_id:'<?php echo $aFold['fold_id']; ?>',
                                                            template_element_id:'<?php echo $iElementId; ?>',
                                                            element_position:'<?php echo $iElementPosition; ?>'
                                                        },
                                multiple            :   '',//multiple
                                closeAnimationSpeed :   3500, //In milli seconds 1000 ms = 1 second
                                autoSubmit          :   true,
								maxFileSize			:	52428800 ,
                                success             :   function(response)
                                {
                                    //console.log(response);

                                    //response was in string so converting it to json object
                                    response = JSON.parse(response);

                                    $("#element_<?php echo $id; ?>").removeClass('ajax_uploaded_image');
                                    //removing error class in case of success
                                    $("#element_<?php echo $id; ?>").removeClass('error');
                                    $('#element_<?php echo $id; ?> .JSpreveiw').text('').removeClass('error');
                                    
                                    

                                    var imgUrl = response.data.image_thumb_small_url;
                                    $("#element_img_<?php echo $id; ?>").html('<img src="'+imgUrl+'" class="m-b-20 has-border">');
                                    $("#element_<?php echo $id; ?> .JSFileChoos .test_check")[0].nextSibling.data = 'Change Image';
                                    
                                },
                                allowExt            :   'gif|jpg|jpeg|png'	//allowing only images for upload,
                            });
                            
                            //removing custom_upload class if the image is present in edit mode
                            <?php if(!empty($ElementData)){ ?>
                            
                            //$("#element_<?php echo $id; ?> .custom_upload").removeClass('custom_upload');
                            $("#element_<?php echo $id; ?>").removeClass('ajax_uploaded_image');
                            $("#element_img_<?php echo $id; ?>").html('<img src="'+'<?php echo site_url('media/fold_elements/thumbnail/small_'.$ElementData) ?>'+'" class="m-b-20 has-border">');
                            $("#element_<?php echo $id; ?> .JSFileChoos .test_check")[0].nextSibling.data = 'Change Image';
                            
                                                    <?php } ?>
                        </script>
                    </div>
                </div>

            <?php
            }
            else if($HtmlControlType == 'textarea')
            {
                ?>
                <div class="form-group">
                    <div class="controls" ng-class="{'has-error':error_<?php echo $ElementName.'_'.$jsArrayIndex; ?>}">
                        <label for="content_1" class="content_1"><?php echo $sElementLabel; ?> </label>
                        <?php
                        
                        $afieldData               =  array   (
                            'name'                  =>  $ElementName,
                            'placeholder'           =>  $sElementLabel,
                            'ng-change'             =>  "setElementDetails({$ElementName}_{$jsArrayIndex},'$ElementName','$iElementId','$iElementPosition','$iFoldId','$jsArrayIndex')",
                            'class'                 =>  'form-control custom-elements',
                            'element_id'            =>  "$iElementId",
                            'fold_id'               =>  "$iFoldId",
                            'position'              =>  "$iElementPosition",
                            'index'                 =>  "$jsArrayIndex",
                            'value'                 =>  "$ElementData",        
                            'ng-model'              =>  "{$ElementName}_{$jsArrayIndex}",
                            'ng-init'               =>  "{$ElementName}_{$jsArrayIndex}='$ElementData'"        

                        );
                       
                        echo form_textarea($afieldData);
                        echo "<label ng-show='error_{$ElementName}_{$jsArrayIndex}'  class='error'>This filed is Required ! </label>";
                        //incrementing the varible after completion of the each iteration
                        $jsArrayIndex = $jsArrayIndex + 1 ;
                        ?>
                    </div>
                </div>

            <?php
            }
        }

        ?>   
    </div>
    <img src="<?php echo site_url($defaultFoldImage) ?>" width="500" height="300" >
</div>

<br>