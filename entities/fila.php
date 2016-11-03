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
                                          funcionario.nome funcionarionome,
                                          fila.ra,
                                          fila.status
                                     FROM fila
                                    INNER JOIN funcionario
                                       ON (fila.codfuncionario = funcionario.codfuncionario)
                                    ORDER BY fila.codfila DESC');
    }

    public function getSelectFila()
    {
        return $this->db->getJson('SELECT tbnext.codfila, fila.ra, tbnext.codfuncionario, tbnext.funcionarionome
                                     FROM (SELECT max(fila.codfila) codfila, fila.codfuncionario, funcionario.nome funcionarionome
                                             FROM fila
                                       INNER JOIN funcionario
                                               ON (funcionario.codfuncionario = fila.codfuncionario)
                                            WHERE fila.status = 1
                                              AND funcionario.disponivel = 1
                                         GROUP BY fila.codfuncionario) tbnext
                               INNER JOIN fila
                                       ON (tbnext.codfila = fila.codfila)');
    }

    public function selectFilaEmployee()
    {
      $params = array(
          ':codfuncionario' => $this->codFuncionario);

      return $this->db->getJson('SELECT fila.codfila,
                                        fila.codfuncionario,
                                        funcionario.nome funcionarionome,
                                        fila.ra,
                                        fila.status
                                   FROM fila
                                  INNER JOIN funcionario
                                     ON (fila.codfuncionario = funcionario.codfuncionario)
                                  WHERE fila.status = 0
                                    AND fila.codfuncionario = :codfuncionario', $params);
    }

    public function insert()
    {
        $sql = 'INSERT INTO fila (codfuncionario, ra, status)
                                 VALUES (:codfuncionario, :ra, :status)';

        $params = array(
            ':codfuncionario' => $this->codFuncionario,
            ':ra' => $this->ra,
            ':status' => $this->status);

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

    public function finaliza()
    {
        $sql = 'UPDATE fila
                   SET status = 2
                 WHERE codfila = :codfila';

        $params = array(
            ':codfila' => $this->codFila);


        return $this->db->update($sql, $params);
    }

    public function andamento()
    {
        $sql = 'UPDATE fila
                   SET status = 1
                 WHERE codfila = :codfila';

        $params = array(
            ':codfila' => $this->codFila);


        return $this->db->update($sql, $params);
    }

    public function cancelar()
    {
        $sql = 'UPDATE fila
                   SET status = 0
                 WHERE codfila = :codfila';

        $params = array(
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
