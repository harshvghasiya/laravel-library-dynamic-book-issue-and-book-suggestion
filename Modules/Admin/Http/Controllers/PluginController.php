<?php 
namespace Modules\Admin\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class PluginController extends Controller 
{
	/**
     * [__construct This function is used to create and initialzation class object]
     */
	public function uploadImageFile() 
	{ 
		// Note: GD library is required for this function
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			$iWidth 		= @$_POST['w'];
			$iHeight 		= @$_POST['h']; // desired image result dimensions
			$iJpgQuality 	= 90;
			$iPngQuality 	= 9;
			ini_set('memory_limit', '-1');

			
			$file_imagemodule 	= $_POST['file_imagemodule'];
			$file_imageurl 		= $_POST['file_imageurl'];
			$file_imagepath 	= $_POST['file_imagepath'];
			$file_imagedbname   = $_POST['file_imagedbname'];
			if (@@$_POST[$file_imagedbname.'_image']) 
			{
				$sTempFileName	=	$file_imagepath.$_POST[$file_imagedbname.'_image'];
				if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) 
				{
					$aSize 	= 	getimagesize($sTempFileName); // try to obtain image info
					if (!$aSize) 
					{
						@unlink($sTempFileName);
						return;
					}
					// check for image type
					switch($aSize[2]) 
					{
						case IMAGETYPE_JPEG:
							$sExt 	= '.jpg';

							// create a new image from file 
							$vImg 	= @imagecreatefromjpeg($sTempFileName);
						break;
						case IMAGETYPE_PNG:
							$sExt 	= '.png';

							// create a new image from file 
							$vImg 	= @imagecreatefrompng($sTempFileName);
						break;
						default:
							@unlink($sTempFileName);
							return;
					}

					// create a new true color image
					$vDstImg 			= 	@imagecreatetruecolor( $iWidth, $iHeight );
					imagealphablending( $vDstImg, false );
					imagesavealpha( $vDstImg, true );

					// copy and resize part of an image with resampling
					imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$_POST['x1'], (int)$_POST['y1'], $iWidth, $iHeight, (int)$_POST['w'], (int)$_POST['h']);

					// define a result image filename
					$sResultFileName 	= 	$sTempFileName.$sExt;

					// output image to file
					switch($aSize[2]) 
					{
						case IMAGETYPE_JPEG:
							imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
						break;
						case IMAGETYPE_PNG:
							imagepng($vDstImg, $sResultFileName, $iPngQuality);
						break;
					}
					$newImgName			=	"cropped_".$_POST[$file_imagedbname.'_image'];
					rename($sResultFileName,$file_imagepath.$newImgName);
					return $newImgName;
				}
			}
		}
	}
	/**
     * This function is upload cropped image file
     * @author Hirak
     * @reviewer
     */
	public function upload_cropped_image()
	{
		$sImage 	= 	$this->uploadImageFile();
		echo basename($sImage);

	}
	/**
     * This function is upload original image file
     * @author Hirak
     * @reviewer
     */
	public function uploadOrigionalImageFile() 
	{ 
		// Note: GD library is required for this function
		if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			ini_set('memory_limit', '-1');
			$file_imagemodule = $_POST['file_imagemodule'];
			$file_imageurl = $_POST['file_imageurl'];
			$file_imagepath = $_POST['file_imagepath'];
			$file_imagedbname   = $_POST['file_imagedbname'];
			if (@@$_FILES[$file_imagedbname.'_image']) 
			{
				$oldWidth = getimagesize($_FILES[$file_imagedbname.'_image']['tmp_name'])[0];
				$oldHeight = getimagesize($_FILES[$file_imagedbname.'_image']['tmp_name'])[1];
			}
			//IF GET MAX HEIGHT THAN SET IT
			if(isset($_POST['max_height']) && !empty($_POST['max_height']))
			{
				$max_height = $_POST['max_height'];
			}
			else
			{
				$max_height = $oldHeight;
			}
			//IF GET MAX HEIGHT THAN SET IT
			//IF GET MAX WIDTH THAN SET IT
			if(isset($_POST['max_width']) && !empty($_POST['max_width']))
			{
				$max_width = $_POST['max_width'];
			}
			else
			{
				$max_width = $oldWidth;
			}
			//IF GET MAX WIDTH THAN SET IT
			if (@@$_FILES[$file_imagedbname.'_image']) 
			{
				$imageFile = @@$_FILES[$file_imagedbname.'_image']['tmp_name'];
				$dataHW = $this->resizeTheImage($imageFile, $max_width, $max_height); //SAMIR COMMENTED - 04 OCT 2017
				//$dataHW = $this->resizeTheImage($imageFile, $oldWidth, $oldHeight);
				$iWidth = @$dataHW['width'];
				$iHeight = @$dataHW['height']; // desired image result dimensions
				$iJpgQuality = 90;
				$iPngQuality = 9;
				
				if (@@$_FILES[$file_imagedbname.'_image']) 
				{
					// if no errors and size less than 600kb
					if (!@@$_FILES[$file_imagedbname.'_image']['error']) {
						// echo 'hisfsdfds'; die;
						if (is_uploaded_file(@@$_FILES[$file_imagedbname.'_image']['tmp_name'])) {
							// new unique filename
							if(!file_exists($file_imagepath . $file_imagemodule))
							{
								mkdir($file_imagepath . $file_imagemodule,0755,true);
							}
							$sTempFileName = $file_imagepath . $file_imagemodule."_".md5(time() . rand());
							// move uploaded file into cache folder
							move_uploaded_file(@@$_FILES[$file_imagedbname.'_image']['tmp_name'], $sTempFileName);
							// change file permission to 644
							@chmod($sTempFileName, 0644);
							if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
								$aSize = getimagesize($sTempFileName); // try to obtain image info
								if (!$aSize) {
									echo "invalidFile";
									@unlink($sTempFileName);
									return;
								}
								if((filesize($sTempFileName)/(1024*1024))>5)
								{
									echo "largeSize";
									@unlink($sTempFileName);
									return;
								}
								if(isset($_POST['file_imageaspectcountmin']) && !empty($_POST['file_imageaspectcountmin']))
								{
									if(($aSize[0]/$aSize[1])<$_POST['file_imageaspectcountmin'])
									{
										echo "tallImage";
										@unlink($sTempFileName);
										return;
									}
								}
								if(isset($_POST['file_imageaspectcountmax']) && !empty($_POST['file_imageaspectcountmax']))
								{
									if(($aSize[0]/$aSize[1])>$_POST['file_imageaspectcountmax'])
									{
										echo "wideImage";
										@unlink($sTempFileName);
										return;
									}
								}
								// check for image type
								switch ($aSize[2]) {
									case IMAGETYPE_JPEG:
										$sExt = '.jpg';
										// create a new image from file 
										$vImg = @imagecreatefromjpeg($sTempFileName);
										break;
										
									case IMAGETYPE_PNG:
										$sExt = '.png';
										// create a new image from file 
										$vImg = @imagecreatefrompng($sTempFileName);
										break;
										
									default:
										echo "notJpgOrPng";
										@unlink($sTempFileName);
										return;
								}
								// create a new true color image
								$vDstImg = @imagecreatetruecolor($iWidth, $iHeight);
								imagealphablending( $vDstImg, false );
								imagesavealpha( $vDstImg, true );
								// copy and resize part of an image with resampling
								imagecopyresampled($vDstImg, $vImg, 0, 0, 0, 0, $iWidth, $iHeight, $oldWidth, $oldHeight);
								// define a result image filename
								$sResultFileName = $sTempFileName . $sExt;
								// output image to file
								switch($aSize[2]) 
								{
									case IMAGETYPE_JPEG:
										imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
									break;
									case IMAGETYPE_PNG:
										imagepng($vDstImg, $sResultFileName, $iPngQuality);
									break;
								}
								@unlink($sTempFileName);
								/*if (filesize($sResultFileName) > 600 * 1024) {
									echo "largeSize";
									exit;
								}*/
								return $sResultFileName;
							}
						}
					}
				}
			}
		}
	}
	/**
     * This function is used for resize image
     * @author Hirak
	 * @param $imageFile
	 * @param $maxWidth
	 * @param $maxHeight
     * @reviewer
     */
	public function resizeTheImage($imageFile, $maxWidth, $maxHeight) 
	{
		$data['width'] = getimagesize($imageFile)[0];
		$data['height'] = getimagesize($imageFile)[1];
		if ($data['width'] > $maxWidth && $data['height'] > $maxHeight) {
			if ($data['height'] > $data['width']) {
				$ratio = $data['height'] / $data['width'];
				$data['height'] = $maxHeight;
				$data['width'] = floor($data['height'] / $ratio);
				if ($data['width'] > $maxWidth) {
					$data['width'] = $maxWidth;
				}
			} else if ($data['height'] < $data['width']) {
				$ratio = $data['width'] / $data['height'];
				$data['width'] = $maxWidth;
				$data['height'] = floor($data['width'] / $ratio);
				if ($data['height'] > $maxHeight) {
					$data['height'] = $maxHeight;
				}
			} else {
				$data['height'] = $data['width'] = min($maxWidth, $maxHeight);
			}
		} else {
			if ($data['width'] > $maxWidth) {
				if ($data['height'] > $data['width']) {
					$ratio = $data['height'] / $data['width'];
					$data['height'] = $maxHeight;
					$data['width'] = floor($data['height'] / $ratio);
					if ($data['width'] > $maxWidth) {
						$data['width'] = $maxWidth;
					}
				} else if ($data['height'] < $data['width']) {
					$ratio = $data['width'] / $data['height'];
					$data['width'] = $maxWidth;
					$data['height'] = floor($data['width'] / $ratio);
					if ($data['height'] > $maxHeight) {
						$data['height'] = $maxHeight;
					}
				} else {
					$data['height'] = $data['width'] = min($maxWidth, $maxHeight);
				}
			} else if ($data['height'] > $maxHeight) {
				if ($data['height'] > $data['width']) {
					$ratio = $data['height'] / $data['width'];
					$data['height'] = $maxHeight;
					$data['width'] = floor($data['height'] / $ratio);
					if ($data['width'] > $maxWidth) {
						$data['width'] = $maxWidth;
					}
				} else if ($data['height'] < $data['width']) {
					$ratio = $data['width'] / $data['height'];
					$data['width'] = $maxWidth;
					$data['height'] = floor($data['width'] / $ratio);
					if ($data['height'] > $maxHeight) {
						$data['height'] = $maxHeight;
					}
				} else {
					$data['height'] = $data['width'] = min($maxWidth, $maxHeight);
				}
			}
		}
		return $data;
	}	
	/**
     * This function is used for upload image
     * @author Hirak
     * @reviewer
     */
	public function upload_image()
	{
		$sImage 	= 	$this->uploadOrigionalImageFile();
		echo basename($sImage);
	}
	/**
     * This function is used for delete image
     * @author Hirak
	 * @param $request
     * @reviewer
     */
    public function deleteUploadedImage(Request $request) 
	{
		$file_imagemodule = $request->input('file_imagemodule');
		$file_imageurl = $request->input('file_imageurl');
		$file_imagepath = $request->input('file_imagepath');
		$file_imagedbname = $request->input('file_imagedbname');
        $file_imagename = $request->input('file_imagename');
        if ($request->input('cropped') == "false") {
            if (file_exists($file_imagepath . $file_imagename) && !empty($file_imagename)) {
                unlink($file_imagepath . $file_imagename);
                echo "deleted";
            } else {
                echo "notDeleted";
            }
        } else {
            if (file_exists($file_imagepath . $file_imagename) && !empty($file_imagename)) {
                unlink($file_imagepath . $file_imagename);
                echo "deleted";
            } else {
                echo "notDeleted";
            }
        }
    }
	/**
     * This function is view display order
     * @author Hirak
	 * @param $request
     * @reviewer
     */
	public function viewAjaxDisplayOrder(Request $request)
	{
		$data = $request->all();
		viewDisplayOrder($data['module'],$data['table'],$data['displayOrderColumnName'],$data['primaryKeyName'],$data['primaryKeyValue'],$data['newDisplayOrder'],$data['oldDisplayOrder'],$data['statusImportant'],$data['statusColumnName'],$data['parentLevels'],$data['parentLevelsColumnName'],$data['newLevels'],$data['oldLevels']);
	}

	
   public function saveTinymceImage(Request $request){

        $url = array("http://localhost");

        reset($_FILES);
        $temp = current($_FILES);

        if ($temp) {

            $oldWidth  = getimagesize($temp['tmp_name'])[0];
            $oldHeight = getimagesize($temp['tmp_name'])[1];
        }
 
        $max_height = $oldHeight;
        $max_width = $oldWidth;

         if ($temp['tmp_name']) {
            $imageFile = $temp['tmp_name'];
            $dataHW    = $this->resizeTheImage($imageFile, $max_width, $max_height); //SAMIR COMMENTED - 04 OCT 2017
            //$dataHW = $this->resizeTheImage($imageFile, $oldWidth, $oldHeight);
            $iWidth      = @$dataHW['width'];
            $iHeight     = @$dataHW['height']; // desired image result dimensions
            $iJpgQuality = 60;
            $iPngQuality = 9;
            $iWebpQuality = 80;

            if ($temp['tmp_name']) {
                // if no errors and size less than 600kb
                if ($temp['tmp_name']) {
                    // echo 'hisfsdfds'; die;
                    if (is_uploaded_file($temp['tmp_name'])) {
                        // new unique filename
                        if (!file_exists(TINYMCE_IMAGE_UPLOAD_PATH())) {
                            mkdir(TINYMCE_IMAGE_UPLOAD_PATH(), 0755, true);
                        }
                        $fName = "post__" . md5(time() . rand());
                        $sTempFileName = TINYMCE_IMAGE_UPLOAD_PATH().$fName;
                        // move uploaded file into cache folder
                        move_uploaded_file($temp['tmp_name'], $sTempFileName);
                        // change file permission to 644
                        @chmod($sTempFileName, 0644);
                        
                        if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
                            $aSize = getimagesize($sTempFileName); // try to obtain image info
                           
                            // check for image type
                            switch ($aSize[2]) {
                                case IMAGETYPE_JPEG:
                                    $sExt = '.jpg';
                                    // create a new image from file
                                    $vImg = @imagecreatefromjpeg($sTempFileName);
                                    break;

                                case IMAGETYPE_PNG:
                                    $sExt = '.png';
                                    // create a new image from file
                                    $vImg = @imagecreatefrompng($sTempFileName);
                                    break;

                                case IMAGETYPE_WEBP:
                                    $sExt = '.webp';
                                    // create a new image from file
                                    $vImg = @imagecreatefromwebp($sTempFileName);
                                    break;

                                default:
                                    echo "notJpgOrPng";
                                    @unlink($sTempFileName);
                                    return;
                            }
                            // create a new true color image
                            $vDstImg = @imagecreatetruecolor($iWidth, $iHeight);
                            imagealphablending($vDstImg, false);
                            imagesavealpha($vDstImg, true);
                            // copy and resize part of an image with resampling
                            imagecopyresampled($vDstImg, $vImg, 0, 0, 0, 0, $iWidth, $iHeight, $oldWidth, $oldHeight);
                            // define a result image filename
                            $sResultFileName = $sTempFileName . $sExt;
                            // output image to file
                            switch ($aSize[2]) {
                                case IMAGETYPE_JPEG:
                                    imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
                                    break;
                                case IMAGETYPE_PNG:
                                    imagepng($vDstImg, $sResultFileName, $iPngQuality);
                                    break;
                                case IMAGETYPE_WEBP:
                                    imagewebp($vDstImg, $sResultFileName, $iWebpQuality);
                                    break;
                            }
                            @unlink($sTempFileName);
                            $fNameURL = TINYMCE_IMAGE_UPLOAD_URL().$fName.$sExt;
                            $arrayData = array("file_path" => $fNameURL);
                            $jsonData = $arrayData;
                            return $jsonData;
                        }
                    }
                }
            }
        }
 	}	
}
