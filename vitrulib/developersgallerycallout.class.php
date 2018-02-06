<?php
require_once 'callout.php';
require_once 'constants.php';


class DevelopersGalleryCallout extends PhpCallout
{
	public function DevelopersGalleryCallout($name = 'DevelopersGalleryCallout')
	{
		$this->PhpCallout($name, VitruUtils::getServerUrl());
	}

	public function getDevelopers($limit = '')
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "";
		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();

		if(isset($limit)){
			$parameters['Limit'] = $limit;
		}

		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);

		return $response;
	}

	public function getBuilderById($builder_ID, $limit = '')
	{
		// add the application ID before invoking the callout also.
		$parameters['Function'] = "getBuilderById";
		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();
		$parameters['BUILDER_ID'] = $builder_ID;

		if(isset($limit)){
			$parameters['Limit'] = $limit;
		}

		// invoke the callout.
		$response = $this->execute($parameters);
		$response = json_decode($response);

		return $response;
	}

	public static function developersDetailPage($builderId){
		$itemid = VitruUtils::getItemID('projects');
		return 'index.php?option=com_projectsearch&view=allprojectsphp&builder='.urlencode($builderId).'&Itemid='.$itemid;
	}
}
?>
