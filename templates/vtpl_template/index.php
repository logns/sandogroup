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

require_once('vitrulib/helperClass.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
	<jdoc:include type="head" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
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

</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-N69LQ8"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N69LQ8');</script>
<!-- End Google Tag Manager -->

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
		<p class="blocktitle"></p>
		<jdoc:include type="" />
		<jdoc:include type="modules" name="" />
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
		<p style="text-align:center;margin-bottom:4px;clear:both;width:100%;position:relative;left:-13px;" class="menu-title">Non-Metallic Valves</p>
                <p class="menu-title">Pumps</p>
                <p class="menu-title" style="left: 223px;position: relative;">PP & PVDF Valves</p>
                <p class="menu-title" style="left: 365px;position: relative;">PFA / FEP Valves</p>
		<p class="menu-title" style="left: 518px;position: relative;">Mechanical Seals</p>

                <div class="clear"></div>
          
           <div class="footlinks-block" style="border-right: 1px solid grey;"> 
            <jdoc:include type="modules" name="footer1" />
            </div>

	    <div class="footlinks-block">
            <jdoc:include type="modules" name="footerPvdfValve" />
            </div>
	

            <div class="footlinks-block" style="border-right: 1px solid grey; width: 235px; margin-right: 35px;">
            <jdoc:include type="modules" name="footer3" />
            </div>


            
            <div class="footlinks-block">
            <jdoc:include type="modules" name="footer2" />
            </div>
            
       
    </div>
    <!-- footer-menu ENDS here -->

    <p style="clear:both;"></p>
</div>

<!--<p style="text-align:center;margin-top:14px;font-size:13px;margin-bottom:12px;">
    Copyright &copy; 2005 Sando Group (Manufacturers of Rotary Equipments).
</p>-->

<form name="component-cta" id="component-cta">
    <p>Request for instant callback:</p>
    <input type="text" class="required name default-value" value="Name" name="Name">
    <input type="text" class="required number default-value" value="Mobile" name="Mobile">
    <input type="text" class="required email default-value" value="E-Mail" name="EmailID">
    <!--<input type="text" class="default-value" value="Country" name="Country">-->
    <?php echo helperClass::renderCountryCode('component-cta-CountryCode'); ?>
    <input type="text" class="default-value" value="City" name="City">

    <input type="button" class="bttnstyle" onclick="javascript:formSubmit('component-cta', 'response-comp');" value="SUBMIT">
    <input type="hidden" name="Source" value="Request for instant callback">
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
<div id="overlay"></div>
<div id="response-comp"></div>

<div _megamenupos="0pos" id="megamenu1" class="megamenu">
<div class="megamenu-wrapper">
	<p class="mega_title" style="text-align:center;width:100%;clear:both;font-size:16px;font-weight:bold;color:#fff;">Non Metallic Valves</p>

	<div class="column" style="width: 210px;">
        <p class="mega_title">Pumps</p>
           <jdoc:include type="modules" name="footer1" />
      </div>

      <div class="column">
        <p class="mega_title">PP & PVDF Valves</p>
         <jdoc:include type="modules" name="footerPvdfValve" />
      </div>

      <div class="column">
        <p class="mega_title">PFA / FEP Valves</p>
         <jdoc:include type="modules" name="footer3" />
      </div>
	

      <div class="column" style="width:168px;">
        <p class="mega_title">Mechanical Seals</p>
         <jdoc:include type="modules" name="footer2" />
      </div>
</div>

    </div>
    <!-- SlidesJS Required: Link to jquery.slides.js -->
    <script src="<?php echo $this->baseurl; ?>/templates/vtpl_template/js/jquery.slides.min.js"></script>
    <!-- End SlidesJS Required -->
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/vtpl_template/js/validate.js"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/vtpl_template/js/common.js"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/vtpl_template/js/vai.js"></script>
</body>
</html>
