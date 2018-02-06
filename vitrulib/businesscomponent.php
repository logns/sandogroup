<?php
require_once( 'arrayutil.php' );
require_once( 'constants.php' );
require_once( 'socketutil.class.php' );

/**
 *
 * @author Hari
 *
 */
class PhpBusinessComponent
{
	var $name;
	var $url;
	var $reqType = 'WebJsonRequest';

	public function PhpBusinessComponent($name, $url)
	{
		$this->name = $name;
		$this->url = $url;
	}

	public function select($set = array(), $predicate = array(), $sortspec = array(), $pagenav = array())
	{
		// While selecting, projection has to be a vector.
		if(count($set) != 0 && !ArrayUtil::isVector($set))
		{
			throw new Exception('projection on select operation can only be a vector array !');
		}

		// While selecting, predicate has to be an associative array.
		if(count($predicate) != 0 && !ArrayUtil::isAssociative($predicate))
		{
			throw new Exception('predicate on select operation can only be an associative array !');
		}

		// While selecting, predicate has to be an associative array.
		if(count($sortspec) != 0 && !ArrayUtil::isAssociative($sortspec))
		{
			throw new Exception('sort spec on select operation can only be an associative array !');
		}

		// While selecting, predicate has to be an associative array.
		if(count($pagenav) != 0 && !ArrayUtil::isAssociative($pagenav))
		{
			throw new Exception('page navigation on select operation can only be an associative array !');
		}

		$jsSet = PhpBusinessComponent::encodeSet($set);
		$jsPredicate = PhpBusinessComponent::encodePredicate($predicate);
		$jsSortSpec = PhpBusinessComponent::encodeSortSpec($sortspec);
		$jsPageNav = PhpBusinessComponent::encodePageNav($pagenav);

		// Send the JSON object with all the necessary parameters to the server.
		$jsRecords = $this->sendMessage('select', $jsSet, $jsPredicate, $jsSortSpec, $jsPageNav);

		return json_decode($jsRecords, true);
	}

	public function insert($set)
	{
		// See if the variable that has been sent is an associative array.
		// If not then throw an exception.
		if(!ArrayUtil::isAssociative($set))
		{
			throw new Exception('insert operation can only be associative array !');
		}

		// Convert the associative array to a JSON object.
		$jsFieldSet = PhpBusinessComponent::encodeSet($set);

		// Send the JSON object with all the necessary parameters to the server.
		$jsRecord = $this->sendMessage('insert', $jsFieldSet);

		return json_decode($jsRecord, true);
	}

	public function update($set, $predicate)
	{
		// While selecting, projection has to be a vector.
		if(!ArrayUtil::isAssociative($set))
		{
			throw new Exception('fieldset on update operation can only be a associative array !');
		}

		// While selecting, predicate has to be an associative array.
		if(!ArrayUtil::isAssociative($predicate))
		{
			throw new Exception('predicate on update operation can only be an associative array !');
		}

		$jsSet = PhpBusinessComponent::encodeSet($set);
		$jsPredicate = PhpBusinessComponent::encodePredicate($predicate);

		// Send the JSON object with all the necessary parameters to the server.
		$jsRecords = $this->sendMessage('update', $jsSet, $jsPredicate);

		return json_decode($jsRecords, true);
	}

	public function delete($predicate)
	{
		// While selecting, predicate has to be an associative array.
		if(!ArrayUtil::isAssociative($predicate))
		{
			throw new Exception('predicate on delete operation can only be an associative array !');
		}

		$jsPredicate = PhpBusinessComponent::encodePredicate($predicate);

		// Send the JSON object with all the necessary parameters to the server.
		$jsRecords = $this->sendMessage('delete', '', $jsPredicate);

		return json_decode($jsRecords, true);
	}

	private function sendMessage($operation, $jsSet = '', $jsPredicate = '', $jsSortSpec = '', $jsPageNav = '')
	{
		// Create the parameters that need to be sent as part of the post.
		$postFields = array(
				"ReqType" => $this->reqType,
				"Operation" => $operation,
				"BusComp" => $this->name,
				"FieldSet" => $jsSet,
				"FieldPredicate" => $jsPredicate,
				"FieldSortSpec" => $jsSortSpec,
				"PageNavigation" => $jsPageNav
		);

		if(VitruUtils::httpSupported())
		{
			return VitruSocketUtil::sendUsingHttp($postFields, $this->url);
		}
		else
		{
			return VitruSocketUtil::sendUsingSocket($postFields, $this->url);
		}
	}

	private static function encodePageNav($pagenav)
	{
		if(count($pagenav) == 0)
		{
			return '';
		}
		return json_encode($pagenav);
	}

	private static function encodeSortSpec($sortspec)
	{
		if(count($sortspec) == 0)
		{
			return '';
		}
		return '{FieldSortSpec:' . json_encode($sortspec) . '}';
	}

	private static function encodeSet($set)
	{
		if(count($set) == 0)
		{
			return '';
		}
		return '{FieldSet:' . json_encode($set) . '}';
	}

	private static function encodePredicate($predicate)
	{
		// See if the predicate associative array is completely empty.
		if(count($predicate) == 0)
		{
			return '';
		}
		// See if there are any fields present in the predicate.
		$fieldSet = $predicate['FieldSet'];
		if(count($fieldSet) == 0)
		{
			return '';
		}
		$bitMap = $predicate['BitMap'];
		return '{FieldPredicate:{FieldSet:' . json_encode($fieldSet) . ', BitMap:"' . $bitMap . '"}}}';
	}
}
?>
