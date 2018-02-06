<?php
defined('_JEXEC') or die('Restricted access');

class Popout {

    public function render() {
        $targetpage = JURI::root(true);
        $targetpage .= '/index.php';
        ?>
        <div class="box firstBox" id="box">
            <div id="popup-main">
                <p class="skip-button" onclick="closePopoutDialog('box');"></p>
                <form name="popupForm" id="popupForm" action="index.php" method="get" onsubmit="return false;"> 

                    <div>

                        <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="10" colspan="3" align="right"></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" height="60" ><span class="text" style="text-align: center; float: none;">Looking to buy a property?</span></td>
                            </tr>

                            <tr>
                                <td colspan="3" align="center"><span class="desc">Please enter your details below, and we will get back to you</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="right" valign="top">
                                    <input name="Name" value="Enter your name" type="text" class="textbox default-value required name" />
                                </td>
                                <td align="left" valign="top">
                                    <input name="Mobile" value="Enter your mobile number" type="text" class="textbox default-value number required" minlength="10" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center"></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <input name="Input" type="image" src="templates/vtpl_template/images/submit.png" style="margin: 10px 0 0; border: none;" onclick="javascript:formSubmit('#popupForm', '#offersProgressBoxMobile', 'googlePopup');" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center" valign="top">
                                    <div id="offersProgressBoxMobile" style="position: relative; right: 2%; top: 0px; width: 330px;"></div>
                                </td>
                            </tr>

                        </table>

                    </div>

                    <div class="continive">
                        <input type="hidden" name="EmailID" value="popup@popup.com" />
                        <input type="hidden" name="format" value="raw" />
                        <input type="hidden" name="task" value="callback" /> 
                        <input type="hidden" name="option" value="com_vprospectgen" /> 
                        <input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid']; ?>" />
                        <input type="hidden" value="ICICI Home Search Pune - Popup Form" name="Source">
                        <input type="hidden" value="" name="pageUrl" class="pageUrl">
                    </div>
                </form>
            </div>
        </div>


        <!--  Second Step Offer  -->
        <div class="box secBox" id="secBox">
            <div id="popup-main">
                <p class="skip-button" onclick="closeSecPopoutDialog('secBox');"></p>
                <div>

                    <table width="93%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="10" colspan="3" align="right"></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center" height="235"><span class="text" style="text-align: center; float: none;">Thank you</span></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center" valign="top">
                            </td>
                        </tr>

                    </table>

                </div>

            </div>
        </div>

        <?php
    }

}
?>
