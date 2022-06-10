<?php 
include 'Classes.php';

// function add_comment_panel(){
//     Comment_panel::init();
// }

// function add_comment(){
//     Comment_panel::get_self()->add_comment();
//     delete(Comment_panel::get_self());
// }

if($_GET['language'])
    Language::set_value($_GET['language']);
if (Language::get_path() == 'ua')
    echo Page::content($_GET['page']??'main');
else 
    TechnicalWork::send_message('Site in English is not created yet, please take another languages');
?>
