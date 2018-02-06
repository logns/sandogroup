<?php
require_once 'attachment.class.php';
require_once 'project.class.php';

class ProjectRender
{

    public static function renderProject($project)
    {
        $desc = strip_tags($project['WebsiteDescription']);
        $desc = strlen($desc) > 320 ? substr($desc, 0, 317) . '...' : $desc;
        $logo = Attachment::attachmenturlbypath($project['ThumbnailSaveFilePath'], $project['FileName']);
        $price = isset($project['CostRange']) ? $project['CostRange'] : 'Price on request';
        ?>

        <div class="project-listing">
            <div class="single-project">
                <div class="images"><a
                        href="<?php echo Project::detailPage($project); ?>"> <?php ProjectRender::renderLogo($project['ROW_ID']); ?>
                        <img src="<?php echo $logo; ?>" class="mainimage" /> </a>

                    <form style="margin: 8px 0px 5px;" id="prjCta-<?php echo $project['ROW_ID']; ?>" class="prjCta"
                          onsubmit="return false;"><input style="width: 82px;" type="text" class="required number default-value"
                                                    name="Mobile" value="enter mobile no." />

                        <input type="hidden" value="<?php echo $project['ProjectName']; ?>" name="Name">
                        <input type="hidden" value="nomail@sobhadeveloperspune.in" name="EmailID">
                        <input type="hidden" value="<?php echo $project['ROW_ID']; ?>" name="projectid">
                        <input type="hidden" value="" name="projectname">
                        <input type="hidden" value="raw" name="format">
                        <input type="hidden" value="siteVisit" name="task">
                        <input type="hidden" value="basic" name="view">
                        <input type="hidden" value="com_vprospectgen" name="option">
                        <input type="hidden" value="<?php echo $_REQUEST['Itemid']; ?>" name="Itemid">

                        <a class="call-me"
                           onclick="javascript:formSubmit('#prjCta-<?php echo $project['ROW_ID']; ?>', '.responseDiv', 'googleSiteVisit');"></a>
                    </form>


                </div>
                <div class="prj-details">
                    <div class="prj-title">
                        <p class="title"><a href="<?php echo Project::detailPage($project); ?>"><span><?php echo $project['ProjectName']; ?>,</span><br />
                                <?php echo $project['ProjectStreet']; ?></a> <br />
                            <?php
                            echo '<strong class="siteVisitPop" rel="price'. $project['ROW_ID'].'">' . $price . '</strong>';
                            ?></p>
                        <p class="group-buying"><a href="#">Hot<br>Project</a></p>
                    </div>
                    
                    <div class="pricepopup" id="price<?php echo $project['ROW_ID']; ?>">
                        <div class="headingPopup">Price
                            <a class="close_price">&times;</a>
                        </div>
                        <div class="requestforprice">
                            <form id="requestforprice" onsubmit="return false;" name="requestforprice">
                                <table>
                                    <tr>
                                        <td>
                                            <div>Please enter the details below to get the detailed pricing information.</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" value="Name" class="required name default-value" name="Name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" value="Enter Mobile No." class="number default-value required" name="Mobile">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input id="ajaxMessage" type="hidden" name="message" value="We have forwarded your request to the concerned department. We will get back to you with detailed pricing.">
                                            <input type="hidden" name="projectid" value="<?php echo $project['ROW_ID']; ?>">
                                            <input type="hidden" name="EmailID" value="pricerequest@sobhadeveloperspune.in">
                                            <input type="hidden" name="format" value="raw">
                                            <input type="hidden" name="task" value="siteVisit">
                                            <input type="hidden" name="view" value="basic">
                                            <input type="hidden" name="option" value="com_vprospectgen">
                                            <input type="hidden" name="Itemid" value="2">
                                            <a class="proceed" onclick="javascript:formSubmit('#requestforprice', '.responseDiv', 'googleSiteVisit');">Proceed</a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    
                    <div class="prj-info">
                        <table style="width: 312px;">
                            <tr>
                                <td valign="top"><?php if (isset($desc) && !empty($desc)) : ?>
                                        <div class="description">
                                            <?php if (!empty($project['Plan'])) : ?>
                                                <span>Plan: <?php echo $project['Plan']; ?></span><br>
                                            <?php endif; ?>
                                            <?php if (!empty($project['Sizes'])) : ?>
                                                <span>Sizes: <?php echo $project['Sizes']; ?></span><br>
                                            <?php endif; ?>
                                            <span class="usp">Project USPs:</span>
                                            <p style="color:#969595"><?php echo $desc; ?></p>
                                        </div>
                                    <?php endif; ?></td>

                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    public static function renderLogo($rowid)
    {
        $attachmentBC = new Attachment();
        $attachments = $attachmentBC->attachmentsByParent($rowid);
        ?>

        <?php
        $counter = 0;
        if (isset($attachments) && !empty($attachments))
        {
            foreach ($attachments as $Idx => $attachment)
            {
                if ($counter == 1)
                {
                    break;
                }
                else
                {
                    if ($attachment['Category'] == 'logo')
                    {
                        $counter++;
                        $image = Attachment::attachmenturlbypath($attachment['ThumbnailSaveFilePath'], $attachment['FilePath']);
                        echo '<img class="devLogo" src="' . $image . '"/>';
                    }
                }
            }
        }
        ?>
        <?php
    }

    public static function renderDetailmenu($project)
    {
        $link = $_REQUEST['view'];
        echo '<ul>';
        $class = '';
        if ($link === 'detail')
        {
            $class = 'active';
        }
        echo '<li><a href="' . Project::detailPage($project, '', 'detail') . '" class="' . $class . '">Overview</a></li>';
        $class = '';
        if ($link === 'photogallery')
        {
            $class = 'active';
        }
        echo '<li><a href="' . Project::detailPage($project, '', 'photogallery') . '" class="' . $class . '">Photo Gallery</a></li>';
        $class = '';
        if ($link === 'floorplans')
        {
            $class = 'active';
        }
        echo '<li><a href="' . Project::detailPage($project, '', 'floorplans') . '" class="' . $class . '">Floor Plans</a></li>';
        $class = '';
        if ($link === 'walkscore')
        {
            $class = 'active';
        }
        echo '<li><a href="' . Project::detailPage($project, '', 'walkscore') . '" class="' . $class . '">Neighbourhood</a></li>';
        $class = '';
        if ($link === 'location')
        {
            $class = 'active';
        }
        echo '<li><a href="' . Project::detailPage($project, '', 'location') . '" class="' . $class . '">Location Details</a></li>';

        $class = '';
        /*if ($link === 'specifications')
        {
            $class = 'active';
        }
        echo '<li><a href="' . Project::detailPage($project, '', 'specifications') . '" class="' . $class . '">Specifications</a></li>';
         * 
         */

        echo '</ul>';
    }

    public static function getAllConfigHTML($configs, $detail = false)
    {
        $html = '';
        $counter = 0;
        $totalCount = count($configs);
        if (isset($configs) && count($configs) > 0)
        {
            $html .= '<table width="100%" cellspacing="0">';
            $html .= '<tr class="head">';
            $html .= '<td class="table_head">Bedrooms</td>';
            $html .= '<td class="table_head">Saleable Area</td>';
            $html .= '<td class="table_head" style="border-right:none !important;">Price</td>';
            $html .= '</tr>';
            foreach ($configs as $idx => $config)
            {
                $html .= ProjectRender::getConfigurationHTML($config, $counter++, $detail, $totalCount);
            }
            $html .= '</table>';
        }
        else
        {
            $html = '<p id="config-response"> There are no configurations for this project.</p>';
        }
        return $html;
    }

    public static function getConfigurationHTML($config, $counter, $detail = false, $totalCount)
    {
        if ($counter < $totalCount - 1)
        {
            $html = '<tr class="projectdetails">';
            $html .= '<td class="details_td">' . (isset($config['Configuration']) && !empty($config['Configuration']) ? $config['Configuration'] : 'Not Specified') . '</td>';
            $html .= '<td class="details_td">' . (isset($config['SaleableArea']) && !empty($config['SaleableArea']) && ($config['SaleableArea'] != 0.0) ? $config['SaleableArea'] . ' SQFT' : 'Not Specified') . '</td>';
            $html .= '<td class="details_td"><span class="siteVisitPop">Click for Price</span></td>';
            $html .= '</tr>';
        }
        else
        {
            $html = '<tr class="projectdetails last">';
            $html .= '<td class="details_td last">' . (isset($config['Configuration']) && !empty($config['Configuration']) ? $config['Configuration'] : 'Not Specified') . '</td>';
            $html .= '<td class="details_td last">' . (isset($config['SaleableArea']) && !empty($config['SaleableArea']) && ($config['SaleableArea'] != 0.0) ? $config['SaleableArea'] . ' SQFT' : 'Not Specified') . '</td>';
            $html .= '<td class="details_td last"><span class="siteVisitPop">Click for Price</span></td>';
            $html .= '</tr>';
        }
        return $html;
    }

}
?>
