<?php jimport( 'joomla.environment.uri' ); ?>
<?php
require_once JPATH_BASE.DS.'vitrulib/city.class.php';
require_once JPATH_BASE.DS.'vitrulib/constants.php';
require_once JPATH_BASE.DS.'vitrulib/property.class.php';
require_once JPATH_BASE.DS.'vitrulib/lstofval.class.php';

class PropertySearchForm
{
	var $enabled = true;

	var $enableProspecting = true;

	public function PropertySearchForm()
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


		// check PropertyTransactionType
		if(isset( $_REQUEST['prptranstype'] ))
		{
			$prpTxnType = $_REQUEST['prptranstype'];
			if($prpTxnType != 'any') {
				if(is_array($prpTxnType)){
					$bitMap = $bitMap . '(';
					foreach($prpTxnType as $Idx){

						$fieldSet[] = $Idx;
						$bitMap .= 'PropertyTransactionType=? || ';
					}
					$bitMap = rtrim($bitMap,"|| ");
					$bitMap = $bitMap . ')&&';
				}else{
					$fieldSet[] = $prpTxnType;
					$fieldSet[] = 'Either';
					$bitMap .= '(PropertyTransactionType=?||PropertyTransactionType=?)&&';
				}


			}
		}

		// check Budget Range
		if(isset( $_REQUEST['budgetrange'] ))
		{
			$budgetRanges = $_REQUEST['budgetrange'];
			if(is_array($budgetRanges))
			{
				if(!in_array('any',$budgetRanges))
				{
					$budgets = array();
					foreach($budgetRanges as $idx => $value)
					{
						$temp = explode('_',$value);
						$budgets[]=$temp[0];
						$budgets[]=$temp[1];
					}
					$fieldSet[] = min($budgets) * 100000;
					$fieldSet[] = max($budgets) * 100000;
					if(is_array($_REQUEST['prptranstype'])){
						if(in_array('Lease',$_REQUEST['prptranstype'])){
							$bitMap .= 'Rent>=?&&Rent<=?&&';
						}else{
							$bitMap .= 'Cost>=?&&Cost<=?&&';
						}
					}else{
						$bitMap .= 'Cost>=?&&Cost<=?&&';
					}
				}
			}
			else
			{
				if ($budgetRanges != 'any')
				{
					$temp = explode('_',$budgetRanges);

					$budgets = array();
					$budgets[]=$temp[0];
					$budgets[]=$temp[1];

					$fieldSet[] = min($budgets) * 100000;
					$fieldSet[] = max($budgets) * 100000;

					$bitMap .= 'Cost>=?&&Cost<=?&&';
				}
			}
		}

		if(isset($_REQUEST['minBudget']) && isset($_REQUEST['maxBudget'])){

			$minBudget = $_REQUEST['minBudget'];
			$maxBudget = $_REQUEST['maxBudget'];



			if(in_array('Lease',$_REQUEST['prptranstype'])){

				$fieldSet[] = $minBudget * 1000;
				$fieldSet[] = $maxBudget * 1000;

				$bitMap .= 'Rent>=?&&Rent<=?&&';
			}else{

				$fieldSet[] = $minBudget * 100000;
				$fieldSet[] = $maxBudget * 100000;
				$bitMap .= 'Cost>=?&&Cost<=?&&';

			}

		}

		// check City ID
		$cityID = $_REQUEST['prpcity'];
		if(isset($cityID) && !in_array('prpcity',$skipParams) && $cityID != 'Any' && $cityID != 'any')
		{
			$bitMap .= 'CITY_ID = ?&&';
			$fieldSet[] = $cityID;
		}

			
		// check area
		if(isset( $_REQUEST['prparea'] ) && !in_array('prparea',$skipParams) && $_REQUEST['prparea'] != 'any' && !in_array('any',$_REQUEST['prparea']) && !in_array('Any',$_REQUEST['prparea']))
		{
			$area = $_REQUEST['prparea'];
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
		if(isset( $_REQUEST['beds'] ))
		{
			$noOfBeds = $_REQUEST['beds'];
			if(is_array($noOfBeds))
			{
				if(!in_array('any',$noOfBeds))
				{
					$temp = '';
					foreach($noOfBeds as $idx => $value)
					{
						$fieldSet[] = $value;
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= 'NumberOfBedrooms=?';
					}
					$bitMap .= '('.$temp.')&&';
				}
			}
			else
			{
				if ($noOfBeds != 'any')
				{
					$bitMap .= 'NumberOfBedrooms=?&&';
					$fieldSet[] = $noOfBeds;
				}
			}
		}

		// check NumberOfBathrooms
		if(isset( $_REQUEST['bathrooms'] ))
		{
			$noOfBathrooms = $_REQUEST['bathrooms'];
			if(is_array($noOfBathrooms))
			{
				if(!in_array('any',$noOfBathrooms))
				{
					$temp = '';
					foreach($noOfBathrooms as $idx => $value)
					{
						$fieldSet[] = $value;
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= 'NumberOfBathrooms=?';
					}
					$bitMap .= '('.$temp.')&&';
				}
			}
			else
			{
				if ($noOfBathrooms != 'any')
				{
					$bitMap .= 'NumberOfBathrooms=?&&';
					$fieldSet[] = $noOfBathrooms;
				}
			}
		}

		// check property type
		if(isset( $_REQUEST['prptype'] ) && !in_array('prptype',$skipParams) && $_REQUEST['prptype'] != 'any' && !in_array('any',$_REQUEST['prptype']) && !in_array('Any',$_REQUEST['prptype']))
		{
			$prptype = $_REQUEST['prptype'];
			if(is_array($prptype))
			{
				if(!in_array('Any', $prptype))
				{
					$temp = '';
					foreach($prptype as $idx => $value)
					{
						$fieldSet[] = $value;
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= 'PropertyType=?';
					}
					$bitMap .= '('.$temp.')&&';
				}
			}
			else
			{
				if (!empty($prptype) && $prptype != 'Any')
				{
					$bitMap .= 'PropertyType=?&&';
					$fieldSet[] = $prptype;
				}
			}
		}

		//Check property sub type
		if(isset( $_REQUEST['prpchildtype'] ) && !in_array('prpchildtype',$skipParams))
		{
			$prptype = $_REQUEST['prpchildtype'];
			if(is_array($prptype))
			{
				if(!in_array('Any', $prptype))
				{
					$temp = '';
					foreach($prptype as $idx => $value)
					{
						$fieldSet[] = $value;
						if(!empty($temp))
						{
							$temp .= '||';
						}
						$temp .= 'PropertyChildType=?';
					}
					$bitMap .= '('.$temp.')&&';
				}
			}
			else
			{
				if (!empty($prptype) && $prptype != 'Any')
				{
					$bitMap .= 'PropertyChildType=?&&';
					$fieldSet[] = $prptype;
				}
			}
		}

		// Search by sellable area
		if(isset( $_REQUEST['minArea'] ) || isset( $_REQUEST['maxArea']))
		{
			$minArea = $_REQUEST['minArea'];
			$maxArea = $_REQUEST['maxArea'];
			if(!(ctype_alpha($minArea)))
			{
				if(isset($minArea) && !empty($minArea))
				{
					$fieldSet[] = $minArea;
					$bitMap .= '(TotalArea>=?)&&';
				}
			}
			if(!(ctype_alpha($maxArea)))
			{
				if(isset($maxArea) && !empty($maxArea))
				{
					$fieldSet[] = $maxArea;
					$bitMap .= '(TotalArea<=?)&&';
				}
			}


		}

		$bitMap = rtrim($bitMap,"&");
		$fieldPredicate = array('FieldSet'=>$fieldSet, 'BitMap'=>$bitMap);
		return $fieldPredicate;
	}

	public function render(&$params = array())
	{
		$helperdir = JPATH_BASE.DS.'vitrulib/common/utils_prp/';
		?>
<div id="left-filter-inner-div">
<div id="block-top">
<p>Refine Your search</p>
</div>
<div id="left-filter-inner-body">
<div class="filters">
<div class="filter-head">ONLY SHOW PROPERTY ON <br>
<span>Lease / Outright</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body"><?php include($helperdir."prptranstype.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties <br>
<span>In price range</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."budgetrange.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties <br>
<span>In city</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body"><select id="prpcity" name="prpcity"
	onchange="javascript:submitpropertytablefrm();" style="width: 100%;">
	<?php include($helperdir."cities.php"); ?>
</select></div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties <br>
<span>In areas</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."areas.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties
<br>
<span>In saleable area</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height">
<input type="text" style="width:110px;" value="Minimum" id="minAreaID" name="minArea" class="default-value ">
<input type="text" style="width:110px;" value="Maximum" id="maxAreaID" name="maxArea" class="default-value ">
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties <br>
<span>With bedrooms</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."bedrooms.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties <br>
<span>With bathrooms</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."bathrooms.php"); ?>
</div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters">
<div class="filter-head">Only show properties <br>
<span>In property type</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body"><?php include($helperdir."prptype.php"); ?></div>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here -->
<div class="filters last">
<div class="filter-head">Only show properties <br>
<span>In property sub type</span></div>
<!-- Filter Head Ends Here -->
<div class="filter-body fixed-height"><?php include($helperdir."prpchildtype.php"); ?>
</div>
<br>
<a id="searchBySaleable" class="bttnstyle" style="padding: 10px 15px; float: right; margin-top: 10px;">Search</a>
<!-- Filter Body Ends Here --></div>
<!-- Filters Ends Here --></div>
<!-- Left Filter Inner Body Ends Here --></div>
<!-- Left Filter Inner Div Ends Here -->
<?php
		echo '<input type="hidden" name="view" value="allpropertiesphp" />'; 
		echo '<input type="hidden" name="option" value="com_rrsearch" />';
		echo '<input type="hidden" name="Itemid" value="'.$_REQUEST['Itemid'].'" />';
	}
}
?>