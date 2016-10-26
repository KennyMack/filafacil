<?php

    class Atendimento
    {

        $codatendimento = null;
        $codfila = null;
        $dtInicio = null;
        $dtFim = null;

        function __construct(argument)
        {
            # code...
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

    }

?>
