<?php

  class Funcionario
  {
    private $codFuncionario = null;
    private $nome = null;
    private $status = null;
    private $email = null;
    private $senha = null;
    private $descricao = null;
    private $disponivel = null;
    private $dtCadastro = null;
    private $tipo = null;
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

    public function getSelectAvailable()
    {
        return $this->db->getJson('SELECT funcionario.codfuncionario,
                                          funcionario.nome
                                     FROM funcionario
                                    WHERE funcionario.disponivel = 1
                                      AND funcionario.tipo = 1');
    }

    public function getUser()
    {
        return $this->db->fetchData('SELECT funcionario.codfuncionario,
                                            funcionario.email,
                                            funcionario.senha,
                                            funcionario.nome
                                       FROM funcionario
                                      WHERE funcionario.status = 1
                                        AND funcionario.email  = :email',
                                      array(':email' => $this->email) );
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
                              disponivel = funcionario.disponivel,
                              tipo = :tipo
                    WHERE codfuncionario = :codfuncionario';

        $params = array(
            ':nome' => $this->nome,
            ':status' => $this->status,
            ':email' => $this->email,
            ':senha' => $this->senha,
            ':descricao' => $this->descricao,
            ':tipo' => $this->tipo,
            ':codfuncionario' => $this->codfuncionario);

        return $this->db->update($sql, $params);
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

    public function disponivel()
    {
        $sql = 'UPDATE funcionario
                   SET disponivel = :disponivel
                 WHERE codfuncionario = :codfuncionario';

        $params = array(
            ':disponivel' => $this->disponivel,
            ':codfuncionario' => $this->codfuncionario);

        return $this->db->update($sql, $params);
    }



  }


?>
