<h1 class="text-center">Mon compte</h1>
<div class="text-center mb-2">
    <img class="qa_image_size" src="<?= URL ?>public/assets/images/acount.jpg" alt="" srcset="">
</div>

<?php Toolbox::displayAlerts(); ?>


<div class="container">
    <div class="row mt-3">
        <div class="col-12 col-sm-6 text-center mt-3">
            <dl>
                <dt>Prenom:</dt>
                <dd><?= htmlspecialchars($user->firstName) ?></dd>
            </dl>
        </div>
        <div class="col-12 col-sm-6 text-center mt-3">
            <dl>
                <dt>Nom:</dt>
                <dd><?= htmlspecialchars($user->lastName) ?></dd>
            </dl>
        </div>
        <div class="col-12 col-sm-6 text-center mt-3">
            <dl>
                <dt>Email:</dt>
                <dd><?= htmlspecialchars($user->email) ?></dd>
            </dl>
        </div>
        <div class="col-12 col-sm-6 text-center mt-3">
            <dl>
                <dt>Nombre de convives:</dt>
                <dd><?= htmlspecialchars($user->guests) ?></dd>
            </dl>
        </div>
        <div class="col-12 col-sm-6 text-center mt-3">
            <dl>
                <dt>Allergies:</dt>
                <?php
                foreach ($user->allergy as $allergy) {
                    echo "<dd>" . htmlspecialchars($allergy) . "</dd>";;
                }
                ?>
            </dl>
        </div>
        <div class="col-12-col-sm-6 text-center">
        <a href="#" class="col-3">
        <button type="button" class="qa_button">Modifier mon compte</button>
    </a>
        </div>
      
    </div>
 

</div>
