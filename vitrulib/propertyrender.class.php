<?php
require_once 'attachment.class.php';

class PropertyRender
{
	public static function renderProperty($property)
	{
		?>
<div
	class="singleproperty">
<div class="singleproperty-title"><span class="property_title"><?php echo Property::propertyListingTitle($property,true,false); ?></span>
</div>
<div class="image"><a
	href="<?php echo Property::detailPage($property);?>"><img alt=""
	src="<?php echo Attachment::attachmenturlbypath($property['ThumbnailSaveFilePath'], $property['FilePath'])?>" /></a>
<div class="ruppee_text"><?php 
if(!empty($property['Cost']))
{
	if($property['Cost'] == '0' || $property['Cost'] == '0.0')
	{
		echo 'Price on Request';
	}
	else
	{
		echo $property['Cost'];
	}
}
elseif(!empty($property['Rent']))
{
	if($property['Rent'] == '0' || $property['Rent'] == '0.0')
	{
		echo 'Price on Request';
	}
	else
	{
		echo $property['Rent'];
	}
}
else
{
	echo 'Price on Request';
}
?></div>
</div>
<!-- Image Ends Here -->
<div class="propertyinfo"><?php 
if(isset($property['PropertyWebsiteDescription']) && !empty($property['PropertyWebsiteDescription']))
{
	if(strlen($property['PropertyWebsiteDescription']) > 100){
		$shortPropertyDesc = substr($property['PropertyWebsiteDescription'], 0, 100);
	}else{
		$shortPropertyDesc = $property['PropertyWebsiteDescription'];
	}
	echo '<p class="listing_desc">'.strip_tags($shortPropertyDesc).'...<a href="'.Property::detailPage($property).'" style="color:#575757;">Read More</a></p>';
}
?>

<p class="text">Property ID :</p>
<p style="padding-left: 90px;"><?php echo $property['PropertyID']; ?> |
Posted On: <?php echo $property['CREATED']; ?></p>
<p class="clear"></p>
<p class="text">Property Type :</p>
<p style="padding-left: 90px;"><?php echo $property['PropertyType']; ?></p>
<p class="clear"></p>
<?php
if($property['PropertyType'] == 'Residential')
{
	echo '<p class="text">Bedrooms :</p><p style="padding-left: 90px;">'.$property['NumberOfBedrooms'].' Bedrooms</p>';
}
if($property['Floor'] != '')
{
	echo '<p class="text">Floor :</p><p style="padding-left: 90px;">'.$property['Floor'].'</p>';
}
if($property['Furniture'] != '')
{
	echo '<p class="text">Furniture :</p><p style="padding-left: 90px;">'.$property['Furniture'].'</p>';
}
?> <?php if($property['NativeTotalArea'] != '') :?>
<p class="text">Saleable Area :</p>
<p style="padding-left: 90px;"><?php echo $property['NativeTotalArea']; ?>&nbsp;<?php echo $property['AbrNTA']; ?></p>
<?php endif; ?> <?php if($property['PropertyTransactionType'] == 'Lease') :?>

<?php if($property['RentPerSqFtSaleableCost'] != '0') :?>
<p class="text">Rate :</p>
<p style="padding-left: 90px;"><?php echo number_format($property['RentPerSqFtSaleableCost'], 2, '.', ''); ?>&nbsp;per/<?php echo $property['AbrNTA']; ?></p>
<?php endif; ?> <?php endif; ?> <?php if($property['PropertyTransactionType'] == 'Outright') :?>

<?php if($property['PerSqFtSaleableCost'] != '0') :?>
<p class="text">Rate :</p>
<p style="padding-left: 90px;"><?php echo number_format($property['PerSqFtSaleableCost'], 2, '.', ''); ?>&nbsp;per/<?php echo $property['AbrNTA']; ?></p>
<?php endif; ?> <?php endif; ?>
<div class="clear"></div>
<?php if(isset($property['Amenities']) && !empty($property['Amenities'])) :?>
<p class="text" style="padding-top: 3px; width: 85px;">Amenities :</p>
<div class="aminities" style="float: right; width: 182px;"><a
	href="<?php echo Property::detailPage($property);?>#amenities"><?php echo substr(str_replace('#',' ', $property['Amenities']),0, 75).'...'; ?></a>
</div>
<div class="clear"></div>
<?php endif; ?>
<div class="bottominfo">
<table width="100%" cellspacing="0">
	<tr>
		<td align="right"><a
			href="<?php echo Property::detailPage($property);?>"
			class="btn_viewdetails"><img
			src="templates/vtpl_template/images/view-details.png" /></a></td>
		<td style="vertical-align: bottom;" align="right"></td>
	</tr>
</table>
</div>
<!-- Bottom Info Ends Here --></div>
<!-- Property Info Ends Here --></div>
<!-- Single Property Ends Here -->

<?php
	}

	public static function rightContact(){

		?>
<div id="right-div">
<div id="right-inner">
<div id="block-top">
<p>Contact Us</p>
</div>
<div id="right-inner-body3">
<form>
<table cellspacing="0" cellpadding="0" border="0">
	<tbody>
		<tr>
			<td><input type="text" name="CTA-Name" value="Name:"
				class="default-value"></td>
		</tr>
		<tr>
			<td><input type="text" name="CTA-Phone" value="Phone:"
				class="default-value"></td>
		</tr>
		<tr>
			<td><input type="text" name="CTA-E-Mail" value="E-Mail:"
				class="default-value"></td>
		</tr>
		<tr>
			<td align="left" colspan="2"><span>I'm looking for a property in...</span></td>
		</tr>
		<tr>
			<td><input type="text" name="CTA-City" value="City:"
				class="default-value"></td>
		</tr>
		<tr>
			<td><input type="text" name="CTA-Locality" value="Locality:"
				class="default-value"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="CTA-submit"
				src="images/btn_submitdetails2.png" value=""
				class="btn_submitdetails"></td>
		</tr>
	</tbody>
</table>
</form>
</div>
<!-- Right Inner Body Ends Here --></div>
<!-- Right Inner Ends Here --></div>
		<?php

	}
}
?>