<?php

  class Funcionario
  {
    $codFuncionario = null;
    $nome = null;
    $status = null;
    $email = null;
    $senha = null;
    $descricao = null;
    $disponivel = null;
    $dtCadastro = null;
    $tipo = null;

    function __construct(argument)
    {
      # code...
    }

    public function getCodFuncionario()
    {
        return $this->codfuncionario;
    }

    public function setCodFuncionario($pCodFuncionario)
    {
        $this->codfuncionario = $pCodFuncionario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($pNome)
    {
        $this->nome = $pNome;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($pStatus)
    {
        $this->status = $pStatus;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($pEmail)
    {
        $this->email = $pEmail;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($pSenha)
    {
        $this->senha = $pSenha;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($pDescricao)
    {
        $this->descricao = $pDescricao;
    }

    public function getDisponivel()
    {
        return $this->disponivel;
    }

    public function setDisponivel($pDisponivel)
    {
        $this->disponivel = $pDisponivel;
    }

    public function setDtCadastro()
    {
        return $this->dtCadastro;
    }

    public function getDtCadastro($pDtCadastro='')
    {
        $this->dtCadastro = $pDtCadastro;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($pTipo='')
    {
        $this->tipo = $pTipo;
    }

  }


?>
