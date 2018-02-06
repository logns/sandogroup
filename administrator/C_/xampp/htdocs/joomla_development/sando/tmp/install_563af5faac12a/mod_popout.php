<?php
defined('_JEXEC') or die('Restricted access');
require_once 'popout.class.php';

JHTML::script('cookie.js','modules/mod_popout/js/');
JHTML::script('popout.js','modules/mod_popout/js/');

$popOut = new Popout();
$popOut->render();
?>