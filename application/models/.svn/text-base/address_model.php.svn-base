<?php

class Address_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    /*
    public function createPackage($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode        = false;
            $aData              = $aData['package'];
            $sTitle             = $aData['title'];
            $sDescription       = $aData['description'];
            $sPrice             = intval($aData['price']);
            $sStatus            = intval($aData['status']);
            $iCreated           = getDatabaseDate();
            $iUserId            = getLoggedInUserId();

            if(!$bisEditMode)    # Insert!
            {
                $SQL = <<<SQL

				INSERT INTO  packages
                (
                    title,description,price,status,created_on,created_by
                )
				VALUES
				(
                    '$sTitle','$sDescription','$sPrice','$sStatus','$iCreated','$iUserId'
                )
SQL;
                if ($this->db->query($SQL))
                {
                    if ($iPackage = $this->db->insert_id())
                    {
                        return $iPackage;
                    }
                }
            }
        }
        return false;
    }

    */
    function insertAddresses($sCallFrom = '',$aData = array())
    {
        $aInsertedIds = array();
        if ($aData)
        {
            $bisEditMode            = false;
            $aAddresses              = $aData;
            
            

            if($aAddresses)
            {
                $aInnerValues       = '';
                
                //making insert into statement from array keys and values
                
                
               foreach($aAddresses as $key=>$data)
                {
                   $aInnerValues =   "('".implode("','", array_values($data))."')" ;
                   $aInnerKeys  =   "(".implode(",", array_keys($data)).")" ;
               
                
                     if($aInnerValues)
                {   
                    $sInsertSQL  = <<<SQL
                    
                    INSERT INTO addresses
                      $aInnerKeys 
                     VALUES     
                      $aInnerValues
SQL;
                   if($sInsertSQL)
                    {
                        if($this->db->query($sInsertSQL))
                            {
                                $aInsertedIds[$key]=$this->db->insert_id();
                                
                            }
                    }
                }
                
               }
                    
                 

               
            }
            return $aInsertedIds;
        }

        return false;
    }



	public function getAddressById($aAddressId)
	{
		
		if(is_array($aAddressId) && !empty($aAddressId))
		{
			$iIds = implode(',', $aAddressId);
			$SQL = <<<SQL
				SELECT * FROM addresses WHERE address_id IN($iIds) 
				ORDER BY TYPE DESC 
SQL;
			if ($Result = $this->db->query($SQL)) {
				return $Result->result();
			}
		}
	}

	
	public function UpdateAddressById($aData=array())
	{
		
		
		
		 if($aData)
        {
			 $iUserId            = getLoggedInUserId();
			 
			//BillingInfo
			$aBillingInfo		= $aData['aBillingInfo'];
			$sBillingAddress	= $aBillingInfo['address'];
            $sBillingCountry	= $aBillingInfo['country'];
            $sBillingCity		= $aBillingInfo['city'];
            $sBillingState		= $aBillingInfo['state'];
            $sBillingZipCode	= $aBillingInfo['zip_code'];
            $sBillingId			= $aBillingInfo['address_billing'];
			
			
			//MailingInfo
			$aMailingInfo		= $aData['aMailingInfo']; 
            $sMailingAddress	= $aMailingInfo['address'];
            $sMailingCountry	= $aMailingInfo['country'];
            $sMailingCity		= $aMailingInfo['city'];
            $sMailingState		= $aMailingInfo['state'];
            $sMailingZipCode	= $aMailingInfo['zip_code'];
            $sMailingId			= $aMailingInfo['address_mailing'];
			
			
		
				foreach ($aData as $key => $value) 
				{
					
					if($key=='aBillingInfo')
					{
					$Sql = <<<QUERY
						
							UPDATE addresses
							SET  address	 = '$sBillingAddress',
								 country	 = '$sBillingCountry',
								 state		 = '$sBillingState',
								 city		 = '$sBillingCity',
								 zip_code	 = '$sBillingZipCode'
							WHERE address_id = '$sBillingId';
QUERY;
					
					}
					else if(($key=='aMailingInfo'))
					{	
							$Sql = <<<QUERY
						
							UPDATE addresses
							SET  address	 = '$sMailingAddress',
								 country	 = '$sMailingCountry',
								 state		 = '$sMailingState',
								 city		 = '$sMailingCity',
								 zip_code	 = '$sMailingZipCode'								
							WHERE address_id = '$sMailingId';
QUERY;
					}	
					 $this->db->query($Sql);
					
			}
			return true;
		}
		 return false;
	}

    
//    public function deletePackagById($sPackageId = array())
//    {
//        $data = array('is_deleted' => '1');
//        $this->db->where('package_id', $sPackageId);
//        $this->db->update('packages', $data);
//        return $this->db->affected_rows();
//    }
}
