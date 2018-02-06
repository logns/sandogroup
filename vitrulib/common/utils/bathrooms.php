<?php
$prpTypeReq = $_REQUEST['prptype'];
$numberOfBathrooms = $_REQUEST['bathrooms'];
if($prpTypeReq=='Commercial' || (is_array($prpTypeReq)&&in_array('Commercial',$prpTypeReq)))
{
	echo 'Commercial property type selected.';
	return;	
}
else 
{
?>
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="1" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('1',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='1'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;1 Bathroom <br class="clear">
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="2" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('2',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='2'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;2 Bathrooms <br class="clear">
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="3" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('3',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='3'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;3 Bathrooms <br class="clear">
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="4" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('4',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='4'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;4 Bathrooms <br class="clear">
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="5" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('5',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='5'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;5 Bathrooms <br class="clear">
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="6" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('6',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='6'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;6 Bathrooms <br class="clear">
<input class="bathrooms" type="checkbox" onchange="javascript:submitpropertytablefrm()"
	name="bathrooms[]" value="7" onclick="javascript:submitpropertytablefrm()"
<?php echo (isset($numberOfBathrooms)?(is_array($numberOfBathrooms)?(in_array('7',$numberOfBathrooms)?'checked':''):($numberOfBathrooms=='7'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;7 Bathrooms <br class="clear">
<?php 
}
?>