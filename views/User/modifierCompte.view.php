<?php var_dump($user->allergy) ?>


<h1 class="text-center">Modifier votre compte</h1>
<div class="text-center mb-2">
    <img class="qa_image_size" src="<?= URL ?>public/assets/images/acount.jpg" alt="" srcset="">
</div>

<?php Toolbox::displayAlerts(); ?>


<div class="container">
    <div class="row">
        <form action="modification_account_information" method="POST" class="needs-validation" novalidate>
            <div class="row">

                <div class="mb-3 col col-12 col-sm-6">
                    <label for="qa_firstname" class="form-label">Prénom :</label>
                    <input type="text" class="form-control" id="qa_firstname" name="firstName" required oninput="validateFields(this)" value="<?= $user->firstName ?>">
                    <div class="invalid-feedback">
                        Veuillez entrer votre prénom.
                    </div>
                </div>
                <div class="mb-3 col col-12 col-sm-6">
                    <label for="qa_lastname" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="qa_lastname" name="lastName" required oninput="validateFields(this)" value="<?= $user->lastName ?>">
                    <div class="invalid-feedback">
                        Veuillez entrer votre nom.
                    </div>
                </div>
                <div class="mb-3 col col-12 col-sm-6">
                    <label for="qa_email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="qa_email" name="email" required oninput="validateFields(this)" value="<?= $user->email ?>">
                    <div class="invalid-feedback">
                        Veuillez entrer une adresse email valide.
                    </div>
                </div>
                <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_guests" class="form-label">Nombre de convives :</label>
                    <input type="number" class="form-control" id="qa_guests" name="guests" min="1" required oninput="validateFields(this)" value="<?= $user->guests ?>">
                    <div class="invalid-feedback">
                        Veuillez entrer un nombre de convives valide.
                    </div>
                </div>

                <div class="mb-3 col-12 col-sm-6" id="allergy_form_container" data-allergies='<?php echo json_encode($user->allergy) ?>'>
                    <label for="qa_allergy_<?= $id_input ?>" class="form-label">Allergies :</label>
                    <ul class="qa_allergy_form_list">

                    </ul>
                    <input type="text" class="form-control" id="qa_allergy_<?= $id_input ?>" name="allergies[]" oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Veuillez entrer une allergie.
                    </div>
                    <button type="button" class="qa_button mt-2" id="add_allergy">Ajouter une allergie</button>
                </div>

                <div>
                    <button type="submit" class="qa_button col-2">Valider Modification</button>
                   
                </div>
        </form>
        <a href="<?= URL ?>account/supprimer_compte" class="btn btn-danger mt-5 ms-2 col-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">Supprimer compte</a>

    </div>

</div>
</div>