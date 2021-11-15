<?php
require_once(dirname(__FILE__).'/../models/Appointments.php');

$id = intval(trim(filter_input(INPUT_GET, 'appointment', FILTER_SANITIZE_NUMBER_INT)));

$delete = Appointments::deleteAppointment($id);


include(dirname(__FILE__).'/../views/templates/header.php');
header('location: /../controllers/readAppointmentController.php');
include(dirname(__FILE__).'/../views/templates/footer.php');