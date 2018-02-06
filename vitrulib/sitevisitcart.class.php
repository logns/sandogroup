<?php
require_once 'callout.php';
require_once 'constants.php';
require_once 'abstractprospect.class.php';
require_once 'vitruemailmanager.class.php';


Class SiteVisitCart extends AbstractProspect
{

	public function saveprospect()
	{

		if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

			$result = AbstractProspect::validationCheck($_REQUEST['mobile'], $_REQUEST['email']);
			if($result === true)
			{
				$ProjectID = "";
				$PropertyID = "";
				
				if(isset($_SESSION['cart']['prj'])){
					foreach($_SESSION['cart']['prj'] as $cartSession => $projects){
						
						foreach($projects as $prjID => $name){
							
							$ProjectIDs .=  $prjID.',';
							
						}
						
					}
					$ProjectID = substr($ProjectIDs, 0, -1);
				}
				if(isset($_SESSION['cart']['prp'])){
					foreach($_SESSION['cart']['prp'] as $cartSession => $properties){
						
						foreach($properties as $prpID => $name){
							
							$PropertyIDs .=  $prpID.',';
							
						}
						
					}
					$PropertyID = substr($PropertyIDs, 0, -1);
				}
				
				// create the associative array representing the prospect information.
				$prospect = array("Name"=>$_GET['name'],"Mobile"=>$_GET['mobile'],"EmailID"=>$_GET['email']);
					
				// create the associative array representing the extra attributes.
				$attributes = array("PROJECT_IDs" => $ProjectID, "PROPERTY_IDs" => $PropertyID, "ContactTime"=>$_GET['ContactTime'], "ContactDate"=>$_GET['SiteVisitDate']);

				// create the associative array representing the interaction details.
				if(VitruUtils::smsEnabled())//send sms parameter in interaction only if sms is enabled
				{
					$interaction = array("Type"=>"SiteVisitCart","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes,"SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(),"BrokerMobile" => VitruUtils::getMobileNumber(), "BrokerEmail" => VitruEmailManager::getDefaultTo());
				}
				else
				{
					$interaction = array("Type"=>"SiteVisitCart","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes,"SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(),"BrokerEmail" => VitruEmailManager::getDefaultTo());
				}

				// create the webprospect array.
				$webprospect = array("Prospect"=>$prospect,"Interaction"=>$interaction);

				// finally create the parameters array as required by the server callout.
				$parameters = array("WebProspect"=>$webprospect);

				$response = parent::saveInternal($parameters);
					
				echo 'Thank you for expressing interest with us, our experts will get back to you shortly';
				
				unset($_SESSION['cart']);
					
				//send email from website if enabled other wise send email from server
				if(VitruUtils::sendEmailFromWebsite())
				{
					CallBack::sendEmail($response);
				}
			}else{
				echo $result;
			}
		}else{
				
			echo 'No Projects.';
			
		}
	}

	private static function sendEmail($response)
	{
		$to = array($_GET['EmailID']);
		$cc = array(VitruEmailManager::getDefaultTo(), VitruEmailManager::getDefaultCC());

		// form the subject
		$subject = $_GET['Name'].' Requested a Call Back !';

		// form the body.
		$body .= '<html>';
		$body .= '<body style="font-size: 11; font-family: Verdana;">';
		$body .= '<p> Thank you for expressing interest on our website. Our expert will get in touch with you shortly. For your reference the information submitted by you on the form is mentioned below </p>';
		$body .= '<br/>';
		$body .= '<table style="font-size: 11; font-family: Verdana;">';
		$body .= '<tr><td>Name:</td><td>'.$_GET['Name'].'</td></tr>';
		$body .= '<tr><td>Mobile:</td><td>'.$_GET['Mobile'].'</td></tr>';
		$body .= '<tr><td>EmailID:</td><td>'.$_GET['EmailID'].'</td></tr>';
		$body .= '</table>';
		$body .= '<br></br>';

		$body .= '</body>';
		$body .= '</html>';

		// fire away.
		VitruEmailManager::sendEmail(array('to'	=> $to, 'cc' => $cc, 'subject' => $subject, 'body' => $body));

	}
}
?>
