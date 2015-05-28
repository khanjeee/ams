<?php

class ApiContact {
	# Initializing Class Variables

	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array()) {
		$this->data = $Data;
	}

	/*	 * ********************CONTACTS CRUD************************** */

	public function createContact($aData = array()) {

		$aPostedData = $aData;
		$isEditMode = $aData['isEditMode'];


		$CI = & get_instance();
		$CI->load->model('contact_model', 'contact');
		$CI->load->model('crm_model', 'crm');

		//$aDataToSave                = array('aData' => $aData,'isEditMode' => false);

		$iContactId = $CI->contact->createContact($aPostedData);

		if ($iContactId) {

			$aPostedData['isEditMode'] = $isEditMode;
			$aPostedData['contacts'] = $iContactId;


			if ($CI->contact->addContactInListByContactId($aPostedData) && $CI->crm->saveCrmUserMetaFields($aPostedData)) {

				$this->result['status'] = true;
				$this->result['message'] = ($isEditMode) ? MSG_SUCCESS_CONTACT_UPDATED : MSG_SUCCESS_CONTACT_ADDED;
			}
		}

		return $this->result;
	}

	public function addMembersToList($aData = array()) {

		$CI = & get_instance();
		$CI->load->model('contact_model', 'contact');

		if ($iTotalContactsAdded = $CI->contact->addMembersToList($aData)) {
			$this->result['status'] = true;
			$this->result['message'] = $iTotalContactsAdded . ' Contacts added successfully.';
		}

		return $this->result;
	}

	public function getAllUsers($aData = array()) {

		$aPostedData = $aData;

		$CI = & get_instance();
		$CI->load->model('user_model', 'users');

		return $CI->users->getAllUsers($aPostedData);
	}

	function setReminder($aData = array()) {

		$title = $aData['title'];
		$summary = $aData['summary'];
		$location = $aData['location'];
		$start_date = $aData['start_date'];
		$start_time = $aData['start_time'];
		$end_date = $aData['end_date'];
		$end_time = $aData['end_time'];
		$email = $aData['aUserData']['email'];

		$start_date = date("Y-m-d", strtotime($start_date));
		$start_time = date("H:i:s", strtotime($start_time));

		$end_date = date("Y-m-d", strtotime($end_date));
		$end_time = date("H:i:s", strtotime($end_time));


		$final_start_date = $start_date . 'T' . $start_time . '.000-07:00';
		$final_end_date = $end_date . 'T' . $end_time . '.000-07:00';


		/* debug($final_start_date);
		  debug($final_end_date);
		  d($aData); */

		require_once 'Google/autoload.php';

		$client_id = '712814309277-7udv71qm713kvpqr7b2ck601nrljg1ss.apps.googleusercontent.com';
		$Email_address = '712814309277-7udv71qm713kvpqr7b2ck601nrljg1ss@developer.gserviceaccount.com';
		$key_file_location = 'Google/api_certificate/prj-calendar-93797d09a2ec.p12';
		$client = new Google_Client();

		$client->setApplicationName("AMS");

		$key = file_get_contents($key_file_location);

		// separate additional scopes with a comma	 
		$scopes = "https://www.googleapis.com/auth/calendar";
		$cred = new Google_Auth_AssertionCredentials(
				$Email_address, array($scopes), $key
		);
		$client->setAssertionCredentials($cred);
		if ($client->getAuth()->isAccessTokenExpired()) {
			$client->getAuth()->refreshTokenWithAssertion($cred);
		}

		$service = new Google_Service_Calendar($client);
		$event = new Google_Service_Calendar_Event();
		$event->setSummary($summary);
		$event->setLocation($location);
		$start = new Google_Service_Calendar_EventDateTime();
		//$start->setDateTime('2015-05-26T10:00:00.000-07:00');
		$start->setDateTime($final_start_date);
		$event->setStart($start);
		$end = new Google_Service_Calendar_EventDateTime();
		//$end->setDateTime('2015-05-26T10:25:00.000-07:00');
		$end->setDateTime($final_end_date);
		$event->setEnd($end);
		$attendee1 = new Google_Service_Calendar_EventAttendee();
		$attendee1->setEmail($email);
		$attendees = array($attendee1);
		$event->attendees = $attendees;

		$createdEvent = $service->events->insert('i5h5pnibtujm7r5qd26b0fr16s@group.calendar.google.com', $event);
		//d($createdEvent);
		$eventId = $createdEvent->getId();
		if (!empty($eventId)) {
			return $createdEvent->getId();
		}
		return 0;
	}

	public function deleteContactById($iContactId = 0) {
		$CI = & get_instance();
		$CI->load->model('contact_model', 'contact');

		if ($CI->contact->deleteContactById($iContactId)) {
			$this->result['status'] = true;
			$this->result['message'] = CONTACT . ' ' . MSG_DELETE_SUCCESS;
		} else {
			$this->result['message'] = ERROR_DELETE_FAILURE;
		}



		return $this->result;
	}

	/*  @Description: Parses the excel file and returns 2 arrays one for dispalying contats and other for insertion 
	 *  @Author:Shoaib Ahmed Khan
	 *  @Params : file path which is to be parsed
	 */

	public function excelParser($filePath = '') {
		$CI = & get_instance();
		$CI->load->library('phpexcel');
		$CI->load->library('PHPExcel/iofactory');

		$aContacts = array();
		$aContactsTable = array();


		$objPHPExcel = new PHPExcel();
		$objReader = IOFactory::createReader(SUPPORTED_EXCEL_FORMATS);
		$objPHPExcel = $objReader->load($filePath);

		foreach ($objPHPExcel->getWorksheetIterator() as $sheetNo => $worksheet) {
			//dynamically gets the no columns in each sheet
			//$highestColumm = $worksheet->getHighestColumn();
			//$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumm);
			$no_of_columns_to_extract = 14;
			//echo 'Worksheet - ' , $worksheet->getTitle(). "<br/>";
			foreach ($worksheet->getRowIterator() as $row) {
				$rowArr = array();
				$rowNo = $row->getRowIndex();

				if ($rowNo > 1) { //escaping first row Titles 
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

					foreach ($cellIterator as $key => $cell) {
						//extracting limited columns
						if ($key < $no_of_columns_to_extract) {

							$cellValue = $cell->getCalculatedValue();
							$cellValue = (empty($cellValue)) ? '' : $cellValue;
							//creating array for displaying contacts of first sheet(first 4 rows only)
							if ($sheetNo == 0 && $rowNo <= 4) {
								$aContactsTable[$sheetNo][$rowNo][] = $cellValue;
							}
							//if (!is_null($cellValue)) 
							//{
							//appending '' at start of every index of array
							if (empty($rowArr[$rowNo])) {
								$rowArr[$rowNo] = '';
							}

							//appending ) to last index of array and setting string to main array
							if ($key == $no_of_columns_to_extract - 1) {
								$rowArr[$rowNo] .= "'$cellValue'";
								//add row to contacts array only if it contains a character.
								//addd only the rows containing data
								if (preg_match('/[a-zA-Z]|[0-9]/', $rowArr[$rowNo])) {
									$aContacts[] = $rowArr[$rowNo];
								}
							}

							//for evey other column except last
							else {
								if ($key == 10 and !empty($cellValue)) { // 10 is the dob column
									//adding 1 days because it was returns date with 1 less day
									$date = (int) PHPExcel_Shared_Date::ExcelToPHP($cellValue);
									$cellValue = date(DATE_ONLY_FORMAT_MYSQL, $date + 86400);
								}

								$rowArr[$rowNo] .= "'$cellValue',";
							}


							// }
						}
					}
				}
			}
		}

		$aData['aContacts'] = $aContacts;
		$aData['aContactsTable'] = $aContactsTable;
		//d($aData);
		return $aData;
	}

	public function import($callFrom = '', $aContacts = array()) {
		$CI = & get_instance();
		$CI->load->model('contact_model', 'contact');

		if ($CI->contact->importContacts($callFrom, $aContacts)) {
			$this->result['status'] = true;
			$this->result['message'] = MSG_SUCCESS_CONTACTS_IMPORTED;
		}

		return $this->result;
	}

	/*	 * ********************CONTACTS END************************** */



	/*	 * ********************LISTS START*************************** */

	function createList($aData = array()) {
		$CI = & get_instance();
		$CI->load->model('list_model', 'list');

		#$aLists = $CI->list->getMasterList();

		$iUserId = getLoggedInUserId();
		$sTitle = $aData['title'];
		$aLists = $CI->list->getLists($iUserId, $sTitle);

		$sMessage = ($aData['isEditMode']) ? MSG_SUCCESS_LIST_UPDATED : MSG_SUCCESS_LIST_ADDED;

		#if($aLists->is_master_list)
		# {	
		if ($aLists) {
			$this->result['status'] = FALSE;
			$this->result['message'] = ERROR_TITLE_LIST_ALREADY_EXISTS;
		} else {
			if ($CI->list->createList($aData)) {
				$this->result['status'] = true;
				$this->result['message'] = $sMessage;
			}
		}
		#  }



		return $this->result;
	}

	public function deleteListById($iListId = 0) {
		$CI = & get_instance();
		$CI->load->model('list_model', 'list');
		if ($CI->list->deleteListById($iListId)) {
			$this->result['status'] = true;
			$this->result['message'] = LIST_SINGULAR . ' ' . MSG_DELETE_SUCCESS;
		} else {
			$this->result['message'] = ERROR_DELETE_FAILURE;
		}
		return $this->result;
	}

	/*	 * ********************LISTS END***************************** */

	public function addContactToMilestone($aData = array()) {
		$CI = & get_instance();
		$CI->load->model('milestone_model', 'milestone');
		
		$aContact = $CI->milestone->getMilestoneContacts($aData['iContactId']);
		if (is_array($aData['milestone']) && !empty($aData['milestone'])) 
		{

			
			if ($aContact) 
			 {
				if ($CI->milestone->deleteMilestoneContactByContactId($aData['iContactId'])) 
				{
					if ($iTotalContactsAdded = $CI->milestone->addContactToMilestone($aData)) 
					{
						$this->result['status'] = true;
						$this->result['message'] = $iTotalContactsAdded . ' Contacts added successfully.';
					}
				}
			}
			else 
			{
				if ($iTotalContactsAdded = $CI->milestone->addContactToMilestone($aData)) 
				{
					$this->result['status'] = true;
					$this->result['message'] = $iTotalContactsAdded . ' Contacts added successfully.';
				}
			}
		}
		else
		{
			
			if($aContact)
			{
				
				if ($CI->milestone->deleteMilestoneContactByContactId($aData['iContactId'])) 
				{
					
						$this->result['status'] = false;
						$this->result['message'] = $iTotalContactsAdded . ' Contacts delete successfully.';
					
				}
			}else
			{
						$this->result['status'] = false;
						$this->result['message'] =  ' Please select milestone.';
			}
			
			
		}
		return $this->result;
	}

}