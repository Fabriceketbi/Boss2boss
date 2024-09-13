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
    <main class="main--lespepes">
    <section class="section_card--var order1">
            <div class="presentation">
                <img class="logo_lespepesflingueurs" src="../assets/img/lespepesflingueursblack.png" alt="">
            
            <p class="section_card--txt">
            Avec une liberté totale de ton, les "Pépés Flingueurs" - 70 ans
            d'entreprenariat cumulé à 2 - abordent des sujets complexes sans détour mais avec humour et bienveillance. Quitte à regarder la vérité en face, autant sourire au miroir !
            </p>

            <section class="section_peoples">

                <div class="perso">
                    <img class="perso_img" src="../assets/img/FrançoisPineda.png" alt="">
                    <h2 class="name">François PINEDA</h2>
                </div>

                <div class="perso">
                    <img class="perso_img" src="../assets/img/ThierryPerrette.png" alt="">
                    <h2 class="name">Thierry PERRETTE</h2>
                </div>

            </section>

            <p class="txt_short--var">LA PROCHAINE SESSION</p>
        </div>
    </section>
    <div class="infos_offers--var-red order2">
        <!-- <card class="card card--var-red">
            <h2 class="card_title">CONFÉRENCES</h2>
            <div>
                <p class="card_txt--var-red">Quoi ma gueule ? 
                </p>
                <p class="card_txt--var-red">(Personal branding)</p>
            </div>
                <p class="card_subtitle">PROCHAINE SESSION</p>
                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>07/11/24 </l1>
                            <l1>18h-19h30h</l1>
                            <l1>Caen</l1>
                        </ul>
                    </div>
                    <button class="btn btn--var-white-red">Je m'inscris
                        </button>
                    </div>
                </card> -->
                <?= getLastFormLppF($dbCo) ?>
            </div>
    <div class="content_offers order3">
        <h2 class="card_title">NOS OFFRES</h2>
        <div class="content_offers_btn">
            <button class="btn btn--var-red">CONFÉRENCES</button>
        </div>
    </div>
        </card>
    </div>
    <section class="section_formations">
        <div class="banner_offers--var-red">
            <h2 class="banner_title">CONFÉRENCES</h2>
            <p class="banner_txt">A l’occasion d’une conférence de 90 minutes animée en duo, des sujets-clefs d’actualité sont abordés : image de soi, management multigénérationnelle, changements sociétaux… Dire, réfléchir et rire (souvent de soi) sont au programme.</p>
        </div>
        
        <?= getAllFormLppF($dbCo) ?>

    </section>
    </main>
    <?php require('_footer-var.php') ?>
</body>
</html>