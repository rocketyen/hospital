<main>
    <?= $errMess ?? '' ?>
    <div class="container">
        <?php if(!empty ($errMess)){
            echo $errMess
            ;}else{ ?>
        <h1 class="text-center text-white mt-3 mb-2">Détail du rendez-vous</h1>
        <table class="offset-2 col-8  mt-3 mb-2">
            <thead class="text-light bg-dark mt-3 mb-2 text-center">
                <tr>
                    <th>ID Rendez-vous</th>
                    <th>Date</th>
                    <th>ID Patient</th>
                </tr>
            </thead>
            <tbody class="text-light bg-dark mt-3 mb-2 text-center">                
                    <tr>
                        <td><?= $result->id; ?></td>
                        <td><?= $result->dateHour; ?></td>
                        <td><?= $result->idPatients; ?></td>
                        <td><a href="/controllers/updateAppointmentController.php?patient=<?= $result->id ?>">
                        <button>Modifier les informations du patient</button></a></td>
                    </tr>
            </tbody>
        </table>
    <?php }?>
    </div>
</main>