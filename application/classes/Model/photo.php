<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Photo extends Model
{
    protected $_table = 'tb_photo';

    /**
    * дир где наход фото относительно $_SERVER['DOCUMENT_ROOT']
    */
    const IMAGE_DIR = 'public/img/';



    /**
    * осуществляет проверку загружаемого изображения на jpg(jpeg)
    * по exif!!! копирует его в католог img, предварительно 
    * изменив размер до s - max(300*300) m  - max(800*800) схранив пропорции
    * @param $file    string 
    * @return         mixed new file name or false(boolean)
    */
    public function load($file) 
    {
        if (exif_imagetype($file) == 2) {
            $name = Text::random('alnum',32).'.jpg';
            $dir  = $_SERVER['DOCUMENT_ROOT'].URL::base().self::IMAGE_DIR;
            Image::factory($file)
                ->resize(300, 300, Image::AUTO)
                ->save($dir.'s_'.$name);
            Image::factory($file)
                ->resize(800, 800, Image::AUTO)
                ->save($dir.'m_'.$name);
            return $name;
        }
        return false;
    }



    public function get_all()
    {
        $tmp = array();
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
        $date  = date('Y-m-d H:i:s');
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
        $tmp = array();
        $sql = "SELECT * FROM ".$this->_table.
        " WHERE 1 ORDER BY rand() LIMIT ".$limit;
        $arr = DB::query(Database::SELECT,$sql)->execute();
        for ($i=0; $i < count($arr) ; $i++) {
            $tmp[$arr[$i]['file']] = $arr[$i]['title'];
        }
        return $tmp;
    }

}