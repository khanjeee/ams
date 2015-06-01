<?php

class ApiProduct
{
	# Initializing Class Variables
	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
		$this->data = $Data;
	}

    function getTemplatesByProductId($aData = array())
    {
        $CI = & get_instance();
        $CI->load->model('product_model');

        $aTemplates         =   $CI->product_model->$aData['method']($aData['product_id']);

        if($aTemplates)
        {
            for($t=0; $t<count($aTemplates);$t++)
            {
               $iTemplatePrice = $CI->product_model->getTemplatesPrice($aTemplates[$t]['template_id']);

                if($iTemplatePrice)
                {
                    $aTemplates[$t]['printing_price'] = $iTemplatePrice['printing_price'];
                }
            }
        }

        $hAjaxHTML          =   '';

        if(isset($aData['call_from']) && $aData['call_from'])
        {
            $sCallFrom      = $aData['call_from'];

            if($sCallFrom  ==  'createPackage')
            {
                $hAjaxHTML          =   $CI->load->view('products/ajax_get_templates',array('aTemplates'=>$aTemplates,'product_name'=>$aData['product_name'],'product_id'=>$aData['product_id']),TRUE);
            }
            else if($sCallFrom  ==  'createCampaign')
            {
                $hAjaxHTML          =   $CI->load->view('campaigns/ajax_get_templates',array('aTemplates'=>$aTemplates,'product_id'=>$aData['product_id']),TRUE);
            }
        }

        return $hAjaxHTML;
    }

    function getProducts($aData = array())
    {
        $CI = & get_instance();
        $CI->load->model('product_model');

        $aTemplates         =   $CI->product_model->$aData['method']($aData['product_id']);
        $hAjaxHTML          =   '';

        if(isset($aData['call_from']) && $aData['call_from'])
        {
            $sCallFrom      = $aData['call_from'];

            if($sCallFrom  ==  'createPackage')
            {
                $hAjaxHTML          =   $CI->load->view('products/ajax_get_templates',array('aTemplates'=>$aTemplates,'product_name'=>$aData['product_name'],'product_id'=>$aData['product_id']),TRUE);
            }
            else if($sCallFrom  ==  'createCampaign')
            {
                $hAjaxHTML          =   $CI->load->view('campaigns/ajax_get_templates',array('aTemplates'=>$aTemplates,'product_name'=>$aData['product_name'],'product_id'=>$aData['product_id']),TRUE);
            }
        }

        return $hAjaxHTML;
    }

 function create($aData= array())
    {
        # Handling Given Data
        if($aData)      $aPackageData = $aData;
        else            $aPackageData = (array) $this->data;

        #If Given Data Exists
        if($aPackageData)
        {
            $CI = & get_instance();
            $CI->load->model('product_model','product');

            # Create Package
            if($iPackageId  = $CI->product->createProduct(__FUNCTION__,$aPackageData ))
            {
                # Adding Newly Created PackageId into PackageData for further use
                $aPackageData['package_id']             =   $iPackageId;

                # Save Package-->Products
                $iProductSettled                        =   $CI->package->setPackageProducts(__FUNCTION__,$aPackageData );

                if($iProductSettled)
                {
                    # Save Products-->Templates
                    $iProductTemplatesSettled           =   $CI->package->setPackageProductTemplates(__FUNCTION__,$aPackageData );

                    if(isset($aPackageData['modules']) && count($aPackageData['modules']) > 0 )
                    {
                        $iProductTemplatesSettled           =   $CI->package->setPackageModules(__FUNCTION__,$aPackageData );
                    }

                    if($iProductTemplatesSettled)
                    {
                        # Hurray....!!!  -- Package Created Successfully...!
                        $this->result = array('status' => TRUE, 'message' => PACKAGES. ' created successfully.');
                    }
                }
            }
        }
        return $this->result;
    }    
    
    
    
    
    }