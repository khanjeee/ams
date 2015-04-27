<?php

class List_Member_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  

    
    
    public function getAllListMembers($aParams = array()) 
        {
        
         $iUserId        = getLoggedInUserId();
         $iListId        = $aParams['list_id'];
         $recordsPerPage = LISTING_PER_PAGE;
         $offset = -1;
         $returnCount = $aParams[ACTION_RECORD_COUNT];

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }
         
         $sFrom = '';
         

        $aWhereClause   = array();
        
        $aWhereClause[] = " ( l.user_id ='$iUserId' ) ";
        $aWhereClause[] = " ( l.list_id ='$iListId' ) ";

        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(l.list_member_id) AS count ';
            $sFrom   = 'list_members l';
        } else {
            $sSelect = 'l.list_member_id,c.contact_id, c.first_name, c.last_name, c.printed_name, c.business_name, 
                        c.address, c.country, c.state, c.city, c.zip, c.email, c.dob, c.phone,c.website,c.notes';
            $sFrom   = 'list_members l 
                        INNER JOIN contacts c ON c.contact_id = l.contact_id';

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY l.list_member_id DESC ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM $sFrom 
				
		 
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

    
    
  
  public function deleteContactFromList($iListId=0,$iContactId = 0)
    {
        $this->db->where('contact_id', $iContactId);
        $this->db->where('list_id', $iListId);
        $this->db->delete('list_members');
        return $this->db->affected_rows();

    }
    
    
   

    
}
