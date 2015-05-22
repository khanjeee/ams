<?php

class Package_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function createPackage($sCallFrom = '',$aData = array())
    {
        if ($aData)
        {
            $bisEditMode        = false;
            $aData              = $aData['package'];
            $sTitle             = $aData['title'];
            $sDescription       = $aData['description'];
            $sPrice             = number_format($aData['price'], 2, '.', '');
            $sStatus            = intval($aData['status']);
            $iCreated           = getDatabaseDate();
            $iUserId            = getLoggedInUserId();
            $PromoCode          = '';
            if(isset($aData['whitelabel']) and $aData['whitelabel'])
            {
                $PromoCode = $aData['whitelabel'];
            }

            if(!$bisEditMode)    # Insert!
            {
                $SQL = <<<SQL

				INSERT INTO  packages
                (
                    title,description,price,status,promotion_code,created_on,created_by
                )
				VALUES
				(
                    '$sTitle','$sDescription','$sPrice','$sStatus','$PromoCode','$iCreated','$iUserId'
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
                        $TemplatePrice = trim($aData['template_price'][$TemplateId]);
                        $aInnerValues[] = "('$iPackage','$iProductId','$TemplateId','$TemplatePrice', '".getDatabaseDate()."','$iUserId')";
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
                      template_price,
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
            $sPrice             = number_format($aData['price'], 2, '.', '');
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

    public function loadPromotionCodePackages($iPromotionCode)
    {
        $result = '';

        $sql = <<<QUERY

        SELECT
               package_id ,
               title ,
               description ,
               promotion_code ,
               price
            FROM packages
            WHERE
                                promotion_code  =   '$iPromotionCode'
                        AND     status      =   '1'
QUERY;

        $Query = $this->db->query($sql);
        $result = $Query->result_array();
        
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

         $SQL = <<<DATA
             SELECT `package_id`, `title`, `description`, `price` FROM (`packages`) WHERE `is_deleted` = '0' AND promotion_code = ''
DATA;

         $Query = $this->db->query($SQL);
         return $Query->result();
    }

    function getPackageImage($iPackageId = 0 )
    {
        if($iPackageId)
        {
            $SQL = <<<SQL

        SELECT image as package_image FROM template_folds WHERE template_id IN
        (
          SELECT template_id FROM templates WHERE product_id =
          (
            SELECT MAX(product_id) FROM package_products WHERE package_id='$iPackageId'
          )
        )

        AND image IS NOT NULL
        LIMIT 1

SQL;
            $Query = $this->db->query($SQL);
            $Image =  $Query->row('package_image');

            if($Image)
            {
                    return $Image;
            }
            return '';
        }

        return false;
    }
	
	
	
	public function getPackagesModules($iPackageId)
    {
		 $Row = array();
         $SQL = <<<DATA
				SELECT pm.package_module_id, pm.module_id 
				FROM   package_modules pm, modules m 
				WHERE  pm.package_id = $iPackageId
				AND    pm.module_id = m.module_id 
				 
DATA;
         if ($result = $this->db->query($SQL))
        {
            $Row =  $result->row('module_id');
            if($Row) return true;
        }
        return false;
		
//			SELECT package_module_id, module_id 
//				FROM package_modules 
//				WHERE package_id = $iPackageId
    }
}
