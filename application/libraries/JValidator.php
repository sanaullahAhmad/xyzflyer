<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

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
 * JValidator class validates invalid data just to make sure junk is prevented to be insert into database
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	PHP validation
 * @author		Gatelogix (Sajjad Mahmood)
 */

class JValidator {
	
	/**
	 * holds string which needs to be validated
	 *
	 * @access protected
	 * @var string
	 */
	protected $mString = "";
	/**
	 * holds boolean either true or false
	 *
	 * @var bool
	 */
	protected $mbIsValid = true;
	/**
	 * array of boolean, if any element/index is false then return false
	 *
	 * @var bool
	 */
	protected $mbError = array();
	/**
	 * array of error messages string
	 */
	protected $mError = array();
	/**
	 * gets string as paramete to be validated
	 *
	 * @param string $string
	 */
	function __construct( $string = "" ){
		$this->mString = $string;
	}
	/**
	 * check for empty validation stores the error message in
	 * mError array which can be accessed by calling 
	 * getError method
	 * 
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg
	 */
	public function addRequiredFieldValidator($fieldName, $string, $errMsg){
		$string = strip_tags(trim(str_replace("&nbsp;","",$string)));
		if( $string == "" || $string == null || !isset($string) || (strlen($string) <= 0 ) ){
			$this->mbError[] = false;
			$this->mError[] = $fieldName."|".$errMsg.",";
		}
		else{
			$this->mError[] = $fieldName."|success,";
			$this->mbError[] = true;
		}
	}
	
	/**
	 * checks the Length of the entered text
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param integer $minLength
	 * @param string $errMsg
	 */
	public function addLengthFieldValidator($fieldName, $string, $minLength, $errMsg){
		if( (strlen($string) < $minLength ) ){
			$this->mbError[] = false;
			$this->mError[] = $fieldName."|".$errMsg.",";
		}
		else{
			$this->mError[] = $fieldName."|success,";
			$this->mbError[] = true;
		}
	}	
	/**
	 * will update the personal info of the logged in user
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function addEmailValidator($fieldName, $string, $errMsg){
		//regular expression for email validation	
	   if($string != ""){
  	   //$okay = preg_match('/^[A-z0-9_\-.]+[@][A-z0-9_\-]+([.][A-z0-9_\-.]+)+[A-z]{2,4}$/',$string);
	   $okay = eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $string);	
	  	   if(!$okay){
	  	   		$this->mbError[] = false;
	  	   		$this->mError[] = $fieldName."|".$errMsg.",";
	  	   }
	  	   else{
		   		$this->mError[] = $fieldName."|success,";
	  	   	   	$this->mbError[] = true;
	  	   }
	   }	   
	   else{
	   	$this->mbError[] = false;
  	   	$this->mError[] = $errMsg;
	   }		
	}
	/**
	 * will validate the phone numbers
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function addPhoneNumberFieldValidator($fieldName, $string, $errMsg){
	   //regular expression for email validation	
	   $be_pattern = "/^([\+][3][2])([ ])([0-9]{8,9})$/";
  	   if(preg_match($be_pattern, $string)){
  	   		$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
  	   } else{
  	      	$this->mbError[] = false;
  	   		$this->mError[] = $fieldName."|".$errMsg.",";
  	   }
	}
	/**
	 * Is a Natural number  (0,1,2,3, etc.) 
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isNaturalFieldValidator($fieldName, $string, $errMsg){
		if(!preg_match('/^[0-9]+$/',$string)){
			$this->mbError[] = false;
  	   		$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		}
	}
	/**
	 * Is a Decimal number  (12.20, 4.52, 0.30, etc.)---- function added by Fuad
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isDecimalValidator($fieldName, $string, $errMsg){ 
		if(!preg_match('/^-?([0-9])+\.?([0-9])+$/',$string)){
			$this->mbError[] = false;
  	   		$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		}
	}
	/**
	 * Is a Natural number, but not a zero  (1,2,3, etc.)
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isNaturalNoZeroFieldValidator($fieldName, $string, $errMsg){
		if(!preg_match('/^[0-9]+$/',$string) || $string == 0){
			$this->mbError[] = false;
  	   		$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		}
	}
	/**
	 * Is a Decimal number  (1, 12.20, 4.52, 0.30, etc.)---- function added by Fuad
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isDecimalFieldValidator($fieldName, $string, $errMsg){
		if(!preg_match('#\d+(?:\.\d{1,2})?#', $string) || !preg_match("/^[0.0-9.9]+$/", $string)){
			$this->mbError[] = false;
  	   		$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		}
	}
	/**
	 * is Alpha
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isAlphaFieldValidator($fieldName, $string, $errMsg){
		if(!preg_match("/^([a-z])+$/i", $string)) {
			$this->mbError[] = false;
			$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		} 
	}
	/**
	 * is Alpha Numeric , will accept only Alphabets + numbers + spaces + dashes           Note: // old preg_match pattern was not accepting "spaces" i.e /^([a-z0-9])+$/i
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isAlphaNumericFieldValidator($fieldName, $string, $errMsg){
		if(!preg_match("/^[A-Z a-z0-9_-]+$/", $string)) {   //please add stripslashes() & mysql_real_escape_string() functions on your string also
			$this->mbError[] = false;
			$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		} 
	}
	/**
	 * is Alpha Dash
	 *
	 * @param string $fieldName
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isAlphaDashFieldValidator($fieldName, $string, $errMsg){
		if(!preg_match("/^([-a-z0-9_-])+$/i", $string)) {
			$this->mbError[] = false;
			$this->mError[] = $fieldName."|".$errMsg.",";
		} else {
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		} 
	}
	/**
	 * check if the image is valid, only jpeg, gif and png images are allowed
	 *
	 * @param string $fieldName
	 * @param string $fileType
	 * @param string $errMsg
	 */
	public function addImageFieldValidator($fieldName, $fileType, $errMsg){
		switch ($fileType){
			case "image/jpeg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/jpg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/jpe_":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/pjpeg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/vnd.swiftview-jpeg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "application/jpg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "application/x-jpg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/pipeg":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/gif":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/gi_":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			case "image/png":
				$this->mbError[] = true;
				$this->mError[] = $fieldName."|success,";
			break;
			default:
				$this->mbError[] = false;
				$this->mError[] = $fieldName."|".$errMsg.",";
			break;	
		}
	}
	/**
	 * check if the size of the image
	 *
	 * @param string $fieldName
	 * @param string $fileSize
	 * @param string $compareSize
	 * @param string $errMsg
	 */
	public function addImageRestrictSizeValidator($fieldName, $fileSize, $compareSize, $errMsg){
		if($fileSize > $compareSize){
			$this->mbError[] = false;
			$this->mError[] = $fieldName."|".$errMsg.",";
		} else{
			$this->mbError[] = true;
			$this->mError[] = $fieldName."|success,";
		}		
	}
	/**
	 * get all ther errors if there are any
	 *
	 */
	public function getErrorMessages(){
		return (is_array($this->mError["error"])?$this->mError:false);
	}
	/**
	 * get all ther errors/success if there are any
	 *
	 */
	public function getErrorSuccessMessages(){
		return (is_array($this->mError)?$this->mError:false);
	}
	/**
	 * will check if everything is valid
	 *
	 * @param string $string
	 * @param string $errMsg 
	 */
	public function isValid(){
		foreach( $this->mbError as $error ){
			//check if there is any error then return false;
			if(!$error){
				$this->mbIsValid = false;
			}
		}
		return $this->mbIsValid;
	}	
} 

?>