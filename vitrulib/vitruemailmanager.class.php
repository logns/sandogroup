<?php
/**
 *
 * @author Hari
 *
 */
class VitruEmailManager
{
	public static $enabled = true;

	public static $to = 'to';
	public static $cc = 'cc';
	public static $bcc = 'bcc';
	public static $subject = 'subject';
	public static $body = 'body';
	public static $html = 'html';

	public static function getDefaultTo()
	{
		// $conf	=& JFactory::getConfig();
		// $mailfrom 	= $conf->getValue('config.mailfrom');
		// $fromname 	= $conf->getValue('config.fromname');
		return 'sandogroup@gmail.com';
		//return 'lalita.chavan@realtyredefined.com';
	}

	public static function getDefaultCC()
        {
                //return 'info@vitruviantech.com';
                return 'rahul.goyal@realtyredefined.com';
        }

	/**
	 *
	 * The only parameter passed here is an associative array. It
	 * contains the following keys.
	 *
	 * 1. to:
	 * This itself can be another array, containing all the
	 * recipients of this mail.
	 *
	 * 2. cc:
	 * This itself can be another array, containing all the
	 * recipients of this mail in Cc.
	 *
	 * 3. bcc:
	 * This itself can be another array, containing all the
	 * recipients of this mail in Bcc.
	 *
	 * 4. subject:
	 * This is simply a string containing the subject of the
	 * mail message.
	 *
	 * 5. body:
	 * This is simply the body string representing all the text information
	 * that needs to be sent along with the email.
	 *
	 * 6. html:
	 * This is simply a boolean true/false. Indicating whether the body needs to be
	 * sent as HTML or normal Text.
	 *
	 * @param unknown_type $p
	 *
	 */
	public static function sendEmail($p)
	{
		if(!VitruEmailManager::$enabled)
		{
			return;
		}

		// create an instance of the mailer class.
		$mailer =& JFactory::getMailer();

		// pick up the sender from joomla configuration & set the sender.
		$config =& JFactory::getConfig();
		$sender = array( $config->getValue( 'config.mailfrom' ), $config->getValue( 'config.fromname' ));
		$mailer->setSender($sender);

		// setup the mailer, with to, cc, bcc, subject, body and the HTML.
		$mailer->addRecipient($p[VitruEmailManager::$to]);

		// check if there is a cc.
		if(isset($p[VitruEmailManager::$cc]))
		{
			$mailer->addCc($p[VitruEmailManager::$cc]);
		}

		// check if there is a bcc.
		if(isset($p[VitruEmailManager::$bcc]))
		{
			$mailer->addBcc($p[VitruEmailManager::$bcc]);
		}

		$mailer->setSubject($p[VitruEmailManager::$subject]);
		$mailer->setBody($p[VitruEmailManager::$body]);
		$mailer->isHTML(isset($p[VitruEmailManager::$html])?$p[VitruEmailManager::$html]:true);

		//		$mailer->AddEmbeddedImage( PATH_COMPONENT.DS.'assets'.DS.'logo128.jpg', 'logo_id', 'logo.jpg', 'base64', 'image/jpeg' );

		// finally send the email.
		$send =& $mailer->Send();
		if ( $send !== true )
		{
			echo 'Error sending email: ' . $send->message;
		}
		else
		{
		}
	}
}
?>
