<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
    var $ApiAdmin;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);

       $this->load->model('address_model', 'address');
       $this->load->model('user_model','users');
       $this->load->model('role_model','roles');
       $this->load->model('country_model','countries');
       //$this->load->model('state_model','states');
       //$this->load->model('city_model','cities');
       
        
        
        $this->ApiAdmin   =   new ApiAdmin();
        
        /*Only Visisble To Super Admin */
        
        if(!isSuperAdmin()){redirect(site_url());}
    }


    public function index()
    {
        redirect($this->controller.'/view');
    }
    
    public function create()
    {
        $sFormAction 	   = $this->controller.'/'. __FUNCTION__ ;  
        $aData = array();
       
        if($this->input->post())
        {
            //$redirectUrlVerify 	= site_url($this->controller.'/verify');
            
              $aPostedData  = $this->input->post('data');
              $aMailingData  = $this->input->post('mailing');
              $aBillingData  = $this->input->post('billing');
              
              $aMailingData['type'] = 'mailing';
              $aBillingData['type'] = 'billing';
              
              
              
//              if($aData)      $aPostedData = $aData;
//                else            $aPostedData = (array) $this->data['data'];

                //d($aPostedData);
            		$sFirstName         = $aPostedData['first_name'];
            		$sLastName          = $aPostedData['last_name'];
                $sEmail             = trim($aPostedData['email']);
                $sPassword          = $aPostedData['password'];
                $sPromotionCode     = $aPostedData['promotion_code'];
                d($sPromotionCode);
                
                $sMailingAddress    = $aMailingData['address'];
                $sMailingCountry    = $aMailingData['country'];
                $sMailingCity       = $aMailingData['city'];
                $sMailingState      = $aMailingData['state'];
                $sMailingZipCode    = $aMailingData['zip_code'];
                
                
                $sBillingAddress    = $aBillingData['address'];
                $sBillingCountry    = $aBillingData['country'];
                $sBillingCity       = $aBillingData['city'];
                $sBillingState      = $aBillingData['state'];
                $sBillingZipCode    = $aBillingData['zip_code'];

              
		$aErrorMessages         = array();

		if (!$sMailingAddress)
                {
                    $aErrorMessages[] = ERROR_ADDRESS_MAILING_REQUIRED;
                        
		}
                if (!$sBillingAddress)
                {
                    $aErrorMessages[] = ERROR_ADDRESS_BILLING_REQUIRED;
		}
                
                if(!$sPassword)
                {
                    $aErrorMessages[] = ERROR_PASSWORD_REQUIRED;
                }
                if(!filter_var($sEmail, FILTER_VALIDATE_EMAIL))
                {
                    $aErrorMessages[] = ERROR_INVALID_EMAIL;
                }
                if($this->users->emailAlreadyExist($sEmail))
                {
                    $aErrorMessages[] = ERROR_EMAIL_ALREADY_EXISTS;
                }
                
                
		

        if($aErrorMessages)
        {
            
            return setMessage(false , array('message' =>  $aErrorMessages , 'redirectUrl'  =>  $sFormAction));
             
        }
        
        $aData['mailing'] =  $aMailingData;
        $aData['billing'] =  $aBillingData;   
        
       $aInsertedIds =  $this->address->insertAddresses($sFormAction,$aData);
        
       if($aInsertedIds)
       {
           $aPostedData['inserted_values'] = $aInsertedIds;
           $result = $this->ApiAdmin->createUser($aPostedData);

           if($result['status'])
                {   
                    return setMessage($result['status'], array('message' =>  $result['message'], 'redirectUrl'  => site_url('users/view')));
                }
          else
                {     
                    $htmlErrorMessages 	= getFormValidationErrorMessage($result['message']);
                    return setMessage($result['status'], array('message' =>$htmlErrorMessages , 'redirectUrl'  =>  $sFormAction));
                    
                }
           
           //d($result);
       }
       
       return setMessage(false, array('message' =>  $result['message'], 'redirectUrl'  =>  $sFormAction));
        
        }

        
        $data['sFormAction']        = site_url($sFormAction);
        $data['aRoles']             = $this->roles->getRolesDropDown();
        $data['aCountries']         = $this->countries->getCountriesDropDown();
       // $data['aStates']            = $this->states->getStatesDropDown();
        
        
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
        $config['total_rows']           = $this->users->getAllUsers($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);
        

        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                       =   array();
        $aUsers                     =   (array)  $this->ApiAdmin->getAllUsers($aParams);// $this->package->getAllPackages($aParams);

        $data['aUsers']             = $aUsers ;

        $sFormAction 	            = $this->controller.'/'. __FUNCTION__ ;
        $data['sFormAction']        = site_url($sFormAction);
        $data['sDeleteAction']      = site_url($this->controller.'/delete');
        $data['sCallFrom']          = $sFormAction;

        //$data['sQuery']             = $sQuery;
        //$data['bSearch']            = $search;
        
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
       public function delete($iUserId=0)
       {
           if($iUserId)
           {
                $result       =   $this->ApiAdmin->deleteUserById($iUserId);

                if($result['status'])
                {
                   return setMessage($result['status'], array('message' =>  getFormValidationSuccessMessage($result['message']), 'redirectUrl'  =>  site_url('users/view')));
                }
                else
                {
                   return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage($result['message']), 'redirectUrl'  =>  site_url('users/view')));
                }
           }
           
           redirect(site_url('users/view'));
       }

    

}
