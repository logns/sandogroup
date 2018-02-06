<?php
require_once 'callout.php';
require_once 'constants.php';
require_once 'property.class.php';
require_once 'abstractprospect.class.php';
require_once 'vitruemailmanager.class.php';
/**
 *
 * @author Hari
 *
 */
class PropertySiteVisit extends AbstractProspect
{
	public function saveProspect()
	{
		// check if the $_GET contains the prospect or not.
		if(!$this->containsprospect())
		{
			return;
		}

		// create the associative array representing the prospect information.
		$prospect = array("Name"=>$_GET['Name'],"Mobile"=>$_GET['Mobile'],"EmailID"=>$_GET['EmailID']);

		// create the associative array representing the extra attributes.
		$attributes = array(
				"Comments"=>$_GET['Comments'],
				"ContactPref"=>$_GET['ContactPref'],
				"ContactTime"=>$_GET['ContactTime'],
				"PropertyID"=>$_GET['propertyid']);

		// create the associative array representing the interaction details.		
		if(VitruUtils::smsEnabled())//send sms parameter in interaction only if sms is enabled
		{
			$interaction = array("Type"=>"RequestAShowing","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes,"SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(),"BrokerMobile" => VitruUtils::getMobileNumber(), "BrokerEmail" => VitruEmailManager::getDefaultTo());
		}
		else
		{
			$interaction = array("Type"=>"RequestAShowing","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes,"SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(),"BrokerEmail" => VitruEmailManager::getDefaultTo());
		}

		// create the webprospect array.
		$webprospect = array("Prospect"=>$prospect,"Interaction"=>$interaction);

		// finally create the parameters array as required by the server callout.
		$parameters = array("WebProspect"=>$webprospect);
		
		parent::saveInternal($parameters);
		
		//send email from website if enabled other wise send email from server
		if(VitruUtils::sendEmailFromWebsite())
		{
			PropertySiteVisit::sendEmail();
		}
							
		echo '<br/>Thank you for expressing interest in this property, our representative will get back to you shortly.';
	}

	private static function sendEmail()
	{
		$to = array($_GET['EmailID']);
		$cc = array(VitruEmailManager::getDefaultTo(), VitruEmailManager::getDefaultCC());

		// form the subject
		$subject = $_GET['Name'].' requested a Property Site Visit!';

		$propertyUrl = Property::detailPage(array('ROW_ID'=>$_GET['propertyid']), true);

		// form the body.
		$body .= '<html>';
		$body .= '<body style="font-size: 11; font-family: Verdana;">';
		$body .= '<h2>Property Site Visit</h2><br>';
		$body .= 'Thank you for visiting our website! Our customer care executive shall get in touch with you shortly.';
		$body .= '<br></br>';
		$body .= 'Click on the link below for more information about this property.';
		$body .= '<br></br>';
		$body .= '<table style="font-size: 11; font-family: Verdana;">';
		$body .= '<tr><td>Name:</td><td>'.$_GET['Name'].'</td></tr>';
		$body .= '<tr><td>Mobile:</td><td>'.$_GET['Mobile'].'</td></tr>';
		$body .= '<tr><td>EmailID:</td><td>'.$_GET['EmailID'].'</td></tr>';
		$body .= '<tr><td>Property Name:</td><td>'.$_GET['propertyname'].'</td></tr>';
		$body .= '<tr><td>Property Details:</td><td><a href="'.$propertyUrl.'">Click Me</a></td></tr>';
		$body .= '<tr><td>Contact Preferences:</td><td>'.$_GET['ContactPref'].'</td></tr>';
		$body .= '<tr><td>Contact Time:</td><td>'.$_GET['ContactTime'].'</td></tr>';
		$body .= '<tr><td>Comments:</td><td>'.$_GET['Comments'].'</td></tr>';
		$body .= '</table>';
		$body .= '<br></br>';
		$body .= 'Regards';
		$body .= '<br></br>';
		$body .= 'Vitruvian Tech';
		$body .= '</body>';
		$body .= '</html>';

		// fire away.
		VitruEmailManager::sendEmail(array('to'	=> $to, 'cc' => $cc, 'subject' => $subject, 'body' => $body));
	}
}
?>
