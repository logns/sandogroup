<?php

class AmenitiesRenderer
{
	public function renderadditionaldetails($project)
	{
		$amenities = $project['Amenities'];
		if(!isset($amenities) || empty($amenities))
		{
			return;
		}
		$amenities = str_replace("#", "", $amenities);
		$amenities = split(',', $amenities);
		if(!isset($amenities) || empty($amenities))
		{
			return;
		}
		echo '<table cellspacing="0" border="0" cellpadding="1" width="100%" >';
		$t = 0;
		for($i = 0; $i < sizeof($amenities); $i = $i + 4)
		{
			echo '	<tr class="'.((++$t%2)==0?'bgstyle1':'bgstyle').'">';
			if(isset($amenities[$i]))
			{
				echo '		<td class="algright"><strong>'.$amenities[$i].' :&nbsp;&nbsp;</strong></td>';
				echo '		<td class="algleft"><img src="templates/vtpl_template/images/tik.png"></td>';
			}
			if(isset($amenities[$i + 1]))
			{
				echo '		<td class="algright"><strong>'.$amenities[$i + 1].' :&nbsp;&nbsp;</strong></td>';
				echo '		<td class="algleft"><img src="templates/vtpl_template/images/tik.png"></td>';
			}
			if(isset($amenities[$i + 2]))
			{
				echo '		<td class="algright"><strong>'.$amenities[$i + 2].' :&nbsp;&nbsp;</strong></td>';
				echo '		<td class="algleft"><img src="templates/vtpl_template/images/tik.png"></td>';
			}
			if(isset($amenities[$i + 3]))
			{
				echo '		<td class="algright"><strong>'.$amenities[$i + 3].' :&nbsp;&nbsp;</strong></td>';
				echo '		<td class="algleft"><img src="templates/vtpl_template/images/tik.png"></td>';
			}
			echo '	</tr>';
		}
		echo '</table>';
	}
}
?>