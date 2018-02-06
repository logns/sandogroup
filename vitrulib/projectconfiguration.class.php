<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

/**
 *
 * @author Hari
 *
 */
class ProjectConfiguration extends PhpBusinessComponent
{
	public function ProjectConfiguration($name = 'ProjectConfiguration_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function configurationsByProject($projectid)
	{
		$predicate = array('FieldSet'=>array($projectid),'BitMap'=>'PROJECT_ID=?');
		$sortspec = array('SerialNo' => 'ASC');
		$records = $this->select(array(), VitruUtils::addAppID($predicate), $sortspec);
		return $records['Record'];
	}

}
?>
