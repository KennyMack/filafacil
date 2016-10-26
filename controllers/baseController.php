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
    }
?>