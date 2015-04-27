<?php

class Role_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  

    public function getRolesDropDown()
    {
        $this->db->select('role_id,title');
        $query = $this->db->get('roles');
        return $query->result_array();
        
    }    
    
    public function getAllRoles($aParams = array()) 
        {

         $recordsPerPage = LISTING_PER_PAGE;
         $offset = -1;
         $returnCount = $aParams[ACTION_RECORD_COUNT];

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }

        $aWhereClause   = array();
        //$aWhereClause[] = " ( c.user_id ='$iUserId' ) ";

        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(r.role_id) AS count ';
        } else {
            $sSelect = 'r.role_id,title';
	

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY r.role_id DESC ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				roles r 		
		 
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

  
     function createRole($aData = array())
    { 
         
        // d($aData);
        if ($aData)
        {
            $isEditMode         = $aData['isEditMode'];
            $sTitle             = $aData['title'];
            $dDate              = date(DATE_FORMAT_MYSQL);
            
            
            
  
                # Insert!
           $SQL = '';     
            if($isEditMode)
            {
               $iRoleId         = $aData['role_id'];
                $SQL = <<<SQL

		UPDATE roles SET
                title='$sTitle',created_on='$dDate' 
                WHERE role_id='$iRoleId';        
			
				 
SQL;
               // d($SQL);
                
            }
            else
            {
                $SQL = <<<SQL

				INSERT INTO roles
                    (
                        title,created_on 
                        
                     )
			VALUES (
                        '$sTitle', '$dDate')
				 
SQL;
                
            }    
            
                if ($this->db->query($SQL))
                {
                    return $this->db->affected_rows();
                }
            }
        

        return false;
    }
    
    
    public function getRoleById($iRoleId = 0) 
    {
        $this->db->where('role_id', $iRoleId); 
        $result = $this->db->get('roles'); 
         if($result->result())
         {
             return $result->result();
         }
         
         return false;
            

    }
    
  public function deleteRoleById($iRoleId = 0) 
    {
        $this->db->where('role_id', $iRoleId); 
        $this->db->delete('roles'); 
        return $this->db->affected_rows();
    
    }
}
