<!-- <?= $errorMess ?> -->

<main>
    <div class="container">
        <form action="" method="POST">
            <fieldset>
                <legend><h1 class="text-center text-white">Formulaire d'ajout d'un patient</h1></legend>
                    <div class="row content mb-5 offset-2 col-8">
                        <!-- lastname -->
                        <div class="form-group offset-4 col-4  mt-3 mb-2">
                            <label for="" class="text-light bg-dark">Nom : </label>
                            <input  type="text" 
                                    class="form-control" 
                                    id="lastname" 
                                    placeholder="Entrez votre nom" 
                                    name="lastname"
                                    value="<?= htmlspecialchars($lastname ?? '') ?>"
                                    pattern="^[\p{L}-]+$"
                                    required>
                            <p class="offset-4 col-4 text-danger">
                            <?= $error['lastname'] ?? null ?>
                            </p>
                        </div>
                        <!-- firstname -->
                        <div class="form-group offset-4 col-4  mt-3 mb-2">
                            <label for="" class="text-light bg-dark" >Prénom : </label>
                            <input  type="text" 
                                    class="form-control" 
                                    id="firstname" 
                                    placeholder="Entrez votre nom" 
                                    name="firstname"
                                    value="<?= htmlspecialchars($firstname ?? '') ?>"
                                    pattern="^[\p{L}-]+$"
                                    required>
                            <p class="offset-4 col-4 text-danger">
                            <?= $error['fistname'] ?? null ?>
                            </p>        
                        </div>
                        <!-- birtdate -->
                        <div class="form-group offset-4 col-4  mt-3 mb-2">
                            <label for="" class="text-light bg-dark">Date de naissance : </label>
                            <input  type="date"
                                    class="form-control" 
                                    id="birthdate" 
                                    placeholder="Entrez votre nom" 
                                    name="birthdate"
                                    value="<?= htmlspecialchars($birthdate ?? '') ?>"
                                    pattern="[\p{N}-]+$"
                                    required>
                            <p class="offset-4 col-4 text-danger">
                            <?= $error['birthdate'] ?? null ?>
                            </p>        
                        </div>
                        <!-- phone  -->
                        <div class="form-group offset-4 col-4  mt-3 mb-2">
                            <label for="" class="text-light bg-dark">Numéro de téléphone : </label>
                            <input  type="tel"
                                    class="form-control" 
                                    id="phone" 
                                    placeholder="Entrez votre numéro de tel" 
                                    name="phone"
                                    value="<?= htmlspecialchars($phone ?? '') ?>"
                                    pattern="^0[1-9][0-9]{8}$"
                                    required>
                            <p class="offset-4 col-4 text-danger">
                            <?= $error['phone'] ?? null ?>
                            </p>
                        </div>
                        <!-- mail -->
                        <div class="form-group offset-4 col-4">
                            <label for="" class="text-light bg-dark">Adresse mail : </label>
                            <input  type="mail" 
                                    class="form-control" 
                                    id="mail" 
                                    placeholder="exemple@mail.com"
                                    name="mail"
                                    value="<?= htmlspecialchars($mail ?? '') ?>" 
                                    pattern="^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-.]?[[:alnum:]])*\.([a-z]{2,4})$"
                                    required>
                            <p class="offset-4 col-4 text-danger">
                            <?= $error['mail'] ?? null ?>
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