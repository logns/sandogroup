<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JTable::addIncludePath(JPATH_COMPONENT.DS.'tabless');

class ExportToExcel {

	function ExportToExcel(){
		global $mainframe;
		$db =& JFactory::getDBO();

		$sql = 'SELECT * FROM jos_leads;';

		$db->setQuery($sql);
		$rows = $db->loadAssocList();

		## If the query doesn't work..
		if (!$db->query() ){
			echo "<script>alert('Please report your problem.');
         window.history.go(-1);</script>\n";
		}

		## Empty data vars
		$data = "";
		## We need tabbed data
		$sep = "\t";

		$fields = (array_keys($rows[0]));

		## Count all fields(will be the collumns
		$columns = count($fields);
		## Put the name of all fields to $out.
		for ($i = 0; $i < $columns; $i++) {
			$data .= $fields[$i].$sep;
		}

		$data .= "\n";

		## Counting rows and push them into a for loop
		for($k=0; $k < count( $rows ); $k++) {
			$row = $rows[$k];
			$line = '';

			## Now replace several things for MS Excel
			foreach ($row as $value) {
				$value = str_replace('"', '""', $value);
				$line .= '"' . $value . '"' . "\t";
			}
			$data .= trim($line)."\n";
		}

		$data = str_replace("\r\n","",$data);

		## If count rows is nothing show o records.
		if (count( $rows ) == 0) {
			$data .= "\n(0) Records Found!\n";
		}

		## Push the report now!
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=leads-".date("d-m-y").".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		print $data;
		die();
	}

}