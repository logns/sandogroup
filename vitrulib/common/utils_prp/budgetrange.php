<?php

$budgetRange = $_REQUEST['budgetrange'];

$minPrice = $_REQUEST['minBudget'];

$maxPrice = $_REQUEST['maxBudget'];



if(isset($minPrice)){

	if($_REQUEST['prptranstype']['0'] == 'Lease'){

		if($minPrice>='0' && $minPrice<='10'){
			$start = '0_0.1';
		}elseif($minPrice>='11' && $minPrice<='50'){
			$start = '0.1_0.5';
		}elseif($minPrice>='51' && $minPrice<='80'){
			$start = '0.5_0.8';
		}elseif($minPrice>='81' && $minPrice<='120'){
			$start = '0.8_1.2';
		}elseif($minPrice>='121' && $minPrice<='200'){
			$start = '1.2_2.0';
		}elseif($minPrice>='151' && $minPrice<='200'){
			$start = '2.0_5.0';
		}elseif($minPrice>='201' && $minPrice<='500'){
			$start = '5.0_10.0';
		}elseif($minPrice>='501' && $minPrice<='1000'){
			$start = '10.0_1000';
		}

		if($maxPrice>='0' && $maxPrice<='10'){
			$stop = '0_0.1';
		}elseif($maxPrice>='11' && $maxPrice<='50'){
			$stop = '0.1_0.5';
		}elseif($maxPrice>='51' && $maxPrice<='80'){
			$stop = '0.5_0.8';
		}elseif($maxPrice>='81' && $maxPrice<='120'){
			$stop = '0.8_1.2';
		}elseif($maxPrice>='121' && $maxPrice<='200'){
			$stop = '1.2_2.0';
		}elseif($maxPrice>='151' && $maxPrice<='200'){
			$stop = '2.0_5.0';
		}elseif($maxPrice>='201' && $maxPrice<='500'){
			$stop = '5.0_10.0';
		}elseif($maxPrice>='501' && $maxPrice<='1000'){
			$stop = '10.0_1000';
		}

	}else{

		if($minPrice>='0' && $minPrice<='25'){
			$start = '0_25';
		}elseif($minPrice>='26' && $minPrice<='40'){
			$start = '25_40';
		}elseif($minPrice>='41' && $minPrice<='60'){
			$start = '40_60';
		}elseif($minPrice>='61' && $minPrice<='100'){
			$start = '60_100';
		}elseif($minPrice>='101' && $minPrice<='150'){
			$start = '100_150';
		}elseif($minPrice>='151' && $minPrice<='200'){
			$start = '150_200';
		}elseif($minPrice>='201' && $minPrice<='300'){
			$start = '200_300';
		}elseif($minPrice>='301' && $minPrice<='500'){
			$start = '300_500';
		}elseif($minPrice>='501' && $minPrice<='1000'){
			$start = '500_1000';
		}

		if($maxPrice>='0' && $maxPrice<='25'){
			$stop = '0_25';
		}elseif($maxPrice>='26' && $maxPrice<='40'){
			$stop = '25_40';
		}elseif($maxPrice>='41' && $maxPrice<='60'){
			$stop = '40_60';
		}elseif($maxPrice>='61' && $maxPrice<='100'){
			$stop = '60_100';
		}elseif($maxPrice>='101' && $maxPrice<='150'){
			$stop = '100_150';
		}elseif($maxPrice>='151' && $maxPrice<='200'){
			$stop = '150_200';
		}elseif($maxPrice>='201' && $maxPrice<='300'){
			$stop = '200_300';
		}elseif($maxPrice>='301' && $maxPrice<='500'){
			$stop = '300_500';
		}elseif($maxPrice>='501' && $maxPrice<='1000'){
			$stop = '500_1000';
		}
	}

}

$budgets = array('0_25',
				'25_40',
				'40_60',
				'60_100',
				'100_150',
				'150_200',
				'200_300',
				'300_500',
				'500_1000',
				'1000_500000',
				'0_0.1',
				'0.1_0.5',
				'0.5_0.8',
				'0.8_1.2',
				'1.2_2.0',
				'2.0_5.0',
				'5.0_10.0',
				'10_1000'
				);
				$check = '0';

				foreach($budgets as $price){

					if($check == '0'){
						if($price === $start){
							$check = '1';
							$budgetRange[] = $price;
						}
					}else{
						$budgetRange[] = $price;
					}

					if($price === $stop){
						break;
					}
				}

				if($_REQUEST['prptranstype']['0']=='Lease' && empty($_REQUEST['prptranstype']['1']))
				{
					?>
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0_0.1" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0_0.1',$budgetRange))?'checked':""):($budgetRange=='0_0.1'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;Upto 10 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0.1_0.5" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0.1_0.5',$budgetRange))?'checked':""):($budgetRange=='0.1_0.5'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;10 Th - 50 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0.5_0.8" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0.5_0.8',$budgetRange))?'checked':""):($budgetRange=='0.5_0.8'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;50 Th - 80 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0.8_1.2" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0.8_1.2',$budgetRange))?'checked':""):($budgetRange=='0.8_1.2'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;80 Th - 120 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="1.2_2.0" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('1.2_2.0',$budgetRange))?'checked':""):($budgetRange=='1.2_2.0'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;1.2 Lac - 2 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="2.0_5.0" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('2.0_5.0',$budgetRange))?'checked':""):($budgetRange=='2.0_5.0'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;2 Lac - 5 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="5.0_10.0" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('5.0_10.0',$budgetRange))?'checked':""):($budgetRange=='5.0_10.0'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;5 Lac - 10 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="10_1000" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('10_1000',$budgetRange))?'checked':""):($budgetRange=='10_1000'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;More than 10 Lac
<br class="clear">
	<?php
				}
				elseif($_REQUEST['prptranstype']['0']=='Outright' && empty($_REQUEST['prptranstype']['1']))
				{
					?>
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0_25" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0_25',$budgetRange))?'checked':""):($budgetRange=='0_25'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;Upto 25 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="25_40" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('25_40',$budgetRange))?'checked':""):($budgetRange=='25_40'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;25 Lac - 40 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="40_60" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('40_60',$budgetRange))?'checked':""):($budgetRange=='40_60'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;40 Lac - 60 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="60_100" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('60_100',$budgetRange))?'checked':""):($budgetRange=='60_100'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;60 Lac - 1 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="100_150" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('100_150',$budgetRange))?'checked':""):($budgetRange=='100_150'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;1 Cr - 1.5 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="150_200" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('150_200',$budgetRange))?'checked':""):($budgetRange=='150_200'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;1.5 Cr - 2 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="200_300" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('200_300',$budgetRange))?'checked':""):($budgetRange=='200_300'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;2 Cr - 3 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="300_500" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('300_500',$budgetRange))?'checked':""):($budgetRange=='300_500'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;3 Cr - 5 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="500_1000" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('500_1000',$budgetRange))?'checked':""):($budgetRange=='500_1000'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;5 Cr - 10 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="1000_500000" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('1000_500000',$budgetRange))?'checked':""):($budgetRange=='1000_500000'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;More than 10 Cr
<br class="clear">
	<?php
				}else{

					?>

<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0_25" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0_25',$budgetRange))?'checked':""):($budgetRange=='0_25'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;Upto 25 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="25_40" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('25_40',$budgetRange))?'checked':""):($budgetRange=='25_40'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;25 Lac - 40 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="40_60" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('40_60',$budgetRange))?'checked':""):($budgetRange=='40_60'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;40 Lac - 60 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="60_100" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('60_100',$budgetRange))?'checked':""):($budgetRange=='60_100'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;60 Lac - 1 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="100_150" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('100_150',$budgetRange))?'checked':""):($budgetRange=='100_150'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;1 Cr - 1.5 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="150_200" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('150_200',$budgetRange))?'checked':""):($budgetRange=='150_200'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;1.5 Cr - 2 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="200_300" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('200_300',$budgetRange))?'checked':""):($budgetRange=='200_300'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;2 Cr - 3 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="300_500" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('300_500',$budgetRange))?'checked':""):($budgetRange=='300_500'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;3 Cr - 5 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="500_1000" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('500_1000',$budgetRange))?'checked':""):($budgetRange=='500_1000'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;5 Cr - 10 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="1000_500000" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('1000_500000',$budgetRange))?'checked':""):($budgetRange=='1000_500000'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;More than 10 Cr
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0_0.1" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0_0.1',$budgetRange))?'checked':""):($budgetRange=='0_0.1'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;Upto 10 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0.1_0.5" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0.1_0.5',$budgetRange))?'checked':""):($budgetRange=='0.1_0.5'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;10 Th - 50 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0.5_0.8" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0.5_0.8',$budgetRange))?'checked':""):($budgetRange=='0.5_0.8'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;50 Th - 80 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="0.8_1.2" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('0.8_1.2',$budgetRange))?'checked':""):($budgetRange=='0.8_1.2'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;80 Th - 120 Th
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="1.2_2.0" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('1.2_2.0',$budgetRange))?'checked':""):($budgetRange=='1.2_2.0'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;1.2 Lac - 2 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="2.0_5.0" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('2.0_5.0',$budgetRange))?'checked':""):($budgetRange=='2.0_5.0'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;2 Lac - 5 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="5.0_10.0" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('5.0_10.0',$budgetRange))?'checked':""):($budgetRange=='5.0_10.0'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;5 Lac - 10 Lac
<br class="clear">
<input
	onclick="javascript:submitpropertytablefrm()"
	onchange="javascript:submitpropertytablefrm()" type="checkbox"
	name="budgetrange[]" value="10_1000" class="budgetrange"
	<?=(isset($budgetRange)?(is_array($budgetRange)?((in_array('10_1000',$budgetRange))?'checked':""):($budgetRange=='10_1000'?'checked':'')):(''));?> />
&nbsp;&nbsp;&nbsp;More than 10 Lac
<br class="clear">
<?php
}
?>