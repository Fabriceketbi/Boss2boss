<?php
session_start();
unset($_SESSION['errorsList']);
require_once 'includes/_fonctions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>boss2boss</title>
</head>

<body>
    <header>
        <div class="header_nav--desktop">
            <a href="/"><img class="nav_logo" src="assets/img/b2b.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple active" href="./pages/_afterboss.php">afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="./pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="./pages/_lespepes.php">les pépés flingueurs</a></li>
                    <li><a class="btn btn--header-white--red-basic" href="./pages/_mouvement-outside.php">mouvement</a></li>
                    <li><a class="btn btn--header-white--blue" href="./pages/_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                    <li><a class="btn btn--header-white--green" href="./pages/_b2btv.php">B2B TV</a></li>
                </ul>

            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div class="nav_logo-mobile">
                <a href=""><img class="nav_logo-mobile" src="assets/svg/logo.svg" alt=""></a>
            </div>

            <div class="nav_menu_berger">
                <img class="" src="assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="./pages/_afterboss.php">afterboss</a></li>
                <li><a class="menu_berger-itm" href="./pages/_entrepreneur2demain.php">entrepreneur2demain</a></li>
                <li><a class="menu_berger-itm" href="./pages/_lespepes.php">les pépés flingueurs</a></li>
                <li><a class="menu_berger-itm" href="./pages/_mouvement-outside.php">mouvement</a></li>
                <li><a class="menu_berger-itm" href="./pages/_mouvement-outside.php#outsideTheBox">outside the box</a></li>
                <li><a class="menu_berger-itm" href="./pages/_b2btv.php">B2B TV</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>

        <section class="header_banner">
            <div class="header_banner--content">
                <img class="logo_header_banner" src="assets/img/boss2boss_white.png" alt="">
                <h3 class="header_banner--tlt">Avec 3 concepts, il y en a forcement un pour vous !</h3>

                <div class="header_banner-bottom_content">
                    <div class="content_bublle">
                        <ul>
                            <li data-tab="tab1" class="hidden itm_bublle itm_bublle-purple">
                                <p class="txt_bublle-purple">
                                    Et si on se parlait
                                    vraiment,
                                    <span class="txt_short--span-purple">sans tabou</span> ?
                                </p>
                            </li>
                            <li data-tab="tab2" class="hidden itm_bublle itm_bublle-orange">
                                Besoin d’aide avant le saut dans le grand bain de
                                <span class="txt_short--span-orange">l’entreprenariat</span> ?
                            </li>
                            <li data-tab="tab3" class="hidden itm_bublle itm_bublle-red">
                                70 ans cumulés d’entreprenariat, avec humour et
                                <span class="txt_short--span-red">sans complexe</span> !
                            </li>
                            <li data-tab="tab4" class="hidden itm_bublle itm_bublle-blue">
                                <p class="txt_bublle-blue">
                                    Devenir acteur de sa
                                    <span class="txt_short--span-blue">réussite</span> !
                                </p>
                            </li>
                            <li data-tab="tab5" class="hidden itm_bublle itm_bublle-red-basic">
                                <p class="txt_bublle-red-basic">
                                    Devenir acteur du
                                    <span class="txt_short--span-red-basic">changement</span> !
                                </p>
                            </li>
                            <li data-tab="tab6" class="hidden itm_bublle itm_bublle-black">
                                Des parcours de vie
                                inspirants
                            </li>

                        </ul>
                    </div>
                    <div class="content_accordion">
                        <ul>
                            <li data-tab="tab1" class="itm_accordion itm_accordion-purple">
                                <img class="img_accordion-purple" src="assets/img/afterboss-full-black.png" alt="">
                                <img data-tab="tab1" class="icon-more icon-more--rotate" src="assets/img/icon-plus.png" alt="">
                                <p id="tab1" data-tab-content="" class="txt_accordion-purple hidden">
                                    Si personne ne détient la vérité, à plusieurs, on est sûrement plus inteligents ! Sur une thématique donnée, des échanges simples, <span class="txt_short--bold">sans tabou</span> sur les maux qui pèsent sur les chef.fes d’entreprise comme sur les dirigeant.es d’entreprise.
                                    Une logique collaborative, conviviale et profondément résiliente.
                                </p>
                            </li>
                            <li data-tab="tab2" class="itm_accordion itm_accordion-orange">
                                <img class="img_accordion-orange" src="assets/img/entrepreneurs2demain-fullblack.png" alt="">
                                <img data-tab="tab2" class="icon-more icon-more--rotate" src="assets/img/icon-plus.png" alt="">
                                <p id="tab2" data-tab-content="" class="txt_accordion-orange hidden">
                                    Nos formations s'adressent à celles et ceux qui sont de <span class="txt_short--bold">jeunes chef.f.es d'entreprise</span> et/ou qui veulent le devenir et/ou qui sont en pleine réflexion et décision de le devenir ! Deux parcours initiaux pour comprendre, poser et envisager les décisions à prendre pour mettre son business en situation de <span class="txt_short--bold">réussite</span> potentielle.
                                </p>
                            </li>
                            <li data-tab="tab3" class="itm_accordion itm_accordion-red">
                                <img class="img_accordion-red" src="assets/img/pepe_b2b_blanc.png" alt="">
                                <img data-tab="tab3" class="icon-more icon-more--rotate" src="assets/img/icon-plus.png" alt="">
                                <p id="tab3" data-tab-content="" class="txt_accordion-red hidden">
                                    Avec une liberté totale de ton, les "Pépés Flingueurs" - 70 ans
                                    d'entreprenariat cumulé à 2 - abordent des sujets complexes sans détour mais avec humour et bienveillance. Quitte à regarder la vérité en face, autant sourire au miroir !
                                </p>
                            </li>
                            <li data-tab="tab4" class="itm_accordion itm_accordion-blue">
                                <img class="img_accordion-blue" src="assets/img/outsidenoir.png" alt="">
                                <img data-tab="tab4" class="icon-more icon-more--rotate" src="assets/img/icon-plus.png" alt="">
                                <p id="tab4" data-tab-content=""
                                    class="txt_accordion-blue hidden">
                                    OUTSIDE THE BOX place l'humain au centre d'une expérience unique. Grâce à des conférences scénarisées et immersives, nous abordons des thématiques sociétales percutantes et profondément actuelles : pression sociale, peur de l’avenir après les études, et bien d’autres.
                                </p>
                            </li>
                            <li data-tab="tab5" class="itm_accordion itm_accordion-red-basic">
                                <img class="img_accordion-red-basic" src="assets/img/mouvement_blanc.png" alt="" >
                                <img data-tab="tab5" class="icon-more icon-more--rotate" src="assets/img/icon-plus.png" alt="">
                                <p id="tab5" data-tab-content=""
                                    class="txt_accordion-red-basic hidden">
                                    MOUVEMENT a pour objet de traiter des questions résolument actuelles liées à la place du numérique, aux nouvelles façons de travailler , à l’intégration des nouvelles générations, aux nouveaux outils.
                                </p>
                            </li>
                            <li data-tab="tab6" class="itm_accordion itm_accordion-green">
                                <img class="img_accordion-green" src="assets/img/les-rencontres-fullblack.png" alt="" class="img_accordion-green">
                                <img data-tab="tab6" class="icon-more icon-more--rotate" src="assets/img/icon-plus.png" alt="">
                                <p id="tab6" data-tab-content=""
                                    class="txt_accordion-green hidden">
                                    En toute intimité au coeur de l’emploi et de l’entreprise
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
    </header>

    <main class="main">
        <div class="main_content">
        <section class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img class="pop-up_close" src="assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <card class="pop-up_card">
                        <div class="card_content-img">
                            <img class="card_img" src="assets/img/FRANCOIS_NB_B2B.jpg" alt="">
                        </div>
                        <p>
                            <span class="card_name">François Pineda</span> vous propose une heure d’échange et de recherches de solutions opérationnelles autour de ces thématiques en visio.
                        </p>
                        <p class="txt_price">
                            Le coût est de 250€ nets/consultation.
                        </p>
                        <div class="card_content-link">
                            <a href="https://www.au32.fr/"><img src="assets/img/Goto.png" alt=""></a>
                            <p>au 32.fr</p>
                        </div>
                    </card>
                    <div class="section_calendly">
                        <iframe class="iframe_calendly" width="100%" height="700" src="https://calendly.com/fpineda65/consultation"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <div class="content_section-agenda">
            <section class="section_agenda">
                <div class="content_agenda--title">
                    <h2 class="title_agenda">Les prochaines dates à ne pas louper ! </h2>
                </div>
                <div class="agenda_content-formation">
                    <?= formationIsComing($dbCo); ?>

                </div>

                <div class="content_make_rdv">
                    <h2>Parlons stratégie et developpement</h2>
                    <p>Vous souhaitez échanger, réfléchir et solutionner des problématiques liées au développement de votre entreprise. Communication ? Marketing ? Digital ?</p>
                    <button data-make_rdv="" class="btn btn--var-green">En savoir plus</button>
                </div>
            </section>
        </div>


        <div id="formations" class="banner">
            <h2>Nos afterworks</h2>
            <p class="txt-banner"><span class="txt_white-banner">Si vous êtes là c’est que l’on à forcément quelque chose</span> pour vous !</p>
        </div>
        <section class="section_card">
            <div class="presentation">
                <img class="logo_afterboss" src="assets/img/afterbossvar.png" alt="">

                <p class="section_card--txt">
                    Si personne ne détient la vérité, à plusieurs, on est sûrement plus intelligents ! Sur une thématique donnée, des échanges simples, sans tabou sur les maux qui pèsent sur les chef.fes d’entreprise comme sur les dirigeant.es d’entreprise.
                    Une logique collaborative, conviviale et profondément résiliente.
                </p>
                <div>
                    <a class="btn btn--var-purple" href="pages/_afterboss.php#afterwork">AFTERWORK</a>
                    <a class="btn btn--var-purple" href="pages/_afterboss.php#atelier">LES ATELIERS</a>
                </div>
            </div>
        </section>
        <div class="infos_offers">
            <?= getFormAwByDate($dbCo); ?>
        </div>

        <section class="section_card">
            <div class="presentation">
                <img class="logo_entrepreneurs2demain" src="assets/img/entrepreneurs2demainblack.png" alt="">

                <p class="section_card--txt">
                    Nos formations s'adressent à celles et ceux qui sont de jeunes chef.fes d'entreprise et/ou qui veulent le devenir
                    et/ou qui sont en pleine réflexion et décision de le devenir ! Deux parcours initiaux pour comprendre, poser et envisager les décisions à prendre pour mettre son business en situation de réussite potentielle.
                </p>

                <div>
                    <a class="btn btn--var-orange" href="pages/_entrepreneur2demain.php#cursus3j">CURSUS 5 JOURS</a>
                    <a class="btn btn--var-orange" href="pages/_entrepreneur2demain.php#cursus5j">CURSUS 3 JOURS</a>
                </div>
            </div>
        </section>
        <div class="infos_cursus">

            <?= getCursusByDate($dbCo); ?>
        </div>
        </section>

        <section class="section_card">
            <div class="presentation">
                <img class="logo_lespepesflingueurs" src="assets/img/lespepesflingueursblack.png" alt="">

                <p class="section_card--txt">
                    Avec une liberté totale de ton, les "Pépés Flingueurs" - 70 ans d'entrepreunariat cumulé à 2 - abordent des sujets complexes sans détour mais avec humour et bienvaillance. Quitte à regarder la vérité en face, autant sourire au miroir!
                </p>

                <div>
                    <a class="btn btn--var-red" href="pages/_lespepes.php#conférences">CONFÉRENCES</a>
                </div>
            </div>
        </section>
        <div class="infos_conf">

            <?= getFormLesPepesByDate($dbCo) ?>
        </div>
        </section>


        <section class="section_card">
            <div class="presentation">
                <img class="logo_mouvement" src="assets/img/mouvement.png" alt="">

                <p class="section_card--txt">
                    Au travers de conférences-débats, WORKFLOW propose des approches concrètes, pratiques et opérationnelles avec un objectif simple : trouver des clefs d’optimisation à effet immédiat.
                </p>

                <div>
                    <a class="btn btn--var-red-basic" href="pages/_mouvement-outside.php#mouv">WORKFLOW</a>
                </div>
            </div>
        </section>
        <div class="infos_workflow">

            <?= getFormMouvementByDate($dbCo) ?>
        </div>
        </section>

        <section class="section_card">
            <div class="presentation">
                <img class="logo_outside" src="assets/img/outsidetheboxcoul.png" alt="">

                <p class="section_card--txt">
                    Et si la solution n’était pas de résoudre les
                    problèmes, mais de changer notre regard sur eux ?
                </p>

                <div>
                    <a class="btn btn--var-blue" href="pages/_mouvement-outside.php#outside">DEVENIR ACTEUR DE SA RÉUSSITE</a>
                </div>
            </div>
        </section>
        <div class="infos_outside">

            <?= getFormOutsideByDate($dbCo) ?>
        </div>
        </section>

        </div>
        <section class="section_card--black">
        <div class="card_content-b2btv">
            <div class="card_content-img">
                
                <img class="img-b2btv" src="../assets/img/img-b2b-radius.png" alt="">
              
                <div class="card_content-banner">   
                    <figure>
                    <picture>
                        <source media="(min-width: 960px)" srcset="../assets/img/img-tlt-les-rencontres-XL.png">
                        <img src="../assets/img/img-tlt-les-rencontres-S.png" alt="">
                    </picture>
                    <figcaption></figcaption>
                    </figure>    

                    <p class="card_txt-b2btv">
                        En toute intimité au coeur de l’emploi et de l’entreprise 
                    </p>

                    <p class="card_txt-b2btv">
                        Découvre tous nos programmes
                    </p>

                    <div class="content_btn-b2btv">
                        <a class="btn btn-green" href="pages/_b2btv.php">Les rencontres</a>
                    </div>
                </div>
            </div>
        
        </div>
        </section>

    
    </main>
    <footer class="footer">
        <div class="content_logo">
            <a href="/"><img class="footer_logo-b2b" src="assets/img/b2b.png" alt=""></a>
            <div class="footer_logo-ac-signature">
                <img class="footer_logo-ac" src="assets/img/ac.png" alt="">
                <img class="footer_logo-signature" src="assets/img/signature.png" alt="">
            </div>
        </div>
        <div class="footer_content_links">
            <ul class="footer_lst-links">
                <li class="footer_item"><a class="footer_link" href="pages/_mentions-legales.php">Mentions légales</a></li>
                <li class="footer_item"><a class="footer_link" href="pages/_reglement-interireur.php">Règlement intérieur</a></li>
            </ul>
            <ul class="footer_lst-links">
                <li class="footer_item"><a class="footer_link" href="pages/_cgu.php">CGU</a></li>
                <li class="footer_item"><a class="footer_link" href="pages/_rgpd.php">RGPD</a></li>
                <li class="footer_item"><a class="footer_link" href="">Contact</a></li>
            </ul>
        </div>

    </footer>
    <script type="module" src="js/script-index.js"></script>
</body>

</html>