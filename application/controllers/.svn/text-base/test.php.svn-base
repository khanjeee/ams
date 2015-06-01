<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->controller = strtolower(__CLASS__);
        $this->load->helper('text');
        $this->load->model('predefined_batch_model', 'batch');
        $this->load->model('payment_model',         'payments');


        define('FONT_PATH',         './assets/fonts/arial.ttf');
    }

    function tester($iUserBatchId=0)
    {
        if($iUserBatchId)
        {
            $ApiPredefinedCampaigns = new ApiPredefinedCampaigns();
            var_dump($ApiPredefinedCampaigns->makeDeepCopy($iUserBatchId));
            exit;
        }
    }

    function make()
    {
       
        
            $data = array();
            $data[1][1]['data'] = "08a6a8c235fa85aba92e49a4d03a5e29.jpg";
            $data[1][1]['type'] = 'background_image';

            $data[1][2]['data'] = "rectangle";
            $data[1][2]['type'] = 'shape_rectangle';
            $data[1][2]['attr'] = array('x1' => 25,'y1' => 250,'x2' => 1325,'y2' => 500,'color' => 13421772);

            $data[1][3]['data'] = "08a6a8c235fa85aba92e49a4d03a5e29.jpg";
            $data[1][3]['type'] = 'image';
            $data[1][3]['attr'] = array('dst_x'=>1375 ,'dst_y'=>250 ,'src_x'=>0 ,'src_y'=>0 ,'src_w'=>150 ,'src_h'=>150);



            $data[1][4]['attr'] = array('size' => 10,'angle' => 0,'x' => 50,'y' => 350,'color' => 0,'font' => FONT_PATH);
            $data[1][4]['data'] = "
                        At w3schools.com you will learn how to
                        eebsite. We offer free tutorials in all web
                        development technologies.
                        At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
                        ";
            $data[1][4]['type'] = 'description';

            $data[1][5]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 475,'color' => 0,'font' => FONT_PATH);
            $data[1][5]['data'] = "text in third index";
            $data[1][5]['type'] = 'label';

            $data[1][6]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 500,'color' => 0,'font' => FONT_PATH);
            $data[1][6]['data'] = "text in third index";
            $data[1][6]['type'] = 'label';

            $data[1][7]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 525,'color' => 0,'font' => FONT_PATH);
            $data[1][7]['data'] = "text in third index";
            $data[1][7]['type'] = 'label';

            $data[1][8]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 550,'color' => 0,'font' => FONT_PATH);
            $data[1][8]['data'] = "text in third index";
            $data[1][8]['type'] = 'label';

            $data[1][9]['attr'] = array('size' => 40,'angle' => 0,'x' => 50,'y' => 300,'color' => 0,'font' => FONT_PATH);
            $data[1][9]['data'] = "thankyou";
            $data[1][9]['type'] = 'label';

            $data[1][10]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 450,'color' => 0,'font' => FONT_PATH);
            $data[1][10]['data'] = "text in third index";
            $data[1][10]['type'] = 'label';





            $data[2][1]['data'] = "08a6a8c235fa85aba92e49a4d03a5e29.jpg";
            $data[2][1]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 550,'color' => 0,'font' => FONT_PATH);
            $data[2][1]['type'] = 'background_image';

            $data[3][1]['data'] = "08a6a8c235fa85aba92e49a4d03a5e29.jpg";
            $data[3][1]['attr'] = array('size' => 15,'angle' => 0,'x' => 1375,'y' => 550,'color' => 0,'font' => FONT_PATH);
            $data[3][1]['type'] = 'background_image';

            $a = new ApiImageRendering();
            $imageArr = array();
            foreach ($data as $key=>$dt)
            {
                $imageArr[] = $a->createJPEG($dt);
                //debug($dt);
            }
            d($imageArr);


        $data = array
        (
            'x1'    => 25,
            'y1'    => 250,
            'x2'    => 1325,
            'y2'    => 550,
            'color' => 0,
            'font'  => FONT_PATH
        );
        print json_encode($data);;
        exit;

    $data = array();
    $data[1]['data']   =  "9382cd9ed48cf3c753af6dfa864d0239.jpg";
    //$data['thumb_image']        =  "http://localhost/ams/media/fold_elements/9382cd9ed48cf3c753af6dfa864d0239.jpg";
    
    
      //shape co-ordiantes
//       $data[1]['attr']= array(
//            'x1'    => 25,
//            'y1'    => 250,
//            'x2'    => 1325,
//            'y2'    => 500,
//            'color' => 13421772
//            
//        );  
    
        $data[2]['attr']= array(
                'size'    => 40,
                'angle'    => 0,
                'x'    => 50,
                'y'    => 300,
                'color' => 0,
                'font'  => FONT_PATH
            );
        $data[2]['data'] = "thankyou";
        
        $data[3]['attr']= array(
            'size'    => 10,
            'angle'    => 0,
            'x'    => 50,
            'y'    => 350,
            'color' => 0,
            'font'  => FONT_PATH
        );
        $data[3]['data'] = "At w3schools.com you will learn how to 
eebsite. We offer free tutorials in all web 
development technologies.
At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
";
        
        $data[4]['attr']= array(
            'size'    => 15,
            'angle'    => 0,
            'x'    => 1375,
            'y'    => 450,
            'color' => 0,
            'font'  => FONT_PATH
        );
        $data[4]['data'] = "text in third index";
        
        $data[5]['attr']= array(
            'size'    => 15,
            'angle'    => 0,
            'x'    => 1375,
            'y'    => 475,
            'color' => 0,
            'font'  => FONT_PATH
        );
        $data[5]['data'] = "text in third index";
        
        $data[6]['attr']= array(
            'size'    => 15,
            'angle'    => 0,
            'x'    => 1375,
            'y'    => 500,
            'color' => 0,
            'font'  => FONT_PATH
        );
        $data[6]['data'] = "text in third index";
        
        $data[7]['attr']= array(
            'size'    => 15,
            'angle'    => 0,
            'x'    => 1375,
            'y'    => 525,
            'color' => 0,
            'font'  => FONT_PATH
        );
        $data[7]['data'] = "text in third index";
       
        $data[8]['attr']= array(
            'size'    => 15,
            'angle'    => 0,
            'x'    => 1375,
            'y'    => 550,
            'color' => 0,
            'font'  => FONT_PATH
        );
        $data[8]['data'] = "text in third index";
        
        $a = new ApiImageRendering();
        
        $img = $a->generatePreivew($data);
        echo "<img src='$img'>";
        d($img);
        

    }

    public function create() {

        
        if (isset($_FILES) && !empty($_FILES)) {


            $arrText = $_POST['heading'];
            $uploaded_file_name_path = $_FILES['image']['tmp_name'];
            $uploaded_file_user_path = $_FILES['image_user']['tmp_name'];




            $this->generate_resized_image($uploaded_file_name_path, RESIZED_IMAGE_PATH,THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_HEIGHT);
            
            $this->generate_resized_image($uploaded_file_user_path, SMALL_IMAGE_PATH,200,200);
            
            
            $generated_preview_image = $this->createJPEG(RESIZED_IMAGE_PATH, FONT_PATH, $arrText,SMALL_IMAGE_PATH);
            

            echo "<img src='".site_url($generated_preview_image)."'> <br>";
            //echo "<img src='" .site_url(SMALL_IMAGE_PATH). "' >";

            //die;
        }

        $sFormAction = $this->controller . '/' . __FUNCTION__;
        $data['sFormAction'] = site_url($sFormAction);
        $this->load->view($this->controller . '/' . __FUNCTION__, $data);
        
    }

    public function createJPEG($img_file_name, $font_path, $text,$profile_image) {
        // Create Image From Existing File
        $jpg_image = imagecreatefromjpeg($img_file_name);
        $jpg_image_user = imagecreatefromjpeg($profile_image);
        
        //imagecopy($jpg_image, $jpg_image_user, 1325,550,1475,700, 150, 150);
        imagecopy($jpg_image, $jpg_image_user, 1375,250,0,0, 150, 150);
        imagedestroy($jpg_image_user);
        
        // Allocate A Color For The Text
        $white = imagecolorallocate($jpg_image, 255, 255, 255);
        $black = imagecolorallocate($jpg_image, 0, 0, 0);
        $grey = imagecolorallocate($jpg_image, 204, 204, 204);
        
        //ImageFilledRectangle($jpg_image, 25, 250, 1325, 550, $grey);
        
        imagettftext($jpg_image, 40, 0, 50, 300, $black, $font_path, "Thank You !");
        
        $index_y = 350;
        $desc_text = $text['text_area'];
        $arr_desc_text = explode("\n", $desc_text);
        
        foreach ($arr_desc_text as $key=>$data)
        {
           imagettftext($jpg_image, 10, 0, 50, $index_y, $black, $font_path, $data);
           $index_y = $index_y + 20; 
        }
        
        
        // Print Text On Image
        imagettftext($jpg_image, 15, 0, 1375, 450, $black, $font_path, $text['heading_1']);
        imagettftext($jpg_image, 15, 0, 1375, 475, $black, $font_path, $text['heading_2']);
        imagettftext($jpg_image, 15, 0, 1375, 500, $black, $font_path, $text['heading_3']);
        imagettftext($jpg_image, 15, 0, 1375, 525, $black, $font_path, $text['heading_4']);

        // Send Image to Browser
        imagejpeg($jpg_image, NULL, 85);
        // capture output to string
        $contents = ob_get_contents();
        // end capture
        ob_end_clean();
        
        //imagedestroy($jpg_image_user);
        imagedestroy($jpg_image);

        // lastly (for the example) we are writing the string to a file
        //$aa = "./temp/imge_file".time().".jpg";
        $fh = fopen(UPLOADED_IMAGE_PATH, "a+");
        fwrite($fh, $contents);
        fclose($fh);

        return UPLOADED_IMAGE_PATH;
    }

    public function generate_resized_image($source_image_path, $thumbnail_image_path,$width,$height) {
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        switch ($source_image_type) {
            case IMAGETYPE_GIF:
                $source_gd_image = imagecreatefromgif($source_image_path);
                break;
            case IMAGETYPE_JPEG:
                $source_gd_image = imagecreatefromjpeg($source_image_path);
                break;
            case IMAGETYPE_PNG:
                $source_gd_image = imagecreatefrompng($source_image_path);
                break;
        }
        if ($source_gd_image === false) {
            return false;
        }
        $source_aspect_ratio = $source_image_width / $source_image_height;
        
        $thumbnail_aspect_ratio = $width / $height;

        if ($source_image_width <= $width && $source_image_height <= $height) {
            $thumbnail_image_width = $source_image_width;
            $thumbnail_image_height = $source_image_height;
        } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
            $thumbnail_image_width = (int) ($height * $source_aspect_ratio);
            $thumbnail_image_height = $height;
        } else {
            $thumbnail_image_width = $width;
            $thumbnail_image_height = (int) ($width / $source_aspect_ratio);
            
            
        }
        
        
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);

        imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        return true;
    }


    /*function download()
    {
        $zipname = 'afile.zip';

        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        $zip->addFile('./media/fold_elements/485da9e5ce4967dfb6de1272003051fa.jpg','a.jpg');

        $zip->close();

    }*/
	
        function payment_info()
	{
	
         $sFormAction = $this->controller . '/' . __FUNCTION__ . '/';
        $data['sFormAction']	= site_url($sFormAction);  
        $aUserData = getLoggedInUserData();
        $ApiAuthorizeDotNet = new ApiAuthorizeDotNet();    
            

        if ($aPostedData = $this->input->post()) 
           {
            $aPostedData['first_name'] = $aUserData['first_name'];
            $aPostedData['last_name'] = $aUserData['last_name'];

            $aPaymentResult = $ApiAuthorizeDotNet->createCustomerPayment($aPostedData);
            if ($aPaymentResult['status']) 
                {
                    $aUserData['payment_id'] = $aPaymentResult['payment_id'];
                    if ($this->payments->savePaymentId($aUserData)) 
                        {
                        $aShippingResult = $ApiAuthorizeDotNet->createCustomerShipping($aPostedData);

                            if ($aShippingResult['status']) 
                                {
                                    $AuthorizeDotNetShippingId = $aShippingResult['address_id'];
                                    $aUserData['address_id'] = $AuthorizeDotNetShippingId;
                                    
                                    if ($this->payments->saveAddressId($aUserData)) 
                                        {
                                            d("card info successfully added {$AuthorizeDotNetShippingId}");
                                        }
                                }
                        }
                }

            //d($aResult['payment_id']);
        } 
           else 
            {
            
            
        
        $AuthorizeDotNetCustomerId  = $this->payments->getCustomerId($aUserData);
        
        if(empty($AuthorizeDotNetCustomerId))
        {

            $aResult  = $ApiAuthorizeDotNet->createCustomerProfile($aUserData);
            //if customer profile created
            if($aResult['status'])
                {
                  $AuthorizeDotNetCustomerId = $aResult['profile_id'];
                  $aUserData['profile_id'] =  $AuthorizeDotNetCustomerId;

                    $this->payments->saveCustomerId($aUserData);

                }
            else
                {
                    d($aResult);
                }
        }
        
        
            
          $data['profile_id'] = $AuthorizeDotNetCustomerId;
            
            }
            
        $this->layout->template(TEMPLATE_BASIC)->show($this->controller . '/' . __FUNCTION__, $data);
            
	}
        
        function test_payment()
        {
            
            $aData = array();
            $aData['amount'] = 10;
            $aData['profile_id'] = 35251102;
            $aData['payment_id'] = 32114527;
            $aData['address_id'] = 33424758;
            
            $ApiAuthorizeDotNet = new ApiAuthorizeDotNet();
            
          $aResult =  $ApiAuthorizeDotNet->createTransaction($aData);
          d($aResult);
         
            
            
        }
	function cal()
	{
		require_once 'Google/autoload.php';
	
		$client_id 			= 	'712814309277-7udv71qm713kvpqr7b2ck601nrljg1ss.apps.googleusercontent.com';
		$Email_address 		= 	'712814309277-7udv71qm713kvpqr7b2ck601nrljg1ss@developer.gserviceaccount.com';	 
		$key_file_location 	= 	'Google/api_certificate/prj-calendar-93797d09a2ec.p12';	 	
		$client 			= 	new Google_Client();	

		$client->setApplicationName("AMS");

		$key = file_get_contents($key_file_location);	 

		// separate additional scopes with a comma	 
		$scopes ="https://www.googleapis.com/auth/calendar";
		$cred = new Google_Auth_AssertionCredentials(	 
		$Email_address,	 	 
		array($scopes),	 	
		$key	 	 
		);	 	
		$client->setAssertionCredentials($cred);
		if($client->getAuth()->isAccessTokenExpired()) {	 	
		$client->getAuth()->refreshTokenWithAssertion($cred);	 	
		}	 	

		$service = new Google_Service_Calendar($client);
		$event = new Google_Service_Calendar_Event();
		$event->setSummary('Event  '.rand(1,100));
		$event->setLocation('Location '.rand(1,100));
		$start = new Google_Service_Calendar_EventDateTime();
		$start->setDateTime('2015-05-26T10:00:00.000-07:00');
		$event->setStart($start);
		$end = new Google_Service_Calendar_EventDateTime();
		$end->setDateTime('2015-05-26T10:25:00.000-07:00');
		$event->setEnd($end);
		$attendee1 = new Google_Service_Calendar_EventAttendee();
		$attendee1->setEmail('ephluxqa87@gmail.com');
		// ...
		$attendees = array($attendee1,
		// ...
		);
		$event->attendees = $attendees;
        $event->sendNotifications = true;
		$createdEvent = $service->events->insert('i5h5pnibtujm7r5qd26b0fr16s@group.calendar.google.com', $event);
		debug($createdEvent);
		echo $createdEvent->getId();
	}

}
