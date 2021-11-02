
<main>
    <?= $errMess ?? '' ?>
    <div class="container">
        <?php if(!empty ($errMess)){
            echo $errMess
            ;}else{ ?>
        <h1 class="text-center text-white mt-3 mb-2">patient</h1>
        <table class="offset-2 col-8  mt-3 mb-2">
            <thead class="text-light bg-dark mt-3 mb-2 text-center">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>N° de Téléphone</th>
                    <th>Adresse mail</th>
                </tr>
            </thead>
            <tbody class="text-light bg-dark mt-3 mb-2 text-center">                
                    <tr>
                        <td><?= $result->firstname; ?></td>
                        <td><?= $result->lastname; ?></td>
                        <td><?= $result->birthdate; ?></td>
                        <td><?= $result->phone; ?></td>
                        <td><?= $result->mail; ?></td>
                        <td><a href="/controllers/updatePatientController.php?patient=<?= $result->id ?>">
                        <button>Modifier les informations du patient</button></a></td>
                    </tr>
            </tbody>
        </table>
    <?php }?>
    </div>
</main>