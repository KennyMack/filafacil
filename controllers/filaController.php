<?php
require_once('baseController.php');
require_once('entities/fila.php');

/**
* filaController
*/
class filaController extends baseController
{
    private $db = null;
    private $filaModel = null;
    
    function __construct($database)
    {
        $this->db = $database;
        $this->filaModel = new Fila($this->db);
    }

    public function select()
    {
        return $this->filaModel->getSelect();
    }

    public function save($type, $body)
    {
        $this->filaModel->setCodFuncionario(parent::getField($body, "codfuncionario"));
        $this->filaModel->setRa(parent::getField($body, "ra"));
        $this->filaModel->setStatus(parent::getField($body, "status", 0));

        if ($type === 'POST') 
        {
            return $this->filaModel->insert();
        }
        else if ($type === 'PUT') 
        {
            $this->filaModel->setCodFila(parent::getField($body, "codfila", -1));
            return $this->filaModel->update();
        }

    }

        public function remove($id)
        {
            $this->filaModel->setCodFila($id);
            return $this->filaModel->delete();
        }
}

?>
