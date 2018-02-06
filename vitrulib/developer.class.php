<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

class Developer extends PhpBusinessComponent
{
	public function Developer($name = 'ClientManagement_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function getBuilderDescription($builderID)
	{
		if(isset( $builderID ))
		{
			$fieldset[] = 'Builder';
			$fieldset[] = $builderID;
			$bitmap = 'ClientSrcType = ? && ROW_ID = ?';
			$predicate = array('FieldSet'=>$fieldset,'BitMap'=>$bitmap);
		}
		$records = $this->select(array('Comments'), VitruUtils::addAppID($predicate), array(), array());
		return $records['Record'];
	}

}
?>