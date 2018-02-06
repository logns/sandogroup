<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_leads
{
	public static function showfilterHeader(){

		?>
<table width="100%">
	<tr>
		<td>
		<form name="containsFilterForm" id="filterForm" method="post" action="index.php">
			Filter:&nbsp;<input type="text" value="<?php echo isset($_POST['key']) ? $_POST['key'] : '';?>" onchange="document.containsFilterForm.submit();" class="text_area" value="" id="search" name="key">
			<button onclick="this.form.submit();">Search</button>
			<button onclick="document.getElementById('search').value='';this.form.submit();">Reset</button> 
			<input type="hidden" name="option" value="com_leads" /> 
			<input type="hidden" name="filterType" value="getContainsFilterQuery" />
		</form>
		</td>
		<td align="right">
		<form name="dateFilterForm" id="filterForm" method="post" action="index.php">
			Filter:&nbsp;<input type="text" value="<?php echo isset($_POST['leaddate']) ? $_POST['leaddate'] : '';?>" onchange="document.containsFilterForm.submit();" class="text_area" value="" id="leaddate" name="leaddate">
			<button onclick="this.form.submit();">Search</button> 
			<input type="hidden" name="option" value="com_leads" /> 
			<input type="hidden" name="filterType" value="getDateFilterQuery" />
		</form>
		</td>
		<td align="right">
		
		<span class="preview"><a href="index.php?option=com_leads&call=call" target="_blank">Export</a></span>
		</td>
	</tr>
</table>



		<?php
	}

	function showLeads( $option, &$rows, &$pageNav )
	{
		?>
<form action="index.php" method="post" name="adminForm">
<table class="adminlist">
	<thead>
		<tr>
			<!--			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>-->
			<th class="title">Lead Name</th>
			<th width="15%">Mobile</th>
			<th width="10%">EMAIl</th>
			<th width="10%">CDT</th>
			<th width="10%">Lead Point</th>
			<th width="5%" nowrap="nowrap">IP</th>
			<th width="10%">Campaign</th>
			<th width="10%">AdGroup</th>
			<th width="10%">Keyword</th>
			<th width="10%">MatchType</th>
			<th width="10%">Distribution</th>
			<th width="10%">AdID</th>
			<th width="10%">Placement</th>
		</tr>
	</thead>
	<?php
	jimport('joomla.filter.output');
	$k = 0;
	for ($i=0, $n=count( $rows ); $i < $n; $i++)
	{
		$row = &$rows[$i];
		$checked = JHTML::_('grid.id', $i, $row->id );
		$published = JHTML::_('grid.published', $row, $i );
		$link = JFilterOutput::ampReplace( 'index.php?option=' . $option . '&task=edit&cid[]='. $row->id );
		?>
	<tr class="<?php echo "row$k"; ?>">
		<!--<td><?php echo $checked; ?></td> -->
		<td><?php echo $row->Name; ?></td>
		<td><?php echo $row->Mobile; ?></td>
		<td><?php echo $row->EmailID; ?></td>
		<td><?php echo $row->cdt; ?></td>
		<td><?php echo $row->leadpoint; ?></td>
		<td><?php echo $row->ip; ?></td>
		<td><?php echo $row->Campaign; ?></td>
		<td><?php echo $row->AdGroup; ?></td>
		<td><?php echo $row->Keyword; ?></td>
		<td><?php echo $row->MatchType; ?></td>
		<td><?php echo $row->Distribution; ?></td>
		<td><?php echo $row->AdID; ?></td>
		<td><?php echo $row->Placement; ?></td>
	</tr>
	<?php
	$k = 1 - $k;
	}
	?>
	<tfoot>
		<td colspan="13"><?php echo $pageNav->getListFooter(); ?></td>
	</tfoot>
</table>
<input type="hidden" name="option" value="<?php echo $option;?>" /> <input
	type="hidden" name="task" value="" /> <input type="hidden"
	name="boxchecked" value="0" /> <?php echo JHTML::_( 'form.token' ); ?>
</form>
	<?php
	}
}
?>