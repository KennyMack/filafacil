<?php
/**
*   urls
*/
class urls 
{
    public static function get_funcionario()
    {
        return '/^GET-\/funcionario\/?$/';
    }

    public static function post_funcionario()
    {
        return '/^POST-\/funcionario\/?$/';
    }

    public static function put_funcionario()
    {
        return '/^PUT-\/funcionario\/?$/';
    }

    public static function delete_funcionario()
    {
        return '/^DELETE-\/funcionario\/\d\/?$/';
    }
}
?>