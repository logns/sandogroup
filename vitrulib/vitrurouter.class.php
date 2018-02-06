<?php
require_once 'arrayutil.php';

/**
 *
 * Class containing utility methods to build and parse a SEF url,
 * this contains methods that have the encryption and decryption logic for
 * the SEF URL generation of Joomla.
 *
 * @author HARISH
 *
 */
class VitruRouter
{
	public static function buildRoute(&$query)
	{
		// if this is a click on a URL taking us to the singlepropertyfancy view
		// then use the special router meant for that.
		if(isset($query['view']) && $query['view'] == 'singlepropertyfancy')
		{
			return VitruRouter::buildPropertyRoute($query);
		}
		if(isset($query['view']) && $query['view'] == 'singleprojectphp')
		{
			return VitruRouter::buildProjectRoute($query);
		}
		// else create the route using the default algorithm meant for everything
		// other than the singlepropertyfancy
		return VitruRouter::buildAllRoute($query);
	}

	public static function parseRoute($segments)
	{
		$values = array_values($segments);
		if(ArrayUtil::isInArray('property', $values))
		{
			return VitruRouter::parsePropertyRoute($segments);
		}
		if(ArrayUtil::isInArray('project', $values))
		{
			return VitruRouter::parseProjectRoute($segments);
		}
		return VitruRouter::parseAllRoute($segments);
	}

	private static function buildPropertyRoute(&$query)
	{
		$segments = array();

		$segments[0] = 'property';
		unset($query['view']);

		$segments[1] = isset($query['neighborhood'])?$query['neighborhood']:'n';
		unset($query['neighborhood']);

		$segments[2] = $query['propertyid'];
		unset($query['propertyid']);

		return $segments;
	}

	private static function parsePropertyRoute($segments)
	{
		$vars = array();
		$vars['view'] = 'singlepropertyfancy';
		if($segments[1]!='neighborhood')
		{
			$vars['neighborhood'] = $segments[1];
		}
		$vars['propertyid'] = $segments[2];
		return $vars;
	}

	private static function buildProjectRoute(&$query)
	{
		$segments = array();

		$segments[0] = 'project';
		unset($query['view']);

		$segments[1] = isset($query['neighborhood'])?$query['neighborhood']:'n';
		unset($query['neighborhood']);

		$segments[2] = $query['projectid'];
		unset($query['projectid']);

		return $segments;
	}

	private static function parseProjectRoute($segments)
	{
		$vars = array();
		$vars['view'] = 'singleprojectphp';
		if($segments[1]!='neighborhood')
		{
			$vars['neighborhood'] = $segments[1];
		}
		$vars['projectid'] = $segments[2];
		return $vars;
	}

	private static function buildAllRoute(&$query)
	{
		$segments = array();
		foreach($query as $key => $value)
		{
			if($key == 'option'||$key == 'Itemid')
			{
				continue;
			}
			// if the value is an array then make it ; separated and add it to the segments.
			if(is_array($value))
			{
				$t = '';
				foreach($value as $i => $v)
				{
					if($t != '')
					{
						$t .= ';';
					}
					$t .= $v;
				}
				$segments[] = $key.'-'.$t;
			}
			// else add it as it is.
			else
			{
				$segments[] = $key.'-'.$value;
			}
			unset($query[$key]);
		}
		return $segments;
	}

	private static function parseAllRoute($segments)
	{
		$vars = array();
		foreach($segments as $idx => $segment)
		{
			$frstIdx = strpos($segment, ':');
			$key = substr($segment, 0, $frstIdx);
			$value = substr($segment, $frstIdx + 1);

			// if the segment contains ; it means that this was an array when we built the URL.
			// so now when we are parsing it we need to convert it to an array.
			if(strstr($value, ';'))
			{
				$vars[$key] = explode(';', $value);
			}
			// else use it as a normal value.
			else
			{
				$vars[$key] = $value;
			}
		}
		return $vars;
	}
}
?>
