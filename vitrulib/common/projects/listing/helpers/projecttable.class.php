<?php
class ProjectTable
{
	public function render()
	{
		// setup the table with the appropriate filter, sorting, pagination and data managers.
		$params = array();
		$params['type'] = 'Projects';
		$table = new PhpTable("projecttable");
		$table->filtermanager = new ProjectSearchForm();
		$table->paginationmanager = new PaginationManager();
		$table->datasource = new ProjectTableData();
		$table->title = "Project Search Result";
		
		// finally render the response.
		$table->render($params);
	}
}
?>