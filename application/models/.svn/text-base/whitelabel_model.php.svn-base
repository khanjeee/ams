<?php

class WhiteLabel_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function createWhiteLabel($sCallFrom = '',$aData = array())
    {
	  if ($aData)
      {
		  
            $bisEditMode        = $aData['bisEditMode']; 
			$iWhiteLabelId		= $aData['whitelabel_id'];
            $sTitle             = $aData['title'];
            $sDescription       = $aData['description'];
			$sEmailAddress		= $aData['email_address'];
		    $sSolutionType		= $aData['solution_type'];
            $iPromotionCode     = $aData['promotion_code'];
            $sColorCode         = json_encode($aData['selected_theme']);
            $sCompanyLogo       = $aData['logo'];
            $iCreated           = getDatabaseDate();
            $iUserId            = getLoggedInUserId();

            if($bisEditMode)    # Insert!
            {
              $SQL = <<<SQL

				UPDATE  whitelabel
				SET		  title			 = '$sTitle',
						  description	 = '$sDescription',
						  promotion_code = '$iPromotionCode',
						  logo			 = '$sCompanyLogo',
						  email_address  = '$sEmailAddress',
						  solution_type  = '$sSolutionType',
						  selected_theme = '$sColorCode',
						  updated_on	 = '$iCreated',
						  updated_by	 = '$iUserId'
				WHERE   whitelabel_id		 = '$iWhiteLabelId';
SQL;
			}
			else
			{
				$SQL = <<<SQL

				INSERT INTO  whitelabel
                (
                    title,
					description,
					email_address,
					solution_type,
					promotion_code,
					selected_theme,
					logo,	
					created_on,
					created_by
                )
				VALUES
				(
                    '$sTitle',
					'$sDescription',
					'$sEmailAddress',
					'$sSolutionType',
					'$iPromotionCode',
					'$sColorCode',
					'$sCompanyLogo',
					'$iCreated',
					'$iUserId'
                )
SQL;
			}
			if ($this->db->query($SQL))
                {
					
					
                    if ($bisEditMode)
                    {
                        return $iWhiteLabelId;
						
                    }else
					{
						return  $this->db->insert_id();
					}
                }
		 }
			 return false;
        }
       
    public function getWhiteLabel($iWhiteLabelId = 0)
    {  
		$SQL = <<<SQL

		SELECT 
		   whitelabel_id ,
           title ,
           description ,
           promotion_code ,
           logo ,
           selected_theme ,
           solution_type ,
           email_address,
           created_on
   FROM whitelabel WHERE whitelabel_id = '$iWhiteLabelId' LIMIT 1
SQL;

        $result = $this->db->query($SQL);
        return $result->row_array();
    }

    public function getWhiteLabelUsers($iPromoCode = 0)
    {
        $SQL = <<<SQL

        SELECT COUNT(promotion_code) as total_subscriber FROM users WHERE promotion_code = '$iPromoCode'
SQL;
        $result = $this->db->query($SQL);
        return $result->row('total_subscriber');
    }


	
	
	 public function getAllWhiteLabel($aParams = array())
     { //-->, $RoleId = 0, $iLimit = 0,$ReturnCount = FALSE,$Offset = 0,$Search = false

         $recordsPerPage = LISTING_PER_PAGE;

         $offset = -1;
         $returnCount = $aParams[ACTION_RECORD_COUNT];

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }

        $aWhereClause   = array();
      

        $sWhereCondition = 'WHERE is_deleted = 0';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(w.whitelabel_id) AS count ';
        } else {
            $sSelect = 'w.whitelabel_id,
						w.title,
						w.description,
						w.promotion_code,
						w.selected_theme,
						w.created_on';
	

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY w.whitelabel_id DESC ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				whitelabel w 		
		 
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
	
	
	public function UpdateCompanyLogoById($iWhiteLabelId = 0 ,$aData =array()) 
    {  
		 $this->db->where('whitelabel_id', $iWhiteLabelId); 
		 $result	= $this->db->update('whitelabel', $aData); 
         if($result)
         {
			 return true;
         }
			 return false;
    }

	public function DeleteCompanyLogoById($iWhiteLabelId = 0) 
    {  
		 $this->db->where('whitelabel_id', $iWhiteLabelId);
		 $result = $this->db->delete('whitelabel'); 
         if($result)
         {
			 return true;
         }
			 return false;
    }
	public function CheckPromotionCode($iPromotionCode) 
    {  
		
		$this->db->where('promotion_code', $iPromotionCode);
		$result = $this->db->get('whitelabel');
		
		
		 if($result->result())
         {
			 return true;
         }
		 return false;
    }

    public function getPredefinedCampaigns($aParams)
    {
        $iWhiteLabelId  = $aParams['white_label_id'];
        $recordsPerPage = LISTING_PER_PAGE;
        $offset         = -1;
        $returnCount    = $aParams[ACTION_RECORD_COUNT];

        if (isset($aParams[ACTION_PAGE_OFFSET]))
        {
            $offset = $aParams[ACTION_PAGE_OFFSET];
        }

        $sWhereCondition = <<<WHERE
            WHERE campaign_id IN
            (
                SELECT campaign_id FROM predefined_campaigns WHERE whitelabel_id='$iWhiteLabelId'
            )
WHERE;

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount)
        {
            $sSelect    = ' COUNT(campaign_id) AS count ';
            $sLimit     = 'LIMIT 1 ';
        }
        else
        {
            $sSelect = ' 
                             campaign_id ,
                             title ,
                             description 
   ';

            if ($offset > -1)
            {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY campaign_id DESC ';
        }

        $sql = <<<QUERY

		 SELECT
				$sSelect
		 FROM
				campaigns

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
                return $result->result_array();
            }
        }

        return  array();
    }


    public function loadPreDefinedCampaigns($iCampaignId = 0)
    {
        if($iCampaignId)
        {
            $sSQL = <<<SQL

                SELECT

                c.campaign_id ,
                c.user_id       as campaign_created_by,
                c.title         as campaign_title,
                c.description   as campaign_description,

                p.product_id ,
                p.title       as product_title,
                p.description as product_description,
                p.is_active   as product_is_active,

                t.template_id ,
                t.title           as template_title,
                t.description     as template_description,
                t.printing_price  as template_printing_price,
                t.cut_off_period  as template_cut_off_period,
                t.status          as template_status

                FROM products p, templates t, campaigns c , predefined_campaigns pc

                WHERE
                        pc. campaign_id ='$iCampaignId'
                AND 	pc. product_id =p. product_id
                AND 	pc. campaign_id =c.campaign_id
                AND 	pc. template_id =t. template_id

SQL;

            if ($result = $this->db->query($sSQL))
            {
                return $result->row_array();
            }
        }
        return array();
    }


    public function PredefinedCampaignsExists($iWhiteLabelId)
    {
        $SQL = <<<SQL
                        SELECT COUNT(campaign_id) AS has_predefined_campaigns FROM predefined_campaigns WHERE whitelabel_id='$iWhiteLabelId'
SQL;

        if ($result = $this->db->query($SQL))
        {
            return $result->row('has_predefined_campaigns');
        }
        return 0;
    }
    
    function softDeleteWhiteLabel($whiteLabelId=0)
    {
        $data = array('is_deleted' => '1');
        $this->db->where('whitelabel_id', $whiteLabelId);
        if($this->db->update('whitelabel', $data))   
        {
            return true;
        }
        return false;
    }
}
