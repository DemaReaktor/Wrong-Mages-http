<?php
class Config{
//    public static $folder = 'https://demareaktor.github.io/Wrong-Mages-site/';
   public static $folder = 'E:/Github/Wrong-Mages/';
   public static $languages = ['ua','uk'];
   public static $pages = array(
'main'=>'index.html',
'guide'=>'html/guide.html',
'news'=>'html/news.html',
'plans'=>'html/plans.html',
'tokenomic'=>'html/tokenomic.html',
'feedback'=>'html/feedback.html'
);
}
class Settings{
    public $page;
    static $inst;
    public static function init(){
        self::$inst = new self();
        return self::$inst;
    }
    public static function get(){
        return self::$inst;
    }
}
class Page{
    public static function content($name){
        $name = strip_tags($name);
        return file_get_contents(Config::$folder.Config::$pages[$name]);
    }
}
class TechnicalWork{
    public static function send_message($text){
        echo $text;
        echo self::get_image();
    }
    public static function get_image(){
        return '<img id=\'technical-work\' src=\''.Config::$folder.'images/TechnicalWork.jpg\'>
        <style>
        #technical-work{
            width: 100px;
            height:100px;
        }
        </style>';
    }
}
class Language{
    public static function set_value($language){
        $language = strip_tags($language);
        if(in_array($language,Config::$languages))
            setcookie('language',$language);
    }
    public static function get_path(){
        return $_COOKIE['language']??'ua';
    }
}

// class Comment_panel{
//     $name;
//     $text;
//     $inst;

//     public static function init(){
//         self::$inst = new self();
//         echo file_get_contents(Config::$folder.'html/comment.html');
//     }
//     // public static function get_self(){
//     //     return self::$inst;
//     // }
//     // public function add_comment(){
        
//     // }
// }
?>