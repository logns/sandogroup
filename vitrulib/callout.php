<?php
require_once( 'arrayutil.php' );
require_once( 'constants.php' );
require_once( 'socketutil.class.php' );

/**
 * This class is a proxy for the server side callout,
 * currently it offers very basic functionality in terms of only sending
 * Parameters as part of the callout invocation.
 *
 * @author HARISH
 *
 */
class PhpCallout
{
	var $name;
	var $url;
	var $reqType = 'SessionUnawareCalloutReqType';

	public function PhpCallout($name, $url)
	{
		$this->name = $name;
		$this->url = $url;
	}

	//	<CalloutDataTransferObject name="">
	//	    <Parameter name="BuilderID" value="123983289473029471329" />
	//	    <Parameter name="" value="" />
	//	</CalloutDataTransferObject>
	/**
	*
	* @param unknown_type $message
	*/
	public function execute($message, $json = true)
	{
		// callout message can only be an associative array.
		if(count($message) == 0)
		{
			throw new Exception('message on callout execute cannot be empty !');
		}
		if(!ArrayUtil::isAssociative($message))
		{
			throw new Exception('message on callout execute can only be an associative array !');
		}

		// Currently PHP callouts support only sending Parameters as part of the message.
		// Here we convert the Associative array into a CalloutDataTransferObject.
		// This is represented by a XML and is sent over the wire to our server callout.
		$xml = '';
		$xml .= '<CalloutDataTransferObject name="'.$this->name.'">';
		foreach($message as $paramName => $paramValue)
		{
			if($json)
			{
				$xml .= '<Parameter name="'.$paramName.'"><![CDATA['.json_encode($paramValue).']]></Parameter>';
			}
			else
			{
				$xml .= '<Parameter name="'.$paramName.'"><![CDATA['.$paramValue.']]></Parameter>';
			}
		}
		$xml .= '</CalloutDataTransferObject>';

		// Send the JSON object with all the necessary parameters to the server.
		$calloutResult = $this->sendMessage($xml);

		if($json)
		{
			return $calloutResult;
		}
		else
		{
			return ArrayUtil::xml2array($calloutResult);
		}
	}

	private function sendMessage($calloutMsgXml)
	{
		// Create the parameters that need to be sent as part of the post.
		$postFields = array(
			"ReqType" => $this->reqType,
			"CalloutMessageXml" => $calloutMsgXml,
			"CalloutName" => $this->name
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
}
?>
