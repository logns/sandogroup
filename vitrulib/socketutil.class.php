<?php
/**
 *
 * @author Hari
 *
 */
class VitruSocketUtil
{
	private static function cleanResponse($jsRecords)
	{
		$jsRecords = utf8_encode($jsRecords);
		return $jsRecords;
	}

	/**
	 *
	 * This method sends data to the specified URL using HTTP POST method.
	 * The out of the box functionality provided by the PECL library along with the HttpRequest
	 * class is used to achieve this behavior.
	 *
	 * After invoking the specified URL with the specified data, the response is also returned as it
	 * is received from the remote server.
	 *
	 * @param unknown_type $data The data that will be sent as the POST payload.
	 * @param unknown_type $url The URL where the remote server is listening.
	 *
	 */
	public static function sendUsingHttp($data, $url)
	{
		// Open a socket connection to our server url.
		$r = new HttpRequest($url, $method);

		// Setup the post request with the payload.
		$r->addPostFields($data);

		// Send the request, and capture the response.
		try
		{
			return VitruSocketUtil::cleanResponse($r->send()->getBody());
		}
		catch(HttpException $ex)
		{
			throw $ex;
		}
	}

	public static function sendUsingCurl($data, $url)
	{
		// convert variables array to string
		$_data = array();
		while(list($n, $v) = each($data))
		{
			$_data[] = urlencode($n)."=".urlencode($v);
		}
		// format --> test1=a&test2=b etc.
		$_data = implode('&', $_data);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);

		return VitruSocketUtil::cleanResponse($result);
	}

	/**
	 *
	 * This method sends data to the specified URL using HTTP POST method.
	 * The socket functionality provided by PHP is used to achieve this behavior.
	 *
	 * After invoking the specified URL with the specified data, the response is also returned as it
	 * is received from the remote server.
	 *
	 * @param $data
	 * @param $url
	 *
	 */
	public static function sendUsingSocket($data, $url)
	{
		return VitruSocketUtil::sendUsingCurl($data, $url);
		/*
		 // convert variables array to string
		 $_data = array();
		 while(list($n, $v) = each($data))
		 {
			$_data[] = urlencode($n)."=".urlencode($v);
			}
			// format --> test1=a&test2=b etc.
			$_data = implode('&', $_data);

			// parse the given URL
			$url = parse_url($url);
			if ($url['scheme'] != 'http')
			{
			die('Only HTTP request are supported !');
			}

			// extract host and path:
			$host = $url['host'];
			$path = $url['path'];
			$port = $url['port'];

			try
			{
			// the error number and error string to get an idea as to what caused the error.
			$errNo;
			$errStr;
			// open a socket connection on the specified port.
			$fp = fsockopen($host, (isset($port) ? $port : 80), &$errNo, &$errStr, 10);

			// if the file pointer opened over the socket is not a valid resource
			// of it it is a boolean (in which case it could be false) then return with
			// an exception.
			if(!is_resource($fp) || is_bool($fp))
			{
			die('Unable to open connection to >>>> '.$host . '. Exiting with Error / Error Message >>>> ' . $errNo . ' / ' . $errStr);
			}

			// send the request headers:
			fputs($fp, "POST $path HTTP/1.1\r\n");
			fputs($fp, "Host: $host\r\n");
			fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Content-length: ". strlen($_data) ."\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $_data);

			$result = '';
			while(!feof($fp))
			{
			// receive the results of the request
			$result .= fgets($fp, 128);
			}

			// close the socket connection
			fclose($fp);
			}
			catch (Exception $ex)
			{
			// close the socket connection
			fclose($fp);
			// exit this request.
			die($ex->getMessage());
			}

			// split the result header from the content
			$result = explode("\r\n\r\n", $result, 2);

			$header = isset($result[0])?$result[0]:'';
			$content = isset($result[1])?$result[1]:'';

			return VitruSocketUtil::cleanResponse($content);
			*/
	}
}
?>

