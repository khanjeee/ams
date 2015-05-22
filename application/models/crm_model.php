<?php

class Crm_Model extends CI_Model 
{

    function __construct() {
		parent::__construct();
	}

    function getAllCrmMetaFields()
    {
		 $result = array();
            $SQL = <<<SQL
				SELECT
					crm_meta_field_id,
					html_control_type
				FROM crm_meta_fields

SQL;
			if ($result = $this->db->query($SQL)) 
			{
				return $result->result_array();
			}
			return $result;
    }

    function getUserCrmMetaFieldValues($contact_id = 0)
    {
		 $result = array();
            $SQL = <<<SQL
				SELECT  
					field_id,field_value,contact_id
				FROM    crm_meta_fields_data
                                WHERE   contact_id = '$contact_id';

SQL;
			if ($result = $this->db->query($SQL)) 
			{
				return $result->result_array();
			}
			return $result;
    }

    
    function checkCrmMetaFieldValues($contact_id = 0,$field_id=0)
    {
		 $result = array();
            $SQL = <<<SQL
				SELECT  
					field_id,field_value,contact_id
				FROM    crm_meta_fields_data
                                WHERE   contact_id = '$contact_id'
                                AND     field_id   = '$field_id';

SQL;
			if ($result = $this->db->query($SQL)) 
			{
				return $result->result_array();
			}
			return $result;
    }
	
    function saveCrmUserMetaFields($aData = array())
    { 
        if ($aData)
        {
            $iUserId           = getLoggedInUserId();
            $dDate             = date(DATE_FORMAT_MYSQL);
            $isEditMode        = $aData['isEditMode'];
            $contactId         = $aData['contacts']; 
            $crmFields         = $aData['crm_fields'];
            
             $aInnerValues          = array();
             
             
                        //check if entry exists in crm_meta_fields_data and is edit mode
                        if($isEditMode)
                            { 
                                foreach ($crmFields as $field_id=>$field_value)
                                        {
                                            $customFieldIsCreated   = $this->checkCrmMetaFieldValues($contactId,$field_id);
                                            if(!empty($customFieldIsCreated))
                                                {
                                                    $sInsertSQL = <<<SQL
                                                  UPDATE crm_meta_fields_data SET
                                                  field_value='$field_value'
                                                  WHERE contact_id='$contactId'
                                                  AND field_id = $field_id    ;        
SQL;
                                                }
                                            else
                                                {
                                                   $sInsertSQL = <<<SQL
                                                  INSERT INTO crm_meta_fields_data 
                                                  (contact_id,field_id,field_value,created_on,created_by)
                                                  VALUES ( '$contactId','$field_id','$field_value','$dDate','$iUserId');       
SQL;
                                                }    
                                    
                                            
                                            if($sInsertSQL)
                                            {
                                                //debug($sInsertSQL);
                                                $this->db->query($sInsertSQL);
                                                    
                                            }
                                        
                                
                                
                                        }
                                        
                                       
                                        return true;
                             
                          
                            
                            }
                        else 
                            {     
                                    
                                foreach ($crmFields as $field_id=>$field_value)
                                        {
                                            $aInnerValues[] = "('$contactId','$field_id','$field_value','$dDate','$iUserId')";
                                        }
                                        
                              
                             
                                if($aInnerValues)
                                    {
                                        $sInnerValue = 'VALUES '.implode(',',$aInnerValues);
                                        $sInsertSQL  = <<<SQL
                                            INSERT INTO crm_meta_fields_data
                                            (contact_id, field_id, field_value, created_on,created_by)
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
	
    function saveCrmMetaFields($aData = array())
    { 
        if ($aData)
        {
            $iUserId           = getLoggedInUserId();
            $sMetaField        = $aData['metafields'];
            $sLabel            = $aData['label'];
            $sOptions          = $aData['options'];
            $dDate             = date(DATE_FORMAT_MYSQL);

                $SQL = <<<SQL
    INSERT INTO crm_user_meta_fields ( user_id, crm_meta_field_id, field_label, field_default_value, created_on,created_by )
    VALUES ( '$iUserId','$sMetaField','$sLabel','$sOptions','$dDate','$iUserId' );
     
SQL;
                if ($this->db->query($SQL))
                {
                    return $this->db->affected_rows();
                }
            }
        return false;
    }
    
    function getMetaFieldsById($iUserCrmId)
    {	
        $result = '';

        $sql = <<<QUERY

        SELECT
			user_crm_meta_field_id,
			user_id,
			crm_meta_field_id,
			field_label,
			field_default_value,
			created_on,
			created_by,
			last_updated_on,
			last_updated_by
		FROM crm_user_meta_fields
		WHERE user_crm_meta_field_id = $iUserCrmId
QUERY;

        $Query = $this->db->query($sql);
        $result = $Query->row();        
        return $result;		
	}

	function UpdateCrmMetaFields($aData = array())
	{	

	if ($aData)
         {
            $iUserId           = getLoggedInUserId();
            $sMetaField        = $aData['metafields'];
            $sLabel            = $aData['label'];
            $sOptions          = $aData['options'];
            $iUserCrmId          = $aData['iUserCrmId'];
            $dDate             = date(DATE_FORMAT_MYSQL);

                $SQL = <<<SQL
				UPDATE crm_user_meta_fields
				SET
				  crm_meta_field_id			 = '$sMetaField',
				  field_label				 = '$sLabel',
				  field_default_value		 = '$sOptions',
				  last_updated_on			 = '$dDate',
				  last_updated_by			 = '$iUserId'
				WHERE user_crm_meta_field_id = '$iUserCrmId';
				 
SQL;
                if ($this->db->query($SQL))
                {
                    return $this->db->affected_rows();
                }
            }
        return false;	
	}
	
    function getAllCrmMeta()
    {
		 $result = array();
		 
		 $iUserId = getLoggedInUserId();
            $SQL = <<<SQL
				SELECT umf.user_crm_meta_field_id,  
					mf.html_control_type,
				umf.field_label,
				umf.field_default_value
			FROM  crm_meta_fields mf , crm_user_meta_fields umf
			WHERE mf.crm_meta_field_id = umf.crm_meta_field_id
			AND   umf.user_id = $iUserId       

SQL;
			if ($result = $this->db->query($SQL)) 
			{
				return $result->result_array();
			}
			return $result;
    }
	
	public function deleteCrmById($iUserCrmId = 0)
    {
		$iUserId           = getLoggedInUserId();
		 $sql = <<<QUERY
					DELETE
					FROM crm_user_meta_fields
					WHERE user_crm_meta_field_id = '$iUserCrmId';
QUERY;

        if ($this->db->query($sql)) 
		{
		
			 $sql = <<<QUERY
					DELETE
					FROM crm_meta_fields_data
					WHERE field_id = '$iUserCrmId'
					AND created_by = '$iUserId'
QUERY;
			return $this->db->query($sql);
        }
    }

    function saveUserMetaFields($aData = array())
    { 
        if ($aData)
        {
            $iUserId           = getLoggedInUserId();
            $sMetaField        = $aData['metafields'];
            $sLabel            = $aData['label'];
            $sOptions          = $aData['options'];
            $dDate             = date(DATE_FORMAT_MYSQL);	

	



                $SQL = <<<SQL
				INSERT INTO crm_user_meta_fields ( user_id, crm_meta_field_id, field_label, field_default_value, created_on,created_by )
				VALUES ( '$iUserId','$sMetaField','$sLabel','$sOptions','$dDate','$iUserId' );
				 
SQL;
                if ($this->db->query($SQL))
                {
                    return $this->db->affected_rows();
                }
            }
        return false;
    }
    
    function getCrmUserMetaFields($iUserId=0)
    { 
        $result = array();
        if ($iUserId)
        {
            $SQL = <<<SQL

			SELECT  crmf.html_control_type as 'field_type', 
                                crmuf.field_label ,
                                crmuf.field_default_value , 
                                crmuf.user_crm_meta_field_id as 'field_id'  
                        FROM   crm_user_meta_fields crmuf
                        INNER JOIN crm_meta_fields crmf
                        ON crmf.crm_meta_field_id = crmuf.crm_meta_field_id
                        WHERE crmuf.user_id = '$iUserId'
			
				 
SQL;
                $result = $this->db->query($SQL);
                
                if ($result)
                {
                    return $result->result_array();
                }
                return $result;
         }
        return false;
    }
}

