<?php
require_once JPATH_BASE.DS.'vitrulib/city.class.php';

$cityDTO = new City();
$cities = $cityDTO->allcities();
$selectedCity = $_REQUEST['prpcity'];
echo '<option name="Any" value="Any" '.($selectedCity == 'Any'?' selected ':'').'>Any</option>';
if(isset($cities) && count($cities) > 0)
{
	foreach($cities as $idx => $city)
	{
		echo '<option name="'.$city['Name'].'" value="'.$city['ROW_ID'].'" '.($city['ROW_ID'] === $selectedCity?' selected ':'').'>'.$city['Name'].'</option>';
	}
}