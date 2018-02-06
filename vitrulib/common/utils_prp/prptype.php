<?php
require_once JPATH_BASE.DS.'vitrulib/lstofval.class.php';
$lstofvalDto = new ListOfValue();
$prpTypes = $lstofvalDto->listofvaluesByType('PROP_TYPE');
$prpTypeReq = $_REQUEST['prptype'];
 
if(isset($prpTypes))
{
	foreach($prpTypes as $index => $prpType)
	{
		echo '<input class="prptype" type="checkbox" onchange="javascript:submitpropertytablefrm()" name="prptype[]" 
		value="'.$prpType['Value'].'" onclick="javascript:submitpropertytablefrm()" '.(isset($prpTypeReq)?(is_array($prpTypeReq)?(in_array($prpType['Value'],$prpTypeReq)?'checked':""):($prpTypeReq==$prpType['Value']?'checked':"")):"").'>&nbsp;&nbsp;&nbsp;'.$prpType['Value'].' <br class="clear">';
	}
}
?>
