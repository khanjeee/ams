<?php

class ApiPayment {
	/*
	 * Initializing Class Variables
	 */

	public $data = array();

	private $CI ;
	function __construct($Data = array()) {
		$this->data = $Data;
		
		   $this->CI =& get_instance();
		   $this->CI->load->library('authorize_arb');
		   $this->CI->load->model('payment_model','payment');
		   $this->result = array('status' => false, 'BatchesSettled' => 0,'message'=>  MSG_SOMETHING_WENT_WRONG );
	}

	// Create Profile
	public function payment($sCallFrom = '',$aData = array()) {


			$sCardHolder		= $aData['aPostedData']['card_holder'];
			$dExpirationDate	= $aData['aPostedData']['year'] . '-' . $aData['aPostedData']['month'];
			$iCvc				= $aData['aPostedData']['cvc'];
			$iCardNumber		= $aData['aPostedData']['card_number'];
			$iAmount			= $aData[0]['total_printing_cost'];
			$iBatchId			= $aData[0]['campaign_batch_id'];
			$iUserId			= $aData[0]['user_id'];

			$firstnumber = substr($iCardNumber, 0, 1);

			switch ($firstnumber) {
				case 3:
					if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $iCardNumber)) {
						$this->result['message'] = 'This is not a valid American Express card number';
						
					}
					break;
				case 4:
					if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $iCardNumber)) {
						$this->result['message'] = 'This is not a valid Visa card number';
						
					}
					break;
				case 5:
					if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $iCardNumber)) {
						$this->result['message'] = 'This is not a valid MasterCard card number';
						
					}
					break;
				case 6:
					if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $iCardNumber)) {
						$this->result['message'] = 'This is not a valid Discover card number';
						
					}
					break;
				default:
					$this->result['message'] = 'This is not a valid credit card number';
					
			}

			$iCardNumber = str_replace('-', '', $iCardNumber);

			$map = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
				0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
			$sum = 0;
			$last = strlen($iCardNumber) - 1;

			for ($i = 0; $i <= $last; $i++) {
				$sum += $map[$iCardNumber[$last - $i] + ($i & 1) * 10];
			}
			if ($sum % 10 != 0) {
				$this->result['message'] = 'This is not a valid credit card number';
				
			}

			

			#echo '<h1>Creating Profile</h1>';

			$this->CI->authorize_arb->startData('create');
			$refId = substr(md5(microtime() . 'ref'), 0, 20);
			$this->CI->authorize_arb->addData('refId', $refId);

			$subscription_data = array(
				'name' => 'Campaign Batch Create',
				'paymentSchedule' => array(
					'interval' => array(
						'length' => 5,
						'unit' => 'months',
					),
					'startDate' => date('Y-m-d'),
					'totalOccurrences' => 9999,
					'trialOccurrences' => 0,
				),
				'amount' => $iAmount,
				'trialAmount' => 0.00,
				'payment' => array(
					'creditCard' => array(
						'cardNumber' => $iCardNumber,
						'expirationDate' => $dExpirationDate,
						'cardCode' => $iCvc,
					),
				),
				'order' => array(
					'invoiceNumber' => $iBatchId,
					'description' => '',
				),
				'customer' => array(
					'id' => $iUserId,
					'email' => '',
					'phoneNumber' => '',
				),
				'billTo' => array(
					'firstName' => $sCardHolder,
					'lastName' => $sCardHolder,
					'address' => '',
					'city' => '',
					'state' => '',
					'zip' => '',
					'country' => 'PK',
				),
			);

			$this->CI->authorize_arb->addData('subscription', $subscription_data);
			// Send request
			if ($this->CI->authorize_arb->send()) {
				
				$new_card = "XXXX-XXXX-XXXX-" . substr($iCardNumber,-4,4);
				
				$aData['aPostedData']['card_number'] =$new_card;
				$aData['aPostedData']['subscription_id'] = $this->CI->authorize_arb->getId();
				
				if($this->CI->payment->createPayment($aData))
				{
					$this->result['message']		= 'Payment Successfully done';
					$this->result['status']				= true;
				}
				
			
				
				#echo '<h1>Success! ID: ' . $this->authorize_arb->getId() . '</h1>';
			} else {
				$this->result['message']		= 'Invalid Data';
				$this->result['status']				= false;
				
			
			}
			// Show debug data
			return $this->result;
	}
}