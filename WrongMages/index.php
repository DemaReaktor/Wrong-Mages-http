<?php 
include 'Classes.php';

Settings::init();
$page = new Page(Language::get_current_language());
echo $page->content(Settings::get_inst()->page);
?>
