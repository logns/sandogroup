<?php
defined('_JEXEC') or die('Restricted access');

?>

<div id="sidePanel" style="right:-200px;">
		<div id="panelContent">
			<div class="rightCta">
				<p style="text-align: center;font-weight:bold;">Please fill the form below for an instant callback !</p>
				<form onsubmit="return false;" id="rightCta">
					<input type="text" class="default-value required name" name="Name" value="Name">
					<input type="text" class="default-value required number"  name="Mobile" value="Mobile">
 					<input type="text" class="default-value required email"  name="EmailID" value="Email">
					<!-- <input type="text" class="default-value" value="Country" name="Country"> -->
                                        <?php echo helperClass::renderCountryCode('rightCta-CountryCode'); ?>
					<input type="text" class="default-value" value="City" name="City">
					<input type="hidden" name="Source" value="Click to Call">
					<input type="hidden" value="com_vprospectgen" name="option">
					<input type="hidden" value="callback" name="task">
					<input type="hidden" value="tmpl" name="format">
					<input type="submit" onclick="formSubmit('rightCta','responseDiv');" class="btn" value="Call Me" />
                                        
                                        <p id="responseDiv"></p>
				</form>
			</div>
		</div>
		<div id="panelHandle">&nbsp;</div>
</div>
