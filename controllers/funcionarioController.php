<?php
    require_once('baseController.php');
    require_once('entities/funcionario.php');
    /**
    * funcionarioController
    */
    class funcionarioController extends baseController
    {
        private $db = null;
        private $funcionarioModel = null;

        function __construct($database)
        {
            $this->db = $database;
            $this->funcionarioModel = new Funcionario($this->db);
        }

        public function select()
        {
            return $this->funcionarioModel->getSelect();
        }

        public function save($type, $body)
        {
                $this->funcionarioModel->setNome(parent::getField($body, "nome"));
                $this->funcionarioModel->setStatus(parent::getField($body, "status"));
                $this->funcionarioModel->setEmail(parent::getField($body, "email"));
                $this->funcionarioModel->setSenha(parent::getField($body, "senha"));
                $this->funcionarioModel->setDescricao(parent::getField($body, "descricao"));
                $this->funcionarioModel->setTipo(parent::getField($body, "tipo", 0));
                $this->funcionarioModel->setDisponivel(parent::getField($body, "disponivel", 0));

            if ($type === 'POST') 
            {
                return $this->funcionarioModel->insert();
            }
            else if ($type === 'PUT') 
            {
                $this->funcionarioModel->setCodfuncionario(parent::getField($body, "codfuncionario", -1));
                return $this->funcionarioModel->update();
            }
        }

        public function remove($id)
        {
            $this->funcionarioModel->setCodfuncionario($id);
            return $this->funcionarioModel->delete();
        }

    }
?>
