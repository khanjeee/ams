<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller
{
    var $ApiContact;

    public function __construct()
    {
        parent::__construct();
         if(!isUserLoggedIn())
        {
            {redirect(site_url());}
        }
        $this->controller  	= strtolower(__CLASS__);
        $this->ApiContact = new ApiContact();
        $this->load->model('list_model','list');
        $this->load->model('list_member_model','list_member');
        $this->load->model('contact_model','contact');
        
    }


    public function index()
    {
        redirect($this->controller.'/view');
    }

	public function add_members($iListId = 0)
    {
        $data               = $aContacts = array();
        $sMethod            = strtolower(__FUNCTION__);
        $sFormAction 	    = $this->controller.'/'. $sMethod.'/'.$iListId ;

        ###################################
        if($aPostedData = $this->input->post())
        {
			
			
            $aPostedData['iListId'] = $iListId;
			
			
            $result = $this->ApiContact->addMembersToList($aPostedData);

            if($result['status'])
            {
                return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
                    'redirectUrl'  => site_url($this->controller.'/view')));
            }
            else
            {
                return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
                    'redirectUrl'  => site_url($this->controller.'/view')));
            }
        }

        ###################################

        if(is_numeric($iListId) && $iListId > 0 )
        {
            $aParams['iUserId'] = getLoggedInUserId();
            $aContacts = (array)  $this->contact->getAllContacts($aParams);
        }

        $data['sFormAction']                = site_url($sFormAction);
        $data['aContacts']                  = $aContacts;
        $data['aPreviousContacts']          = $this->list->getListContacts($iListId);

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.$sMethod,$data);
    }
    
    public function create()
    {
        $sFormAction 	   = $this->controller.'/'. __FUNCTION__ ;  
		if($this->input->post())
        {
              $aPostedData				 = $this->input->post('data');
              $aPostedData['isEditMode'] = false; 
              $sTitle					 = $aPostedData['title'];
			  $aErrorMessages			 = array();

		if (!$sTitle)
        {
                    $aErrorMessages[] = ERROR_TITLE_REQUIRED;
        }
             
        if($aErrorMessages)
        {
                return setMessage(false , array('message' =>  getFormValidationErrorMessage($aErrorMessages) , 
                                                'redirectUrl'  =>  $sFormAction));
        }
           $result = $this->ApiContact->createList($aPostedData);
       
           if($result['status'])
                {   
			   
                    return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
                                                               'redirectUrl'  => site_url($this->controller.'/view')));
                }
				
         
        return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
                                                               'redirectUrl'  => $sFormAction ));
															   
        }

        
        $data['sFormAction']        = site_url($sFormAction);
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
    public function update($iListId = 0)
    {
        $sFormAction 	   = $this->controller.'/'. __FUNCTION__ .'/'.$iListId;  
       
        if($this->input->post())
        {
            
            
              $aPostedData  = $this->input->post('data');
              $aPostedData['isEditMode'] = true;
              $aPostedData['list_id'] = $iListId;
              
             $sTitle   = $aPostedData['title'];
		
                $aErrorMessages         = array();

		if (!$sTitle)
                {
                    $aErrorMessages[] = ERROR_TITLE_REQUIRED;
                        
		}
             
        if($aErrorMessages)
            {
                return setMessage(false , array('message' =>  $aErrorMessages , 'redirectUrl'  =>  $sFormAction));
            }
        
           
           
           $result = $this->ApiContact->createList($aPostedData);
           
           
           if($result)
                {   
                    return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
                                                               'redirectUrl'  => site_url($this->controller.'/view')));
                }
         
        return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
                                                               'redirectUrl'  => site_url($sFormAction)));
           
          
        
        } 

        
        $data['sFormAction']     = site_url($sFormAction);
        $data['aList']           = $this->list->getListId($iListId);
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
          
    public function view($iPage=0)
    {
	    $aParams = array();
        $aParams[ACTION_RECORD_COUNT] = true;

        #   Pagination
        global $gPagination;
        $config = $gPagination;
        $config['base_url']             = site_url($this->controller.'/'. __FUNCTION__);
        $config['total_rows']           = $this->list->getAllLists($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);

        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                       =   array();
        $aLists                     =   (array)  $this->list->getAllLists($aParams);// $this->package->getAllPackages($aParams);
		
		
      	$aGetListWithTotalContact	=  	AddContactInListArray($aLists);
      	$iMasterContact				=  	getMasterContactByUser();
		
		 
        $sFormAction 	            = $this->controller.'/'. __FUNCTION__ ;
        $data['aLists']             = $aGetListWithTotalContact ;
        $data['iMasterContact']     = $iMasterContact ;
        $data['sFormAction']        = site_url($sFormAction);
        $data['sDeleteAction']      = site_url($this->controller.'/delete');
        $data['sEditAction']        = site_url($this->controller.'/update');
        $data['sAddMemberAction']   = site_url($this->controller.'/add_members');
        $data['sViewMemberAction']  = site_url($this->controller.'/view_members');
        

        $data['sCallFrom']          = $sFormAction;

        //$data['sQuery']             = $sQuery;
        //$data['bSearch']            = $search;
        
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }

	public function view_members($iListId=0,$iPage=0)
    {
        $data = array();

        if($iListId > 0)
        {
            $aParams = array();
            $aParams[ACTION_RECORD_COUNT] = true;
            $aParams['list_id']           = $iListId;

            #   Pagination
            global $gPagination;
            $config = $gPagination;
            $config['base_url']             = site_url($this->controller.'/'. __FUNCTION__ .'/'.$iListId);
            $config['total_rows']           = $this->list_member->getAllListMembers($aParams);
            $config['per_page']             = LISTING_PER_PAGE;
            $this->pagination->initialize($config);

            #### ----------------- ####

            $aParams[ACTION_RECORD_COUNT]   = false;
            $aParams[ACTION_PAGE_OFFSET]    = $iPage;
            
            $data                       =   array();
            $aLists                     =   (array)  $this->list_member->getAllListMembers($aParams);
            
            $sFormAction 	        = $this->controller.'/'. __FUNCTION__ ;
            $data['aLists']             = $aLists ;
            $data['sFormAction']        = site_url($sFormAction);
            $data['sDeleteAction']      = site_url($this->controller.'/delete_member/'.$iListId);
            $data['sEditAction']        = site_url('contacts/update/');
            $data['sAddMemberAction']   = site_url($this->controller.'/add_members');

            $data['sCallFrom']          = $sFormAction;

            
        }

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
    public function delete_member($iListId=0,$iContactId=0)
	{

		if($iContactId)
		{
			 $result =   $this->list_member->deleteContactFromList($iListId,$iContactId);

			 if($result)
			 {
				return setMessage(true, array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS),
											  'redirectUrl'  =>  site_url($this->controller.'/view_members/'.$iListId)));
			 }

		}

		return  setMessage(false, array('message' =>  getFormValidationErrorMessage(MSG_INVALID_ATTEMPT), 
										'redirectUrl'  =>  site_url($this->controller.'/view_members/'.$iListId)));
	}
	
	public function delete($iListId=0)
	{

           if($iListId)
           {
                $result =   $this->ApiContact->deleteListById($iListId);

                if($result)
                {
                   return setMessage($result['status'], array('message' =>  getFormValidationErrorMessage($result['message']),
                                                 'redirectUrl'  =>  site_url($this->controller.'/view')));
                }
               
           }
          
           return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage($result['message']), 
                                           'redirectUrl'  =>  site_url($this->controller.'/view')));
       }
	   
	public function detail($iListId=0,$iPage=0)
	{
		#$iPage=0;
		$data	 = $aContacts =$aList =array();
		$aParams = array();
        $aParams['iListId'] = $iListId;
        $aParams['iUserId'] = getLoggedInUserId();
		$aParams[ACTION_RECORD_COUNT] = true;

        #   Pagination
        global $gPagination;
		$config = $gPagination;
		
		$config['base_url']             = site_url($this->controller.'/'. __FUNCTION__.'/'.$iListId);
        $config['total_rows']           = $this->list->getAllContactsByListId($aParams);
		$config['per_page']             = LISTING_PER_PAGE;
        $config['uri_segment']          = 4;
        $this->pagination->initialize($config);
        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;		
		
		if($iListId) {
			$aList = (array) $this->list->getListId($iListId); 
			
				if($aList[0]->is_master_list) {
					$aContacts = (array) $this->contact->getContactByUserId($aParams['iUserId']); 
				} else {
					$aContacts = (array) $this->list->getAllContactsByListId($aParams); 
				}
		}
			
		
		
		$sFormAction 	        = $this->controller.'/'. __FUNCTION__ ;
		$data['aContacts']		= $aContacts;  
		$data['aList']			= $aList;  
		$data['sDeleteAction']  = site_url($this->controller.'/delete_contact/'.$iListId);
        $data['sEditAction']    = site_url('contacts/update/');
		$data['sFormAction']	= site_url($sFormAction);
		$data['sCallFrom']      = $sFormAction;
		
		$this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
	}

	public function delete_contact($iListId=0,$iContactId=0)
	{
		if($iContactId)
		{
				$result	=   $this->list_member->deleteContactFromList($iListId,$iContactId);
			 if($result)
			 {
				return setMessage(true, array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS),
											  'redirectUrl'  =>  site_url($this->controller.'/detail/'.$iListId)));
			 }
		}
				return  setMessage(false, array('message' =>  getFormValidationErrorMessage(MSG_INVALID_ATTEMPT), 
										'redirectUrl'  => site_url($this->controller.'/detail/'.$iListId)));
	}
	

	
}
