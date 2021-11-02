<?php
require_once(dirname(__FILE__).'/../models/Patients.php');

$id = intval(trim(filter_input(INPUT_GET, 'patient', FILTER_SANITIZE_NUMBER_INT)));

$result = Patient::profile($id);
if(!is_object($result)){
    $errMess = $result;
}

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/profilePatient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');