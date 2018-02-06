<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class PrpQuickContact
{
	public function render($propertyId, $propertyName)
	{
?>
<div id="quickcontact">
<p class="quick_contact_heading">Are you interested? Request a callback</p>
<form name="prpquickcontact" id="prpquickcontact" action="index.php"
	method="get" onsubmit="return false;">
<div id="qckfields">
<p>Please complete the form below to request a Site Visit for this
property. We will review your request and will get in touch with you
shortly.</p>
<label for="">Name: <span class="red">*</span></label> <input
	type="text" name="Name" class="required" /> <label for="">Mobile No: <span
	class="red">*</span></label> <input type="text" name="Mobile"
	class="required number" /> <label for="">Email ID: <span class="red">*</span></label>
<input type="text" name="EmailID" class="required email" />
<p id="responseText"></p>
</div>
<div id="qckbuttons"><input type="button" class="submit" id="button"
	value="Submit"
	onclick="javascript:formSubmit('prpquickcontact','responseText');" />&nbsp;&nbsp;
<input type="button" class="reset" id="button" value="Reset"
	onclick="javascript:resetFormFields('prpquickcontact');" /></div>
<input type="hidden" name="propertyid"
	value="<?php echo $propertyId; ?>" /> <input type="hidden"
	name="propertyname"
	value="<?php echo $propertyName; ?>" /> <input
	type="hidden" name="format" value="raw" /> <input type="hidden"
	name="task" value="quickreqashowing" /> <input type="hidden"
	name="view" value="detail" /> <input type="hidden"
	name="option" value="com_rrsearch" /> <input type="hidden"
	name="Itemid" value="<?=$_REQUEST['Itemid'];?>" /></form>
</div>
<?php 
	}
}
?>