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
            <a href="/"><img class="nav_logo" src="assets/img/boss2boss_white.png" alt=""></a>
            <nav>
                <ul class="nav_lst">
                    <li><a class="btn btn--header-white--purple" href="./pages/_afterboss.php">Afterboss</a></li>
                    <li><a class="btn btn--header-white--orange" href="./pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                    <li><a class="btn btn--header-white--red" href="./pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                </ul>

            </nav>
            <a type="mail" href="mailto:fpineda@fpineda.co" class="btn btn--var-green">Contact</a>
        </div>
        <div class="header_nav--mobile">
            <div class="nav_logo">
                <a href=""><img src="assets/svg/logo.svg" alt=""></a>
            </div>
            <!-- <div class="nav_menu_berger">
                
            </div> -->
            <div class="nav_menu_berger">
                <img class="" src="assets/svg/menu_berger.svg" alt="">
            </div>
        </div>
        <div class="hidden nav_menu_berger-open">
            <ul class="nav_menu_berger-open--lst">
                <li><a class="menu_berger-itm" href="./pages/_afterboss.php">Afterboss</a></li>
                <li><a class="menu_berger-itm" href="./pages/_entrepreneur2demain.php">Entrepreneurs2demain</a></li>
                <li><a class="menu_berger-itm" href="./pages/_lespepes.php">Les Pépés Flingueurs</a></li>
                <li><a class="menu_berger-itm" type="mail" href="mailto:fpineda@fpineda.co">Contact</a></li>
            </ul>
        </div>

        <section class="header_banner">
            <div class="header_banner--content">
                <img class="logo_header_banner" src="assets/img/boss2boss_white.png" alt="">
                <div class="header_banner_lst">
                    <img class="logo_afterboss--header" src="assets/img/afterboss.png" alt="">
                    <img class="logo_lespepesflingueurs--header" src="assets/img/lespepesflingueurs.png" alt="">
                    <img class="logo_entrepreneurs2demain--header" src="assets/img/entrepreneurs2demain.png" alt="">
                </div>
                <a class="btn btn--var-green" href="#formations">Voir nos formation</a>
            </div>
        </section>
    </header>

    <main class="main">
        <section class="section_agenda">
            <div class="content_agenda--title">
                <h2 class="title_agenda">L'agenda</h2>
            </div>
            <div class="content_agenda">
                <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Europe%2FParis&bgcolor=%23ffffff&src=MTdlNWYwM2I2NTkzMTFiYzcyYzNmNDlmODJkNmNiOWY3ODc5OWUyMTU4YzRkY2RhMDc0MTAwMjhlNzZmMWZhZUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Y180NTM5Njc3OTBmNTA3MDFkNTdiNmIzOTg4MzVmN2VkNWE5YTQ5ZDllNzcyN2ZiOTUwNGIzNGU0OThlZjRkMmYzQGdyb3VwLmNhbGVuZGFyLmdvb2dsZS5jb20&color=%23009688&color=%239E69AF" style="border:solid 1px #777" width="352" height="300" frameborder="0" scrolling="no"></iframe>
            </div>
            <div class="content_agenda--title2">
                <h2 class="title_agenda">À venir</h2>
            </div>
            <div class="lst_rdv">
                <ul>
                    <div class="separator"></div>
                    <li class="itm_rdv">
                        <p class="rdv_date">03/11</p>
                        <p>Réunion de quelque chose</p>
                    </li>
                    <div class="separator"></div>
                    <li class="itm_rdv">
                        <p class="rdv_date">05/11</p>
                        <p>Conférence b2b</p>
                    </li>
                </ul>
            </div>
            <div class="content_make_rdv">
                <h2>RENDEZ-VOUS</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, necessitatibus doloribus sunt nihil eum reprehenderit.</p>
                <button class="btn btn--var-green">Prendre rendez-vous</button>
            </div>
        </section>
        <div id="formations" class="banner">
            <h2>Nos formations</h2>
        </div>
        <section class="section_card">
            <div class="presentation">
                <img class="logo_afterboss" src="assets/img/afterbossvar.png" alt="">

                <p class="section_card--txt">
                    Si personne ne détient la vérité, à plusieurs, on est sûrement plus intelligents ! Sur une thématique donnée, des échanges simples, sans tabou sur les maux qui pèsent sur les chef.fes d’entreprise comme sur les dirigeant.es d’entreprise.
                    Une logique collaborative, conviviale et profondément résiliente.
                </p>
                <p class="txt_short">Découvrez nos offres</p>
                <div>
                    <button class="btn btn--var-purple">AFTERWORK</button>
                    <button class="btn btn--var-purple">LES ATELIERS</button>
                    <button class="btn btn--var-purple">BOOTCAMP</button>
                </div>
            </div>
        </section>
        <div class="infos_offers">
            <card class="card card--var-purple">
                <h2 class="card_title">AFTERWORK</h2>
                <p class="card_txt">Je suis Superman, même pas peur, même pas mal 
                    ou comment en finir avec l’injonction d’exemplarité</p>
                <p class="card_subtitle">PROCHAINE SESSION</p>
                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>07/11/24 </l1>
                            <l1>18h-19h30h</l1>
                            <l1>Caen</l1>
                        </ul>
                    </div>
                    <button class="btn btn--var-white-purple">Je m'inscris
                    </button>
                </div>
            </card>
        </div>

        <section class="section_card">
            <div class="presentation">
                <img class="logo_entrepreneurs2demain" src="assets/img/entrepreneurs2demainblack.png" alt="">

                <p class="section_card--txt">
                    Nos formations s'adressent à celles et ceux qui sont de jeunes chef.fes d'entreprise et/ou qui veulent le devenir
                    et/ou qui sont en pleine réflexion et décision de le devenir ! Deux parcours initiaux pour comprendre, poser et envisager les décisions à prendre pour mettre son business en situation de réussite potentielle.
                </p>
                <p class="txt_short">Découvrez nos offres</p>
                <div>
                    <button class="btn btn--var-orange">CURSUS 5 JOURS</button>
                    <button class="btn btn--var-orange">CURSUS 3 JOURS</button>
                </div>
            </div>
        </section>
        <div class="infos_cursus">
            <card class="card card--var-purple">
                <h2 class="card_title">CURSUS 5 JOURS</h2>
                <p class="card_subtitle">PROCHAINE SESSION</p>
                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>07/11/24 </l1>
                            <l1>18h-19h30h</l1>
                            <l1>Caen</l1>
                        </ul>
                    </div>
                    <button class="btn btn--var-white-orange">Je m'inscris
                    </button>
                </div>
            </card>
        </div>
        </section>

        <section class="section_card">
            <div class="presentation">
                <img class="logo_lespepesflingueurs" src="assets/img/lespepesflingueursblack.png" alt="">

                <p class="section_card--txt">
                    Avec une liberté totale de ton, les Pépés Flingueurs* - 70 ans d'entrepreunariat cumulé à 2 - abordent des sujets complexes sans détour mais avec humour et bienvaillance. Quitte à regarder la vérité en face, autant sourire au miroir!
                </p>
                <p class="txt_short">Découvrez nos offres</p>
                <div>
                    <button class="btn btn--var-red">CURSUS 5 JOURS</button>
                </div>
            </div>
        </section>
        <div class="infos_conf">
            <card class="card card--var-purple">
                <h2 class="card_title">CURSUS 5 JOURS</h2>
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
            </card>
        </div>
        </section>
        <section class="section_follow">
            <div>
                <h2 class="follow_title">Suivez nous sur LinkedIn !</h2>
            </div>
            <div class="lst_card_linkedin">
                <div class="card_linkedin">
                    <div class="circle"></div>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div class="card_linkedin">
                    <div class="circle"></div>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
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
                <li class="footer_item"><a class="footer_link" href="">Alliance Consultants (c)</a></li>
                <li class="footer_item"><a class="footer_link" href="">Mentions légales</a></li>
            </ul>
            <ul class="footer_lst-links">
                <li class="footer_item"><a class="footer_link" href="">Règlement intérieur</a></li>
                <li class="footer_item"><a class="footer_link" href="">CGU</a></li>
                <li class="footer_item"><a class="footer_link" href="">RGPD</a></li>
                <li class="footer_item"><a class="footer_link" href="">Contact</a></li>
            </ul>
        </div>

    </footer>
    <script type="module" src="js/script-index.js"></script>
</body>

</html>