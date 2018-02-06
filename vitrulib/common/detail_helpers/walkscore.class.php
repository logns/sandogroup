<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class Walkscore
{
	public function render($data)
	{
		$basicaddress = $data->basicaddress;
		if(isset($basicaddress))
		{
			?>
<script type='text/javascript'>
var ws_wsid = '3ba0a0106e46e06d98ce5eabc8ef1bb7';
var ws_address = '<?php echo $basicaddress; ?>';
var ws_width = '940';
var ws_height = '370';
var ws_layout = 'horizontal';
</script>
<style type='text/css'>
#ws-street {
    position: relative !important;
    left: 22px !important;
    top: 20px !important;
}
#ws-a {
    position: relative !important;
    top: 20px !important;
    left: 0 !important;
}

#ws-go{
   	position: relative !important;
    top: 20px !important;
    left: 2px !important;
}

#ws-walkscore-tile {
	position: relative;
	text-align: left;
	height:320px;
	float: left !important;
}

#ws-walkscore-tile * {
	float: none;
	margin-top: 10px;
}

#ws-footer a,#ws-footer a:link {
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	margin-right: 6px;
	white-space: nowrap;
	padding: 0;
	color: #000;
	font-weight: bold;
	text-decoration: none
}

#ws-footer a:hover {
	color: #777;
	text-decoration: none
}

#ws-footer a:active {
	color: #b14900
}
</style>
<div id='ws-walkscore-tile'>
<div id='ws-footer'
	style='position: absolute; top: 200px; left: 8px; width: 745px'>
<form id='ws-form'><a id='ws-a' href='http://www.walkscore.com/'
	target='_blank'>Find out your home's Walk Score:</a><input type='text'
	id='ws-street'
	style='position: absolute; top: 0px; left: 225px; width: 331px' /><input
	type='image' id='ws-go'
	src='http://www2.walkscore.com/images/tile/go-button.gif' height='15'
	width='22' border='0' alt='get my Walk Score'
	style='position: absolute; top: 0px; right: 0px' /></form>
</div>
</div>
<script
	type='text/javascript'
	src='http://www.walkscore.com/tile/show-walkscore-tile.php'></script>
			<?php
		}
		else
		{
			echo 'Walkscore has not been setup for this property';
		}
	}
}
?>
