<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batches extends CI_Controller
{
    var $ApiBatches;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);
        $this->load->model('role_model','role');
        $this->load->model('list_model','lists');
        $this->load->model('batch_model','batch');
        $this->load->model('package_model','package');
        $this->load->model('campaign_model',    'campaign');
        $this->load->model('whitelabel_model','whitelabel');

        $this->ApiBatches   =   new ApiBatches();
        if(!isUserLoggedIn()){redirect(site_url());}
    }


    public function index()
    {
        redirect('campaigns/view') ;
    }


    # Test Function for Batch Template
    public function setBatchTemplate()
    {
        $aData = array  (
                            'campaign_batch_id'             => 1,   //  BatchId
                            'template_id'                   => 2,   //  Envelopes
                            'product_id'                   => 2,   //  Envelopes
        );

        debug($this->ApiBatches->setBatchTemplate($aData));
        exit;
    }

    public function create($iCampaignId = 0)
    {
        $aProducts                  = $this->package->loadPackage(getLoggedInUserPackageId());
        $data['sFormAction']        = site_url('ajax/batches');
        $data['sGetTempaltesUrl']   = site_url('ajax/product');
        $data['aLists']             = $this->lists->getAllUserLists();
        $data['aProducts']          = json_encode($aProducts['products']) ;
        $data['iCampaignId']        = $iCampaignId;
        
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    public function whitelabel_create($iCampaignId = 0)
    {
        //this is the predefined campaign data 
        $data['sFormAction']        = site_url('ajax/batches');
        $data['sGetTempaltesUrl']   = site_url('ajax/product');
        $data['aLists']             = $this->lists->getAllUserLists();
        $data['iCampaignId']        = $iCampaignId;
        $data['aWhiteLabelCampaignData'] = $this->whitelabel->loadPreDefinedCampaigns($iCampaignId);
        
        //d($aWhiteLabelCampaignData);
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
     public function whitelabel_edit($iBatchId = 0)
    {
         
        $bInvalid = false;
        $aBatches = array();

        if($iBatchId)
        {
            $aBatches                   = $this->batch->BatchInfo($iBatchId);
        }

        if($aBatches)
        {
            if($aBatches->current_status == BATCH_IS_IN_EDIT_MODE)
            {
                if($aBatches->user_id == getLoggedInUserId())
                {
                    $aProducts                  = $this->package->loadPackage(getLoggedInUserPackageId());
                    $data['sFormAction']        = site_url('ajax/batches');
                    $data['sGetTempaltesUrl']   = site_url('ajax/product');
                    $data['aLists']             = $this->lists->getAllUserLists();
                    $data['aProducts']          = json_encode($aProducts['products']) ;
                    $data['iBatchId']           = $iBatchId;

                    $data['aBatchLists']       =  $this->batch->getBatchListsFormated($iBatchId);
                    $data['aBatchDetails']     =  (array) $aBatches;
                    $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
                    
                }
                else    {$bInvalid = true;}
            }
            else    {$bInvalid = true;}
        }
        else    {$bInvalid = true;}

        if($bInvalid)
        {
            redirect(site_url());
        }
    }

    

     public function edit($iBatchId = 0)
    {
        $bInvalid = false;
        $aBatches = array();

        if($iBatchId)
        {
            $aBatches                   = $this->batch->BatchInfo($iBatchId);
        }

        if($aBatches)
        {
            if($aBatches->current_status == BATCH_IS_IN_EDIT_MODE)
            {
                if($aBatches->user_id == getLoggedInUserId())
                {
                    $aProducts                  = $this->package->loadPackage(getLoggedInUserPackageId());
                    $data['sFormAction']        = site_url('ajax/batches');
                    $data['sGetTempaltesUrl']   = site_url('ajax/product');
                    $data['aLists']             = $this->lists->getAllUserLists();
                    $data['aProducts']          = json_encode($aProducts['products']) ;
                    $data['iBatchId']           = $iBatchId;

                    $data['aBatchLists']       =  $this->batch->getBatchListsFormated($iBatchId);
                    $data['aBatchDetails']     =  (array) $aBatches;

                    $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
                }
                else    {$bInvalid = true;}
            }
            else    {$bInvalid = true;}
        }
        else    {$bInvalid = true;}

        if($bInvalid)
        {
            redirect(site_url());
        }
    }

    public function uc()
    {
        $aTemplateFoldsData             =   $this->batch->getTemplateFoldsData(2);
        $this->layout->template(TEMPLATE_BASIC)->show('batches/upload_content',$aTemplateFoldsData);
    }

    public function getFoldElementsHTML()
    {
        $aTemplateFoldsData             =   $this->batch->getTemplateFoldsData(2);
        echo $this->ApiBatches->getFoldElementsHTML($aTemplateFoldsData);
        exit;
    }


    public function saveTemplateContent()
    {
        echo $this->ApiBatches->setBatchElementsData();
        exit;
    }

    public function ScheduleBatch()
    {
        $aPostedData = array(
                                'campaign_batch_id'     => 1,
                                'schedule_date'         => '03/05/2015',
                                'schedule_time'         => '5:49 PM',
                            );

        echo $this->ApiBatches->ScheduleBatch($aPostedData);
        exit;
    }

    public function summary()
    {
        $aSummaryData                   =   $this->batch->getBatchSummary(1);
        $this->layout->template(TEMPLATE_BASIC)->show('batches/summary',array('aSummaryData'=>$aSummaryData));
    }

    public function delete($iBatchId=0)
    {
        $data = array();


        if($iBatchId)
        {
            $aBatches                   = $this->batch->BatchInfo($iBatchId);
        }

        if($aBatches)
        {
            if($aBatches->current_status == BATCH_IS_IN_EDIT_MODE)
            {
                if($aBatches->user_id == getLoggedInUserId())
                {
                    $data['iBatchId']       =   $iBatchId;
                    $result                 =   $this->ApiBatches->delete($data);

                    if($result['status'])
                    {
                        return setMessage($result['status'], array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS), 'redirectUrl'  =>  site_url('campaigns/view')));
                    }
                    else
                    {
                        return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage(ERROR_DELETE_FAILURE), 'redirectUrl'  =>  site_url('campaigns/view')));
                    }
                }
            }
        }
        redirect('campaigns/view');
        exit;
    }
}
