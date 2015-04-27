<?php

class Flag_Model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function create($aData = array()) 
	{
			
			$sTitle = $aData['title'];
			$iCreated = getDatabaseDate();
			$iUserId = getLoggedInUserId();
			$isEditMode	= $aData['isEditMode'];
		if (!$isEditMode) 
		{
			
			
			$SQL = <<<SQL
				INSERT INTO flags (user_id,title,created_on,created_by)
				VALUES			  ('$iUserId', '$sTitle', '$iCreated', '$iUserId')
SQL;
		}
		else
		{
			
			$iFlagId= $aData['flag_id'];
			$SQL = <<<SQL
					
				UPDATE flags
					SET  title			  = '$sTitle',
						 last_updated_on  = '$iCreated',
						 last_updated_by  = '$iUserId'
					WHERE flag_id		  = '$iFlagId';
SQL;
		}
						if ($this->db->query($SQL))
						{
							if(!$isEditMode)
							{
								return $this->db->insert_id();
							}
							else 
							{
								return $iFlagId;
							}
						}
		return false;
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
        $aWhereClause[] = " ( f.user_id ='$iUserId' ) ";

        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(f.flag_id) AS count ';
        } else {
            $sSelect = 'f.flag_id,f.user_id,f.title,f.created_on';
	

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY f.flag_id asc ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				flags f 		
		 
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
	
	 public function getFlagId($iFlagId = 0) 
     {
        $this->db->where('flag_id', $iFlagId); 
        $result = $this->db->get('flags'); 
         if($result->result())
         {
             return $result->result();
         }
         return false;
    }
	
	public function getFlagByTitleAndUserId($iUserId = 0,$Title = '')
    {
        if($iUserId)
        {
            $SQL = <<<SQL
				 SELECT title FROM flags WHERE user_id = '$iUserId' AND title = '$Title'
SQL;
        }
        if ($result = $this->db->query($SQL)) 
		{
			return $result->result_array();
		}
			return array();
    }
	
	
	 public function deleteFlagById($iFlagId = 0) 
    {
        $this->db->where('flag_id', $iFlagId); 
        $this->db->delete('flags'); 
        return $this->db->affected_rows();
    
    }

}
