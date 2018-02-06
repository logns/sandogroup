<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

/**
 *
 * @author Hari
 *
 */
class Area extends PhpBusinessComponent
{
	public function Area($name = 'Area_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function areas($cityRIDs)
	{
		$predicate = array('FieldSet'=>array(),'BitMap'=>'');
		if(isset( $cityRIDs ))
		{
			$fieldSet = array();
			$temp = '';
			//if(stristr($cityRIDs, ',') === FALSE) {
			//   $cityRIDsArray = $cityRIDs;
		  	//}
		  	//else{
		  	
			if (strpos($cityRIDs, ","))
			{
				$cityRIDsArray = explode(",",$cityRIDs);
			}
			elseif(is_array($cityRIDs)){
				$cityRIDsArray = $cityRIDs;
			}
			else{
				$cityRIDsArray[] = $cityRIDs;
			}
		  	   
		  	//}
			
			foreach($cityRIDsArray as $idx => $value)
			{
				if(!empty($temp))
				{
					$temp .= '||';
				}
				$temp .= 'CITY_ID = ?';
				$fieldset[] = $value;
			}
			$bitmap = '('.$temp.')';
			$predicate = array('FieldSet'=>$fieldset,'BitMap'=>$bitmap);
		}
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('Name' => 'ASC'));
		return $records['Record'];
	}

	public function defaultareas()
	{
		$cityDto = new City();
		$predicate = array('FieldSet'=>array($cityDto->defaultCity), 'BitMap'=>'CityName=?');

		// form the predicate to query for areas based on the default city.
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('Name' => 'ASC'));

		// return only the data.
		return $records['Record'];
	}

        public function getAreaNameById($areaID)
        {
                if($areaID)
                {
                        $areas = $this->allareas();
                        foreach($areas as $idx => $area)
                        {
                                if($area['ROW_ID'] === $areaID)
                                {
                                        return $area['Name'];
                                }
                        }
                }
        }

        public function getAreaIdByName($areaName)
        {
                if($areaName)
                {
                        $areas = $this->allareas();
                        foreach($areas as $idx => $area)
                        {
                                if($area['Name'] === $areaName)
                                {
                                        return $area['ROW_ID'];
                                }
                        }
                }
        }


	public function allareas()
	{
		// form the predicate for all cities.
		$records = $this->select(array(), VitruUtils::addAppID(array()), array('Name' => 'ASC'));

		// return only the data.
		return $records['Record'];
	}

	// locality browser
	public static function getAreaPage($areaName, $cityName)
	{
		$itemid = VitruUtils::getItemID('real-estate-in-india');
		return 'index.php?option=com_localitybrowser&view=area&city='.urlencode($cityName).'&area='.urlencode($areaName).'&Itemid='.$itemid;
	}
	
	// locality browser
	public static function getCityPage($cityName)
	{
		$itemid = VitruUtils::getItemID('real-estate-in-india');
		return 'index.php?option=com_localitybrowser&view=city&city='.urlencode($cityName).'&Itemid='.$itemid;
	}
	
	public static function getAreasDropDown($city){
		
		$areas = new self;
		$areas = $areas->areas($city);
		foreach($areas as $Idx => $area){
			
			echo '<option name="'.$area['Name'].'" value="'.$area['ROW_ID'].'">'.$area['Name'].'</option>';
			
		}
		
	}
}
?>
