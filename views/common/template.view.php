<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description ?>">
    <title><?= $page_title ?></title>

    <!-- Link to CSS -->
    <link rel="stylesheet" href="<?= URL ?>public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL ?>public/css/main.css">
    <?php if (!empty($page_css)) : ?>
        <?php foreach ($page_css as $fichier_css) : ?>
            <link href="<?= URL ?>public/CSS/<?= $fichier_css ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <div>Header</div>
    <?= $page_content ?>
    <div>Footer</div>




    <!-- Link to JS -->
    <script src="<? URL ?>public/javascript/bootstrap.bundle.min.js"></script>
    <?php if (!empty($page_javascript)) : ?>
        <?php foreach ($page_javascript as $fichier_javascript) : ?>
            <script src="<?= URL ?>public/JavaScript/<?= $fichier_javascript ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>