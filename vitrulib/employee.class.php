<?php
require_once 'businesscomponent.php';
require_once 'constants.php';
require_once 'loginmanager.class.php';

class Employee extends PhpBusinessComponent
{
	public function Employee($name = 'Employee_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function employeeByRID($empID)
	{
		if(isset($empID)&&!empty($empID))
		{
			$predicate = array('FieldSet'=>array($empID),'BitMap'=>'ROW_ID=?');
			$records = $this->select(array(), VitruUtils::addAppID($predicate));
			return $records['Record'];
		}
		
	}
}
?>
