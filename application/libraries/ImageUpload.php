<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once("FileUpload.php");
require_once("phpthumb/ThumbLib.inc.php");

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 2.1
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Used for uploading image and creating thumbnails 
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		Gatelogix (Sajjad Mahmood)
 */

class ImageUpload{
	
	/**
	 * Main image resize width 
	 *
	 * @var integer
	 */
	protected $mWidth = 80;
	/**
	 * Main image resize height 
	 *
	 * @var integer
	 */
	protected $mHeight = 80;
	
	/**
	 * Thumbnail width 
	 *
	 * @var integer
	 */
	protected $mThumbWidth = 80;
	/**
	 * Thumbnail height 
	 *
	 * @var integer
	 */
	protected $mThumbHeight = 80;
	
	/**
	 * constructor of the class
	 *
	 */
	public function __construct(){}
	
	/**
	 * Will set the width for the thumbnail 
	 *
	 * @param integer $width
	 */
	public function setWidth($width){
		$this->mWidth = $width;
	}
	
	/**
	 * Will set the height for the thumbnail 
	 *
	 * @param integer $height
	 */
	public function setHeight($height){
		$this->mHeight = $height;
	}
	
	/**
	 * Will set the width for the thumbnail 
	 *
	 * @param integer $width
	 */
	public function setThumbWidth($width){
		$this->mThumbWidth = $width;
	}
	
	/**
	 * Will set the height for the thumbnail 
	 *
	 * @param integer $height
	 */
	public function setThumbHeight($height){
		$this->mThumbHeight = $height;
	}
	
	/**
	 * Will save the image file as it is [If we only need to upload image without creating the thumbnails]
	 *
	 * @param file $file_element
	 * @param string $module_name
	 * @param integer $record_id
	 * @param string $file_upload_path
	 * @param string $filename
	 */
	public function saveFile($file_element, $module_name="", $record_id, $file_upload_path, $is_main_resize=false, $is_thumbnail=false){
		$fileObj = new FileUpload();
		$fileObj->doInitialize($file_element);
		$filename = substr($file_element['name'], 0,strrpos($file_element['name'],'.'));
		$filename = $module_name."_".$record_id.$fileObj->getExtension();
		$fileObj->setName($filename);
		$fileObj->saveAs($file_upload_path); //to save the file physically on given location
		
		$savedImgPath = $fileObj->getFullPath();//This holds the full path of the file
		if($is_main_resize){
			$mainResize = PhpThumbFactory::create($savedImgPath);
			$mainResize->resize($this->mWidth, $this->mHeight);
			$mainResize->save($file_upload_path.$fileObj->getName());
		}
		if($is_thumbnail){
			$thumb = PhpThumbFactory::create($savedImgPath);
			//$thumb->adaptiveResize(80, 80);
			$thumb->resize($this->mThumbWidth, $this->mThumbHeight);
			$thumb->save($file_upload_path."thumbnail/".$fileObj->getName());
		}
		return $filename;
	}
	
}

?>