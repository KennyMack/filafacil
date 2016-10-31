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
            try
            {
                return parent::httpResponse(true, $this->funcionarioModel->getSelect());
            }
            catch (Exception $e) {
                return parent::httpResponse(false, $e->getMessage());
            }
        }

        public function selectAvailable()
        {
            try
            {
                return parent::httpResponse(true, $this->funcionarioModel->getSelectAvailable());
            }
            catch (Exception $e) {
                return parent::httpResponse(false, $e->getMessage());
            }
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

            try
            {
                $data = '';
                if ($type === 'POST')
                {
                    $data = $this->funcionarioModel->insert();
                }
                else if ($type === 'PUT')
                {
                    $this->funcionarioModel->setCodfuncionario(parent::getField($body, "codfuncionario", -1));
                    $data = $this->funcionarioModel->update();
                }

                return parent::httpResponse($data > 0, $data);

            } catch (Exception $e) {
                return parent::httpResponse(false, $e->getMessage());
            }
        }

        public function remove($id)
        {
            try
            {
                $this->funcionarioModel->setCodfuncionario($id);
                return parent::httpResponse(true, $this->funcionarioModel->delete());
            }
            catch (Exception $e) {
                return parent::httpResponse(false, $e->getMessage());
            }
        }

    }
?>
