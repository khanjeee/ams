<?php
/*  @Author:Shoaib Ahmed Khan
 *  @Desc :Image genaration Api
 *  
 */

define('THUMBNAIL_IMAGE_MAX_WIDTH', 400);
define('THUMBNAIL_IMAGE_MAX_HEIGHT', 300);
define('GENERATED_IMAGE_MAX_WIDTH', 1800);
define('GENERATED_IMAGE_MAX_HEIGHT', 1325);
define('GENERATED_IMAGE_QUALITY', 85);
define('TEXTAREA_LINE_SPACING', 35);

define('GENERATED_IMAGE_PATH',"media/preview/gd_generated_image/generated_".time().rand(1,767868768).".jpg");

class ApiImageRendering {
	/*
	 * Initializing Class Variables
	 */
         
	public $data = array();
	public $result = array('status' => false, 'message' => MSG_INVALID_ATTEMPT);

	function __construct($Data = array()) 
        {
		$this->data = $Data;
	}

   
   
    public function createJPEG($aData)
    {

        
        $backGroundImage = '';
        $generatedImagePath = '';
        
        //sorting the array 
        ksort($aData);
        //debug($aData);
        foreach ($aData as $key=>$data)
        {
           //drawing background image
            if ($data['type'] == 'background_image')
            {

                $generatedImagePath   =   "media/preview/front/gd_image_".time().'_'.  rand(1,314323).'.jpg';
                $generatedImagePath   =    $this->generate_resized_image(
                                                                            site_url('media/fold_elements/'.$data['data']),
                                                                            $generatedImagePath,
                                                                            GENERATED_IMAGE_MAX_WIDTH,
                                                                            GENERATED_IMAGE_MAX_HEIGHT
                                                                        );
                $backGroundImage      = imagecreatefromjpeg($generatedImagePath);
            }
            
            //drawing shape
            else if ($data['type']== 'shape_rectangle')
            {

                $this->draw_shape($backGroundImage,$data['attr'],$data['type']);

            }

            //drawing thumbnail image
            else if ($data['type'] == 'image')
            {
                $generatedThumbPath   =   "media/preview/thumb/gd_image_".time().'_'.  rand(1,314323).'.jpg';
                $generatedThumbPath   =    $this->generate_resized_image(
                    site_url('media/fold_elements/'.$data['data']),
                    $generatedThumbPath,
                    THUMBNAIL_IMAGE_MAX_WIDTH,
                    THUMBNAIL_IMAGE_MAX_HEIGHT
                );

                $jpg_image_user  = imagecreatefromjpeg($generatedThumbPath);

                imagecopy(
                    $backGroundImage,
                    $jpg_image_user,
                    $data['attr']['dst_x'],
                    $data['attr']['dst_y'],
                    $data['attr']['src_x'],
                    $data['attr']['src_y'],
                    $data['attr']['src_w'],
                    $data['attr']['src_h']
                );

                imagedestroy($jpg_image_user);

            }
            
            //drawing text label
            else if ($data['type']== 'label')
            {
                
                $this->write_text_on_image($backGroundImage,$data['attr'],$data['data']);
            }
            
            //drawing text area label
            else if ($data['type']== 'description')
            {
                
                $index_y        = $data['attr']['y'];
                $desc_text      = $data['data'];
                $arr_desc_text  = explode("\n", $desc_text);
                foreach ($arr_desc_text as $key=>$dataTextArea)
                {
                    
                    $data['attr']['y'] = $index_y;
                    $this->write_text_on_image($backGroundImage,$data['attr'],$dataTextArea);
                    $index_y = $index_y + TEXTAREA_LINE_SPACING;
                }


            }
        }

        // Send Image to Browser
        imagejpeg($backGroundImage, $generatedImagePath, GENERATED_IMAGE_QUALITY);
        imagedestroy($backGroundImage);
        return $generatedImagePath;
    }

    public function draw_shape($image,$shapeAttributes,$shapeName)
    {

        //drawing rectangle
        if($shapeName == 'shape_rectangle')
        {
            ImageFilledRectangle(
                $image,
                $shapeAttributes['x1'],
                $shapeAttributes['y1'],
                $shapeAttributes['x2'],
                $shapeAttributes['y2'],
                $shapeAttributes['color']
            );
        }

        return;

    }
    
    public function generate_resized_image($source_image_path, $thumbnail_image_path,$width,$height) 
    {
        
        list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
        
        switch ($source_image_type)
        {
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
        
        if ($source_gd_image === false) 
            {
                return false;
            }
        $source_aspect_ratio = $source_image_width / $source_image_height;
        
        $thumbnail_aspect_ratio = $width / $height;

        if ($source_image_width <= $width && $source_image_height <= $height) 
              {
                $thumbnail_image_width = $source_image_width;
                $thumbnail_image_height = $source_image_height;
              } 
       elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) 
              {
                 $thumbnail_image_width = (int) ($height * $source_aspect_ratio);
                 $thumbnail_image_height = $height;
              } 
       else   {
                    $thumbnail_image_width = $width;
                    $thumbnail_image_height = (int) ($width / $source_aspect_ratio);
              }
        
        
        $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);

        imagecopyresampled(
                            $thumbnail_gd_image,
                            $source_gd_image, 
                            0,
                            0,
                            0,
                            0,
                            $thumbnail_image_width,
                            $thumbnail_image_height,
                            $source_image_width,
                            $source_image_height
                                );
        imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail_gd_image);
        return $thumbnail_image_path;
    }
    
    
    public function write_text_on_image($image,$arrAttributes,$text)
    {
        
        imagettftext(
                    $image,
                    $arrAttributes['size'],
                    $arrAttributes['angle'],
                    $arrAttributes['x'],
                    $arrAttributes['y'],
                    $arrAttributes['color'],
                    $arrAttributes['font'],
                    $text 
                );
        return;
        
    }

        
   

}