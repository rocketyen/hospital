<?php
require_once(dirname(__FILE__).'/../models/Appointments.php');


$appointments = Appointments::readAppointment();


include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/users/readAppointment.php');
include(dirname(__FILE__).'/../views/templates/footer.php');