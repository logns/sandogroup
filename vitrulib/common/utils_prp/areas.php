<?php
require_once JPATH_BASE.DS.'vitrulib/area.class.php';

// load all the areas, for a given city.
$areaDto = new Area();

if(isset($_REQUEST['prpcity']) && $_REQUEST['prpcity'] != 'Any')
{
	$areas = $areaDto->areas($_REQUEST['prpcity']);
}
else
{
	echo 'Please select a city first.';
	return;	
}

// Areas which will be marked selected are based only on previous form submissions.
$t = $_REQUEST['prparea'];
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
		
		echo '<input class="prparea" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="prparea[]" 
		value="'.$area['ROW_ID'].'" onclick="javascript:submitpropertytablefrm()" '.$check.'>&nbsp;&nbsp;&nbsp;'.$area['Name'].' <br class="clear">';
	}
}
?>
