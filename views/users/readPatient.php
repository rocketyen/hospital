<main>
    <div class="container">
        <h1 class="text-center text-white mt-3 mb-2">Liste des utilisateurs</h1>
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
                <?php foreach ($patients as $patient) : ?>
                    <tr>
                        <td><?= $patient->lastname; ?></td>
                        <td><?= $patient->firstname; ?></td>                        
                        <td><?= $patient->birthdate; ?></td>
                        <td><?= $patient->phone; ?></td>
                        <td><?= $patient->mail; ?></td>
                        <td><a href="/controllers/profilePatientController.php?patient=<?= $patient->id ?>"><button>Infos</button></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</main>        