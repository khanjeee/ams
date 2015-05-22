<?php

class Payment_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        
    }

    function createPayment($aData = array())
    {
        if ($aData)
        {
          
            $sCardHolder		= $aData['aPostedData']['card_holder'];
			#$dExpirationDate	= $aData['aPostedData']['year'] . '-' . $aData['month'];
			#$iCvc				= $aData['aPostedData']['cvc'];
			$iCardNumber		= $aData['aPostedData']['card_number'];
			$iSubscriptionId	= $aData['aPostedData']['subscription_id'];
			#$iAmount			= $aData[0]['total_printing_cost'];
			$iBatchId			= $aData[0]['campaign_batch_id'];			
			$iUserId			= $aData[0]['user_id'];
            $dDate              = date(DATE_FORMAT_MYSQL);
          

            # Insert!
             
                $SQL = <<<SQL

            INSERT INTO payment
            ( user_id, campaign_batch_id,subscription_id,card_number,card_type,card_holder,created_on )
			VALUES 
			(
				'$iUserId',
				'$iBatchId',
				'$iSubscriptionId',
				'$iCardNumber',
				'card_type',
				'$sCardHolder',
				'$dDate'
			);
				 
SQL;
           

            if ($this->db->query($SQL))
            {
               return $this->db->insert_id() ;
            }
        }
        return false;
    }
    
    
    
    
    
}
