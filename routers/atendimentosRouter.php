<?php
require_once('config/urls.php');
require_once('baseRouter.php');
require_once('controllers/atendimentosController.php');
/**
* atendimentosRouter
*/
class atendimentosRouter extends baseRouter
{
    private $atendimentosController = null;
    private $db =null;


    function __construct($database)
    {
        $this->db = $database;
        $this->atendimentosController = new atendimentosController($this->db);
    }

    public function route($uri, $method, $body)
    {
        $path = $method.'-'.$uri;

        if ((bool)preg_match(urls::get_atendimentos(), $path ))
        {
            return $this->getAtendimentos();
        }
        else if ((bool)preg_match(urls::post_atendimentos(), $path ))
        {
            return $this->createAtendimentos('POST', $body);
        }
        else if ((bool)preg_match(urls::post_atendimentos_termina(), $path ))
        {
            return $this->finalizaAtendimentos($body);
        }
        else if ((bool)preg_match(urls::put_atendimentos(), $path ))
        {
            return $this->alterAtendimentos('PUT', $body);
        }
        else if ((bool)preg_match(urls::delete_atendimentos(), $path ))
        {
            $params = parent::getUriParams($uri);

            return $this->deleteAtendimentos($params[0]);
        }
        else
            http_response_code(404);
    }

    public function getAtendimentos()
    {
        return $this->atendimentosController->select();
    }

    public function createAtendimentos($type, $body)
    {
        return $this->atendimentosController->save($type, $body);
    }

    public function finalizaAtendimentos($body)
    {
        return $this->atendimentosController->finaliza($body);
    }

    public function alterAtendimentos($type, $body)
    {
        return $this->atendimentosController->save($type, $body);
    }

    public function deleteAtendimentos($id)
    {
        return $this->atendimentosController->remove($id);
    }
}
?>
