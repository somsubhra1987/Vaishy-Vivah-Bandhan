<?php
namespace app\lib;

use Yii;
use app\lib\Core;

Class GdClient extends Core
{

	var $className = "GdClient";
	var $image;
	var $image_type;
	var $width;
	var $height;

	
	function imageHeader($imageType)
	{
		if($imageType=='.jpg' ||$imageType=='.jpeg' )
			header('Content-type: image/jpeg');
		elseif($imageType=='.png' )
			header('Content-type: image/png');
		elseif($imageType=='.gif' )
			header('Content-type: image/gif');
	}

	function createImageByType($imageType,$imagePath)
	{
		if($imageType=='.jpg' ||$imageType=='.jpeg' )
				$image = imagecreatefromjpeg($imagePath);
		elseif($imageType=='.png' )
				$image = imagecreatefrompng($imagePath);
		elseif($imageType=='.gif' )
			$image = imagecreatefromgif($imagePath);

		return $image;
	}

	function showImageByType($imageType,$image)
	{
		if($imageType=='.jpg' ||$imageType=='.jpeg' )
			imagejpeg($image, NULL, 80);
		elseif($imageType=='.png' )
			imagepng($image);
		elseif($imageType=='.gif' )
			imagegif($image);
	}

	function resizeImage($imagePath,$imageDestinationPath,$width,$height,$imageType='jpg')
	{
		self::loadNew($imagePath,$imageType);
		if($width>0 && $height>0)
			$this->resize($width,$height);
		elseif($width>0 && $height<=0)
			$this->resizeToWidth($width);
		elseif($width<=0 && $height>0)
			$this->resizeToHeight($height);
		$this->saveFile($imageDestinationPath,$imageType);
	}

   function loadNew($filename,$imageType)
   {
      $image_info = getimagesize($filename);
      $this->image_type = $imageType;


      if( $this->image_type == '.jpg' || $this->image_type == '.jpeg')
      {
         $this->image = imagecreatefromjpeg($filename);
      }
      elseif( $this->image_type == '.gif' )
      {
         $this->image = imagecreatefromgif($filename);
      }
      elseif( $this->image_type == '.png' )
      {
         $this->image = imagecreatefrompng($filename);
      }

   }

   

   function saveFile($filename, $image_type='.jpg', $compression=75, $permissions=null)
   {
      if( $image_type == '.jpg'||$image_type == '.jpeg' )
      {
         imagejpeg($this->image,$filename,$compression);
      }
      elseif( $image_type == '.gif' )
      {
         imagegif($this->image,$filename);         
      }
      elseif( $image_type == '.png' )
      {
         imagepng($this->image,$filename);
      }   

      if( $permissions != null) {
         chmod($filename,$permissions);
      }

   }


   function output($image_type='.jpg') 
   {
      if( $image_type == '.jpg'||$image_type == '.jpeg' )
      {
         imagejpeg($this->image);
      } 
      elseif( $image_type == '.gif' )
      {
         imagegif($this->image);         
      }
      elseif( $image_type == '.png' )
      {
         imagepng($this->image);
      }   
   }

   function getWidth()
   {
      return imagesx($this->image);
   }

   function getHeight()
   {
      return imagesy($this->image);
   }


   function resizeToHeight($height)
   {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }


   function resizeToWidth($width)
   {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }

   function scale($scale)
   {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
   }

   function resize($width,$height)
   {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;   
   }  

   function blackAndWhiteImage($imagePath,$imageType)
   {
	$this->imageHeader($imageType);
	$image = $this->createImageByType($imageType,$imagePath);
	$image_width = imagesx($image);
	$image_height = imagesy($image);

	for ($h = 0; $h < $image_height; $h++)
	{
		for ($w = 0; $w < $image_width; $w++)
		{
			$colors = imagecolorsforindex($image, imagecolorat($image, $w, $h));
			$grayed_color = ($colors['red'] + $colors['green'] + $colors['blue']) / 3;
			$new_color = imagecolorallocate($image, $grayed_color, $grayed_color, $grayed_color);
			imagesetpixel($image, $w, $h, $new_color);
		}
	}
	$this->showImageByType($imageType,$image);
   }

   

   function sepiaImage($imagePath,$imageType)
   {
   	$this->imageHeader($imageType);
	$im = $this->createImageByType($imageType,$imagePath);
	$start_red = 2; 
	$start_blue = 2.3; 
	$red_scale = ($start_red-1)/256; 
	$blue_scale = ($start_blue - 1)/256; 


	$sepia = array();
	for($x = 0;$x < 256;$x++)
	{

		$red = intval($x * ($start_red - ($x * $red_scale)));
		if($red > 255) $red = 255;
		$blue = intval($x / ($start_blue - ($x * $blue_scale)));
		$sepia[$x][0] = $red;
		$sepia[$x][1] = $blue;
	}

	for($y = 0;$y < imagesy($im);$y++)
	{
		for($x = 0;$x < imagesx($im);$x++)
		{

			$pixel = imagecolorat($im, $x, $y);
			$red = ($pixel & 0xFF0000) >> 16;
			$green = ($pixel & 0x00FF00) >> 8;
			$blue = $pixel & 0x0000FF;
			$alpha = $pixel & 0x7F000000;
			$gs = intval(($red * 0.3) + ($green * 0.59) + ($blue * 0.11));
			$p = $alpha | $sepia[$gs][1] | ($gs << 8) | ($sepia[$gs] [0] << 16);
			imagesetpixel ($im, $x, $y, $p);
		}

	}
	$this->showImageByType($imageType,$im);
   }
     
   function cropImage($imagePath,$imageDestinationPath,$imageType,$stX,$stY,$width,$height)
   {
		$image = $imagePath;
		$dest_big_image = $imageDestinationPath;
	
		self::loadNew($image,$imageType);
		$this->resize($width+$stX,$height+$stY);
		$this->saveFile($dest_big_image);
		
		$dest_image = $dest_big_image;
		$img = imagecreatetruecolor($width,$height);
		$org_img = imagecreatefromjpeg($dest_big_image);
		imagecopy($img,$org_img, 0, 0, $stX, $stY, $width, $height);
		imagejpeg($img,$dest_image,90);
   }
   
   function saveResizedImage($uploadedFileName,$fileName,$refTableName,$sizeName,$width=0,$height=0,$orgImageWidth,$orgImageHeight)
   {
	   
	   
		if($height == '0')
		{
			$height = '0';
			$width =  $width;
		}
		elseif($width =='0')
		{
			$height = $height;
			$width =  '0';
		}
		else
		{
			$height = '0';
			$width =  $width;
		}
		
		
		$path = Core::getUploadedPath();
		
		if($sizeName) 
		{
			$fileName = $sizeName."_".$fileName;
			$filePath = $path . "/" . $refTableName . "/".$sizeName;
			$imageDestinationPath = $path . "/" . $refTableName . "/".$sizeName."/" . $fileName;
		}
		else 
		{
			$imageDestinationPath = $path . "/" . $refTableName . "/" . $fileName;
			$filePath = $path . "/" . $refTableName;
		}

		@mkdir($filePath, 0777, true); 
		
		$localImageExt = Core::getFileExtension($fileName);	
		
		
		self::resizeImage($uploadedFileName,$imageDestinationPath,$width,$height,$localImageExt);
	}	
   
  function saveRefImageResizedImage($uploadedFileName,$fileName,$refTableName, $subFolder, $sizeName,$width=0,$height=0,$orgImageWidth,$orgImageHeight)
   {
	   
	   
		if($height == '0')
		{
			$height = '0';
			$width =  $width;
		}
		elseif($width =='0')
		{
			$height = $height;
			$width =  '0';
		}
		else
		{
			$height = '0';
			$width =  $width;
		}
		
		
		$path = Core::getUploadedPath();
		
		if($sizeName) 
		{
			$fileName = $sizeName."_".$fileName;
			$imageDestinationPath = $path . "/" . $refTableName . "/".$sizeName."/" . $fileName;
		}
		else 
		{
			if($subFolder)
			{
				$imageDestinationPath = $path . "/" . $refTableName . "/" . $subFolder . "/" . $fileName;
			}
			else
			{
				$imageDestinationPath = $path . "/" . $refTableName . "/" . $fileName;	
			}
			
		}
		
		$localImageExt = Core::getFileExtension($fileName);	
		
		
		self::resizeImage($uploadedFileName,$imageDestinationPath,$width,$height,$localImageExt);
	}
}
?>