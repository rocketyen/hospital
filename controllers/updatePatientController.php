<?php
require_once (dirname(__FILE__).'/../utils/database.php');
include(dirname(__FILE__).'/../models/Patients.php');

$error = [];

$id = trim(filter_input(INPUT_GET, 'patient', FILTER_SANITIZE_NUMBER_INT));

// $profilePatient = new Patient();
// $patients = $profilePatient->profile($id);

$patient = Patient::profile($id);


if($patient instanceof PDOException ){
    $errorMess = $profilePatient->getMessage();
};

$errorMess = 'Y a un binse';
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $regexFirstname = "/^[\p{L}-]+$/";
    if(!empty($firstname)){    
        if(!preg_match($regexFirstname, $firstname)){
            $error['firstname'] = 'prénom invalide';
        }
    } else{
        $error['firstname'] = 'prénom manquant';
    }

    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $regexLastname = "/^[\p{L}-]+$/";
    if(!empty($lastname)){
        if(!preg_match($regexLastname, $lastname)){
            $error['lastname'] = 'Nom invalide';
        }
    } else{
        $error['lastname'] = 'Nom manquant';         
    }

    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $regexBirthdate = "/^[\p{N}-]+$/";
    if(!empty($birthdate)){ 
        if(!preg_match($regexBirthdate, $birthdate)){
            $error['birthdate'] = 'Date de naissance invalide';
        }
    } else{
        $error['birthdate'] = 'Date de naissance manquante'; 
    }

    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $regexPhone = "/^0[1-9][0-9]{8}$/";
    if(!empty($phone)){ 
        if(!preg_match($regexPhone, $phone)){
            $error['phone'] = 'Téléphone invalide';
        }
    } else{
        $error['phone'] = 'Téléphone manquant'; 
    }

    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
    $regexMail = "/^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-.]?[[:alnum:]])*\.([a-z]{2,4})$/";
    if(!empty($mail)){ 
        if(!preg_match($regexMail, $mail)){
            $error['mail'] = 'Mail  invalide';
        }
    } else{
        $error['mail'] = 'Mail  manquant'; 
    }

    if (empty($error)) {
        $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
        $response = $patient -> update();
        if($response !== true){
            $errorMess = 'Aille';
        }else{
            return true;
        }
    }
}

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/updatePatient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');