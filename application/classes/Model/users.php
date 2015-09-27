<?php 
class Model_Users extends Model
{
    protected $_table = 'users';
 
    const SALT = 'ffsfsfDzdnjfSJVK5sf';


	/**
	* проверяет на соответствие пароля и его хэша 
	* @param  $serialize   string hash
	* @param  $value       string password
	* @return              bool    в случаи совпадения true else false
	*/
	/*function check_hasing($serialize,$value)
	{
		$arr = unserialize($serialize);
		if (self::SALT == $arr['salt']) {
			for ($i=0; $i < 35478 ; $i++) { 
				$value = md5($value.$arr['salt']);
			}		
		} else {
			for ($i=0; $i < 3141; $i++) { 
				$value = md5($value.$arr['salt']);
			}
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
        if ($login == 'admin' && $password == '31415926') return true;
        return false;

    }

    /**
     * устанавливает пользователю кукис и сохраняет их 
     * значение в бд
     * @return bool 
     */
    public function setcookie() 
    {

    }
}