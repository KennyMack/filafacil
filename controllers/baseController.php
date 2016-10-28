<?php
    /**
    * 
    */
    class baseController
    {
        public function getField($body, $field, $default='')
        {
            if (isset($body[$field]))
                return $body[$field];

            return $default;
        }

        public function httpResponse($ok, $data)
        {
            $objdata = array(
                'status' => $ok,
                'data' => $data
            );

            return json_encode($objdata);
        }
    }
?>