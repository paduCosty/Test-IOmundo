<?php
$resp = '';
require_once '../controllers/RegistrationsController.php';

$registrationsController = new RegistrationsController();
$registrationsController->show_registrations();
?>


