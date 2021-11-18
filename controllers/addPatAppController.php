<?php
require_once(dirname(__FILE__) . '/../utils/database.php');
require_once(dirname(__FILE__) . '/../models/Appointments.php');
require_once(dirname(__FILE__) . '/../models/Patients.php');
require_once(dirname(__FILE__) . '/../models/Verify.php');

$error = [];
$errorMess = 'hjkdegfr';

/********************** PAGE VARIABLES **********************/
$title = 'CHU d\'Amiens';
$page_name = 'Ajouter un rendez-vous';
$appointHours = ['8', '9', '10', '11', '13', '14', '15', '16', '17', '18'];
$patients = Patient::read();
$idPatients = 0;
$appointHour = 0;


/********************** CONTROL FORM'S VALUES **********************/
/*Varaiables to verify*/
$valid = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {

    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $regexFirstname = "/^[\p{L}-]+$/";
    if (!empty($firstname)) {
        if (!preg_match($regexFirstname, $firstname)) {
            $error['firstname'] = 'prénom invalide';
        }
    } else {
        $error['firstname'] = 'prénom manquant';
    }

    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    $regexLastname = "/^[\p{L}-]+$/";
    if (!empty($lastname)) {
        if (!preg_match($regexLastname, $lastname)) {
            $error['lastname'] = 'Nom invalide';
        }
    } else {
        $error['lastname'] = 'Nom manquant';
    }

    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    $regexBirthdate = "/^[\p{N}-]+$/";
    if (!empty($birthdate)) {
        if (!preg_match($regexBirthdate, $birthdate)) {
            $error['birthdate'] = 'Date de naissance invalide';
        }
    } else {
        $error['birthdate'] = 'Date de naissance manquante';
    }

    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $regexPhone = "/^0[1-9][0-9]{8}$/";
    if (!empty($phone)) {
        if (!preg_match($regexPhone, $phone)) {
            $error['phone'] = 'Téléphone invalide';
        }
    } else {
        $error['phone'] = 'Téléphone manquant';
    }

    $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
    $regexMail = "/^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-.]?[[:alnum:]])*\.([a-z]{2,4})$/";
    if (!empty($mail)) {
        if (!preg_match($regexMail, $mail)) {
            $error['mail'] = 'Mail  invalide';
        }
    } else {
        $error['mail'] = 'Mail  manquant';
    }

    // HOUR VERIFICATION //    
    $appointHour = trim(filter_input(INPUT_POST, 'appointHour', FILTER_SANITIZE_STRING));
    $regexAppointHour = "/^[\p{N}-]+$/";

    if (!empty($appointHour)) {
        if (!preg_match($regexAppointHour, $appointHour)) {
            $error['appointHour'] = 'Heure de rendez-vous invalide';
        }
    } else {
        $error['appointHour'] = 'Heure de rendez-vous manquante';
    }

    // DATE VERIFICATION //
    $appointDate = trim(filter_input(INPUT_POST, 'appointDate', FILTER_SANITIZE_STRING));
    $regexAppointDate = "/^[\p{N}-]+$/";
    if (!empty($appointDate)) {
        if (!preg_match($regexAppointDate, $appointDate)) {
            $error['appointDate'] = 'Date de rendez-vous invalide';
        }
    } else {
        $error['appointDate'] = 'Date de rendez-vous manquante';
    }



    /*create appointment*/
    if (empty($error)) {
        // var_dump('tout va bien');
        // die;        

        $pdo = Database::connect();
        $dateHour = "$appointDate $appointHour:00:00";

        try {            

            $pdo->beginTransaction();            
            $patient = new Patient($lastname, $firstname, $birthdate, $phone, $mail);
            $response = $patient->create();
            $idPatients = $pdo->lastInsertId();
            $appointment = new Appointments($dateHour, $idPatients);
            $created_appointment = $appointment->createAppointment();
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
}

include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/users/addPatApp.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');
