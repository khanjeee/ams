<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Predefined_Campaigns extends CI_Controller
{
    var $ApiPredefinedCampaigns;

    public function __construct()
    {
        parent::__construct();

        $this->controller  	                =   strtolower(__CLASS__);
        $this->ApiPredefinedCampaigns       =   new ApiPredefinedCampaigns();

        /*
        $this->load->model('package_model',     'package');
        $this->load->model('campaign_model',    'campaign');
        $this->load->model('batch_model',       'batch');
        */
        $this->load->model('predefined_batch_model',                  'batch');
        $this->load->model('predefined_campaign_model',    'predefined_campaign');

        if(!isUserLoggedIn()) {redirect(site_url());}
    }

    public function index()
    {
        redirect($this->controller.'/view');
    }
    
    public function create()
    {
        $data   =  array();

        # When the Campaigns creation form is posted
        if($aCampaignInfo     = $this->input->post())
        {
            $aPostedData    =   array('title' => $aCampaignInfo['campaign_title'],'description'=>$aCampaignInfo['campaign_description']);
            $result         =   $this->ApiPredefinedCampaigns->create($aPostedData);

            if($result['status'])
            {
                setMessage(true, array('message' =>  getFormValidationSuccessMessage($result['message']), 'redirectUrl'  =>  site_url('predefined_batches/create/'.$result['iCampaignId'])));
            }
        }
        else    # when the data is not posted create package form dispalyed
        {
            $data['sFormAction']            = site_url($this->controller.'/'.__FUNCTION__);

            $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
        }
    }

    public function view($iPage=0)
    {
        $data = $aParams = array();
        $aParams[ACTION_RECORD_COUNT] = true;

        #   Pagination
        global $gPagination;
        $config = $gPagination;
        $config['base_url']             = site_url($this->controller.'/'. __FUNCTION__);
        $config['total_rows']           = $this->predefined_campaign->getAllCampaigns($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);
        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                           =   array();
        $aCampaigns                     =   (array)  $this->predefined_campaign->getAllCampaigns($aParams);// $this->package->getAllPackages($aParams);

        if($aCampaigns)
        {
            $iCampaignCount  = count($aCampaigns);
            for($c=0; $c < $iCampaignCount ; $c++)
            {
                $oCampaign                  = $aCampaigns[$c];
                $oCampaign->canBeDeleted    = 1;//$this->predefined_campaign->CampaignCanBeDeleted($oCampaign->predefined_campaign_id);

                $iCampaignId                = $oCampaign->predefined_campaign_id;
                $aBatches                   = $this->predefined_campaign->getCampaignBatches($iCampaignId,getLoggedInUserId());

                if($BatchCount = count($aBatches))
                {
                    
                    for($b=0; $b < $BatchCount; $b++)
                    {
                        $aBatch                     =       $this->batch->BatchInfo($aBatches[$b]['predefined_campaign_batch_id']);
                        //$aBatch->BatchLists         =       $this->batch->getBatchListsFormated($aBatches[$b]['campaign_batch_id']);
                        $oCampaign->aBatches[]      =       $aBatch;
                    }
                }
                else
                {
                    $oCampaign->aBatches           =       array();
                }
                $aCampaigns[$c] = (array) $oCampaign; 
            }
        }

        $data['aCampaigns']             =   $aCampaigns;

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }


    ## This is list of user predefined Campaigns by admin
    public function display($iPage=0)
    {
        $data = $aParams = array();
        $aParams[ACTION_RECORD_COUNT] = true;

        #   Pagination
        global $gPagination;
        $config = $gPagination;
        $config['base_url']             = site_url($this->controller.'/'. __FUNCTION__);
        $config['total_rows']           = $this->predefined_campaign->getAllUserPredefinedCampaigns($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);
        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                           =   array();
        $aCampaigns                     =   (array)  $this->predefined_campaign->getAllUserPredefinedCampaigns($aParams);// $this->package->getAllPackages($aParams);

        if($aCampaigns)
        {
            $iCampaignCount  = count($aCampaigns);
            for($c=0; $c < $iCampaignCount ; $c++)
            {
                $oCampaign                  = $aCampaigns[$c];
                $oCampaign->canBeDeleted    = 0;//$this->predefined_campaign->CampaignCanBeDeleted($oCampaign->predefined_campaign_id);

                $iCampaignId                = $oCampaign->predefined_campaign_id;
                $aBatches                   = $this->predefined_campaign->getCampaignBatches($iCampaignId,getLoggedInUserId());

                if($BatchCount = count($aBatches))
                {
                    for($b=0; $b < $BatchCount; $b++)
                    {
                        $aBatch                     =       $this->batch->BatchInfo($aBatches[$b]['predefined_campaign_batch_id']);
                        //$aBatch->BatchLists         =       $this->batch->getBatchListsFormated($aBatches[$b]['campaign_batch_id']);
                        $oCampaign->aBatches[]      =       $aBatch;
                    }
                }
                else
                {
                    $oCampaign->aBatches           =       array();
                }
                $aCampaigns[$c] = (array) $oCampaign;
            }
        }

        $data['aCampaigns']             =   $aCampaigns;

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }



    ## This is list of user predefined Campaigns by admin
    public function in_use($iPage=0)
    {
        $data = $aParams = array();
        $aParams[ACTION_RECORD_COUNT] = true;

        #   Pagination
        global $gPagination;
        $config = $gPagination;
        $config['base_url']             = site_url($this->controller.'/'. __FUNCTION__);
        $config['total_rows']           = $this->predefined_campaign->getAllUsedCampaigns($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);
        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                           =   array();
        $aCampaigns                     =   (array)  $this->predefined_campaign->getAllUsedCampaigns($aParams);// $this->package->getAllPackages($aParams);

        if($aCampaigns)
        {
            $iCampaignCount  = count($aCampaigns);
            for($c=0; $c < $iCampaignCount ; $c++)
            {
                $oCampaign                  = $aCampaigns[$c];
                $oCampaign->canBeDeleted    = 0;//$this->predefined_campaign->CampaignCanBeDeleted($oCampaign->predefined_campaign_id);

                $iCampaignId                = $oCampaign->predefined_campaign_id;
                $aBatches                   = $this->predefined_campaign->getUsedCampaignBatches($iCampaignId,getLoggedInUserId());

                if($BatchCount = count($aBatches))
                {
                    for($b=0; $b < $BatchCount; $b++)
                    {
                        $aBatch                                 =       $this->batch->BatchInfo($aBatches[$b]['predefined_campaign_batch_id']);
                        $aBatch->predefined_user_batch_id       =       $aBatches[$b]['predefined_user_batch_id'];
                        $oCampaign->aBatches[]                  =       $aBatch;
                    }
                }
                else
                {
                    $oCampaign->aBatches           =       array();
                }
                $aCampaigns[$c] = (array) $oCampaign;
            }
        }

        $data['aCampaigns']             =   $aCampaigns;
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }

    public function show($iCampaignId=0)
    {
        $data                                   = $aBatches = array();
        $aCampaign                              = $this->predefined_campaign->getCampaign($iCampaignId);
        $data['aCampaignData']['aCampaign']     = $aCampaign;

        if($aCampaign)
        {
            //$data['aCampaignData']['aCampaign']->is_predefined_campaign = $this->predefined_campaign->IsPredefinedCampaign($iCampaignId);

            $aBatches   = $this->predefined_campaign->getCampaignBatches($iCampaignId,getLoggedInUserId());

            if($aBatches)
            {
                for($b=0; $b < count($aBatches);$b++)
                {
                    $data['aCampaignData']['aBatches'][$aBatches[$b]['predefined_campaign_batch_id']]      =       (array) $this->batch->BatchInfo($aBatches[$b]['predefined_campaign_batch_id']);
                    //$data['aCampaignData']['aBatches'][$aBatches[$b]['campaign_batch_id']] ['BatchLists']  =       $this->batch->getBatchLists($aBatches[$b]['predefined_campaign_batch_id']);
                }
            }
        }

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }

    public function details($iCampaignId=0)
    {
        $data                                   = $aBatches = array();
        $aCampaign                              = $this->predefined_campaign->getCampaign($iCampaignId);
        $data['aCampaignData']['aCampaign']     = $aCampaign;

        if($aCampaign)
        {
            //$data['aCampaignData']['aCampaign']->is_predefined_campaign = $this->predefined_campaign->IsPredefinedCampaign($iCampaignId);

            $aBatches   = $this->predefined_campaign->getCampaignBatches($iCampaignId,getLoggedInUserId());

            if($aBatches)
            {
                for($b=0; $b < count($aBatches);$b++)
                {
                    $data['aCampaignData']['aBatches'][$aBatches[$b]['predefined_campaign_batch_id']]      =       (array) $this->batch->BatchInfo($aBatches[$b]['predefined_campaign_batch_id']);
                    //$data['aCampaignData']['aBatches'][$aBatches[$b]['campaign_batch_id']] ['BatchLists']  =       $this->batch->getBatchLists($aBatches[$b]['predefined_campaign_batch_id']);
                }
            }
        }

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }

    public function delete($iCampaignId=0)
    {
        $data = array();

        if($iCampaignId)
        {
            $data['iCampaignId']     =   $iCampaignId;
            $result                  =   $this->ApiPredefinedCampaigns->delete($data);

            if($result['status'])
            {
                return setMessage($result['status'], array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS), 'redirectUrl'  =>  site_url($this->controller.'/view')));
            }
            else
            {
                return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage(ERROR_DELETE_FAILURE), 'redirectUrl'  =>  site_url($this->controller.'/view')));
            }
        }
        redirect($this->controller.'/view');
    }


    public function savePreDefinedCampaign()
    {
        $aData  = array
        (
            'whitelabel_id'             => '1',
            'package_id'                => '2',
            'predefined_campaign_id'    => '3',
            'product_id'                => '4',
            'template_id'               => '5',
        );

        $result         =   $this->ApiPredefinedCampaigns->savePreDefinedCampaign($aData);
        d($result);
        exit;
    }

}
