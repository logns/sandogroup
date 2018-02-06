<?php
//defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( 'export.php' );
JTable::addIncludePath(JPATH_COMPONENT.DS.'tabless');
showfilterHeader();
showLeads( $option );

if($_REQUEST['call'])
{
	$export = new ExportToExcel();
}

function showfilterHeader() {
	HTML_leads::showfilterHeader();
}

function showLeads( $option )
{
	global $mainframe;
	$db =& JFactory::getDBO();
	$limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
	$limitstart = JRequest::getVar('limitstart', 0);
	$filterType=JRequest::getVar('filterType', "getContainsFilterQuery");
	$query = ($filterType=='getContainsFilterQuery'?getContainsFilterQuery(true):getDateFilterQuery(true));
	$db->setQuery( $query );
	$total = $db->loadResult();
	$query = ($filterType=='getContainsFilterQuery'?getContainsFilterQuery(false):getDateFilterQuery(false));
	$db->setQuery( $query, $limitstart, $limit );
	$rows = $db->loadObjectList();
	if ($db->getErrorNum()) {
		echo $db->stderr();
		return false;
	}
	jimport('joomla.html.pagination');
	$pageNav = new JPagination($total, $limitstart, $limit);
	HTML_leads::showLeads( $option, $rows, $pageNav);
}

function getContainsFilterQuery($count=false)
{
	return ($count?"SELECT count(*) FROM jos_leads ":"SELECT * FROM jos_leads ")."where (Name like '%".JRequest::getVar('key', '')."%' or Mobile like '%".JRequest::getVar('key', '')."%'or EmailID like '%".JRequest::getVar('key', '')."%') order by CDT desc";
}

function getDateFilterQuery($count=false)
{
	return ($count?"SELECT count(*) FROM jos_leads ":"SELECT * FROM jos_leads ")."where date(cdt) = date('".JRequest::getVar('leaddate', '')."') order by CDT desc";
}

function exportToExcel(){



}

?>