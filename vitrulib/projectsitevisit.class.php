<?php
require_once 'callout.php';
require_once 'constants.php';
require_once 'project.class.php';
require_once 'abstractprospect.class.php';
require_once 'vitruemailmanager.class.php';

/**
 *
 * @author Hari
 *
 */
class ProjectSiteVisit extends AbstractProspect
{
	public function saveProspect()
	{
		// check if the $_GET contains the prospect or not.
		if(!$this->containsprospect())
		{
			return;
		}
		AbstractProspect::leadGeneration();
		// create the associative array representing the prospect information.
		$nam = $_GET['Name'];
		if(isset($_SESSION['Keyword']))
		{
			$nam = $_GET['Name'].'('.$_SESSION['Keyword'].')';
		}
		$prospect = array("Name"=>$nam,"Mobile"=>$_GET['Mobile'],"EmailID"=>$_GET['EmailID']);

		// create the associative array representing the extra attributes.

		if(isset($_SESSION['Campaign']))
		{
			$comments = $_GET['Comments'].'BUDGET:'.$_GET['budget'].', IP:'.VitruUtils::getIpAddr().', URL'.VitruUtils::curPageURL().', ADD INFO:'.$_SESSION['Campaign'].', '.$_SESSION['AdGroup'].', '.$_SESSION['MatchType'].', '.$_SESSION['Distribution'].', '.$_SESSION['AdID'].', '.$_SESSION['Placement'];
		}
		else
		{
			$comments = $_GET['Comments'].', IP:'.VitruUtils::getIpAddr().', URL:'.VitruUtils::curPageURL();
		}

		$attributes = array("Comments"=>$comments,
							"ContactPref"=>$_GET['ContactPref'],
							"ContactTime"=>$_GET['ContactTime'],
							"ProjectID"=>$_GET['projectid']);

		// create the associative array representing the interaction details.		
		if(VitruUtils::smsEnabled())//send sms parameter in interaction only if sms is enabled
		{
			$interaction = array("Type"=>"ProjectRequestAShowing","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes,"SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(),"BrokerMobile" => VitruUtils::getMobileNumber(), "BrokerEmail" => VitruEmailManager::getDefaultTo());
		}
		else
		{
			$interaction = array("Type"=>"ProjectRequestAShowing","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes,"SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(),"BrokerEmail" => VitruEmailManager::getDefaultTo());
		}

		// create the webprospect array.
		$webprospect = array("Prospect"=>$prospect,"Interaction"=>$interaction);

		// finally create the parameters array as required by the server callout.
		$parameters = array("WebProspect"=>$webprospect);

		parent::saveInternal($parameters);

		//send email from website if enabled other wise send email from server
		if(VitruUtils::sendEmailFromWebsite())
		{
			ProjectSiteVisit::sendEmail();
		}	

		echo 'Thank you for expressing interest in this project, our representative will get back to you shortly.';
	}

	private static function sendEmail()
	{
		$to = array(VitruEmailManager::getDefaultTo());
                $cc = array('rahul@vitruviantech.com', 'nirav.gosalia@vitruviantech.com');
		// form the subject
		$subject = $_GET['Name'].' requested a Project Site Visit!';

		$projectUrl = Project::detailPage(array('ROW_ID'=>$_GET['projectid']), true);

		// form the body.
		$body .= '<html>';
		$body .= '<body style="font-size: 11; font-family: Verdana;">';
		$body .= '<h2>Project Site Visit</h2><br>';
		$body .= 'Thank you for visiting our website! Our customer care executive shall get in touch with you shortly.';
		$body .= '<br></br>';
		$body .= 'Click on the link below for more information about this project.';
		$body .= '<br></br>';
		$body .= '<table style="font-size: 11; font-family: Verdana;">';
		$body .= '<tr><td>Name:</td><td>'.$_GET['Name'].'</td></tr>';
		$body .= '<tr><td>Mobile:</td><td>'.$_GET['Mobile'].'</td></tr>';
		$body .= '<tr><td>EmailID:</td><td>'.$_GET['EmailID'].'</td></tr>';
		$body .= '<tr><td>Project Name:</td><td>'.$_GET['projectname'].'</td></tr>';
		$body .= '<tr><td>Project Details:</td><td><a href="'.$projectUrl.'">Click Me</a></td></tr>';		
		$body .= '<tr><td>Contact Preferences:</td><td>'.$_GET['ContactPref'].'</td></tr>';
		$body .= '<tr><td>Contact Time:</td><td>'.$_GET['ContactTime'].'</td></tr>';
		$body .= '<tr><td>City:</td><td>'.$_GET['Comments'].'</td></tr>';
		$body .= '</table>';
		$body .= '<br></br>';
		$body .= 'Regards';
		$body .= '<br></br>';
		$body .= 'Sobha Developers';
		$body .= '</body>';
		$body .= '</html>';

		// fire away.
		VitruEmailManager::sendEmail(array('to'	=> $to, 'cc' => $cc, 'subject' => $subject, 'body' => $body));
	}
}
?>
