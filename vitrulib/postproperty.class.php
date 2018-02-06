<?php
require_once 'callout.php';
require_once 'constants.php';
require_once 'abstractprospect.class.php';

/**
 *
 * @author Hari
 *
 */
class PostProperty extends AbstractProspect
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
				"PropertyTransactionType"=>$_GET['PropertyTransactionType'],
				"NumberOfBedrooms"=>$_GET['NumberOfBedrooms'],
				"NumberOfBathrooms"=>$_GET['NumberOfBathrooms'],
				"PropertyType"=>$_GET['PropertyType'],
				"PropertyChildType"=>$_GET['PropertyChildType'],
				"City"=>$_GET['City'],
				"Area"=>$_GET['Area'],
				"Price"=>$_GET['Price'],
				"SaleableArea"=>$_GET['SaleableArea']);

		// create the associative array representing the interaction details.
		$interaction = array("Type"=>"PostProperty","IP"=>VitruUtils::getIpAddr(),"Attributes"=>$attributes);

		// create the webprospect array.
		$webprospect = array("Prospect"=>$prospect,"Interaction"=>$interaction);

		// finally create the parameters array as required by the server callout.
		$parameters = array("WebProspect"=>$webprospect);

		$response = parent::saveInternal($parameters);


//		PostProperty::sendEmail($response);

		echo '<a href="'.PostProperty::getBackUrl().'"><img src="images/vitru-images/back_btn.gif" border="0"/></a>';
		echo '<br></br>';
		echo 'Thank you for sharing this information with us, our executive will get in touch with you soon.';
	}

	public static function getBackUrl()
	{
		return 'index.php?option=com_postproperty&view=basic&' . VitruUtils::getQueryString(array('task','view','option'));
	}

	private static function sendEmail($response)
	{
		$to = array($_GET['EmailID']);
		$bcc = array(VitruEmailManager::getDefaultTo());

		// form the subject
		$subject = $_GET['Name'].' Posted this Property !';

		// form the body.
		$body .= '<html>';
		$body .= '<body style="font-size: 11; font-family: Verdana;">';
		$body .= '<h2>Property Posted !</h2><br>';
		$body .= 'Thank you for visiting our website! Our customer care executive shall get in touch with you shortly.';
		$body .= '<br></br>';
		$body .= '<table style="font-size: 11; font-family: Verdana;">';
		$body .= '<tr><td>Name:</td><td>'.$_GET['Name'].'</td></tr>';
		$body .= '<tr><td>Mobile:</td><td>'.$_GET['Mobile'].'</td></tr>';
		$body .= '<tr><td>EmailID:</td><td>'.$_GET['EmailID'].'</td></tr>';
		$body .= '<tr><td>PropertyTransactionType:</td><td>'.$response['PropertyTransactionType'].'</td></tr>';
		$body .= '<tr><td>NumberOfBedrooms:</td><td>'.(isset($response['NumberOfBedrooms'])?$response['NumberOfBedrooms']:'NA').'</td></tr>';
		$body .= '<tr><td>NumberOfBathrooms:</td><td>'.(isset($response['NumberOfBathrooms'])?$response['NumberOfBathrooms']:'NA').'</td></tr>';
		$body .= '<tr><td>PropertyType:</td><td>'.$response['PropertyType'].'</td></tr>';
		$body .= '<tr><td>PropertyChildType:</td><td>'.$response['PropertyChildType'].'</td></tr>';
		$body .= '<tr><td>City:</td><td>'.$response['CityName'].'</td></tr>';
		$body .= '<tr><td>Area:</td><td>'.$response['AreaName'].'</td></tr>';
		$body .= '<tr><td>Price:</td><td>'.$response['Cost'].'</td></tr>';
		$body .= '<tr><td>SaleableArea:</td><td>'.$response['TotalArea'].'</td></tr>';
		$body .= '</table>';
		$body .= '<br></br>';
		$body .= 'Regards';
		$body .= '<br></br>';
		$body .= 'Vitruvian Tech';
		$body .= '</body>';
		$body .= '</html>';

		// fire away.
		VitruEmailManager::sendEmail(array('to'	=> $to, 'bcc' => $bcc, 'subject' => $subject, 'body' => $body));
	}
}
?>
