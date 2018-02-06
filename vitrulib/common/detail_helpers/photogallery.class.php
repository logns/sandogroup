<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_BASE.DS.'vitrulib/constants.php';
require_once JPATH_BASE.DS.'vitrulib/attachment.class.php';

class PhotoGallery
{
	public function render($data)
	{
		echo '<div style="width: 728px;">';
		$categories = $data->images;
		if(is_array($categories)){
			foreach($categories as $k => $images)
			{
				echo '<p class="headingoverview">'.$k.'</p>';
				echo '<ul id="photogallery" class="gallery clearfix">';
				foreach($images as $idx => $image)
				{
					echo '<li><a href=' . Attachment::attachmenturlbypath($image['SaveFilePath'], $image['FilePath'],'application/octet-stream', VitruUtils::getServerUrl()) . ' rel="prettyPhoto[gallery]"><img src=' . Attachment::attachmenturlbypath($image['ThumbnailSaveFilePath'], $image['SaveFilePath'],'application/octet-stream', VitruUtils::getServerUrl()) . ' width="80" height="60" alt="" /></a></li>';
				}
				echo '</ul>';
			}
		}else{
			echo 'No Images';
		}
		echo '</div>';
	}
}
?>
