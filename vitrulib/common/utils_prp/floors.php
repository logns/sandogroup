<?php


if($_REQUEST['floors']){
	$floorsReq = $_REQUEST['floors'];
}else{
	$floorsReq = array();
}


?>

<input class="floors" <?php echo (in_array('-4',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="-4" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;-4
<br class="clear">
<input class="floors" <?php echo (in_array('-3',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="-3" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;-3
<br class="clear">
<input class="floors" <?php echo (in_array('-2',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="-2" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;-2
<br class="clear">
<input class="floors" <?php echo (in_array('-1',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="-1" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;-1
<br class="clear">
<input class="floors" <?php echo (in_array('0',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="0" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;Ground Floor
<br class="clear">
<input class="floors" <?php echo (in_array('1',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="1" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;1
<br class="clear">
<input class="floors"  <?php echo (in_array('2',$floorsReq) ? 'checked=""' : '');?>type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="2" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;2
<br class="clear">
<input class="floors" <?php echo (in_array('3',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="3" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;3
<br class="clear">
<input class="floors" <?php echo (in_array('4',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="4" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;4
<br class="clear">
<input class="floors" <?php echo (in_array('5',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="5" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;5
<br class="clear">
<input class="floors" <?php echo (in_array('6',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="6" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;6
<br class="clear">
<input class="floors" <?php echo (in_array('7',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="7" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;7
<br class="clear">
<input class="floors" <?php echo (in_array('8',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="8" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;8
<br class="clear">
<input class="floors" <?php echo (in_array('9',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="9" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;9
<br class="clear">
<input class="floors" <?php echo (in_array('10',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="10" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;10
<br class="clear">
<input class="floors" <?php echo (in_array('11',$floorsReq) ? 'checked=""' : '');?> type="checkbox" onchange="javascript:submitpropertytablefrm()" name="floors[]" value="11" onclick="javascript:submitpropertytablefrm()" />&nbsp;&nbsp;&nbsp;10+
<br class="clear">