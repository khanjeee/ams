<?php

class User_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function emailAlreadyExist($email='')
    {
        $this->db->select('user_id');
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $result=$query->result();
        
        if($result)
        {
            return true;
        }
        
        return false;
    }
    
     function createUser($sCallFrom = '', $aData = array())
    {
       
        if ($aData)
        {
            //$iUserId            = $aData['user_id'];
            $iRoleId            = 2;
            $sFirstName         = $aData['first_name'];
            $sLastName          = $aData['last_name'];
            $sEmail             = $aData['email'];
            $spassword          = md5($aData['password']);
            $iIs_active         = 0;
            $sUserImage         = $aData['image'];
            $sGender            = $aData['gender'];
            $sPromoCode         = $aData['promotion_code'];
            $dDate              = date(DATE_FORMAT_MYSQL);
            //$LoggedInUser       = getLoggedInUserId();
            $sAddressMailing    = $aData['inserted_values']['mailing'];
            $sAddressBilling    = $aData['inserted_values']['billing'];
            $iPackageId         = $aData['package_id'];

            # Insert!

            $SQL = <<<SQL

			INSERT INTO  users 
					(
                    role_id, first_name, last_name, email, password,promotion_code,gender,address_mailing,address_billing,image, is_active, joined_on,  package_id)
			 VALUES (
                    '$iRoleId', '$sFirstName', '$sLastName', '$sEmail', '$spassword','$sPromoCode','$sGender','$sAddressMailing','$sAddressBilling','$sUserImage' ,'$iIs_active','$dDate', '$iPackageId' )
			 
SQL;
            
            if ($this->db->query($SQL))
            {
                if ($iUserId = $this->db->insert_id())
                {
                    return $iUserId;
				}
            }
        }
        
        echo $sCallFrom;
        return false;
    }
    
    
    function addSubscriber($sCallFrom = '', $aData = array())
    { 
        return $this->createUser($sCallFrom, $aData);
    }
    
    function updateSubscriberStaus($aData = array())
    {
         
        $email     = (string)$aData['email'];
        $status    = $aData['status'];
        
        //d($email);
        $data = array('is_active' => $status);
        $this->db->where('email', $email);
        $this->db->update('users', $data);
        
        //d($this->db->last_query());
        if($this->db->affected_rows())
        {
            return true;
        }
        return false;
    }
    
    
    /*
     * This is a wrapper function for all CRUD operations.
     * Decides which data handler is to be called according to given post type
     */

    public function dataHandler($type = "", $Data = array()) {


        if ($type) {
            if ($type == 'userLogin')
                return $this->_userLogin($type, $Data);
            else if ($type == 'defaultUserLogin')
                return $this->_defaultUserLogin($type, $Data);
            else if ($type == 'saveUser')
                return $this->_saveUser($Data);
            else if ($type == 'deleteTrainer')
                return $this->deleteTrainer($Data);
            else if ($type == 'deleteVolunteer')
                return $this->deleteVolunteer($Data);
            else if ($type == 'deleteTrainee')
                return $this->deleteTrainee($Data);
            else if ($type == 'deleteCompanyRep')
                return $this->deleteCompanyRep($Data);
            else if ($type == 'deleteEntrepreneur')
                return $this->deleteEntrepreneur($Data);
            else if ($type == 'AddAvailability')
                return $this->addavailability($Data);
            else if ($type == 'deleteAvailabilityTimeSlot')
                return $this->deleteAvailabilityTimeSlot($Data);
            else if ($type == 'saveUserInfo')
                return $this->_saveUserInfo($Data);

            #else if($type == 'markattendance')   		return  $this->getUserFullNameById($Data);
        }
        return false;
    }

    /*
     *  Perform Login
     */

    private function _userLogin($sType = "", $aData = array()) {
        if ($aData) {
            $sLoginKey = trim($aData['login_key']);
            $sLoginValue = trim($aData['key_value']);
            $sLoginSecret = trim($aData['login_secret']);
            $sSecretValue = md5(trim($aData['secret_value']));

            $adminRoleId = ROLE_ID_ADMIN;

            $SQL = <<<SQL

                SELECT user_id ,first_name,last_name,email FROM users WHERE role_id='$adminRoleId' AND $sLoginKey = '$sLoginValue' AND  $sLoginSecret = '$sSecretValue' LIMIT 1
SQL;
			
			
            if ($Result = $this->db->query($SQL)) {
                $aRow = $Result->row();

                if ($aRow) {
                    return (array) $aRow;
                }
            }
        }
        return array();
    }

    /*
     *  Author : Hussain
     *  Code: This Function working for Default User on Public Web
     *  Date : 31-10-2014 
     *  Function _defaultUserLogin
     */

    private function _defaultUserLogin($sType = "", $aData = array()) {
        if ($aData) 
		{
            $sLoginKey		= trim($aData['login_key']);
            $sLoginValue	= trim($aData['key_value']);
            $sLoginSecret	= trim($aData['login_secret']);
            $sSecretValue	= md5(trim($aData['secret_value']));
			
            $SQL = <<<SQL

                SELECT
                            u.user_id ,
                            u.role_id,
                            u.first_name,
                            u.last_name,
                            u.package_id,
                            u.email,
                            u.image,
                            w.selected_theme,
                            w.logo,
                            w.whitelabel_id,
                            u.promotion_code
                FROM users u 
                LEFT JOIN whitelabel w
                ON      w.promotion_code = u.promotion_code                
                WHERE   u.$sLoginKey = '$sLoginValue' 
                AND     u.$sLoginSecret = '$sSecretValue' 
                AND     u.is_active = 1

                LIMIT 1
SQL;

            if ($Result = $this->db->query($SQL))
            {
                return $Result->row_array();
            }
        }
        return array();
    }


public function deleteUserById($aUserInfo = array()) {

    $sAddresses =   "'$aUserInfo->address_mailing','$aUserInfo->address_billing'";
    $iUserId    =   $aUserInfo->user_id;
    
    $sql = <<<QUERY
		
		DELETE FROM addresses
                WHERE address_id IN ($sAddresses)
QUERY;
    
    
        if ($this->db->query($sql)) {
            $sql = <<<QUERY
		
		 DELETE FROM users 		
		 WHERE user_id = '$iUserId'
QUERY;
            return $this->db->query($sql);
        }
    
       return false;
    }
  

    public function getAllUsers($aParams) { //-->, $RoleId = 0, $iLimit = 0,$ReturnCount = FALSE,$Offset = 0,$Search = false
        $recordsPerPage = LISTING_PER_PAGE;
        //$roleId = $aParams['roleId'];

        $offset = -1;
        $returnCount = false;

        if (isset($aParams[ACTION_RECORD_COUNT])) {
            $returnCount = $aParams[ACTION_RECORD_COUNT];
        }

        if (isset($aParams[ACTION_PAGE_OFFSET])) {
            $offset = $aParams[ACTION_PAGE_OFFSET];
        }

        $searchQuery = '';
//        if (isset($aParams[ACTION_FILTER])) {
//            if (isset($aParams[ACTION_FILTER][ACTION_FILTER_QUERY])) {
//                $searchQuery = $aParams[ACTION_FILTER][ACTION_FILTER_QUERY];
//            }
//        }

        $aWhereClause = array();

        // Role!
//        if ($roleId) {
//            $aWhereClause[] = " ( role_id = '" . $roleId . "' ) ";
//        }
        // Gender!

        if (isset($aParams['gender']) && $aParams['gender']) {

            $aWhereClause[] = " ( gender = '" . $aParams['gender'] . "' ) ";
        }


        // Search Query!
        if ($searchQuery) {
            $aWhereClause[] = " ( u.user_id='$searchQuery' OR u.first_name LIKE '%$searchQuery%' OR u.last_name LIKE '%$searchQuery%' OR u.email LIKE '%$searchQuery%' ) ";
        }

        $sWhereCondition = '';
        if (is_array($aWhereClause) && count($aWhereClause) > 0) {
            $sWhereCondition = ' WHERE ' . implode(' AND ', $aWhereClause);
        }

        $sSelect = '';
        $sLimit = '';
        $sOrderBy = '';
        
        if ($returnCount) {
            $sSelect = ' COUNT(u.user_id) AS count ';
            
        } else {
            $sSelect = 'u.user_id,u.role_id,u.first_name,u.last_name,u.email,u.gender,u.is_active';
            /* $sSelect = 'u.user_id,u.role_id,u.package_id,u.first_name,u.last_name,u.email,u.is_active,u.gender,
                        mailing.address as "mailing_address" ,mailing.country as "mailing_country",
                        mailing.state as "mailing_state" ,mailing.city as "mailing_city",
                        mailing.zip_code as "mailing_zip",
                        billing.address as "billing_address" ,billing.country as "billing_country",
                        billing.state as "billing_state",billing.city as "billing_city",
                        billing.zip_code as "billing_zip" ';
            $sFrom   = 'users u INNER JOIN addresses mailing ON mailing.address_id = u.address_mailing
                                INNER JOIN addresses billing ON billing.address_id = u.address_billing';*/

            if ($offset > -1) {
                $sLimit = " LIMIT $offset, $recordsPerPage ";
            }

            $sOrderBy = ' ORDER BY u.user_id DESC ';
        }

        $sql = <<<QUERY
		
		 SELECT 
				$sSelect 
		 FROM 
				users u 		
		 
		 $sWhereCondition 
		 
		 $sOrderBy
		 
		 $sLimit 
		
QUERY;


        if ($result = $this->db->query($sql)) {
            if ($returnCount) {
                return $result->row('count');
            } else {
                return $result->result();
            }
        }
		

        /*         * *
          $aRow   = array();
          $SQL = $Where  = $Limit = '';

          if($RoleId)         {   $Where = " WHERE role_id = '". $RoleId ."' "; }
          if($iLimit)         {   $Limit = " LIMIT $Offset,$iLimit "; }

          if($ReturnCount)    {   $SQL = "  SELECT count(*) as count FROM users $Where "; }
          else                {   $SQL = " SELECT user_id ,first_name,last_name,email FROM users $Where  ORDER BY user_id DESC $Limit ";}

          if($Search && $ReturnCount)
          {
          $SQL = <<<COUNT

          SELECT count(*) as count FROM users
          WHERE
          role_id = "$RoleId"
          AND
          (first_name like '%$SearchQuery%'
          OR  last_name like '%$SearchQuery%'
          OR  email like '%$SearchQuery%')
          COUNT;
          }
          else if($Search && !$ReturnCount)
          {
          $SQL = <<<SEARCH

          SELECT user_id ,first_name,last_name,email FROM users
          WHERE
          role_id = "$RoleId"
          AND
          (first_name like '%$SearchQuery%'
          OR  last_name like '%$SearchQuery%'
          OR  email like '%$SearchQuery%')
          $Limit
          SEARCH;
          }


          echo $SQL.'<br />';
          if( $Result  = $this->db->query($SQL))
          {
          if($ReturnCount)    return $Result->row('count');
          else                return $Result->result();
          }** */
    }

    /*
     * Get User For Edit
     */

	
	
	
    public function getUserForEdit($sType = '', $aData = array()) {
        if ($aData) {
            $sKey = $aData['key'];
            $sValue = $aData['value'];

            $SQL = <<<SQL
                SELECT user_id ,first_name,last_name,email FROM users WHERE $sKey = '$sValue' LIMIT 1
SQL;
            if ($Result = $this->db->query($SQL)) {
                $aRow = $Result->row();

                if ($aRow) {
                    return $aRow;
                }
            }
        }
        return array();
    }

    /*
     * Get User For Edit
     */

	


	public function getUserById($iUserId) {
        $SQL = <<<SQL
                SELECT  user_id,role_id, package_id,  account_type,  first_name,  last_name,  email,  password,  promotion_code,  address_mailing,  address_billing, image, gender
                FROM users 
                WHERE user_id = '$iUserId' 
                LIMIT 1 
SQL;
        if ($Result = $this->db->query($SQL)) {
            $aRow = $Result->row();

            if ($aRow) {
                return $aRow;
            }
        }

        return array();
    }
	
	
	
	public function getUserDataByLoginId($iUserId) 
	{
		if($iUserId)
		{
			 $SQL = <<<SQL
                SELECT u.user_id, u.role_id,CONCAT(u.first_name,' ',u.last_name)AS username, 
				 t.image_name AS image, u.email, u.description, u.gender, u.is_active
				 FROM users u , media m , thumbmails t
				 WHERE u.user_id = m.object_id
				 AND m.media_id = t.media_id
				 AND t.thumb_size = 'small' 
				 AND u.user_id = '$iUserId' 
                 LIMIT 1 
SQL;
			 
		
			if ($Result = $this->db->query($SQL)) 
			{
				$aRow = $Result->row();
			   if ($aRow) 
				{
					return $aRow;
				}
			}
		}
		 return array();
    }

    public function getUserByIdIN($iUsers) {

        $Id = implode(',', $iUsers);
        $myResultArray = array();
        $SQL = <<<SQL
                SELECT user_id, first_name, last_name, email, lang, gender, is_active 
                FROM users 
                WHERE user_id IN ($Id) 
SQL;
        if ($Result = $this->db->query($SQL)) {
            return $Result->result();
        }
    }

    public function deleteTrainer($aData = array()) {
        $iUserId = 0;
        if (isset($aData['iUserId'])) {
            $iUserId = $aData['iUserId'];
        }

        $sql = <<<QUERY
		
		 DELETE FROM users 		
		 WHERE user_id = '$iUserId'
QUERY;

        if ($this->db->query($sql)) {
            $sql = <<<QUERY
		
		 DELETE FROM course_info 		
		 WHERE trainer_id = '$iUserId'
QUERY;

            return $this->db->query($sql);
        }
    }

    public function deleteVolunteer($aData = array()) {
        $iUserId = 0;
        #$Availability = array();


        if (isset($aData['iUserId'])) {
            $iUserId = $aData['iUserId'];
        }
        $sql = <<<QUERY
		
		 DELETE FROM users 		
		 WHERE user_id = '$iUserId'
QUERY;
        return $this->db->query($sql);
//			if ($this->db->query($sql)) {
//				$Availability = $this->getVolunteerAvailability($iUserId);
//				$USER_AVAILABLILITY_ID = CALL_FROM_ADD_AVAILABILITY;
//				foreach ($Availability as $key => $value) {
//					$sql = <<<QUERY
//					DELETE FROM calendar
//					WHERE object_id = '$value->user_availability_id'
//					AND object_type = '$USER_AVAILABLILITY_ID'
//QUERY;
//				}
//				if ($this->db->query($sql)) {
//					$sql = <<<QUERY
//						DELETE FROM  user_availability
//						WHERE user_id = '$iUserId'
//QUERY;
//					return $this->db->query($sql);
//				}
//			}
    }

    public function deleteTrainee($aData = array()) {
        $iUserId = 0;
        if (isset($aData['iUserId'])) {
            $iUserId = $aData['iUserId'];
        }
        $sql = <<<QUERY
		
		 DELETE FROM users 		
		 WHERE user_id = '$iUserId'
QUERY;
        if ($this->db->query($sql)) {
            $sql = <<<QUERY
		
		 DELETE FROM course_info 		
		 WHERE trainer_id = '$iUserId'
QUERY;

            return $this->db->query($sql);
        }
    }

    public function deleteCompanyRep($aData = array()) {
        $iUserId = 0;
        if (isset($aData['iUserId'])) {
            $iUserId = $aData['iUserId'];
        }
        $sql = <<<QUERY
		
		 DELETE FROM users 		
		 WHERE user_id = '$iUserId'
QUERY;
        if ($this->db->query($sql)) {
            $sql = <<<QUERY
		
		 DELETE FROM course_info 		
		 WHERE trainer_id = '$iUserId'
QUERY;
            return $this->db->query($sql);
        }
    }

    public function deleteEntrepreneur($aData = array()) {
        $iUserId = 0;
        if (isset($aData['iUserId'])) {
            $iUserId = $aData['iUserId'];
        }
        $sql = <<<QUERY
		
		 DELETE FROM users 		
		 WHERE user_id = '$iUserId'
QUERY;
        if ($this->db->query($sql)) {
            $sql = <<<QUERY
		
		 DELETE FROM course_info 		
		 WHERE trainer_id = '$iUserId'
QUERY;
            return $this->db->query($sql);
        }
    }

    function addavailability($aData = array()) {
        if ($aData) {
            $DB_StartTime = $aData['DB_StartTime'];
            $DB_EndTime = $aData['DB_EndTime'];
            $iUserId = $aData['iUserId'];
            $sDays = $aData['days'];
            $iAdminId = getLoggedInUserId();

            if ($DB_StartTime and $DB_EndTime and $iUserId) {
                $sql = <<<QUERY

                INSERT INTO user_availability (user_id,start_time,end_time,availability_days,added_by)
                VALUES ('$iUserId','$DB_StartTime','$DB_EndTime','$sDays','$iAdminId')
QUERY;

                if ($this->db->query($sql)) {
                    if ($iAvailabilityId = $this->db->insert_id()) {
                        return $iAvailabilityId;
                    }
                }
            }
        }
        return false;
    }

    public function getUserFullNameById($iUserId = 0) {
        if ($iUserId) {
            $SQL = <<<SQL
                           SELECT
                                user_id,
                                first_name,
                                last_name
                              FROM users
                              WHERE user_id = $iUserId
SQL;
            if ($Result = $this->db->query($SQL)) {
                $aRow = $Result->row();

                if ($aRow) {
                    return (array) $aRow;
                }
            }
        }
        return array();
    }

    public function getVolunteersAvailability($aData = array(), $iUserId = 0) {
        if ($aData) {
            $SQL = '';

            $bReturnCount = false;

            if (isset($aData['recordsCount']) and $aData['recordsCount']) {
                $bReturnCount = true;
            }

            if ($bReturnCount) {
                $SQL = <<<SQL

                    select 	count(start_time) as preferred_time
                    from
                    user_availability
                    WHERE user_id = "$iUserId"
SQL;
            } else {
                $SQL = <<<SQL

                    select 	u.first_name,u.last_name, ua.user_availability_id, ua.user_id, ua.start_time,ua.end_time
                    from
                    user_availability ua,users u
                    WHERE ua.user_id = "$iUserId"
                    AND u.user_id = "$iUserId"
                    ORDER BY user_availability_id DESC

                    limit 0, 5000
SQL;
            }

            if ($Result = $this->db->query($SQL)) {
                if ($bReturnCount) {
                    return $Result->row('preferred_time');
                } else {
                    return $Result->result();
                }
            }
        }
        return array();
    }

    function CheckVolunteersAvailability($aData = array()) {
        $iUserId = $aData['data']['iUserId'];
        $DB_StartTime = $aData['data']['DB_StartTime'];
        $DB_EndTime = $aData['data']['DB_EndTime'];

        $SQL = <<<SQL

                    select 	count(user_availability_id) as preferred_time
                    from
                    user_availability
                    WHERE user_id = "$iUserId"
                    AND start_time = '$DB_StartTime'
                    AND end_time = '$DB_EndTime'

SQL;

        if ($Result = $this->db->query($SQL)) {
            return $Result->row('preferred_time');
        }

        return false;
    }

    public function deleteAvailabilityTimeSlot($aData = array()) {
        $iUserId = 0;
        $USER_AVAILABLILITY_ID = CALL_FROM_ADD_AVAILABILITY;
        if (isset($aData['availableTimeSlotId'])) {
            $iAvailableTimeSlotId = $aData['availableTimeSlotId'];
        }
        $sql = <<<QUERY
					DELETE FROM calendar
					WHERE object_id = '$iAvailableTimeSlotId'
					AND object_type = '$USER_AVAILABLILITY_ID'
QUERY;
        if ($this->db->query($sql)) {
            $sql = <<<QUERY
				DELETE FROM user_availability
				WHERE user_availability_id = '$iAvailableTimeSlotId'
QUERY;
        }
        return $this->db->query($sql);
    }

    /*
     *  Return All User Roles
     */

    function getAllUserRoles($IncludeAdmin = TRUE) {

        $Where = '';
        if (!$IncludeAdmin) {
            $Where = 'WHERE role_id > 1';
        }

        $SQL = <<<QUERY

            select 	role_id, en_title, ar_title
            from
            roles
            $Where
            ORDER BY role_id
QUERY;

        if ($Result = $this->db->query($SQL)) {
            return $Result->result();
        }
        return array();
    }

    function getVolunteerAvailability($iUserId = 0) {
        $SQL = <<<SQL

                    select ua.user_availability_id,ua.start_time,ua.end_time
                    from
                    user_availability ua
                    WHERE ua.user_id = "$iUserId"
                    ORDER BY user_availability_id DESC
SQL;

        if ($Result = $this->db->query($SQL)) {
            return $Result->result();
        }
        return array();
    }

    /* function ScheduleVolunteerInterview($aPostedData) {
      $SQL = <<<SQL

      select ua.start_time,ua.end_time
      from
      user_availability ua
      WHERE ua.user_id = "$iUserId"
      ORDER BY user_availability_id DESC
      SQL;
      } */

    /*
     * This function will save User Work Experience
     */

    /*private function _saveUserInfo($aData)
    {
        if (!empty($aData))
        {
            # Bulk INSERT
            $SQL = "
                    INSERT INTO user_info
                            (user_id, section, field_name, field_value)
                            VALUES " . $aData . ";
                ";
            return $this->db->query($SQL);
        }
        else
        {
            return false;
        }
    }*/

	
    function  SaveUserInfo($sCallFrom = '' , $aGivenData = array())
    {
        $sSection    = $DelSQL = '';
        $aData      = array();
		
        if($aGivenData) $aData      = $aGivenData['aData'];

        if(isset($aGivenData['section']) and $aGivenData['section'])
        {
            $sSection = $aGivenData['section'];
        }

        if($sSection and count($aData) > 0 )
        {
            $Fields = array();

            if($sSection == SECTION_BASIC)
            {
				
				
                # Extra Info
                $BasicInfo = array  (
										'middle_name',
										'dob_type',
                                        'dob_value',
                                        'hijridate',
                                        'nationality',
                                        'id_number',
                                        'marital_status',
                                        'employment_status',
                                        'employment_qualification',
                                        'city',
                                        'district',
                                        'mobile_number',
                                    );

                $Fields = $BasicInfo;
			}
            else if($sSection == SECTION_WORK_EXP)
            {
                # SECTION_WORK_EXP  Info
                $BasicInfo = array  (
                    'educational_status',
                    'edu',
                    'edu_name',
                    'edu_year',
                    'edu_degree',
                    'work_experience',
                    'experience_desc',
                    'experience_searching_job',

                    'employed_at',


                    'organization_name',
                    'date_of_establish',
                    'org_purpose',
                    'employed_at',
                    'employed_at',
                    'employed_at',
                    'employed_at',

                );

                $Fields = $BasicInfo;
            }

            else if($sSection == SECTION_PDT)
            {
                # Extra Info
                $BasicInfo = array
                (
                    'prominent_course_session_name',
                    'prominent_course_session_date',
                    'prominent_course_session_location',
                    'experience_searching_job',
                );

                $Fields = $BasicInfo;
            }

            else if($sSection == SECTION_COMMUNITY)
            {
                # Extra Info
                $BasicInfo = array
                (
                    'social_problem',
                    'ever_volunteered_previously',
                );

                $Fields = $BasicInfo;
            }
            else if($sSection == SECTION_ABOUT)
            {
                # Extra Info
                $BasicInfo = array
                (
                    'hear_about',
                    'attended_programs_before',
                    'courses_interested',
                    'wish_to_see_offered',
                );

                $Fields = $BasicInfo;
            }
			else if($sSection == SECTION_GENERAL)
            {
                # Extra Info
                $BasicInfo = array
                (
                    'organization_name',
                    'purpose_organization',
                    'date_establishment',
                    'interior_design',
                    'organization_registered',
                    'headquarters_location',
                    'cities_operation',
                );

                $Fields = $BasicInfo;
            }
			else if($sSection == SECTION_ORGANIZATION)
            {
                # Extra Info
                $BasicInfo = array
                (
                    'info_org',
                );

                $Fields = $BasicInfo;
            }
			else if($sSection == SECTION_GLANCE)
            {
			   # Extra Info
                $BasicInfo = array
                (
                    'describe_your_organization',
                    'total_headcount',
                    'saudi_employees',
                    'women_employees',
                    'saudis_managerial_positions',
                    'women_managerial_positions',
                    
                );

                $Fields = $BasicInfo;
            }
			else if($sSection == SECTION_TRAINING)
            {
			   # Extra Info
                $BasicInfo = array
                (
                    'participants',
                );

                $Fields = $BasicInfo;
            }
			else if($sSection == SECTION_MARKETING)
            {
			   # Extra Info
                $BasicInfo = array
                (
                    'organization_website',
                    'facebook_page',
                    'twitter_account',
                    'instagram_account',
                );

                $Fields = $BasicInfo;
            }
			else if($sSection == SECTION_COMPANY_ABOUT)
            {
			   # Extra Info
                $BasicInfo = array
                (
                    'hear_about',
                    'interested',
                    'contact_person',
                    'position',
                    'email_address',
                    'phone_number',
                );

                $Fields = $BasicInfo;
            }
			

            $aValues    = array();
            $TotalData  = count($aData);
            $iUserID    = $aData['iUserid'];

            if($TotalData > 0 )
            {
				
				
                foreach ($aData as $FieldName => $Value)
                {
                   if(in_array($FieldName,$Fields))
                   {
                       # Avoid empty values to be inserted
                       $$Value = trim($Value);

                       if (!empty($Value) and ! is_array($Value))
                       {
                           #$aValues should be pass like (user_id, 'section', 'field_name', 'field_value')
                           $aValues[] = "('$iUserID','$sSection','$FieldName', '$Value')";
                       }
                   }
                }

                if($aValues)
                {
                    # Bulk INSERT
                    $SQL = "
                                INSERT INTO user_info
                                        (user_id, section, field_name, field_value)
                                        VALUES " . implode(',',$aValues) . ";
                            ";


                    if($aGivenData)
                    {
                        if(isset($aGivenData['isEditMode']) and $aGivenData['isEditMode'])
                        {
                            $DelSQL = " DELETE FROM  user_info WHERE section = '$sSection' and user_id='".getLoggedInUserId()."'";
                            $this->db->query($DelSQL);
                        }
                    }

                    return $this->db->query($SQL);
                }
            }
        }

        return false;
    }


    function getUserInfo($sCallFrom = '' , $aGivenData = array())
    {
        $iUserId    = $aGivenData['user_id'];
        $sSection   = $aGivenData['section'];

        $sSectionSql = '';
        if($sSection)
        {
            $sSectionSql = 'AND section="'.$sSection.'"';
        }

        $SQL = <<<SQL

                select 	id, user_id, section, field_name, field_value, other
                from
                user_info
                where user_id='$iUserId'
                $sSectionSql
SQL;


        if ($Result = $this->db->query($SQL))
        {
            return $Result->result_array();
        }
        return array();
    }
    
    
     function getFormsInfo($sCallFrom = '' , $aGivenData = array())
    {
        $iObjectId        = $aGivenData['object_id'];
        $sObjectType      = $aGivenData['object_type'];

        $SQL = <<<SQL

                select 	object_id, object_type,field_name, field_value,other_text
                from
                    forms_info
                where object_id=$iObjectId
                and   object_type='$sObjectType'
                
SQL;
		

        if ($Result = $this->db->query($SQL))
        {
            return $Result->result_array();
        }
        return array();
    }
	
	
	function getUserInfoByEmail($sEmail = '') 
	{
		if($sEmail)
		{ 
			$SQL = <<<SQL
			 SELECT user_id, role_id, first_name, last_name, email
			 FROM	users
			 WHERE	email  = '$sEmail'
SQL;
			if ($Result = $this->db->query($SQL)) 
			{
				   $aRow = $Result->row();

				   if ($aRow) 
				   {
					   return (array) $aRow;
				   }
			}
		}
       return array();
    }
	
	
	function ResetPassword($aData = array())
	{
		$iUserId = $aData['user_id'];
		$Md5Pssword = $aData['Md5Pssword'];
		
		
        if( isset($aData) )
        {
            $Sql = <<<QUERY
					UPDATE users
					SET   PASSWORD = '$Md5Pssword'
					WHERE user_id = '$iUserId';
QUERY;
        }

        if($Sql)
        {
            return  $this->db->query($Sql);
        }
        return false;
	}

    # Set Last Login Time
    public function updateLastLoginTime($aUser = array())
    {
        if($aUser)
        {
            $iUserId = $aUser['user_id'];
            $dDate              = date(DATE_FORMAT_MYSQL);
            $Sql = <<<QUERY

					UPDATE users
					SET   last_login    = '$dDate'
					WHERE user_id       = '$iUserId'
					LIMIT 1
QUERY;

            if($Sql)
            {
                return  $this->db->query($Sql);
            }
        }

        return false;
    }



    function saveForm($sCallFrom ='', $aData = array())
    {
        $aValues        = array();
 
		
		
        $iUserID        = $aData['iUserid'];
        $iObjectId      = $aData['iObjectId'];
        $sObjectType    = $aData['sObjectType'];
        $TotalData      = count($aData['aGivenData']);
		$object_type    = FORM_ADD_RECOMMENDATION;
	
		if($TotalData > 0 )
        {
            foreach ($aData['aGivenData'] as $FieldName => $Value)
            {
                # Avoid empty values to be inserted
                $$Value = trim($Value);

                if (!empty($Value))
                {
                    #$aValues should be pass like (user_id, '$iObjectId', '$sObjectType', '$sFieldName','$Value')
                    $aValues[] = "('$iUserID','$iObjectId','$sObjectType','$FieldName','$Value','')";
                }
            }

            if($aValues)
            {
                # Bulk INSERT
                $SQL = "
                                INSERT INTO forms_info
                                        (
                                             `user_id`,
                                             `object_id`,
                                             `object_type`,
                                             `field_name`,
                                             `field_value`,
                                             `other_text`
                                        )
                                        VALUES " . implode(',',$aValues) . ";
                            ";
  
                if($aData['bEditMode'])
                { 
                    if(isset($aData['bEditMode']) and $aData['bEditMode'])
                    {
               
						
							$DelSQL = "DELETE
									FROM forms_info
									WHERE object_id = '$iObjectId'
									AND  object_type = '$object_type'";
							
							$this->db->query($DelSQL);
						
							 
						
						 #$DelSQL = " DELETE FROM  user_info WHERE section = '$sSection' and user_id='".getLoggedInUserId()."'";
                         
                    }
                }
			
                return $this->db->query($SQL);
            }
        }
    }




    public function getUserForChangePassword($sType = '', $aData = array()) {
        if ($aData)
        {
            $sKey       = $aData['key'];
            $sValue     = $aData['value'];
            $iUserId    = $aData['user_id'];


            $SQL = <<<SQL
                SELECT user_id ,first_name,last_name,email FROM users WHERE $sKey = '$sValue' and user_id='$iUserId' LIMIT 1
SQL;
            if ($Result = $this->db->query($SQL))
            {
                $aRow = $Result->row();

                if ($aRow) {
                    return $aRow;
                }
            }
        }
        return array();
    }



    function UpdateBasicInfo($sCallFrom= '', $CoreBasicInfo = array())
    {
		
		$sQueryChangeImage = $sQueryChangePassword = '';
        if($CoreBasicInfo)
        {
            $sFirstName         = $CoreBasicInfo['first_name'];
            $sLastName          = $CoreBasicInfo['last_name'];
            $sGender            = $CoreBasicInfo['gender'];
           # $sPassword          = $CoreBasicInfo['password'];
            $iUserId            = getLoggedInUserId();

			if (isset($CoreBasicInfo['image'])) {
                    $sQueryChangeImage = " image  =  '" . $CoreBasicInfo['image'] . "', ";
                }
			 if (isset($CoreBasicInfo['password'])) {
                    $sQueryChangePassword = " password  =  '" . $CoreBasicInfo['password'] . "', ";
                }
			
			
            $Sql = <<<QUERY

					UPDATE
					            users
					SET
					            first_name          = '$sFirstName',
					            last_name           = '$sLastName',
								$sQueryChangeImage
								$sQueryChangePassword
								 gender              = '$sGender'

					WHERE
                                user_id = '$iUserId'
					LIMIT 1
QUERY;

			
            if($Sql)
            {
                return  $this->db->query($Sql);
            }
        }

        return false;
    }
	
	
	
	public function pending()
	{
		  $SQL = <<<SQL
               SELECT
				   user_id,
				   first_name,
				   last_name 
			  FROM users
			  WHERE is_active = '0'
SQL;
		   
        if ($Result = $this->db->query($SQL))
        {
            return $Result->result_array();
        }
        return array();
	}
	
	public  function ChangeUserStatus($aData =array())
	{	
		if($aData)
        {
			$UserIds = $aData['users'];
			
			if($UserIds)
			{
				 $Status              = USER_STATUS_ACTIVE;
				foreach ($UserIds as $key => $Userid) 
				{
					$Sql = <<<QUERY
					UPDATE  users
						SET is_active = '$Status'
						WHERE user_id = '$Userid';
QUERY;
					$this->db->query($Sql);
				}
				return true;
			}
			return false;
		}
        
	}

}
