<?php
require_once(dirname(__FILE__).'/../models/Patients.php');

$id = intval(trim(filter_input(INPUT_GET, 'patient', FILTER_SANITIZE_NUMBER_INT)));

$delete = Patient::deletePatient($id);


include(dirname(__FILE__).'/../views/templates/header.php');
header('location: /../controllers/readPatientController.php');
include(dirname(__FILE__).'/../views/templates/footer.php');