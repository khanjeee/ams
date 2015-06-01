<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Register extends CI_Controller {

    private $controller;
    private $ApiRegister;

    public function __construct() {
       
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);
        $this->load->model('package_model', 'package');
        $this->load->model('address_model', 'address');
        $this->load->model('user_model','users');
        $this->load->library('encrypt');
         

        $this->ApiRegister   =   new ApiRegister();

       // if(!isUserLoggedIn()){redirect(site_url());}
    }

    public function index()
    {
        redirect($this->controller.'/save');
    }

    public function save($iUserId = 0)
    {
        $sFormAction = $this->controller . '/' . __FUNCTION__;
        $aData = array();
        $aUploadImageResponce = array('file_name'=>'','name'=>'');
        
        if ($this->input->post())
        {
            
            $redirectUrlVerify = site_url($this->controller . '/verify');

            $aPostedData = $this->input->post('data');
            $aMailingData = $this->input->post('mailing');
            $aBillingData = $this->input->post('billing');

            $aMailingData['type'] = 'mailing';
            $aBillingData['type'] = 'billing';
            $sFirstName = $aPostedData['first_name'];
            $sLastName = $aPostedData['last_name'];
            $sEmail = trim($aPostedData['email']);
            $sPassword = $aPostedData['password'];
            $sConfirmPassword = $aPostedData['confirm_password'];


            $sMailingAddress = $aMailingData['address'];
            $sMailingCountry = $aMailingData['country'];
            $sMailingCity = $aMailingData['city'];
            $sMailingState = $aMailingData['state'];
            $sMailingZipCode = $aMailingData['zip_code'];


            $sBillingAddress = $aBillingData['address'];
            $sBillingCountry = $aBillingData['country'];
            $sBillingCity = $aBillingData['city'];
            $sBillingState = $aBillingData['state'];
            $sBillingZipCode = $aBillingData['zip_code'];

            $sPackageId = (isset($aPostedData['package_id'])) ? $aPostedData['package_id'] : 0;
            $sPromotionCode = $aPostedData['promotion_code'];

            $aErrorMessages = array();
            
            if (!is_numeric($sPackageId) or empty($sPackageId)) {
                $aErrorMessages[] = ERROR_PACKAGE_REQUIRED;
            }
            if (!$sMailingAddress) {
                $aErrorMessages[] = ERROR_ADDRESS_MAILING_REQUIRED;

            }
            if (!$sBillingAddress) {
                $aErrorMessages[] = ERROR_ADDRESS_BILLING_REQUIRED;
            }

            if (!$sPassword) {
                $aErrorMessages[] = ERROR_PASSWORD_REQUIRED;
            }

            if ($sPassword != $sConfirmPassword) {
                $aErrorMessages[] = ERROR_PASSWORD_DONOT_MATCH;
            }

            if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
                $aErrorMessages[] = ERROR_INVALID_EMAIL;
            }
            if ($this->users->emailAlreadyExist($sEmail)) {
                $aErrorMessages[] = ERROR_EMAIL_ALREADY_EXISTS;
            }
            
            

			if($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name'] )
			{
				$aUploadImageResponce = UploadImage(USER_IMAGE,$aData);
			}
			
			
			
            if ($aErrorMessages)
            {
                $aRegistrationInfo['message']       =   getFormValidationErrorMessage($aErrorMessages);
		$aRegistrationInfo['data']          =	$aPostedData;
                $aRegistrationInfo['mailing']       =   $aMailingData;
                $aRegistrationInfo['billing']       =   $aBillingData;
                        
                //return setMessage(false, array('message' => $aErrorMessages, 'redirectUrl' => $sFormAction));
            }
            
            else
            {
            $aData['mailing'] = $aMailingData;
            $aData['billing'] = $aBillingData;

            $aInsertedIds = $this->address->insertAddresses($sFormAction, $aData);

            if ($aInsertedIds)
            {
                $aPostedData['inserted_values'] = $aInsertedIds;
		$aPostedData['image']	= 	$aUploadImageResponce['file_name'];
				
		$result = $this->ApiRegister->addSubscriber($aPostedData);

                if ($result['status'])
                {
                    $aPostedData['hash'] = _encrypt_with_url_decode($aPostedData['email']);
                    SendEmail(__FUNCTION__, $aPostedData);
                    return setMessage($result['status'],
                                      array('message' => getFormValidationSuccessMessage($result['message']),
                                            'redirectUrl' => $redirectUrlVerify));
                }
                else
                {
                    $htmlErrorMessages = getFormValidationErrorMessage($result['message']);
                    return setMessage($result['status'], array('message' => $htmlErrorMessages, 'redirectUrl' => $sFormAction));
                }
            }
            
            return setMessage(false, array('message' => $result['message'], 'redirectUrl' => $sFormAction));
            }
            

            

        }

        $aPackages = $this->package->getAllPackagesDropDown();

        if($aPackages)
        {
            for($p=0; $p < count($aPackages); $p++)
            {
                $aPackages[$p]->image = '';

                $Image =  $this->package->getPackageImage($aPackages[$p]->package_id);
                if($Image)
                {
                    $aPackages[$p]->image = site_url($Image);
                }
            }
        }

        $data['sFormAction'] = site_url($sFormAction);
        $data['aPackages'] = $aPackages;
        $data['aRegistrationInfo'] = isset($aRegistrationInfo) ? $aRegistrationInfo : null;
        
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
    }
	
	
	public function profile()
	{		
			 
			  $iUserid     = getLoggedInUserId();
			  $htmlErrorMessages = '';
			 
	
			$aUserInfo	 = (array) $this->users->getUserById($iUserid);
			
			if(is_array($aUserInfo) && !empty($aUserInfo) )
			{
				if(!empty($aUserInfo['address_mailing']) && !empty($aUserInfo['address_billing']))
				{
					$aAddress['address_mailing'] = $aUserInfo['address_mailing'];
					$aAddress['address_billing'] = $aUserInfo['address_billing'];
					$aUserInfo['aAddress']	 =  $this->address->getAddressById($aAddress);
				}
			}
		
			if ($this->input->post())
			{
			
				
				$aPostedData['data']		= $this->input->post('data');
				$aPostedData['mailing']		= $this->input->post('mailing');
				$aPostedData['billing']		= $this->input->post('billing');
				$aPostedData['OldUserInfo'] = $aUserInfo;
			
				$result = $this->ApiRegister->UpdateUserInfo($aPostedData);
				 	
				  if($result['status'])
                    {
                 		 setMessage($result['status'], 
							 array('message'	  =>  getFormValidationSuccessMessage($result['message']),
								   'redirectUrl'  =>  site_url('home/dashboard')));
                    }
					else
					{
						$htmlErrorMessages =   getFormValidationErrorMessage($result['message']);
						
						$aUserInfo = $aPostedData['data'];
						$aUserInfo['aAddress'][0] = (object)$aPostedData['mailing'];
						$aUserInfo['aAddress'][1] = (object)$aPostedData['billing'];
						
						
					}
           
			}
			
			
			
			
				
				
			$data['aUserInfo']				= $aUserInfo;
			$data['sFormAction']			= site_url($this->controller . '/' . __FUNCTION__);
			$data['htmlErrorMessages']      = $htmlErrorMessages;
		 
			$this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
	}
    
    public function verify($hash=0)
    {
        $aData = array();
        $sVerificationUrl 	= site_url($this->controller.'/verify');
        $sloginUrl 	= site_url('/');
        
        //first check if data is posted means url willl be decoded
        if($this->input->post('v'))
        {
            $sVerificationCode = $this->input->post('v');
            
            $aData['email'] = _decrypt_with_url_decode($sVerificationCode);
            $aData['status'] = 1 ;
        }
        //else means verification is done via url so data will not be decoded because
        //data received from url is already decoded 
        else
        {
            if(isset($_REQUEST['v']))
                {

                    $sVerificationCode = $_REQUEST['v'];

                    $aData['email'] = _decrypt_without_url_decode($sVerificationCode);
                    $aData['status'] = 1 ;
                }
        }

        if($aData)
        {
            $result = $this->ApiRegister->updateSubscriberStaus($aData);
                    
            if($result['status'])
                    {
                         return setMessage($result['status'], array('message' => getFormValidationSuccessMessage($result['message']),
                                                                    'redirectUrl'  =>  $sloginUrl));
                    }

            return setMessage($result['status'], array('message' => getFormValidationErrorMessage($result['message']),
                                                       'redirectUrl'  =>  $sVerificationUrl));
        }

        $sFormAction 	            = $this->controller.'/'. __FUNCTION__ ;
        $data['sFormAction']        = site_url($sFormAction);
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);

    }

}
