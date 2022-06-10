<?php
class Config{
//    public static $folder = 'https://demareaktor.github.io/Wrong-Mages-site/';
   public static $folder = 'D:/wamp/apache2/htdocs/WrongMages/';
   public static $languages = ['ua','uk'];
   public static $pages = ['main'=>'index','guide','news','plans','tokenomic','feedback'];
}
class Settings{
    public $page;
    static $inst;

    public static function init(){
        self::$inst = new self();

        if($_GET['language'])
            Language::set_value($_GET['language']);
            self::$inst->page = strip_tags($_GET['page']??'main');
        return self::$inst;
    }
    public static function get(){
        return self::$inst;
    }
}
class Page{
    protected $language = 'ua';

    function __construct(string $language= 'ua'){
        if(in_array($language,Config::$languages))
            $this->language = $language;
    }

    public function content($name){
        $name = strip_tags($name);

        $page = file_get_contents(Config::$folder.'html/'.$this->language.'/'.self::get_page($name));

        if($page==false)
            return TechnicalWork::send_message('ця сторінка з цією мовою ще не створена').
            file_get_contents(Config::$folder.'html/ua/'.self::get_page($name));
        return $page;
    }

    public static function get_page($name){
        if(in_array($name,Config::$pages))
            return Config::$pages[$name].'.html';
        return 'index.html';
    }
}
class TechnicalWork{
    public static function send_message($text){
        echo $text;
        echo self::get_image();
    }
    public static function get_image(){
        return '<img id=\'technical-work\' src=\'https://demareaktor.github.io/Wrong-Mages-site/images/TechnicalWork.jpg\'>
        <style>
        #technical-work{
            width: 300px;
            height:300px;
        }
        </style>';
    }
}
class Language{
    public static function set_value($language){
        $language = strip_tags($language);
        if(in_array($language,Config::$languages)){
            setcookie('language',$language);
            $_COOKIE['language'] = $language;
        }
    }
    public static function get_current_language(){
        return $_COOKIE['language']??'ua';
    }
}
?>