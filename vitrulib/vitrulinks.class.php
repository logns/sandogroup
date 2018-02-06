<?php
require_once 'weblinkexchange.class.php';

/**
 *
 * @author Hari
 *
 */
class VitruLinks
{
	public function render(&$params = array())
	{
		$weblinkxchangeBC = new WebLinkExchange();
		$link = $weblinkxchangeBC->getWebLink();
		if(!isset($link))
		{
			$this->renderInternalLinks();
			return;
		}

		$group = $link[0]['Group'] + 1;
		$outboundlinks = $weblinkxchangeBC->getWebLinks($group);
		if(!isset($outboundlinks) || empty($outboundlinks))
		{
			$outboundlinks = $weblinkxchangeBC->getWebLinks(1);
		}
		if(!isset($outboundlinks) || empty($outboundlinks))
		{
			$this->renderInternalLinks();
			return;
		}

		echo '<ul>';
		foreach($outboundlinks as $i => $outboundlink)
		{
			echo '<li><a href="'.$outboundlink['WebsiteURL'].'" alt="'.$outboundlink['CompanyName'].'">'.$outboundlink['AnchorText'].'</a></li>';
		}
		echo '</ul>';

		$this->renderInternalLinks();
	}

	private function renderInternalLinks()
	{
		echo '<ul>';
		echo '<li><a href="http://www.realtyredefined.com" alt="Real Estate Software">Real Estate Software</a></li>';
		echo '<li><a href="http://www.realtyredefined.com" alt="Property Software">Property Software</a></li>';
		echo '<li><a href="http://www.realtyredefined.com/index.php?option=com_content&view=article&id=85&Itemid=42" alt="Real Estate Marketing">Real Estate Marketing</a></li>';
		echo '<li><a href="http://www.realtyredefined.com/index.php?option=com_content&view=article&id=85&Itemid=42" alt="Real Estate Websites">Real Estate Websites</a></li>';
		echo '<li><a href="http://www.vitruviantech.com" alt="Vitruvian Technologies Pvt Ltd">Vitruvian Technologies Pvt Ltd</a></li>';
		echo '<li><a href="http://www.hotmumbaiproperties.com" alt="Mumbai Properties">Mumbai Properties</a></li>';
		echo '<li><a href="http://www.hotmumbaiproperties.com" alt="Property in Mumbai">Property in Mumbai</a></li>';
		echo '<li><a href="http://www.hotmumbaiproperties.com" alt="Mumbai Real Estate">Mumbai Real Estate</a></li>';
		echo '<li><a href="http://www.hotdelhiproperties.com" alt="Delhi Properties">Delhi Properties</a></li>';
		echo '<li><a href="http://www.hotdelhiproperties.com" alt="Property in Delhi">Property in Delhi</a></li>';
		echo '<li><a href="http://www.hotdelhiproperties.com" alt="Delhi Real Estate">Delhi Real Estate</a></li>';
        echo '<li><a href="http://www.hotbengaluruproperties.com" alt="Bangalore Properties">Bangalore Properties</a></li>';
		echo '<li><a href="http://www.hotbengaluruproperties.com" alt="Property in Bangalore">Property in Bangalore</a></li>';
		echo '<li><a href="http://www.hotbengaluruproperties.com" alt="Bangalore Real Estate">Bangalore Real Estate</a></li>';
		echo '<li><a href="http://www.hotpuneproperties.com" alt="Pune Properties">Pune Properties</a></li>';
		echo '<li><a href="http://www.hotpuneproperties.com" alt="Property in Pune">Property in Pune</a></li>';
		echo '<li><a href="http://www.hotpuneproperties.com" alt="Pune Real Estate">Pune Real Estate</a></li>';
		echo '<li><a href="http://www.hotindiaproperties.in" alt="India Properties">India Properties</a></li>';
		echo '<li><a href="http://www.hotindiaproperties.in" alt="Property in India">Property in India</a></li>';
		echo '<li><a href="http://www.hotindiaproperties.in" alt="India Real Estate">India Real Estate</a></li>';
		echo '</ul>';
	}
}
?>
