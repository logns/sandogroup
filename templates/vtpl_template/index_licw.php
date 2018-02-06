<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
$this->setGenerator('Realty Redefined Website');
//remove mootools.js coz it confilcts with jquery ui
$headerstuff = $this->getHeadData();
reset($headerstuff['scripts']);
$moo = 'mootools.js';
$cap = 'caption.js';
foreach ($headerstuff['scripts'] as $key => $value)
{
    if (strpos($key, $moo))
    {
        unset($headerstuff['scripts'][$key]);
    }
    if (strpos($key, $cap))
    {
        unset($headerstuff['scripts'][$key]);
    }
}

$this->setHeadData($headerstuff);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<jdoc:include type="head" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->
    baseurl; ?>/templates/vtpl_template/css/template.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->
    baseurl; ?>/templates/vtpl_template/css/slider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->
    baseurl; ?>/templates/vtpl_template/css/details.css">
 <link rel="stylesheet" type="text/css" href="<?php echo $this->
    baseurl; ?>/templates/vtpl_template/css/megamenu.css">
    <!-- SlidesJS Required: Link to jQuery -->
	
    <!-- End SlidesJS Required -->

    <!-- SlidesJS Required: Link to jquery.slides.js -->
    <script src="<?php echo $this->baseurl; ?>/templates/vtpl_template/js/jquery.slides.min.js"></script>
    <!-- End SlidesJS Required -->
    <script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/vtpl_template/js/common.js"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/vtpl_template/js/validate.js"></script>
</head>
<body>
    <!-- Header starts Here -->
    <div id="header">
        <!-- header-row-1 starts here -->
        <div id="header-row-1">
            <div id="header-row-1-wrapper">
                <jdoc:include type="modules" name="headerrow1" />
            </div>
            <!-- header-row-1-wrapper ends here --> </div>
        <!-- header-row-1 ends here -->

        <!-- header-row-2 starts here -->
        <div id="header-row-2">

            <!-- header-row-2-wrapper starts here -->
            <div id="header-row-2-wrapper">
                <jdoc:include type="modules" name="logo" />

                <p style="position: absolute; font-size: 42px; top: 36px; left: 136px;font-weight:bold;">Sando Rotary Equipments Pvt. Ltd.</p>
                <jdoc:include type="modules" name="iso" />

                <div class="clear"></div>

                <!-- Menu starts here -->
                <div id="menu">
                    <jdoc:include type="modules" name="mainmenu" />
                </div>
                <!-- Menu ends here -->
                <div id="socialmedialinks">
                    <jdoc:include type="modules" name="socialmedialinks" />

                </div>

            </div>
            <!-- header-row-2-wrapper ends here --> </div>
        <!-- header-row-2 ends here --> </div>
    <!-- Header ends Here -->

    <!-- Slider starts Here -->
   <jdoc:include type="modules" name="sliderbanner" />
    <!-- Slider ends Here -->

    <!-- click to call STARTS here -->
    <jdoc:include type="modules" name="clicktocall" />
    
    
    <!--CLICK TO CAL ENDS HERE -->
    
    
    <div id="content">
        <!-- content starts Here -->
        <div id="content-wrapper">
            <!-- content-wrapper starts Here -->
            <!-- featured-pumps-content starts here -->
            <?php
                    if ($_REQUEST['Itemid'] == '1')
                    {
                        ?>
            <jdoc:include type="modules" name="featuredpumps" />

            <!-- featured-pumps-content ends here -->
            <div class="clear"></div>

            <jdoc:include type="modules" name="homepageaboutus" />

            <!-- aboutus ends here -->

            <div id="quicklinks-content">
                <!-- quicklinks starts here -->

                <p class="blocktitle">Quick Links</p>
                <jdoc:include type="modules" name="quicklinks" />
            </div>
            <!-- quicklinks ends here -->
             <jdoc:include type="modules" name="contactus" />
            


            <div class="clear"></div>

            <!-- testimonials starts here -->
            <jdoc:include type="modules" name="testimonials" />
            <!-- testimonials ends here -->

            <jdoc:include type="modules" name="downloadprofile" />

            <div class="clear"></div>
            <?
                    } //HOME PAGE ENDS HERE

		else if ($_REQUEST['option'] == 'com_ckforms')
		{
		?>
		<p class="blocktitle">Contact Us</p>
		<jdoc:include type="component" />
		<jdoc:include type="modules" name="contactaddress" />
	<?php
		}
                    else if (($_REQUEST['option'] == 'com_content'))
                    {
                        ?>
            <jdoc:include type="component" />

            <?php } ?>
        </div>
        <!-- content-wrapper ends Here --> </div>
    <!-- content ends Here -->

    <!-- Footer starts here -->
    <div id="footer">
        <div id="footer-wrapper">
            <!-- footer-wrapper strats here -->
            <div id="footer-menu">
                <!-- footer-wrapper STARTS here -->
                <p class="menu-title">Pumps</p>
                <p class="menu-title" style="left: 228px;position: relative;">Non-Metallic Valves</p>
                <p class="menu-title" style="left: 374px;position: relative;">Mechanical Seals</p>
                <p class="menu-title" style="left: 532px;position: relative;">Other</p>
                <div class="clear"></div>
          
            
            <div class="footlinks-block">
            <jdoc:include type="modules" name="footer1" />
            </div>
            <div class="footlinks-block">
            <jdoc:include type="modules" name="footer3" />
            </div>
            
            <div class="footlinks-block">
            <jdoc:include type="modules" name="footer2" />
            </div>
            
            <div class="footlinks-block">
            <jdoc:include type="modules" name="footer4" />
            </div>
       
    </div>
    <!-- footer-menu ENDS here -->

    <p style="clear:both;" class="footer-seperator"></p>
</div>

<p style="text-align:center;margin-top:14px;font-size:13px;margin-bottom:12px;">
    Copyright &copy; 2005 Sando Group (Manufacturers of Rotary Equipments).
</p>

<form name="component-cta" id="component-cta">
    <p>Request for instant callback:</p>
    <input type="text" class="required name default-value" value="Name" name="Name">
    <input type="text" class="required number default-value" value="Mobile" name="Mobile">
    <input type="text" class="email default-value" value="E-Mail" name="EmailID">

    <input type="button" class="bttnstyle" onclick="javascript:formSubmit('component-cta', 'response-text');" value="SUBMIT">
    <p id="response-text"></p>

    <input type="hidden" name="view" value="basic">
    <input type="hidden" name="task" value="callback">
    <input type="hidden" name="option" value="com_vprospectgen">
    <input type="hidden" name="Itemid" value="">
    <input type="hidden" name="format" value="raw">
    <input type="hidden" name="tmpl" value="component">
</form>
<!-- footer-wrapper ENDS here -->


</div>
<!-- Footer ends here -->
<div class="clear"></div>
<div _megamenupos="0pos" id="megamenu1" class="megamenu">
<div class="megamenu-wrapper">

      <div class="column">
        <p class="mega_title">Pumps</p>
           <jdoc:include type="modules" name="footer1" />
      </div>

      <div class="column">
        <p class="mega_title">Non-Metallic Valves</p>
         <jdoc:include type="modules" name="footer3" />
      </div>

      <div class="column">
        <p class="mega_title">Mechanical Seals</p>
         <jdoc:include type="modules" name="footer2" />
      </div>
</div>

    </div>
</body>
</html>
