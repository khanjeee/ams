<?php

class Batch_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        
    }

    function createBatch($aData = array())
    {
        if ($aData)
        {
            $isEditMode         = $aData['isEditMode'];
            $sTitle             = $aData['name'];
            $sDesc              = $aData['description'];
            $iBatchId           = $aData['batch_id'];
            $iCampaignId        = $aData['campaign_id'];
            $iCurrentStatus     = BATCH_IS_IN_EDIT_MODE;// Edit Mode
            //$dTomorrow          = date('Y-m-d', strtotime('+1 day', time()));
            $dDate              = date(DATE_FORMAT_MYSQL);
            $iUserId            = getLoggedInUserId();

            # Insert!
            $SQL = '';
            if($isEditMode)
            {
                $SQL = <<<SQL

		UPDATE campaign_batches SET
                title='$sTitle',description='$sDesc',last_updated_on='$dDate',last_updated_by='$iUserId'
                WHERE campaign_batch_id='$iBatchId';        
			
				 
SQL;

            }
            else
            {
                $SQL = <<<SQL

            INSERT INTO campaign_batches
            (
                campaign_id,user_id,title,description,current_status,created_on,created_by
            )
			VALUES
			(
			  '$iCampaignId',
			  '$iUserId',
			  '$sTitle',
			  '$sDesc',
			  '$iCurrentStatus',
			  '$dDate',
			  '$iUserId'
			)
				 
SQL;
            }

            if ($this->db->query($SQL))
            {
               return ($isEditMode) ? $iBatchId : $this->db->insert_id() ;
            }
        }
        return false;
    }
    
    
    
     function updateBatch($aData = array())
    { 
        if ($aData)
        {
            //d($aData);
            $isEditMode         = $aData['isEditMode'];
            $sTitle             = $aData['name'];
            $sDesc              = $aData['description'];
            $iBatchId           = $aData['batch_id'];
            $dDate              = date(DATE_FORMAT_MYSQL);
            $iUserId            = getLoggedInUserId();

            # Insert!
            $SQL = '';
            if($isEditMode)
            {
                $SQL = <<<SQL

		UPDATE campaign_batches SET
                title='$sTitle',description='$sDesc',last_updated_on='$dDate',last_updated_by='$iUserId'
                WHERE campaign_batch_id='$iBatchId';        
			
				 
SQL;

            }
           
            if ($this->db->query($SQL))
            {
               return $iBatchId;
            }
        }
        return false;
    }
    
    function createBatchList($aData = array())
    {
        if ($aData)
        {
            $bisEditMode = false;
            $aLists      = $aData['aList'];
            $iUserId     = getLoggedInUserId();
            $iBatchId    = $aData['batch_id'];
            $iCampaignId = $aData['campaign_id'];
            $dDate       = date(DATE_FORMAT_MYSQL);
            
            if($aLists)
            {
                $aInnerValues = array();
                $sInnerKeys   =   "(user_id,campaign_id,campaign_batch_id,list_id,created_on,created_by)" ;
                
               foreach($aLists as $key=>$data)
                {
                   $iListId = $data['list_id'];
                   
                   $aInnerValues[] = "('$iUserId','$iCampaignId','$iBatchId','$iListId','$dDate','$iUserId')";
                   
                }
                
                //d($aInnerValues);
                if(!empty($aInnerValues))
                {
                   $sInnerValues = implode(',',$aInnerValues);
                    $sInsertSQL  = <<<SQL

                    INSERT INTO campaign_batches_lists
                      $sInnerKeys
                     VALUES
                      $sInnerValues
SQL;

                        $this->db->query($sInsertSQL);
                        return $this->db->affected_rows();
                }
           }
        }

        return false;
        
    }
    
    function deleteBatchList($iBatchId = 0)
    {
        $this->db->where('campaign_batch_id', $iBatchId); 
        $this->db->delete('campaign_batches_lists'); 
        return $this->db->affected_rows();
    
    }

    function CheckBatchElementData($aData = array())
    {
        #Handling Data
        $iCampaignBatchId   =   $aData['campaign_batch_id'];
        $iTemplateId        =   $aData['template_id'];
        $iTemplateFoldId    =   $aData['template_fold_id'];
        $iTemplateElementId =   $aData['template_element_id'];
        $iElementPosition   =   $aData['element_position'];

        $SQL = <<<SQL

        SELECT
                template_content_id
        FROM    template_content
        WHERE
                    campaign_batch_id       =     '$iCampaignBatchId'
              AND   template_id             =     '$iTemplateId'
              AND   template_fold_id        =     '$iTemplateFoldId'
              AND   template_element_id     =     '$iTemplateElementId'
              AND   element_position        =     '$iElementPosition'
        LIMIT 1
SQL;

        $SQL = $this->db->query($SQL);
        return $SQL->row('template_content_id');
    }

    function UploadBatchContent($sCallFrom='',$aGivenData = array())
    {
        #Handling Data
        $aData              =   $aGivenData['aData'];
        $iCampaignBatchId   =   $aData['campaign_batch_id'];
        $iTemplateId        =   $aData['template_id'];
        $iTemplateFoldId    =   $aData['template_fold_id'];
        $iTemplateElementId =   $aData['template_element_id'];
        $sElementData       =   $aData['element_data'];
        $iElementPosition   =   $aData['element_position'];

        $dDate              =   date(DATE_FORMAT_MYSQL);
        $iUserId            =   getLoggedInUserId();

        if(!$aGivenData['isEditMode'])
        {
            $SQL = <<<SQL

            INSERT INTO  template_content
            (
                  campaign_batch_id ,
                  template_id ,
                  template_fold_id ,
                  template_element_id ,
                  element_position ,
                  element_data ,
                  created_on ,
                  created_by
             )
            VALUES
            (
                '$iCampaignBatchId',
                '$iTemplateId',
                '$iTemplateFoldId',
                '$iTemplateElementId',
                '$iElementPosition',
                '$sElementData',
                '$dDate',
                '$iUserId'
            )
SQL;

            if ($this->db->query($SQL)) {return $this->db->insert_id();}
        }
        else
        {
            $SQL = <<<SQL

            UPDATE
                  template_content
            SET
                  element_data          = '$sElementData',
                  last_updated_on       = '$dDate',
                  last_updated_by       = '$iUserId'

            WHERE
                  campaign_batch_id       =     '$iCampaignBatchId'
            AND   template_id             =     '$iTemplateId'
            AND   template_fold_id        =     '$iTemplateFoldId'
            AND   template_element_id     =     '$iTemplateElementId'
            AND   element_position        =     '$iElementPosition'

            LIMIT 1
SQL;
            if ($this->db->query($SQL)) {return $this->db->affected_rows();}
        }

        return 0;
    }

    function setBatchTemplate($sCallFrom='',$aData = array())
    {
        $success  = false; 
        if($aData)
        {
            #Handling Data
            $aData                  =   $aData['aData'];
            $iCampaignBatchId       =   $aData['campaign_batch_id'];
            $iTemplateId            =   $aData['template_id'];
            $iProductId             =   $aData['product_id'];
            $dDate                  =   date(DATE_FORMAT_MYSQL);
            $iUserId                =   getLoggedInUserId();

            $SQL = <<<SQL

            UPDATE campaign_batches
            SET
                   user_id                = '$iUserId',
                   product_id             = '$iProductId',
                   template_id            = '$iTemplateId',
                   last_updated_on        = '$dDate',
                   last_updated_by        = '$iUserId'
            WHERE  campaign_batch_id      = '$iCampaignBatchId';
SQL;
            
            if ($this->db->query($SQL)) {
                
                $success = true;
            }
        }

        return $success;
    }

    function getTemplateFoldsData( $iTemplateId = 0 )
    {
        $aTemplateFoldData = array();

        if(validateId($iTemplateId))
        {
            $aTemplateFoldData['aFolds'] = $this->getTemplateFolds($iTemplateId);

            if($aTemplateFoldData['aFolds'])
            {
                if($iTotalFolds = count($aTemplateFoldData['aFolds']))
                {
                    for($p=0; $p <$iTotalFolds; $p++ )
                    {
                        $aTemplateFoldData['aFolds'][$p]['elements'] = $this->getFoldElements($aTemplateFoldData['aFolds'][$p]['fold_id']);
                    }
                }
            }
        }
        return $aTemplateFoldData;
    }

    public function getTemplateFolds( $iTemplateId = 0 )
    {
        $aFolds = array();

        if(validateId($iTemplateId))
        {
            $SQL = <<<SQL

                SELECT
                   template_fold_id as fold_id,
                   title ,
                   description ,
                   image as default_fold_image
                FROM  template_folds
                WHERE template_id= '$iTemplateId'
SQL;
            if ($Result = $this->db->query($SQL))
            {
                $aFolds =  $Result->result_array();
            }
        }

        return $aFolds;
    }


    function getFoldElements( $iTemplateFoldId = 0)
    {
        $aTemplateFoldElements = array();

        if(validateId($iTemplateFoldId))
        {
            $SQL = <<<SQL

                SELECT
                        te.template_element_id AS element_id ,
                        te.title,
                        te.element_name,
                        te.html_control_type,
                        tfe.element_position,
                        tfe.element_label,
                        tfe.template_fold_id,
                        tfe.element_default_value
                FROM
                                        template_elements te
                INNER JOIN 		template_fold_elements tfe ON tfe.template_element_id= te.template_element_id

                AND 			tfe.template_fold_id='$iTemplateFoldId'
SQL;

            if ($Result = $this->db->query($SQL))
            {
                $aTemplateFoldElements =  $Result->result_array();
            }
        }

        return $aTemplateFoldElements;
    }


    function getBatchTemplateId($sCallFrom,$aData)
    {
        $iCampaignBatchId = 0;

        if($sCallFrom)
        {
            if($aData)
            {
                #Handling Data
                $iCampaignBatchId       =   $aData['campaign_batch_id'];
            }
        }

        if($iCampaignBatchId)
        {
            $SQL = <<<SQL

                SELECT
                        template_id
                FROM
                                        campaign_batches
                WHERE   campaign_batch_id='$iCampaignBatchId'
                LIMIT 1
SQL;

            if ($Result = $this->db->query($SQL))
            {
                return $Result->row('template_id');
            }
        }
        return 0;
    }

    function deleteOldBatchContent($sCallFrom,$iCampaignBatchId)
    {
        if($iCampaignBatchId)
        {
            $SQL = <<<SQL

                DELETE
                FROM    template_content
                WHERE   campaign_batch_id  = '$iCampaignBatchId'
SQL;

            return $this->db->query($SQL);
        }
        return 0;
    }

    function ScheduleBatch($sCallFrom='',$aData = array())
    {
        if($aData)
        {
            #Handling Data
            $aData                  =   $aData['aData'];
            $iCampaignBatchId       =   $aData['campaign_batch_id'];
            $dScheduleDate          =   $aData['schedule_date'];
            $dScheduleTime          =   $aData['schedule_time'];
            $dCutOffDate            =   date('Y-m-d', strtotime('-'.$aData['iCutOffPeriod'].' day', strtotime($dScheduleDate)));

            $SQL = <<<SQL

                UPDATE
                        campaign_batches
                SET
                        schedule_date  = '$dScheduleDate',
                        schedule_time  = '$dScheduleTime',
                        cut_off_date    = '$dCutOffDate'

                WHERE  campaign_batch_id  = '$iCampaignBatchId' LIMIT 1
SQL;
            if ($this->db->query($SQL)) {return $this->db->affected_rows();}
        }
        return 0;
    }

    function getCutOffBatches()
    {
        $dDate              = date(DATE_ONLY_FORMAT_MYSQL);
        $sBatchStatus = BATCH_READY_FOR_PRINTING;
        $SQL = <<<SQL

         SELECT
                campaign_batch_id
        FROM    campaign_batches
        WHERE current_status='$sBatchStatus'
        ORDER BY campaign_batch_id DESC

SQL;
        $DbResult                           =   $this->db->query($SQL);
        return $DbResult->result_array('campaign_batch_id');
    }

    function getBatchSummary($iCampaignBatchId = 0)
    {
        $aSummaryData = array();

        if($iCampaignBatchId)
        {
            $SQL = <<<SQL

            SELECT
                   cb.title as batch_title,
                   cb.description as batch_description,
                   cb.schedule_date ,
                   cb.campaign_batch_id ,
                   cb.campaign_batch_id ,
                   cb.last_preview_images ,
                   cb.cut_off_date ,
                   cb.cut_off_date ,
                   cb.current_status ,
                   cb.created_on ,
                   cb.template_id ,
                   cb.total_printing_cost ,

                   u.first_name,
                   u.last_name,

                   c.title          as campaign_title,
                   c.description    as campaign_description,
                   c.campaign_id    ,

                   p.title          as product_title,
                   p.description    as product_description,

                   t.title          as template_title,
                   t.description    as template_description,
                   t.printing_price as template_printing_price,
                   t.cut_off_period
            FROM
                  campaign_batches cb,
                  users u,
                  campaigns c,
                  products p,
                  templates t

            WHERE
                  cb.campaign_batch_id  =   '$iCampaignBatchId'
            AND   u.user_id             =   cb.user_id
            AND   c.campaign_id         =   cb.campaign_id
            AND   p.product_id          =   cb.product_id
            AND   t.template_id         =   cb.template_id

            LIMIT 1
SQL;

            $DbResult                               =   $this->db->query($SQL);
            $aSummaryData['BatchDetails']           =   $DbResult->row_array();
            $aSummaryData['BatchLists']             =   $this->getBatchLists($iCampaignBatchId);
            $iTemplePrintingPrice                   =   $aSummaryData['BatchDetails']['template_printing_price']; 
            $aSummaryData['BatchTotalPrintingPrice']=   $this->getTotalPrintingPrice($iCampaignBatchId,$iTemplePrintingPrice);
        }

        return $aSummaryData;
    }
    
    function loadBatch($iCampaignBatchId = 0)
    {
        $aSummaryData = array();

        if($iCampaignBatchId)
        {
            $SQL = <<<SQL

            SELECT
                   cb.title as batch_title,
                   cb.description as batch_description,
                   cb.schedule_date ,
                   cb.campaign_batch_id ,
                   cb.campaign_id,
                   cb.product_id,
                   cb.template_id, 
                   cb.schedule_time ,
                   cb.cut_off_date ,
                   cb.created_on,
                   cb.current_status ,
                   cb.user_id ,
                   cb.created_on,
                   t.printing_price as template_printing_price  

            FROM
                  campaign_batches cb,
                  templates t
                  
            WHERE
                  cb.campaign_batch_id  =   '$iCampaignBatchId'
            AND   t.template_id         =   cb.template_id        
                        
            LIMIT 1
SQL;
            $DbResult                               =   $this->db->query($SQL);
            $aSummaryData['BatchDetails']           =   $DbResult->row_array();
            $aSummaryData['BatchLists']             =   $this->getBatchListsFormated($iCampaignBatchId);
            $iTemplePrintingPrice                   =   $aSummaryData['BatchDetails']['template_printing_price'];    
            $aSummaryData['BatchTotalPrintingPrice']=   $this->getTotalPrintingPrice($iCampaignBatchId,$iTemplePrintingPrice);
        }

        return $aSummaryData;
    }

      /*@author :Shoaib
     * @desc    :Returns the total Printing price for a batch.
     * @params  :batch_id , template price
     */
    function getTotalPrintingPrice($iCampaignBatchId = 0,$iTemplePrintingPrice = 0)
    {
        
        
         if($iCampaignBatchId)
        {
            $SQL = <<<SQL

              SELECT SUM(contacts_count) TotalContacts
                FROM
                (
                   SELECT l.list_id,l.title AS list_title , COUNT(lm.contact_id) AS contacts_count
                   FROM lists l,list_members lm 
                        WHERE l.list_id IN  ( SELECT list_id FROM  campaign_batches_lists WHERE campaign_batch_id= '$iCampaignBatchId' )
                        AND l.list_id = lm.list_id
                        GROUP BY   l.list_id   
                ) tempTableListCount;         
              
SQL;
            $DbResult               =   $this->db->query($SQL);
            $totalBatchContacts     =   $DbResult->result_array();
            $totalContacts          =   $totalBatchContacts[0]['TotalContacts'];
            $totalPrintingPrice     = intval($totalContacts) * intval($iTemplePrintingPrice);
            
            return $this->updateTotalPrintingPrice($totalPrintingPrice,$iCampaignBatchId);
                
        }
        return 0;
    
    }
    
    function updateTotalPrintingPrice($iPrice,$iCampaignBatchId)
    {
        $data = array('total_printing_cost' => $iPrice);
        $this->db->where('campaign_batch_id', $iCampaignBatchId);
        if($this->db->update('campaign_batches', $data))   
        {
            return $iPrice;
        }
        return 0;
        
        
    }

    function getBatchListsFormated( $iCampaignBatchId = 0 )
    {
        $aListsData = array();

        if($iCampaignBatchId)
        {
            $SQL = <<<SQL

              SELECT
               list_id,
               title as text
              FROM lists WHERE list_id IN
              (
                  SELECT list_id
                  FROM  campaign_batches_lists
                  WHERE campaign_batch_id='$iCampaignBatchId'
              )
SQL;
            $DbResult                           =   $this->db->query($SQL);
            $aListsData                         =   $DbResult->result_array();
        }
        return $aListsData;
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
                  FROM  campaign_batches_lists
                  WHERE campaign_batch_id='$iCampaignBatchId'
              )
SQL;
            $DbResult                           =   $this->db->query($SQL);
            $aListsData                         =   $DbResult->result_array();
        }
        return $aListsData;
    }
    
  
    function getElementDefaultData($iTemplateFoldId)
    {
//        $SQL = <<<SQL
//
//        SELECT
//           template_fold_id ,
//           template_element_id ,
//           element_position ,
//           element_data 
//        FROM template_default_content
//        WHERE template_fold_id = '$iTemplateFoldId'
//
//SQL;
          $SQL = <<<SQL

        SELECT
           e.template_fold_id ,
           e.template_element_id ,
           e.element_position ,
           e.element_data,
           t.element_name
        FROM template_default_content e
        INNER JOIN  template_elements t 
        ON          t.template_element_id = e.template_element_id               
        WHERE e.template_fold_id = '$iTemplateFoldId'

SQL;
          
        $Result   =   $this->db->query($SQL);
        return $Result->result_array();
    }

    function getBatchUploadedContent($iTemplateFoldId, $iCampaignBatchId)
    {
//         $SQL = <<<SQL
//
//        SELECT
//               element_position ,
//               element_data
//        FROM  template_content
//        WHERE template_fold_id = '$iTemplateFoldId' AND campaign_batch_id='$iCampaignBatchId'
        
        
        $SQL = <<<SQL

        SELECT
               e.element_position ,
               e.element_data,
               t.element_name
        FROM        template_content e
        INNER JOIN  template_elements t 
        ON          t.template_element_id = e.template_element_id     
        WHERE e.template_fold_id = '$iTemplateFoldId' AND e.campaign_batch_id='$iCampaignBatchId'

SQL;

        $Result   =   $this->db->query($SQL);
        return $Result->result_array();
    }

    function getListIdOfBatch($BatchId=0)
    {
        if($BatchId)
        {
            $SQL = <<<SQL

            SELECT list_id FROM list_members WHERE list_id IN
            (
              SELECT list_id FROM campaign_batches_lists WHERE campaign_batch_id = '$BatchId'
            )
            LIMIT 1
SQL;
        }

        $Result   =   $this->db->query($SQL);
        return $Result->row('list_id');
    }

    function getTagValue($ListId=0,$Field='')
    {
        if($ListId)
        {
            $SQL = <<<SQL

            SELECT $Field FROM contacts WHERE contact_id IN
            (
                SELECT contact_id FROM list_members WHERE list_id='$ListId'
            )
            LIMIT 1
SQL;
        }

        $Result   =   $this->db->query($SQL);
        return $Result->row($Field);
    }


    function DownloadBatchContent($BatchId = 0)
    {
        if($BatchId)
        {
            $Url = './media/fold_elements/';

            $SQL = <<<SQL

            /* Download Batch Uploaded Content */

            SELECT
                  concat('$Url',element_data) as file_server_path,
                  element_data as file_name

            FROM  template_content
            WHERE  template_element_id  IN
            (
                SELECT  template_element_id  FROM  template_elements  WHERE  html_control_type  = 'image'
            )
            AND  campaign_batch_id  = '$BatchId'
SQL;
        }

        $Result   =   $this->db->query($SQL);
        return $Result->result_array();
    }

    function DownloadDefaultContent($BatchId = 0)
    {
        if($BatchId)
        {
            $SQL = <<<SQL

            SELECT

            CONCAT('.',image) AS file_server_path,
            CONCAT(title,'.',image_extention) AS file_name

            FROM `template_folds` WHERE `template_fold_id` IN
            (
            SELECT template_fold_id FROM  `template_folds` WHERE template_id
            IN
            (
            SELECT `template_id` FROM `campaign_batches` WHERE `campaign_batch_id` = '$BatchId'
            )
            )
SQL;
        }

        $Result   =   $this->db->query($SQL);
        return $Result->result_array();
    }

    function saveLastGeneratedPreview($iCampaignBatchId , $Preview_Data)
    {
        if($iCampaignBatchId and $Preview_Data)
        {
            $SQL = <<<SQL

            update  campaign_batches
            set
                    last_preview_images  = '$Preview_Data'

            where  campaign_batch_id  = '$iCampaignBatchId'
            LIMIT 1
SQL;
            if ($this->db->query($SQL)) {return $this->db->affected_rows();}
        }

        return 0;
    }

    function getLastGeneratedPreview($iCampaignBatchId )
    {
        if( $iCampaignBatchId )
        {
            $SQL = <<<SQL

           SELECT last_preview_images FROM campaign_batches where campaign_batch_id='$iCampaignBatchId'
SQL;
            $Result   =   $this->db->query($SQL);
            return $Result->row('last_preview_images');
        }
        return array();

    }


    function getFoldElementsData($aData = array())
    {
        $Value = '';
        if( $aData )
        {
            $iTemplateId        =  $aData['iTemplateId'];
            $iCampaignBatchId   =  $aData['iCampaignBatchId'];
            $iElementId         =  $aData['element_id'];
            $iElementPosition   =  $aData['element_position'];
            $iFoldId            =  $aData['iFoldId'];

            $SQL = <<<SQL

                  SELECT
                        element_data as provided_data
                  FROM  template_content
                  WHERE
                              campaign_batch_id             = '$iCampaignBatchId'
                        AND   template_id                   = '$iTemplateId'
                        AND   template_fold_id              = '$iFoldId'
                        AND   template_element_id           = '$iElementId'
                        AND   element_position              = '$iElementPosition'
                  LIMIT 1

SQL;
            $Result     =   $this->db->query($SQL);
            return  $Result->row('provided_data');
        }
        return '';
    }

    function deleteBatch($iBatchId = 0)
    {
        $SQL = <<<SQL

                DELETE
                FROM       campaign_batches
                WHERE  campaign_batch_id  = '$iBatchId';

SQL;
        if ($this->db->query($SQL))
        {
            $SQL = <<<SQL

                DELETE
                FROM       campaign_batches_lists
                WHERE  campaign_batch_id  = '$iBatchId';

SQL;
            if ($this->db->query($SQL))
            {
                $SQL = <<<SQL

                DELETE
                FROM       campaign_batch_logs
                WHERE  campaign_batch_id  = '$iBatchId';

SQL;
                if ($this->db->query($SQL))
                {
                    $SQL = <<<SQL

                DELETE
                FROM template_content
                WHERE campaign_batch_id = '$iBatchId';

SQL;
                    if ($this->db->query($SQL))
                    {
                        return true;
                    }
                }
            }
        }
        return true;
    }


    function BatchInfo($iBatchId=0)
    {
        if($iBatchId)
        {
            $SQL = <<<SQL

            SELECT

                    cb.campaign_batch_id,
                    cb.title AS batch_title,
                    cb.description AS batch_description,
                    cb.schedule_date ,
                    cb.created_on ,
                    cb.schedule_time ,
                    cb.cut_off_date ,
                    cb.last_preview_images,
                    cb.current_status,
                    cb.campaign_id,
                    cb.total_printing_cost,
                    cb.user_id,


                    u.first_name,
                    u.last_name,

                    p.title          AS product_title,
                    p.description    AS product_description,
                    IFNULL(p.product_id,0) AS product_id ,

                    t.title          AS template_title,
                    IFNULL(t.template_id,0) AS template_id ,
                    t.description    AS template_description,
                    t.printing_price AS template_printing_price

            FROM     campaign_batches cb

            LEFT JOIN         users   u  ON u.user_id     = cb.user_id
            LEFT JOIN         products  p  ON p.product_id  = cb.product_id
            LEFT JOIN         templates  t  ON t.template_id = cb.template_id

            WHERE             cb.campaign_batch_id  =   '$iBatchId'

SQL;
            $Result   =   $this->db->query($SQL);
            return $Result->row();
        }
        return array();
    }
    
    function getTemplateCutOffPeriod($iTemplateId = 0)
    {
        
        $this->db->select('cut_off_period');
        $query = $this->db->get_where('templates', array('template_id' => $iTemplateId), 1, 0);
        $result = $query->result();
        if(!empty($result))
            {
            return $result[0]->cut_off_period;
            }
        return 0 ;    
        
    }
    function getCutOffPeriod($CampaignBatchId)
    {
        if($CampaignBatchId)
        {
            $SQL = <<<SQL

            SELECT
              cut_off_period
            FROM templates WHERE template_id=( SELECT
              template_id
            FROM campaign_batches WHERE campaign_batch_id ='$CampaignBatchId')

SQL;
            $Result   =   $this->db->query($SQL);
            return $Result->row('cut_off_period');
        }
        return array();
    }

    function createBatchLog($aData = array())
    {
      if($aData)
      {
          //updating status in campaign batches table
            $dataBatch = array('current_status' =>  $aData['status']);
            $this->db->where('campaign_batch_id', $aData['campaign_batch_id']);
            $this->db->update('campaign_batches', $dataBatch); 
          
            $dDate              = date(DATE_FORMAT_MYSQL);
          
         //insertion of log in campaign logs table
            $data = array(
                        'campaign_batch_id' => $aData['campaign_batch_id'] ,
                        'status'        =>  $aData['status'] ,
                        'comments'      =>  $aData['comments'],
                        'created_on'    =>  $dDate,
                        'created_by'    => getLoggedInUserId()
                        );
            
            $this->db->insert('campaign_batch_logs', $data); 
            return $this->db->insert_id();
      }
      
      return 0;
    }

    function SettleCuttOffBatches($dDate)
    {
        if($dDate)
        {
            $sBatchStatus   = BATCH_READY_FOR_PRINTING;
            $sBatchEditMode = BATCH_IS_IN_EDIT_MODE;
            

            $SQL = <<<SQL

            UPDATE  campaign_batches
            SET     current_status  = '$sBatchStatus'
            WHERE   cut_off_date    = '$dDate'
            AND      current_status = '$sBatchEditMode'
                    
            

SQL;
            if ($this->db->query($SQL)) {return $this->db->affected_rows();}
        }

        return 0;
    }
    
    function getBatchesForCuttOff()
    {
         $this->db->select('campaign_batch_id,user_id,total_printing_cost');       
         $this->db->where('cut_off_date',date(DATE_ONLY_FORMAT_MYSQL,time()));
         $this->db->where('current_status',"".BATCH_IS_IN_EDIT_MODE);
         $query = $this->db->get('campaign_batches');
         
         return $query->result_array();
         
    }

    function getScheduledBatches($aUser = array())
    {
        $iUserId    =   $aUser['user_id'];
        $dToday     =   date('Y-m-d');

        $SQL = <<<SQL

            SELECT
                        campaign_batch_id
                FROM
                        campaign_batches
                WHERE
                              user_id='$iUserId'
                        AND   schedule_date IS NOT NULL
                        AND   schedule_date >= '$dToday'


SQL;
        $Result   =   $this->db->query($SQL);
        return $Result->result_array();
    }
}
