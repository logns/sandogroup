<?php
defined('_JEXEC') or die('Restricted access');

class TableLeads extends JTable
{
//	var $id = null;
	var $Name = null;
	var $Mobile = null;
	var $cdt = null;
	var $url = null;
	var $EmailID = null;
	var $ip = null;
	var $leadpoint = null;
	//PPC fields
	var $Campaign = null;
	var $AdGroup = null;
	var $Keyword = null;
	var $MatchType = null;
	var $Distribution = null;
	var $AdID = null;
	var $Placement = null;

	function __construct(&$db)
	{
		parent::__construct( '#__leads', 'id', $db );
	}
}

?>