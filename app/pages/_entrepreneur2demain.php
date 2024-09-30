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
            <a href="/"><img class="nav_logo" src="../assets/img/b2b.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple" href="../pages/_afterboss.php">afterboss</a></li>
                    <li><a class="btn btn--header-white--orange active_etp" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
                </ul>
                
            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div >
                <a href="/"><img class="nav_logo-mobile" src="../assets/img/b2b.png" alt=""></a>
            </div>
            <div class="nav_menu_berger"><img src="../assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="../pages/_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="../pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="../pages/_lespepes.php">les pépés flingueurs</a></li>
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
            <div class="content_offers">
                    <h2 class="card_title-underline">Découvrez nos offres</h2>
                    <div class="content_offers_btn">
                        <a href="#cursus5j" class="btn btn--var-orange">CURSUS 5 JOURS</a>
                        <a href="#cursus3j" class="btn btn--var-orange">CURSUS 3 JOURS</a>
                    </div>
                </div>

        </div>
    </section>
    <div class="infos_offers--var-orange">
        <?= getCursusByDate ($dbCo) ?>
    </div>

        </card>
    </div>
    <div class="content_cursus">
        <section id="cursus3j" class="section_formations">     
            
            <?= getAllFormE2D3J ($dbCo) ?>
        <div id="cursus5j"></div>
            <?= getAllFormE2D5J ($dbCo) ?>
        </section>
        
    </div>
    </main>
    <?php require('_footer.php') ?>
    <script type="module" src="../js/script-entrepreneur2demain.js"></script>
</body>
</html>