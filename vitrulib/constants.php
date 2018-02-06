<?php
/**
 *
 * Just a crappy class containing shit loads of all sorts of useful stuff.
 *
 * @author HARISH
 *
 */
class VitruUtils
{
	public static function cacheEnabled()
	{
		return false;
	}

	public static function cookiesEnabled()
	{
		return false;
	}

	public static function httpSupported()
	{
		return false;
	}

	public static function seoEnabled()
	{
		return true;
	}

	public static function smsEnabled()
	{
		return false;
	}

	public static function sendEmailFromWebsite()
	{
		return true;
	}

	public static function addMetaTag($name, $content)
	{
		if(!VitruUtils::seoEnabled())
		{
			return;
		}
		$document = &JFactory::getDocument();
		$document->setMetaData($name, $content);
	}

	public static function setTitle($title)
	{
		if(!VitruUtils::seoEnabled())
		{
			return;
		}
		$document = &JFactory::getDocument();
		$document->setTitle($title);
	}

	/**
	 *
	 * Used to get us the url from where we need to pull and push the data.
	 * This is where we need to change when deploying a website to production.
	 *
	 */
	public static function getServerUrl()
	{
		//return 'http://175.41.131.189:8080/RR/Request/query.htm';
		//		return 'http://192.168.1.140:8080/RealtyRedefined/Request/query.htm';
            		return 'http://54.251.99.7:8080/RRDevelopers/Request/query.htm';
	}

	/**
	 *
	 * Currently we are not using any PDF report generated from the website, but in the future
	 * when we do generate the flyers from our site then we can use this method to hit the server
	 * application which will generate the PDF.
	 *
	 */
	public static function getReportUrl()
	{
		return 'http://175.41.131.189:8080/RR/Request/GenerateReport';
	}

	/**
	 *
	 * This method is used to specify the mobile number
	 * which will recieve sms from the server whenever an
	 * prospect is generated on the website
	 */
	public static function getMobileNumber()
	{
		return '';
	}

	/**
	 *
	 * Most important method when giving a deployment in SaaS mode, here we will
	 * specify the APPLICATION_ID that needs to be used to get data from the server.
	 *
	 */
	public static function getAppID()
	{
		//return '2117';//APP ID for Sobha Developers
                return '1';//APP ID for GopalKirshnagroup
	}

	/**
	 *
	 * A lot of places in the website use this method to generate SaaS aware search
	 * predicates.
	 * These predicates are decorated with the appropriate APPLICATION_ID which is then
	 * used on the server to query accordingly.
	 *
	 * @param $predicate
	 */
	public static function addAppID($predicate)
	{
		$appID = VitruUtils::getAppID();
                //$row_id = '363670412314726072';
		if(empty($appID))
		{
			return $predicate;
		}
		$predicate['FieldSet'][] = VitruUtils::getAppID();
                $predicate['FieldSet'][] = $row_id;
		(!empty($predicate['BitMap']))?$predicate['BitMap'].='&&APPLICATION_ID=?':$predicate['BitMap']='APPLICATION_ID=?';
		return $predicate;
	}

	/**
	 * Utility method used to get a cookie with a given name.
	 *
	 * @param unknown_type $key
	 */
	public static function getCookie($key)
	{
		return isset($_COOKIE[$key])?$_COOKIE[$key]:'';
	}

	/**
	 * Utility method used to set a cookie.
	 *
	 * @param unknown_type $key
	 * @param unknown_type $value
	 * @param unknown_type $expiry
	 */
	public static function setCookie($key, $value, $expiry = 604800)
	{
		setcookie($key, $value, time() + $expiry);
	}

	/**
	 * Very useful utility method that is used to generate a set of hidden input tags,
	 * with values and names as are present in the current $_REQUEST object.
	 * This is very useful when we need to replicate the query data coming from one page and passing
	 * that information on to another page.
	 *
	 * The way this information is passed on is using POST method of HTTP submits. This method is
	 * usually used along with a form.
	 *
	 * @param unknown_type $skipParams
	 */
	public static function getPostQueryString($skipParams = array())
	{
		foreach($_REQUEST as $k => $v)
		{
			if(!in_array($k, $skipParams))
			{
				if(is_array($v))
				{
					foreach($v as $tIdx => $tVal)
					{
						echo '<input type="hidden" name="'.$k.'[]" value="'.$tVal.'" />';
					}
				}
				else
				{
					echo '<input type="hidden" name="'.$k.'" value="'.$v.'" />';
				}
			}
		}
	}

	/**
	 * Very useful utility method that is used to generate a the entire query string for the anchor tags href attributes.
	 * The query string is generated with key / value pairs based on the current $_REQUEST object.
	 * This is very useful when we need to replicate the query data coming from one page and passing
	 * that information on to another page.
	 *
	 * The way this information is passed on is using GET method of HTTP submits. This method is
	 * usually used along with a anchor tags href attribute..
	 *
	 * @param unknown_type $skipParams
	 */
	public static function getQueryString($skipParams = array())
	{
		$r = '';
		$requestArray = array_merge($_GET, $_POST);
		foreach($requestArray as $k => $v)
		{
			if(!in_array($k, $skipParams))
			{
				if(!is_array($v))
				{
					if(!empty($r))
					{
						$r.='&';
					}
					$r.=($k.'='.urlencode($v));
				}
				else
				{
					foreach($v as $tIdx => $tVal)
					{
						if(!empty($r))
						{
							$r.='&';
						}
						$r.=($k.'[]='.$tVal);
					}
				}
			}
		}
		return $r;
	}

	/**
	 *
	 * As the name suggests used to get the IP address from where the request came.
	 *
	 */
	public static function getIpAddr()
	{
		// check ip from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		// to check ip is pass from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	public static function hyphenate($string)
	{
		$string = str_replace(' ', '-', $string);
		$string = str_replace(',', '-', $string);
		$string = str_replace(';', '-', $string);
		$string = str_replace('/', '-', $string);
		$string = str_replace('\\', '-', $string);
		return $string;
	}

	public static function dehyphenate($string)
	{
		// if there is any hyphen already then replace it with underscore.
		$string = str_replace(':', '-', $string);
		$string = str_replace('-', ' ', $string);
		// replace all space characters with hyphen.
		$string = str_replace('_', '-', $string);
		return $string;
	}

	public static function getItemID($alias, $mentype = '')
	{
		$db =& JFactory::getDBO();
		if(isset($menutype) && !empty($menutype))
		{
			$query = "SELECT * FROM #__menu WHERE published = '1' AND alias = '".$alias."' AND menutype = '".$menutype."'";
		}
		else
		{
			$query = "SELECT * FROM #__menu WHERE published = '1' AND alias = '".$alias."'";
		}
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		if ($db->getErrorNum())
		{
			echo $db->stderr();
			return;
		}
		return $rows[0]->id;
	}

	//Locality - Browser Change
	# Convert a stdClass to an Array
	public static function object_to_array(stdClass $Class)
	{
		# Typecast to (array) automatically converts stdClass -> array.
		$Class = (array)$Class;

		# Iterate through the former properties looking for any stdClass properties.
		# Recursively apply (array).
		foreach($Class as $key => $value)
		{
			if(is_object($value)&&get_class($value)==='stdClass')
			{
				$Class[$key] = self::object_to_array($value);
			}
		}
		return $Class;
	}

	public static function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}
?>
