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
            <div >
                <a href="/"><img class="nav_logo" src="../assets/img/b2b.png" alt=""></a>
            </div>
            <div class="nav_menu_berger"><img src="../assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="../pages/_afterboss.php">Afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>   
    </header>
    <main class="main--afterwork">
    <section class="section_card--var order1">
            <div class="presentation">
                <img class="logo_entrepreneurs2demain" src="../assets/img/entrepreneurs2demainblack.png" alt="">
            
            <p class="section_card--txt">
            Nos formations s'adressent à celles et ceux qui sont de jeunes chef.f.es d'entreprise et/ou qui veulent le devenir 
            et/ou qui sont en pleine réflexion et décision de le devenir ! Deux parcours initiaux pour comprendre, poser et envisager les décisions à prendre pour mettre son business en situation de réussite potentielle.
            </p>
            <p class="txt_short--var">LA PROCHAINE SESSION</p>
        </div>
    </section>
    <div class="infos_offers--var-orange order2">

        <?= getLastFormE2D ($dbCo) ?>
        
    </div>
    <div class="content_offers order3">
        <h2 class="card_title">NOS OFFRES</h2>
        <div class="content_offers_btn">
            <button class="btn btn--var-orange">CURSUS 5 JOURS</button>
            <button class="btn btn--var-orange">CURSUS 3 JOURS</button>
        </div>
    </div>
        </card>
    </div>
    <section class="section_formations">
        <div class="banner_offers--var-orange">
            <h2 class="banner_title">CURSUS 5 JOURS</h2>
            <p class="banner_txt">Nous proposons des formations gratuites grâce au concours et au partenariat que nous avons noué avec l'ORIFF-PL (https://www.oriffplcn.fr). Cette formation s’articule autour de deux pôles principaux : 
            les questions administratives et financières liées à la création et à son business plan, les questions marketing avec, en particulier, son offre, sa place sur le marché et sa propre image de marque.</p>
            <img class="oriffpl" src="../assets/img/oriffpl.png" alt="">
        </div>

        <?= getAllFormE2D5J ($dbCo) ?>

        <div class="banner_offers--var-orange">
            <h2 class="banner_title">CURSUS 3 JOURS</h2>
            <p class="banner_txt">Au centre de ce cursus, la question de la création d’entreprise selon trois axes : le management d’entreprise, le besoin financier, mon offre et son marché. Trois jours pour affiner et peut-être valider son « go ».</p>

        </div>

        <?= getAllFormE2D3J ($dbCo) ?>

    </section>
    </main>
    <?php require('_footer-var.php') ?>
</body>
</html>