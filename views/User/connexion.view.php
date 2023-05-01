<h1 class="text-center">Créez votre compte</h1>
<div class="text-center mb-2">
    <img class="qa_image_size" src="<?= URL ?>public/assets/images/acount.jpg" alt="" srcset="">
</div>

<?php Toolbox::displayAlerts(); ?>


<div class="container mt-5">
    <div class="row">
        <form action="validate_connexion" method="POST" class="needs-validation" novalidate>
            <div class="row">
                <div class="mb-3 col col-12 col-sm-6">
                    <label for="qa_email" class="form-label">Email de connexion :</label>
                    <input type="email" class="form-control" id="qa_email" name="email" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Veuillez entrer une adresse email valide.
                    </div>
                </div>
                <div class="mb-3 col-12 col-sm-6">
                    <label for="qa_password" class="form-label">Mot de passe :</label>
                    <input type="password" class="form-control" id="qa_password" name="password" required oninput="validateFields(this)">
                    <div class="invalid-feedback">
                        Veuillez entrer un mot de passe.
                    </div>
                </div>
                <div>
                    <button type="submit" class="qa_button col-2">Se connecter</button>
                </div>
        </form>
        <p class="mt-2">Vous n'avez pas de compte? <a href="inscription" class="qa_link">Cliquez ici!</a> </p> 
    </div>

</div>
</div>