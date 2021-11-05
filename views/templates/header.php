<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="/../assets/img/favIcon.png"/>
    <link rel="apple-touch-icon" href="/../assets/img/favIcon.png"/>
    <link rel="stylesheet" href="/../assets/css/style.css">
    <title>Hôpital</title>    
</head>
<body>
<nav id="navbar" role="button" class="navbar navbar-expand-sm">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-3 mb-2 d-flex justify-content-center" id="collapsibleNavbar">    
            <ul class="navbar-nav">
                <li class="nav-item" title="Accueil">                    
                <a href="/controllers/homePatientController.php" class="nav-link" onClick="ouverture();">Accueil</a>&nbsp
                </li>

                <li class="nav-item" title="Inscription">
                <a href="/controllers/addPatientController.php" class="nav-link" onClick="ouverture();">Ajouter un patient</a>&nbsp
                </li>

                <li class="nav-item" id="Connection">
                <a href="/controllers/readPatientController.php" class="nav-link" onClick="ouverture();">Liste des patients</a>&nbsp
                </li>

                <li class="nav-item" id="Connection">
                <a href="/controllers/addAppointmentController.php" class="nav-link" onClick="ouverture();">Définir un rendez-vous</a>&nbsp
                </li>

                <li class="nav-item" id="Connection">
                <a href="/controllers/readAppointmentController.php" class="nav-link" onClick="ouverture();">Liste des rendez-vous</a>&nbsp
                </li>
                <img src="/assets/img/logo.jpg" class="logo">
            </ul>            
        </div>
</nav>