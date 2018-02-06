<?php
/**
 *
 * @author Hari
 *
 */
class ArrayUtil
{
	public static function isVector( &$array )
	{
		if ( !is_array($array) )
		{
			return false;
		}
		$next = 0;
		foreach ( $array as $k => $v )
		{
			if ( $k !== $next )
			{
				return false;
			}
			$next++;
		}
		return true;
	}

	public static function isAssociative($array)
	{
		if ( !is_array($array) )
		{
			return false;
		}
		foreach (array_keys($array) as $k => $v)
		{
			if ($k !== $v)
			{
				return true;
			}
		}
		return false;
	}

	public static function isInArray($v, $arr)
	{
		foreach($arr as $index => $value)
		{
			if(strcmp($value, $v) == 0)
			{
				return true;
			}
		}
		return false;
	}

	public static function xml2array($contents, $get_attributes = 1, $priority = 'attribute') {
		if(!$contents)
		{
			return array();
		}

		if(!function_exists('xml_parser_create'))
		{
			echo "'xml_parser_create()' function not found!";
			return array();
		}

		// Get the XML parser of PHP - PHP must have this module for the parser to work
		$parser = xml_parser_create('');
		xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, trim($contents), $xml_values);
		xml_parser_free($parser);

		if(!$xml_values)
		{
			return;
		}

		// Initializations
		$xml_array = array();
		$parents = array();
		$opened_tags = array();
		$arr = array();

		// Refference
		$current = &$xml_array;

		// Go through the tags.
		// Multiple tags with same name will be turned into an array
		$repeated_tag_index = array();
		foreach($xml_values as $data)
		{
			// Remove existing values, or there will be trouble
			unset($attributes,$value);
			// This command will extract these variables into the foreach scope
			// tag(string), type(string), level(int), attributes(array).
			// We could use the array by itself, but this cooler.
			extract($data);
			$result = array();
			$attributes_data = array();
			if(isset($value))
			{
				if($priority == 'tag')
				{
					$result = $value;
				}
				else
				{
					// Put the value in a assoc array if we are in the 'Attribute' mode
					$result['value'] = $value;
				}
			}
			// Set the attributes too.
			if(isset($attributes) and $get_attributes)
			{
				foreach($attributes as $attr => $val)
				{
					if($priority == 'tag')
					{
						$attributes_data[$attr] = $val;
					}
					else
					{
						// Set all the attributes in a array called 'attr'
						$result['attr'][$attr] = $val;
					}
				}
			}
			//See tag status and do the needed.
			//The starting of the tag '<tag>'
			if($type == "open")
			{
				$parent[$level-1] = &$current;
				//Insert New tag
				if(!is_array($current) or (!in_array($tag, array_keys($current))))
				{
					$current[$tag] = $result;
					if($attributes_data)
					{
						$current[$tag. '_attr'] = $attributes_data;
					}
					$repeated_tag_index[$tag.'_'.$level] = 1;
					$current = &$current[$tag];
				}
				// There was another element with the same tag name
				else
				{
					//If there is a 0th element it is already an array
					if(isset($current[$tag][0]))
					{
						$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
						$repeated_tag_index[$tag.'_'.$level]++;
					}
					// This section will make the value an array if multiple tags with the same name appear together
					else
					{
						// This will combine the existing item and the new item together to make an array
						$current[$tag] = array($current[$tag],$result);
						$repeated_tag_index[$tag.'_'.$level] = 2;
						// The attribute of the last(0th) tag must be moved as well
						if(isset($current[$tag.'_attr']))
						{
							$current[$tag]['0_attr'] = $current[$tag.'_attr'];
							unset($current[$tag.'_attr']);
						}
					}
					$last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
					$current = &$current[$tag][$last_item_index];
				}
			}
			// Tags that ends in 1 line '<tag />'
			elseif($type == "complete")
			{
				// See if the key is already taken.
				// New Key
				if(!isset($current[$tag]))
				{
					$current[$tag] = $result;
					$repeated_tag_index[$tag.'_'.$level] = 1;
					if($priority == 'tag' and $attributes_data)
					{
						$current[$tag. '_attr'] = $attributes_data;
					}
				}
				// If taken, put all things inside a list(array)
				else
				{
					// If it is already an array...
					if(isset($current[$tag][0]) and is_array($current[$tag]))
					{
						// ...push the new element into that array.
						$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
						if($priority == 'tag' and $get_attributes and $attributes_data)
						{
							$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
						}
						$repeated_tag_index[$tag.'_'.$level]++;

					}
					// If it is not an array...
					else
					{
						//...Make it an array using using the existing value and the new value
						$current[$tag] = array($current[$tag],$result);
						$repeated_tag_index[$tag.'_'.$level] = 1;
						if($priority == 'tag' and $get_attributes)
						{
							// The attribute of the last(0th) tag must be moved as well
							if(isset($current[$tag.'_attr']))
							{
								$current[$tag]['0_attr'] = $current[$tag.'_attr'];
								unset($current[$tag.'_attr']);
							}
							if($attributes_data)
							{
								$current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
							}
						}
						// 0 and 1 index is already taken
						$repeated_tag_index[$tag.'_'.$level]++;
					}
				}
			}
			//End of tag '</tag>'
			elseif($type == 'close')
			{
				$current = &$parent[$level-1];
			}
		}
		return($xml_array);
	}
}
?>
