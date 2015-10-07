<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Article extends Model
{
    protected $_table = 'tb_articles';

    /**
    * сохраняет стаью в бд
    * @param   $title   string  заглавиее
    * @param   $text    string  art.
    */
    public function save_all($title='',$text='')
    {
        DB::insert($this->_table, array('text','title','user','date'))
            ->values(array($text,$title,1,date("Y-m-d H:i:s")))
            ->execute();
    }

    /**
    * возвращает массив всех статьей 
    * @return  array of array 
    */
    public function get_all()
    {
        $tmp = array();
        $sql = "SELECT * FROM ".$this->_table." WHERE 1";
        $arr = DB::query(Database::SELECT, $sql)->execute();
        for ($i=0; $i < count($arr) ; $i++) { 
            $tmp[$arr[$i]['id']] = $arr[$i]['title'];
        }
        return $tmp;
    }

    /**
    * возращает массив с текстом публикации и его наз-
    * ванием, принимает йдишник статьи  
    * @return   array 
    */
    public function get_text($id)
    {
        $sql = "SELECT * FROM ".$this->_table." WHERE id = :id";
        $arr = DB::query(Database::SELECT, $sql)
            ->param(':id',$id)->execute();
        if (isset($arr[0]) && isset($arr[0]['id'])) {
            $out = array(
                    'title' => $arr[0]['title'],
                    'text'  => $arr[0]['text'],
                    'id'    => $arr[0]['id']
                );
            return $out;            
        }
        return false;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ".$this->_table." WHERE id = :id";
        DB::query(Database::DELETE,$sql)
            ->param(':id',$id)->execute();
    }

    public function update($id,$title,$text)
    {
        $sql = "UPDATE ".$this->_table." SET text = :text, title = :title WHERE id = :id";
        $query = DB::query(Database::UPDATE,$sql)
            ->parameters(array(
                ':text' => $text,
                ':id'   =>$id,
                ':title'=>$title,
                ));
        $query->execute();
    }




}

 ?>