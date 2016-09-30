<?php  


function head($title)
{
	$head = '<head>';
	$head .= '<meta charset="utf-8">';
	$head .= '<title>FilaFacil | '.$title.'</title>';
	$head .= '<link rel="stylesheet" type="text/css" href="../style/css/main.css">';
	$head .= '</head>';

	return $head;
}

?>