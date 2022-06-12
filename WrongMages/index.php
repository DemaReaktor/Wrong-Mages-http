<?php 
include_once 'Classes.php';

Settings::init();
$page = new Page(Language::get_current_language());
$page->set_content(Settings::get_inst()->page);
?>
