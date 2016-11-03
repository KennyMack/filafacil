<?php

    class Atendimentos
    {

        private $codAtendimento = null;
        private $codFila = null;
        private $dtInicio = null;
        private $dtFim = null;
        private $db = null;
        private $observacao = null;
        private $codFuncionario = null;

        function __construct($database)
        {
            $this->db = $database;
        }

        public function getCodFuncionario()
        {
            return $this->$codFuncionario;
        }

        public function setCodFuncionario($pCodFuncionario)
        {
            $this->codFuncionario = $pCodFuncionario;
        }

        public function getCodAtendimento()
        {
            return $this->codAtendimento;
        }

        public function setCodAtendimento($pCodAtendimento)
        {
            $this->codAtendimento = $pCodAtendimento;
        }

        public function getCodFila()
        {
            return $this->codFila;
        }

        public function setCodFila($pCodFila)
        {
            $this->codFila = $pCodFila;
        }

        public function getDtInicio()
        {
            return $this->dtInicio;
        }

        public function setDtInicio($pDtInicio)
        {
            $this->dtInicio = $pDtInicio;
        }

        public function getDtFim()
        {
            return $this->dtFim;
        }

        public function setDtFim($pDtFim)
        {
            $this->dtFim = $pDtFim;
        }

        public function getObservacao()
        {
            return $this->observacao;
        }

        public function setObservacao($pObservacao)
        {
            $this->observacao = $pObservacao;
        }

        public function getSelect()
        {
            return $this->db->getJson('SELECT atendimentos.codatendimento,
                                                                     atendimentos.codfila,
                                                                     atendimentos.dtinicio,
                                                                     atendimentos.dtfim,
                                                                     atendimentos.observacao
                                                          FROM atendimentos');
        }

        public function getEmployeeFila()
        {
            return $this->db->getJson('SELECT atendimentos.codatendimento,
                                       atendimentos.codfila,
                                       fila.ra,
                                       atendimentos.dtinicio,
                                       atendimentos.dtfim,
                                       atendimentos.observacao
                                  FROM atendimentos
                            INNER JOIN fila
                                    ON (atendimentos.codfila = fila.codfila)
                                 WHERE fila.codfuncionario = :codfuncionario
                                 ORDER BY atendimentos.codatendimento DESC',
                            array(
                                ':codfuncionario' => $this->codFuncionario));
        }

        public function insert()
        {
            $sql = 'INSERT INTO atendimentos (codfila, dtinicio, dtfim, observacao)
                                                   VALUES (:codfila, :dtinicio, :dtfim, :observacao)';


            $params = array(
                ':codfila' => $this->codFila,
                ':dtinicio' => $this->dtInicio,
                ':dtfim' =>  $this->dtFim,
                ':observacao' => $this->observacao);

            return $this->db->save($sql, $params);
        }

        public function update()
        {
            $sql = 'UPDATE atendimentos
                              SET codfila = :codfila,
                                     dtinicio = :dtinicio,
                                     dtfim = :dtfim,
                                     observacao = :observacao
                        WHERE codatendimento = :codatendimento';


            $params = array(
                ':codfila' => $this->codFila,
                ':dtinicio' => $this->dtInicio,
                ':dtfim' =>  isset($this->dtFim) ? $this->dtFim : null,
                ':observacao' => isset($this->observacao) ? $this->observacao : null,
                ':codatendimento' => $this->codAtendimento);

            return $this->db->update($sql, $params);
        }

        public function delete()
        {
            $sql = 'DELETE
                           FROM atendimentos
                        WHERE codatendimento = :codatendimento';

            $params = array(
                ':codatendimento' => $this->codAtendimento);

            return $this->db->remove($sql, $params);
        }


    }

?>
