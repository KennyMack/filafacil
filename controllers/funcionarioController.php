<?php
    require_once('baseController.php');
    /**
    * funcionarioController
    */
    class funcionarioController extends baseController
    {
        private $db = null;
        private $funcionarioModel = null;

        function __construct($database)
        {
            require_once('entities/funcionario.php');
            $this->db = $database;
            $this->funcionarioModel = new Funcionario($this->db);
        }

        public function select()
        {
            return $this->funcionarioModel->getSelect();
        }

        public function save($type, $body)
        {

                $this->funcionarioModel->nome = parent::getField($body, "nome");
                $this->funcionarioModel->status = parent::getField($body, "status");
                $this->funcionarioModel->email = parent::getField($body, "email");
                $this->funcionarioModel->senha = parent::getField($body, "senha");
                $this->funcionarioModel->descricao = parent::getField($body, "descricao");
                $this->funcionarioModel->tipo = parent::getField($body, "tipo", 0);
                $this->funcionarioModel->disponivel = parent::getField($body, "disponivel", 0);

            if ($type === 'POST') 
            {
                return $this->funcionarioModel->insert();
            }
            else if ($type === 'PUT') 
            {
                $this->funcionarioModel->codfuncionario = parent::getField($body, "codfuncionario", -1);
                return $this->funcionarioModel->update();

            }
        }

        public function remove($id)
        {
            $this->funcionarioModel->codfuncionario = $id;
            return $this->funcionarioModel->delete();
        }

    }
?>
