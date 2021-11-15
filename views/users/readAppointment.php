<main>
    <div class="container">
        <h1 class="text-center text-white mt-3 mb-2">Liste des rendez-vous</h1>
        <table class="offset-2 col-8  mt-3 mb-2">
            <thead class="text-light bg-dark mt-3 mb-2 text-center">
                <tr>
                    <th>ID Rendez-vous</th>                    
                    <th>Nom du Patient</th>
                    <th>Prénom du Patient</th>
                    <th>Date du rendez-vous</th>                  
                </tr>
            </thead>
            
            <tbody class="text-light bg-dark mt-3 mb-2 text-center">
                <?php foreach ($appointments as $appointment) : ?>
                    <tr>
                        <td><?= $appointment->id; ?></td>
                        <td><?= $appointment->lastname; ?></td>
                        <td><?= $appointment->firstname; ?></td>
                        <td><?= $appointment->dateHour; ?></td>                       
                        <td><a href="/controllers/profileAppointmentController.php?appointment=<?= $appointment->id ?>"><button>Infos</button></a></td>
                        <td><a href="/controllers/deleteAppointmentController.php?appointment=<?= $appointment->id ?>"><button>Supprimer</button></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</main>        