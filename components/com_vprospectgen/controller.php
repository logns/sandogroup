<?php
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.application.component.controller');

require_once JPATH_BASE.DS.'vitrulib/constants.php';
require_once JPATH_BASE.DS.'vitrulib/callout.php';
require_once JPATH_BASE.DS.'vitrulib/project.class.php';
require_once JPATH_BASE.DS.'vitrulib/area.class.php';
require_once JPATH_BASE.DS.'vitrulib/city.class.php';
require_once JPATH_BASE.DS.'vitrulib/localitybrowsercallout.class.php';
require_once JPATH_BASE.DS.'vitrulib/lstofval.class.php';
require_once JPATH_BASE.DS.'vitrulib/callback.class.php';

require_once JPATH_BASE.DS.'vitrulib/projectsitevisit.class.php';

class VprospectgenController extends JController
{
	function display()
	{
		parent::display();
	}

	function quickSearch()
	{
		// create the callout instance.
		$callout = new PhpCallout('ContextItemCallout', VitruUtils::getServerUrl());

		$parameters['APPLICATION_ID'] = VitruUtils::getAppID();

		//$parameters['k'] = $_REQUEST['term'];
		if(is_numeric($_REQUEST['term'])){
			$parameters['k'] = '%'.$_REQUEST['term'].'%';
		}else{
			$parameters['k'] = $_REQUEST['term'];
		}

		// invoke the callout.
		$response = $callout->execute($parameters);
		$response = json_decode($response);
		$response = $response->ContextItems;

		$resultItems = array();
		if(isset($response) && !empty($response))
		{
			$resultItem['DisplayLabel'] = "Browse through all Properties for \"".$_REQUEST['term']."\"";
			$resultItem['TargetURL'] = "";
			$resultItems[] = $resultItem;
			foreach($response as $idx => $contextItem)
			{
				$resultItem['DisplayLabel'] = $contextItem->DisplayLabel;
				$targetUrl = $contextItem->TargetURL;

				$url = explode('&',$targetUrl);
				foreach($url as $Idx => $key){
					if(preg_match('/^menualias/', $key)){
						$aliasString = explode('=',$key);
						$Itemid = VitruUtils::getItemID($aliasString['1']);
						if($Itemid){
							$targetUrl = $targetUrl.'&Itemid='.$Itemid;
							break;
						}
					}
				}

				$resultItem['TargetURL'] = $targetUrl;
				$resultItems[] = $resultItem;
			}
		}
		else
		{
			$resultItem['DisplayLabel'] = "Sorry, we could not find any data matching your keyword \"".$_REQUEST['term']."\"";
			$resultItem['TargetURL'] = "";
			$resultItems[] = $resultItem;
		}

		// return the array as json
		echo json_encode($resultItems);
	}

	public function siteVisit(){
                $this->savevaLead();
		$sitevisitObj = new ProjectSiteVisit();
		$sitevisitObj->saveProspect();
	}

	public function callback(){
                $this->savevaLead();
		$callback = new CallBack();
		$callback->saveprospect();
	}
        public function savevaLead(){
    	$keyword = $_COOKIE['vaLead_Keyword'];
        $channel = $_COOKIE['vaLead_Channel'];
        $campaign = $_COOKIE['vaLead_Campaign'];
        $placement = $_COOKIE['vaLead_Placement'];
        $device = $_COOKIE['vaLead_Device'];

        $name = $_REQUEST['Name'];
        $email = $_REQUEST['EmailID'];
        $mobile = $_REQUEST['Mobile'];
        $source = $_REQUEST['Source']; 
        $countrycode = $_REQUEST['CountryCode'];
        $description = $_REQUEST['message']; 
        $appID = "445043796209754233";
        
        $urlParams  = urlencode("recordData.fields['name'].value")."=".urlencode($name)."&";
        $urlParams .= urlencode("recordData.fields['email'].value")."=".urlencode($email)."&";
        $urlParams .= urlencode("recordData.fields['mobile'].value")."=".urlencode($countrycode.$mobile)."&";
        $urlParams .= urlencode("recordData.fields['channel'].value")."=".urlencode($channel)."&";
        $urlParams .= urlencode("recordData.fields['keyword'].value")."=".urlencode($keyword)."&";
        $urlParams .= urlencode("recordData.fields['placement'].value")."=".urlencode($placement)."&";
        $urlParams .= urlencode("recordData.fields['device'].value")."=".urlencode($device)."&";
        $urlParams .= urlencode("recordData.fields['pageUrl'].value")."=".urlencode('http://sandogroup.com/')."&";
        $urlParams .= urlencode("recordData.fields['prospectCapturingPoint'].value")."=".urlencode($source)."&";        
        $urlParams .= urlencode("recordData.fields['campaign'].value")."=".urlencode($campaign)."&";
        $urlParams .= urlencode("recordData.fields['description'].value")."=".urlencode($description)."&";
        $url = "http://54.251.248.213:8080/VitruvianAnalytics/webToLead.html?module=lead&action=create&webToLead=Yes&appID=$appID&".$urlParams;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
    }

}