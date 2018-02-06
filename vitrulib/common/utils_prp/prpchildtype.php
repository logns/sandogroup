<?php
require_once JPATH_BASE.DS.'vitrulib/lstofval.class.php';
$lstofvalDto = new ListOfValue();
$prpTypeReq = $_REQUEST['prptype'];
$prpTypes = $lstofvalDto->listofvaluesByType('PROP_TYPE');

if(!isset($prpTypeReq)&&empty($prpTypeReq))
{
	echo 'Please select property type first.';
	return;	
}
elseif(isset($prpTypes))
{
	foreach($prpTypes as $index => $prpType)
	{
		if(in_array($prpType['Value'],$prpTypeReq))
		{
			$prpRowId = $prpType['ROW_ID'];
			break;
		}
	}
}
$prpChildTypes = $lstofvalDto->listofvaluesByParent('PROP_SUB_TYPE', $prpRowId);
$prpChildTypeReq = $_REQUEST['prpchildtype'];
 
if(isset($prpChildTypes))
{
	foreach($prpChildTypes as $index => $prpChildType)
	{
		echo '<input class="prpchildtype" type="checkbox" onchange="javascript:submitpropertytablefrm()" name="prpchildtype[]" 
		value="'.$prpChildType['Value'].'" onclick="javascript:submitpropertytablefrm()" '.(isset($prpChildTypeReq)?(is_array($prpChildTypeReq)?(in_array($prpChildType['Value'],$prpChildTypeReq)?'checked':""):($prpChildTypeReq==$prpChildType['Value']?'checked':"")):"").'>&nbsp;&nbsp;&nbsp;'.$prpChildType['Value'].' <br class="clear">';
	}
}
?>