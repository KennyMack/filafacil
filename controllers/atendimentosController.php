<?php
    require_once('baseController.php');
    require_once('entities/atendimentos.php');
    require_once('entities/fila.php');
    /**
    * atendimentosController
    */
    class atendimentosController extends baseController
    {
        private $db = null;
        private $atendimentosModel = null;
        private $filaModel = null;

        function __construct($database)
        {
            $this->db = $database;
            $this->atendimentosModel = new Atendimentos($this->db);
        }

        public function select()
        {
            try
            {
                return  parent::httpResponse(true, $this->atendimentosModel->getSelect());
            }
            catch (Exception $e) {
                return parent::httpResponse(false, $e->getMessage());
            }
        }

        public function finaliza($body)
        {
          $this->filaModel = new Fila($this->db);
          try
          {
            $this->filaModel->setCodFila(parent::getField($body, "codfila", -1));
            $this->filaModel->finaliza();

            return parent::httpResponse($data > 0, $this->save('POST', $body));

          } catch (Exception $e) {
              return parent::httpResponse(false, $e->getMessage());
          }
        }

        public function save($type, $body)
        {
            $this->atendimentosModel->setCodFila(parent::getField($body, "codfila", -1));
            $this->atendimentosModel->setDtInicio(parent::getField($body, "dtinicio", null));
            $this->atendimentosModel->setDtFim(parent::getField($body, "dtfim", null));
            $this->atendimentosModel->setObservacao(parent::getField($body, "observacao"));

            try
            {
                $data = '';
                if ($type === 'POST')
                {
                    $data = $this->atendimentosModel->insert();
                }
                else if ($type === 'PUT')
                {
                    $this->atendimentosModel->setCodatendimento(parent::getField($body, "codatendimento", -1));
                    $data = $this->atendimentosModel->update();
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
                $this->atendimentosModel->setCodatendimento($id);
                return parent::httpResponse(true, $this->atendimentosModel->delete());
            }
            catch (Exception $e) {
                return parent::httpResponse(false, $e->getMessage());
            }
        }

    }
?>
