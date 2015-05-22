<?php

/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date:  5/14/15
 * Time: 2:55 PM
 */
class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!isUserLoggedIn()) {redirect(site_url('home/dashboard'));}
        $this->load->model('batch_model','batch');
        $this->controller  	= strtolower(__CLASS__);
    }

    public function view()
    {
        if(!isUserLoggedIn()){redirect(site_url());}

        $Data = $aBatchDetails = array();

        $aCutOffBatches             =   $this->batch->getCutOffBatches();

        if($aCutOffBatches)
        {
            for($b=0; $b<count($aCutOffBatches); $b++)
            {
                $iBatchId                                   =   $aCutOffBatches[$b]['campaign_batch_id'];
                $aBatchSummary                              =   $this->batch->getBatchSummary($iBatchId);
                $aBatchSummary['BatchDetails']['folds']     =   $this->batch->getTemplateFolds($aBatchSummary['BatchDetails']['template_id']);
                $aBatchDetails[]                            =   $aBatchSummary['BatchDetails'];
            }
        }

        $Data['aCutOffBatches']             =   $aBatchDetails;

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$Data);
    }

}

