<?php
require_once (dirname(__FILE__).'/../utils/database.php');
include(dirname(__FILE__).'/../models/Appointements.php');
include_once dirname(__FILE__) . '/../models/Patient.php';
include_once dirname(__FILE__) . '/../models/Verify.php';

$error = [];
$errorMess = 'hjkdegfr';

/********************** PAGE VARIABLES **********************/
$title = 'CHU d\'Amiens';
$page_name = 'Ajouter un rendez-vous';
$appointHour = ['8', '9', '10', '11', '13', '14', '15', '16', '17', '18'];
$patients = Patient::profile($id);
$idPatient = 0;

/********************** CONTROL FORM'S VALUES **********************/
/*Varaiables to verify*/
$errors = [];
$valid = null;

/*Sanitize & validate values*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) 
{
    // LASTNAME VERIFICATION //    
    $patientId = trim(filter_input(INPUT_POST, 'patientId', FILTER_SANITIZE_STRING));
    $regexpatientId = "/^[\p{N}-]+$/";
    if(!empty($patientId)){ 
        if(!preg_match($regexpatientId, $patientId)){
            $error['patientId'] = 'Date de rendez-vous invalide';
        }
    } else{
        $error['appointDate'] = 'Date de rendez-vous manquante'; 
    }

    // HOUR VERIFICATION //    
    $appointHour = trim(filter_input(INPUT_POST, 'appointHour', FILTER_SANITIZE_STRING));
    $regexAppointHour = "/^[\p{N}-]+$/";
    if(!empty($appointHour)){ 
        if(!preg_match($regexAppointHour, $appointHour)){
            $error['appointHour'] = 'Heure de rendez-vous invalide';
        }
    } else{
        $error['appointHour'] = 'Heure de rendez-vous manquante'; 
    }

    // DATE VERIFICATION //
    $appointDate = trim(filter_input(INPUT_POST, 'appointDate', FILTER_SANITIZE_STRING));
    $regexAppointDate = "/^[\p{N}-]+$/";
    if(!empty($appointDate)){ 
        if(!preg_match($regexAppointDate, $appointDate)){
            $error['appointDate'] = 'Heure de rendez-vous invalide';
        }
    } else{
        $error['appointDate'] = 'Heure de rendez-vous manquante'; 
    }

/*create appointment*/
    if (empty($errors)) {

        // if $date >= today's date
        if ($date >= date('Y-m-d')) {

            //formate date & hour
            $dateHour = "$date $hour:00:00";

            $appointment = new Appointments($dateHour, $idPatient);

            $created_appointment = $appointment->createAppointment();
            // if the appointment reponse is an error, show it
            if ($created_appointment instanceof PDOException) {
                $code = $created_appointment->getCode();
                $returned_message = ERRORS_ARRAY[$code];

            } else {
                $returned_message = 'Le rendez-vous a bien été enregistré.';
                /* ! DEVELOPPER PART : DEBUG ! */
                // $returned_message = 'NO PDO ERROR';
            }
        } else {
            $returned_message = 'Il est impossible d\'enregistrer un rendez-vous à une date inférieure à celle du jour.';
        } // if date > today date
    } // if errors
} // server POST

include_once(dirname(__FILE__).'/../views/templates/header.php');
include_once(dirname(__FILE__).'/../views/users/addAppointement.php');
include_once(dirname(__FILE__).'/../views/users/readPatient.php');
include_once(dirname(__FILE__).'/../views/templates/footer.php');