<?php

require_once 'callout.php';
require_once 'constants.php';
require_once 'abstractprospect.class.php';
require_once 'vitruemailmanager.class.php';

Class CallBack extends AbstractProspect
{

    public function saveprospect()
    {   
        if(($_GET['EmailID'] == '') || ($_GET['EmailID'] === 'E-Mail'))
        {
           $_GET['EmailID'] = 'nomail@sandogroup.com' ;
        }
        $result = AbstractProspect::validationCheck($_REQUEST['Mobile'], $_REQUEST['EmailID']);
        if ($result === true)
        {
//            AbstractProspect::leadGeneration();
//            // create the associative array representing the prospect information.
//            $nam = $_GET['Name'];
//            if (isset($_SESSION['Keyword']))
//            {
//                $nam = $_GET['Name'] . '(' . $_SESSION['Keyword'] . ')';
//            }
//            $prospect = array("Name" => $nam, "Mobile" => $_GET['Mobile'], "EmailID" => $_GET['EmailID']);
//
//            if (isset($_SESSION['Campaign']))
//            {
//                $comments = $_GET['Comments'] . 'BUDGET:' . $_GET['budget'] . ', IP:' . VitruUtils::getIpAddr() . ', URL' . VitruUtils::curPageURL() . ', ADD INFO:' . $_SESSION['Campaign'] . ', ' . $_SESSION['AdGroup'] . ', ' . $_SESSION['MatchType'] . ', ' . $_SESSION['Distribution'] . ', ' . $_SESSION['AdID'] . ', ' . $_SESSION['Placement'];
//            }
//            else
//            {
//                $comments = $_GET['Comments'] . 'BUDGET:' . $_GET['budget'] . ', IP:' . VitruUtils::getIpAddr() . ', URL:' . VitruUtils::curPageURL();
//            }
//
//            // create the associative array representing the extra attributes.
//            $attributes = array(
//                'City' => $_GET['city'],
//                'Area' => $_GET['area'],
//                'Comments' => $comments,
//                'Project' => array(),
//                'Property' => array()
//            );
//
//            // create the associative array representing the interaction details.
//            if (VitruUtils::smsEnabled())//send sms parameter in interaction only if sms is enabled
//            {
//                $interaction = array("Type" => "PortalCallBack", "IP" => VitruUtils::getIpAddr(), "Attributes" => $attributes, "SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(), "BrokerMobile" => VitruUtils::getMobileNumber(), "BrokerEmail" => VitruEmailManager::getDefaultTo());
//            }
//            else
//            {
//                $interaction = array("Type" => "PortalCallBack", "IP" => VitruUtils::getIpAddr(), "Attributes" => $attributes, "SendEmailFromWebsite" => VitruUtils::sendEmailFromWebsite(), "BrokerEmail" => VitruEmailManager::getDefaultTo());
//            }
//
//            // create the webprospect array.
//            $webprospect = array("Prospect" => $prospect, "Interaction" => $interaction);
//
//            // finally create the parameters array as required by the server callout.
//            $parameters = array("WebProspect" => $webprospect);
//
//            $response = parent::saveInternal($parameters);

            echo 'Thank you for expressing interest with us, our experts will get back to you shortly';

            //send email from website if enabled other wise send email from server
            if (VitruUtils::sendEmailFromWebsite())
            {
                CallBack::sendEmail($response);
            }
        }
        else
        {
            echo $result;
        }
    }

    private static function sendEmail($response)
    {
        $to = array(VitruEmailManager::getDefaultTo());
       // $cc = array('rahul.goyal@realtyredefined.com', 'nirav.gosalia@vitruviantech.com');
	$cc = array('rahul.goyal@realtyredefined.com',$_GET['EmailID'],'sandogroup@mtnl.net.in','sagar.ubhare@realtyredefined.com');
        // form the subject
        $subject = $_GET['Name'] . ' Requested a Call Back !';

        // form the body.
        $body .= '<html>';
        $body .= '<body style="font-size: 11; font-family: Verdana;">';
        $body .= '<p> Thank you for expressing interest on our website. Our expert will get in touch with you shortly. For your reference the information submitted by you on the form is mentioned below </p>';
        $body .= '<br/>';
        $body .= '<table style="font-size: 11; font-family: Verdana;">';
        $body .= '<tr><td>Name:</td><td>' . $_GET['Name'] . '</td></tr>';
        $body .= '<tr><td>Mobile:</td><td>' . $_GET['Mobile'] . '</td></tr>';
        $body .= '<tr><td>EmailID:</td><td>' . $_GET['EmailID'] . '</td></tr>';
	$body .= '<tr><td>Country:</td><td>'.$_GET['CountryCode'].'</td></tr>';
	$body .= '<tr><td>City:</td><td>'.$_GET['City'].'</td></tr>';
        $body .= '</table>';
        $body .= '<br></br>';
	$body .= 'Regards';
	$body .= '<br></br>';
	$body .= 'Sando Group';
        $body .= '<br></br>';
        $body .= '</body>';
        $body .= '</html>';

        // fire away.
        VitruEmailManager::sendEmail(array('to' => $to, 'cc' => $cc, 'subject' => $subject, 'body' => $body));
    }

}

?>
