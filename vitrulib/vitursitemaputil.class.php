<?php
/**
 *
 * @author HARISH
 *
 */
class VitruSiteMapUtil
{
	public static function xmlSitemapURL($loc, $lastmod = '', $changefreq = '', $priority = '')
	{
		echo '<url>';
		echo '<loc><![CDATA['.$loc.']]></loc>';
		if(isset($lastmod)&&!empty($lastmod)) { echo '<lastmod>'.$lastmod.'</lastmod>'; }
		if(isset($changefreq)&&!empty($changefreq)) { echo '<changefreq>'.$changefreq.'</changefreq>'; }
		if(isset($priority)&&!empty($priority)) { echo '<priority>'.$priority.'</priority>'; }
		echo '</url>';
	}

	public static function xmlSitemapStartTag()
	{
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
		echo '        xmlns:image="http://www.sitemaps.org/schemas/sitemap-image/1.1"';
		echo '        xmlns:video="http://www.sitemaps.org/schemas/sitemap-video/1.1">';
	}

	public static function xmlSitemapEndTag()
	{
		echo '</urlset>';
	}
}
?>
