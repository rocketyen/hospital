<?php

require_once(dirname(__FILE__) . '/models/Appointments.php');
require_once(dirname(__FILE__) . '/models/Patients.php');


$test1 = new Patient($id);
$result1 = $test1->create();
$test2 = new Appointments($id);
$result2 = $test2->createAppointment();

