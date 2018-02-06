<?php
$prpTransTypeReq = $_REQUEST['prptranstype'];
?>
<input class="prptranstype"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	onclick="javascript:submitpropertytablefrm()"
	value="Outright"
<?php echo (isset($prpTransTypeReq)?(is_array($prpTransTypeReq)?(in_array('Outright',$prpTransTypeReq)?'checked':""):($prpTransTypeReq=='Outright'?'checked':"")):"");?>
	name="prptranstype[]" />
&nbsp;&nbsp;&nbsp;Buy
<br class="clear">
<input class="prptranstype"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	onclick="javascript:submitpropertytablefrm()"
	value="Lease"
<?php echo (isset($prpTransTypeReq)?(is_array($prpTransTypeReq)?(in_array('Lease',$prpTransTypeReq)?'checked':""):($prpTransTypeReq=='Lease'?'checked':"")):"");?>
	name="prptranstype[]" />
&nbsp;&nbsp;&nbsp;Rent
<br class="clear">
