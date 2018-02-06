<?php jimport( 'joomla.environment.uri' ); ?>
<?php
require_once JPATH_BASE.DS.'vitrulib/city.class.php';
require_once JPATH_BASE.DS.'vitrulib/constants.php';
require_once JPATH_BASE.DS.'vitrulib/project.class.php';
require_once JPATH_BASE.DS.'vitrulib/lstofval.class.php';

class ProjectSearchForm
{
	var $enabled = true;

	var $enableProspecting = true;

	public function ProjectSearchForm()
	{
	}

	public function getPredicate(&$params, $skipParams = array())
	{
		if(!$this->enabled)
		{
			return array();
		}
		$fieldSet = array('Yes');
		$bitMap = 'PushToWebsite=?&&';

		if(isset( $_REQUEST['budget'] ) && !empty( $_REQUEST['budget']))
		{
			$budgetrange = $_REQUEST['budget'];
			if(is_array($budgetrange))
			{
				$temp = '';
				$bitMap .= '(';
				foreach($budgetrange as $key => $value)
				{
					$budgetKey = Project::getOldProjectBudget($value);
					if($budgetKey != '')
					{
						$fieldSet[] = "Yes";
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= ($budgetKey.'=?');
					}
				}
				$bitMap .= $temp . ')&&';
			}
			else
			{
				$budgetKey = Project::getOldProjectBudget($budgetrange);
				if($budgetKey != '')
				{
					$bitMap .= $budgetKey.'=?&&';
					$fieldSet[] = "Yes";
				}
			}
		}

		//Quick Search Budget Mapping (Slider Range)

		if(!empty( $_REQUEST['QuickSearch']) && !empty( $_REQUEST['minBudgetPrj']))
		{
			$minBudgetrange = $_REQUEST['minBudgetPrj'];
			$maxBudgetrange = $_REQUEST['maxBudgetPrj'];
				
			$budgets = array($minBudgetrange, $maxBudgetrange);
				
			foreach($budgets as $Idx => $bdgRange){
				if($bdgRange >= 0 && $bdgRange <=20){
					$budgetrange[] = '0_25';
				}elseif($bdgRange > 20 && $bdgRange <=40){
					$budgetrange[] = '25_40';
				}elseif($bdgRange > 40 && $bdgRange <=60){
					$budgetrange[] = '40_60';
				}elseif($bdgRange > 60 && $bdgRange <=100){
					$budgetrange[] = '60_100';
				}elseif($bdgRange > 100 && $bdgRange <=150){
					$budgetrange[] = '100_150';
				}elseif($bdgRange > 150 && $bdgRange <=200){
					$budgetrange[] = '150_200';
				}elseif($bdgRange > 200 && $bdgRange <=300){
					$budgetrange[] = '200_300';
				}elseif($bdgRange > 300 && $bdgRange <=500){
					$budgetrange[] = '300_500';
				}elseif($bdgRange > 500 && $bdgRange <=1000){
					$budgetrange[] = '500_1000';
				}
			}
			
			$start = $budgetrange['0'];
			$stop = $budgetrange['1'];
			unset($budgetrange);
			$budgets = array('0_25',
							'25_40',
							'40_60',
							'60_100',
							'100_150',
							'150_200',
							'200_300',
							'300_500',
							'500_1000');
			$check = '0';
			foreach($budgets as $price){
			
				if($check == '0'){
					if($price === $start){
						$check = '1';
						$budgetrange[] = $price;
					}
				}else{
					$budgetrange[] = $price;
				}
				
				if($price === $stop){
					break;
				}
			}
			if(is_array($budgetrange))
			{
				$temp = '';
				$bitMap .= '(';	
				foreach($budgetrange as $key => $value)
				{
					$budgetKey = Project::getOldProjectBudget($value);
					if($budgetKey != '')
					{
						$fieldSet[] = "Yes";
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= ($budgetKey.'=?');
					}
				}
				$bitMap .= $temp . ')&&';
			}
				
		}
		
		// check City ID
		$cityID = $_REQUEST['prjcity'];
		if(isset($cityID) && !in_array('prjcity',$skipParams)  && $cityID != 'Any' && $cityID != 'any')
		{
			$bitMap .= 'CITY_ID = ?&&';
			$fieldSet[] = $cityID;
		}

		if(isset( $_REQUEST['prjarea'] ) && !in_array('prjarea',$skipParams) && $_REQUEST['prjarea'] != 'any' && !in_array('any',$_REQUEST['prjarea']))
		{
			$area = $_REQUEST['prjarea'];
			if(is_array($area))
			{
				$temp = '';
				foreach($area as $idx => $value)
				{
					$fieldSet[] = $value;
					if(!empty($temp))
					{
						$temp .= '||';
					}
					$temp .= 'AREA_ID=?';
				}
				$bitMap .= '('.$temp.')&&';
			}
			else
			{
				$bitMap .= 'AREA_ID=?&&';
				$fieldSet[] = $area;
			}
		}

		// check NumberOfBedrooms
		if(isset( $_REQUEST['beds'] ) && !in_array('beds',$skipParams))
		{
			$noOfBeds = $_REQUEST['beds'];
			if(is_array($noOfBeds))
			{
				$temp = '';
				foreach($noOfBeds as $key => $value)
				{
					$bedKey = Project::getProjectBedroom($value);
					if(isset($bedKey) && $bedKey != '')
					{
						$bedKey = explode(',', $bedKey);
						foreach($bedKey as $idx => $val)
						{
							$fieldSet[] = "Yes";
							if(!empty($temp))
							{
								$temp .= '||';
							}
							$temp .= ($val.'=?');
						}
					}
				}
				$bitMap .= '(' . $temp . ')&&';
			}
			else
			{
				$bedKey = Project::getProjectBedroom($noOfBeds);
				$temp = '';
				if(isset($bedKey) && $bedKey != '')
				{
					$bedKey = explode(',', $bedKey);
					foreach($bedKey as $idx => $val)
					{
						$fieldSet[] = "Yes";
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= ($val.'=?');
					}
					$bitMap .= '(' . $temp . ')&&';
				}
			}
		}

		if(isset( $_REQUEST['prptype'] ) && !in_array('prptype',$skipParams))
		{
			$prptype = $_REQUEST['prptype'];
			if(is_array($prptype))
			{
				if(!in_array('any', $prptype))
				{
					$temp = '';
					foreach($prptype as $idx => $value)
					{
						$fieldSet[] = $value;
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= 'ProjectType=?';
					}
					$bitMap .= '('.$temp.')&&';
				}
			}
			else
			{
				if (!empty($prptype) && $prptype != 'any')
				{
					$bitMap .= 'ProjectType=?&&';
					$fieldSet[] = $prptype;
				}
			}
		}
		
		// check ProjectStatus
		if(isset( $_REQUEST['ProjectStatus'] ))
		{
			$projectStatus = $_REQUEST['ProjectStatus'];
			if($projectStatus != 'any')
			{
				$fieldSet[] = $projectStatus;
				$bitMap .= 'ProjectStatus=?&&';
			}
		}

		$bitMap = rtrim($bitMap,"&");
		$fieldPredicate = array('FieldSet'=>$fieldSet, 'BitMap'=>$bitMap);
		return $fieldPredicate;
	}

	public function render(&$params = array())
	{
		$helperdir = JPATH_BASE.DS.'vitrulib/common/utils/';
		?>
<div id="left-filter-inner-div">
<div id="block-top">
<p>Refine Your search</p>
</div>
<div id="left-filter-inner-body">
<div class="filters">
<div class="filter-head">Only show projects <br>
<span>In price range</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."budgetrange.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show projects <br>
<span>In city</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body"><select id="prjcity" name="prjcity"
	onchange="javascript:submitprojecttablefrm()" style="width: 100%;">
	<?php include($helperdir."cities.php"); ?>
</select></div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show projects <br>
<span>In areas</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."areas.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show projects <br>
<span>With bedrooms</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."bedrooms.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->

<div class="filters">
<div class="filter-head">Only show projects <br>
<span>In property type</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body"><?php include($helperdir."prptype.php"); ?></div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here --></div>
<!-- Left Filter Inner Body Ends Here --></div>
<!-- Left Filter Inner Div Ends Here -->
	<?php
	echo '<input type="hidden" name="view" value="'.$_REQUEST['view'].'" />';
	echo '<input type="hidden" name="option" value="com_projectsearch" />';
	echo '<input type="hidden" name="Itemid" value="'.$_REQUEST['Itemid'].'" />';
	}
}
?>