<h1 class="text-center">Nouveau mot de passe</h1>
<div class="text-center">
    <img class="qa_image_size mb-3" src="<?= URL ?>public/assets/images/acount.jpg" alt="" srcset="">
</div>

<?php Toolbox::displayAlerts(); ?>


<div class="container mt-3">
    <p class="text-center"><strong>Veuillez entrer votre nouveau mot de passe:</strong></p>
    <div class="row">
        <form action="<?= URL ?> change_password" method="POST" class="needs-validation mt-3" novalidate>
            <div class="row">
                <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_password" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" id="qa_password" name="password" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Veuillez entrer un mot de passe.
                    </div>
                </div>
                <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_confirm_password" class="form-label">Confirmation du mot de passe :</label>
                    <input type="password" class="form-control" id="qa_confirm_password" name="passwordConfirmation" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Les mots de passe doivent correspondre.
                    </div>
                </div>
                <div>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" required oninput="validateFields(this)">

                </div>

                <div>
                    <button type="submit" class="qa_button col-2">Envoyer</button></button>
                </div>

        </form>
    </div>

</div>
</div>