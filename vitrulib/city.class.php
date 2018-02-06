<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

/**
 *
 * @author Hari
 *
 */
class City extends PhpBusinessComponent
{
	public $defaultCity = 'Mumbai';

	public function City($name = 'City_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function defaultcity($attribute = '')
	{
		$predicate = array('FieldSet'=>array($this->defaultCity), 'BitMap'=>'Name=?');

		// form the predicate for the default city.
		$records = $this->select(array(), VitruUtils::addAppID($predicate));

		if(!isset($attribute) || empty($attribute))
		{
			return $records['Record'];
		}
		else
		{
			return $records['Record'][0][$attribute];
		}
	}

	public function allcities()
	{
		// form the predicate for all cities.
		$records = $this->select(array(), VitruUtils::addAppID(array()), array('Name' => 'ASC'));

		// return only the data.
		return $records['Record'];
	}

	//Function added for Locality Browser
	public static function getCityPage($cityID)
	{
		$itemid = VitruUtils::getItemID('projects');
		return 'index.php?option=com_projectsearch&view=listing&prjcity='.urlencode($cityID).'&Itemid='.$itemid;
	}

	public static function getLocalityBrowserCityPage($cityName)
	{
		$itemid = VitruUtils::getItemID('real-estate-in-india');
		return 'index.php?option=com_localitybrowser&view=city&city='.$cityName.'&Itemid='.$itemid;
	}

	public function getCityNameById($cityID)
	{
		if($cityID)
		{
			$cities = $this->allcities();
			foreach($cities as $idx => $city)
			{
				if($city['ROW_ID'] === $cityID)
				{
					return $city['Name'];
				}
			}
		}
	}

	public function getCityIdByName($cityName)
	{
		if($cityName)
		{
			$cities = $this->allcities();
			foreach($cities as $idx => $city)
			{
				if($city['Name'] === $cityName)
				{
					return $city['ROW_ID'];
				}
			}
		}
	}
}
?>
