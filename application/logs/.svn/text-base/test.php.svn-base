<?php

define('THUMBNAIL_IMAGE_MAX_WIDTH', 1200);
define('THUMBNAIL_IMAGE_MAX_HEIGHT', 600);
define('UPLOADED_IMAGE_PATH', "./temp/resized_image/thumb_".time().".jpg" );
define('RESIZED_IMAGE_PATH', "./temp/original_image/original_".time().".jpg" );
define('FONT_PATH', './temp/arial.ttf' );



	function createJPEG($img_file_name,$font_path,$text)
	{
			// Create Image From Existing File
		  $jpg_image = imagecreatefromjpeg($img_file_name);

		  // Allocate A Color For The Text
		  $white = imagecolorallocate($jpg_image, 255, 255, 255);
		  $black = imagecolorallocate($jpg_image, 0, 0, 0);
                  
                  $desc_text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum";
                  $len = strlen($desc_text)/20 ;  
                 //drawing shape rectangle   
                 ImageFilledRectangle($jpg_image,450,250,750,550,$black);
				 imagettftext($jpg_image,20,0,500,350, $white,$font_path ,"Do u know why we cal january , January");
				 $counter_start = 0;
				 $index_y = 400;
				 for($a=0;$a < 10 ;$a++)
					 {
								imagettftext($jpg_image,10,0,400,$index_y,$white,$font_path ,substr($desc_text,$counter_start,$counter_start+20));
								$counter_start = $counter_start + 20;
								$index_y = $index_y +10 ;
								
					 }
				 
				 imagettftext($jpg_image,20,0,500,450, $white,$font_path ,"kaisa dia");
				 //imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text)

		  // Print Text On Image
		  imagettftext($jpg_image, 25, 0, 75, 300, $white, $font_path, $text['heading_1']);
		  imagettftext($jpg_image, 25, 0, 75, 350, $white, $font_path, $text['heading_2']);
		  imagettftext($jpg_image, 25, 0, 75, 400, $white, $font_path, $text['heading_3']);
                  imagettftext($jpg_image, 25, 0, 75, 450, $white, $font_path, $text['heading_4']);
                  
                  // Send Image to Browser
		  imagejpeg($jpg_image, NULL, 85);
			// capture output to string
			$contents = ob_get_contents();
			// end capture
			ob_end_clean();
		 
		  imagedestroy($jpg_image);
		  
			// lastly (for the example) we are writing the string to a file
			//$aa = "./temp/imge_file".time().".jpg";
			$fh = fopen(UPLOADED_IMAGE_PATH, "a+" );
			fwrite( $fh, $contents );
			fclose( $fh );
			
			return UPLOADED_IMAGE_PATH;
	
	}
	
	
function generate_resized_image($source_image_path, $thumbnail_image_path)
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
    
    $thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
    
    if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT)
        {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
        } 
   elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) 
       {
        $thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
        $thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
        }
   else 
       {
        $thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
        $thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
        }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}	
	
	if(isset($_FILES) && !empty($_FILES))
		{
                        
                        
			$arrText  = $_POST['heading'];
                        $uploaded_file_name_path = $_FILES['image']['tmp_name'];
                        
                        
			//RESIZED_IMAGE_PATH 
			
			generate_resized_image($uploaded_file_name_path, RESIZED_IMAGE_PATH);
			
                        //$img_file_name = $_FILES['image']['tmp_name'];
			
			
			$generated_preview_image = createJPEG(RESIZED_IMAGE_PATH,FONT_PATH,$arrText);
			
			echo "<img src='$generated_preview_image'> <br>";
			
			
			echo "<img src='".RESIZED_IMAGE_PATH."' >";
                        
			//get image sizes 
//                        $IMG_dimentions = getimagesize($_FILES['image']['tmp_name']);
//                        echo '<br> width = '.$IMG_dimentions[0]; 
//			echo '<br> height = '.$IMG_dimentions[1]; 
		
		}
		
		
		
		
		
  
  
  
?>
		
 
<form enctype="multipart/form-data" method="post" action="/xyz.php">
  File: <input type="file" name="image"><br><br>
  Text1: <input value="aaaaaa" type="text" name="heading[heading_1]"><br><br>
  Text2: <input value="bbbbbb" type="text" name="heading[heading_2]"><br><br>
  Text3: <input value="cccccc" type="text" name="heading[heading_3]"><br><br>
  Text4: <input value="dddddd" type="text" name="heading[heading_4]"><br><br>
  Dpi X  <input id="dpi_x" readonly type="text" name="dpi_x"><br><br>
  Dpi Y  <input id="dpi_y" readonly type="text" name="dpi_y"><br><br>
  <input type="submit" value="Submit">
  
</form>
<div style="height: 1in;left: -100%;position: absolute;top: -100%;width: 1in;" id="testdiv"></div>
<div id="dementionsDiv"></div>

<br>size in inches = size in pixels / dots per inch
<script>
window.onload = function ()
{
var dpi_x = document.getElementById('testdiv').offsetWidth;
var dpi_y = document.getElementById('testdiv').offsetHeight;
var width_in = screen.width / dpi_x;
var height_in = screen.height / dpi_y;
var diagonal_in = Math.round(10 * Math.sqrt(width_in * width_in + height_in * height_in)) / 10;

var dimentions = 'dpi_x = '+dpi_x+'<br>  dpi_y = '+dpi_y+'  '+' <br> width_in = '+width_in+' <br> height_in = '+height_in+' <br> diagonal_in = '+diagonal_in ;
document.getElementById('dementionsDiv').innerHTML  = dimentions;

document.getElementById('dpi_x').value  = dpi_x;
document.getElementById('dpi_y').value  = dpi_y;
}

</script>