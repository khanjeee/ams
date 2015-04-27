<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Whitelabel_Campaigns extends CI_Controller
{
	var $ApiContact;

	public function __construct()
    {
		parent::__construct();
		if (!isUserLoggedIn())
        {
            redirect(site_url());
		}

		$this->controller = strtolower(__CLASS__);
		$this->load->model('whitelabel_model','whitelabel');
	}

    public function index()
    {
        redirect($this->controller.'/view');
    }

	public function view($iPage = 0)
    {
        $aParams                            = $data = array();
		$aParams[ACTION_RECORD_COUNT]       = true;
        $aParams['white_label_id']          = getWhiteLablelId();

		#   Pagination
		global $gPagination;
		$config                     = $gPagination;
		$config['base_url']         = site_url($this->controller . '/' . __FUNCTION__);
		$config['total_rows']       = $this->whitelabel->getPredefinedCampaigns($aParams);
		$config['per_page']         = LISTING_PER_PAGE;
		$this->pagination->initialize($config);
		#### ----------------- ####

		$aParams[ACTION_RECORD_COUNT] = false;
		$aParams[ACTION_PAGE_OFFSET] = $iPage;

		$data['sFormAction']            = site_url($this->controller . '/' . __FUNCTION__);
		$data['sCallFrom']              = $data['sFormAction'];
        $data['aPredefinedSolutions']   = $this->whitelabel->getPredefinedCampaigns($aParams);

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}

}
