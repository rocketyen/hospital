<?php
require_once(dirname(__FILE__).'/../models/Patients.php');

$id = intval(trim(filter_input(INPUT_GET, 'patient', FILTER_SANITIZE_NUMBER_INT)));

$delete = Patient::deletePatient($id);

header('location: /../controllers/readPatientController.php');
