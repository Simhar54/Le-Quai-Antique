<h1 class="text-center">Modifier votre mot de passe</h1>
<div class="text-center mb-2">
    <img class="qa_image_size" src="<?= URL ?>public/assets/images/acount.jpg" alt="" srcset="">
</div>

<?php Toolbox::displayAlerts(); ?>


<div class="container">
    <div class="row mt-3">
        <form action="modification_password" method="POST" class="needs-validation" novalidate>
            <div class="row">
            <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_old_password" class="form-label">Veuillez entrer votre ancien mode passe :</label>
                    <input type="password" class="form-control" id="qa_old_password" name="old_password" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Veuillez entrer un mot de passe valide.
                    </div>
                </div>
            
                <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_password" class="form-label">Veuillez entrer votre nouveau mot de passe :</label>
                    <input type="password" class="form-control" id="qa_password" name="password" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Veuillez entrer un mot de passe valide.
                    </div>
                </div>
                <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_confirm_password" class="form-label">Confirmation du nouveau mot de passe :</label>
                    <input type="password" class="form-control" id="qa_confirm_password" name="passwordConfirmation" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Les mots de passe doivent correspondre.
                    </div>
                </div>
      
                <div>
                    <button type="submit" class="qa_button col-2">Modifier mot de de passe</button>
                </div>

        </form>
    </div>

</div>
</div>