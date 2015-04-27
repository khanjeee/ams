<?php

class ApiAdmin
{
	# Initializing Class Variables
	public $data    = array();
    public $result  = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array())
    {
		$this->data = $Data;
	}

	function validatePostedData($aPostedData = array())
    {
		if (is_array($aPostedData) && count($aPostedData) > 0)
        {
                if      ((isset($aPostedData['login_key'])  && filter_var($aPostedData['login_key'], FILTER_VALIDATE_EMAIL))
                &&      (isset($aPostedData['secret'])      && strlen($aPostedData['secret']) >= SECRET_LENGTH ))
                        {return true;}
		}
		return false;
	}

        
/**********************USERS CRUD***************************/
        
        public function createUser($aData= array())
        {
            
         $aPostedData   = $aData ;
           

        $CI = & get_instance();
        $CI->load->model('user_model','users');

            //$aDataToSave                = array('aData' => $aData,'isEditMode' => false);
            // d($aDataToSave);
            $iUserId                 = $CI->users->createUser(__FUNCTION__, $aPostedData);
          
            if($iUserId)
            {
                $this->result['status']     = true;
                $this->result['message']    = MSG_SUCCESS_USER_ADDED;
            }
        
		return $this->result;
	}
        
        public function getAllUsers($aData= array())
        {
            
         $aPostedData   = $aData ;
           
        $CI = & get_instance();
        $CI->load->model('user_model','users');
        
        return $CI->users->getAllUsers($aPostedData);
            
        
	}
        
        function deleteUserById($iUserId=0)
    {
        $CI = & get_instance();
        $CI->load->model('user_model','users');
        $aUserInfo = $CI->users->getUserById($iUserId);
        
        if($aUserInfo)
        {
                
                    if($CI->users->deleteUserById($aUserInfo))
                    {
                        $this->result['status']     = true;
                        $this->result['message']    = USER.' '.MSG_DELETE_SUCCESS;
                    }
                    else
                    {
                        $this->result['message']    = ERROR_DELETE_FAILURE;
                    }
            
        }
        
        return $this->result;
    }
    
/**********************USERS CRUD END***************************/    
    
    
        
        
	# Core Login Handler
	public function userLogin()
    {
		$aPostedData = (array) $this->data['data'];

		if (!$this->validatePostedData(FORM_TYPE_USER_LOGIN, $aPostedData))
        {
			$this->result['message'] = lang('ValidLoginCredentials');
			return $this->result;
		}

		# Check if user exists in database already

		$CI = & get_instance();
		$CI->load->model('user_model','users');

		$aUser = $CI->users->dataHandler
        (
				__FUNCTION__,
                array
                (
                    'login_key' => 'email',
                    'key_value' => $aPostedData['login_key'],
                    'login_secret' => 'password',
                    'secret_value' => $aPostedData['secret'],
				)
		);

		if ($aUser)
        {
			if (setLoggedInUserSession($aUser))
            {
                $CI->users->updateLastLoginTime($aUser);
				$this->result['status'] = true;
				$this->result['message'] = 'Welcome to '.SITE_TITLE.'....!';
			}
		}

		return $this->result;
	}

	/*
	 * Author : Hussain
	 * Code: This Function working for Default User on Public Web
	 *  Date : 31-10-2014 
	 *  Function _defaultUserLogin
	 */

	public function defaultUserLogin()
    {
		$aPostedData = (array) $this->data['data'];

		if (!$this->validatePostedData($aPostedData))
        {
			$this->result['message'] = ERROR_INVALID_CREDENTIALS;
			return $this->result;
		}

		# Check if user exists in database

		$CI = & get_instance();
		$CI->load->model('user_model',              'users');
        $CI->load->model('whitelabel_model',        'whitelabel');


        $aUser = $CI->users->dataHandler
        (
            __FUNCTION__, array (
                                    'login_key'     => 'email',
                                    'key_value'     => $aPostedData['login_key'],
                                    'login_secret'  => 'password',
                                    'secret_value'  => $aPostedData['secret'],
                                 )
		);

		if ($aUser)
        {
            if  (
                                $aUser['role_id'] == ROLE_ID_ADMINISTRATOR
                            or  $aUser['role_id'] == ROLE_ID_SUBSCRIBER
                            
            )
            {
                /*$aUser['predefined_campaigns_exists'] = 0;

                if(isset($aUser['whitelabel_id']) && $aUser['whitelabel_id'] > 0)
                {
                    $aUser['predefined_campaigns_exists'] = $CI->whitelabel->PredefinedCampaignsExists($aUser['whitelabel_id']);
                }*/

                if (setLoggedInUserSession($aUser))
                {
                    $CI->users->updateLastLoginTime($aUser);
                    $this->result['status'] = true;
                    $this->result['message'] =$aUser['first_name'].' '.$aUser['last_name'].' '. WELCOME_LOGIN ;
                }
            }
		}
        else
        {
            $this->result['message'] = ERROR_INVALID_CREDENTIALS;
        }
        
		return $this->result;
	}

	/*
	 * Sample static function just for learning
	 */

	/* //NOT IN USE!
	  public static function getSiteTitle()
	  {
	  return 'Nesma';
	  } */

	/*
	 * Get Fresh Data of Given User
	 */

	/* // NOT IN USE!
	  public function getUserForEdit()
	  {
	  $aData        = (array) $this->data;

	  if(isset($aData['user_id']) && $aData['user_id'] > 0)
	  {
	  $iUserId    = $aData['user_id'];

	  $CI =& get_instance();
	  $CI->load->model('users');

	  $aUser = $CI->users->Data_Handler
	  (
	  __FUNCTION__,
	  array  (
	  'key'       =>  'user_id',
	  'value'     =>  $iUserId,
	  )
	  );
	  return $aUser;
	  }
	  return array();
	  } */

	/*
	 * Update User Profile
	 */

	function saveUser($aData= array())
    {
        if($aData)      $aPostedData = $aData;
        else            $aPostedData = (array) $this->data['data'];

		# Must Required Fields
		$iUserId        = $aPostedData['user_id'];
		$sFirstName     = $aPostedData['first_name'];
		$sLastName      = $aPostedData['last_name'];


        if(!isUserLoggedIn())
        {
            $sEmailAddress  = $aPostedData['email'];
        }

		$sPassword      = $aPostedData['password'];
		$sDescription   = $aPostedData['description'];

		$aErrorMessages = array();

		if (!$sFirstName) {
			$aErrorMessages[] = lang('FirstNameRequired');
		}

		if (!$sLastName) {
			$aErrorMessages[] = lang('LastNameRequired');
		}
		if (!$sDescription) {
			$aErrorMessages[] = lang('DescriptionRequired');
		}


        if(!isUserLoggedIn())
        {
            if (!$sEmailAddress) {
                $aErrorMessages[] = lang('EmailRequired');
            } else {
                if (!validateEmailAddress($sEmailAddress)) {
                    $aErrorMessages[] = lang('ValidEmailAddress');
                }
            }
        }


		if (!$sPassword) {
			if (!$iUserId) { // For Update User: They can left it as blank field, if they dont want to change password!
				$aErrorMessages[] = lang('PasswordRequired');
			}
		} else {
			if (!strlen($sPassword) >= SECRET_LENGTH) {
				$aErrorMessages[] = lang('ApiAdmin_PasswordLimit'). SECRET_LENGTH . lang('ApiAdmin_Characters');
			}
		}


        $CI = & get_instance();
       $CI->load->model('user_model','users');


        # User Is in Edit Profile Mode
        if(!isUserLoggedIn())
        {
            # User Exits Check - START
            $aUser = (array) $CI->users->getUserForEdit(__FUNCTION__, array('key' => 'email','value' => $aPostedData['email']));
            if($aUser and count($aUser) > 0)
            {
                $ForgotPasswordUrl = site_url('home/forgotpassword');
                $aErrorMessages[] = lang('ApiAdmin_EmailAddressAlreadyTaken').' <a href="'.$ForgotPasswordUrl.'">'.  lang('ApiAdmin_ClickHere').'</a>';
            }
            # User Exits Check - END
        }
             if(isset($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']))
                if(!checkFileSizeLimit($_FILES))
                      {
                      $aErrorMessages[] = 'The uploaded File size is greater than 1 MB.';
                      }

		if ($aErrorMessages)
        {
			$this->result['message'] = $aErrorMessages;
			return $this->result;
		}

        #User is editing his own profile after login
        if(isUserLoggedIn() && !isSuperAdmin() == ROLE_ID_Administrator)
        {
            $aPostedData['iUserid']     = getLoggedInUserId();
            $aDataToSave                = array('section' => SECTION_BASIC,'aData' => $aPostedData,'isEditMode' => true);
            @$BasicInfoSaved            = $CI->users->SaveUserInfo(__FUNCTION__,$aDataToSave );
			
			 if($_FILES)
             {
					if(isset($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']) and $_FILES[MEDIA_FILE_UPLOAD_FIELD]['name'])
					{
						$ApiMedia                           =   new ApiMedia();
						$aMediaData['object_id']            =   getLoggedInUserId();
						$aMediaData['media_type']           =   MEDIA_TYPE_IMAGE;
						$aMediaData['object_type']          =   USER_IMAGE;
						$aMediaData['file_field_name']      =   MEDIA_FILE_UPLOAD_FIELD;
						$aMediaData['files']                =   $_FILES[MEDIA_FILE_UPLOAD_FIELD];
						$aMediaData['file_config']          =   USER_IMAGE_CONFIG;
						@$ApiMedia->UploadMedia(USER_IMAGE_CONFIG,$aMediaData);
					}
             }

            $this->result['status']     = true;
            $this->result['message']    = lang('UserSavedSuccessfully');
        }
        else
        {
            #   User is updated by Admin
            $bEditMode      = $bPassowrdIsChanged = false;
            if(isset($aPostedData['user_id']) and $aPostedData['user_id']) {$bEditMode  = true;}
            if(isset($aPostedData['password']) and $aPostedData['password'] and $bEditMode) {$bPassowrdIsChanged = true;}

            $EmailHash              = generateRandomString(20);
            $aPostedData['hash']    = $EmailHash;
            $bUserUpdated = $CI->users->dataHandler(__FUNCTION__, $aPostedData);

            if ($bUserUpdated)
            {
                $MediaUserid = $aPostedData['user_id'];
					
				if(!$MediaUserid)
				{
					$MediaUserid = $bUserUpdated;
				}
                
				# Save User Image
                if($_FILES)
                {
					if(isset($_FILES[MEDIA_FILE_UPLOAD_FIELD]['name']) and $_FILES[MEDIA_FILE_UPLOAD_FIELD]['name'])
					{
					
						$ApiMedia                           =   new ApiMedia();
						$aMediaData['object_id']            =   $MediaUserid;
						$aMediaData['media_type']           =   MEDIA_TYPE_IMAGE;
						$aMediaData['object_type']          =   USER_IMAGE;
						$aMediaData['file_field_name']      =   MEDIA_FILE_UPLOAD_FIELD;
						$aMediaData['files']                =   $_FILES[MEDIA_FILE_UPLOAD_FIELD];
						$aMediaData['file_config']          =   USER_IMAGE_CONFIG;
						@$ApiMedia->UploadMedia(USER_IMAGE_CONFIG,$aMediaData);
					
					}
					
                }
                #Saving User info Basic Section extra fields in users_info table
				$aPostedData['iUserid']     = $MediaUserid;
				$aDataToSave                = array('section' => SECTION_BASIC,'aData' => $aPostedData);
                @$BasicInfoSaved            = $CI->users->SaveUserInfo(__FUNCTION__,$aDataToSave );

                if(!$bEditMode)
                {
                    @SendEmail(__FUNCTION__,$aPostedData);
                    $this->result['iUserid']    = $bUserUpdated;
                }

                if($bPassowrdIsChanged)
                {
                    @SendEmail("PasswordChangedByAdmin",$aPostedData);
                }

                $this->result['status']     = true;
                $this->result['message']    = lang('UserSavedSuccessfully');
            }
        }


		return $this->result;
	}


    function UpdateBasicInfo($CoreBasicInfo = array())
    {
        $CI = & get_instance();
        $CI->load->model('user_model','users');

        $SessionData                = getLoggedInUserData();
        $SessionData['first_name']  = $CoreBasicInfo['first_name'];
        $SessionData['last_name']   = $CoreBasicInfo['last_name'];
        $CI->session->set_userdata(SESS_USERDATA, $SessionData);
        $SessionData = getLoggedInUserData();

        return $CI->users->UpdateBasicInfo(__FUNCTION__, $CoreBasicInfo);
    }


    function SaveUserProfile($aData= array())
    {
        $CI = & get_instance();
        $CI->load->model('user_model','users');

        if($CI->users->SaveUserInfo(__FUNCTION__,$aData))
        {
            $this->result['status']     = true;
            $this->result['message']    = lang('ApiAdmin_ProfileUpdateSuccessfully');
        }

        return $this->result;
    }
	
	
	function ForgotPassword()
	{
		$aPostedData = (array) $this->data['data'];
		$aErrorMessages = array();
		
		
		
		$CI = & get_instance();
		$CI->load->model('user_model','users');
		if( isset($aPostedData['login_key'] ) && filter_var( $aPostedData['login_key'], FILTER_VALIDATE_EMAIL ) ) 
		{
			$aUserInfo       =		(array)  $CI->users->getUserInfoByEmail($aPostedData['login_key']);
			if($aUserInfo)
			{
					$aUserInfo['Password']    = generateRandomString();
					$aUserInfo['Md5Pssword']  = md5($aUserInfo['Password']);
					$aReset      =		(array)  $CI->users->ResetPassword($aUserInfo);
					if($aReset)
					{
                        SendEmail(__FUNCTION__,array('UserInfo' => $aUserInfo));
                        $this->result['status']     = TRUE;
                        $this->result['message']    = MSG_SUCCESS_PASSWORD_CHANGED;
					}
			}
			else
			{
					$aErrorMessages[] = MSG_INVALID_ATTEMPT;
			}
			
			if ($aErrorMessages)
			{
				$this->result['message'] = $aErrorMessages;
				return $this->result;
			}
		}
		return $this->result;
	}

    function ChangePassword()
    {
        $aPostedData = (array) $this->data['data'];
        $aErrorMessages = array();

        if($aPostedData)
        {
            $OldPass            = $aPostedData['old_pass'];
            $NewPass            = $aPostedData['new_pass'];
            $ConfirmNewPass     = $aPostedData['confirm_new_pass'];

            if( (!$OldPass) or (!$NewPass) or (!$ConfirmNewPass)  )
            {
                $aErrorMessages[] = lang('ApiAdmin_Required');
            }

            if($NewPass != $ConfirmNewPass)
            {
                $aErrorMessages[] = lang('ApiAdmin_PasswordsMismatched');
            }

            if ($aErrorMessages)
            {
                $this->result['message'] = $aErrorMessages;
                return $this->result;
            }


            # All Validations are passed -- now Continue
            $CI = & get_instance();
            $CI->load->model('user_model','users');

            # Check Old Password is true or not
            $OldPasswordHash        = md5($OldPass);
            $bOldPasswordIsCorrect  = $CI->users->getUserForChangePassword(__FUNCTION__,array('user_id' => getLoggedInUserId(),'key' => 'password','value'=>$OldPasswordHash));

            if(!$bOldPasswordIsCorrect)
            {
                $aErrorMessages[] = lang('ApiAdmin_OldPasswordIncorrect');
                $this->result['message'] = $aErrorMessages;
                return $this->result;
            }

            $NewPasswordHash        = md5($NewPass);

            # Old Password Is Correct Now ChangePassword
            $bPasswordChanged = $CI->users->ResetPassword(array('user_id' => getLoggedInUserId(),'Md5Pssword'=>$NewPasswordHash));

            if($bPasswordChanged)
            {
                $this->result['status']     = TRUE;
                $this->result['message']    = lang('ApiAdmin_PasswordChangedSuccessfully');
            }
        }
        return $this->result;
    }
	
	
	public function ChangeUserStatus($aData= array())
	{
		
		$aErrorMessages = array();
			
        if(!isset($aData['users']))
        {
            $aErrorMessages[] =  'Invalid attempt';
        }

		if($aErrorMessages)
        {
                $this->result['message'] = $aErrorMessages;
                return $this->result;
        }
		$CI =& get_instance();
        $CI->load->model('user_model','users');
        
        $UserStatus = $CI->users->ChangeUserStatus($aData);

        if($UserStatus)
        {
            $this->result['status']  = true;
            $this->result['message'] = 'Operation successfull.';
        }
        
        return $this->result;
	}


    function VerifyAccount($Hashcode = '')
    {
        $Result = array();
        $CI     =& get_instance();
        $CI->load->model('user_model','users');

        if($Hashcode)
        {
            $AffectedRows =  (int) $CI->users->VerifyAccount(__FUNCTION__,$Hashcode);

            if($AffectedRows)
            {
                $this->result['status']  =  true;
                $this->result['message'] = 'Email verified.';
            }
        }

        return $this->result;
    }

}