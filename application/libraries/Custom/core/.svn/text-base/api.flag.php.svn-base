<?php

class ApiFlag
{
	# Initializing Class Variables
	public $data    = array();
    public $result  = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
		$this->data = $Data;
    }


        
   public function create($aPostedData= array())
   {
	   
	    $sTitle				= $aPostedData['title'];
	   	$iUserId			= getLoggedInUserId();
		$isEditMode			= $aPostedData['isEditMode'];
		
		 $sMessage = ($aPostedData['isEditMode']) ?  MSG_SUCCESS_FALG_UPDATED : MSG_SUCCESS_FLAG_ADDED;
	   	$aErrorMessages = array();
	   
		$CI = & get_instance();
		$CI->load->model('flag_model','flag');
		$aFlag = $CI->flag->getFlagByTitleAndUserId($iUserId,$sTitle);
		
	    if (!$sTitle)
        {
              $aErrorMessages[] = ERROR_TITLE_REQUIRED;
        }
		if($aFlag)
		{
			$aErrorMessages[] = ERROR_FLAG_ALREADY_EXISTS;
		}

		#return Errors
		if ($aErrorMessages) 
		{	
			$this->result['message'] = $aErrorMessages;
			return $this->result;
		}
		
        $iFlagId   =  $CI->flag->create($aPostedData);            
		if($iFlagId)
		{
		   $this->result['status']     = true;
		   $this->result['message']    = $sMessage ;
		}
		return $this->result;
	} 
	
	
	 public function deleteFlagById($iFlagId=0)
    {
        $CI = & get_instance();
       	$CI->load->model('flag_model','flag');
               
                    if($CI->flag->deleteFlagById($iFlagId))
                    {
						$this->result['status']     = true;
                        $this->result['message']    = MSG_DELETE_SUCCESS;
                    }
                    else
                    {
						$this->result['status']     = false;
                        $this->result['message']    = ERROR_DELETE_FAILURE;
                    }
            
        
        
        return $this->result;
    }
}