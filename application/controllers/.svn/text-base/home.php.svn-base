<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);
        $this->load->model('batch_model','batch');
        $this->load->model('payment_model','payments');
    }

    # This is Site Index
	public function index()
	{
        if(isUserLoggedIn()) {redirect(site_url('home/dashboard'));}

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.$this->controller);
	}

    function login()
    {        
        $this->_loginHandler($this->input->post());
    }
    
    #Login Handler
    private function _loginHandler($aPostedData=array())
    {
        $ApiAdmin    	=   new ApiAdmin($aPostedData);
        $result         =   $ApiAdmin->defaultUserLogin();

        if($result['status'])
        {
            setMessage($result['status'], array('message' =>  '', 'redirectUrl'  =>  site_url($this->controller.'/dashboard')));
        }
        setMessage(false, array('message' =>  getFormValidationErrorMessage($result['message']), 'redirectUrl'  =>  site_url()));
    }
    
    
    public function forgotpassword()
	{
		$data = $aUserInfo = array();
		
		$htmlErrorMessages = '';
		
        if(!is_array($aUserInfo) || count($aUserInfo) <= 0)
        {
            $aUserInfo['login_key']  =   '';
        }
				
        $PostedData  = $this->input->post();
        if($PostedData)
        {
            
			 	$aPostedData['client_is_using']     = USER_AGENT_WEBSITE;

                $apiAdmin       		= new ApiAdmin($PostedData);
                $result                 = $apiAdmin->ForgotPassword($PostedData);
					
				if($result['status'])
                {
                    $htmlErrorMessages 	= getFormValidationErrorMessage($result['message']);
                    setMessage($result['status'], array('message' =>  $htmlErrorMessages, 'redirectUrl'  =>  site_url()));
                }
                else
                {
					$htmlErrorMessages 	= getFormValidationErrorMessage($result['message']);
					
					if(isset($aPostedData['data']))
					{
						$aUserInfo 			= $aPostedData['data'];
					}
                    setMessage($result['status'], array('message' =>  $htmlErrorMessages, 'redirectUrl'  => site_url('home/forgotpassword')));
                }
	}
	
		$data['aUserInfo']     = $aUserInfo;

		$this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
	}
    
    
     # This is Dashboard
	public function dashboard()
	{
        if(!isUserLoggedIn()){redirect(site_url());}

        $Data = $aBatchDetails = array();

        $aCutOffBatches             =   $this->batch->getCutOffBatches();

        if($aCutOffBatches)
        {
            for($b=0; $b<count($aCutOffBatches); $b++)
            {
                $iBatchId                                   =   $aCutOffBatches[$b]['campaign_batch_id'];
                $aBatchSummary                              =   $this->batch->getBatchSummary($iBatchId);
                $aBatchSummary['BatchDetails']['folds']     =   $this->batch->getTemplateFolds($aBatchSummary['BatchDetails']['template_id']);
                $aBatchDetails[]                            =   $aBatchSummary['BatchDetails'];
            }
        }

        $Data['aCutOffBatches']                             =   $aBatchDetails;
        $Data['aScheduledBatches']                          =   array();

        $LoggedInUserData = getLoggedInUserData();

        if($LoggedInUserData['role_id'] == ROLE_ID_SUBSCRIBER)
        {
            if($aBatches = $this->batch->getScheduledBatches($LoggedInUserData))
            {
                foreach($aBatches as $k => $v)
                {
                    $Data['aScheduledBatches'][]  = $this->batch->getBatchSummary($v['campaign_batch_id']);
                }
            }
        }

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/dashboard',$Data);
	}
        
      public function logout()
    {   
        $this->session->unset_userdata(LOGIN_USER_DATA);
        redirect(site_url()); 
    }

    public function read()
    {
        $this->load->library('phpexcel');
        $this->load->library('PHPExcel/iofactory');

        $objPHPExcel = new PHPExcel();

        echo date('H:i:s') , " Load from Excel2007 file". "<br/>";
        $objReader = IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load('media/import/ContactImportSample.xlsx');

        echo date('H:i:s') , " Iterate worksheets". "<br/>";
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            echo 'Worksheet - ' , $worksheet->getTitle(). "<br/>";

            foreach ($worksheet->getRowIterator() as $row) {
                echo '    Row number - ' , $row->getRowIndex(). "<br/>";

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                foreach ($cellIterator as $cell) {
                    if (!is_null($cell)) {
                        echo '        Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue(). "<br/>";
                    }
                }
            }
        }
        exit;
    }
 
    /*function calendar()
    {
        $this->benchmark->mark('code_start');
        $this->load->library('calendar');

        $data = array(
            3  => 'http://example.com/news/article/2006/03/',
            7  => 'http://example.com/news/article/2006/07/',
            13 => 'http://example.com/news/article/2006/13/',
            26 => 'http://example.com/news/article/2006/26/'
        );

        echo $this->calendar->generate(2006, 6, $data);
        $this->benchmark->mark('code_end');
    }*/


    function  testing()
    {

    }

    function  add_card()
    {
       $sFormAction = $this->controller . '/' . __FUNCTION__ . '/';
       $data['sFormAction']	= site_url($sFormAction);  
       $aUserData = getLoggedInUserData();
       
       $ApiAuthorizeDotNet = new ApiAuthorizeDotNet();    
            

        if ($aPostedData = $this->input->post()) 
           {
            $aPostedData['first_name'] = $aUserData['first_name'];
            $aPostedData['last_name'] = $aUserData['last_name'];

            $aPaymentResult = $ApiAuthorizeDotNet->createCustomerPayment($aPostedData);
            
            if ($aPaymentResult['status']) 
                {
                    $aUserData['payment_id'] = $aPaymentResult['payment_id'];
                    if ($this->payments->savePaymentId($aUserData)) 
                        {
                        $aShippingResult = $ApiAuthorizeDotNet->createCustomerShipping($aPostedData);

                            if ($aShippingResult['status']) 
                                {
                                    $AuthorizeDotNetShippingId = $aShippingResult['address_id'];
                                    $aUserData['address_id'] = $AuthorizeDotNetShippingId;
                                    
                                    if ($this->payments->saveAddressId($aUserData)) 
                                        {
                                            d("Card successfully added {$AuthorizeDotNetShippingId}");
                                        }
                                }
                              
                        }
                }
           else 
                {
                    
                    d($aPaymentResult);
                 }       

            //d($aResult['payment_id']);
        } 
        else 
        {
        $AuthorizeDotNetCustomerId  = $this->payments->getCustomerId($aUserData);
        
        if(empty($AuthorizeDotNetCustomerId))
        {

            $aResult  = $ApiAuthorizeDotNet->createCustomerProfile($aUserData);
            //if customer profile created
            if($aResult['status'])
                {
                  $AuthorizeDotNetCustomerId = $aResult['profile_id'];
                  $aUserData['profile_id'] =  $AuthorizeDotNetCustomerId;

                    $this->payments->saveCustomerId($aUserData);

                }
            
        }
        
        $data['profile_id'] = $AuthorizeDotNetCustomerId;
            
        }
            
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
    }



}
