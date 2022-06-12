<?php 
include_once 'Classes.php';

$count = count(Config::$languages);
$index = array_search(Language::get_current_language(),Config::$languages) + 1;

if($index == $count)
    $index = 0;

Language::set_value(Config::$languages[$index]);
include_once 'index.php';
?>
