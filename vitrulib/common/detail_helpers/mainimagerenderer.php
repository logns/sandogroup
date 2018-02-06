<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once 'vitrulib/constants.php';
require_once 'vitrulib/attachment.class.php';

class MainImage
{
	public function renderMainImages($savePath, $filePath)
	{
		echo '<img src="'.Attachment::attachmenturlbypath($savePath, $filePath, 'application/octet-stream', VitruUtils::getServerUrl()).'" />';
	}
}
?>