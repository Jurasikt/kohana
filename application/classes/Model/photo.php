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
    * копирует его в католог img, предварительно 
    * изменив размер до s - max(300*300) m  - max(800*800) схранив пропорции
    * @param $file    string  полное имя файла 
    * @return         mixed new file name or false(boolean)
    */
    public function load($file,$id = '') 
    {

        if (
            !Upload::valid($file) ||
            !Upload::not_empty($file) ||
            !Upload::type($file, array('jpg', 'jpeg'))
            ) {
            return false;
        }
        $dir  = DOCROOT.self::IMAGE_DIR;
        if ($image = Upload::save($file, NULL, $dir)) {
            if ($id == '') {
                $id = Text::random('alnum',32);
            }
            $name = $id.'.jpg';
            Image::factory($image)
                ->resize(300, 300, Image::AUTO)
                ->save($dir.'s_'.$name);
            Image::factory($image)
                ->resize(800, 800, Image::AUTO)
                ->save($dir.'m_'.$name);
            unlink($image);
            return $name;       
        }
        return false;
    }

    /**
     * возвращает список файлов изображений 
     * @param $offset  int смещение в запросе селект 
     * @param $limit   int 
     * @return         array - двумерный массив с названием файлов 
     *                         и заглавием изображений
     */ 
    public function get_limit($offset,$limit = 6)
    {
        $tmp = array();
        $sql = "SELECT * FROM ".$this->_table." LIMIT ".$limit." OFFSET ".$offset;
        $arr = DB::query(Database::SELECT, $sql)->execute();
        foreach ($arr as $value) {
            $tmp[] = array(
                'file' => Arr::get($value,'file',''),
                'title'=> Arr::get($value,'title',''),
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
        $query = DB::insert($this->_table, array('title','date','file','user'))
                    ->values(array(&$title, date("Y-m-d H:i:s"), &$file,1));
        foreach ($arr as $value) {
            $title = Arr::get($value,'title','');
            $file  = Arr::get($value,'file','');
            $query->execute();
        }
    }

    /**
    * возвращает имя файла и соответствующее ему название фото 
    * случайно выбраное из бд.
    * @param  $limit  int 
    * @return         array
    */
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

    /**
    * возвращает суммарное число изображений в бд
    * @return int
    */
    public function count()
    {
        $sql = "SELECT count(*) FROM ".$this->_table;
        return (int)DB::query(Database::SELECT,$sql)->execute()[0]["count(*)"];
    }

}