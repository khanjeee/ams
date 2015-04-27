<?php

class Predefined_Campaign_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function createCampaign($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode        = $aData['isEditMode'];
            $aData              = $aData['aData'];
            $sTitle             = $aData['title'];
            $sDescription       = $aData['description'];
            $iCreated           = getDatabaseDate();
            $iUserId            = getLoggedInUserId();


            if(!$bisEditMode)    # Insert!
            {
                $SQL = <<<SQL

				INSERT INTO  predefined_campaigns
                (
                    user_id,title,description,created_on,created_by
                )
				VALUES
				(
                    '$iUserId','$sTitle','$sDescription','$iCreated','$iUserId'
                )
SQL;

                if ($this->db->query($SQL))
                {
                    if ($iCampaign = $this->db->insert_id())
                    {
                        return $iCampaign;
                    }
                }
            }
            else
            {
                $iCampaign             = $aData['predefined_campaign_id'];
                $sUpdateSQL = <<<SQL

				UPDATE  predefined_campaigns
                SET
                        title                       = '$sTitle',
                        description                 = '$sDescription',
                        last_updated_on             = '$iCreated',
                        last_updated_by             = '$iUserId'
                WHERE   predefined_campaign_id        = '$iCampaign'
                LIMIT 1
SQL;

                if($this->db->query($sUpdateSQL)){return $this->db->affected_rows();}
            }
        }
        return false;
    }


    function setPackageProducts($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode            = false;
            $aProducts              = $aData['products'];
            $iPackage               = $aData['package_id'];
            $iUserId                = getLoggedInUserId();

            if($aProducts)
            {
                $aInnerValues       = array();
                $iTotalProducts     = count($aProducts);

                for($p=0; $p < $iTotalProducts; $p++)
                {
                    $aInnerValues[] = "('$iPackage','$aProducts[$p]','".getDatabaseDate()."','$iUserId')";
                }

                if($aInnerValues)
                {
                    $sInnerValue = 'VALUES '.implode(',',$aInnerValues);
                    $sInsertSQL  = <<<SQL

                    INSERT INTO package_products
                    (
                      package_id ,
                      product_id ,
                      created_on ,
                      created_by
                     )
                      $sInnerValue
SQL;
                    if($sInsertSQL)
                    {
                        if($this->db->query($sInsertSQL)){return $this->db->affected_rows();}
                    }
                }
            }
        }

        return false;
    }


    function setPackageProductTemplates($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode            = false;
            $aTemplates             = $aData['templates'];
            $iPackage               = $aData['package_id'];
            $iUserId                = getLoggedInUserId();

            if($aTemplates)
            {
                $aInnerValues       = array();

                foreach($aTemplates as $iProductId => $Template)
                {
                    foreach($Template as $TemplateId)
                    {
                        $aInnerValues[] = "('$iPackage','$iProductId','$TemplateId','".getDatabaseDate()."','$iUserId')";
                    }
                }

                if($aInnerValues)
                {
                    $sInnerValue = 'VALUES '.implode(',',$aInnerValues);
                    $sInsertSQL  = <<<SQL

                    INSERT INTO package_product_templates
                    (
                      package_id,
                      product_id,
                      template_id,
                      created_on,
                      created_by
                     )
                      $sInnerValue
SQL;
                    if($sInsertSQL)
                    {
                        if($this->db->query($sInsertSQL)){return $this->db->affected_rows();}
                    }
                }
            }
        }
        return false;
    }

    function savePackageInfo($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode        = $aData['isEditMode'];
            $aData              = $aData['aData'];
            $sTitle             = $aData['title'];
            $sDescription       = $aData['description'];
            $sPrice             = intval($aData['price']);
            $sStatus            = $aData['status'];
            $sType              = $aData['type'];
            $iUserId            = getLoggedInUserId();


           if(!$bisEditMode)    # Insert!
           {
               $SQL = <<<SQL

				INSERT INTO  packages
                (
                    title,description,price,created_by,status,type
                )
				VALUES
				(
                    '$sTitle','$sDescription','$sPrice','$iUserId','$sStatus','$sType'
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
            else  # UPDATE!
            {
               /* SQL = <<<SQL
                UPDATE  packages
                SET  package_id  = 'package_id',
                   type  = 'type',
                   title  = 'title',
                   description  = 'description',
                   promotion_code  = 'promotion_code',
                   price  = 'price',
                   currency  = 'currency',
                   status  = 'status',
                   created_on  = 'created_on',
                   created_by  = 'created_by',
                   last_updated_on  = 'last_updated_on',
                   last_updated_by  = 'last_updated_by'
                WHERE  package_id  = 'package_id';
                LIMIT 1
               */
SQL;

            }
        }
        return 0;
    }



    function setPackageModules($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode            = false;
            $aModules               = $aData['modules'];
            $iPackage               = $aData['package_id'];
            $iUserId                = getLoggedInUserId();

            if($aModules)
            {
                $aInnerValues       = array();
                $iTotalModules     = count($aModules);

                for($p=0; $p < $iTotalModules; $p++)
                {
                    $aInnerValues[] = "('$iPackage','$aModules[$p]','".getDatabaseDate()."','$iUserId')";
                }

                if($aInnerValues)
                {
                    $sInnerValue = 'VALUES '.implode(',',$aInnerValues);
                    $sInsertSQL  = <<<SQL

                    INSERT INTO package_modules
                    (
                      package_id ,
                      module_id ,
                      created_on ,
                      created_by
                     )
                      $sInnerValue
SQL;
                    if($sInsertSQL)
                    {
                        if($this->db->query($sInsertSQL)){return $this->db->affected_rows();}
                    }
                }
            }
        }

        return false;
    }
    
    
    
    
     public function getAllPackages($aParams = array())
     { //-->, $RoleId = 0, $iLimit = 0,$ReturnCount = FALSE,$Offset = 0,$Search = false

         $recordsPerPage = LISTING_PER_PAGE;

         $offset = -1;
         $returnCount = $aParams[ACTION_RECORD_COUNT];

         if (isset($aParams[ACTION_PAGE_OFFSET]))
         {
             $offset = $aParams[ACTION_PAGE_OFFSET];
         }

        $aWhereClause   = array();
        $aWhereClause[] = " ( is_deleted ='0' ) ";

        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(p.package_id) AS count ';
        } else {
            $sSelect = 'p.package_id, p.type, p.title, p.description, p.promotion_code,p.price, p.currency, p.charging_frequency, p.status,                            p.created_on,created_by, last_updated_on, last_updated_by';
	

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY p.package_id DESC ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				packages p 		
		 
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


    public function loadPackage($iPackageId)
    {
        $result = array('package'=>array(),'products'=>array());

        $sql = <<<QUERY

		    SELECT
               package_id ,
               title ,
               description ,
               promotion_code ,
               price
            FROM packages
            WHERE
                                package_id  =   '$iPackageId'
                        AND     status      =   '1'
            LIMIT 1
QUERY;

        $Query = $this->db->query($sql);

        $result['package']                  = $Query->row();
        $result['products']                 = $this->getPackageProducts($iPackageId);

        if($iTotalProducts = count($result['products']))
        {
            for($p=0; $p <$iTotalProducts; $p++ )
            {
                $result['products'][$p]['templates'] = $this->getPackageProductTemplate($result['products'][$p]['product_id']);
            }
        }

        return $result;
    }


    public function getPackageProductTemplate($iProductId)
    {
        $Sql = <<<QUERY

		    SELECT
                 template_id ,
                 product_id ,
                 title ,
                 description ,
                 printing_price ,
                 width ,
                 height ,
                 cut_off_period ,
                 status 
            FROM templates WHERE product_id = '$iProductId'

QUERY;

        $Query = $this->db->query($Sql);
        return $Query->result_array();
    }

    public function getPackageProducts($iPackageId)
    {
        $Sql = <<<QUERY

		    SELECT
               product_id ,
               title ,
               description 
            FROM products
            WHERE product_id IN(SELECT
               product_id 
            FROM package_products
            WHERE package_id='$iPackageId')

QUERY;

        $Query = $this->db->query($Sql);
        return $Query->result_array();
    }




    
    public function deletePackagById($sPackageId = array())
    {
        $data = array('is_deleted' => '1');
        $this->db->where('package_id', $sPackageId);
        $this->db->update('packages', $data);
        return $this->db->affected_rows();
    }
    
    
    public function getAllPackagesDropDown()
     {
         $result    =       array();

                            $this->db->select('package_id,title');
                            $this->db->where('is_deleted', '0');
         $query      =      $this->db->get('packages');
         $result     =      $query->result();

         return $result;
    }
    

    function getAllCampaigns($aParams)
    {

        $recordsPerPage = LISTING_PER_PAGE;

        $offset = -1;
        $returnCount = $aParams[ACTION_RECORD_COUNT];

        if (isset($aParams[ACTION_PAGE_OFFSET]))
        {
            $offset = $aParams[ACTION_PAGE_OFFSET];
        }

        $aWhereClause   = array();
        $aWhereClause[] = " ( is_deleted ='0' ) ";
        if(!isSuperAdmin())
        {
            $aWhereClause[] = " ( user_id ='1' ) ";
        }

        $sWhereCondition = '';

        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        if ($returnCount) {
            $sSelect = ' COUNT(c.predefined_campaign_id) AS count ';
        }
        else
        {
            $sSelect = 'c.predefined_campaign_id,c.title,c.description,c.created_on';

            if ($offset > -1)
            {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY c.predefined_campaign_id DESC ';
        }

        $sql = <<<QUERY

		 SELECT
				$sSelect
		 FROM
				predefined_campaigns c

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

    function setCount($sCallFrom  = '', $aData = array())
    {
        if($sCallFrom == 'IncreaseCampaignBatchCount')
        {
            $iCampaignId = $aData['iCampaignId'];

            $sSQL = <<<SQL

            UPDATE 	campaigns
            SET 	total_batches = total_batches+1
            WHERE 	predefined_campaign_id = '$iCampaignId'
            LIMIT 1
SQL;

            if($this->db->query($sSQL)){return $this->db->affected_rows();}
        }
        return 0;
    }

    public function deleteCampaignById($iCampaignId = array())
    {
        $data = array('is_deleted' => '1');
        $this->db->where('predefined_campaign_id', $iCampaignId);
        $this->db->update('predefined_campaigns', $data);
        return $this->db->affected_rows();
    }


    public function loadCampaign($iCampaignId=1)
    {
        $aCampaignData = array();

        if($iCampaignId)
        {
            $sSQL = <<<SQL

            SELECT * FROM predefined_campaigns where predefined_campaign_id='$iCampaignId'
            LIMIT 1
SQL;

            $DbResult                               =      $this->db->query($sSQL);
            $aCampaignData['aCampaign']             =      $DbResult->row_array();
            $aBatches                               =      $this->getCampaignBatches($iCampaignId,getLoggedInUserId());

            if($aBatches)
            {
                for($b=0; $b<count($aBatches);$b++)
                {
                    $aCampaignData['aBatches'][$aBatches[$b]['predefined_campaign_batch_id']]                              =     $this->getBatchSummary($aBatches[$b]['predefined_campaign_batch_id']);
                    $aCampaignData['aBatches'][$aBatches[$b]['predefined_campaign_batch_id']]['predefined_campaign_batch_id']         =     $aBatches[$b]['predefined_campaign_batch_id'];
                }
            }
        }
        return $aCampaignData;
    }

    public function getCampaignBatches($iCampaignId = 0,$iUserId = 0 )
    {
        if($iCampaignId && $iUserId)
        {
            $sSQL = <<<SQL

           SELECT
              predefined_campaign_batch_id
        FROM  predefined_campaign_batches
        WHERE predefined_campaign_id='$iCampaignId'
        AND   user_id='$iUserId'
SQL;

            $DbResult = $this->db->query($sSQL);
            return $DbResult->result_array();
        }
        return array();
    }

    function getBatchSummary($iCampaignBatchId = 0)
    {
        $aBatch = array();

        if($iCampaignBatchId)
        {
            
            $SQL = <<<SQL

            SELECT
                   cb.title as batch_title,
                   cb.description as batch_description,
                   cb.schedule_date ,
                   cb.created_on ,
                   cb.schedule_time ,
                   cb.cut_off_date ,
                   cb.last_preview_images ,

                   u.first_name,
                   u.last_name,

                   /*c.title          as campaign_title,
                   c.description    as campaign_description,*/
                        
                   p.title          as product_title,
                   p.description    as product_description,
                   p.product_id ,

                   t.title          as template_title,
                   t.template_id ,
                   t.description    as template_description,
                   t.printing_price as template_printing_price

            FROM
                  predefined_predefined_campaign_batches cb,
                  users u,
                  /*campaigns c,*/
                  products p,
                  templates t

            WHERE
                  cb.predefined_campaign_batch_id  =   '$iCampaignBatchId'
            AND   u.user_id             =   cb.user_id
            /*AND   c.predefined_campaign_id         =   cb.predefined_campaign_id*/
            AND   p.product_id          =   cb.product_id
            AND   t.template_id         =   cb.template_id

            LIMIT 1
SQL;
            $DbResult                           =   $this->db->query($SQL);
            $aBatch                             =   $DbResult->row_array();
            $aBatch['BatchLists']               =   $this->getBatchLists($iCampaignBatchId);
        }

        return $aBatch;
    }

    function getBatchLists( $iCampaignBatchId = 0 )
    {
        $aListsData = array();

        if($iCampaignBatchId)
        {
            $SQL = <<<SQL

              SELECT
               list_id,
               title as list_title
              FROM lists WHERE list_id IN
              (
                  SELECT list_id
                  FROM  predefined_campaign_batches_lists
                  WHERE predefined_campaign_batch_id='$iCampaignBatchId'
              )
SQL;
            $DbResult                           =   $this->db->query($SQL);
            $aListsData                         =   $DbResult->result_array();
        }
        return $aListsData;
    }


    function getCampaign( $iCampaignId = 0 )
    {
        if($iCampaignId)
        {
            $SQL = <<<SQL

               SELECT
               
                   predefined_campaign_id ,
                   user_id ,
                   title ,
                   description ,
                   total_batches

                FROM predefined_campaigns where predefined_campaign_id='$iCampaignId'
              LIMIT 1
SQL;
            $DbResult                           =   $this->db->query($SQL);
            return $DbResult->row();
        }
        return array();
    }

    function CampaignCanBeDeleted($iCampaignId = 0 )
    {
        if($iCampaignId)
        {
            $SQL = <<<SQL

               SELECT
                        predefined_campaign_batch_id
               FROM
                        predefined_campaign_batches
               Where
                        predefined_campaign_id='$iCampaignId'
               AND
                        current_status > 1
               LIMIT 1
SQL;
            $DbResult                           =   $this->db->query($SQL);
            $Row =  $DbResult->row();

            if($Row)
            {
                return false;
            }
        }
        return true;
    }
    
    /* @Author:Shoaib Ahemd 
     * @Date:4/13/15
     * @Descritption: returns pre-defined campaign data created by admin
     */

    function getPredefinedCampaigns($iWhiteLabel = 0)
    {
        $SQL = <<<SQL

        SELECT

        predefined_campaign_id  ,
        user_id  ,
        title  ,
        description  ,
        total_batches  ,
        1 as is_predefined_campaign,
        created_on
  
        FROM predefined_campaigns WHERE predefined_campaign_id

        IN
        (

            SELECT
                DISTINCT predefined_campaign_id
            FROM
                predefined_campaigns
            WHERE
                whitelabel_id='$iWhiteLabel'
        )


SQL;

        $DbResult   =   $this->db->query($SQL);
        return $DbResult->result();
    }

    function IsPredefinedCampaign($iCampaignId = 0)
    {
        $SQL = <<<SQL

        SELECT
                predefined_campaign_id
        FROM
                predefined_campaigns
        WHERE
                predefined_campaign_id = '$iCampaignId'

SQL;

        $DbResult   =   $this->db->query($SQL);
        return $DbResult->row('predefined_campaign_id');

    }



    function savePreDefinedCampaign($sCallFrom ='' , $aData = array())
    {
        $bisEditMode            =    $aData['isEditMode'];
        $aData                  =    $aData['aData'];
        $iWhiteLabelId          =    $aData['whitelabel_id'];
        $iPackageId             =    $aData['package_id'];
        $iCampaignId            =    $aData['predefined_campaign_id'];
        $iBatchId               =    $aData['predefined_campaign_batch_id'];
        $iProductId             =    $aData['product_id'];
        $iTemplateId            =    $aData['template_id'];
        $iCreated               =    getDatabaseDate();
        $iUserId                =    getLoggedInUserId();

        if(!$bisEditMode)
        {
            $SQL = <<<SQL

            UPDATE  predefined_campaign_batches
            SET
               whitelabel_id    = '$iWhiteLabelId',
               package_id       = '$iPackageId',
               last_updated_on  = '$iCreated',
               last_updated_by  = '$iUserId'
            WHERE  predefined_campaign_batch_id  = '$iBatchId'
            LIMIT 1
SQL;

            if ($this->db->query($SQL))
            {
                return $this->db->affected_rows();
            }
        }
        return 0;
    }
}
