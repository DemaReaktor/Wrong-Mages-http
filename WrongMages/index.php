<?php 
if(!$_SESSION)
session_start();

include_once 'Classes.php';

Settings::init();
$page = new Page(Settings::$inst->language);
$page->echo_content(Settings::get_inst()->page);
?>
