<?php
require_once(dirname(__FILE__).'/../models/Appointments.php');

$id = intval(trim(filter_input(INPUT_GET, 'appointment', FILTER_SANITIZE_NUMBER_INT)));

$result = Appointments::profileAppointment($id);
if(!is_object($result)){
    $errMess = $result;
}

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/profileAppointment.php');
include(dirname(__FILE__).'/../views/templates/footer.php');