<?php
class PropertyTable
{
	public function render()
	{
		// setup the table with the appropriate filter, sorting, pagination and data managers.
		$params = array();
		$params['type'] = 'Properties';
		$table = new PhpTable("propertytable");
		$table->filtermanager = new PropertySearchForm();
		$table->paginationmanager = new PaginationManager();
		$table->datasource = new PropertyTableData();
		$table->title = "Property Search Result";
		
		// finally render the response.
		$table->render($params);
	}
}
?>