<?php
require_once(dirname(__FILE__).'/../models/Appointments.php');

$id = intval(trim(filter_input(INPUT_GET, 'appointment', FILTER_SANITIZE_NUMBER_INT)));

$delete = Appointments::deleteAppointment($id);

header('location: /../controllers/readAppointmentController.php');