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
}