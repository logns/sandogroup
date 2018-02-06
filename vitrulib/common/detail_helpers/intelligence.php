<?php
require_once JPATH_BASE.DS.'vitrulib/project.class.php';
require_once JPATH_BASE.DS.'vitrulib/developersgallerycallout.class.php';
require_once JPATH_BASE.DS.'vitrulib/attachment.class.php';

class Intelligence
{
	var $response;
	var $elementsPerFrame = 7;
	var $totalFrames = 2;

	public function Intelligence($buildername)
	{
		$this->response = array();

		$predicate = array('FieldSet'=>array('Yes',$buildername), 'BitMap'=>'PushToWebsite = ?&&BUILDER_ID = ?');
		
		$projectDto = new Project();
		$this->response = $projectDto->projects(array(), $predicate, array(), array("PageSize" => 14, "Window" => 0));

	}

	public function renderDropDown()
	{
		$projects = $this->response['Record'];
		if(isset($projects) && is_array($projects))
		{
			foreach($projects as $Idx => $project)
			{
				echo '<option value="'.$project['ROW_ID'].'">'.$project['ProjectName'].'</option>';
			}
		}
	}
	
	public function render($builderName)
	{
		$projects = $this->response['Record'];
		
		if(isset($projects) && is_array($projects))
		{
			echo '<div id="more-projects-div">';
			echo '<div class="heading"><span><a title="More Projects By '.$builderName.'" href="'.DevelopersGalleryCallout::developersDetailPage($builderName).'">More Projects By '.$builderName.'</a></span></div>';
			echo '<div class="clear"></div>';
			echo '<ul id="intelligence" class="jcarousel-skin-tango">';
			foreach($projects as $Idx => $project)
			{
				$prjImage = Attachment::attachmenturlbypath($project['ThumbnailSaveFilePath'], $project['FilePath']);
				$prjCity = (strlen($project['ProjectCity']) > 15 ? substr($project['ProjectCity'], 0, 15).'...' : $project['ProjectCity']);
				$prjTitle = (strlen($project['ProjectName']) > 15 ? substr($project['ProjectName'], 0, 15).'...' : $project['ProjectName']);
?>
				<li>
					<div>
						<a href="<?php echo Project::detailPage($project,'','detail');?>">
							<img src="<?php echo $prjImage;?>" alt="<?php echo $project['ProjectName']; ?>" />
						</a>
						<p>
							<a href="<?php echo Project::detailPage($project,'','detail');?>">
								<span class="prpTitle" title="<?php echo $project['ProjectName']; ?>"><?php echo $prjTitle;?></span>
								<span class="prpLoc" title="<?php echo $project['ProjectCity']; ?>"><?= $prjCity;?></span>
							</a>
						</p>
					</div>
				</li>
<?php 
			}
			echo '</ul>';
			echo '</div><!-- More Propertys Div Ends Here -->';
		}
	}
}
?>