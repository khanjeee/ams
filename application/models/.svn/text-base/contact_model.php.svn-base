<?php

class Contact_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function importContacts($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode            = false;
            $iUserId                = getLoggedInUserId();

            //if($aProducts)
            {
                $aInnerValues       = array();
                $iTotalContacts     = count($aData);

                for($p=0; $p < $iTotalContacts; $p++)
                {
                    
                    $aInnerValues[] = "( $aData[$p] ,'$iUserId','".getDatabaseDate()."','$iUserId')";
                }
                //d($aInnerValues);
                if($aInnerValues)
                {
                    $sInnerValue = 'VALUES '.implode(',',$aInnerValues);
                    $sInsertSQL  = <<<SQL

                    INSERT INTO contacts
                    (
                        first_name, last_name, printed_name, business_name, 
                        address,city,state,zip,country,email, dob, phone, 
                        website, notes, user_id, created_on, created_by 
                        
                     )
                      $sInnerValue
SQL;
                    //d($sInsertSQL);
                    if($sInsertSQL)
                    {
                        if($this->db->query($sInsertSQL))
                            {
                            return $this->db->affected_rows();
                            }
                    }
                }
            }
        }

        return false;
    }
    
    function createContact($aData = array())
    { 
         
        
        if ($aData)
        {
            $isEditMode         = $aData['isEditMode'];
            $sFirstName         = $aData['first_name'];
            $sLastName          = $aData['last_name'];
            $sPrintedName       = $aData['printed_name'];
            $sBusinessName      = $aData['business_name'];
            $sAddress           = $aData['address'];
            $sCity              = $aData['city'];
            $sState             = $aData['state'];
            $sZip               = $aData['zip_code'];
            $sCountry           = $aData['country'];
            $sEmail             = $aData['email'];
            $sDob               = date(DATE_ONLY_FORMAT_MYSQL,strtotime($aData['dob']));
            $sPhone             = $aData['phone'];
            $sWebsite           = $aData['website'];
            $sNotes             = $aData['notes'];
			
            $dDate              = date(DATE_FORMAT_MYSQL);
            $LoggedInUser       = getLoggedInUserId();
            
			if(isset($aData['flags']) && !empty($aData['flags']))
			{
				$Flag				= $aData['flags'];
			}
            
  
                # Insert!
           $SQL = '';     
            if($isEditMode)
            {
               $iContactId         = $aData['contact_id'];
                $SQL = <<<SQL

		UPDATE contacts SET
                first_name='$sFirstName',last_name='$sLastName',printed_name='$sPrintedName',business_name='$sBusinessName', 
                address='$sAddress',city='$sCity',state='$sState',zip='$sZip',country='$sCountry',email='$sEmail', dob='$sDob',
                phone='$sPhone',website='$sWebsite',notes='$sNotes',user_id='$LoggedInUser',flag_id='$Flag',created_on='$dDate',created_by='$LoggedInUser' 
                WHERE contact_id='$iContactId';        
			
				 
SQL;
               
                
            }
            else
            {
                $SQL = <<<SQL

				INSERT INTO contacts
                    (
                        first_name, last_name, printed_name, business_name, 
                        address,city,state,zip,country,email, dob, phone, 
                        website, notes, user_id,flag_id, created_on, created_by 
                        
                     )
			VALUES (
                        '$sFirstName', '$sLastName', '$sPrintedName', '$sBusinessName','$sAddress','$sCity','$sState', 
                        '$sZip','$sCountry','$sEmail','$sDob','$sPhone','$sWebsite','$sNotes','$LoggedInUser','$Flag','$dDate','$LoggedInUser' )
				 
SQL;
				
//                if ($this->db->query($SQL))
//				{
//					if ($iContactId = $this->db->insert_id())
//					{
//						return $iContactId;
//					}
//				}
            }    
                

                   
						if ($this->db->query($SQL))
						{
						
							
							if(!$isEditMode)
							{
								return $this->db->insert_id();
							}
							else 
							{
								
								return $iContactId;
							}
						} 
					 
					 
            
                       
            
//                if ($this->db->query($SQL))
//                {
//                    return $this->db->affected_rows();
//                }
            }
        

        return false;
    }
        
    public function getAllContacts($aParams = array())
    { //-->, $RoleId = 0, $iLimit = 0,$ReturnCount = FALSE,$Offset = 0,$Search = false

		
		
            $returnCount = false;
         $recordsPerPage = LISTING_PER_PAGE;
         $iUserId   = $aParams['iUserId'];  
         $offset = -1;

         if(isset($aParams[ACTION_RECORD_COUNT]))
         {
             $returnCount = $aParams[ACTION_RECORD_COUNT];
         }

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }

		 $searchQuery = '';
        if (isset($aParams['search'])) {
            if (isset($aParams['search']['query'])) {
                $searchQuery = $aParams['search']['query'];
            }
        }
		 
		 
        $aWhereClause   = array();
        $aWhereClause[] = " ( c.user_id ='$iUserId' ) AND c.first_name !='' AND c.last_name !=''";

		
		if($searchQuery)
		{
			 $aWhereClause[] = " ( c.flag_id='$searchQuery') ";
		}
		
        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(c.contact_id) AS count ';
        } else {
            $sSelect = 'c.contact_id, c.first_name, c.last_name, c.printed_name, c.business_name, 
                        c.address, c.country, c.state, c.city, c.zip, c.email, c.dob, c.phone, 
                        c.website,c.flag_id, c.notes';
	

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY c.contact_id DESC ';
        }

         $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				contacts c 		
		 
		 $sWhereCondition 
		 
		 $sOrderBy
		 
		 $sLimit 
		
QUERY;
		#debug($sql);
        if ($result = $this->db->query($sql))
        {
            if ($returnCount)
            {
                return $result->row('count');
            }
            else
            {
                return $result->result();
            }
        }
    }

    public function deleteContactById($iContactId = 0) 
    {
        $this->db->where('contact_id', $iContactId); 
        $this->db->delete('contacts'); 
        return $this->db->affected_rows();
    
    }
        
    public function getContactById($iContactId = 0) 
    {
        $this->db->where('contact_id', $iContactId); 
        $result = $this->db->get('contacts'); 
		
		 if($result->result())
         {
             return $result->result();
         }
         
         return false;
            

    }

    function addMembersToList($aData= array())
    { 
        if ($aData)
        {
			
			
            $iUserId                = getLoggedInUserId();
            $iListId                = $aData['iListId'];

            $aInnerValues           = array();
            $iTotalContacts         = count($aData['contacts']);

            for($c=0; $c < $iTotalContacts; $c++)
            {
                $iContactId = $aData['contacts'][$c];
                $aInnerValues[] = "( '$iUserId','$iListId','$iContactId','".getDatabaseDate()."','$iUserId')";
            }

            if($aInnerValues)
            {
                $sInnerValue = 'VALUES '.implode(',',$aInnerValues);
                $sInsertSQL  = <<<SQL

                INSERT INTO list_members
                (
                     user_id,
                     list_id,
                     contact_id,
                     created_on,
                     created_by
                 )
                  $sInnerValue
SQL;
                 
                    if($sInsertSQL)
                    {
                        if($this->db->query($sInsertSQL))
                        {
                            return $this->db->affected_rows();
                        }
                    }
                }
				 
				
        }
        return false;
    }
		
	function addContactInListByContactId($aData =array())
	{
		
		
				
			$iUserId                = getLoggedInUserId();
            $iListId                = $aData['list'];
            $iContactId             = $aData['contacts'];
			$dCreated				= getDatabaseDate();
			$isEditMode				= $aData['isEditMode'];
			
//			if($isEditMode)
//            {
//				$SQL = <<<SQL
//					UPDATE list_members
//						SET
//						  list_id = '$iListId',
//						  last_updated_on = '$dCreated'
//						WHERE contact_id = '$iContactId';
//SQL;
//			}
//			else
//			{
				$SQL = <<<SQL
					INSERT INTO list_members
					(user_id,
					 list_id,
					 contact_id,
					 created_on  )
				VALUES ( '$iUserId',
						 '$iListId',
						 '$iContactId',
						 '$dCreated' );
SQL;
			//}
			
			
			
			if ($this->db->query($SQL))
			{
				//if(!$isEditMode)
				//{
					return $this->db->insert_id();
				//}
//				else 
//				{
//					return $iContactId;
//				}
			}

			
	}
	
	function getContactByUserId($iUserId = 0)
	{
		 $this->db->where('user_id', $iUserId); 
         $result = $this->db->get('contacts'); 
         if($result->result())
         {
             return $result->result();
         }
         return false;
            
	}
    

}
