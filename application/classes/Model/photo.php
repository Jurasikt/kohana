<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Photo extends Model
{
    protected $_table = 'tb_photo';


    /**
    * качество сохран изображения 
    * по умолчанию 75
    */
    const IMAGE_QUALITY = 55;

    /**
    *  разрешенный тип изображений
    */
    const IMAGE_TYPE = 2; // jgp

    /**
    * дир где наход фото относительно $_SERVER['DOCUMENT_ROOT']
    */
    const IMAGE_DIR = 'public/img/';


    /**
    * уменьшает размер изображения
    * @param  $file   string
    * @param  $w      int     ширина изображения
    * @param  $h      int     высота изображения 
    * @param  $dir    string  
    * @return         boolean
    */
    public function thumbnail($file, $dir,$w, $h) 
    {
        list($w1,$h1) = getimagesize($file);
        $image_p      = imagecreatetruecolor($w, $h);
        $image        = imagecreatefromjpeg($file);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $w, $h, $w1, $h1);
        if (!imagejpeg($image_p, $dir, self::IMAGE_QUALITY)) return false;
        return true;
    }

    /**
    * осуществляет проверку загружаемого изображения 
    * по exif копирует его в католог img, предварительно 
    * изменив размер до s - (180*240) m  - (600*800)
    * @param $file    string 
    * @return         mixed new file name or false(boolean)
    */
    public function load($file) 
    {
        if (exif_imagetype($file) == self::IMAGE_TYPE) {
            $name = $this->srand();
            $dir  = $_SERVER['DOCUMENT_ROOT'].URL::base().self::IMAGE_DIR;
            /*if (!is_dir($dir)) {
                mkdir($dir);
            }*/
            $this->thumbnail($file,$dir."s_".$name.'.jpg',240,180);
            $this->thumbnail($file,$dir."m_".$name.'.jpg',800,600);
            //self::thumbnail($file,$dir.$name.'-echo.jpg',240,180,true);
            return $name.'.jpg';
        }
        return false;
    }


    public function get_all()
    {
        $sql = "SELECT * FROM ".$this->_table." WHERE 1";
        $arr = DB::query(Database::SELECT, $sql)->execute();
        for ($i=0; $i < count($arr) ; $i++) { 
            $tmp[] = array(
                'file' => $arr[$i]['file'],
                'title'=> $arr[$i]['title']
                );
        }
        return $tmp;
    }


    /**
    * записывает в базу данных информацию о загру изображениях
    * @param $arr   array   двухмуерный массив с названием и описанием файлов
    */
    public function finish_load($arr = array())
    {
        $date  = date('Y_m_d H:i:s');
        $sql   = "INSERT INTO tb_photo (title, date, file, user) VALUES (:title, '$date',:file,1)";
        $query = DB::query(Database::INSERT, $sql)    
            ->bind(':title', $title)    
            ->bind(':file', $file); 
        for ($i=0; $i < count($arr) ; $i++) { 
            $title = $arr[$i]['title'];
            $file  = $arr[$i]['file'];
            $query->execute();
        }
    }


    public function rand($limit) 
    {
        $sql = "SELECT * FROM ".$this->_table.
        " WHERE 1 ORDER BY rand() LIMIT ".$limit;
        $arr = DB::query(Database::SELECT,$sql)->execute();
        for ($i=0; $i < count($arr) ; $i++) { 
            $tmp[] = array(
                'file' => $arr[$i]['file'],
                'title'=> $arr[$i]['title']
                );
        }
        return $tmp;
    }

    /**
    * генерирует случайную сторку длиной $length
    * @return string 
    */
    public function srand($length=32)
    {
        $str_shuffle = 'qsUIwoOPdfg0123456789hDHeASrV812tLZyYuNpaFJ4458i6jklCBGmQTXKxcW95MzERvb730nqq';
        $shuffle = '';
        $round       = strlen($str_shuffle)-1;
        for ($i=0; $i < $length; $i++){
            $rnd = rand(0,$round);
            $shuffle = $shuffle.$str_shuffle[$rnd];
        } 
        return $shuffle;
    }
}