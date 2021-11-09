<main>
    <?= $errMess ?? '' ?>
    <div class="container">
        <?php if(!empty ($errMess)){
            echo $errMess
            ;}else{ ?>
        <h1 class="text-center text-white mt-3 mb-2">Détail du rendez-vous</h1>
        <table class="offset-1 col-10  mt-3 mb-2">
            <thead class="text-light bg-dark mt-3 mb-2 text-center">
                <tr>
                    <th>ID Rendez-vous</th>                    
                    <th>Nom du Patient</th>
                    <th>Prénom du Patient</th>
                    <th>Téléphone du Patient</th>
                    <th>Date du rendez-vous</th>
                </tr>
            </thead>
            <tbody class="text-light bg-dark mt-3 mb-2 text-center">                
                    <tr>
                        <td><?= $result->id; ?></td>
                        <td><?= $result->lastname; ?></td>
                        <td><?= $result->firstname; ?></td>
                        <td><?= $result->phone; ?></td>
                        <td><?= $result->dateHour; ?></td>
                        <td><a href="/controllers/updateAppointmentController.php?updateAppointment=<?= $result->id ?>">
                        <button>Modifier le rendez-vous</button></a></td>
                    </tr>
            </tbody>
        </table>
    <?php }?>
    </div>
</main>