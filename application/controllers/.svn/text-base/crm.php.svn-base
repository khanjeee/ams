<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crm extends CI_Controller 
{
    public function __construct() 
	{
        parent::__construct();
        if (!isUserLoggedIn()) { {
                redirect(site_url());
            }
        }
        $this->controller = strtolower(__CLASS__);
        $this->ApiCrm = new ApiCrm();
        $this->load->model('contact_model', 'contact');
        $this->load->model('crm_model', 'crm');
    }

    public function index() 
	{
        redirect($this->controller . '/view');
    }

    public function create() 
	{
        if ($aPostedData = $this->input->post('data')) {
                
            $result = $this->ApiCrm->saveCrmMetaFields($aPostedData);

            if ($result['status']) {
                return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
                    'redirectUrl' => site_url($this->controller . '/view')));
            } else {
                return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
                    'redirectUrl' => site_url($this->controller . '/view')));
            }

		}
		$data['sFormAction'] = site_url($this->controller.'/'.__FUNCTION__);
		$data['aMetaFields'] = $this->crm->getAllCrmMetaFields();
		$this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}
	
	public function update($iUserCrmId=0)
	{
	     $data = array();
		 $sFormAction 	   = $this->controller.'/'. __FUNCTION__ .'/'.$iUserCrmId;  
		
		if($aPostedData = $this->input->post('data'))
		{
			$aPostedData['iUserCrmId'] = $iUserCrmId;
			$result = $this->ApiCrm->UpdateCrmMetaFields($aPostedData);
			
			if($result['status'])
            {
                return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
                    'redirectUrl' => site_url($this->controller . '/view')));
            } else {
                return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
                    'redirectUrl' => site_url($this->controller . '/view')));
            }

		}
		
		
		$data['aMetaFields'] = $this->crm->getAllCrmMetaFields();
		$data['aCrm']		 = (array) $this->crm->getMetaFieldsById($iUserCrmId);
		$data['sFormAction'] = site_url($sFormAction);
					
		$this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}
			
    public function view() 
	{

        $aParams['iUserId'] = getLoggedInUserId();
        $data = array();
        $aCrm = (array) $this->crm->getAllCrmMeta($aParams);

        $data['aCrm'] = $aCrm;

        $sFormAction = $this->controller . '/' . __FUNCTION__;
        $data['sFormAction'] = site_url($sFormAction);
        $data['sDeleteAction'] = site_url($this->controller . '/delete');
        $data['sEditAction'] = site_url($this->controller . '/update');
        $data['sCallFrom'] = $sFormAction;

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
    }

	public function delete($iUserCrmId=0)
	{
		   if($iUserCrmId)
           {
                $result =   $this->ApiCrm->deleteCrmById($iUserCrmId);


                if($result)
                {
                   return setMessage($result['status'], array('message' =>  getFormValidationErrorMessage($result['message']),
                                                 'redirectUrl'  =>  site_url($this->controller.'/view')));
                }
           }
           return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage($result['message']), 
                                           'redirectUrl'  =>  site_url($this->controller.'/view')));
       }
}
