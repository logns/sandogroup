<?php
require_once JPATH_BASE.DS.'components/com_vprospectgen/controller.php';
class callBackRenderer{

	public static function footerCta(){
		?>
		<form id="component-cta" name="component-cta" onsubmit="return false;">
			<p>Looking to buy a property?</p>
			<input type="text" name="Name" value="Name:" class="required name default-value">
			<input type="text" name="Mobile" value="Mobile" class="required number default-value">
			<input type="text" name="EmailID" value="E-Mail" class="required email default-value">
			<!--
			<select id="city" name="city" onchange="javascript:changeArea('city','area');">
				<?php //VProspectgenController::getCityList();?>
			</select>
			<select id="area" name="area">
				<?php //VProspectgenController::getAreaList();?>
			</select>
			-->
                        <input type="text" name="Comments" class="default-value" value="City"/>
			<input type="submit" value="Submit" onclick="javascript:formSubmit('component-cta', 'response-text');" class="bttnstyle" >
			<p id="response-text"></p>
			<input type="hidden" value="callback" name="task">
			<input type="hidden" value="basic" name="view">
			<input type="hidden" value="com_vprospectgen" name="option">
			<input type="hidden" value="" name="Itemid">
			<input type="hidden" value="raw" name="format">
		</form>
		<?php
		
	}
}