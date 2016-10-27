<?php

class Fila
{
    private $codFila = null;
    private $ra = null;
    private $codFuncionario = null;
    private $status = null;
    private $db = null;

    function __construct($database)
    {
        $this->db = $database;
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

    public function getSelect()
    {
        return $this->db->getJson('SELECT fila.codfila,
                                                                 fila.codfuncionario,
                                                                 fila.ra,
                                                                 fila.status
                                                      FROM fila');
    }

    public function insert()
    {
        $sql = 'INSERT INTO fila (codfuncionario, ra, status)
                                 VALUES (:codfuncionario, :ra, :status)';

        $params = array(
            ':codfuncionario' => $this->codFuncionario,
            ':ra' => $this->ra,
            ':status' => $this->status);
        var_dump($params);

        return $this->db->save($sql, $params);
    }

    public function update()
    {
        $sql = 'UPDATE fila
                          SET codfuncionario = :codfuncionario,
                                 ra = :ra,
                                 status = :status
                    WHERE codfila = :codfila';

        $params = array(
            ':codfuncionario' => $this->codFuncionario,
            ':ra' => $this->ra,
            ':status' => $this->status,
            ':codfila' => $this->codFila);


        return $this->db->update($sql, $params);
    }

    public function delete()
    {
        $sql = 'DELETE 
                       FROM fila
                    WHERE codfila = :codfila';

        $params = array(
            ':codfila' => $this->codFila);

        return $this->db->remove($sql, $params);
    }
}
?>
