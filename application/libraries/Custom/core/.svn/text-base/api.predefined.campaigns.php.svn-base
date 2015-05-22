<?php

class ApiPredefinedCampaigns
{
	# Initializing Class Variables
	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
		$this->data = $Data;
	}

	function create($aData= array())
    {
        if($aData)      $aPostedData = $aData;
        else            $aPostedData = (array) $this->data['data'];

		# Must Required Fields
		$sCampaignTitle             = $aPostedData['title'];
        $sCampaignDescription       = $aPostedData['description'];

		$aErrorMessages         = array();

		if (!$sCampaignTitle)
        {
			$aErrorMessages[] = CAMPAIGN.' '.ERROR_TITLE_REQUIRED;
		}

		if (!$sCampaignDescription)
        {
			$aErrorMessages[] = CAMPAIGN.' '.ERROR_DESC_REQUIRED;
		}

        if($aErrorMessages)
        {
            $this->result['message'] = $aErrorMessages;
            return $this->result;
        }

        $CI = & get_instance();
        $CI->load->model('predefined_campaign_model','predefined_campaign');

        if(getUserRoleById() == ROLE_ID_SUBSCRIBER or getUserRoleById() == ROLE_ID_ADMINISTRATOR)
        {
            $aDataToSave                    = array('aData' => $aPostedData,'isEditMode' => false);
            $iCampaignId                    = $CI->predefined_campaign->createCampaign(__FUNCTION__,$aDataToSave );

            if($iCampaignId)
            {
                $this->result['status']         = true;
                $this->result['iCampaignId']    = $iCampaignId;
                $this->result['message']        = CAMPAIGN.' '.'created successfully.';
            }
        }

		return $this->result;
	}

    function UpdateBasicInfo($CoreBasicInfo = array())
    {
        $CI = & get_instance();
        $CI->load->model('user_model','users');

        $SessionData                = getLoggedInUserData();
        $SessionData['first_name']  = $CoreBasicInfo['first_name'];
        $SessionData['last_name']   = $CoreBasicInfo['last_name'];
        $CI->session->set_userdata(SESS_USERDATA, $SessionData);
        $SessionData = getLoggedInUserData();

        return $CI->users->UpdateBasicInfo(__FUNCTION__, $CoreBasicInfo);
    }


    function SaveUserProfile($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('user_model','users');

        if($CI->users->SaveUserInfo(__FUNCTION__,$aData))
        {
            $this->result['status']     = true;
            $this->result['message']    = lang('ApiAdmin_ProfileUpdateSuccessfully');
        }

        return $this->result;
    }

    function getAll($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('package_model','package');
        
        return $CI->package->getAllPackages($aData);
        
    }

    function delete($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('predefined_campaign_model','predefined_campaign');

        if($CI->predefined_campaign->deleteCampaignById($aData['iCampaignId']))
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


    function updateCampaign($aPostedData = array())
    {
        # Must Required Fields
        $sCampaignTitle             = $aPostedData['title'];
        $sCampaignDescription       = $aPostedData['description'];

        $aErrorMessages             = array();

        if (!$sCampaignTitle)
        {
            $aErrorMessages[] = CAMPAIGN.' '.ERROR_TITLE_REQUIRED;
        }

        if (!$sCampaignDescription)
        {
            $aErrorMessages[] = CAMPAIGN.' '.ERROR_DESC_REQUIRED;
        }

        if($aErrorMessages)
        {
            $this->result['message'] = $aErrorMessages;
            return json_encode($this->result);
        }

        $CI = & get_instance();
        $CI->load->model('predefined_campaign_model','predefined_campaign');

        if(getUserRoleById() == ROLE_ID_SUBSCRIBER or getUserRoleById() == ROLE_ID_ADMINISTRATOR)
        {
            $aDataToSave                    = array('aData' => $aPostedData,'isEditMode' => true);
            $bUpdated                       = $CI->predefined_campaign->createCampaign(__FUNCTION__,$aDataToSave );

            if($bUpdated)
            {
                $this->result['status']         = true;
                $this->result['message']        = CAMPAIGN.' '.'updated successfully.';
                $this->result['aData']          = $aPostedData;
            }
        }

        return json_encode($this->result);
    }


    function savePreDefinedCampaign($aData = array())
    {
        $result = $aErrorMessages = array();

        if($aData)
        {
            $iWhiteLabelId          =    $aData['whitelabel_id'];
            $iPackageId             =    $aData['package_id'];
            $iCampaignId            =    $aData['predefined_campaign_id'];
            $iBatchId               =    $aData['predefined_campaign_batch_id'];
            $iProductId             =    $aData['product_id'];
            $iTemplateId            =    $aData['template_id'];

            if
            (
                        !validateId($iWhiteLabelId)
                or      !validateId($iPackageId)
                or      !validateId($iCampaignId)
                or      !validateId($iTemplateId)
                or      !validateId($iProductId)
                or      !validateId($iBatchId)

            )
            {$aErrorMessages[] = MSG_INVALID_ATTEMPT;   }

            #In case of any error
            if($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
                return $this->result;
            }

            $CI = & get_instance();
            $CI->load->model('predefined_campaign_model','campaign');

            $iSuccess   = $CI->campaign->savePreDefinedCampaign(__FUNCTION__,array('aData' => $aData,'isEditMode' => false) );

            if($iSuccess)
            {
                $result['status']                    = TRUE;
                $result['message']                   = 'Template set successfully.';
            }
            else
            {
                $result['status']                    = FALSE;
                $result['message']                   = MSG_SOMETHING_WENT_WRONG;
            }
        }

        echo json_encode($result);
        exit;
    }

    function makeDeepCopy($iUserBatchId = 2 )
    {
        define('DEEP_COPY_CREATE_CAMPAIGN',         'createCampaign');
        define('DEEP_COPY_CREATE_BATCH',            'createBatch');
        define('DEEP_COPY_SET_BATCH_LISTS',         'setBatchLists');
        define('DEEP_COPY_UPLOAD_CONTENT',          'uploadContent');
        define('DEEP_COPY_DELETE_USER_BATCH',       'deleteUserBatchOnSucess');

        # Variable Initialization
        $DeepCopySuccess    =   false;
        $aUserBatchData     =   $Ids    =   array();

        # Validating $iUserBatchId
        $iUserBatchId       =   intval($iUserBatchId);

        #If Valid --> Algorithm Started
        if($iUserBatchId)
        {
            $CI = & get_instance();
            $CI->load->model('predefined_batch_model','predefined_batch');

            $aUserBatchData                     =   $CI->predefined_batch->getUserBatchById($iUserBatchId);
            $Ids['iUserBatchId']                =   $iUserBatchId;

            #If UserBatch Exists Proceed Forward
            if($aUserBatchData)
            {
                # Deep Copy -- Steps Initialization
                $aDeepCopySteps = array
                (
                    DEEP_COPY_CREATE_CAMPAIGN,
                    DEEP_COPY_CREATE_BATCH,
                    DEEP_COPY_SET_BATCH_LISTS,
                    DEEP_COPY_UPLOAD_CONTENT,
                    DEEP_COPY_DELETE_USER_BATCH,
                );

                if($aDeepCopySteps)
                {
                    $iNewCampaignId     = $iNewBatchId = 0;

                    foreach($aDeepCopySteps as $sStep)
                    {
                        if($sStep == DEEP_COPY_CREATE_CAMPAIGN)
                        {
                            $iNewCampaignId         =   $this->saveCampaign($iUserBatchId,array('aUserBatch'=>$aUserBatchData));
                            $Ids['iNewCampaignId'] =   $iNewCampaignId;
                        }
                        else if($sStep == DEEP_COPY_CREATE_BATCH && $iNewCampaignId > 0)
                        {
                            $iNewBatchId            =   $this->saveBatch($iNewCampaignId,array('aUserBatch'=>$aUserBatchData));
                            $Ids['iNewBatchId']     =   $iNewBatchId;
                        }
                        else if($sStep == DEEP_COPY_SET_BATCH_LISTS && $iNewCampaignId > 0 && $iNewBatchId > 0)
                        {
                            $iListSaved             =   $this->saveBatchLists($iUserBatchId,$iNewCampaignId,$iNewBatchId,array('aUserBatch'=>$aUserBatchData));
                            $Ids['iListSaved']      =   $iListSaved;
                        }
                        else if($sStep == DEEP_COPY_UPLOAD_CONTENT && $iNewCampaignId > 0 && $iNewBatchId > 0 && $iListSaved > 0)
                        {
                            $iRecordSaved           =   $this->saveUploadedContent($Ids,array('aUserBatch'=>$aUserBatchData));
                            $Ids['iContentSaved']   =   $iRecordSaved;
                        }
                        else if($sStep == DEEP_COPY_DELETE_USER_BATCH && $iNewCampaignId > 0 && $iNewBatchId > 0 && $iListSaved > 0 && $iRecordSaved > 0)
                        {
                            if($CI->predefined_batch->deleteUserBatch($iUserBatchId))
                            {
                                $DeepCopySuccess = true;
                            }
                        }
                    }
                }
            }
        }

        echo json_encode(array('status'=>$DeepCopySuccess,'iUserBatchDeleted' => $iUserBatchId));
        exit;
    }

    #Step One Algo
    function saveCampaign($iUserBatchId=0,$data = array())
    {
        $iCampaignId = 0;

        $CI = & get_instance();
        $CI->load->model('predefined_batch_model','predefined_batch');
        $CI->load->model('predefined_campaign_model','predefined_campaign');
        $CI->load->model('campaign_model','campaign');
        $iCampaignId = $CI->predefined_batch->checkCampaignMapping($iUserBatchId);
        
        if(empty($iCampaignId))
        {
            //getting user bath data for creating campaign
            $userBatchData = $data['aUserBatch'];

            //creating new campaign
            $aPredefinedCampaign = $CI->predefined_campaign->getCampaignByid($userBatchData->predefined_campaign_id);

            //campaign to be created
            $aCampaignData['isEditMode']             = false;
            $aCampaignData['aData']['title']         = $aPredefinedCampaign['title'];
            $aCampaignData['aData']['description']   = $aPredefinedCampaign['description'];

            //Create Campaign
            $iCampaignId = $CI->campaign->createCampaign(__FUNCTION__,$aCampaignData);

            //creating entry in mapping table
            $aData['predefined_campaign_id']    = $userBatchData->predefined_campaign_id;
            $aData['campaign_id']               = $iCampaignId;

            //make entry in campaign mapping table
            $CI->predefined_batch->createCampaignMapping($aData);
        }
        return $iCampaignId;
    }

    #Step Two Algo
    function saveBatch($iFinalCampaignId=0,$data = array())
    {
        $iBatchId       = 0;
        $aUserBatchData = $data['aUserBatch'];

        $iPD_CampaignBatchId = (int) $aUserBatchData->predefined_campaign_batch_id;

        if($iPD_CampaignBatchId > 0 )
        {
            $CI = & get_instance();
            $CI->load->model('predefined_batch_model',          'predefined_batch');
            $CI->load->model('predefined_campaign_model',       'predefined_campaign');

            $aPD_BatchInfo  = $CI->predefined_batch->BatchInfo($iPD_CampaignBatchId);

            if($aPD_BatchInfo)
            {
                $aCreateBatch      = array
                (
                    'user_id'               =>      getLoggedInUserId(),
                    'batch_title'           =>      $aPD_BatchInfo->batch_title,
                    'batch_description'     =>      $aPD_BatchInfo->batch_description,
                    'campaign_id'           =>      $iFinalCampaignId,
                    'product_id'            =>      $aPD_BatchInfo->product_id,
                    'template_id'           =>      $aPD_BatchInfo->template_id,
                    'schedule_date'         =>      $aPD_BatchInfo->schedule_date,
                    'cut_off_date'          =>      $aPD_BatchInfo->cut_off_date,
                    'last_preview_images'   =>      $aUserBatchData->last_preview_images,
                    'total_printing_cost'   =>      $aUserBatchData->total_printing_cost,
                    'current_status'        =>      BATCH_IS_IN_EDIT_MODE,
                    'created_on'            =>      date(DATE_FORMAT_MYSQL),
                    'created_by'            =>      getLoggedInUserId(),

                );

                return $CI->predefined_campaign->DeepCopy_CreateBatch((object) $aCreateBatch);
            }
        }
        return 0;
    }

    #Step Three Algo
    function saveBatchLists($iUserBatchId,$iNewCampaignId=0,$iNewBatchId,$data = array())
    {
        $CI = & get_instance();
        $CI->load->model('predefined_batch_model',          'predefined_batch');
        $CI->load->model('batch_model',                     'default_batch');

        $aBatchLists = $CI->predefined_batch->getBatchLists($iUserBatchId);

        $aCreateList = array
        (
            'aList'             =>  $aBatchLists,
            'batch_id'          =>  $iNewBatchId,
            'campaign_id'       =>  $iNewCampaignId,
        );

        $iTotalListSaved = $CI->default_batch->createBatchList($aCreateList);

        if($iTotalListSaved)    return $iTotalListSaved;
        else                    return 0;
    }

    #Step Four Algo
    function saveUploadedContent($Ids,$aData = array())
    {
        $iUserBatchId = $Ids['iUserBatchId'];
        $iNewBatchId = $Ids['iNewBatchId'];

        $CI = & get_instance();
        $CI->load->model('predefined_campaign_model',       'predefined_campaign');

        $aUploadedContent =  $CI->predefined_campaign->DeepCopy_getBatchUploadedContent($iUserBatchId);

        if($aUploadedContent)
        {
            return $CI->predefined_campaign->DeepCopy_setBatchUploadedContent($iNewBatchId, (object) $aUploadedContent);
        }
        return 0;
    }
}