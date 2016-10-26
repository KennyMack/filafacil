<?php

  class Funcionario
  {
    public $codFuncionario = null;
    public $nome = null;
    public $status = null;
    public $email = null;
    public $senha = null;
    public $descricao = null;
    public $disponivel = null;
    public $dtCadastro = null;
    public $tipo = null;
    private $db = null;

    function __construct($database)
    {
        $this->db = $database;
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

    public function getSelect()
    {
        return $this->db->getJson('SELECT funcionario.codfuncionario,
                                                             funcionario.nome,
                                                             funcionario.status,
                                                             funcionario.email,
                                                             funcionario.senha,
                                                             funcionario.descricao,
                                                             funcionario.disponivel,
                                                             funcionario.dtcadastro,
                                                             funcionario.tipo
                                                  FROM funcionario');
    }

    public function insert()
    {
        $sql = 'INSERT INTO funcionario (nome, status, email, senha, 
                                                              descricao, disponivel, dtcadastro, tipo)
                                            VALUES (:nome, :status, :email, :senha, 
                                                           :descricao, :disponivel, now(), :tipo)';

        $params = array(
            ':nome' => $this->nome,
            ':status' => $this->status,
            ':email' => $this->email,
            ':senha' => $this->senha,
            ':descricao' => $this->descricao,
            ':disponivel' => $this->disponivel,
            ':tipo' => $this->tipo);

        return $this->db->save($sql, $params);
    }

    public function update()
    {
        $sql = 'UPDATE funcionario
                          SET nome = :nome,
                                 status = :status,
                                 email = :email,
                                 senha = :senha,
                                 descricao = :descricao,
                                 disponivel = :disponivel,
                                 tipo = :tipo
                    WHERE codfuncionario = :codfuncionario';

        $params = array(
            ':nome' => $this->nome,
            ':status' => $this->status,
            ':email' => $this->email,
            ':senha' => $this->senha,
            ':descricao' => $this->descricao,
            ':disponivel' => $this->disponivel,
            ':tipo' => $this->tipo,
            ':codfuncionario' => $this->codfuncionario);

        return $this->db->save($sql, $params);
    }

    public function delete()
    {
        $sql = 'DELETE 
                       FROM funcionario
                    WHERE codfuncionario = :codfuncionario';

        $params = array(
            ':codfuncionario' => $this->codfuncionario);

        return $this->db->remove($sql, $params);
    }



  }


?>
