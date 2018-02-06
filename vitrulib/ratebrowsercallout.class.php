<?php
require_once 'callout.php';
require_once 'constants.php';
require_once 'city.class.php';

class RateBrowserCallout extends PhpCallout
{
	public function RateBrowserCallout($name)
	{
		$this->PhpCallout($name, VitruUtils::getServerUrl());
	}

	public function getAllCitiesRateBrowser($cities)
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "allcitiesrate";
		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();
		
		$parameters['City'] = $cities;
		
		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);

		return $response;
	}

	public function getCityRateBrowser()
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "cityrate";
		$parameters['City'] = $_REQUEST['city'];
		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();

		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);

		return $response;
	}
}
?>