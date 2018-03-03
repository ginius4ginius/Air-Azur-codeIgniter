<?php
if (isset($_REQUEST['date'])) {
    echo date("d:m:Y");
} 
elseif (isset($_REQUEST['time']))
    echo date("H:i:s");
elseif (isset($_REQUEST['datetime']))
{
    header('Content-type: application/json');
    //
    echo json_encode(['date' => date("d:m:Y"), 
        'time' => date("H:i:s")]);

}
else
    //header("HTTP/1.0 404 Not Found");
    header("HTTP/1.0 555 Strange error");

?>

