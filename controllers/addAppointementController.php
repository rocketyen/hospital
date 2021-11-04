<?php
require_once (dirname(__FILE__).'/../utils/database.php');
include(dirname(__FILE__).'/../models/Appointements.php');

$error = [];
$errorMess = 'hjkdegfr';

$patients = Patient::read();
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
    
    $appointHour = trim(filter_input(INPUT_POST, 'appointHour', FILTER_SANITIZE_STRING));
    $regexAppointHour = "/^[\p{N}-]+$/";
    if(!empty($appointHour)){ 
        if(!preg_match($regexAppointHour, $appointHour)){
            $error['appointHour'] = 'Heure de rendez-vous invalide';
        }
    } else{
        $error['appointHour'] = 'Heure de rendez-vous manquante'; 
    }

    if (empty($error)) {
        $appointement = new Appointements($dateHour, $idPatient);
        $response = $appointement -> createAppointement();
        if(!$response){
            $errorMess = 'Aille';
        }else{
            return true;
        }
    }
}

include_once(dirname(__FILE__).'/../views/templates/header.php');
include_once(dirname(__FILE__).'/../views/users/addAppointement.php');
include_once(dirname(__FILE__).'/../views/users/readPatient.php');
include_once(dirname(__FILE__).'/../views/templates/footer.php');