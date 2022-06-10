<?php
include 'Classes.php';

echo 'done1';
if(isset($_GET['click'])){
    echo 'done2';
    $value = strip_tags($_GET['click']);
switch($value){
    case 'add_comment_panel':
        echo 'done3';
        // Comment_panel::init();
        break;
}

}
?>