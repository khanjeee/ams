<?php

class ApiWhiteLabel {
	/*
	 * Initializing Class Variables
	 */

	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array()) {
		$this->data = $Data;
	}

	
	
	function create($aData = array())
    {
		
		//d($aData);	
		
		#$aData			= $aData['whitelabel'];
		$bisEditMode	= $aData['bisEditMode'];
		$sTitle			= $aData['title'];
		$sDescription	= $aData['description'];
		$sEmailAddress  = $aData['email_address'];
		$sSolutionType  = $aData['solution_type'];
		$iPromotionCode	= $aData['promotion_code'];
		$sColorCode		= $aData['selected_theme'];
		$iWhiteLabelId	= $aData['whitelabel_id'];
		
		
			
		if($bisEditMode)
		{
			$aOldWhiteLabelData = $aData['aOldWhiteLabelData'];
		}
		
		
		$CI = & get_instance();
		$CI->load->model('whitelabel_model', 'whitelabel');
		$aErrorMessages = array();

		if (!$sTitle) 
		{
			$aErrorMessages[] = ERROR_TITLE_REQUIRED;
		}
		if (!$sDescription) 
		{
			$aErrorMessages[] = ERROR_DESC_REQUIRED;
		}
		if (!$sEmailAddress) 
		{
              $aErrorMessages[] = ERROR_EMAIL_REQUIRED;
        } 
		else 
		{
			if (!validateEmailAddress($sEmailAddress)) 
			{
				$aErrorMessages[] = ERROR_INVALID_EMAIL;
			}
        }
		if (!$sSolutionType) 
		{
			$aErrorMessages[] = ERROR_SOLUTION_TYPE_REQUIRED;
		}
		if (!$iPromotionCode) 
		{
			$aErrorMessages[] = ERROR_PROMO_CODE_REQUIRED;
		}
		if (!$sColorCode) 
		{
			$aErrorMessages[] = ERROR_COLOR_CODE_REQUIRED;
		}
		
		
		
		
		if($bisEditMode)
		{
			if(!empty($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']) )
			{
				
				$aUploadImageResponce = UploadImage(COMPANY_CREATED,$aData);
				unlink(WHITELABEL_LOGO_UPLOAD_PATH.$aOldWhiteLabelData['logo']);
			}
			else
			{
				$aUploadImageResponce['file_name'] = $aOldWhiteLabelData['logo'];
				
				
			
			}
		}
		else
		{
			if(!empty($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']) )
			{
				$aUploadImageResponce = UploadImage(COMPANY_CREATED,$aData);
			}
			else
			{
				$aErrorMessages[] = ERROR_IMAGE_REQUIRED;
			}
		}
		
		
		
		
		if($bisEditMode)
		{
			
			if($iPromotionCode == $aOldWhiteLabelData['promotion_code'])
			{
				if($iWhiteLabelId	=! $aOldWhiteLabelData['whitelabel_id'])
				{
					$aErrorMessages[] = ERROR_PROMOTION_CODE_EXISTS;
				}
			}
			else
			{
				# both promotion code diffrents. 
				$PromotionCodeExists = isPromotionCodeExists($iPromotionCode);
				
				if($PromotionCodeExists)
				{
						$aErrorMessages[] = ERROR_PROMOTION_CODE_EXISTS;
				}
			}
		}
		else
		{
			#creating mood true
			$PromotionCodeExists = isPromotionCodeExists($iPromotionCode);
			
			if($PromotionCodeExists)
			{
					$aErrorMessages[] = ERROR_PROMOTION_CODE_EXISTS;
			}
		}
		
		#return Errors
		if ($aErrorMessages) 
		{	
			$this->result['message'] = $aErrorMessages;
			return $this->result;
		}
		
		
			
			
			if($aUploadImageResponce)
			{
				$aData['logo']	= 	$aUploadImageResponce['file_name'];
				$iWhiteLabelId = $CI->whitelabel->createWhiteLabel(__FUNCTION__, $aData);
						
				if($iWhiteLabelId) 
				{
					
					if(!$bisEditMode)
					{
						@SendEmail(COMPANY_CREATED,$aData);
					}
					$this->result = array('status' => TRUE, 'message' =>'White Label Created successfully.');
				}
			}
			
		return $this->result;
	}
	

	function getAll($aData = array()) 
	{
		$CI = & get_instance();
		$CI->load->model('whitelabel_model', 'whitelabel');
		return $CI->whitelabel->getAllWhiteLabel($aData);
	}
	function delete($aData = array()) 
	{
		$iWhiteLabelId	 = $aData['iWhiteLabelId'];
		
		if($iWhiteLabelId > 0)
		{
                    $CI = & get_instance();
                    $CI->load->model('whitelabel_model', 'whitelabel');
                     return $CI->whitelabel->softDeleteWhiteLabel($iWhiteLabelId);
			/*
                        $CI = & get_instance();
			$CI->load->model('whitelabel_model', 'whitelabel');
			$aWhiteLabelInfo  = (array) $CI->whitelabel->getWhiteLabelId($iWhiteLabelId);
			if(is_array($aWhiteLabelInfo) && !empty($aWhiteLabelInfo))
			{
				unlink(COMPANY_LOGO_PATH.$aWhiteLabelInfo['logo']);
				return $CI->whitelabel->DeleteCompanyLogoById($iWhiteLabelId);
			}
                         
                         */
		}
		return false;
	}

}