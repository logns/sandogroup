<?php
require_once 'callout.php';
require_once 'constants.php';


class PropertyProjectCountCallout extends PhpCallout
{
	public function PropertyProjectCountCallout($name = 'PropertyProjectCountCallout')
	{
		$this->PhpCallout($name, VitruUtils::getServerUrl());
	}

	public function getCount(){

		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();

		$response = $this->execute($parameters);
		$response = json_decode($response);

		return $response;

	}
}