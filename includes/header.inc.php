<?php


function head($title)
{
    $head = '<meta charset="utf-8">';
    $head .= '<title>FilaFacil | '.$title.'</title>';
    $head .= '<link rel="stylesheet" type="text/css" href="../style/css/main.css">';
    $head .= '<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">';
    $head .= '<link rel="stylesheet" type="text/css" href="../style/css/lib/font-awesome-4.6.3/css/font-awesome.min.css">';
    $head .= '<meta name="apple-mobile-web-app-capable" content="yes">';
    $head .= '<meta name="HandheldFriendly" content="True">';
    $head .= '<meta name="apple-mobile-web-app-status-bar-style" content="black">';


    return $head;
}

?>
