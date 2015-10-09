<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Article extends Model
{
    protected $_table = 'tb_articles';

    /**
    * сохраняет стаью в бд
    * @param   $title   string  заглавиее
    * @param   $text    string  art.
    */
    public function save_item($title='',$text='')
    {
        DB::insert($this->_table, array('text','title','user','date'))
            ->values(array($text,$title,1,date("Y-m-d H:i:s")))
            ->execute();
    }

    /**
    * возвращает массив всех статьей 
    * @return  array of array если таблица пуста то пустой массив
    */
    public function get_items()
    {
        $items = DB::select()
            ->from($this->_table)
            ->execute()
            ->as_array('id','title');
        return $items;
    }

    /**
    * возращает массив с текстом публикации и его наз-
    * ванием, принимает айдишник статьи  
    * @return   array 
    */
    public function get_item_by_id($id)
    {
        $item = DB::select()
            ->from($this->_table)
            ->where('id','=',$id)
            ->execute()
            ->current();
        return (count($item) == 0)?false:
            array(
                'title'=>$item['title'],
                'text'=> $item['text'],
                'id'=>$item['id']
            );
    }

    /**
    * удаляет стаью 
    * @param $id   int 
    */
    public function delete_item($id)
    {
        DB::delete($this->_table)
            ->where('id','=',$id)
            ->execute();
    }


    /**
    * обновляет содержимое статьи 
    * @param  $id    int      
    * @param  $title string новое заглавие 
    * @param  $text  string содержание статьи  
    */
    public function update_item($id,$title,$text)
    {
        DB::update($this->_table)
            ->set(array(
                'text' => $text,
                'title'=>$title,
                ))
            ->where('id','=',$id)
            ->execute();
    }




}

 ?>