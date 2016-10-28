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

    public static function get_fila()
    {
        return '/^GET-\/fila\/?$/';
    }

    public static function post_fila()
    {
        return '/^POST-\/fila\/?$/';
    }

    public static function put_fila()
    {
        return '/^PUT-\/fila\/?$/';
    }

    public static function delete_fila()
    {
        return '/^DELETE-\/fila\/\d\/?$/';
    }

    public static function get_atendimentos()
    {
        return '/^GET-\/atendimentos\/?$/';
    }

    public static function post_atendimentos()
    {
        return '/^POST-\/atendimentos\/?$/';
    }

    public static function put_atendimentos()
    {
        return '/^PUT-\/atendimentos\/?$/';
    }

    public static function delete_atendimentos()
    {
        return '/^DELETE-\/atendimentos\/\d\/?$/';
    }
}
?>