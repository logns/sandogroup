<?php


if($_REQUEST['furnitues']){
	$furnituesReq = $_REQUEST['furnitues'];
}else{
	$furnituesReq = array();
}


?>
<input class="furnitues" <?php echo (in_array('Un-furn',$furnituesReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="furnitues[]" value="Un-furn" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;Un-Furnished
<br class="clear">
<input class="furnitues" <?php echo (in_array('Semi-furn',$furnituesReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="furnitues[]" value="Semi-furn" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;Semi-Furnished
<br class="clear">
<input class="furnitues" <?php echo (in_array('Furnished',$furnituesReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="furnitues[]" value="Furnished" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;Furnished
<br class="clear">
<input class="furnitues" <?php echo (in_array('Not Specified',$furnituesReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="furnitues[]" value="Not Specified" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;Not Specified
<br class="clear">