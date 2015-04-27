<?php

class Product_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

     public function getAllProducts()
     {
         $result    =       array();

                            $this->db->select('product_id,title');
         $query      =      $this->db->get('products');
         $result     =      $query->result();

         return $result;
    }


    public function getTemplatesByProductId($iProductId = 0)
    {
        $result    =        array();

        if($iProductId)
        {
                                $this->db->select('template_id,title,description,printing_price,width,height');
            $query      =       $this->db->get_where('templates', array('product_id' => $iProductId));
            $result     =       $query->result_array();
        }

        return $result;
    }
    
    
    
      public function createProduct($sCallFrom = '',$aData = array())
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

}
