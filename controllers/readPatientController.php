<?php
require_once(dirname(__FILE__).'/../models/Patients.php');

$patients = Patient::read();

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/readPatient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');