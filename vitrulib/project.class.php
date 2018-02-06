<?php

require_once 'businesscomponent.php';
require_once 'constants.php';
require_once 'area.class.php';
require_once 'developersgallerycallout.class.php';
require_once 'loginmanager.class.php';

class Project extends PhpBusinessComponent
{

    public static $budgetFieldMapping = array(
        '0_25' => 'ZeroToTwentyfive',
        '25_40' => 'TwentyfiveToForty',
        '40_60' => 'FortyToSixty',
        '60_100' => 'SixtyToOnehundred',
        '100_150' => 'OnehundredToOnefifty',
        '150_200' => 'OnefiftyToTwohundred',
        '200_300' => 'TwohundredToThreehundred',
        '300_500' => 'ThreehundredToFivehundred',
        '500_1000' => 'FivehundredToOnethousand',
        '1000_500000' => 'OnethousandToFivehundredthousand');
    public static $bedroomFieldMapping = array(
        '1' => 'OneBed',
        '1.5' => 'OnePlusHalfBed',
        '2' => 'TwoBed',
        '2.5' => 'TwoPlusHalfBed',
        '3' => 'ThreeBed',
        '3.5' => 'ThreePlusHalfBed',
        '4' => 'FourBed',
        '5' => 'FiveBed',
        '6' => 'SixBed',
        '7' => 'SevenBed',
        '8+' => 'EightPlus');
    public static $oldBudgetFieldMapping = array(
        '0_25' => 'ZeroToTwentyfive',
        '25_40' => 'TwentyfiveToForty',
        '40_60' => 'FortyToSixty',
        '60_100' => 'SixtyToOnehundred',
        '100_150' => 'OnehundredToOnefifty',
        '150_200' => 'OnefiftyToTwohundred',
        '200_300' => 'TwohundredToThreehundred',
        '300_500' => 'ThreehundredToFivehundred',
        '500_1000' => 'FivehundredToOnethousand',
        '1000_500000' => 'OnethousandToFivehundredthousand');

    public function Project($name = 'WebsiteProject_BC')
    {
        $this->PhpBusinessComponent($name, VitruUtils::getServerUrl());
    }

    public function projects($set = array(), $predicate = array(), $sortspec = array(), $pagenav = array())
    {
        $fieldset = $predicate['FieldSet'];
        $bitmap = $predicate['BitMap'];

        // create the bitmap.
        $predicate = array('FieldSet' => $fieldset, 'BitMap' => $bitmap);

        //add a sortspec
        $sortspec = array('LAST_UPD' => 'DESC');

        // fire the query.
        return $this->select($set, VitruUtils::addAppID($predicate), $sortspec, $pagenav);
    }

    public function projectsByRID($prjids)
    {
        $fieldset = array('Yes');
        $bitmap = 'PushToWebsite = ?&&';

        // form the predicate contributed by the row_ids
        if (isset($prjids) && !empty($prjids))
        {
            $temp = '';
            foreach ($prjids as $k => $v)
            {
                if (!empty($temp))
                {
                    $temp .= '||';
                }
                $temp .= 'ROW_ID = ?';
                $fieldset[] = $v;
            }
            $bitmap = $bitmap . '(' . $temp . ')';
        }
        $bitMap = rtrim($bitMap, "&");

        // form the predicate
        $predicate = array('FieldSet' => $fieldset, 'BitMap' => $bitmap);

        // fire the query.
        $records = $this->select(array(), VitruUtils::addAppID($predicate));

        // return only the data.
        return $records['Record'];
    }

    public function hotProjects($pagesize = 3)
    {
        $fieldset = array('Yes', 'Yes','363670412314726072');
        $bitmap = 'HotOrNot = ?&&PushToWebsite = ?&&ROW_ID=?';
        $pagespec = array("PageSize" => $pagesize, "Window" => 0);
        $predicate = array('FieldSet' => $fieldset, 'BitMap' => $bitmap);
        $records = $this->select(array(), VitruUtils::addAppID($predicate), array('LAST_UPD' => 'DESC'), $pagespec);
        return $records['Record'];
    }

    public function getDevelopersProjects($builderId, $pagespec)
    {

        $fieldset = array($builderId);
        $bitmap = 'BuilderFirmName = ?';
        $predicate = array('FieldSet' => $fieldset, 'BitMap' => $bitmap);
        $records = $this->select(array(), VitruUtils::addAppID($predicate), array('LAST_UPD' => 'DESC'), $pagespec);
        return $records;
    }

    public static function getProjectBedroom($bed)
    {
        if (array_key_exists($bed, Project::$bedroomFieldMapping))
        {
            return Project::$bedroomFieldMapping[$bed];
        }
        return '';
    }

    public static function getProjectBedroomKey($bed)
    {
        if (in_array($bed, Project::$bedroomFieldMapping))
        {
            return array_search($bed, Project::$bedroomFieldMapping);
        }
        return '';
    }

    public static function getProjectBudget($minPrice = '0', $maxPrice = '500000')
    {
        $returnArr = array();
        if ($minPrice != '0' || $maxPrice != '500000')
        {
            $minFound = false;
            $maxFound = false;
            foreach (Project::$budgetFieldMapping as $key => $value)
            {
                if ($minPrice == $key)
                {
                    $minFound = true;
                }
                if ($maxPrice == $key)
                {
                    $maxFound = true;
                }
                if ($minFound && !$maxFound)
                {
                    $returnArr[] = $value;
                }
            }
        }
        return $returnArr;
    }

    public static function getOldProjectBudget($budgetRange)
    {
        return $budgetRange == '' ? '' : Project::$oldBudgetFieldMapping[$budgetRange];
    }

    public static function generateTitle($project)
    {
        // set the title and meta tags
        VitruUtils::setTitle($project['Neighbourhood']);
    }

    public static function generateMetaTags($project)
    {
        // set the description meta tag.
        $description = $project['WebsiteTitle'] . ' ' . $project['ProjectName'] . ' by ' . $project['BuilderFirmName'] . ', ' . strip_tags($project['WebsiteDescription']);
        VitruUtils::addMetaTag('description', $description);

        // set the title meta tag.
        VitruUtils::addMetaTag('title', $project['Neighbourhood']);
    }

    public static function projectTitle($project)
    {
        $title = '<a title="' . $project['ProjectName'] . '" href="' . Project::detailPage($project) . '">' . $project['ProjectName'] . '</a>, <a title="' . $project['ProjectStreet'] . '" href="' . Area::getAreaPage($project['ProjectStreet'], $project['ProjectCity']) . '">' . $project['ProjectStreet'] . '</a>, <a title="' . $project['ProjectCity'] . '" href="' . Area::getCityPage($project['ProjectCity']) . '">' . $project['ProjectCity'] . '</a> by <a title="' . $project['BuilderFirmName'] . '" href="' . DevelopersGalleryCallout::developersDetailPage($project['BuilderFirmName']) . '">' . $project['BuilderFirmName'] . '</a>';
        return $title;
    }

    public static function detailPage($project, $absolute = false, $view = 'detail')
    {
        $detailPage = '';
        $itemid = VitruUtils::getItemID('project-detail');
        if ($absolute)
        {
            $detailPage = JURI::root();
        }
        if (isset($itemid))
        {
            $detailPage .= 'index.php?option=com_projectsearch&view=' . $view . '&Itemid=' . $itemid;
        }
        else
        {
            $detailPage .= 'index.php?option=com_projectsearch&view=' . $view;
        }
        // if this flag has been set to true then we add th extra parameters used by the property component
        // router to create the SEF URL's.
        if (VitruUtils::seoEnabled())
        {
            $detailPage .= (!isset($project['Neighbourhood']) || empty($project['Neighbourhood']) ? '' : '&p=' . urlencode($project['Neighbourhood']));
            $detailPage .= (!isset($project['AreaName']) || empty($project['AreaName']) ? '&a=' . urlencode($project['CityName']) : '&a=' . urlencode($project['AreaName']));
        }
        $detailPage .= '&projectid=' . $project['ROW_ID'];
        return $detailPage;
    }

    public static function generateAddress($project)
    {
        $address = '';
        //$address.=((isset($project['LocalityName']) && !empty($project['LocalityName'])) ? ($project['LocalityName'].', ') : '');
        $address.=((isset($project['ProjectStreet']) && !empty($project['ProjectStreet'])) ? ($project['ProjectStreet'] . ', ') : '');
        $address.=((isset($project['ProjectCity']) && !empty($project['ProjectCity'])) ? ($project['ProjectCity'] . ', ') : '');
        $address.=((isset($project['ProjectZip']) && !empty($project['ProjectZip'])) ? ($project['ProjectZip'] . ', ') : '');
        //$address .= rtrim(rtrim($address, ' '), ',');
        $address.=('India');
        return $address;
    }

    public static function projectHeadTitle($project)
    {
        $projectName = '<a href="' . Project::detailPage($project) . '" class="midtextlink" title="' . $project['ProjectName'] . '">' . $project['ProjectName'] . '</a>';
        //		$developerName = '<a href="'.Developer::getDetailPageByName($project['BuilderName']).'" class="midtextlink" title="'.$project['BuilderName'].'">'.$project['BuilderName'].'</a>';
        $areaName = '<a href="' . Area::getAreaPage($project['AreaName'], $project['RegionName'], $project['CityName']) . '" class="midtextlink" title="' . $project['AreaName'] . '">' . $project['AreaName'] . '</a>';
        $regionName = '<a class="midtextlink" href="index.php?option=com_localitybrowser&view=region&Itemid=7&city=' . $project['CityName'] . '&region=' . ($project['RegionName'] == 'All Bengaluru' ? 'All Bangalore' : $project['RegionName']) . '" title="' . $project['RegionName'] . '">' . ($project['RegionName'] == 'All Bengaluru' ? 'All Bangalore' : $project['RegionName']) . '</a>';
        $title = $projectName . ', ' . $developerName . ', ' . $areaName . ', ' . $regionName;
        return $projectName;
    }

    public static function ProjectBudgetFilterPage($budget)
    {
        $itemid = VitruUtils::getItemID('projects');
        $query = '';
        if (isset($_REQUEST['beds']) && !empty($_REQUEST['beds']))
        {
            $query .= '&beds=' . $_REQUEST['beds'];
        }

        if (isset($_REQUEST['area']) && !empty($_REQUEST['area']))
        {
            $query .= '&area=' . $_REQUEST['area'];
        }
        return 'index.php?option=com_projectsearch&view=allprojectsphp&budget=' . $budget . '' . $query . '&Itemid=' . $itemid;
    }

    public static function ProjectBedFilterPage($beds)
    {
        $itemid = VitruUtils::getItemID('projects');
        $query = '';
        if (isset($_REQUEST['budget']) && !empty($_REQUEST['budget']))
        {
            $query .= '&budget=' . $_REQUEST['budget'];
        }

        if (isset($_REQUEST['area']) && !empty($_REQUEST['area']))
        {
            $query .= '&area=' . $_REQUEST['area'];
        }
        return 'index.php?option=com_projectsearch&view=allprojectsphp&beds=' . $beds . '' . $query . '&Itemid=' . $itemid;
    }

}

?>
