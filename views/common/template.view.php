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
    <link rel="stylesheet" href="<?= URL ?>public/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= URL ?>public/css/main.css">
    <?php if (!empty($page_css)) : ?>
        <?php foreach ($page_css as $fichier_css) : ?>
            <link href="<?= URL ?>public/CSS/<?= $fichier_css ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <header class="mb-auto">
        <nav class="navbar navbar-expand-lg d-block d-sm-none">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="<?= URL ?>public/assets/images/logo_quai_antique.svg" alt="Logo" width="80px" height="auto" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php

                        foreach ($menuItems as $menuItem) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $menuItem['url'] ?>"><?= $menuItem['name'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="qa_page_content">
        <main>
            <div class="row" id="qa_content_container">
                <div id="qa_sideMenu" class="col-sm-3 d-none d-sm-block text-center">
                    <div>
                        <img src="<?= URL ?>public/assets/images/logo_quai_antique.svg" alt="" srcset="" width="100%" height="auto" id="qa_sideMenu_logo">
                    </div>
                    <div>
                        <ul class="qa_sideMenu_listGroup d-flex flex-column">
                            <?php

                            foreach ($menuItems as $menuItem) : ?>
                                <li class="qa_sideMenu_listItem ">
                                    <a href="<?= $menuItem['url'] ?>"><?= $menuItem['name'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
                <div class="col-12 col-sm-9 " id="qa_content_wrapper">
                    <div id="qa_content">
                        <?= $page_content ?>
                    </div>


                </div>
            </div>



        </main>
        <footer class=" qa_footer container-fluid ">
            <div class="row align-items-center justify-content-around  ">
                <div class="col-12 col-sm-3 qa_footerBox">
                    Horaires d'ouverture : <br>
                    <span>
                        Mardi - Jeudi : 12h00 - 14h30, 19h00 - 22h30 <br>
                        Week-end : 12h00 - 14h30, 19h00 - 23h00 <br>
                        Lundi : Fermé <br>
                    </span>
                </div>
                <div class="col-12 col-sm-3 qa_footerBox">
                    Le Quai Antique <br>
                    12 Quai des Allobroges <br>
                    73000 Chambéry Savoie, France <br>
                    Tél : +33 4 50 11 22 33 <br>
                </div>
                <div class="col-12 col-sm-3 qa_footerBox">
                    Retrouvez-nous sur les réseaux sociaux <br>
                    <div>
                        <a href="https://www.facebook.com/" target="_blank">
                            <img class="qa_footerIcon" src="<?= URL ?>public/assets/icon/facebook.svg" alt="" srcset="">
                        </a>
                        <a href="https://www.instagram.com/" target="_blank">
                            <img class="qa_footerIcon" src="<?= URL ?>public/assets/icon/instagram.svg" alt="" srcset="">
                        </a>
                    </div>
                </div>
                <div id="copyright">
                    <span>© arnaudSimoncelli(); 2023</span>
                </div>
        </footer>


    </div>







    <!-- Link to JS -->
    <script src="<?= URL ?>public/javascript/bootstrap.bundle.min.js"></script>
    <?php if (!empty($page_javascript)) : ?>
        <?php foreach ($page_javascript as $fichier_javascript) : ?>
            <script src="<?= URL ?>public/javascript/<?= $fichier_javascript ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>