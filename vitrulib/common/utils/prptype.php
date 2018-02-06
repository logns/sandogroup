<?php
require_once JPATH_BASE.DS.'vitrulib/lstofval.class.php';
$lstofvalDto = new ListOfValue();
$prpTypes = $lstofvalDto->listofvaluesByType('PROP_TYPE');
$prpTypeReq = $_REQUEST['prjtype'];
?>
<div class="searchchecklist"><?php 
if(isset($prpTypes))
{
	foreach($prpTypes as $index => $prpType)
	{
		echo '<input id="prjtype" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="prjtype[]" 
		value="'.$prpType['Value'].'" onclick="javascript:submitprojecttablefrm()" '.(isset($prpTypeReq)?(is_array($prpTypeReq)?(in_array($prpType['Value'],$prpTypeReq)?'checked':""):($prpTypeReq==$prpType['Value']?'checked':"")):"").'>   '.$prpType['Value'].'<br />';
	}
}
?></div>
