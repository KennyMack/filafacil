<?php

    class Atendimentos
    {

        private $codAtendimento = null;
        private $codFila = null;
        private $dtInicio = null;
        private $dtFim = null;
        private $db = null;

        function __construct($database)
        {
            $this->db = $database;
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

        public function getSelect()
        {
            return $this->db->getJson('SELECT atendimentos.codatendimento,
                                                                     atendimentos.codfila,
                                                                     atendimentos.dtinicio,
                                                                     atendimentos.dtfim
                                                          FROM atendimentos');
        }

        public function insert()
        {
            $sql = 'INSERT INTO atendimentos (codfila, dtinicio, dtfim)
                                                   VALUES (:codfila, :dtinicio, :dtfim)';

            $params = array(
                ':codfila' => $this->codFila,
                ':dtinicio' => $this->dtInicio,
                ':dtfim' => $this->dtFim);

            return $this->db->save($sql, $params);
        }

        public function update()
        {
            $sql = 'UPDATE atendimentos
                              SET codfila = :codfila,
                                     dtinicio = :dtinicio,
                                     dtfim = :dtfim
                        WHERE codatendimento = :codatendimento';
            
            $params = array(
                ':codfila' => $this->codFila,
                ':dtinicio' => $this->dtInicio,
                ':dtfim' => $this->dtFim,
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
