<?php 
class Model_Users extends Model
{
    protected $_table = 'users';
 
    /**
    * проверяет на соответствие пароля и его хэша 
    * @param  $serialize   string hash
    * @param  $value       string password
    * @return              bool    в случаи совпадения true else false
    */
    /*function check_hasing($serialize,$value)
    {
        $arr = unserialize($serialize);
        for ($i=0; $i < 3141; $i++) { 
            $value = md5($value.$arr['salt']);
        }
        return $value == $arr['data'];
    }*/

    /**
     * Get all articles
     * @return bool
     * пока нет времени делать через бд
     */
    public function login($login,$password)
    {
        if ($login == 'admin' && $password == '31415926') {
            return true;
        }
        return false;

    }

    /**
     * устанавливает пользователю кукис и сохраняет их 
     * значение в бд
     */
    public function setcookie() 
    {
        $value = Model::factory('Photo')->srand();
        setcookie('rememberme',$value,time()+314159,'/');
        if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
        else $ip = '';
        $sql = "INSERT INTO cookie (value, ip) VALUES ('$value','$ip')";
        DB::query(Database::INSERT,$sql)->execute();
    }

    /**
     * проверяет на существования кукиса в бд
     * @param  $cookie string - value cookie
     * @return bool
     */
    public function oath($cookie = true) 
    {
        if ($cookie == true) {
            if (isset($_COOKIE['rememberme'])) $cookie = $_COOKIE['rememberme'];
            else return false;
        }
        $sql = "SELECT * FROM cookie WHERE value = :value";
        $out = DB::query(Database::SELECT,$sql)
                ->param(':value',$cookie)->execute();
        if (isset($out[0]['id'])) return true;
        return false;
    }
}