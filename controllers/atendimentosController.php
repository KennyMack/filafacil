<?php
    require_once('baseController.php');
    require_once('entities/atendimentos.php');
    /**
    * atendimentosController
    */
    class atendimentosController extends baseController
    {
        private $db = null;
        private $atendimentosModel = null;

        function __construct($database)
        {
            $this->db = $database;
            $this->atendimentosModel = new Atendimentos($this->db);
        }

        public function select()
        {
            return $this->atendimentosModel->getSelect();
        }

        public function save($type, $body)
        {
                $this->atendimentosModel->setCodFila(parent::getField($body, "codfila"));
                $this->atendimentosModel->setDtInicio(parent::getField($body, "dtinicio"));
                $this->atendimentosModel->setDtFim(parent::getField($body, "dtfim"));

            if ($type === 'POST') 
            {
                return $this->atendimentosModel->insert();
            }
            else if ($type === 'PUT') 
            {
                $this->atendimentosModel->setCodatendimento(parent::getField($body, "codatendimento", -1));
                return $this->atendimentosModel->update();
            }
        }

        public function remove($id)
        {
            $this->atendimentosModel->setCodatendimento($id);
            return $this->atendimentosModel->delete();
        }

    }
?>
