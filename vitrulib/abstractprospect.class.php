<?php
require_once 'vitruemailmanager.class.php';
require_once 'vitrusmsmanager.class.php';
require_once 'constants.php';
require_once 'arrayutil.php';
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components/com_leads/tables');

/**
 *
 * @author Hari
 *
 */
class AbstractProspect
{
	var $calloutName = 'ProspectCallout';

	public function containsprospect()
	{
		if(isset($_GET['Mobile'])&&isset($_GET['Name'])&&isset($_GET['EmailID']))
		{
			$this->saveCookies();
			return true;
		}
		else
		{
			return false;
		}
	}

	protected function extractResponse($response)
	{
		$attributes = $response['InteractionData']['Attributes']['Attribute'];
		$simplified = array();
		if(!isset($attributes)||empty($attributes))
		{
			return $simplified;
		}

		foreach($attributes as $idx => $attribute)
		{
			if(ArrayUtil::isAssociative($attribute))
			{
				$value = $attribute['value'];
				$attr  = $attribute['attr']['Name'];
				$simplified[$attr] = $value;
			}else{
				$value = $attributes['value'];
				$attr  = $attributes['attr']['Name'];
				$simplified[$attr] = $value;
				return $simplified;
			}
		}

		return $simplified;
	}

	protected function saveInternal($parameters)
	{
		// add the application ID before invoking the callout also.
		$parameters['ApplicationID'] = VitruUtils::getAppID();

		// create the callout instance.
		$callout = new PhpCallout($this->calloutName, VitruUtils::getServerUrl());

		// invoke the callout.
		$response = ArrayUtil::xml2array($callout->execute($parameters));

		return $this->extractResponse($response);
	}

	public function saveCookies()
	{
		if(!VitruUtils::cookiesEnabled())
		{
			return;
		}
		VitruUtils::setCookie('Name', isset($_GET['Name'])?$_GET['Name']:'');
		VitruUtils::setCookie('EmailID', isset($_GET['EmailID'])?$_GET['EmailID']:'');
		VitruUtils::setCookie('Mobile', isset($_GET['Mobile'])?$_GET['Mobile']:'');
	}

	public static function validationCheck($mobile, $email){
		$msg = true;
		if(empty($mobile) || strlen($mobile) >= 13 || strlen($mobile) <= 6 || $mobile === 'Mobile:' || !(AbstractProspect::is_mobileNumber($mobile))){
			$msg = 'Enter a valid mobile number<br>';
			return $msg;
		}
              // if(!empty($email) && !(AbstractProspect::isValidEmail($email)) ){
		//	$msg = 'Enter a valid email address<br>';
	//		return $msg;
	//	}
		return $msg;
               
	}

	public function isValidEmail($email){
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}

	public function is_mobileNumber($mobile) {
		$regex1 = '123456789';
		$regex2 = '1234567890';
		$regex3 = '0123456789';

		if(preg_match('/^([0-9])\1*$/', $mobile)){
			return false;
		}elseif($mobile == $regex1){
			return false;
		}elseif($mobile == $regex2){
			return false;
		}elseif($mobile == $regex3){
			return false;
		}elseif(preg_match("/[^0-9]/", $mobile)){
			return false;
		}else{
			return true;
		}
	}

	public static function leadGeneration(){

		$row =& JTable::getInstance('leads', 'Table');
		if (!$row->bind(JRequest::get('get')))
		{
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$date =& JFactory::getDate($row->cdt);
		$row->cdt = $date->toMySQL();

		$row->ip = VitruUtils::getIpAddr();

		if($_GET['projectname']){
			$row->leadpoint = $_GET['projectname'];
		}elseif($_GET['propertyname']){
			$row->leadpoint = $_GET['propertyname'];
		}else{
			$row->leadpoint =  $_GET['Country'].' '. $_GET['City'].' '.VitruUtils::curPageURL();
		}

		//PPC Entry
		$row->Campaign = $_SESSION['Campaign'];
		$row->AdGroup = $_SESSION['AdGroup'];
		$row->Keyword = $_SESSION['Keyword'];
		$row->MatchType = $_SESSION['MatchType'];
		$row->Distribution = $_SESSION['Distribution'];
		$row->AdID = $_SESSION['AdID'];
		$row->Placement = $_SESSION['Placement'];


		if (!$row->store())
		{
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

	}
}
?>
