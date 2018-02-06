<?php
require_once JPATH_BASE.DS.'vitrulib/area.class.php';

// load all the areas, for a given city.
$areaDto = new Area();

if(isset($_REQUEST['prjcity']) && $_REQUEST['prjcity'] != 'Any')
{
	$areas = $areaDto->areas($_REQUEST['prjcity']);
}
else
{
	echo 'Please select a city first.';
	return;	
}

// Areas which will be marked selected are based only on previous form submissions.
$t = $_REQUEST['prjarea'];
if(isset($areas))
{
	foreach($areas as $index => $area)
	{
		
		if(isset($t)){
			if(is_array($t)){
				foreach($t as $areaSelected){
					if($area['ROW_ID'] === $areaSelected){
						$check = 'checked';
						break;
					}else{
						$check = '';
					}
				}
			}elseif($t === $area['ROW_ID']){
				$check = 'checked';
			}else{
				$check = '';
			}
		}
		
		echo '<input class="prjarea" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="prjarea[]" 
		value="'.$area['ROW_ID'].'" onclick="javascript:submitpropertytablefrm()" '.$check.'>&nbsp;&nbsp;&nbsp;'.$area['Name'].' <br class="clear">';
	}
}
?>
