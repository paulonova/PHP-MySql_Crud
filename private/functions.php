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

?>
