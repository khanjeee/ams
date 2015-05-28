<?php

class ApiRegister {
	/*
	 * Initializing Class Variables
	 */

	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array()) {
		$this->data = $Data;
	}

   
	public function addSubscriber($aData= array())
    {
        //d($aData);
         $aPostedData   = $aData ;
           

        $CI = & get_instance();
        $CI->load->model('user_model','users');
        $CI->load->model('list_model','list');

      
        
        {
            //$aDataToSave                = array('aData' => $aData,'isEditMode' => false);
          
            $iUserId                 = $CI->users->addSubscriber(__FUNCTION__, $aPostedData);
            
			
			
			if($iUserId)
            {
				$Milestone = $this->hook_milestone($iUserId);
				
				$CI->list->addMasterList($iUserId);
				
                $this->result['status']     = true;
                $this->result['message']    = MSG_SUCCESS_SUBSCRBER_ADDED;
            }
        }
          
		return $this->result;
	}
	
	
	function hook_milestone($iUserId)
	{
		 $CI = & get_instance();
		 $CI->load->model('milestone_model','milestone');
		
		 $aMilestones =  $CI->milestone->getMilestoneByUserId(USER_ID_ADMINISTRATOR);
		
		 if(is_array($aMilestones) && !empty($aMilestones))
		 {
			foreach ($aMilestones as $key => $value) 
			{
				$task =   $CI->milestone->getMilestoneByMilestoneId($value->milestones_id);
				  if($task)
				  {
					    $aMilestones[$key]->task = $task;
				  }
				
			}
		 }
		 
		
		 if(is_array($aMilestones) && !empty($aMilestones))
		 {
			 return $CI->milestone->CopyMilestoneByNewUserId($aMilestones,$iUserId);
		 }
	}
        
    function updateSubscriberStaus($aData= array())
    {
           
         $CI = & get_instance();
         $CI->load->model('user_model','users');
         
         if($CI->users->updateSubscriberStaus($aData))
                {
                 $this->result['status']     = true;
                 $this->result['message']    = 'Subscriber successfully verified';
                }
         
        return $this->result;   
         
        }

		
		
	function UpdateUserInfo($aData = array())
	{
		
		 $aErrorMessages = array();
			#OldUserInfo 
			$aOldUserInfo		= $aData['OldUserInfo'];  
				
			
			#Basic Info
			$aBasicInfo				= $aData['data'];   
			$sFirstName				= $aBasicInfo['first_name'];
            $sLastName				= $aBasicInfo['last_name'];
			
			
			
			if(!empty($aBasicInfo['old_password']) && empty($aBasicInfo['password']))
			{
				$aErrorMessages[] = ERROR_PASSWORD_NEW_PASSWORD_REQUIRED;
			}else
			{
				if(isset($aBasicInfo['password']) && empty($aBasicInfo['password']))
				{
					unset($aBasicInfo['password']);
					unset($aBasicInfo['old_password']);
				}
				else 
				{
					$sNewPassword			= md5($aBasicInfo['password']);	

					# Password Validations
					$sDBPassword		= $aOldUserInfo['password'];
					$sOldPassword		= md5($aBasicInfo['old_password']);
				}
			}
			
			
			
			
			
         
	
			
		
			#Mailing Info
			$aMailingInfo		= $aData['mailing']; 
            $sMailingAddress	= $aMailingInfo['address'];
            $sMailingCountry	= $aMailingInfo['country'];
            $sMailingCity		= $aMailingInfo['city'];
            $sMailingState		= $aMailingInfo['state'];
            $sMailingZipCode	= $aMailingInfo['zip_code'];
			$aMailingInfo['address_mailing'] = $aOldUserInfo['address_mailing'];
					
			#Billing Info
			$aBillingInfo		= $aData['billing'];  
            $sBillingAddress	= $aBillingInfo['address'];
            $sBillingCountry	= $aBillingInfo['country'];
            $sBillingCity		= $aBillingInfo['city'];
            $sBillingState		= $aBillingInfo['state'];
            $sBillingZipCode	= $aBillingInfo['zip_code'];
			$aBillingInfo['address_billing'] = $aOldUserInfo['address_billing'];
			
			
			
			

            if (!$sMailingAddress) 
			{
                $aErrorMessages[] = ERROR_ADDRESS_MAILING_REQUIRED;
			}
            if (!$sBillingAddress) 
			{
                $aErrorMessages[] = ERROR_ADDRESS_BILLING_REQUIRED;
            }
			
			
			
			
			if (!empty($sNewPassword)) 
			{
				#if password exists then check old insert and DB password match 
				if ($sDBPassword != $sOldPassword) 
				{
					$aErrorMessages[] = ERROR_PASSWORD_DONOT_MATCH;
				}
				else
				{
					 $aBasicInfo['password'] = $sNewPassword;
				}
            }
			
           
			
			
			
		
			#return Errors
			if ($aErrorMessages) 
			{	
				
				
				$this->result['message'] = $aErrorMessages;
				return $this->result;
			}
			
			if(isset($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']) && !empty($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']) )
			{
				#upload new image
				$aUploadImageResponce	=	UploadImage(USER_IMAGE,$aData);
				
				#remove old image from folder
				unlink(USER_IMAGE_UPLOAD_PATH.$aOldUserInfo['image']);
				$aBasicInfo['image']	= 	$aUploadImageResponce['file_name'];
			}
			
			$CI = & get_instance();
			$CI->load->model('user_model','users');
			$CI->load->model('address_model', 'address');
			
			
			$aAddressUpdate['aBillingInfo'] = $aBillingInfo;
			$aAddressUpdate['aMailingInfo'] = $aMailingInfo;
			
			#$CI->users->UpdateBasicInfo(__FUNCTION__, $aBasicInfo);
			
			$this->UpdateBasicInfo($aBasicInfo);
			
			
			$Updated = $CI->address->UpdateAddressById($aAddressUpdate);
				
			if($Updated)
			{
				
				$this->result = array('status' => TRUE, 'message' =>'Profile Updated successfully.');
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


}