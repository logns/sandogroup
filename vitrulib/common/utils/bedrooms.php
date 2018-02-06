<?php
$prpTypeReq = $_REQUEST['prptype'];
$numberOfBedrooms = $_REQUEST['beds'];
if($prpTypeReq=='Commercial' || (is_array($prpTypeReq)&&in_array('Commercial',$prpTypeReq)))
{
	echo 'Commercial property type selected.';
	return;	
}
else 
{
?>
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="1" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('1',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='1'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;1 Bedroom <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="1.5" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('1.5',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='1.5'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;1.5 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="2" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('2',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='2'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;2 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="2.5" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('2.5',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='2.5'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;2.5 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="3" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('3',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='3'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;3 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="3.5" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('3.5',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='3.5'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;3.5 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="4" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('4',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='4'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;4 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="4.5" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('4.5',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='4.5'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;4.5 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="5" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('5',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='5'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;5 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="6" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('6',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='6'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;6 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="7" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('7',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='7'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;7 Bedrooms <br class="clear">
<input class="beds" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="beds[]" value="8" onclick="javascript:submitprojecttablefrm()"
<?php echo (isset($numberOfBedrooms)?(is_array($numberOfBedrooms)?(in_array('8',$numberOfBedrooms)?'checked':''):($numberOfBedrooms=='8'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;More than 8 Bedrooms <br class="clear">
<?php 
}
?>