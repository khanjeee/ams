<?php

class ApiCrm
{
	# Initializing Class Variables
	public $data    = array();
    public $result  = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
		$this->data = $Data;
    }



    function saveCrmMetaFields($aData = array())
    { 
      $CI = & get_instance();
      $CI->load->model('crm_model', 'crm');
	 
	  if($CI->crm->saveCrmMetaFields($aData))
	  {  
			$this->result['status']     = true;
			$this->result['message']    = 'Meta Fields Add successfully';
	  }  
		return $this->result;
    }
    function UpdateCrmMetaFields($aData = array())
    { 
      $CI = & get_instance();
      $CI->load->model('crm_model', 'crm');
	
	  if($CI->crm->UpdateCrmMetaFields($aData))
	  {  
			$this->result['status']     = true;
			$this->result['message']    = 'Meta Fields Update successfully';
	  }  
		return $this->result;
    }
	
	public function deleteCrmById($iUserCrmId=0)
    {
        $CI = & get_instance();
         $CI->load->model('crm_model', 'crm');
			if($CI->crm->deleteCrmById($iUserCrmId))
			{
				$this->result['status']     = true;
				$this->result['message']    = MSG_DELETE_SUCCESS;
			}
			else
			{
				$this->result['message']    = ERROR_DELETE_FAILURE;
			}
         return $this->result;
    }
	
	
	

}