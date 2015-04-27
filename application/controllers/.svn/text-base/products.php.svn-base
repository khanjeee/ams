<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller
{
    var $ApiProduct;

    public function __construct()
    {
        parent::__construct();
        $this->controller  	= strtolower(__CLASS__);

        $this->load->model('product_model', 'product');
        $this->ApiProduct   =   new ApiProduct();

        if(!isUserLoggedIn()){redirect(site_url());}
    }


    public function index()
    {
        redirect('packages/view');
    }
    
    public function create()
    {
        $data                       = array();

        # when the package creation form is posted
        if($PackageInfo     = $this->input->post())
        {
            $result     = $this->ApiProduct->create($PackageInfo);

            if($result['status'])
            {
                setMessage(true, array('message' =>  getFormValidationSuccessMessage($result['message']), 'redirectUrl'  =>  site_url($this->controller.'/view')));
            }
        }
        else    # when the data is not posted create package form dispalyed
        {
            
            $sJsCreateProduct           =   getAssetsPath().JS_CREATE_PRODUCT;
            $sFormAction                =   $this->controller.'/'.__FUNCTION__;

            $data['sHeading']           = PRODUCT;
            $data['sFormAction']        = site_url($sFormAction);
            $data['js_create_product']  = $sJsCreateProduct;
           // $data['aModules']           = $aModules;

            $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
        }
    }

//    public function view()
//    {
//        $data               = array();
//        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
//    }
    
    
    public function view($iPage=0)
    {
	$aParams = array();
        $aParams[ACTION_RECORD_COUNT] = true;

        #   Pagination
        global $gPagination;
        $config = $gPagination;
        $config['base_url']             = site_url($this->controller.'/'. __FUNCTION__);
        $config['total_rows']           = $this->package->getAllPackages($aParams);
        $config['per_page']             = LISTING_PER_PAGE;
        $this->pagination->initialize($config);

        #### ----------------- ####

        $aParams[ACTION_RECORD_COUNT]   = false;
        $aParams[ACTION_PAGE_OFFSET]    = $iPage;

        $data                       =   array();
        $aPackages                  =   (array)  $this->ApiPackage->getAll($aParams);// $this->package->getAllPackages($aParams);

        $data['aPackages']          = $aPackages ;

        $sFormAction 	            = $this->controller.'/'. __FUNCTION__ ;
        $data['sFormAction']        = site_url($sFormAction);
        $data['sDeleteAction']      = site_url($this->controller.'/delete');
        $data['sCallFrom']          = $sFormAction;

        //$data['sQuery']             = $sQuery;
        //$data['bSearch']            = $search;
        
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller.'/'.__FUNCTION__,$data);
    }
    
       public function delete($iPackageId=0)
       {
           $data = array();

           if($iPackageId)
           {
                $data['iPackageId']     =   $iPackageId;
                $result                 =   $this->ApiPackage->delete($data);

                if($result['status'])
                {
                   return setMessage($result['status'], array('message' =>  getFormValidationSuccessMessage(MSG_DELETE_SUCCESS), 'redirectUrl'  =>  site_url('packages/view')));
                }
                else
                {
                   return  setMessage($result['status'], array('message' =>  getFormValidationErrorMessage(ERROR_DELETE_FAILURE), 'redirectUrl'  =>  site_url('packages/view')));
                }
           }
           redirect(site_url('packages/view'));
       }

    public function test()
    {
        $this->benchmark->mark('code_start');

        $PackageInfo = array
        (
            'package'   =>  array
            (
                'title'         => 'Paid Package '.time(),
                'description'   => 'Paid Package Description '.time(),
                'price'         => rand(10,80),
                'created_on'    => getDatabaseDate(),
                'created_by'    => getLoggedInUserId(),
            ),
            'products'  =>   array(1,2),
            'templates'  =>  array
            (
                1 => array(1),
                2 => array(2,3),
            ),
        );

        $result                         = $this->ApiPackage->create($PackageInfo);

        debug($result);
        $this->benchmark->mark('code_end');echo $this->benchmark->elapsed_time('code_start', 'code_end');
        exit;

    }

}
