<?php
    require_once('config/urls.php');
    require_once('baseRouter.php');
    require_once('controllers/funcionarioController.php');
    /**
    * funcionarioRouter
    */
    class funcionarioRouter extends baseRouter
    {
        private $funcionarioController = null;
        private $db =null;


        function __construct($database)
        {
            $this->db = $database;
            $this->funcionarioController = new funcionarioController($this->db);
        }

        public function route($uri, $method, $body)
        {
            $path = $method.'-'.$uri;
            
            if ((bool)preg_match(urls::get_funcionario(), $path )) 
            {
                return $this->getFuncionario();
            }
            else if ((bool)preg_match(urls::post_funcionario(), $path )) 
            {
                return $this->createFuncionario('POST', $body);
            }
            else if ((bool)preg_match(urls::put_funcionario(), $path )) 
            {
                return $this->alterFuncionario('PUT', $body);
            }
            else if ((bool)preg_match(urls::delete_funcionario(), $path )) 
            {
                $params = parent::getUriParams($uri);

                return $this->deleteFuncionario($params[0]);
            }
            else
                http_response_code(404);
        }

        public function getFuncionario()
        {
            return $this->funcionarioController->select();
        }

        public function createFuncionario($type, $body)
        {
            return $this->funcionarioController->save($type, $body);
        }

        public function alterFuncionario($type, $body)
        {
            return $this->funcionarioController->save($type, $body);
        }

        public function deleteFuncionario($id)
        {
            return $this->funcionarioController->remove($id);
        }
    }
?>