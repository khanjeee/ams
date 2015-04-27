<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Whitelabel extends CI_Controller
{
    var $ApiWhiteLabel;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);
		
		$this->load->model('whitelabel_model','whitelabel');
        $this->ApiWhiteLabel   =   new ApiWhiteLabel();
        if(!isSuperAdmin()){redirect(site_url());}
    }
    
    
    public function index()
    {
        redirect($this->controller.'/view');
    }
    
    
	
	
    public function create($iWhiteLabelId = 0)
    {
		$aWhiteLabelInfo   = $aPostedData = $data  = $Whitelabel = array();
		$sFormAction 	   = $this->controller.'/'. __FUNCTION__;
		$sHeading 		   = ADD_WHITE_LABEL;
		$bisEditMode	   = false;
		$htmlErrorMessages = '';
			
		//edit
		if(!empty($iWhiteLabelId))
		{
			$aWhiteLabelInfo  = (array) $this->whitelabel->getWhiteLabel($iWhiteLabelId);
			$Whitelabel = $aWhiteLabelInfo;
			$sFormAction	= $this->controller.'/'. __FUNCTION__ . '/'.$iWhiteLabelId;
			$bisEditMode 	= true;
            $sHeading		= "Edit : ".$aWhiteLabelInfo['title'];
        }
		
		
		
		if($this->input->post('whitelabel'))
        {	
			$aPostedData = $this->input->post('whitelabel');
			
			if($bisEditMode)
			{
				$aPostedData['aOldWhiteLabelData'] = $aWhiteLabelInfo;
			}
			
			$aPostedData['bisEditMode'] = $bisEditMode;

			$result			  = $this->ApiWhiteLabel->create($aPostedData);

			if($result['status'])
			{
				setMessage($result['status'], 
							 array('message'	  =>  getFormValidationSuccessMessage($result['message']),
								   'redirectUrl'  =>  site_url($this->controller.'/view')));
			}
			else
			{
				$htmlErrorMessages 	    =   getFormValidationErrorMessage($result['message']);
				$Whitelabel = $aWhiteLabelInfo;
				$aWhiteLabelInfo	=	$aPostedData;
				

			}
        }
	
		

        $data['sHeading']				= $sHeading;
        $data['sFormAction']			= site_url($sFormAction);
		$data['aWhiteLabelInfo']		= $aWhiteLabelInfo;
		$data['aWhiteLabel']		= $Whitelabel;
		$data['bisEditMode']			= $bisEditMode;
		$data['htmlErrorMessages']      =   $htmlErrorMessages;
	
		
			
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
        $config['total_rows']           = $this->ApiWhiteLabel->getAll($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);
        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                       =   array();
        $aWhiteLabels               =   (array)  $this->ApiWhiteLabel->getAll($aParams);// $this->package->getAllPackages($aParams);

        $sFormAction 	            = $this->controller.'/'. __FUNCTION__ ;
        $data['sFormAction']        = site_url($sFormAction);
        $data['sDeleteAction']      = site_url($this->controller.'/delete');
        $data['sCallFrom']          = $sFormAction;
		$data['aWhiteLabels']        = $aWhiteLabels;

        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
	
	public function delete($iWhiteLabelId = 0)
	{
		 $aPostedData =  array(); 
		 
         if(isUserLoggedIn()) 
         {
                if($iWhiteLabelId)
                {
                    $aPostedData['data']['iWhiteLabelId']     = $iWhiteLabelId; 
                }   

               
                $result         = $this->ApiWhiteLabel->delete($aPostedData['data']);
				
                if($result)
                {
                        $redirectUrl                    = site_url($this->controller.'/view');
                        setMessage($result['status'], array('message' =>  $result['message'], 'redirectUrl'  =>  $redirectUrl));
                }

                
         }
		   $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__);
	}
	
	public function show($iWhiteLabelId = 0)
	{
        $data['aWhiteLabelInfo'] = array();
		if(!empty($iWhiteLabelId))
		{
			$aWhiteLabelInfo  = (array) $this->whitelabel->getWhiteLabel($iWhiteLabelId);
		
			if(!empty($aWhiteLabelInfo))
			{
                $data['aWhiteLabelInfo']    =  $aWhiteLabelInfo;
                $data['iTotalUsers']        =  $this->whitelabel->getWhiteLabelUsers($aWhiteLabelInfo['promotion_code']);;
            }
		}

		$this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
	}
}
