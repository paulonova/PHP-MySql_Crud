<?php

function url_for($script_path){
    if($script_path[0] != '/'){
        $script_path = '/' . $script_path;
    }
    return WWW_ROOT . $script_path;
}


//Encode URL pparameters
function u($string=""){
    return urlencode($string);
}

function raw_u($string=""){
    return rawurlencode($string);
}

//Convert the predefined characters to HTML entities:
function h($string=""){
    return htmlspecialchars($string);
}


/**Error messages */
function error_404(){
    header($_SERVER['SERVER_PROTOCOL'] . " 404 Not Found");
    exit();
}

function error_505(){
    header($_SERVER['SERVER_PROTOCOL'] . " 505 Internal Server Error");
    exit();
}


function redirect_to($location){
    header('Location: '. $location);
    exit();
}

?>
