<?php

class ApiPackage {
	/*
	 * Initializing Class Variables
	 */

	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array()) {
		$this->data = $Data;
	}

    function create($aData= array())
    {
        # Handling Given Data
        if($aData)      $aPackageData = $aData;
        else            $aPackageData = (array) $this->data;

        #If Given Data Exists
        if($aPackageData)
        {
            $aPackage               = $aPackageData['package'];

            # Must Required Fields
            $sPackageName           = $aPackage['title'];
            $sPackageDescription    = $aPackage['description'];
            $iPrice                 = intval($aPackage['price']);
            //$sStatus                = $aPackage['status'];
            //$sType                  = $aPackage['type'];

            $aErrorMessages         = array();

            if (!$sPackageName)
            {
                $aErrorMessages[] = PACKAGES.' '.ERROR_TITLE_REQUIRED;
            }

            if (!$sPackageDescription)
            {
                $aErrorMessages[] = PACKAGES.' '.ERROR_DESC_REQUIRED;
            }
            if (!$iPrice)
            {
                $aErrorMessages[] = PACKAGES.' '.ERROR_PRICE_REQUIRED;
            }

            if($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
                return $this->result;
            }

            $CI = & get_instance();
            $CI->load->model('package_model','package');

            # Create Package
            if($iPackageId  = $CI->package->createPackage(__FUNCTION__,$aPackageData ))
            {
                # Adding Newly Created PackageId into PackageData for further use
                $aPackageData['package_id']             =   $iPackageId;

                # Save Package-->Products
                $iProductSettled                        =   $CI->package->setPackageProducts(__FUNCTION__,$aPackageData );

                if($iProductSettled)
                {
                    # Save Products-->Templates
                    $iProductTemplatesSettled           =   $CI->package->setPackageProductTemplates(__FUNCTION__,$aPackageData );

                    if(isset($aPackageData['modules']) && count($aPackageData['modules']) > 0 )
                    {
                        $iProductTemplatesSettled           =   $CI->package->setPackageModules(__FUNCTION__,$aPackageData );
                    }

                    if($iProductTemplatesSettled)
                    {
                        # Hurray....!!!  -- Package Created Successfully...!
                        $this->result = array('status' => TRUE, 'message' => PACKAGES. ' created successfully.');
                    }
                }
            }
        }
        return $this->result;
    }

	/*function createPackage($aData= array())
    {
        if($aData)      $aPostedData = $aData;
        else            $aPostedData = (array) $this->data['data'];

		# Must Required Fields
		$sPackageName           = $aPostedData['title'];
		$sPackageDescription    = $aPostedData['description'];
		$iPrice                 = intval($aPostedData['price']);
        $sStatus                = $aPostedData['status'];
        $sType                  = $aPostedData['type'];

		$aErrorMessages         = array();

		if (!$sPackageName)
        {
			$aErrorMessages[] = PACKAGES.' '.ERROR_TITLE_REQUIRED;
		}

		if (!$sPackageDescription)
        {
			$aErrorMessages[] = PACKAGES.' '.ERROR_DESC_REQUIRED;
		}
		if (!$iPrice)
        {
			$aErrorMessages[] = PACKAGES.' '.ERROR_PRICE_REQUIRED;
		}

        if($aErrorMessages)
        {
            $this->result['message'] = $aErrorMessages;
            return $this->result;
        }

        $CI = & get_instance();
        $CI->load->model('package_model');

        #User is editing his own profile after login
        if(getUserRoleById() == ROLE_ID_ADMINISTRATOR)
        {
            $aDataToSave                = array('aData' => $aPostedData,'isEditMode' => false);
            $iPackageId                 = $CI->package_model->savePackageInfo(__FUNCTION__,$aDataToSave );

            if($iPackageId)
            {
                $this->result['status']     = true;
                $this->result['message']    = PACKAGES.' '.'created successfully.';
            }
        }

		return $this->result;
	}*/

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
	
	
    function delete($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('package_model','package');
        
        if($CI->package->deletePackagById($aData['iPackageId']))
        {
            $this->result['status']     = true;
            $this->result['message']    = PACKAGES.' deleted successfully.';
        }
        else
        {
            $this->result['message']    = PACKAGES.' delete failed.';
        }
        
        return $this->result;
    }
    
    function getAll($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('package_model','package');

        return $CI->package->getAllPackages($aData);
    }

    function getPromoCodePackages($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('package_model','package');

        $aPackages = $CI->package->loadPromotionCodePackages(trim($aData['iPromotionCode']));

        if($aPackages)
        {
            for($p=0; $p < count($aPackages); $p++)
            {
                $aPackages[$p]['image'] = '';

                $Image =  $CI->package->getPackageImage($aPackages[$p]['package_id']);
                if($Image)
                {
                    $aPackages[$p]['image'] = site_url($Image);
                }
            }
        }

        return $aPackages;
    }


    function getWhiteLabelPackages($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('package_model','package');

        $data['aPackages'] = $CI->package->loadPromotionCodePackages(trim($aData['iPromotionCode']));

        echo  $CI->load->view('packages/ajax_get_whitelabel_packages',$data,TRUE);
        exit;
    }

    function ajax_get_white_labels($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('whitelabel_model','whitelabel');

        $data['aSolutions'] = $CI->whitelabel->getAllWhiteLabel(array(ACTION_RECORD_COUNT=>0));

        echo  $CI->load->view('packages/'.__FUNCTION__,$data,TRUE);
        exit;
    }

}