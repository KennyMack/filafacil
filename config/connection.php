<?php
  /**
   * connection
   */
class Connection
{

    private function getConnStr()
    {
        return 'mysql:host=localhost;port=3306;dbname=filafacil';
    }

    public function getUser()
    {
        return 'root';
    }

    public function getPassword()
    {
        return '123456';
    }

    public function getConn()
    {
        try
        {
            $this->conn = new PDO($this->getConnStr(), $this->getUser(), $this->getPassword());

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }

        return $this->conn;
    }

    public function __destruct()
    {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    private function query($sql, $params=null, $conn= null)
    {
        $cmd = null;
        if ($conn)
        $cmd = $conn->prepare($sql);
        else
        $cmd = $this->getConn()->prepare($sql);

        $cmd->execute($params);
        return $cmd;
    }

    public function fetchData($sql, $params=null, $type=PDO::FETCH_ASSOC)
    {
        $query = $this->query($sql, $params);

        $rs = $query->fetchAll($type);

        $this->__destruct();
        return $rs;
    }

    public function getJson($sql, $params=null)
    {
        $rs = $this->fetchData($sql, $params);

        return json_encode($this->encode_all($rs));
    }

    public function save($sql, $params=null)
    {
        $conn = $this->getConn();

        $query = $this->query($sql, $params, $conn);

        $rs = $conn->lastInsertId();

        $this->__destruct();

        return $rs;
    }

    public function update($sql, $params=null)
    {
        $query = $this->query($sql, $params);

        $rs = $query->rowCount();

        $this->__destruct();
        return $rs;
    }

    public function remove($sql, $params=null)
    {
      $query = $this->query($sql, $params);

      $rs = $query->rowCount();

      $this->__destruct();
      return $rs;
    }

    public function encode_all($data)
    {
        if (is_string($data)) 
            return utf8_encode($data);

        if (!is_array($data)) 
            return $data;

        $ret = array();

        foreach ($data as $key => $value) {
            $ret[$key] = $this->encode_all($value);
        }

        return $ret;
    }
}

?>
