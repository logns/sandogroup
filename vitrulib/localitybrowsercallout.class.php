<?php
require_once 'callout.php';
require_once 'constants.php';

class LocalityBrowserCallout extends PhpCallout
{
	public function LocalityBrowserCallout($name = "LocalityBrowserCallout")
	{
		$this->PhpCallout($name, VitruUtils::getServerUrl());
	}

	public function getCities()
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "allcities";
		$appID = VitruUtils::getAppID();
		if(!empty($appID))
		{
			$parameters['APPLICATION_ID'] = VitruUtils::getAppID();
		}
		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);
		return $response;
	}

	public function getAreasInCity($city)
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "city";
		$parameters['City'] = $city;
		$appID = VitruUtils::getAppID();
		if(!empty($appID))
		{
			$parameters['APPLICATION_ID'] = VitruUtils::getAppID();
		}
		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);
		return $response;
	}

	public function getAreasInRegion($city, $region)
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "region";
		$parameters['City'] = $city;
		$parameters['Region'] = $region;
		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();
		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);
		return $response;
	}

	public function getArea($area, $region, $city)
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "area";
		$parameters['Area'] = $area;
		$parameters['Region'] = $region;
		$parameters['City'] = $city;
		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();
		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);
		return $response;
	}
	
	public static function getCityDropDown(){
		$response = new self;
		$response = $response->getCities();
		echo '<option value="any">Any</option>';
		foreach($response->CityRecords->Record as $Idx => $city){
			
			echo '<option name="'.$city->NAME.'" value="'.$city->ROW_ID.'">'.$city->NAME.'</option>';
			
		}
	}
}
?>
