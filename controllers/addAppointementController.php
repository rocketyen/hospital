<?php
require_once (dirname(__FILE__).'/../utils/database.php');
include(dirname(__FILE__).'/../models/Appointements.php');

$error = [];
$errorMess = 'hjkdegfr';
if($_SERVER['REQUEST_METHOD'] == 'POST'){    

    $appointDate = trim(filter_input(INPUT_POST, 'appointDate', FILTER_SANITIZE_STRING));
    $regexAppointDate = "/^[\p{N}-]+$/";
    if(!empty($appointDate)){ 
        if(!preg_match($regexAppointDate, $appointDate)){
            $error['appointDate'] = 'Date de rendez-vous invalide';
        }
    } else{
        $error['appointDate'] = 'Date de rendez-vous manquante'; 
    }    

    if (empty($error)) {
        $appointement = new Appointement($dateHour, $idPatient);
        $response = $appointement -> createAppointement();
        if(!$response){
            $errorMess = 'Aille';
        }else{
            return true;
        }
    }
}

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/addAppointement.php');
include(dirname(__FILE__).'/../views/templates/footer.php');