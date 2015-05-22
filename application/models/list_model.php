<?php

class List_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  

    public function getRolesDropDown()
    {
        $this->db->select('role_id,title');
        $query = $this->db->get('roles');
        return $query->result_array();
        
    }    
    
    public function getAllLists($aParams = array()) 
    {
        
        $iUserId            = getLoggedInUserId();
         $recordsPerPage = LISTING_PER_PAGE;
         $offset = -1;
         $returnCount = $aParams[ACTION_RECORD_COUNT];

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }

        $aWhereClause   = array();
        $aWhereClause[] = " ( l.user_id ='$iUserId' ) ";

        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(l.list_id) AS count ';
        } else {
            $sSelect = 'l.list_id,l.user_id,l.title,l.description,l.is_master_list,l.created_on';
	

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY l.list_id DESC ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				lists l 		
		 
		 $sWhereCondition 
		 
		 $sOrderBy
		 
		 $sLimit 
		
QUERY;
		
		

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

  
    function createList($aData = array())
    { 
         
        // d($aData);
        if ($aData)
        {
            $iUserId            = getLoggedInUserId();
            $isEditMode         = $aData['isEditMode'];
            $sTitle             = $aData['title'];
            $sDesc              = $aData['description'];
            $dDate              = date(DATE_FORMAT_MYSQL);
            
            
            
  
                # Insert!
           $SQL = '';     
            if($isEditMode)
            {
               $iListId         = $aData['list_id'];
                $SQL = <<<SQL

		UPDATE lists SET
                title='$sTitle',description='$sDesc',last_updated_on='$dDate',last_updated_by='$iUserId' 
                WHERE list_id='$iListId';        
			
				 
SQL;
               // d($SQL);
                
            }
            else
            {
                $SQL = <<<SQL

				INSERT INTO lists
                    (
                        user_id, title,description,created_on, created_by
                        
                     )
			VALUES (
                        '$iUserId','$sTitle' ,'$sDesc','$dDate','$iUserId')
				 
SQL;
                
            }    
            
                if ($this->db->query($SQL))
                {
                    return $this->db->affected_rows();
                }
            }
        

        return false;
    }
    
    public function getListId($iListId = 0) 
    {
        $this->db->where('list_id', $iListId); 
        $result = $this->db->get('lists'); 
         if($result->result())
         {
             return $result->result();
         }
         
         return false;
            

    }
    public function getMasterList() 
    {
        $this->db->where('is_master_list', 1); 
        $result = $this->db->get('lists'); 
         if($result->result())
         {
             return $result->row();
         }
         return false;
    }
    
	public function deleteListById($iListId = 0)
    {
//        $this->db->where('list_id', $iListId);
//        $this->db->delete('lists');
//
//        $this->db->where('list_id', $iListId);
//        $this->db->delete('list_members');
		
		// return $this->db->affected_rows();
		
		 $sql = <<<QUERY
		
		DELETE FROM lists
WHERE list_id = '$iListId';
QUERY;

        if ($this->db->query($sql)) {
            $sql = <<<QUERY
		
		 DELETE FROM list_members
WHERE list_id = '$iListId';
QUERY;

            return $this->db->query($sql);
        }
	
    }

    public function getListContacts($iListId = 0)
    {
        $Result = array();

        $this->db->select('contact_id');
        $this->db->where('list_id', $iListId);
        $result = $this->db->get('list_members');

        if($aContacts = $result->result_array())
        {
            foreach($aContacts as $value)   {$Result[]    = $value['contact_id'];}
        }
        return $Result;
    }
    
    public function getAllUserLists()
    {
        $iUserId            = getLoggedInUserId();
        $this->db->select('lists.list_id,lists.title as text');
        $this->db->from('lists');
        $this->db->join('list_members', 'list_members.list_id = lists.list_id');
        $this->db->where('lists.user_id', $iUserId);
        $this->db->group_by('lists.list_id');
        $result = $this->db->get();
       
        if($result->result())
        {
         return $result->result();
        }

         return false;
    }

    public function getAllContactsOfList($iListId = 0)
    {
        if($iListId)
        {
            $SQL = <<<SQL

            SELECT
               first_name ,
               last_name ,
               printed_name ,
               business_name ,
               address ,
               country ,
               state ,
               city ,
               zip ,
               email ,
               dob ,
               phone ,
               website ,
               notes 
            FROM contacts
            WHERE contact_id
            IN(SELECT contact_id FROM list_members WHERE list_id='$iListId')
SQL;
        }

        if ($result = $this->db->query($SQL)) {return $result->result_array();}

        return array();
    }
    public function getAllListByUserId($iUserId = 0)
    {
        if($iUserId)
        {
            $SQL = <<<SQL

            SELECT list_id, title
			FROM lists
			WHERE user_id = '$iUserId'
SQL;
        }

        if ($result = $this->db->query($SQL)) {return $result->result_array();}

        return array();
    }
	
	public function getContactByListId($iListId = 0)
	{
		if(!empty($iListId))
		{
			$this->db->select('COUNT(lm.contact_id) as total_contact ');
			$this->db->from('lists l');
			$this->db->join('list_members lm','l.list_id = lm.list_id');
			$this->db->where('l.list_id', $iListId);
			$result['total_contact'] = $this->db->get()->row()->total_contact;		
			if($result['total_contact'])
			{
			   return $result['total_contact'];
			}
		}
		    return $result['total_contact']  = 0;
	}
	public function getMasterContactByUser($iUserId = 0)
	{
		if(!empty($iUserId))
		{
			
			$SQL = <<<SQL

			
					SELECT COUNT(contact_id) AS master_contact
					FROM contacts
					WHERE user_id = '$iUserId'

SQL;
			
			
			if ($Result = $this->db->query($SQL))
            {
				 return $Result->row();
            }
		}
		
		    
	}
	
	public function getAllContactsByListId($aParams = array())
    { //-->, $RoleId = 0, $iLimit = 0,$ReturnCount = FALSE,$Offset = 0,$Search = false
			
         $returnCount = false;
         $recordsPerPage = LISTING_PER_PAGE;
         $iUserId   = $aParams['iUserId'];  
         $iListId   = $aParams['iListId'];  
         $offset = -1;

         if(isset($aParams[ACTION_RECORD_COUNT]))
         {
             $returnCount = $aParams[ACTION_RECORD_COUNT];
         }

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }

        $aWhereClause   = array();
        $aWhereClause[] = " (contact_id IN(
									SELECT 	contact_id 
									FROM 	list_members 
									WHERE 	list_id	=	'$iListId'	 
									AND 	user_id	=	'$iUserId'
								 )   
							 ) ";

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
                        c.website, c.notes';
	

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
	
	function addMasterList($iUserId)
	{
		
		$sDefaultList = MASTER_LIST;
		$iIsMasterList = IS_MASTER_LIST;
		$dDate       = date(DATE_FORMAT_MYSQL);
		if($iUserId)
		{
			$SQL = <<<SQL

			INSERT INTO lists
            (
				user_id,
				title,
				description,
				is_master_list,
				created_on
				
             )
			VALUES 
			(
				'$iUserId',
				'$sDefaultList',
				'$sDefaultList',
				'$iIsMasterList',
				'$dDate'
			);
			 
SQL;
            
            if ($this->db->query($SQL))
            {
                if ($iListId = $this->db->insert_id())
                {
                    return $iListId;
                }
            }
		}
		return false;
		 
	}
	
	public function getlistByContactId($iContactId = 0)
	{	
			
			if(!empty($iContactId))
			{
				$SQL = <<<SQL

						SELECT list_member_id, user_id, list_id, contact_id
						FROM list_members
						WHERE contact_id = '$iContactId'
SQL;
				if ($Result = $this->db->query($SQL))
				{
					 return $Result->row();
				}
			}
			return array();
		
		
	}
	
	public function getLists($iUserId,$sTitle) 
    {
        $SQL = <<<SQL
				SELECT list_id,title 
				FROM lists 
				WHERE user_id = $iUserId
				AND title = '$sTitle'
			 
SQL;
         if ($result = $this->db->query($SQL))
         {
             return $result->row();
         }
         return false;
    }
	
	
	function createListForContactAdd($aData = array())
    { 
         
        // d($aData);
        if ($aData)
        {
            $iUserId            = getLoggedInUserId();
            
            $sTitle             = $aData['title'];
            $sDesc              = $aData['description'];
            $dDate              = date(DATE_FORMAT_MYSQL);
            
            
            
  
                # Insert!
          
                $SQL = <<<SQL

				INSERT INTO lists
                    (
                        user_id, title,description,created_on, created_by
                        
                     )
			VALUES (
                        '$iUserId','$sTitle' ,'$sDesc','$dDate','$iUserId')
				 
SQL;
                
            
            
                if ($this->db->query($SQL))
                {
                   if ($iListId = $this->db->insert_id())
					{
						return $iListId;
					}
                }
            }
        

        return false;
    }
}
