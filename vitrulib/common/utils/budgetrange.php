<?php
if(!empty($_REQUEST['budget'])){

	$budgetreq = $_REQUEST['budget'];

}elseif(!empty( $_REQUEST['QuickSearch'])){

	$minBudgetrange = $_REQUEST['prjminBudget'];
	$maxBudgetrange = $_REQUEST['prjmaxBudget'];
	
	$budgets = array($minBudgetrange, $maxBudgetrange);

	foreach($budgets as $Idx => $bdgRange){
		if($bdgRange >= 0 && $bdgRange <=20){
			$budgetreq[] = '0_25';
		}elseif($bdgRange > 20 && $bdgRange <=40){
			$budgetreq[] = '25_40';
		}elseif($bdgRange > 40 && $bdgRange <=60){
			$budgetreq[] = '40_60';
		}elseif($bdgRange > 60 && $bdgRange <=100){
			$budgetreq[] = '60_100';
		}elseif($bdgRange > 100 && $bdgRange <=150){
			$budgetreq[] = '100_150';
		}elseif($bdgRange > 150 && $bdgRange <=200){
			$budgetreq[] = '150_200';
		}elseif($bdgRange > 200 && $bdgRange <=300){
			$budgetreq[] = '200_300';
		}elseif($bdgRange > 300 && $bdgRange <=500){
			$budgetreq[] = '300_500';
		}elseif($bdgRange > 500 && $bdgRange <=1000){
			$budgetreq[] = '500_1000';
		}
	}
	
	$start = $budgetreq['0'];
	$stop = $budgetreq['1'];
	unset($budgetreq);
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
				$budgetreq[] = $price;
			}
		}else{
			$budgetreq[] = $price;
		}
		
		if($price === $stop){
			break;
		}
	}

}
?>
<div class="searchchecklist"><input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()"
	name="budget[]" value="0_25" onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('0_25',$budgetreq)?'checked':''):($budgetreq=='0_25'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;Upto 25 Lac <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="25_40"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('25_40',$budgetreq)?'checked':''):($budgetreq=='25_40'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;25 Lac - 40 Lac <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="40_60"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('40_60',$budgetreq)?'checked':''):($budgetreq=='40_60'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;40 Lac - 60 Lac <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="60_100"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('60_100',$budgetreq)?'checked':''):($budgetreq=='60_100'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;60 Lac - 100 Lac <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="100_150"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('100_150',$budgetreq)?'checked':''):($budgetreq=='100_150'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;100 Lac - 1.5 Cr <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="150_200"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('150_200',$budgetreq)?'checked':''):($budgetreq=='150_200'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;1.5 Cr - 2 Cr <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="200_300"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('200_300',$budgetreq)?'checked':''):($budgetreq=='200_300'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;2 Cr - 3 Cr <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="300_500"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('300_500',$budgetreq)?'checked':''):($budgetreq=='300_500'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;3 Cr - 5 Cr <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="500_1000"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('500_1000',$budgetreq)?'checked':''):($budgetreq=='500_1000'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;5 Cr - 10 Cr <br />
<input id="budget" type="checkbox" onchange="javascript:submitprojecttablefrm()" name="budget[]" value="1000_500000"
	onclick="javascript:submitprojecttablefrm()"
	<?php echo (isset($budgetreq)?(is_array($budgetreq)?(in_array('1000_500000',$budgetreq)?'checked':''):($budgetreq=='1000_500000'?'checked':'')):'');?>>
&nbsp;&nbsp;&nbsp;More than 10 Cr <br />
</div>