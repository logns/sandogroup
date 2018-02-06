<?php
require_once 'businesscomponent.php';
require_once 'constants.php';
require_once 'loginmanager.class.php';
require_once 'area.class.php';

class Property extends PhpBusinessComponent
{
	public function Property($name = 'WebProperty_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function properties($set = array(), $predicate = array(), $sortspec = array(), $pagenav = array())
	{
		$fieldset = $predicate['FieldSet'];
		$bitmap = $predicate['BitMap'];

		// create the bitmap.
		$predicate = array('FieldSet'=>$fieldset,'BitMap'=>$bitmap);

		// fire the query.
		return $this->select($set, VitruUtils::addAppID($predicate), array('LAST_UPD' => 'DESC'), $pagenav);
	}

	public function propertiesByRID($prpids)
	{
		$fieldset = array('Yes');
		$bitmap = 'PushToWebsite = ?&&';

		// form the predicate contributed by the row_ids
		if(isset($prpids)&&!empty($prpids))
		{
			$temp = '';
			foreach($prpids as $k => $v)
			{
				if(!empty($temp))
				{
					$temp .= '||';
				}
				$temp .= 'ROW_ID = ?';
				$fieldset[] = $v;
			}
			$bitmap = $bitmap.'('.$temp.')';
		}
		$bitMap = rtrim($bitMap,"&");

		// form the predicate
		$predicate = array('FieldSet'=>$fieldset, 'BitMap'=>$bitmap);

		// fire the query.
		$records = $this->select(array(), VitruUtils::addAppID($predicate));

		// return only the data.
		return $records['Record'];
	}

	public function hotProperties($type, $txntype, $pagesize = 15)
	{
		$fieldset = array('Yes','Yes');
		$bitmap = 'PropertyHotOrNot=?&&PushToWebsite = ?';
		$pagespec = array("PageSize" => $pagesize, "Window" => 0);
		if(isset($type))
		{
			$fieldset[] = $type;
			$bitmap .= '&&PropertyType=?';
		}
		//		if(isset($txntype))
		//		{
		//			$fieldset[] = $txntype;
		//			$fieldset[] = 'Either';
		//			$bitmap .= '&&(PropertyTransactionType=?||PropertyTransactionType=?)';
		//		}
		$predicate = array('FieldSet'=>$fieldset,'BitMap'=>$bitmap);
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('LAST_UPD' => 'DESC'), $pagespec);
		return $records['Record'];
	}

	public static function generateTitle($property)
	{
		// set the title and meta tags
		VitruUtils::setTitle($property['Neighbourhood']);
	}

	public static function generateMetaTags($property)
	{
		// set the description meta tag.
		$description = $property['PropertyWebsiteTitle'].', '.$property['PropertyWebsiteDescription'];
		VitruUtils::addMetaTag('description', $description);

		// set the title meta tag.
		VitruUtils::addMetaTag('title', $property['Neighbourhood']);
	}

	public static function propertyTitle($property, $areaFlag=false, $html=true)
	{
		$title = '';
		$areaname = '';
		$type = $property['PropertyType'];

		if($areaFlag)
		{
			$areaname = '<a href="'.Area::getAreaPage($property['AreaName'],($property['RegionName'] == 'All Bengaluru' ? 'All Bangalore' : $property['RegionName']),($property['CityName'] == 'Bengaluru' ? 'Bangalore' : $property['CityName'])).'" class="midtextlink" title="'.$property['AreaName'].'">'.$property['AreaName'].'</a>';
		}
		else
		{
			$areaname = $property['AreaName'];
		}
		if($type == 'Residential')
		{
			$bedrooms = $property['NumberOfBedrooms'];
			if($bedrooms == 0)
			{
				$title = 'Studio Apartment ' . (isset($property['AreaName'])?('in '.$areaname):(' in '.$property['CityName']));
			}
			else
			{
				$title = $bedrooms . ' Bedroom, Residential Apartment ' . (isset($property['AreaName'])?(' in '.$areaname):(' in '.$property['CityName']));
			}
		}
		else
		{
			$title = $property['PropertyChildType'] . (isset($property['AreaName'])?(' in '.$areaname):(' in '.$property['CityName']));
		}

		if($property['PropertyTransactionType'] == 'Outright')
		{
			$title .= ' for Sale';
		}
		if($property['PropertyTransactionType'] == 'Lease')
		{
			$title .= ' for Lease';
		}
		if($property['PropertyTransactionType'] == 'Either')
		{
			$title .= ' for Sale/Lease';
		}
		return $title;
	}

	public static function detailPage($property, $absolute = false, $view = 'detail')
	{
		$detailPage = '';
		$itemid = VitruUtils::getItemID('properties');
		if($absolute)
		{
			$detailPage = JURI::root();
		}
		if(isset($itemid))
		{
			$detailPage .= 'index.php?option=com_rrsearch&view='.$view.'&Itemid='.$itemid;
		}
		else
		{
			$detailPage .= 'index.php?option=com_rrsearch&view='.$view;
		}
		// if this flag has been set to true then we add th extra parameters used by the property component
		// router to create the SEF URL's.
		if(VitruUtils::seoEnabled())
		{
			//			$detailPage .= (!isset($property['BuilderCompanyName']) || empty($property['BuilderCompanyName']) ? '' : '&b='.urlencode($property['BuilderCompanyName']));
			$detailPage .= (!isset($property['Neighbourhood']) || empty($property['Neighbourhood']) ? '' : '&p='.urlencode($property['Neighbourhood']));
			$detailPage .= (!isset($property['AreaName']) || empty($property['AreaName']) ? '&a='.urlencode($property['CityName']) : '&a='.urlencode($property['AreaName']));
		}
		$detailPage .= '&propertyid='.$property['ROW_ID'];
		return $detailPage;
	}

	public function propertyIDsearch($prpid)
	{
		$fieldset = $prpid;
		$bitmap = 'PropertyID=?';
		$predicate = array('FieldSet'=>$fieldset,'BitMap'=>$bitmap);
		$records = $this->select(array(), VitruUtils::addAppID($predicate));
		return $records['Record'];
	}

	//Properties listing title function
	public static function propertyListingTitle($property, $html = true)
	{
		$title = '';
		$areaname = '';
		$type = $property['PropertyType'];


		$areaname = $property['AreaName'];
		if($type == 'Residential')
		{
			$bedrooms = $property['NumberOfBedrooms'];
			if($bedrooms == 0)
			{
				$title = 'Studio Apartment ' . (isset($property['AreaName'])?('in '.$areaname):(' in '.$property['CityName']));
			}
			else
			{
				$title = $bedrooms . ' Bedroom, Residential Apartment ' . (isset($property['AreaName'])?(' in '.$areaname):(' in '.$property['CityName']));
			}
		}
		else
		{
			$title = $property['PropertyChildType'] . (isset($property['AreaName'])?(' in '.$areaname):(' in '.$property['CityName']));
		}

		if($property['PropertyTransactionType'] == 'Outright')
		{
			$title .= ' for Sale';
		}
		if($property['PropertyTransactionType'] == 'Lease')
		{
			$title .= ' for Lease';
		}
		if($property['PropertyTransactionType'] == 'Either')
		{
			$title .= ' for Sale/Lease';
		}

		if(strlen($title) > 70){
			$shorttitle = substr($title, 0, 70).'...';

		}
		else
		{
			$shorttitle = $title;
		}
		$titleLink = '<a href="'.Property::detailPage($property).'" title="'.$title.'">'.$shorttitle.'</a>';
		if($html){
			return $titleLink;
		}else{
			return $title;
		}
	}

	public static function propertyAddress($property)
	{
		if(isset($property['GoogleAddress']) && !empty($property['GoogleAddress']))
		{
			return $property['GoogleAddress'];
		}
		// form the address ourself.
		else
		{
			return self::defaultAddress($property);
		}
	}

	private static function defaultAddress($property)
	{
		$address = '';
		$address.=((isset($property['LocalityName']) && !empty($property['LocalityName'])) ? ($property['LocalityName'].', ') : '');
		$address.=((isset($property['AreaName']) && !empty($property['AreaName'])) ? ($property['AreaName'].', ') : '');
		$address.=((isset($property['RegionName']) && !empty($property['RegionName'])) ? ($property['RegionName'].', ') : '');
		$address.=((isset($property['CityName']) && !empty($property['CityName'])) ? ($property['CityName'].', ') : '');
		$address.=((isset($property['propertyZip']) && !empty($property['propertyZip'])) ? ($property['propertyZip'].', ') : '');
		$address = rtrim(rtrim($address, ' '), ',');
		$address.=(', India');
		return $address;
	}

}
?>
