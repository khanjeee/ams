<?php if (!defined('BASEPATH'))   exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Anas
 * Date: 12/23/14
 * Time: 3:51 PM
 */

function _encrypt_with_url_decode($pure_string) {
        
        $CI = & get_instance();
        $CI->load->library('encrypt');
        
        $encrypted_string =  urlencode($CI->encrypt->encode($pure_string));
         
        return $encrypted_string;
    }

    /**
     * Returns decrypted original string
     */
    function _decrypt_with_url_decode($encrypted_string) {
        
        $CI = & get_instance();
        $CI->load->library('encrypt');
        
        $decrypted_string = $CI->encrypt->decode(urldecode($encrypted_string));
        
        return $decrypted_string;
    }
    
    
    function _decrypt_without_url_decode($encrypted_string) {
        
        $CI = & get_instance();
        $CI->load->library('encrypt');
        
        $decrypted_string = $CI->encrypt->decode($encrypted_string);
        
        return $decrypted_string;
    }

function d($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>"; die;
}

function s($arr)
{
    echo "<pre>";
    echo($arr);
    echo "</pre>"; die;
}
function debug($arr)
{
    echo "<pre class='debug'>";
    print_r($arr);
    echo "</pre>";
}

function getAssetsPath() {
    return getBaseUrl() . 'assets/';
}

function getBaseUrl(){return site_url();}

function setMessage($sucess, $data = array())
{

    $CI = & get_instance();
    $CI->load->library('session');

    if (is_array($data['message']) && count($data['message']) > 0) {
        $data['message'] = getFormValidationErrorMessage($data['message']);
    }
    

    if ($sucess) {
        $CI->session->set_flashdata('flash_message', $data['message']);
    } else {
        $CI->session->set_flashdata('flash_error', $data['message']);
    }

    if (isset($data['redirectUrl'])) {
        redirect($data['redirectUrl']);
        exit;
    }
}

function getFormValidationErrorMessage($aErrors) {
    $htmlErrorMessages = '';
    if (is_array($aErrors) && count($aErrors) > 0) {
        foreach ($aErrors as $errorKey => $errorMessage) {
            $htmlErrorMessages .= '<li>' . $errorMessage . '</li>';
        }

        if ($htmlErrorMessages) {
            $htmlErrorMessages = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><ul class="text-danger">' . $htmlErrorMessages . '</ul></div>';

        }
    } else {
        $htmlErrorMessages = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><ul class="text-danger"><li>' . $aErrors . '</li></ul></div>';
    }

    return $htmlErrorMessages;
}

function getFormValidationSuccessMessage($aErrors)
{
    $htmlErrorMessages = '';
    if (is_array($aErrors) && count($aErrors) > 0)
    {
        foreach ($aErrors as $errorKey => $errorMessage) {
            $htmlErrorMessages .= '<li>' . $errorMessage . '</li>';
        }

        if ($htmlErrorMessages)
        {
            $htmlErrorMessages = <<<MSG
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> <ul>$htmlErrorMessages</ul>
            </div>
MSG;
        }
    }
    else
    {
        $htmlErrorMessages = <<<MSG
        <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> $aErrors
            </div>

MSG;
    }
    return $htmlErrorMessages;
}

function setLoggedInUserSession($SessionData = array())
{
    if ($SessionData)
    {
        $CI = & get_instance();
        $CI->load->library('session');

        $SessionData['logged_in'] = TRUE;
        $CI->session->set_userdata(LOGIN_USER_DATA, $SessionData);

        //Set Global User here
        #setGlobalUser();
        return true;
    }

    return false;
}

function isUserLoggedIn() {
    $CI = & get_instance();
    $aLoggedInUserData = $CI->session->userdata(LOGIN_USER_DATA);

    if ($aLoggedInUserData and isset($aLoggedInUserData['logged_in']) and $aLoggedInUserData['logged_in']) {

        return true;
    }

    return false;
}


function isPromotionCodeExists($iPromotionCode)
{
	$CI = & get_instance();
	$CI->load->model('whitelabel_model', 'whitelabel');
	return $CI->whitelabel->CheckPromotionCode($iPromotionCode);
}


function UploadImage($sCallFrom,	$aData = array())
{
	 $CI =& get_instance();
	 $aResponce = array();
	if($sCallFrom == COMPANY_CREATED)
	{
			global $gCompanyLogoConfig;
			$gCompanyLogoConfig['file_name'] = 'logo-'. time();
			$CI->load->library('upload', $gCompanyLogoConfig);
	}
	elseif($sCallFrom == USER_IMAGE)
	{
			global $gUserImageConfig;
			$CI->load->library('upload', $gUserImageConfig);
	}		
			
			if (!$CI->upload->do_upload(MEDIA_FILE_UPLOAD_FIELD))
			{
				$aResult['message'] = strip_tags($CI->upload->display_errors());
			} 
			else 
			{
				$aResult['UploadInfo'] = $CI->upload->data();
				if ($aResult['UploadInfo']['is_image']) 
				{
						$aResponce	 = $aResult['UploadInfo'];
				}
			}
			return $aResponce;
	
	
			
}

function getLoggedInUserId() {
    $iId = 0;

    if (isUserLoggedIn())
    {
        $CI =& get_instance();
        $aLoggedInUserData = $CI->session->userdata(LOGIN_USER_DATA);

        $iId = (int) $aLoggedInUserData['user_id'];
    }

    return $iId;
}

function getFlag($iFlagId)
{
	$Flag = 'N/A';
	if($iFlagId)
	{
			$CI = & get_instance();
			$CI->load->model('flag_model','flag');
			$FlagTitle =  $CI->flag->getFlagId($iFlagId);
			
			if(is_array($FlagTitle))
			{
				$Flag =  $FlagTitle[0]->title;
			}
	}
	return $Flag;

	
}


function getLoggedInUserData()
{
    $aLoggedInUserData = array();
    if (isUserLoggedIn())
    {
        $CI = & get_instance();
      //  $CI->load->model('media');
        $aLoggedInUserData = $CI->session->userdata(LOGIN_USER_DATA);

//        if($aLoggedInUserData['user_id'])
//        {
//            $aLoggedInUserData['Image']     =   (array)  $CI->media->getImageByObjectId(USER_IMAGE,$aLoggedInUserData['user_id'],COURSE_MATERIAL_THUMB_SMALL);
//        }

        return $aLoggedInUserData;
    }
    return false;
}

function getLoggedInUserPackageId()
{
    $iPackageId             = 0;
    $aLoggedInUserData      = array();
    if (isUserLoggedIn())
    {
        $CI = & get_instance();
        $aLoggedInUserData = $CI->session->userdata(LOGIN_USER_DATA);

        if($aLoggedInUserData['role_id'] == ROLE_ID_SUBSCRIBER)
        {
            $iPackageId =  $aLoggedInUserData['package_id'];
        }
    }
    return $iPackageId;
}

function getUserRoleById()
{
    $iId=0;
    $iRoleId =0;

    $CI		= & get_instance();
    //$CI->load->model('users');
	$CI->load->model('user_model','users');
    if(getLoggedInUserId())
    {
        $iId =  getLoggedInUserId();
        $iRoles =  $CI->users->getUserById($iId);

        $iRoleId = $iRoles->role_id;
    }
    return $iRoleId;
}


function AddContactInListArray($aList = array())
{#this function work for add contacts of list in list array by list id
	if(is_array($aList) && !empty($aList))
	{
		$CI		= & get_instance();
		#d($CI->list->getContactByListId(16));
		$iListCount = count($aList);
		#d($CI->list->getContactByListId(1));
		for($i = 0; $i < $iListCount; $i++)
		{
			$aList[$i]->total_contact=  $CI->list->getContactByListId($aList[$i]->list_id);
		}
		return $aList;
	}
	 return array();
}

function getMasterContactByUser()
{#this function work for add contacts of list in list array by list id
	
		$CI		= & get_instance();
		
		 $iUserId = getLoggedInUserId();
		
			$iMasterContact =  $CI->list->getMasterContactByUser($iUserId);
			
		return $iMasterContact;
	

}
function isWhiteLablelUser()
{
    $aUserData = getLoggedInUserData();
    return empty($aUserData['promotion_code']) ? false : true;
}

function getWhiteLablelId()
{
    $aUserData = getLoggedInUserData();
    return $aUserData['whitelabel_id'];
}

function hasPreDefinedCampaigns()
{
    $aUserData = getLoggedInUserData();
    return empty($aUserData['predefined_campaigns_exists']) ? false : true;
}


function isSuperAdmin()
{
    $sRoleId = getUserRoleById();

    if($sRoleId == ROLE_ID_ADMINISTRATOR)
    {
        return true;
    }
    return false;

}

function validateEmailAddress($sEmailAddress)
{
    if (!filter_var($sEmailAddress, FILTER_VALIDATE_EMAIL))
    {
        return false;
    }
    return true;
}

function validateId($iId =  0)
{
    if(is_string($iId))                     {$iId = (int) $iId;}

    if( ($iId) and ($iId > 0) )             {return true;}

    return false;
}

function validateUrl($sUrl)
{
    if (!filter_var($sUrl, FILTER_VALIDATE_URL))
    {
        return false;
    }

    return true;
}

function getUserName($oUser)
{
    $oUser =    (object) $oUser;
    $name =     $oUser->first_name . " " . $oUser->last_name;

    return $name;
}

function displayDate($date, $format = DATE_FORMAT_DISPLAY) {
    $dateFormat = date($format, strtotime($date));

    return $dateFormat;
}

function getSolutionType($iType=0)
{
	$sSolutiontype = '----';
	if(!empty($iType))
	{
			if($iType == SOLUTION_TYPE_VALUE_A)
			{
				$sSolutiontype = SOLUTION_TYPE_A;
			}
			elseif($iType == SOLUTION_TYPE_VALUE_B)
			{
				$sSolutiontype = SOLUTION_TYPE_B;
			}
	}
	
	return $sSolutiontype;
}

function displayDateTime($dateTime, $format = DATE_TIME_FORMAT_DISPLAY) {
    $dateTimeFormat = date($format, strtotime($dateTime));

    return $dateTimeFormat;
}


function formatAmount($iValue=0)
{
    $iValue = (int) $iValue;
    return '$'.number_format($iValue, 2, '.', '');
}

function displayTime($time, $format = TIME_FORMAT_DISPLAY) {
    $timeFormat = date($format, strtotime($time));

    return $timeFormat;
}

function getGlobalVariableValue($gVariable, $key)
{
    $sValue = '';

    if      (isset($gVariable[$key]))   {   $sValue = $gVariable[$key]; }
    else                                {   $sValue = $key;             }

    return $sValue;
}



function SendEmail($callFrom = '', $Data = array())
{
    $aStatus            = array();
    $aFormattedEmail    = getFormatedEmail($callFrom, $Data);
    $sTo                = $aFormattedEmail['to'];
    $sFrom              = AMS_INFO_EMAIL;
    $sSubject           = $aFormattedEmail['subject'];
    $sMessage           = $aFormattedEmail['content'];

    define('ENV_LOCAL',true);

    if(ENV_LOCAL)
    {
        $email_config = Array
        (
            //'protocol'  => 'smtp',
            'smtp_host' => '127.0.0.1',
            'smtp_port' => 25,
            'mailtype' => 'html',
            'charset'   => 'iso-8859-1'
        );
    }
    else
    {
        # This config is working for Demo Server
        $email_config = Array
        (
            'protocol'  => 'smtp',
            #'smtp_host' => 'ssl://ip-203-124-120-111.ip.secureserver.net',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'noreply@nesma.com',
            'smtp_pass' => '123nrep123-',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );

        /*# This config is working for Dev Server
        $email_config = Array
        (
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => '465',
            'smtp_user' => 'apptestid2014@gmail.com',
            'smtp_pass' => 'apptestonline1',
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );*/
    }

    $sContent['sMessage'] = $sMessage;
    $CI = & get_instance();

    $sMessage = $CI->load->view('email_template/email.php',$sContent,true);

    $CI->load->library('email',$email_config);
    $CI->email->from('noreply@ams.com','Automated mailing System');
    $CI->email->to($sTo);
    $CI->email->subject($sSubject);
    $CI->email->message($sMessage);

    if($CI->email->send())
    {
        return true;
    }
    else
    {
        return false;
    }
}



function getFormatedEmail($callFrom, $Data)
{
    global $sSubjectPrefix, $sEmailFooter;

    $CI	                =&  get_instance();
    $sSiteTitle         =   SITE_TITLE;
    $sUrl               =   site_url();
    $sSubjectPrefix     =   '['. $sSiteTitle .'] ';
    $sEmailFooter       =   'Thanks, Team '.$sSiteTitle;

    if($callFrom == 'save')
    {
        $aFinalEmail['subject']     =   $sSubjectPrefix.' Welcome to '.SITE_TITLE;
        $Name                       =   $Data['first_name'].' '.$Data['last_name'];
        $Email                      =   $Data['email'];
        $Hash                       =   $Data['hash'];
        $UserVerifyUrl              =   site_url('register/verify?v='.$Hash);

        $HTMLEmailTemplate = <<<EMAIL

			<div>Hi ,</div>
			<div>$Name</div>

           <div>Your Account has been created. <br/>Please click on url below to verify your account.</div>
           <div><a href="$UserVerifyUrl">Click here </a> to verify your account</div>
           <div>OR insert the hash code below in verification box</div>
           <div>$Hash</div>
                

            $sEmailFooter
EMAIL;
        $aFinalEmail['content'] = $HTMLEmailTemplate;
        $aFinalEmail['to']      = $Email;

    }
    
   else if($callFrom == 'ForgotPassword')
    {
		$aData =  $Data['UserInfo'];

        $aFinalEmail['subject']     =   $sSubjectPrefix.'Forgot Password';
        $sPassword                  =   $aData['Password'];
        $Name                       =   $aData['first_name'].' '.$aData['last_name'];
        $Email                      =   $aData['email'];

        $HTMLEmailTemplate = <<<EMAIL


			<div>Hi,</div>
			<div>$Name</div>
			<div>Your password has been updated. <br/>Here are your new login credentials.</div>
            <div>Email    : $Email</div>
			<div>Password : $sPassword</div>
			<div><a href="$sUrl">Click here to login</a></div>


            $sEmailFooter
EMAIL;
        $aFinalEmail['content'] = $HTMLEmailTemplate;
        $aFinalEmail['to']      = $Email;

    }
   
	else if($callFrom == COMPANY_CREATED)
    {
		
		
        $aFinalEmail['subject']     =   $sSubjectPrefix.' Welcome to '.SITE_TITLE;
        $CompanyTitle               =   $Data['title'];
        $Email                      =   $Data['email_address'];
        

        $HTMLEmailTemplate = <<<EMAIL

			<div>Hi ,</div>
			<div>$CompanyTitle</div>

           <div>Your Company has been created.</div>
          $sEmailFooter
EMAIL;
        $aFinalEmail['content'] = $HTMLEmailTemplate;
        $aFinalEmail['to']      = $Email;

    }

    return $aFinalEmail;
}


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++)
    {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function SearchArrayandGetValue($id, $array)
{
    foreach ($array as $key => $val) {if ($val['field_name'] === $id) {return $val['field_value'];}}
    return '';
}

function trimText($sText, $iCharacterLimit = DEFAULT_SHORT_DESCRIPTION_LIMIT)
{
    $sText = substr($sText, 0, $iCharacterLimit);
    $sText = substr($sText, 0, strrpos($sText,' '));
    $sText = $sText . " ...";

    return $sText;
}

function checkFileSizeLimit($aFile)
{
    if(isset($aFile['file_upload']['size']))
    {
        $iFileSize      = intval($aFile['file_upload']['size']) / FILE_UPLOAD_LIMIT;
        if($iFileSize   > FILE_UPLOAD_LIMIT) return false;
    }
    return true;
}

function ShowProjectName()
{
    echo SITE_TITLE;
    return ;
}

function setGlobalUser()
{
    global $user;

    $user->user_id      = '264';
    $user->name         = 'Subscriber';
    $user->email        = 'umair771@gmail.com';
    $user->role_name    = 'subscriber';
    $user->role_id      = '2';

    return;
}

function getDatabaseDate()
{
    return date(DATE_FORMAT_MYSQL);
}


function checkKeyExists($key,$aData)
{
	
	$value = NOT_AVAILABLE;
	if(is_array($aData) && !empty($aData))
	{
		
		if(array_key_exists($key,$aData))
		{
			if(isset($key) && !empty($key)) 
			{
				$value = $key; 
			} 
		}
	}
	else
	{
		$aData[$key] = $value;
	}
	return $value;
}




//function UploadImage($sCallFrom,	$aData = array())
//{
//	 $CI =& get_instance();
//	 $aResponce = array();
//	if($sCallFrom == COMPANY_CREATED)
//	{
//			
//			global $gCompanyLogoConfig;
//			$gCompanyLogoConfig['file_name'] = 'logo-'. time();
//			 
//			$CI->load->library('upload', $gCompanyLogoConfig);
//			
//			
//			if (!$CI->upload->do_upload(MEDIA_FILE_UPLOAD_FIELD))
//			{
//				$aResult['message'] = strip_tags($CI->upload->display_errors());
//			} 
//			else 
//			{
//				$aResult['UploadInfo'] = $CI->upload->data();
//				if ($aResult['UploadInfo']['is_image']) 
//				{
//						$aResponce	 = $aResult['UploadInfo'];
//				}
//			}
//			return $aResponce;
//	
//	
//			
//}