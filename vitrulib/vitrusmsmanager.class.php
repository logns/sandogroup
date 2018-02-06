<?php
/**
 *
 * @author Hari
 *
 */
class VitruSmsManager
{
	public static $enabled = false;

	private static $userid = '2000038675';
	private static $password = 'anil4320';
	private static $msgType = 'TEXT';
	private static $authScheme = 'PLAIN';

	public static function sendSms($msg, $to = '919987027067')
	{
		if(!VitruSmsManager::$enabled)
		{
			return;
		}

		$param["method"]= "sendMessage";
		$param["send_to"] = $to;
		$param["msg"] = $msg;
		$param["userid"] = VitruSmsManager::$userid;
		$param["password"] = VitruSmsManager::$password;
		$param["v"] = "1.1";

		// Can be "FLASH"/"UNICODE_TEXT"
		$param["msg_type"] = VitruSmsManager::$msgType;
		$param["auth_scheme"] = VitruSmsManager::$authScheme;

		// initialise the request variable
		$request = "";
		foreach($param as $key=>$val)
		{
			// Have to URL encode the values
			$request.= $key."=".urlencode($val);

			// append the ampersand (&) sign after each parameter-value pair
			$request.= "&";
		}
		// remove final (&) sign from the request
		$request = substr($request, 0, strlen($request)-1);
		$url = "http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;

		// invoke the above URL using the curl API call.
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
	}
}
?>
