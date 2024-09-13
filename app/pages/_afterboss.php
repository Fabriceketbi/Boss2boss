<?php

session_start();

require_once '../includes/_fonctions.php';
include '../includes/_database.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>boss2boss</title>
</head>

<body>
    <header>
        <div class="header_nav--desktop">
            <a href="/"><img class="nav_logo" src="../assets/img/boss2boss_white.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple" href="../pages/_afterboss.php">Afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="../pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="../pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                </ul>

            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div>
                <a href="/"><img class="nav_logo" src="../assets/img/b2b.png" alt=""></a>
            </div>
            <div class="nav_menu_berger"><img src="../assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="../pages/afterboss.php">Afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>
    </header>
    <main class="main--afterwork">
        <section class="section_card--var order1">
            <div class="presentation">
                <img class="logo_afterboss" src="../assets/img/afterbossvar.png" alt="">

                <p class="section_card--txt">
                    Si personne ne détient la vérité, à plusieurs, on est sûrement plus intelligents ! Sur une thématique donnée, des échanges simples, sans tabou sur les maux qui pèsent sur les chef.fes d’entreprise comme sur les dirigeant.es d’entreprise.
                    Une logique collaborative, conviviale et profondément résiliente.
                </p>
                <p class="txt_short--var">LA PROCHAINE SESSION</p>
            </div>
        </section>
        <div class="infos_offers--var order2">
            <?= getLastFormAb ($dbCo) ?>
        </div>
        <div class="content_offers order3">
            <h2 class="card_title">NOS OFFRES</h2>
            <div class="content_offers_btn">
                <button class="btn btn--var-purple">AFTERWORK</button>
                <button class="btn btn--var-purple">LES ATELIERS</button>
            </div>
        </div>
        </card>
        </div>
        <section class="section_formations">
            <div class="banner_offers">
                <h2 class="banner_title">AFTER WORK</h2>
                <p class="banner_txt">Autour d’une thématique animée par un expert, cinq à six chefs d’entreprises échangents, mettent en commun et envisagent des solutions.</p>
            </div>

            <?= getFormAbAw($dbCo) ?>


            <div class="banner_offers">
                <h2 class="banner_title">LES ATELIERS</h2>
                <p class="banner_txt">Animé par un.e expert.e, une demi-journée 100% pratique pour traiter d’une problématiques... et la régler !</p>
            </div>

            <?= getAllFormAbLa($dbCo) ?>

        </section>
    </main>
    <?php require('_footer-var.php') ?>
</body>

</html>