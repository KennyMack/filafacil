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
        try
        {
            return parent::httpResponse(true, $this->filaModel->getSelect());
        }
        catch (Exception $e) {
            return parent::httpResponse(false, $e->getMessage());
        }
    }

    public function selectFilaEmployee($codfuncionario)
    {
        try
        {
            $this->filaModel->setCodFuncionario($codfuncionario);
            return parent::httpResponse(true, $this->filaModel->selectFilaEmployee());
        }
        catch (Exception $e) {
            return parent::httpResponse(false, $e->getMessage());
        }
    }

    public function save($type, $body)
    {
        $this->filaModel->setCodFuncionario(parent::getField($body, "codfuncionario", -1));
        $this->filaModel->setRa(parent::getField($body, "ra"));
        $this->filaModel->setStatus(parent::getField($body, "status", 0));

         try
         {
             $data = '';
             if ($type === 'POST')
             {
                 $data =  $this->filaModel->insert();
             }
             else if ($type === 'PUT')
             {
                 $this->filaModel->setCodFila(parent::getField($body, "codfila", -1));
                 $data =  $this->filaModel->update();
             }

             return parent::httpResponse($data > 0, $data);

        } catch (Exception $e) {
            return parent::httpResponse(false, $e->getMessage());
        }

    }

    public function andamento($body)
    {
        try
        {
            $this->filaModel->setCodFila(parent::getField($body, "codfila", -1));
            return parent::httpResponse(true, $this->filaModel->andamento());
        }
        catch (Exception $e) {
            return parent::httpResponse(false, $e->getMessage());
        }
    }

    public function remove($id)
    {
        try
        {
            $this->filaModel->setCodFila($id);
            return parent::httpResponse(true, $this->filaModel->delete());
        }
        catch (Exception $e) {
            return parent::httpResponse(false, $e->getMessage());
        }
    }
}

?>
