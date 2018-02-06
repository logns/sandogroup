<?php
require_once 'businesscomponent.php';
require_once 'constants.php';

/**
 *
 * @author Hari
 *
 */
class Attachment extends PhpBusinessComponent
{
	public function Attachment($name = 'Attachment_BC')
	{
		$this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
	}

	public function attachmentsByParent($parrowid)
	{
		$predicate = array('FieldSet'=>array($parrowid, 'Yes'),'BitMap'=>'PAR_ROW_ID=?&&ShareWithWebsite=?');
		$records = $this->select(array(), VitruUtils::addAppID($predicate));
		return $records['Record'];
	}

	public static function attachmenturlbypath($fullpath, $filename, $contenttype = 'application/octet-stream')
	{
		if(!isset($fullpath))
		{
			return 'images/default_image.jpg';
		}
		// encode the path, name & the content type.
		$fullpath = base64_encode($fullpath);
		$filename = base64_encode($filename);
		$contenttype = base64_encode($contenttype);

		// get hold of the server url
		$serverurl = VitruUtils::getServerUrl();

		// simply concatenate all of this together and return.
		return $serverurl.'?ReqType=SessionUnawarePathBasedAttachmentDownloadReqType&p='.$fullpath.'&n='.$filename.'&ct='.$contenttype;
	}

	public static function attachmenturl($attachmentrid)
	{
		return VitruUtils::getServerUrl().'?ReqType=SessionUnawareAttachmentDownloadReqType&AttachmentRowID='.$attachmentrid.'&APP_ID='.VitruUtils::getAppID();
	}

	public static function imageurl($attachmentrid, $thumb = true)
	{
		// see if the APPLICATION_ID has been setup.
		$appID = VitruUtils::getAppID();
		if(isset($appID) && !empty($appID))
		{
			$url = VitruUtils::getServerUrl().'?ReqType=SessionUnawareAttachmentDownloadReqType&APP_ID='.$appID;
		}
		else
		{
			$url = VitruUtils::getServerUrl().'?ReqType=SessionUnawareAttachmentDownloadReqType';
		}

		// if thumbnails need to be setup.
		if($thumb)
		{
			$url = $url.'&Thumbnail=Yes&AttachmentRowID=';
		}
		else
		{
			$url = $url.'&AttachmentRowID=';
		}

		// finally return the URL.
		if(!empty($attachmentrid))
		{
			return $url.$attachmentrid;
		}
		else
		{
			return 'images/default_image.jpg';
		}
	}
}
?>
