<?php

class ApiCrons
{
	function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('batch_model',           'batch');
        $this->result = array('status' => false, 'BatchesSettled' => 0,'message'=>  MSG_SOMETHING_WENT_WRONG );
	}

    public function SettleCuttOffBatches()
    {
        $aBatchesReadyForPrinting = $this->CI->batch->getBatchesForCuttOff();
        
        if(!empty($aBatchesReadyForPrinting))
        {
            $ApiBatches =  new ApiBatches();
            $this->result['BatchesSettled'] = $this->CI->batch->SettleCuttOffBatches(date(DATE_ONLY_FORMAT_MYSQL,time()));
            $this->result['status']         = true;
            $this->result['message']        = MSG_SUCCESS_CRON;
            
            foreach ($aBatchesReadyForPrinting as $aBatch)
            {
                $iBatchId = $aBatch['campaign_batch_id'];
                
                //saving contacts list when batch is scheduled successfully
                
                $BatchLists       =   $this->CI->batch->getBatchLists($iBatchId);
                
                    if($BatchLists)
                    {
                        $aListsFiles    =   $ApiBatches->ExportBatchLists(__FUNCTION__,$BatchLists,$iBatchId);
                    }
                
            }
        }
        else
        {
            $this->result = array('status' => true, 'BatchesSettled' => 0,'message'=>  "No batch ready for printing." );
        }

        return $this->result;
    }
}