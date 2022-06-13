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
    protected $gets;
    public $page;
    public $language;
    static $inst;

    public static function init(){
        self::$inst = new self();
        // unset($_SESSION['comments-name']);

        self::$inst->language = new Language($_COOKIE['language']);
        if(isset($_POST['language_x'])){
            self::$inst->language->next_language();
            self::$inst->language->set_cookie();
        }

        if(isset($_POST['comment-name'])){
            $com =  new Comment($_POST['comment-name'],$_POST['comment-text']);
            $com->add_comment();
        }

        self::$inst->gets = $_GET;

        self::$inst->page = strip_tags($_GET['page']??'main');

        return self::$inst;
    }
    public function change_get($key,$value){
        self::$inst->gets[$key] = $value;
    }

    public function get_gets(){
        $text = '';

        if(self::$inst->gets){
            $text = '?';

            foreach(array_keys(self::$inst->gets) as $element)
                $text = $text.$element.'='.self::$inst->gets[$element].'&';
        }

        return $text;
    }

    public static function get_inst(){
        return self::$inst;
    }
}
class Component{
    protected $language;
    protected $name = 'main';
    protected $file;

    function __construct(string $name,Language $language){
        $this->language = new Language($language->value);
        if(in_array($name,Config::$pages))
            $this->name = $name;

        $this->file = Config::$folder.'html/'.$this->language->value.'/'.Config::$pages[$this->name].'.php';

        if(!file_exists($this->file)){
                $this->file = Config::$folder.'html/ua/'.Config::$pages[$this->name].'.php';
                $this->language = new Language();
            }
        }
    public function get_name(){ return $this->name; }
    public function get_language(){ return $this->language; }
    public function get_file(){ return $this->file; }
}

class Page{
    protected $language;

    function __construct(Language $language){
        $this->language = $language;
    }
    public function get_language(){
        return $this->language;
    }

    public function echo_content($name){
        $name = strip_tags($name);

        $page = new Component($name, $this->language);

        $menu = new Component('menu',$this->language);

        foreach([$menu
        ,$page
        ] as $element){
            if($element->get_language()->value!=$this->language->value)
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
    public $value = 'ua';

    public function __construct(string $value='ua'){
        $value = strip_tags($value);

        if(in_array($value,Config::$languages))
            $this->value = $value;
    }

    public function set_cookie(){
        setcookie('language',$this->value);
        $_COOKIE['language'] = $this->value;
    }

    public function next_language(){
        $count = count(Config::$languages);
        $index = array_search($this->value,Config::$languages) + 1;

        if($index == $count)
            $index = 0;

        $this->value = Config::$languages[$index];
        return $this->value;
    }
    public static function get_current_language(){
        return $_COOKIE['language']??'ua';
    }
}
class Comment{
    public $name;
    public $text;

    public function __construct(string $name,string $text){
        $this->name = strip_tags($name);
        $this->text = strip_tags($text);
    }
    public function add_comment(){
        if(!isset($_SESSION['comments-name'])){
            $_SESSION['comments-name'] = [];
            $_SESSION['comments-text'] = [];
        }

        $_SESSION['comments-name'][count($_SESSION['comments-name'])+1] = $this->name;
        $_SESSION['comments-text'][count($_SESSION['comments-text'])+1] = $this->text;
    }
    public static function echo_comments(){
        if(isset($_SESSION['comments-name']))
            for($i = 0;$i < count($_SESSION['comments-name']);$i++){
                echo '<div class="user-commnet-table">
                    <p class="user-commnet-name">'.$_SESSION['comments-name'][$i].'</p>
                    <p class="user-commnet-text" >'.$_SESSION['comments-text'][$i].'</p>
                    </div>';
            }
        }
    }
?>