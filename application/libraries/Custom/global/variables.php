<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// gLanguages
global $gLanguages;
$gLanguages = array();
$gLanguages[LANG_ENGLISH] = 'English';
$gLanguages[LANG_ARABIC]  = 'العربية';


global $gCourseResults;
$gCourseResults = array();
$gCourseResults['course_assesment']    = 'Assesment';
$gCourseResults['course_grading']      = 'Grading';


//gActive
global $gUserStatus;
$gUserStatus = array();
$gUserStatus[USER_STATUS_ACTIVE]      = 'Active';
$gUserStatus[USER_STATUS_NOT_ACTIVE]  = 'Not Active';




#gender
global $gGender;
$gGender = array();
$gGender[GENDER_MALE]      = 'Male';
$gGender[GENDER_FEMALE]    = 'Female';

global $gRoles;
$gRoles = array
(
    ROLE_ID_Administrator => ROLE_Administrator,
    ROLE_ID_Job_Seeker => ROLE_Job_Seeker,
    ROLE_ID_Interviewer => ROLE_Interviewer,
    ROLE_ID_Trainer => ROLE_Trainer,
    ROLE_ID_Community_Shaper => ROLE_Community_Shaper,
    ROLE_ID_Entrepreneur => ROLE_Entrepreneur,
    'All'               => 'All',
);
/*
//pagination config!
global $gPagination;
$gPagination['per_page']     = LISTING_PER_PAGE;

$gPagination['full_tag_open'] = '<ul class="pagination">';
$gPagination['full_tag_close'] = '</ul>';

$gPagination['num_tag_open'] = '<li>';
$gPagination['num_tag_close'] = '</li>';

$gPagination['first_link'] = 'First';
$gPagination['first_tag_open'] = '<li>';
$gPagination['first_tag_close'] = '</li>';

$gPagination['last_link'] = 'Last';
$gPagination['last_tag_open'] = '<li>';
$gPagination['last_tag_close'] = '</li>';

$gPagination['next_link'] = 'Next &raquo;';
$gPagination['next_tag_open'] = '<li>';
$gPagination['next_tag_close'] = '</li>';

$gPagination['prev_link'] = 'Prev &laquo;';
$gPagination['prev_tag_open'] = '<li>';
$gPagination['prev_tag_close'] = '</li>';

$gPagination['cur_tag_open'] = '<li class="active"><span>';
$gPagination['cur_tag_close'] = '</span></li>';*/


#Week Days
global $gDays;
$gDays = array();
$gDays['Sun']    = Day_Sun;
$gDays['Mon']    = Day_Mon;
$gDays['Tue']    = Day_Tue;
$gDays['Wed']    = Day_Wed;
$gDays['Thu']    = Day_Thu;
$gDays['Fri']    = Day_Fri;
$gDays['Sat']    = Day_Sat;


#Week Days
global $gAttendance;
$gAttendance = array();
$gAttendance[ATTENDANCE_STATUS_PRESENT] 				= 'Present';
$gAttendance[ATTENDANCE_STATUS_ABSENT_WITH_REASON] 		= 'Absent With Reason';
$gAttendance[ATTENDANCE_STATUS_ABSENT_WITHOUT_REASON] 	= 'Absent Without Reason';

#Course Request Status
global $gCourseRequestStatus;
$gCourseRequestStatus = array();
$gCourseRequestStatus[COURSE_REQUEST_STATUS_PENDING] 			 = 'Pending';
$gCourseRequestStatus[COURSE_REQUEST_STATUS_VOLUNTEER_ASSIGNED]  = 'Volunteer Assigned';
$gCourseRequestStatus[COURSE_REQUEST_STATUS_STUDENT_RESPONDED]   = 'Student Responded';
$gCourseRequestStatus[COURSE_REQUEST_STATUS_VOLUNTEER_ACCEPTED]   = 'Volunteer Accepted';
$gCourseRequestStatus[COURSE_REQUEST_STATUS_VOLUNTEER_REJECTED]   = 'Volunteer Rejected';


#Company Request Status
global $gCompanyRequestStatus;
$gCompanyRequestStatus = array();
$gCompanyRequestStatus[COMPANY_REQUEST_STATUS_PENDING] 			 = 'Pending';
$gCompanyRequestStatus[COMPANY_REQUEST_STATUS_ASSIGNED]  		 = 'Assigned';


#File Config
global $gFileUploadConfig;
$gFileUploadConfig = array();

$gFileUploadConfig[COURSE_MATERIAL] = array
(
        'upload_path'       =>  './media/course-material/',
        'thumb_path'        =>  'thumbnail',
        'encrypt_name'      =>  true,
        'allowed_types'     =>  'gif|jpg|png|bmp|txt|doc|docx|xls|xlsx|ppt|pptx|pdf|zip',
        'sizes'             =>  array   (
                                        COURSE_MATERIAL_THUMB_SMALL     => array('width'=>150, 'height'=>150),
                                        COURSE_MATERIAL_THUMB_MEDIUM    => array('width'=>300, 'height'=>300),
                                        COURSE_MATERIAL_THUMB_LARGE     => array('width'=>500, 'height'=>500),
                                    )
);

/*
 * This array for Room image
 */
global $gGalleryUploadConfig;
$gGalleryUploadConfig = array();

$gGalleryUploadConfig[ROOM_IMAGE_CONFIG] = array
(
    'upload_path'       =>  './media/facility-gallery/',
    'thumb_path'        =>  'thumbnail',
    'encrypt_name'      =>  true,
    'allowed_types'     =>  'gif|jpg|png|bmp',
    'sizes'             =>  array   (
                                        COURSE_MATERIAL_THUMB_SMALL     => array('width'=>150, 'height'=>150),
                                        COURSE_MATERIAL_THUMB_MEDIUM    => array('width'=>300, 'height'=>300),
                                        COURSE_MATERIAL_THUMB_LARGE     => array('width'=>500, 'height'=>500),
                                    )
);


/*
 * This array for Course image
 */
global $gCourseUploadConfig;
$gCourseUploadConfig = array();

$gCourseUploadConfig[COURSE_IMAGE_CONFIG] = array
(
    'upload_path'       =>  './media/course-gallery/',
    'thumb_path'        =>  'thumbnail',
    'encrypt_name'      =>  true,
    'allowed_types'     =>  'gif|jpg|png|bmp',
    'sizes'             =>  array   (
                                        COURSE_MATERIAL_THUMB_SMALL     => array('width'=>150, 'height'=>150),
                                        COURSE_MATERIAL_THUMB_MEDIUM    => array('width'=>300, 'height'=>300),
                                        COURSE_MATERIAL_THUMB_LARGE     => array('width'=>500, 'height'=>500),
                                    )
);


/*
 * This array for Course image
 */
global $gCourseResultConfig;
$gCourseResultConfig = array();

$gCourseResultConfig[COURSE_RESULT_CONFIG] = array
(
    'upload_path'       =>  './media/course-results/',
    'encrypt_name'      =>  true,
    'allowed_types'     =>  'doc|docx|pdf',
);


/*
 * This array for User image
 */
global $gUserResumeConfig;
$gUserResumeConfig = array();

$gUserResumeConfig[USER_RESUME_CONFIG] = array
(
    'upload_path'       =>  './media/user/resume/',
    'encrypt_name'      =>  true,
    'allowed_types'     =>  'doc|docx|pdf',
);



global $gUserImageConfig;
$gUserImageConfig = array();

$gUserImageConfig[USER_IMAGE_CONFIG] = array
(
    'upload_path'       =>  './media/user/image/',
    'thumb_path'        =>  'thumbnail',
    'encrypt_name'      =>  true,
    'allowed_types'     =>  'gif|jpg|png|bmp',
    'sizes'             =>  array   (
        COURSE_MATERIAL_THUMB_SMALL     => array('width'=>200, 'height'=>200),
        COURSE_MATERIAL_THUMB_MEDIUM    => array('width'=>450, 'height'=>450),
        COURSE_MATERIAL_THUMB_LARGE     => array('width'=>600, 'height'=>600),
        COURSE_MATERIAL_THUMB_PROFILE   => array('width'=>600, 'height'=>230),
    )
);

#Events/Announcements
global $gContent;
$gContent = array();
$gContent[CONTENT_EVENTS]        = 'Event';
$gContent[CONTENT_ANNOUNCEMENTS] = 'Announcement';


global $gStatus;
$gStatus = array();
$gStatus[CONTENT_ENABLE] = 'Enable';
$gStatus[CONTENT_DISABLE] = 'Disable';



#Week Days
global $gCustomField;
$gCustomField = array();
$gCustomField[NATIONALITY]	  =	'Nationality';
$gCustomField[CITY] 		  = 'City';
$gCustomField[DISTRICT] 	  = 'District';




