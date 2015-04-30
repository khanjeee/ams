<?php

class ApiContact
{
	# Initializing Class Variables
	public $data    = array();
    public $result  = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
		$this->data = $Data;
    }


        
/**********************CONTACTS CRUD***************************/
        
   public function createContact($aData= array())
        {
            
         $aPostedData   = $aData ;
         $isEditMode    = $aData['isEditMode'];
        

        $CI = & get_instance();
        $CI->load->model('contact_model','contact');

            //$aDataToSave                = array('aData' => $aData,'isEditMode' => false);
            // d($aDataToSave);
            $iContactId                 =  $CI->contact->createContact($aPostedData);
            
            if($iContactId)
            {
				  $aPostedData['isEditMode'] = $isEditMode;
				  $aPostedData['contacts'] = $iContactId;
				  if($CI->contact->addContactInListByContactId($aPostedData))
				  {
					  $this->result['status']     = true;
					  $this->result['message']    = ($isEditMode) ? MSG_SUCCESS_CONTACT_UPDATED : MSG_SUCCESS_CONTACT_ADDED ;
				  }
			}
        
		return $this->result;
	}
        
   public function addMembersToList($aData= array())
   {
	  
       $CI = & get_instance();
       $CI->load->model('contact_model','contact');

       if($iTotalContactsAdded  = $CI->contact->addMembersToList($aData))
       {
           $this->result['status']     = true;
           $this->result['message']    = $iTotalContactsAdded.' Contacts added successfully.';
       }

       return $this->result;

   }

   public function getAllUsers($aData= array())
     {
            
         $aPostedData   = $aData ;
           
        $CI = & get_instance();
        $CI->load->model('user_model','users');
        
        return $CI->users->getAllUsers($aPostedData);
            
        
    }
        
   public function deleteContactById($iContactId=0)
    {
        $CI = & get_instance();
        $CI->load->model('contact_model','contact');
                
                    if($CI->contact->deleteContactById($iContactId))
                    {
                        $this->result['status']     = true;
                        $this->result['message']    = CONTACT.' '.MSG_DELETE_SUCCESS;
                    }
                    else
                    {
                        $this->result['message']    = ERROR_DELETE_FAILURE;
                    }
            
        
        
        return $this->result;
    }
    
    /*  @Description: Parses the excel file and returns 2 arrays one for dispalying contats and other for insertion 
     *  @Author:Shoaib Ahmed Khan
     *  @Params : file path which is to be parsed
     */
    public function excelParser($filePath='')
    {
        $CI = & get_instance();
        $CI->load->library('phpexcel');
        $CI->load->library('PHPExcel/iofactory');
        
        $aContacts = array(); 
        $aContactsTable = array(); 
        
        
        $objPHPExcel = new PHPExcel();
                            $objReader = IOFactory::createReader(SUPPORTED_EXCEL_FORMATS);
                            $objPHPExcel = $objReader->load($filePath);

                            foreach ($objPHPExcel->getWorksheetIterator() as $sheetNo=>$worksheet) 
                                {
                                //dynamically gets the no columns in each sheet
                                //$highestColumm = $worksheet->getHighestColumn();
                                //$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumm);
                                $no_of_columns_to_extract =  14;
                                  //echo 'Worksheet - ' , $worksheet->getTitle(). "<br/>";
                                  foreach ($worksheet->getRowIterator() as $row) 
                                      {
                                        $rowArr = array();
                                        $rowNo = $row->getRowIndex();

                                        if($rowNo > 1 ) //escaping first row Titles 
                                            {
                                                $cellIterator = $row->getCellIterator();
                                                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

                                                foreach ($cellIterator as $key=>$cell) 
                                                {
                                                    //extracting limited columns
                                                    if($key < $no_of_columns_to_extract)
                                                    {

                                                        $cellValue = $cell->getCalculatedValue();
                                                        $cellValue = (empty($cellValue)) ? '' : $cellValue;
                                                        //creating array for displaying contacts of first sheet(first 4 rows only)
                                                        if($sheetNo==0 && $rowNo <=4)
                                                            {
                                                                $aContactsTable[$sheetNo][$rowNo][] = $cellValue;
                                                            }
                                                        //if (!is_null($cellValue)) 
                                                            //{

                                                                //appending '' at start of every index of array
                                                                if(empty($rowArr[$rowNo])) 
                                                                  {
                                                                        $rowArr[$rowNo]='';
                                                                  }

                                                                //appending ) to last index of array and setting string to main array
                                                                if($key == $no_of_columns_to_extract-1)
                                                                  {
                                                                        $rowArr[$rowNo] .=    "'$cellValue'";
                                                                        //add row to contacts array only if it contains a character.
                                                                        //addd only the rows containing data
                                                                        if(preg_match('/[a-zA-Z]|[0-9]/', $rowArr[$rowNo]))
                                                                            {
                                                                                $aContacts[]    =$rowArr[$rowNo];
                                                                            }

                                                                   }

                                                                //for evey other column except last
                                                                else
                                                                  {
                                                                    if($key==10 and !empty($cellValue)) // 10 is the dob column
                                                                    {
                                                                        //adding 1 days because it was returns date with 1 less day
                                                                        $date = (int) PHPExcel_Shared_Date::ExcelToPHP($cellValue); 
                                                                        $cellValue = date(DATE_ONLY_FORMAT_MYSQL, $date+86400); 

                                                                    }
                                                                    
                                                                    $rowArr[$rowNo] .=    "'$cellValue',";
                                                                  }


                                                           // }
                                                    }
                                                }

                                            }


                                        }
                                }
       
        $aData['aContacts']         = $aContacts; 
        $aData['aContactsTable']    = $aContactsTable;
        //d($aData);
        return $aData; 
    }
    
    
    
    public function import($callFrom='',$aContacts = array())
    {
        $CI = & get_instance();
        $CI->load->model('contact_model','contact');
        
         if($CI->contact->importContacts($callFrom,$aContacts))
         {
             $this->result['status']     = true;
             $this->result['message']    = MSG_SUCCESS_CONTACTS_IMPORTED;
         }
         
         return $this->result;
                
        
        
    }        
    
    
/**********************CONTACTS END***************************/    
    
    
    
/**********************LISTS START****************************/
     function createList($aData = array())
     { 
      $CI = & get_instance();
      $CI->load->model('list_model','list');
		
	  #$aLists = $CI->list->getMasterList();
		 
		$iUserId = getLoggedInUserId();
		$sTitle =   $aData['title'];
		$aLists = $CI->list->getLists($iUserId,$sTitle);
	
      $sMessage = ($aData['isEditMode']) ? MSG_SUCCESS_LIST_UPDATED  : MSG_SUCCESS_LIST_ADDED;
     
	  #if($aLists->is_master_list)
	 # {	
		  if($aLists)
		  {
			   $this->result['status']     = FALSE;
			   $this->result['message']    = ERROR_TITLE_LIST_ALREADY_EXISTS;
		  }
		 else 
		 {
			if($CI->list->createList($aData))
			{  
				$this->result['status']     = true;
				$this->result['message']    = $sMessage;
			}  
		 }
	#  }
	
	  
		
        return $this->result;
    }
    
    public function deleteListById($iListId=0)
    {
        $CI = & get_instance();
        $CI->load->model('list_model','list');
                
                    if($CI->list->deleteListById($iListId))
                    {
                        $this->result['status']     = true;
                        $this->result['message']    = LIST_SINGULAR.' '.MSG_DELETE_SUCCESS;
                    }
                    else
                    {
                        $this->result['message']    = ERROR_DELETE_FAILURE;
                    }
            
        
        
        return $this->result;
    }
    
    
/**********************LISTS END******************************/    
    
    
        
   
}