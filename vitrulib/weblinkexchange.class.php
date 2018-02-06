<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

class WebLinkExchange extends PhpBusinessComponent
{
	public function WebLinkExchange($name = 'WebLinkExchange_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function getWebLink()
	{
		$predicate = array('FieldSet' => array(VitruUtils::getAppID(), 'Yes'), 'BitMap' => 'EXCH_APP_ID = ?&&Published = ?');

		// fire the query.
		$records = $this->select(array(), $predicate);

		// return only the data.
		return $records['Record'];
	}

	public function getWebLinks($group)
	{
		$predicate = array('FieldSet' => array($group, 'Yes'), 'BitMap' => 'Group = ?&&Published = ?');

		// fire the query.
		$records = $this->select(array(), $predicate);

		// return only the data.
		return $records['Record'];
	}
}
?>
