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
    
    
    //saving customer id returned by authorize.net in payments_info table 
    function saveCustomerId($aData = array())
    {
        if ($aData)
        {
          
               
               $iUserId        = $aData['user_id'];
               $dDate          = date(DATE_FORMAT_MYSQL);
               $type            = AUTHORIZE_DOT_NET_PROFILE_ID;
               $value           = $aData['profile_id'];

            # Insert!
             
                $SQL = <<<SQL

            INSERT INTO payment_info
            ( user_id, type,value,created_on )
			VALUES 
			(
				'$iUserId',
				'$type',
				'$value',
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
    
    
    //saving customer id returned by authorize.net in payments_info table 
    function savePaymentId($aData = array())
    {
        
       if ($aData)
        {
          
               
               $iUserId        = $aData['user_id'];
               $dDate          = date(DATE_FORMAT_MYSQL);
               $type            = AUTHORIZE_DOT_NET_PAYMENT_ID;
               $value           = $aData['payment_id'];

            # Insert!
             
                $SQL = <<<SQL

            INSERT INTO payment_info
            ( user_id, type,value,created_on )
			VALUES 
			(
				'$iUserId',
				'$type',
				'$value',
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
    
    
    //saving customer id returned by authorize.net in payments_info table 
    function saveAddressId($aData = array())
    {
        
       if ($aData)
        {
          
               
               $iUserId        = $aData['user_id'];
               $dDate          = date(DATE_FORMAT_MYSQL);
               $type            = AUTHORIZE_DOT_NET_ADDRESS_ID;
               $value           = $aData['address_id'];

            # Insert!
             
                $SQL = <<<SQL

            INSERT INTO payment_info
            ( user_id, type,value,created_on )
			VALUES 
			(
				'$iUserId',
				'$type',
				'$value',
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
    
    //saving customer id returned by authorize.net in payments_info table 
    function getCustomerId($aData = array())
    {
        if ($aData)
        {
               $iUserId         = $aData['user_id'];
               

            # Insert!
             
                $SQL = <<<SQL

            SELECT value from payment_info 
            WHERE   user_id = '$iUserId';
				 
SQL;
           $Result = $this->db->query($SQL);

            if ($Result) 
                {
                    return $Result->row('value');
		}
        }
        return 0;
    }
    
    
    
}
