<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller
{
    var $ApiPackage;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);
        $this->load->model('role_model','role'); 

        
        

        if(!isSuperAdmin()){redirect(site_url());}
    }


    public function index()
    {
        redirect($this->controller.'/view');
    }
    
      
     public function create()
    {
        $sFormAction 	   = $this->controller.'/'. __FUNCTION__ ;  
       
        if($this->input->post())
        {
            //$redirectUrlVerify 	= site_url($this->controller.'/verify');
            
              $aPostedData  = $this->input->post('data');
              
              $aPostedData['isEditMode'] = false; 
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
        
        
           
           $result = $this->role->createRole($aPostedData);
           
           if($result)
                {   
                    return setMessage(true, array('message' => getFormValidationSuccessMessage(MSG_SUCCESS_ROLE_ADDED),
                                                               'redirectUrl'  => site_url($this->controller.'/view')));
                }
         
       return setMessage(false, array('message' =>getFormValidationErrorMessage(MSG_INVALID_ATTEMPT),'redirectUrl'  =>  $sFormAction));
        
        }

        
        $data['sFormAction']        = site_url($sFormAction);
//        $sCustomJsPath              = getAssetsPath().JS_CREATE_CONTACT;
//        $data['custom_js']          = $this->load->view('includes/js_includes.php',array('custom_js'=>$sCustomJsPath),true);
           $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
      public function update($iRoleId = 0)
    {
        $sFormAction 	   = $this->controller.'/'. __FUNCTION__ .'/'.$iRoleId;  
       
        if($this->input->post())
        {
            
            
              $aPostedData  = $this->input->post('data');
              $aPostedData['isEditMode'] = true;
              $aPostedData['role_id'] = $iRoleId;
              
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
        
           
           $result = $this->role->createRole($aPostedData);
           
           if($result)
                {   
                    return setMessage(true, array('message' => getFormValidationSuccessMessage(MSG_SUCCESS_ROLE_UPDATED),
                                                               'redirectUrl'  => site_url($this->controller.'/view')));
                }
          
           return setMessage(false, array('message' =>getFormValidationErrorMessage(MSG_INVALID_ATTEMPT),'redirectUrl'  =>  $sFormAction));
        
        } 

        
        $data['sFormAction']     = site_url($sFormAction);
        $data['aRole']           = $this->role->getRoleById($iRoleId);
//        $sCustomJsPath              = getAssetsPath().JS_CREATE_CONTACT;
//        $data['custom_js']        = $this->load->view('includes/js_includes.php',array('custom_js'=>$sCustomJsPath),true);
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
        $config['total_rows']           = $this->role->getAllRoles($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);

        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                       =   array();
        $aRoles                     =   (array)  $this->role->getAllRoles($aParams);;// $this->package->getAllPackages($aParams);
        
        
        $sFormAction 	            = $this->controller.'/'. __FUNCTION__ ;
        $data['aRoles']             = $aRoles ;
        $data['sFormAction']        = site_url($sFormAction);
        $data['sDeleteAction']      = site_url($this->controller.'/delete');
        $data['sEditAction']        = site_url($this->controller.'/update');
        $data['sCallFrom']          = $sFormAction;

        //$data['sQuery']             = $sQuery;
        //$data['bSearch']            = $search;
        
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
       public function delete($iRoleId=0)
       {

           if($iRoleId)
           {
                $result =   $this->role->deleteRoleById($iRoleId);

                if($result)
                {
                   return setMessage(true, array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS),
                                                 'redirectUrl'  =>  site_url($this->controller.'/view')));
                }
               
           }
          
           return  setMessage(false, array('message' =>  getFormValidationErrorMessage(ERROR_DELETE_FAILURE), 
                                           'redirectUrl'  =>  site_url($this->controller.'/view')));
       }

 

}
