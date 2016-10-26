<?php

    class Fila
    {
        $codFila = null;
        $ra = null;
        $codFuncionario = null;
        $status = null;

        function __construct(argument)
        {
            # code...
        }

        public function getCodFila()
        {
            return $this->codFila;
        }

        public function setCodFila($pCodFila)
        {
            $this->codFila = $pCodFila;
        }

        public function getCodFuncionario()
        {
            return $this->codFuncionario;
        }

        public function setCodFuncionario($pCodFuncionario)
        {
            $this->codFuncionario = $pCodFuncionario;
        }

        public function getRa()
        {
            return $this->ra;
        }

        public function setRa($pRa)
        {
            $this->ra = $pRa;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($pStatus)
        {
            $this->status = $pStatus;
        }
    }
?>
