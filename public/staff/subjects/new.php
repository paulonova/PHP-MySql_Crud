<?php require_once('../../../private/initialize.php');

    $test = $_GET['test'] ?? '';

    if($test == '404'){
        error_404();

    }elseif($test == '505'){
        error_505();
    }elseif($test == 'redirect'){
        redirect_to(url_for('/staff/subjects/index.php'));
    }else{
        echo 'No Error';
    }
?>


<!-- there is no white spaces between php -->
