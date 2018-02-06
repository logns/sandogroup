<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

/**
 *
 * @author Hari
 *
 */
class ListOfValue extends PhpBusinessComponent
{
	public function ListOfValue($name = 'ListOfValue_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function listofvalueByRID($rid)
	{
		$predicate = array('FieldSet'=>array($rid),'BitMap'=>'ROW_ID=?');
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('DispValue' => 'ASC'));
		return $records['Record'];
	}

	public function listofvalueQuery($type, $value, $attribute = '')
	{
		$predicate = array('FieldSet'=>array($type, $value),'BitMap'=>'Type=?&&Value=?');
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('DispValue' => 'ASC'));
		$prpTypes = $records['Record'];
		if(!isset($prpTypes) || empty($prpTypes))
		{
			return;
		}
		if(!isset($attribute)||empty($attribute))
		{
			return $prpTypes[0];
		}
		else
		{
			return $prpTypes[0][$attribute];
		}
	}

	public function listofvaluesByType($type)
	{
		// form a predicate
		$predicate = array('FieldSet'=>array($type),'BitMap'=>'Type=?');

		// query and get the records
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('DispValue' => 'ASC'));

		// return just the data.
		return $records['Record'];
	}

	public function listofvaluesByParent($type, $parentvalue)
	{
		// check if the parent value has been setup.
		$predicate = array();
		if(isset($parentvalue))
		{
			$predicate = array('FieldSet'=>array($type, $parentvalue),'BitMap'=>'Type=?&&ParentValue=?');
		}
		// if not then we need to query just on the basis of the type.
		else
		{
			return $this->listofvaluesByType($type);
		}

		// query and get the records.
		$records = $this->select(array(), VitruUtils::addAppID($predicate), array('DispValue' => 'ASC'));

		// return just the data.
		return $records['Record'];
	}
}
?>
