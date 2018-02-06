<?php
require_once JPATH_BASE.DS.'vitrulib/constants.php';

class PaginationManager
{
	var $targetpage = 'index.php';
	var $defaultpagesize = 10;
	var $defaultpage = 0;
	var $defaultadjacents = 1;
	var $skipParams = array('page','prjcb','cartfunc','generateprospect','slideoutonload');

	function getPageSize()
	{
		if($_REQUEST['option'] === 'com_sitemap'){
			return (isset($_REQUEST['pagesize']) ? $_REQUEST['pagesize'] : '200');
		}else{
			return (isset($_REQUEST['pagesize']) ? $_REQUEST['pagesize'] : $this->defaultpagesize);
		}
	}

	function getPageSpec()
	{
		return array("PageSize" => $this->getPageSize(), "Window" => isset($_REQUEST['page']) ? $_REQUEST['page'] - 1 : 0);
	}

	function render(&$params = array())
	{
		$pagination = "<div class=\"paginationholder\">";

		// before we even start to make the pagination string we need to make the drop down for the pagesize.
		$pagination .= '<select style="display: none;" id="paginationpagesize" name="pagesize" class="prpsrchfrm" onchange="javascript:submitpropertytablefrm();">';
		$pagination .= '	<option value="10"'.(isset($_REQUEST['pagesize'])?($_REQUEST['pagesize']=='10'?' selected':''):' selected').'>10</option>';
		$pagination .= '	<option value="15"'.(isset($_REQUEST['pagesize'])?($_REQUEST['pagesize']=='15'?' selected':''):'').'>15</option>';
		$pagination .= '	<option value="20"'.(isset($_REQUEST['pagesize'])?($_REQUEST['pagesize']=='20'?' selected':''):'').'>20</option>';
		$pagination .= '</select>';

		$querystring = VitruUtils::getQueryString($this->skipParams);
		//$querystring .= '#filterform';

		// How many adjacent pages should be shown on each side?
		$adjacents = $this->defaultadjacents;
		// get total number of rows in data table.
		$total_pages = $params['tablerowcount'];
		// name of the target page.
		$targetpage = $this->targetpage;
		// how many items to show per page
		$limit = $this->getPageSize();
		$page = $_REQUEST['page'];
		if($page)
		{
			// first item to display on this page
			$start = ($page - 1) * $limit;
		}
		else
		{
			// if no page var is given, set start to 0
			$start = 0;
		}

		// Setup page vars for display.
		// if no page var is given, default to 1.
		if ($page == 0)
		{
			$page = 1;
		}

		// previous page is page - 1
		$prev = $page - 1;
		// next page is page + 1
		$next = $page + 1;
		// lastpage is = total pages / items per page, rounded up.
		$lastpage = ceil($total_pages/$limit);
		// last page minus 1
		$lpm1 = $lastpage - 1;

		// Now we apply our rules and draw the pagination object.
		// We're actually saving the code to a variable in case we want to draw it more than once.
		if($lastpage > 1)
		{
			$pagination .= "<div class=\"pagination\">";

			// previous button
			if ($page > 1)
			{
				$pagination.= "<a href=\"$targetpage?page=$prev&$querystring\"><div class=\"previous\"></div></a>";
			}
			else
			{
				$pagination.= "<span class=\"disabled\"><div class=\"link\"></div></span>";
			}

			// pages
			// not enough pages to bother breaking it up
			if ($lastpage < 7 + ($adjacents * 2))
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
					{
						$pagination.= "<span class=\"current\">$counter</span>";
					}
					else
					{
						$pagination.= "<a href=\"$targetpage?page=$counter&$querystring\"><div class=\"link\">$counter</div></a>";
					}
				}
			}
			// enough pages to hide some
			elseif($lastpage > 5 + ($adjacents * 2))
			{
				// close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
						{
							$pagination.= "<span class=\"current\">$counter</span>";
						}
						else
						{
							$pagination.= "<a href=\"$targetpage?page=$counter&$querystring\"><div class=\"link\">$counter</div></a>";
						}
					}
					$pagination.= "<span class=\"disabled\">...</span>";
					$pagination.= "<a href=\"$targetpage?page=$lpm1&$querystring\"><div class=\"link\">$lpm1</div></a>";
					$pagination.= "<a href=\"$targetpage?page=$lastpage&$querystring\"><div class=\"link\">$lastpage</div></a>";
				}
				// in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"$targetpage?page=1&$querystring\"><div class=\"link\">1</div></a>";
					if($page != 3)
					{
						$pagination.= "<a href=\"$targetpage?page=2&$querystring\"><div class=\"link\">2</div></a>";
					}
					//$pagination.= "<span class=\"disabled\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
						{
							$pagination.= "<span class=\"current\">$counter</span>";
						}
						else
						{
							$pagination.= "<a href=\"$targetpage?page=$counter&$querystring\"><div class=\"link\">$counter</div></a>";
						}
					}
					$pagination.= "<span class=\"disabled\">...</span>";
					$pagination.= "<a href=\"$targetpage?page=$lpm1&$querystring\"><div class=\"link\">$lpm1</div></a>";
					$pagination.= "<a href=\"$targetpage?page=$lastpage&$querystring\"><div class=\"link\">$lastpage</div></a>";
				}
				// close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"$targetpage?page=1&$querystring\"><div class=\"link\">1</div></a>";
					$pagination.= "<a href=\"$targetpage?page=2&$querystring\"><div class=\"link\">2</div></a>";
					$pagination.= "<span class=\"disabled\">...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
						{
							$pagination.= "<span class=\"current\">$counter</span>";
						}
						else
						{
							$pagination.= "<a href=\"$targetpage?page=$counter&$querystring\"><div class=\"link\">$counter</div></a>";
						}
					}
				}
			}

			// next button
			if ($page < $counter - 1)
			{
				$pagination.= "<a href=\"$targetpage?page=$next&$querystring\"><div class=\"next\"></div></a>";
			}
			else
			{
				$pagination.= "<span class=\"disabled\"><div class=\"link\"></div></span>";
			}
			$pagination.= "</div>\n";
		}

		$pagination .= '</div>';
		echo $pagination;
	}
}
?>