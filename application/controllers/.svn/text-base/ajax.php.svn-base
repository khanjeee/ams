<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('BATCH_UPLOAD_CONTENT', 'BatchUploadContent');
class Ajax extends CI_Controller
{
    public $aData       = array();
    public $sMethod     = ''; 

    public function __construct()
    {
        parent::__construct();

        $this->controller  	= strtolower(__CLASS__);
        $this->aData        = $this->_handlePostedData();
    }

    private function _handlePostedData()
    {
        $aPostedData    =   array();

        //if($_REQUEST)       {$aPostedData = $_REQUEST;} Not working on #http://ams.devtestonline.com/batches/create/7
        if($_POST)       	{$aPostedData = $_POST;}
        else                {$aPostedData = json_decode(@file_get_contents("php://input"),true);}

        if($aPostedData)
        {
            if(isset($aPostedData['method']) and $aPostedData['method']) {$this->sMethod = $aPostedData['method'];}
        }

        return $aPostedData;
    }

    public function product($sMethod = 'getTemplatesByProductId')
    {
        $aPostedData        =   $this->aData;
        $sMethod            =   $this->sMethod;

        $ApiProduct     =   new ApiProduct();
        echo $ApiProduct->$sMethod($aPostedData);
        exit;
    }
    
    public function batches($sMethod = 'createBatch')
    {
        $aPostedData        =   $this->aData;
        $sMethod            =   $this->sMethod;

        $ApiBatches         =   new ApiBatches();
        echo $ApiBatches->$sMethod($aPostedData);
        exit;
    }

    public function upload($sMethod = 'createBatch')
    {
        $sCallFrom          =   '';
        $aMediaData         =   array();

        $aPostedData        =   $this->input->post();

        if(isset($aPostedData['call_from']) and $aPostedData['call_from'])
        {
            $sCallFrom          =   $aPostedData['call_from'];
        }

        $FileUploadConfig = array
        (
            BATCH_UPLOAD_CONTENT    =>  array
            (
                'upload_path'       =>  './media/fold_elements/',
                'thumb_path'        =>  'thumbnail',
                'encrypt_name'      =>  true,
                'allowed_types'     =>  'gif|jpg|png|bmp',
                'sizes'             =>  array
                                        (
                                            'small'     => array('width'=>250, 'height'=>250),
                                            'medium'    => array('width'=>500, 'height'=>500),
                                            'large'     => array('width'=>1000, 'height'=>1000),
                                        )
            ),
        );

        if($sCallFrom)
        {
            if($_FILES)
            {
                if(isset($_FILES[FILE_UPLOAD_FIELD]['name']) and $_FILES[FILE_UPLOAD_FIELD]['name'])
                {
                    $ApiMedia                           =   new ApiMedia();
                    $aMediaData['configurations']       =   $FileUploadConfig[$sCallFrom];
                    $aMediaData['files']                =   $_FILES[FILE_UPLOAD_FIELD];
                    $aResult                            =   $ApiMedia->UploadMedia($sCallFrom,$aMediaData);

                    $this->callRespectiveHandler
                    (
                        array
                        (
                            'aPostedData'   => $aPostedData,
                            'aUploadResult' => $aResult,
                            'sCallFrom'     => $sCallFrom,
                        )
                    );
                }
            }
        }
    }

    function callRespectiveHandler($aData)
    {
        $sCallFrom      = $aData['sCallFrom'];

        if($sCallFrom)
        {
            if($sCallFrom == BATCH_UPLOAD_CONTENT)
            {
                $ApiBatches     =   new ApiBatches();
                $aResult        =   $ApiBatches->UploadBatchContentImage($sCallFrom, $aData);
            }
        }

        return $aResult;
    }

    public function campaign($sMethod = 'updateCampaign')
    {
        $aPostedData        =   $this->aData;
        $sMethod            =   $this->sMethod;

        $ApiCampaign     =   new ApiCampaign();
        echo $ApiCampaign->$sMethod($aPostedData);
        exit;
    }

    public function package($sMethod = 'getPromoCodePackages')
    {
        $aPostedData        =   $this->aData;
        $sMethod            =   $this->sMethod;

        $ApiPackage     =   new ApiPackage();
        $aResult        =   $ApiPackage->$sMethod($aPostedData);

        echo json_encode($aResult);
        exit;
    }

    /*******************************************************************/
    public function predefined_campaign($sMethod = 'updateCampaign')
    {
        $aPostedData        =   $this->aData;
        $sMethod            =   $this->sMethod;

        $ApiPredefinedCampaigns    =   new ApiPredefinedCampaigns();
        echo $ApiPredefinedCampaigns->$sMethod($aPostedData);
        exit;
    }

    public function predefined_batches($sMethod = 'createBatch')
    {
        $aPostedData        =   $this->aData;
        $sMethod            =   $this->sMethod;

        $ApiPredefinedBatches    =   new ApiPredefinedBatches();
        echo $ApiPredefinedBatches->$sMethod($aPostedData);
        exit;
    }
    /*******************************************************************/
}
