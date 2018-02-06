<?php

/**
 *
 * @author Hari
 *
 */
class VitruLoginManager
{
	var $joomlaLoginUrl = 'index.php?option=com_user&view=login';
	var $loginEnabled = false;

	public function redirectToLoginUrl($targetUrl)
	{
		if(!$this->loginEnabled)
		{
			return;
		}
		$user =& JFactory::getUser();
		if (!$user->guest)
		{
			return;
		}
		else
		{
			// base64 encode the target URL.
			$redirectUrl = base64_encode($targetUrl);

			// setup the encoded url against a request variable called return.
			$redirectUrl = '&return='.$redirectUrl;

			$application = JFactory::getApplication('site');
			$application->redirect($this->joomlaLoginUrl.$redirectUrl);
		}
	}

	public function getLoginUrl($targetUrl)
	{
		if(!$this->loginEnabled)
		{
			return $targetUrl;
		}
		$user =& JFactory::getUser();
		if (!$user->guest)
		{
			return $targetUrl;
		}
		else
		{
			// base64 encode the target URL.
			$redirectUrl = base64_encode($targetUrl);

			// setup the encoded url against a request variable called return.
			$redirectUrl = '&return='.$redirectUrl;

			// finally return the concatenation of the joomla login url and this
			return $this->joomlaLoginUrl.$redirectUrl;
		}
	}
}
?>
