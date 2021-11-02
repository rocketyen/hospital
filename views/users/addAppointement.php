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
                            <input  type="date"
                                    class="form-control" 
                                    id="appointDate" 
                                    placeholder="Entrez votre nom" 
                                    name="appointDate"
                                    value="<?= htmlspecialchars($appointDate ?? '') ?>"
                                    pattern="[\p{N}-]+$"
                                    required>
                            <p class="offset-4 col-4 text-danger">
                            <?= $error['appointDate'] ?? null ?>
                            </p>        
                        </div>
                    <!-- firstname -->
                    <div class="form-group offset-4 col-4  mt-3 mb-2">
                        <label for="" class="text-light bg-dark">Prénom : </label>
                        <input type="text" class="form-control" id="firstname" placeholder="Entrez votre nom" name="firstname" value="<?= htmlspecialchars($firstname ?? '') ?>" pattern="^[\p{L}-]+$" required>
                        <p class="offset-4 col-4 text-danger">
                            <?= $error['fistname'] ?? null ?>
                        </p>
                    </div>
                    <div class="button">
                        <button type="submit" class="btn btn-primary offset-4 col-4 mt-3 mb-5">Ajouter un Patient</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</main>