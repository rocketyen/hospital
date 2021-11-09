<?php
require_once(dirname(__FILE__) . '/../utils/database.php');
require_once(dirname(__FILE__) . '/../models/Appointments.php');
require_once(dirname(__FILE__) . '/../models/Patients.php');
require_once(dirname(__FILE__) . '/../models/Verify.php');

$error = [];
$errorMess = 'hjkdegfr';

$id = intval(trim(filter_input(INPUT_GET, 'updateAppointment', FILTER_SANITIZE_NUMBER_INT)));

/********************** PAGE VARIABLES **********************/
$appointHours = ['8', '9', '10', '11', '13', '14', '15', '16', '17', '18'];
$idPatients = 0;
$appointHour = 0;
$appointment = Appointments::profileAppointment($id);
/********************** CONTROL FORM'S VALUES **********************/
/*Varaiables to verify*/
$errors = [];
$valid = null;

if($appointment instanceof PDOException ){
    $errorMess = $appointment->getMessage();
};

$errorMess = 'Y a un binse';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {

    // LASTNAME VERIFICATION //    
    $idPatients = intval(trim(filter_input(INPUT_POST, 'patientId', FILTER_SANITIZE_NUMBER_INT)));
    $regexpatientId = "/^[\p{N}-]+$/";   
    if (!empty($idPatients)) {
        
        if (!preg_match($regexpatientId, $idPatients)) {
            $error['patientId'] = 'Patient invalide';
        }
    } else {
        $error['patientId'] = 'Patient manquant';
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
        
    if (empty($error)) {         
        $dateHour = "$appointDate $appointHour:00:00";
        
        
        $appointments = new Appointments($id, $dateHour, $idPatients);         
        $response = $appointments -> updateAppointment();
        
        if($response !== true){
            $errorMess = 'Aille';
        }
    }
}

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/updateAppointment.php');
include(dirname(__FILE__).'/../views/templates/footer.php');