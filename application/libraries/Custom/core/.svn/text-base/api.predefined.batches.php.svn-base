<?php

class ApiPredefinedBatches
{
	# Initializing Class Variables
    public      $CI;
	public      $data = array();
	public      $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
        $this->data = $Data;
        $this->CI = & get_instance();
        $this->CI->load->model('predefined_batch_model',           'batch');
        $this->CI->load->model('predefined_campaign_model',        'campaign');
    }

    function UploadPredefinedBatchContentImage($sCallFrom ='',$aGivenData = array())
    {
        $aErrorMessages         = array();
        $aData                  = $aGivenData['aPostedData'];

        if($aData)
        {
            if($aGivenData['aUploadResult']['status'])
            {
                #Handling Data
                $iCampaignBatchId       =   $aData['campaign_batch_id'];
                $iTemplateId            =   $aData['template_id'];
                $iTemplateFoldId        =   $aData['template_fold_id'];
                $iTemplateElementId     =   $aData['template_element_id'];
                $sElementData           =   $aGivenData['aUploadResult']['UploadInfo']['file_name'];
                $aData['element_data']  =   $sElementData;

                if
                (
                            !validateId($iCampaignBatchId)
                    or      !validateId($iTemplateId)
                    or      !validateId($iTemplateFoldId)
                    or      !validateId($iTemplateElementId)
                )
                {$aErrorMessages[] = MSG_INVALID_ATTEMPT;   }
                if(!$sElementData)  {$aErrorMessages[] = MSG_NO_DATA_FOUND;     }

                #In case of any error
                if($aErrorMessages)
                {
                    $this->result['message'] = $aErrorMessages;
                    return $this->result;
                }

                #In case of no error .. Save Data..!

                #Check for previous Entry
                $isEditMode =   false;
                $Exists     =     $this->CI->batch->CheckBatchElementData($aData);

                if($Exists) {$isEditMode = true;} //TODO : Remove thumbnails from batches in case of update

                $iSuccess   =     $this->CI->batch->UploadBatchContent(__FUNCTION__,array('aData' => $aData,'isEditMode' => $isEditMode) );

                if($iSuccess)
                {
                    $this->result['status']         =   TRUE;
                    $this->result['message']        =   "File uploaded successfully.";
                    $aData['template_content_id']   =   $iSuccess;
                    $aData['image_url']             =   site_url('media/fold_elements/'.$sElementData);
                    $aData['image_thumb_small_url'] =   site_url('media/fold_elements/thumbnail/small_'.$sElementData);
                    $aData['image_thumb_medium_url']=   site_url('media/fold_elements/thumbnail/medium_'.$sElementData);
                    $aData['image_thumb_large_url'] =   site_url('media/fold_elements/thumbnail/large_'.$sElementData);
                    $this->result['data']           =   $aData;
                }
            }
        }

        echo json_encode($this->result,TRUE);
        exit;
    }

    function  setBatchElementsData($aPostedData = array())
    {
        $aErrorMessages             = array();

        if($aPostedData)
        {
            if($FoldElementsData = $aPostedData['fold_elements_data'])
            {
                $iTotalRecords = count($FoldElementsData);

                for($r=0; $r < $iTotalRecords; $r++)
                {
                    $aData                  = (array) $FoldElementsData[$r];

                    #Handling Data
                    $iCampaignBatchId       =   $aData['campaign_batch_id'];
                    $iTemplateId            =   $aData['template_id'];
                    $iTemplateFoldId        =   $aData['template_fold_id'];
                    $iTemplateElementId     =   $aData['template_element_id'];
                    $sElementData           =   $aData['element_data'];

                    if
                    (
                                !validateId($iCampaignBatchId)
                        or      !validateId($iTemplateId)
                        or      !validateId($iTemplateFoldId)
                        or      !validateId($iTemplateElementId)
                    )
                    {$aErrorMessages[] = MSG_INVALID_ATTEMPT;                       }
                    if(!$sElementData)  {$aErrorMessages[] = MSG_NO_DATA_FOUND;     }

                    #In case of any error
                    if($aErrorMessages)
                    {
                        $this->result['message'] = $aErrorMessages;
                        echo json_encode($this->result);
                        exit;
                    }

                    #Check for previous Entry
                    $isEditMode =   false;
                    $Exists     =   $this->CI->batch->CheckBatchElementData($aData);

                    $aData      =   $this->ImplementShortTags($aData,$iCampaignBatchId);

                    if($Exists) {$isEditMode = true;}
                    $iSuccess   =   $this->CI->batch->UploadBatchContent(__FUNCTION__,array('aData' => $aData,'isEditMode' => $isEditMode) );
                }

                if($iSuccess)
                {
                    $this->result['status']         =   TRUE;
                    $this->result['message']        =   "Data Saved successfully.";
                    $this->result['preview_url']    =   $this->getPreviewImage($iTemplateId,$iCampaignBatchId,$FoldElementsData);
                    $this->result['tab']            =   '4';
                }
            }
        }

        echo json_encode($this->result);
        exit;
    }

    function ImplementShortTags($aData = array(),$iCampaignBatchId=0)
    {
        $ShortTags = array  (
                                '{{first_name}}' => 'first_name'
                            );

        $GivenData = $aData;

        $ListId     = $this->CI->batch->getListIdOfBatch($iCampaignBatchId);

        if($ListId)
        {
            foreach($ShortTags as $Tag => $DbColumn)
            {
                $SearchInData = $aData['element_data'];

                if (strpos($SearchInData,$Tag) !== false)
                {
                    $GivenData['element_data'] = $this->CI->batch->getTagValue($ListId,$DbColumn);
                }
            }
        }

        return $GivenData;
    }

    function getPreviewImage($iTemplateId, $iCampaignBatchId, $FoldElementsData)
    {
        $LastGeneratedPreview   = array();

        $aTotalFoldsPreviews    = '';
        
        $iTotalFolds            = 0;
        $aTemplateFolds = array();

        // Get Total Folds

        if(validateId($iTemplateId))
        {
            #Fetch Total Folds
            if($aTemplateFolds      =   $this->CI->batch->getTemplateFolds($iTemplateId))
            {
                $iTotalFolds        =   count($aTemplateFolds);
            }
        }

        if($iTotalFolds)
        {
            for($f=0; $f  < $iTotalFolds; $f++)
            {
                $UploadedContent        = array();
                
                $iFoldId            = $aTemplateFolds[$f]['fold_id'];
                $sFoldTitle         = $aTemplateFolds[$f]['title'];

                $aUploadedContent   = $this->CI->batch->getBatchUploadedContent($iFoldId,$iCampaignBatchId);
                $aElementData       = $this->CI->batch->getElementDefaultData($iFoldId);

                if($aUploadedContent)
                {
                    foreach($aUploadedContent as $iIndex  =>  $aContentData)
                    {
                        $UploadedContent[$aContentData['element_position']]         = array('data' => $aContentData['element_data']);
                        $UploadedContent[$aContentData['element_position']]['type'] = $aContentData['element_name'];
                    }
                }

                if($aElementData)
                {
                    foreach($aElementData as $iIndex  =>  $aValue)
                    {
                        $UploadedContent[$aValue['element_position']]['attr'] = json_decode($aValue['element_data'],TRUE);
                        $UploadedContent[$aValue['element_position']]['type'] = $aValue['element_name'];
                    }
                }

                //TODO : Add this html into View
                $ApiImageRendering          = new ApiImageRendering();
                if($UploadedContent)
                {
                    $FileServerPath         = $ApiImageRendering->createJPEG($UploadedContent);
                    $imagePreviewUrl        = site_url($FileServerPath);
                    $previewHtml     = <<<HTML

                                        <div class='col-md-6'>
                                            <div class='img-sty-1'>
                                                <h3 class='text-center'> $sFoldTitle </h3>
                                                <img src="$imagePreviewUrl">
                                            </div>
                                        </div>
HTML;

                $aTotalFoldsPreviews    .=  $previewHtml;
            }

                # Update Last Generated Data according to batch uploaded content.
                $LastGeneratedPreview[]   =  array('file_server_path'=> './'.$FileServerPath, 'fold_id'=>$iFoldId,'fold_title'=>$sFoldTitle);

                unset($UploadedContent);
            }
        }

        if($LastGeneratedPreview)
        {
            if($Preview_Data = json_encode($LastGeneratedPreview,true))
            {
                $this->CI->batch->saveLastGeneratedPreview($iCampaignBatchId, $Preview_Data);
            }
        }

        return json_encode($aTotalFoldsPreviews,true);
    }

    function createBatch($aData = array())
    {
        $aPostedData = $aData ;

        if($aPostedData)
        {
            $sName                      = @$aPostedData['name'];
            $aDescription               = @$aPostedData['description'];
            $iBatchId                   = @$aPostedData['batch_id'];
            $iCampaignId                = @$aPostedData['campaign_id'];
            $aPostedData['isEditMode']  = ($iBatchId > 0) ? true : false;

            $aErrorMessages             = array();

            if( !validateId($iCampaignId) )
            {
                $aErrorMessages[] = ERROR_CAMPAIGN_ID_REQUIRED;   
            }
            if(empty($sName))
            {
                $aErrorMessages[] = ERROR_NAME_REQUIRED;
            }
            if(empty($aDescription))
            {
                $aErrorMessages[] = ERROR_DESC_REQUIRED;
            }

            #In case of any error
            if($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
                $this->result['batch_id']= '0';
                echo json_encode($this->result);
                exit;
            }

            //Returns batch id in both create and update cases
            $iBatchId = $this->CI->batch->createBatch($aPostedData);

            $this->result['status']  = true;
            $this->result['message'] = MSG_SUCCESS_BATCH_ADDED;
            $this->result['tab']     = '2';
            $this->result['batch_id']= "$iBatchId";

        }
        echo json_encode($this->result);  die;
    }

    
    function updateBatch($aData = array())
    {
        $aPostedData = $aData ;
        //d($aPostedData);
        if($aPostedData)
        {
            $sName                      = @$aPostedData['name'];
            $aDescription               = @$aPostedData['description'];
            $iBatchId                   = @$aPostedData['batch_id'];
            $iCampaignId                = @$aPostedData['campaign_id'];
            $aPostedData['isEditMode']  = true ;

            $aList                      = @json_decode($aPostedData['list'],true);
            $aPostedData['aList']       = $aList;
            
            $aErrorMessages             = array();

            if( !validateId($iCampaignId) )
            {
                $aErrorMessages[] = ERROR_CAMPAIGN_ID_REQUIRED;   
            }
            if(empty($sName))
            {
                $aErrorMessages[] = ERROR_NAME_REQUIRED;
            }
            if(empty($aDescription))
            {
                $aErrorMessages[] = ERROR_DESC_REQUIRED;
            }

            if(empty($aList))
            {
                $aErrorMessages[] = ERROR_CAMPAIGN_LIST_REQUIRED;
            }

            #In case of any error
            if($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
                $this->result['batch_id']= '0';
                echo json_encode($this->result);  die;
            }

            //Returns batch id in both create and update cases
            $iBatchId = $this->CI->batch->updateBatch($aPostedData);
            if($iBatchId)
            {
                $aPostedData['batch_id'] = $iBatchId;

                //delete all batches lists in case of update
                if($aPostedData['isEditMode'])
                {
                    $this->CI->batch->deleteBatchList($iBatchId);
                }

                if($this->CI->batch->createBatchList($aPostedData))
                {
                    if(!$aPostedData['isEditMode'])
                    {
                        $this->CI->campaign->setCount('IncreaseCampaignBatchCount',array('iCampaignId' => $iCampaignId));
                    }

                    $this->result['status']  = true;
                    $this->result['message'] = MSG_SUCCESS_BATCH_UPDATED;
                    $this->result['tab']     = '2';
                    $this->result['batch_id']= "$iBatchId";
                }
            }
        }
        echo json_encode($this->result);  die;
    }

    function setBatchTemplate($aData = array())
    {
        $hAngularResponseHTML           =   '';
        $AngularResponseObject          = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

        if($aData)
        {
            #Handling Data
            $iCampaignBatchId       =   @$aData['predefined_campaign_batch_id'];
            $iTemplateId            =   @$aData['template_id'];
            $iProductId             =   @$aData['product_id'];
            $iTemplateCuttOffPerod  =   $this->CI->batch->getTemplateCutOffPeriod($iTemplateId);

            $aErrorMessages         = array();

            if
            (
                        !validateId($iCampaignBatchId)
                or      !validateId($iTemplateId)
                or      !validateId($iProductId)
            )
            {$aErrorMessages[] = MSG_INVALID_ATTEMPT;   }

            #In case of any error
            if($aErrorMessages)
            {
                
                $this->result['message'] = $aErrorMessages;
                echo json_encode($this->result);
                exit;
            }

            $iSuccess   = $this->CI->batch->setBatchTemplate(__FUNCTION__,array('aData' => $aData,'isEditMode' => false) );

            if($iSuccess)
            {
                $AngularResponseObject['status']                    = TRUE;
                $AngularResponseObject['message']                   = 'Template set successfully.';
                $AngularResponseObject['tab']                       = '3';
                $AngularResponseObject['cuttOffPeriod']             = $iTemplateCuttOffPerod ;
            }
            else
            {
                $AngularResponseObject['status']                    = FALSE;
                $AngularResponseObject['message']                   = MSG_SOMETHING_WENT_WRONG;
            }
        }
        echo json_encode($AngularResponseObject);
        exit;
    }

    function getFoldElementsHTML ($aTemplateFoldsData = array(),$iTemplateId=0,$iCampaignBatchId=0)
    {
        /* =======================================================================
         * @author : Shoaib Ahmed Khan
         * variable used as unique javascript array index in elements_html  view    */
        global $jsArrayIndex;
        $jsArrayIndex = 0;
        /* ========================================================================  */

        $hFoldHtml = '';

        if(!empty($aTemplateFoldsData))
        {
            #   Validating Data
            if(isset($aTemplateFoldsData['aFolds']))
            {
                $iTotalFolds =  count($aTemplateFoldsData['aFolds']);

                #Getting All Folds
                $aFolds     = $aTemplateFoldsData['aFolds'];

                for($f=0; $f < $iTotalFolds; $f++)
                {
                    #Getting all Elements of this particular fold
                    if(isset($aFolds[$f]['elements']) && $aFolds[$f]['elements'])
                    {
                        #Fetch all elements data of a Fold
                        $aElements          =   $aFolds[$f]['elements'];
                        if($aElements)
                        {
                            $iTotalElements = count($aElements);
                            for($e=0; $e < $iTotalElements; $e++)
                            {
                                $Val              = '';
                                $aElement         = $aElements[$e];

                                $Value            = $this->CI->batch->getFoldElementsData(array('iFoldId'=>$aFolds[$f]['fold_id'], 'iTemplateId'=>$iTemplateId,'iCampaignBatchId'=>$iCampaignBatchId,'element_position'=>$aElement['element_position'],'element_id'=>$aElement['element_id']));

                                if(is_array($Value)) { $aElement['provided_data']      = '';}
                                else
                                {
                                    if($Value)
                                    {
                                        $aElement['provided_data']      = (string) $Value;
                                    }
                                    else
                                    {
                                        $aElement['provided_data']      = $Val;
                                    }
                                }
                                $aElements[$e] = $aElement;
                            }
                        }

                        $iTotalElements     =   count($aElements);

                        # If a single element exists
                        if($iTotalElements > 0 )
                        {
                            #Loading HTML View
                            $hFoldHtml          .=      $this->CI->load->view('folds/elements_html',array('isPredefined'=>true,'aElements'=>$aElements,'aFold' =>$aFolds[$f],'iTemplateId'=>$iTemplateId,'iCampaignBatchId'=>$iCampaignBatchId),TRUE);
                        }
                    }
                }
            }
        }

        return $hFoldHtml;
    }

    function ScheduleBatch($aData = array())
    {
        $aErrorMessages     = array();
        $dScheduleDate      = $dScheduleTime = "";
        $CampaignBatchId    = 0;

        if($aData)
        {
            if(isset($aData['campaign_batch_id']) and $aData['campaign_batch_id'])
            {
                $CampaignBatchId  = $aData['campaign_batch_id'];
            }
            else {$aErrorMessages[] = MSG_INVALID_ATTEMPT;}

            if(isset($aData['schedule_date']) and $aData['schedule_date'])
            {
                $aData['schedule_date'] = date(DATE_ONLY_FORMAT_MYSQL,strtotime($aData['schedule_date']));
            }
            else {$aErrorMessages[] = "Please select a valid Date";}

           /* if(isset($aData['schedule_time']) and $aData['schedule_time'])
            {
                $aData['schedule_time']  = date('G:i',strtotime($aData['schedule_time']));
            }
            else {$aErrorMessages[] = "Please select a valid Time Format";}*/

        }

        // Suppose 5 days
        $aData['iCutOffPeriod']         =   $this->CI->batch->getCutOffPeriod($CampaignBatchId);

        $aLeastCutOffDate               =   strtotime('+'.$aData['iCutOffPeriod'].' day', time());
        $dScheduleDate                  =   strtotime($aData['schedule_date']); // or your date as well

        //    5 < 5
        if($dScheduleDate < $aLeastCutOffDate)
        {
            $aErrorMessages[] = "Sorry..! Atleast ".$aData['iCutOffPeriod'].' Day(s) are required by printers.';
        }

        #In case of any error
        if($aErrorMessages)
        {
            $this->result['message'] = $aErrorMessages;
        }
        else
        {
            $this->result['status']         =   TRUE;
            $this->result['rows_updated']   =   $this->CI->batch->ScheduleBatch(__FUNCTION__,array('aData' => $aData,'isEditMode' => false) );
            $this->result['message']        =   "Schedule successfully.";
            $this->result['tab']            =   '6';
            
            
        }

        echo json_encode($this->result);
        exit;
    }

    public function getPredefinedBatchSummary($aData = array())
    {
        $CampaignBatchId            = $aData['predefined_campaign_batch_id'];
        $UserBatchId                = $aData['campaign_batch_id'];

        $BatchData          = $this->CI->batch->getPredefinedBatchSummary($CampaignBatchId,$UserBatchId);
        $sSummary           = $this->CI->load->view('batches/summary',array('aSummaryData'=>$BatchData),TRUE);

        $this->result['status']         =   TRUE;
        $this->result['data']           =   json_encode($sSummary,TRUE);
        $this->result['message']        =   "Summary generated.";

        echo json_encode($this->result);
        exit;
    }

    function downloadBatchContent($aData = array())
    {
        $aErrorMessages = array();

        #Perform Data Validation
        if($aData)
        {
            if(isset($aData['campaign_batch_id']) and $aData['campaign_batch_id'])
            {
                $CampaignBatchId  = $aData['campaign_batch_id'];
            }
            else {$aErrorMessages[] = MSG_INVALID_ATTEMPT;}
        }

        #In case of any error
        if($aErrorMessages)
        {
            echo  json_encode($this->result['message'] = $aErrorMessages);
            exit;
        }

        $zipname = time().'_'.$CampaignBatchId.'_BatchContent.zip';

        $sDefaultContent        = 'Default Content';
        $sUploadedContent       = 'Uploaded Content';
        $sGeneratedPreview      = 'Generated Preview';
        $sLists                 = 'Lists';


        $Folders = array(
                            $sDefaultContent,
                            $sUploadedContent,
                            $sGeneratedPreview,
                            $sLists,
                        );

        # delete file if exists any older file
        if (file_exists('./'.$zipname)) { unlink ('./'.$zipname); }

        # Download
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        # Add Each Folder and file types according to folder functionlaity
        foreach($Folders as $Folder)
        {
            $zip->addEmptyDir($Folder);

            if          ($Folder == $sUploadedContent)
            {
                $files              = $this->CI->batch->DownloadBatchContent($CampaignBatchId);

                if($files)
                {
                    $UploadedContent    = array();

                    if($files)
                    {
                        foreach($files as $k => $aFile)
                        {
                            $UploadedContent[ (string) $aFile['file_server_path']] = (string) $aFile['file_name'];
                        }
                    }

                    foreach ($UploadedContent as $k => $file)
                    {
                        $zip->addFile( (string)$k, (string) $Folder.'/'.$file);
                    }
                }
            }
            else    if  ($Folder == $sDefaultContent)
            {
                $DefaultFiles       = $this->CI->batch->DownloadDefaultContent($CampaignBatchId);

                $DefaultContent    = array();

                if($DefaultFiles)
                {
                    foreach($DefaultFiles as $k => $aFile)
                    {
                        $DefaultContent[ (string) $aFile['file_server_path']] = (string)str_replace(' ', '', $aFile['file_name']);
                    }
                }

                foreach ($DefaultContent as $k => $file)
                {
                    $zip->addFile( (string)$k, (string) $Folder.'/'.$file);
                }
            }
            else    if  ($Folder == $sGeneratedPreview)
            {
                $PreviewFiles       = $this->CI->batch->getLastGeneratedPreview($CampaignBatchId);
                $PreviewFiles       = json_decode($PreviewFiles,true);
                $DefaultContent    = array();

                if($PreviewFiles)
                {
                    foreach($PreviewFiles as $k => $aFile)
                    {
                        $FileServerPath = $aFile['file_server_path'];
                        $FoldTitle      = $aFile['fold_title'];
                        $FoldId         = $aFile['fold_id'];

                        $DefaultContent[ (string) $FileServerPath ]= (string) str_replace(' ', '', $FoldTitle.'_'.$FoldId.'.jpg');
                    }
                }

                #Adding File to Zip archives from location with a new name
                foreach ($DefaultContent as $k => $file)
                {
                    $zip->addFile( (string)$k, (string) $Folder.'/'.$file);
                }
            }
            else    if  ($Folder == $sLists)
            {
                $BatchLists         =   $this->CI->batch->getBatchLists($CampaignBatchId);
                if($BatchLists)
                {
                    $aListsFiles    =   $this->ExportBatchLists(__FUNCTION__,$BatchLists,$CampaignBatchId);

                    $ListContent    = array();

                    if($aListsFiles)
                    {
                        foreach($aListsFiles as $k => $aFile)
                        {
                            $ListContent[ (string) $aFile['file_server_path']] = (string)str_replace(' ', '', $aFile['file_name']);
                        }
                    }

                    #Adding File to Zip archives from location with a new name
                    foreach ($ListContent as $k => $file)
                    {
                        $zip->addFile( (string)$k, (string) $Folder.'/'.$file);
                    }
                }
            }
        }

        #Finish $ Close Writing Zip File
        $zip->close();

        #Check File If exists on root
        if (file_exists('./'.$zipname))
        {
            // Move to folder named download_contet
            if(rename($zipname, BATCH_CONTENT_ZIP_FOLDER.$zipname))
            {
                #Return proper download URL
                $data = array
                (
                    'url'       => site_url(BATCH_CONTENT_ZIP_FOLDER.$zipname),
                    'status'    => true,
                );
                echo json_encode($data);
                exit;
            }
        }
        echo json_encode($this->result);
        exit;
    }


    function ExportBatchLists($callFrom = '',$aLists = array(),$CampaignBatchId)
    {
        $aExportedFiles = $Files = array();
        

        if($aLists)
        {
            $iTotalLists = count($aLists);

            if($iTotalLists)
            {
                for( $L = 0;   $L < $iTotalLists; $L ++)
                {
                    $aListContacts =  $this->CI->list->getAllContactsOfList($aLists[$L]['list_id']);

                    if($aListContacts)
                    {
                        
                        $CI->load->library('phpexcel');
                        $CI->load->library('PHPExcel/iofactory');

                        $objPHPExcel = new PHPExcel();
                        $objPHPExcel->setActiveSheetIndex(0);

                        $objPHPExcel->getActiveSheet()->setTitle($aLists[$L]['list_title']);

                        $HeadersArray = array(
                                                'A1'    =>  'First Name',
                                                'B1'    =>  'Last Name',
                                                'C1'    =>  'Printed Name',
                                                'D1'    =>  'Business Name',
                                                'E1'    =>  'Address',
                                                'F1'    =>  'Country',
                                                'G1'    =>  'State',
                                                'H1'    =>  'City',
                                                'I1'    =>  'Zip',
                                                'J1'    =>  'Email',
                                                'K1'    =>  'Date Of Birth',
                                                'L1'    =>  'Phone',
                                                'M1'    =>  'Website',
                                                'N1'    =>  'Notes',
                                            );

                        foreach ($HeadersArray as $CellId => $ColName)
                        {
                            $objPHPExcel->getActiveSheet()->setCellValue($CellId, $ColName);
                            $objPHPExcel->getActiveSheet()->getStyle($CellId)->getFont()->setBold(true);
                        }

                        $iTotalContacts = count($aListContacts);

                        $rowCount = 2;

                        for( $c = 0;   $c < $iTotalContacts; $c ++)
                        {
                            $row        = $aListContacts[$c];

                            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['first_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['last_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['printed_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['business_name']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['address']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['country']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['state']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['city']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['zip']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $row['email']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $row['dob']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $row['phone']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $row['website']);
                            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $row['notes']);

                            // Increment the Excel row counter
                            $rowCount++;
                        }
                        
                        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                        
                        if($callFrom == 'SettleCuttOffBatches')
                        {
                            $serverPath = BATCH_FOLDER_SERVER_PATH;
                            $FileName = trim($CampaignBatchId.'_'.$aLists[$L]['list_id'].'.xlsx');
                            $objWriter->save($serverPath.$FileName);
                        }
                     else
                         {
                            $serverPath = LISTS_FOLDER_SERVER_PATH;
                            $FileName = trim(trim($aLists[$L]['list_title']).'_'.$aLists[$L]['list_id'].'.xlsx');
                            $objWriter->save($serverPath.$FileName);
                         }
                        
                        
                        $Files[] =  array('file_server_path' => $serverPath.$FileName,'file_name' => $FileName);
                        
                        
                        
                    }
                }
            }
        }
        return $Files;
    }
    
    function updateBatchStatus($aData = array())
    {
        //d($aData);
        $aPostedData = $aData;
         if($aPostedData)
        {
            $status                     = @$aPostedData['status'];
            $comments                   = @$aPostedData['comments'];
            $iBatchId                   = @$aPostedData['campaign_batch_id'];
            
            $aErrorMessages             = array();

            if(empty($iBatchId))
            {
                $aErrorMessages[] = ERROR_BATCH_ID_REQUIRED;
            }
            if(empty($status))
            {
                $aErrorMessages[] = ERROR_INVALID_BATCH_STATUS;
            }
            if(empty($comments))
            {
                $aErrorMessages[] = ERROR_BATCH_COMMENTS_REQUIRED;
            }
            

            

            #In case of any error
            if($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
            }
            
            else if($this->CI->batch->createBatchLog($aPostedData))
            {
                $this->result['message']    = 'Success';
                $this->result['status']     =  true;
            
            }
            
            echo json_encode($this->result);  die;
            
            
            
        }    
    }


    function delete($aData= array())
    {
        if($this->CI->batch->deleteBatch($aData['iBatchId']))
        {
            $this->result['status']     = true;
            $this->result['message']    = CAMPAIGN.' deleted successfully.';
        }
        else
        {
            $this->result['message']    = CAMPAIGN.' delete failed.';
        }
        return $this->result;
    }






    /*
     * Umair Ahmed
     * This function save User List of batches which are predefined by admin as a template and linked to user packages.
     */

    function createUserBatch($aData = array())
    {

        $aErrorMessages             =   array();
        $CampaignId                 =   $iBatchId   =   $iUserId    =  0;
        $aList                      =   @json_decode($aData['list'],true);
        $aData['aList']             =   $aList;
        $iUserBatchId               =   $aData['user_batch_id'];
        $iTemplateId                =   $aData['template_id'];

        if($aData)
        {
            if(isset($aData['predefined_campaign_id']) and $aData['predefined_campaign_id'])
            {
                $CampaignId     = $aData['predefined_campaign_id'];
            }else {$aErrorMessages[] = MSG_INVALID_ATTEMPT;}

            if(isset($aData['predefined_campaign_batch_id']) and $aData['predefined_campaign_batch_id'])
            {
                $iBatchId       = $aData['predefined_campaign_batch_id'];
            }else {$aErrorMessages[] = MSG_INVALID_ATTEMPT;}

            if(isset($aData['user_id']) and $aData['user_id'])
            {
                $iUserId       = $aData['user_id'];
            }else {$aErrorMessages[] = MSG_INVALID_ATTEMPT;}

            if(isset($aData['template_id']) and $aData['template_id'])
            {
                $iUserId       = $aData['template_id'];
            }else {$aErrorMessages[] = MSG_INVALID_ATTEMPT;}

            if(empty($aList))
            {
                $aErrorMessages[] = ERROR_CAMPAIGN_LIST_REQUIRED;
            }
        }

        #In case of any error
        if($aErrorMessages)
        {
            $this->result['message']    =   $aErrorMessages;
        }
        else
        {
            $aData['isEditMode']        = ($iUserBatchId > 0) ? true : false;

            //Returns batch id in both create and update cases
            $iBatchId               = $this->CI->batch->createUserBatch($aData);

            $aData['user_batch_id'] = $iBatchId;

            if($aData['isEditMode'])
            {
                $this->CI->batch->deleteBatchList($iBatchId);
            }

            if($this->CI->batch->createBatchList($aData))
            {
                $aTemplateFoldsData             =   $this->CI->batch->getTemplateFoldsData($iTemplateId);

                if($aTemplateFoldsData)
                {
                    $aFieldHtml                 =   $this->getFoldElementsHTML($aTemplateFoldsData,$iTemplateId,$iBatchId);
                    $Data['aTemplateFoldsData'] =   $aTemplateFoldsData;
                    $Data['fieldHtml']          =   $aFieldHtml;
                    $hAngularResponseHTML       =   $this->CI->load->view('batches/upload_content',$Data,TRUE);
                }

                $this->result['status']                     =   TRUE;
                $this->result['aFoldData']                  =   $aTemplateFoldsData['aFolds'];
                $this->result['message']                    =   'Lists Saved  successfully.';
                $this->result['tab']                        =   '3';
                $this->result['hUploadContentHTML']         =   json_encode($hAngularResponseHTML,true);
                $this->result['batch_id']                   =   "$iBatchId";
            }
        }

        echo json_encode($this->result);
        exit;
    }


    function getTemplateFoldsData($aData = array())
    {
        $hAngularResponseHTML           =   '';
        $AngularResponseObject          = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

        if($aData)
        {
            #Handling Data
            $iTemplateId            = $aData['template_id'];
            $iCampaignBatchId       = $aData['predefined_campaign_batch_id'];

            $aErrorMessages         = array();

            if
            (
                        !validateId($iTemplateId)
                or      !validateId($iCampaignBatchId)
            )
            {$aErrorMessages[] = MSG_INVALID_ATTEMPT;   }

            #In case of any error
            if($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
                echo json_encode($this->result);
                exit;
            }

            $aTemplateFoldsData             =   $this->CI->batch->getTemplateFoldsData($iTemplateId);

            if($aTemplateFoldsData)
            {
                $aFieldHtml                 =   $this->getFoldElementsHTML($aTemplateFoldsData,$iTemplateId,0);
                $Data['aTemplateFoldsData'] =   $aTemplateFoldsData;
                $Data['fieldHtml']          =   $aFieldHtml;
                $hAngularResponseHTML       =   $this->CI->load->view('batches/upload_content',$Data,TRUE);
            }

            $AngularResponseObject['status']                    = TRUE;
            $AngularResponseObject['aFoldData']                 = $aTemplateFoldsData['aFolds'];
            $AngularResponseObject['message']                   = 'Lists Saved  successfully.';
            $AngularResponseObject['tab']                       = '3';
            $AngularResponseObject['hUploadContentHTML']        = json_encode($hAngularResponseHTML,true);
        }

        echo json_encode($AngularResponseObject);
        exit;
    }
}