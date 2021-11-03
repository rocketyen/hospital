<main>
    <div class="container">
        <form action="" method="POST">
            <fieldset>
                <legend>
                    <h1 class="text-center text-white">Ajout d'un rendez-vous : </h1>
                </legend>
                <div class="row content mb-5 offset-2 col-8">
                    <!-- Jour et heure du rendez-vous  -->
                    <div class="form-group offset-4 col-4  mt-3 mb-2">
                        <label for="" class="text-light bg-dark">Jour et heure du rendez-vous : </label>
                        <input type="date" class="form-control" id="appointDate" placeholder="Entrez votre nom" name="appointDate" value="<?= htmlspecialchars($appointDate ?? '') ?>" pattern="[\p{N}-]+$" required>
                        <p class="offset-4 col-4 text-danger">
                            <?= $error['appointDate'] ?? null ?>
                        </p>
                    </div>
                    <!-- Heure -->
                    <div class="form-group offset-4 col-4  mt-3 mb-2">
                        <label for="" class="text-light bg-dark">Choisissez une plage horraire 09:00 et 19:00</label>
                        <input type="time" class="form-control" id="time" placeholder="Choisissez un time" name="time" value="<?= htmlspecialchars($time ?? '') ?>" pattern="^[\p{L}-]+$" required>
                        <p class="offset-4 col-4 text-danger">
                            <?= $error['time'] ?? null ?>
                        </p>
                    </div>
                    <!-- patient -->
                    <div class="form-group offset-4 col-4  mt-3 mb-2">
                        <label for="" class="text-light bg-dark">Choisissez un patient : </label>
                        <select type="text" class="form-control" id="patient" placeholder="Choisissez un patient" name="patient" value="<?= htmlspecialchars($patient ?? '') ?>" pattern="^[\p{L}-]+$" required>
                            <p class="offset-4 col-4 text-danger">
                                <?= $error['patient'] ?? null ?>
                            </p>
                        </select>
                    </div>
                    <div class="button">
                        <button type="submit" class="btn btn-primary offset-4 col-4 mt-3 mb-5">Ajouter un rendez-vous</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</main>