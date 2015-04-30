<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Predefined_Batches extends CI_Controller
{
    var $ApiPredefinedBatches;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);

        $this->load->model('role_model','role');
        $this->load->model('list_model','lists');
        $this->load->model('predefined_batch_model','predefined_batch');
        $this->load->model('package_model','package');
        $this->load->model('predefined_campaign_model',    'predefined_campaign');
        $this->load->model('whitelabel_model','whitelabel');
        $this->load->model('product_model','product');


        $this->ApiPredefinedBatches   =   new ApiPredefinedBatches();
        if(!isUserLoggedIn()){redirect(site_url());}
    }


    public function index()
    {
        redirect('predefined_campaigns/view') ;
    }


    # Test Function for Batch Template
    public function setBatchTemplate()
    {
        $aData = array  (
                            'campaign_batch_id'             => 1,   //  BatchId
                            'template_id'                   => 2,   //  Envelopes
                            'product_id'                   => 2,   //  Envelopes
        );

        debug($this->ApiPredefinedBatches->setBatchTemplate($aData));
        exit;
    }

    public function create($iCampaignId = 0)
    {
        $data['aSolutions']         =  $this->whitelabel->getAllWhiteLabel(array(ACTION_RECORD_COUNT=>0));
        //$data['SolutionsDrpDown']   =  $this->load->view('packages/ajax_get_white_labels',$data,TRUE);
        $aProducts['products']      = $this->product->getAllProducts();
        $data['sFormAction']        = site_url('ajax/predefined_batches');
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
            $aBatches                   = $this->predefined_batch->BatchInfo($iBatchId);
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

                    $data['aBatchLists']       =  $this->predefined_batch->getBatchListsFormated($iBatchId);
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
            $aBatches                   = $this->predefined_batch->BatchInfo($iBatchId);
        }

        if($aBatches)
        {
            if($aBatches->current_status == BATCH_IS_IN_EDIT_MODE)
            {
                if($aBatches->user_id == getLoggedInUserId())
                {
                    $data['aSolutions']         =  $this->whitelabel->getAllWhiteLabel(array(ACTION_RECORD_COUNT=>0));
                    $aProducts['products']      = $this->product->getAllProducts();
                    $data['sFormAction']        = site_url('ajax/predefined_batches');
                    $data['sGetTempaltesUrl']   = site_url('ajax/product');
                    $data['aLists']             = $this->lists->getAllUserLists();
                    $data['aProducts']          = json_encode($aProducts['products']) ;
                    $data['iBatchId']           = $iBatchId;

                    $data['aBatchLists']       =  $this->predefined_batch->getBatchListsFormated($iBatchId);
                    $data['aBatchDetails']     =  (array) $aBatches;
                    $data['selectedWhiteLabel']=  $this->whitelabel->getWhiteLabel($data['aBatchDetails']['whitelabel_id']);

                    if(isset($data['selectedWhiteLabel']['promotion_code']))
                    {
                        $data['selectedPromoCode'] =  $data['selectedWhiteLabel']['promotion_code'];
                    }

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

    //predefined batches created by admin used by the whitelabel user here 
    public function save($iBatchId = 0)
    {
        $bInvalid = false;
        $aBatches = $aUserData = array();

        if($iBatchId)
        {
            $aBatches  = $this->predefined_batch->BatchInfo($iBatchId);
            $aUserData = (object)getLoggedInUserData();

        }

        if($aBatches)
        {
            if($aBatches->current_status == BATCH_IS_IN_EDIT_MODE)
            {
                if(($aBatches->package_id == $aUserData->package_id) and ($aBatches->whitelabel_id == $aUserData->whitelabel_id) )
                {
                    $data['aSolutions']         =  $this->whitelabel->getAllWhiteLabel(array(ACTION_RECORD_COUNT=>0));
                    $aProducts['products']      = $this->product->getAllProducts();
                    $data['sFormAction']        = site_url('ajax/predefined_batches');
                    $data['sGetTempaltesUrl']   = site_url('ajax/product');
                    $data['aLists']             = $this->lists->getAllUserLists();
                    $data['aProducts']          = json_encode($aProducts['products']) ;
                    $data['iBatchId']           = $iBatchId;
                    $data['aBatchLists']        =  $this->predefined_batch->getBatchListsFormated($iBatchId);
                    $data['aBatchDetails']      =  (array) $aBatches;
                    $data['selectedWhiteLabel'] =  $this->whitelabel->getWhiteLabel($data['aBatchDetails']['whitelabel_id']);
                    $data['selectedPromoCode']  =  $data['selectedWhiteLabel']['promotion_code'];

                    $data['aUserInfo']           = $aUserData;

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

     //predefined batches created by admin used by the whitelabel user here edit mode
    public function edit_save($iBatchId = 0)
    {
        $bInvalid = false;
        $aBatches = $aUserData = array();

        if($iBatchId)
        {
            $iAdminBatchId              =   $this->predefined_batch->getAdminCampaignBatchId_From_UserBatchId($iBatchId);
            $aBatches                   =   $this->predefined_batch->getPredefinedBatchSummary($iAdminBatchId,$iBatchId);
            $aUserData                  =   (object)    getLoggedInUserData();
            $data['aSolutions']         =   $this->whitelabel->getAllWhiteLabel(array(ACTION_RECORD_COUNT=>0));
            $aProducts['products']      =   $this->product->getAllProducts();
            $data['sFormAction']        =   site_url('ajax/predefined_batches');
            $data['sGetTempaltesUrl']   =   site_url('ajax/product');
            $data['aLists']             =   $this->lists->getAllUserLists();
            $data['aProducts']          =   json_encode($aProducts['products']) ;
            $data['iBatchId']           =   $iBatchId;
            $data['aLists']             =   $this->lists->getAllUserLists();
            $data['aBatchLists']        =   $aBatches['BatchLists'];
            $data['aBatchDetails']      =   (array) $aBatches['BatchDetails'];
            $data['selectedWhiteLabel'] =   $this->whitelabel->getWhiteLabel($data['aBatchDetails']['whitelabel_id']);

            if(isset($data['selectedWhiteLabel']['promotion_code'])) {$data['selectedPromoCode']  =  $data['selectedWhiteLabel']['promotion_code'];}

            $data['iUserBatchId']       =   $iBatchId;
            $data['aUserInfo']          =   $aUserData;

            $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
        }
        

        if($bInvalid)
        {
            redirect(site_url());
        }
    }

    public function uc()
    {
        $aTemplateFoldsData             =   $this->predefined_batch->getTemplateFoldsData(2);
        $this->layout->template(TEMPLATE_BASIC)->show('batches/upload_content',$aTemplateFoldsData);
    }

    public function getFoldElementsHTML()
    {
        $aTemplateFoldsData             =   $this->predefined_batch->getTemplateFoldsData(2);
        echo $this->ApiPredefinedBatches->getFoldElementsHTML($aTemplateFoldsData);
        exit;
    }


    public function saveTemplateContent()
    {
        echo $this->ApiPredefinedBatches->setBatchElementsData();
        exit;
    }

    public function ScheduleBatch()
    {
        $aPostedData = array(
                                'campaign_batch_id'     => 1,
                                'schedule_date'         => '03/05/2015',
                                'schedule_time'         => '5:49 PM',
                            );

        echo $this->ApiPredefinedBatches->ScheduleBatch($aPostedData);
        exit;
    }

    public function summary()
    {
        $aSummaryData                   =   $this->predefined_batch->getBatchSummary(1);
        $this->layout->template(TEMPLATE_BASIC)->show('batches/summary',array('aSummaryData'=>$aSummaryData));
    }

    public function delete($iBatchId=0)
    {
        $data = array();


        if($iBatchId)
        {
            $aBatches                   = $this->predefined_batch->BatchInfo($iBatchId);
        }

        if($aBatches)
        {
            if($aBatches->current_status == BATCH_IS_IN_EDIT_MODE)
            {
                if($aBatches->user_id == getLoggedInUserId())
                {
                    $data['iBatchId']       =   $iBatchId;
                    $result                 =   $this->ApiPredefinedBatches->delete($data);

                    if($result['status'])
                    {
                        return setMessage($result['status'], array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS), 'redirectUrl'  =>  site_url('predefined_campaigns/view')));
                    }
                    else
                    {
                        return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage(ERROR_DELETE_FAILURE), 'redirectUrl'  =>  site_url('predefined_campaigns/view')));
                    }
                }
            }
        }
        redirect($this->controller.'/view');
        exit;
    }
}
