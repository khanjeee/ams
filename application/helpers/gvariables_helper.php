<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

global $user;

global $gPackageStatus;
$gPackageStatus = array('Inactive','Active');

global $aUserStatus;
$aUserStatus = array('Inactive','Active');

global $aRoles;
$aRoles = array(
                ROLE_ID_ADMINISTRATOR   =>  ROLE_Administrator,
                ROLE_ID_SUBSCRIBER      =>  ROLE_Subscriber

                );

global $aContactImportConfig;
       $aContactImportConfig['upload_path']     = './media/import/';
       $aContactImportConfig['allowed_types']   = CONTACT_IMPORT_ALLOWED_EXTENSIONS;
       $aContactImportConfig['max_size']	    = CONTACT_IMPORT_MAX_FILE_SIZE;
       //$aContactImportConfig['max_width']       = '1024';
       //$aContactImportConfig['max_height']      = '768';


global $aBatchStatus;
$aBatchStatus = array
(
    BATCH_IS_IN_EDIT_MODE           =>  'In-Complete Batch',
    BATCH_READY_FOR_PRINTING        =>  'Ready For Printing',
    BATCH_DISPATCHED_TO_PRINTERS    =>  'Sent To Printers',
    BATCH_DISPATCHED_TO_CUSTOMERS    =>  'Dispatched For Printing',
);



/*
 * Author : Muhammad Hussain Muhammad Munaf Tabani Memon  
 * Date : 01/04/2015
 * Work For : AMS
 * Company Logo
 */

global $gCompanyLogoConfig;
 $gCompanyLogoConfig['upload_path']    = WHITELABEL_LOGO_UPLOAD_PATH;
 $gCompanyLogoConfig['allowed_types'] = ALLOWED_IMAGE_TYPES;
/*
 * Author : Muhammad Hussain Muhammad Munaf Tabani Memon  
 * Date : 13/04/2015
 * Work For : AMS
 * User Image
 */

global $gUserImageConfig;
 $gUserImageConfig['upload_path']    = USER_IMAGE_UPLOAD_PATH;
 $gUserImageConfig['allowed_types'] = ALLOWED_IMAGE_TYPES;

 
 global $gSolutionType;
 $gSolutionType[SOLUTION_TYPE_VALUE_A]    = SOLUTION_TYPE_A;
 $gSolutionType[SOLUTION_TYPE_VALUE_B]    = SOLUTION_TYPE_B;
 
 global $gCities;
 $gCities["New York"]     = "New York";
 $gCities["New Jersy"]    = "New Jersy";

 
 global $gStates;
$gStates = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);
 
 
global $gCountries;
$gCountries = array
(
//	"AF" => "Afghanistan",
//	"AL" => "Albania",
//	"DZ" => "Algeria",
//	"AS" => "American Samoa",
//	"AD" => "Andorra",
//	"AO" => "Angola",
//	"AI" => "Anguilla",
//	"AQ" => "Antarctica",
//	"AG" => "Antigua and Barbuda",
//	"AR" => "Argentina",
//	"AM" => "Armenia",
//	"AW" => "Aruba",
//	"AU" => "Australia",
//	"AT" => "Austria",
//	"AZ" => "Azerbaijan",
//	"BS" => "Bahamas",
//	"BH" => "Bahrain",
//	"BD" => "Bangladesh",
//	"BB" => "Barbados",
//	"BY" => "Belarus",
//	"BE" => "Belgium",
//	"BZ" => "Belize",
//	"BJ" => "Benin",
//	"BM" => "Bermuda",
//	"BT" => "Bhutan",
//	"BO" => "Bolivia",
//	"BA" => "Bosnia and Herzegovina",
//	"BW" => "Botswana",
//	"BV" => "Bouvet Island",
//	"BR" => "Brazil",
//	"BQ" => "British Antarctic Territory",
//	"IO" => "British Indian Ocean Territory",
//	"VG" => "British Virgin Islands",
//	"BN" => "Brunei",
//	"BG" => "Bulgaria",
//	"BF" => "Burkina Faso",
//	"BI" => "Burundi",
//	"KH" => "Cambodia",
//	"CM" => "Cameroon",
//	"CA" => "Canada",
//	"CT" => "Canton and Enderbury Islands",
//	"CV" => "Cape Verde",
//	"KY" => "Cayman Islands",
//	"CF" => "Central African Republic",
//	"TD" => "Chad",
//	"CL" => "Chile",
//	"CN" => "China",
//	"CX" => "Christmas Island",
//	"CC" => "Cocos [Keeling] Islands",
//	"CO" => "Colombia",
//	"KM" => "Comoros",
//	"CG" => "Congo - Brazzaville",
//	"CD" => "Congo - Kinshasa",
//	"CK" => "Cook Islands",
//	"CR" => "Costa Rica",
//	"HR" => "Croatia",
//	"CU" => "Cuba",
//	"CY" => "Cyprus",
//	"CZ" => "Czech Republic",
//	"CI" => "Côte d’Ivoire",
//	"DK" => "Denmark",
//	"DJ" => "Djibouti",
//	"DM" => "Dominica",
//	"DO" => "Dominican Republic",
//	"NQ" => "Dronning Maud Land",
//	"DD" => "East Germany",
//	"EC" => "Ecuador",
//	"EG" => "Egypt",
//	"SV" => "El Salvador",
//	"GQ" => "Equatorial Guinea",
//	"ER" => "Eritrea",
//	"EE" => "Estonia",
//	"ET" => "Ethiopia",
//	"FK" => "Falkland Islands",
//	"FO" => "Faroe Islands",
//	"FJ" => "Fiji",
//	"FI" => "Finland",
//	"FR" => "France",
//	"GF" => "French Guiana",
//	"PF" => "French Polynesia",
//	"TF" => "French Southern Territories",
//	"FQ" => "French Southern and Antarctic Territories",
//	"GA" => "Gabon",
//	"GM" => "Gambia",
//	"GE" => "Georgia",
//	"DE" => "Germany",
//	"GH" => "Ghana",
//	"GI" => "Gibraltar",
//	"GR" => "Greece",
//	"GL" => "Greenland",
//	"GD" => "Grenada",
//	"GP" => "Guadeloupe",
//	"GU" => "Guam",
//	"GT" => "Guatemala",
//	"GG" => "Guernsey",
//	"GN" => "Guinea",
//	"GW" => "Guinea-Bissau",
//	"GY" => "Guyana",
//	"HT" => "Haiti",
//	"HM" => "Heard Island and McDonald Islands",
//	"HN" => "Honduras",
//	"HK" => "Hong Kong SAR China",
//	"HU" => "Hungary",
//	"IS" => "Iceland",
//	"IN" => "India",
//	"ID" => "Indonesia",
//	"IR" => "Iran",
//	"IQ" => "Iraq",
//	"IE" => "Ireland",
//	"IM" => "Isle of Man",
//	"IL" => "Israel",
//	"IT" => "Italy",
//	"JM" => "Jamaica",
//	"JP" => "Japan",
//	"JE" => "Jersey",
//	"JT" => "Johnston Island",
//	"JO" => "Jordan",
//	"KZ" => "Kazakhstan",
//	"KE" => "Kenya",
//	"KI" => "Kiribati",
//	"KW" => "Kuwait",
//	"KG" => "Kyrgyzstan",
//	"LA" => "Laos",
//	"LV" => "Latvia",
//	"LB" => "Lebanon",
//	"LS" => "Lesotho",
//	"LR" => "Liberia",
//	"LY" => "Libya",
//	"LI" => "Liechtenstein",
//	"LT" => "Lithuania",
//	"LU" => "Luxembourg",
//	"MO" => "Macau SAR China",
//	"MK" => "Macedonia",
//	"MG" => "Madagascar",
//	"MW" => "Malawi",
//	"MY" => "Malaysia",
//	"MV" => "Maldives",
//	"ML" => "Mali",
//	"MT" => "Malta",
//	"MH" => "Marshall Islands",
//	"MQ" => "Martinique",
//	"MR" => "Mauritania",
//	"MU" => "Mauritius",
//	"YT" => "Mayotte",
//	"FX" => "Metropolitan France",
//	"MX" => "Mexico",
//	"FM" => "Micronesia",
//	"MI" => "Midway Islands",
//	"MD" => "Moldova",
//	"MC" => "Monaco",
//	"MN" => "Mongolia",
//	"ME" => "Montenegro",
//	"MS" => "Montserrat",
//	"MA" => "Morocco",
//	"MZ" => "Mozambique",
//	"MM" => "Myanmar [Burma]",
//	"NA" => "Namibia",
//	"NR" => "Nauru",
//	"NP" => "Nepal",
//	"NL" => "Netherlands",
//	"AN" => "Netherlands Antilles",
//	"NT" => "Neutral Zone",
//	"NC" => "New Caledonia",
//	"NZ" => "New Zealand",
//	"NI" => "Nicaragua",
//	"NE" => "Niger",
//	"NG" => "Nigeria",
//	"NU" => "Niue",
//	"NF" => "Norfolk Island",
//	"KP" => "North Korea",
//	"VD" => "North Vietnam",
//	"MP" => "Northern Mariana Islands",
//	"NO" => "Norway",
//	"OM" => "Oman",
//	"PC" => "Pacific Islands Trust Territory",
//	"PK" => "Pakistan",
//	"PW" => "Palau",
//	"PS" => "Palestinian Territories",
//	"PA" => "Panama",
//	"PZ" => "Panama Canal Zone",
//	"PG" => "Papua New Guinea",
//	"PY" => "Paraguay",
//	"YD" => "People's Democratic Republic of Yemen",
//	"PE" => "Peru",
//	"PH" => "Philippines",
//	"PN" => "Pitcairn Islands",
//	"PL" => "Poland",
//	"PT" => "Portugal",
//	"PR" => "Puerto Rico",
//	"QA" => "Qatar",
//	"RO" => "Romania",
//	"RU" => "Russia",
//	"RW" => "Rwanda",
//	"RE" => "Réunion",
//	"BL" => "Saint Barthélemy",
//	"SH" => "Saint Helena",
//	"KN" => "Saint Kitts and Nevis",
//	"LC" => "Saint Lucia",
//	"MF" => "Saint Martin",
//	"PM" => "Saint Pierre and Miquelon",
//	"VC" => "Saint Vincent and the Grenadines",
//	"WS" => "Samoa",
//	"SM" => "San Marino",
//	"SA" => "Saudi Arabia",
//	"SN" => "Senegal",
//	"RS" => "Serbia",
//	"CS" => "Serbia and Montenegro",
//	"SC" => "Seychelles",
//	"SL" => "Sierra Leone",
//	"SG" => "Singapore",
//	"SK" => "Slovakia",
//	"SI" => "Slovenia",
//	"SB" => "Solomon Islands",
//	"SO" => "Somalia",
//	"ZA" => "South Africa",
//	"GS" => "South Georgia and the South Sandwich Islands",
//	"KR" => "South Korea",
//	"ES" => "Spain",
//	"LK" => "Sri Lanka",
//	"SD" => "Sudan",
//	"SR" => "Suriname",
//	"SJ" => "Svalbard and Jan Mayen",
//	"SZ" => "Swaziland",
//	"SE" => "Sweden",
//	"CH" => "Switzerland",
//	"SY" => "Syria",
//	"ST" => "São Tomé and Príncipe",
//	"TW" => "Taiwan",
//	"TJ" => "Tajikistan",
//	"TZ" => "Tanzania",
//	"TH" => "Thailand",
//	"TL" => "Timor-Leste",
//	"TG" => "Togo",
//	"TK" => "Tokelau",
//	"TO" => "Tonga",
//	"TT" => "Trinidad and Tobago",
//	"TN" => "Tunisia",
//	"TR" => "Turkey",
//	"TM" => "Turkmenistan",
//	"TC" => "Turks and Caicos Islands",
//	"TV" => "Tuvalu",
//	"UM" => "U.S. Minor Outlying Islands",
//	"PU" => "U.S. Miscellaneous Pacific Islands",
//	"VI" => "U.S. Virgin Islands",
//	"UG" => "Uganda",
//	"UA" => "Ukraine",
//	"SU" => "Union of Soviet Socialist Republics",
//	"AE" => "United Arab Emirates",
//	"GB" => "United Kingdom",
	"US" => "United States",
//	"ZZ" => "Unknown or Invalid Region",
//	"UY" => "Uruguay",
//	"UZ" => "Uzbekistan",
//	"VU" => "Vanuatu",
//	"VA" => "Vatican City",
//	"VE" => "Venezuela",
//	"VN" => "Vietnam",
//	"WK" => "Wake Island",
//	"WF" => "Wallis and Futuna",
//	"EH" => "Western Sahara",
//	"YE" => "Yemen",
//	"ZM" => "Zambia",
//	"ZW" => "Zimbabwe",
//	"AX" => "Åland Islands",
);


 
#gender
global $gGender;
$gGender = array();
$gGender[GENDER_MALE]      = 'Male';
$gGender[GENDER_FEMALE]    = 'Female';


global $gFlag;
 $gFlag[FLAG_IMPORTANT]      = "Important";
 $gFlag[FLAG_VERY_IMPORTANT] = "Very Important";