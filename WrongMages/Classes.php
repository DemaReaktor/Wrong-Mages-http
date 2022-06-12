<?php
class Config{
   public static $git_folder = 'https://demareaktor.github.io/Wrong-Mages-site/';
   public static $folder = 'D:/wamp/apache2/htdocs/WrongMages/';
   public static $languages = ['ua','uk'];
   public static $pages = ['main'=>'index','guide'=>'guide','news'=>'news','plans'=>'plans','tokenomic'=>'tokenomic','feedback'=>'feedback','menu'=>'menu'];
}
interface ISingleton{
    public static function init();
    public static function get_inst();
}
class Settings implements ISingleton{
    public $gets;
    public $page;
    static $inst;

    public static function init(){
        self::$inst = new self();

        if($_POST['language'])
            Language::set_value($_POST['language']);
        if($_GET['language'])
            Language::set_value($_GET['language']);
        self::$inst->page = strip_tags($_GET['page']??'main');

        return self::$inst;
    }
    public static function get_inst(){
        return self::$inst;
    }
}
class Component{
    protected $language = 'ua';
    protected $name = 'main';
    protected $file;

    function __construct(string $name,string $language = 'ua'){
        if(in_array($language,Config::$languages))
            $this->language = $language;
        if(in_array($name,Config::$pages))
            $this->name = $name;

        $this->file = Config::$folder.'html/'.$this->language.'/'.Config::$pages[$this->name].'.php';

        if(!file_exists($this->file)){
                $this->file = Config::$folder.'html/ua/'.Config::$pages[$this->name].'.php';
                $this->language = 'ua';
            }
        }
    public function get_name(){ return $this->name; }
    public function get_language(){ return $this->language; }
    public function get_file(){ return $this->file; }
}

class Page{
    protected $language = 'ua';

    function __construct(string $language= 'ua'){
        if(in_array($language,Config::$languages))
            $this->language = $language;
    }

    public function next_language(){
        if($this->language=='ua')
        return 'uk';
        return 'ua';
    }

    public function set_content($name){
        $name = strip_tags($name);

        $page = new Component($name, $this->language);

        $menu = new Component('menu',$this->language);

        foreach([$menu
        ,$page
        ] as $element){
            if($element->get_language()!=$this->language)
                echo TechnicalWork::get_message('ця сторінка з цією мовою ще не дороблена');
            include $element->get_file();    
        }
    }
}
class TechnicalWork{
    public static function get_message($text){
        return $text.self::get_image();
    }
    public static function get_image(){
        return '<img id=\'technical-work\' src=\'https://demareaktor.github.io/Wrong-Mages-site/images/TechnicalWork.jpg\'>
        <style>
        #technical-work{
            width: 280px;
            height:280px;
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