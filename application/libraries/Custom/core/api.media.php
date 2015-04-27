<?php

class ApiMedia
{
    public $data        =   array();
    public $result      =   array('status' => false, 'message'=> 'Ooops..! Something went wrong.');

    function __construct($Data = array()) 
    {
        $this->data = $Data;
    }

    /*
     * Upload Media
     */
    public function UploadMedia($sAction = '', $aData  = array())
    {
        $aResult                    = array();
        $aResult['status']          = false;

        $CI =& get_instance();
        $CI->load->library('upload', $aData['configurations']);

        if( ! $CI->upload->do_upload(FILE_UPLOAD_FIELD))    $aResult['message']         = strip_tags($CI->upload->display_errors());

        else
        {
            $aResult['status']          = true;
            $aResult['UploadInfo']      = $CI->upload->data();

            if($aResult['UploadInfo']['is_image']) $this->SaveThumbnails($aData , $aResult);
        }

        return $aResult;
    }

    /*
     * Save Thumbmail if Photo
     */
    public function SaveThumbnails($aData = array(),$aResult = array())
    {
        if(isset($aResult['UploadInfo']) and $aResult['UploadInfo'])
        {
            $aThumbData = $aSizes = array();

            $CI =& get_instance();
            $CI->load->library('image_lib');

            $sThumbPath = '';
            if(isset($aData['configurations']['sizes']) and $aData['configurations']['sizes'])
            {
                $aSizes         = $aData['configurations']['sizes'];
                $sThumbPath     = $aData['configurations']['thumb_path'];
            }

            if($aSizes and $sThumbPath)
            {
                foreach($aSizes as $sThumbName => $aConfig)
                {
                    $aSize          =       $aConfig;
                    $aResizeConf    =       array   (
                                                        'source_image'  => $aResult['UploadInfo']['full_path'],
                                                        'new_image'     => $aResult['UploadInfo']['file_path'].$sThumbPath.'/'.$sThumbName.'_'.$aResult['UploadInfo']['file_name'],
                                                        'width'         => $aSize['width'],
                                                        'height'        => $aSize['height'],
                                                        'maintain_ratio'=> false,
                                                    );

                    $CI->image_lib->initialize($aResizeConf);

                    if($CI->image_lib->resize())
                    {
                        $aThumbData['thumb_size']       =   $sThumbName;
                        $aThumbData['image_width']      =   $CI->image_lib->width;
                        $aThumbData['image_height']     =   $CI->image_lib->height;
                        $aThumbData['image_name']       =   $CI->image_lib->dest_image;
                        $aThumbData['image_type']       =   $CI->image_lib->mime_type;

                        $CI->image_lib->clear();
                    }
                }
            }
        }
        return true;
    }

    /*
     * Delete Item From Media
     */
    public function DeleteItem($CallFrom = '', $iMediaId = 0)
    {
        $result = array('status' => FALSE,'message'=>'');

        if($iMediaId)
        {
            $CI =& get_instance();
            $CI->load->model('media');

            $iDeleted = $CI->media->delete($CallFrom, $iMediaId);

            if($iDeleted)
            {
                $result = array('status' => TRUE,'message'=>lang('ApiMedia_PhotoDeletedSuccessfully'));
            }
        }
        return $result;
    }
    public function deletegallery($CallFrom = '', $iRoomId = 0)
    {
        $result = array('status' => FALSE,'message'=>'');

		
        if($iRoomId)
        {
            $CI =& get_instance();
            $CI->load->model('media');

            $iDeleted = $CI->media->deletegallery($CallFrom, $iRoomId);

            if($iDeleted)
            {
                $result = array('status' => TRUE,'message'=>lang('ApiMedia_GalleryDeletedSuccessfully'));
            }
        }
        return $result;
    }
	
	function RemoveImage()
    {
         $aPostedData    = (array) $this->data['data'];
         $aErrorMessages = array();
		
		
		 $iMediaId = $aPostedData['iMediaId']; 
		 
		 if(!$iMediaId)
        {
            $aErrorMessages[] = lang('ApiMedia_ImageNotFound');
        }
        
		
        if($aErrorMessages)
        {
                $this->result['message'] = $aErrorMessages;
                return $this->result;
        }

        $CI =& get_instance();
        $CI->load->model('media');

        $bMediaImageDelete = $CI->media->delete(__FUNCTION__, $iMediaId);

        if($bMediaImageDelete)
        {
            $this->result['status']     =   true;
            $this->result['message']    =  lang('ApiMedia_ImageDeleteSuccessfully');
        }
     return $this->result;
    }
	
	function DeletePreviousData($CallFrom ='', $aData  = array())
    {
         $aErrorMessages = array();
		
		 $iMediaId = $aData['object_id']; 
		 
		 if(!$iMediaId)
        {
            $aErrorMessages[] = lang('ApiMedia_ImageNotFound');
        }
        
		
        if($aErrorMessages)
        {
                $this->result['message'] = $aErrorMessages;
                return $this->result;
        }
		
        $CI =& get_instance();
        $CI->load->model('media');

        $bMediaImageDelete = $CI->media->deleteMediaImage(__FUNCTION__, $iMediaId);

        if($bMediaImageDelete)
        {
            $this->result['status']     =   true;
            $this->result['message']    =  lang('ApiMedia_ImageDeleteSuccessfully');
        }
     return $this->result;
    }
	
	 public function UploadMediaImage($sAction = '', $aData  = array())
    {
        $aFileUploadConfig = array();
	
        if($sAction and $aData)
        {
            global $gFileUploadConfig;
            $aFileUploadConfig = $gFileUploadConfig;

             if($sAction == COMPANY_LOGO_CONFIG)
             {
                global $gCompanyLogoConfig;
                $aFileUploadConfig = $gCompanyLogoConfig;
             }
           
            $CI =& get_instance();
            $CI->load->model('media');

            $sMediaType         =   '';
            $aSizes             =   $aUploadData = array();
            $sMediaType         =   $aData['media_type'];

            if($sMediaType == MEDIA_TYPE_FILE or  $sMediaType == MEDIA_TYPE_IMAGE)
            {
                $CI->load->library('upload', $aFileUploadConfig[$aData['file_config']]);

                if( ! $CI->upload->do_upload($aData['file_field_name']))
                {
					#pr($CI->upload->display_errors());die;
                    return $CI->upload->display_errors();
                }
                else
                {
                    $aUploadData                = $CI->upload->data();
                    $aData['upload_info']       = $aUploadData;
                    $iMediaId                   = $CI->media->add($sAction,$aData);
                    $aUploadData['iMediaId']    = $iMediaId;
                    $aData['iMediaId']          = $iMediaId;
                    if($aUploadData['is_image']) // If Uploaded File is Image File
                    {
                        #Save Thumbnails
                        $aData['aFileUploadConfig'] = $aFileUploadConfig;
                        $this->SaveThumbnails($aData);
                    }
                }
            }
            else if($sMediaType == MEDIA_TYPE_LINK)
            {
                $iMediaId                   = $CI->media->add($sAction,$aData);
                $aUploadData['iMediaId']    = $iMediaId;
            }

            return $aUploadData;
        }

        return false;
    }
}