<?php
/**
* baseRouter
*/
class baseRouter
{
    public function getUriParams($url)
    {
        preg_match_all('/\d+/', $url, $matches);
        return $matches[0];
    }
}
?>