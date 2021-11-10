<main>
    <div class="container">
        <?php if (isset($returned_message)) : ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-6 alert alert-info mt-5 text-center">
                        <p><?= $returned_message ?></p>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?updateAppointment=<?= $appointment->id ?? '' ?>" method="post" class="row justify-content-evenly">

            <!-- ---------------------------------------- PERSONNAL INFORMATIONS ---------------------------------------- -->
            <fieldset class="col-9 col-sm-8 col-md-5 col-xl-3 mt-5 mb-4">
                <legend class="fs-5">Formulaire de modification du rendez-vous</legend>

                <!-- ------------------- NAMES ------------------- -->
                <div class="d-flex flex-column">

                    <div class="d-flex flex-column mb-3">
                        <label for="patientId">Patient :</label>
                        <select name="patientId" class="no_border pointer p-2  rounded" readonly>
                            <option value="<?= $appointment->id ?>"><?= $appointment->lastname ?> <?= $appointment->firstname ?></option>
                        </select>
                        <span class="text-danger fs-09"><?= $errors['patientError'] ?? '' ?></span>
                    </div>

                    <!-- date & hour -------------- -->
                    <div class="d-flex flex-column mb-3">
                        <label for="hour">Heure<span>*</span> :</label>

                        <select name="appointHour" class="no_border pointer p-2  rounded">
                            <?php foreach ($appointHours as $hour_value) :
                                $selected = ($appointHour === $hour_value) ? 'selected="selected"' : '';

                            ?>
                                <option value="<?= $hour_value ?>"><?= $hour_value ?>h</option>
                            <?php endforeach ?>
                        </select>
                        <span class="text-danger fs-09"><?= $errors['hourError'] ?? '' ?></span>
                    </div>

                    <div class="d-flex flex-column mb-3">
                        <label for="date">Date<span>*</span> :</label>
                        <input type="date" name="appointDate" value="<?= htmlentities($_POST['date'] ?? '') ?>" required="required" size="30" class="p-2  no_border pointer">
                        <span class="text-danger fs-09"><?= $errors['dateError'] ?? '' ?></span>
                    </div>                    
            </fieldset>
                <div class="d-flex flex-center mb-3">
                            <input type="submit" value="Modifier le rendez-vous" class="btn bg-light offset-4 col-4  mt-3 mb-2">
                </div>
        </form>
    </div>
</main>