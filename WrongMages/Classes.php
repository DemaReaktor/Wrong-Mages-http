<?php
class Config{
//    public static $folder = 'https://demareaktor.github.io/Wrong-Mages-site/';
   public static $folder = 'D:/wamp/apache2/htdocs/WrongMages/';
   public static $languages = ['ua','uk'];
   public static $pages = ['main'=>'index','guide'=>'guide','news'=>'news','plans'=>'plans','tokenomic'=>'tokenomic','feedback'=>'feedback','menu'=>'menu'];
}
interface ISingleton{
    public static function init();
    public static function get_inst();
}
class Settings implements ISingleton{
    public $page;
    static $inst;

    public static function init(){
        self::$inst = new self();

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
    protected $text;

    function __construct(string $name,string $language = 'ua'){
        if(in_array($language,Config::$languages))
            $this->language = $language;
        if(in_array($name,Config::$pages))
            $this->name = $name;

        $this->text = file_get_contents(Config::$folder.'html/'.$this->language.'/'.Config::$pages[$this->name].'.html');
        if($this->text == null){
            $this->text = file_get_contents(Config::$folder.'html/ua/'.Config::$pages[$this->name].'.html');
            $this->language = 'ua';
        }
    }
    public function get_name(){ return $this->name; }
    public function get_language(){ return $this->language; }
    public function get_text(){ return $this->text; }
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

    public function content($name){
        $name = strip_tags($name);

        $page = new Component($name, $this->language);

        $menu = new Component('menu',$this->language);
        $text= '';

        foreach([$menu,$page] as $element){
            if($element->get_language()!=$this->language)
                $text = $text.TechnicalWork::get_message('ця сторінка з цією мовою ще не дороблена');
            $text = $text.$element->get_text();    
        }

        foreach([
            ['{language}',$this->language],
            ['{next_language}',$this->next_language()]]
            as $element)
                $text = str_replace($element[0],$element[1],$text);

        return $text;
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
        echo gettype($language);
    }
}
?>