<?php
require_once('config/urls.php');
require_once('baseRouter.php');
require_once('controllers/filaController.php');

/**
* filaRouter
*/
class filaRouter extends baseRouter
{
    private $filaController = null;
    private $db = null;


    function __construct($database)
    {
        $this->db = $database;
        $this->filaController = new filaController($this->db);
    }

    public function route($uri, $method, $body)
    {
        $path = $method.'-'.$uri;

        if ((bool)preg_match(urls::get_fila(), $path ))
        {
            return $this->getFila();
        }
        if ((bool)preg_match(urls::get_fila_dash(), $path ))
        {
            return $this->getFilaDash();
        }
        else if ((bool)preg_match(urls::get_fila_employee(), $path ))
        {
            $params = parent::getUriParams($uri);

            return $this->getFilaEmployee($params[0]);
        }
        else if ((bool)preg_match(urls::post_fila(), $path ))
        {
            return $this->createFila('POST', $body);
        }
        else if ((bool)preg_match(urls::post_fila_cancelar(), $path ))
        {
            return $this->cancelarFila($body);
        }
        else if ((bool)preg_match(urls::post_fila_andamento(), $path ))
        {
            return $this->andamentoFila($body);
        }
        else if ((bool)preg_match(urls::put_fila(), $path ))
        {
            return $this->alterFila('PUT', $body);
        }
        else if ((bool)preg_match(urls::delete_fila(), $path ))
        {
            $params = parent::getUriParams($uri);

            return $this->deleteFila($params[0]);
        }
        else
            http_response_code(404);
    }

    public function getFila()
    {
        return $this->filaController->select();
    }

    public function getFilaDash()
    {
        return $this->filaController->selectFilaDash();
    }

    public function getFilaEmployee($codfuncionario)
    {
        return $this->filaController->selectFilaEmployee($codfuncionario);
    }

    public function andamentoFila($body)
    {
        return $this->filaController->andamento($body);
    }

    public function cancelarFila($body)
    {
        return $this->filaController->cancelar($body);
    }

    public function createFila($type, $body)
    {
        return $this->filaController->save($type, $body);
    }

    public function alterFila($type, $body)
    {
        return $this->filaController->save($type, $body);
    }

    public function deleteFila($id)
    {
        return $this->filaController->remove($id);
    }
}
?>
