<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Flags extends CI_Controller {

	var $ApiFlag;

	public function __construct() 
	{
		parent::__construct();
		if (!isUserLoggedIn()) { {
				redirect(site_url());
			}
		}
		$this->controller = strtolower(__CLASS__);
		$this->load->model('flag_model','flag');
		$this->ApiFlag = new ApiFlag();
	}

    public function index()
    {
        redirect($this->controller.'/view');
    }

	public function view($iPage = 0)
    {
		$aParams = array();
		$aParams[ACTION_RECORD_COUNT] = true;
		$aParams['iUserId'] = getLoggedInUserId();

		#   Pagination
		global $gPagination;
		$config = $gPagination;
		$config['base_url'] = site_url($this->controller . '/' . __FUNCTION__);
		$config['total_rows'] = $this->flag->getAllLists($aParams);
		$config['per_page'] = LISTING_PER_PAGE;
		$this->pagination->initialize($config);

		#### ----------------- ####

		$aParams[ACTION_RECORD_COUNT] = false;
		$aParams[ACTION_PAGE_OFFSET] = $iPage;

		$data = array();
		$aFlags = (array) $this->flag->getAllLists($aParams); // $this->package->getAllPackages($aParams);
		
		$data['aFlags'] = $aFlags;

		$sFormAction = $this->controller . '/' . __FUNCTION__;
		$data['sFormAction'] = site_url($sFormAction);
		$data['sDeleteAction'] = site_url($this->controller . '/delete');
		$data['sEditAction'] = site_url($this->controller . '/update');
		$data['sCallFrom'] = $sFormAction;

		$this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}

	public function update($iFlagId = 0) {
	
		
		$sFormAction = $this->controller . '/' . __FUNCTION__ . '/' . $iFlagId;
	
		if ($aPostedData = $this->input->post('data')) 
		{
			
			 $aPostedData['isEditMode'] = true;
             $aPostedData['flag_id'] = $iFlagId;	
             $result = $this->ApiFlag->create($aPostedData);

			
			if ($result['status']) {
				return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
					'redirectUrl' => site_url($this->controller . '/view')));
			} else {

				return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
					'redirectUrl' => $sFormAction));
			}			
		
		}


		$data['sFormAction']   = site_url($sFormAction);
		$data['aFlags']		   = $this->flag->getFlagId($iFlagId);
	
		


		$this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}

	public function create() 
	{
		$sFormAction = $this->controller . '/' . __FUNCTION__;
		
		
		if ($aPostedData = $this->input->post('data')) 
		{
			
			$aPostedData['isEditMode'] = false;
			$result = $this->ApiFlag->create($aPostedData);

			
			if ($result['status']) {
				return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
					'redirectUrl' => site_url($this->controller . '/view')));
			} else {

				return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
					'redirectUrl' => $sFormAction));
			}			
		}

		
		$data['sFormAction'] = site_url($sFormAction);
		$this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}

	public function delete($iFlagId = 0) {
		if ($iFlagId) {
			
			
			$result = $this->flag->deleteFlagById($iFlagId);
			
			if ($result) {
				return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
					'redirectUrl' => site_url($this->controller . '/view')));
			} else {
				return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
					'redirectUrl' => site_url($this->controller . '/view')));
			}
		}
		
	}

}
