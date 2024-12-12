<?php

require_once '_database.php';
require_once '_config.php';

function test()
{
    echo 'test de chemin';
}
function testCo(PDO $dbCo)
{
    $query = $dbCo->query('SELECT * FROM host');

    $query->execute();

    while ($infoHost = $query->fetch()) {
        echo $infoHost['name'];
    }
}

/**
 * Redirect to the given URL.
 *
 * @param string $url
 * @return void
 */
function redirectTo(string $url): void
{
    // var_dump('REDIRECT ' . $url);
    header('Location: ' . $url);
    exit;
}

/**
 * Generate a unique token and add it to the user session. 
 *
 * @return void
 */
function generateToken()
{
    if (
        !isset($_SESSION['token'])
        || !isset($_SESSION['tokenExpire'])
        || $_SESSION['tokenExpire'] < time()
    ) {
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        $_SESSION['tokenExpire'] = time() + 60 * 15;
    }
}

/**
 * Check for CSRF token
 *
 * @param array|null $data Input data
 * @return boolean Is there a valid toekn in user session ?
 */
function isTokenOk(?array $data = null): bool
{
    if (!is_array($data)) $data = $_REQUEST;

    return isset($_SESSION['token'])
        && isset($data['token'])
        && $_SESSION['token'] === $data['token'];
}

/**
 * Check fo referer
 *
 * @return boolean Is the current referer valid ?
 */
function isRefererOk(): bool
{
    // HTTP_REFERER existe dans la superglobale $_SERVER
    // HTTP_REFERER est un en-tête HTTP qui indique l'URL de la page d'où provient la requête actuelle.
    // La fonction utilise isset() pour vérifier si cet en-tête est défini
    // Si HTTP_REFERER est défini, la fonction utilise str_contains() pour vérifier si l'URL définie dans $globalUrl est contenue dans l'URL  du HTTP_REFERER.
    // str_contains() renvoie true si la chaîne spécifiée est trouvée dans la chaîne principale, sinon false.
    global $globalUrl;
    return isset($_SERVER['HTTP_REFERER'])
        && str_contains($_SERVER['HTTP_REFERER'], $globalUrl);
}

/**
 * Verify HTTP referer and token. Redirect with error message.
 *
 * @return void
 */
function preventCSRF(string $redirectUrl = 'index.php'): void
{
    if (!isRefererOk()) {
        addError('referer');
        redirectTo($redirectUrl);
    }

    if (!isTokenOk()) {
        addError('csrf');
        redirectTo($redirectUrl);
    }
}

/**
 * Add a new error message to display on next page. 
 *
 * @param string $errorMsg - Error message to display
 * @return void
 */
function addError(string $errorMsg): void
{
    if (!isset($_SESSION['errorsList'])) {
        $_SESSION['errorsList'] = [];
    }
    $_SESSION['errorsList'][] = $errorMsg;
}

/**
 * Add a new message to display on next page. 
 *
 * @param string $message - Message to display
 * @return void
 */
function addMessage(string $message): void
{
    if (!isset($_SESSION['msg'])) {
        $_SESSION['msg'] = [];
    }
    $_SESSION['msg'][] = $message;
}

/**
 * Get value of error
 *
 * @param string $error
 * @param array $arrayErrors
 * @return string
 */
function getErrorValue(string $error, array $arrayErrors): string
{
    foreach ($arrayErrors as $errorValue) {
        if ($errorValue = $error) {
            return $error;
        }
    }
}

/**
 * Get value of succes
 *
 * @param string $succes
 * @param array $arrayMessages
 * @return string
 */
function getSuccesValue(string $succes, array $arrayMessages): string
{
    foreach ($arrayMessages as $succesValue) {
        if ($succesValue = $succes) {
            return $succes;
        }
    }
}

function displayErrorMsg(string $error, array $arrayErrors, $arrayDataError)
{
    return '<p class="msg_error">' . $arrayDataError[getErrorValue($error, $arrayErrors)] . '</p>';
}

function displaySuccesMsg(string $succes, array $arrayMessages, $arrayDataSucces)
{
    return '<p class="msg_succes">' . $arrayDataSucces[getSuccesValue($succes, $arrayMessages)] . '</p>';
}

// Tableau des jours et mois en français
$jours = array('Sunday' => 'Dimanche', 'Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi');
$mois = array('January' => 'Janvier', 'February' => 'Février', 'March' => 'Mars', 'April' => 'Avril', 'May' => 'Mai', 'June' => 'Juin', 'July' => 'Juillet', 'August' => 'Août', 'September' => 'Septembre', 'October' => 'Octobre', 'November' => 'Novembre', 'December' => 'Décembre');

// Fonction pour traduire
function traductDate($date)
{
    global $jours, $mois;
    $englishDate = date('l d F Y', strtotime($date));
    $frenchDate = str_replace(array_keys($jours), $jours, $englishDate);
    $frenchDate = str_replace(array_keys($mois), $mois, $frenchDate);
    return $frenchDate;
}


function checkNameHost(array $nameInfo): bool
{
    if (!isset($nameInfo['name']) || strlen($nameInfo['name']) === 0) {
        addError('name_host');
    }
    return !empty($_SESSION['errorsList']);
}

function checkNameCategory(array $nameInfo): bool
{
    if (!isset($nameInfo['name']) || strlen($nameInfo['name']) === 0) {
        addError('name_category');
    }
    return !empty($_SESSION['errorsList']);
}

function checkNameSubCategory(array $nameInfo): bool
{
    if (!isset($nameInfo['name']) || strlen($nameInfo['name']) === 0) {
        addError('name_subCategory');
    }
    return !empty($_SESSION['errorsList']);
}


/**
 * Get all sub categories
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllSubCategorie($dbCo)
{
    $query = $dbCo->query('SELECT * FROM sub_category');
    $query->execute();
    while ($subCategory = $query->fetch()) {

        echo '
            <option value="' . $subCategory["id_sub_category"] . '">' . $subCategory["name_subcat"] . '</option>
        ';
    }
}

/**
 * Get all categories
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllCategories($dbCo)
{
    $query = $dbCo->query('SELECT * FROM category');
    $query->execute();
    while ($category = $query->fetch()) {

        echo '
            <option value="' . $category["id_category"] . '">' . $category["name_category"] . '</option>
        ';
    }
}


/**
 * Get all hosts
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllHosts($dbCo)
{
    $query = $dbCo->query('SELECT * FROM host');
    $query->execute();
    while ($host = $query->fetch()) {
        echo '
            <option value="' . $host["id_host"] . '">' . $host["name_host"] . '</option>
        ';
    }
}

/**
 * Check valid infos for formation
 *
 * @param array $infos
 * @return boolean
 */
function checkInfosFormation(array $infos): bool
{

    if (!isset($infos['name_host']) || !ctype_digit($infos['name_host'])) {
        addError('host');
    }

    if (!isset($infos['category']) || !ctype_digit($infos['category'])) {
        addError('category');
    }

    if (!isset($infos['subCategory']) || !ctype_digit($infos['subCategory'])) {
        addError('sub_category');
    }

    if (!isset($infos['date1']) || strtotime($infos['date1']) === false) {
        addError('date');
    }

    if (strlen($infos['price']) === 0) {
        addError('price');
    }

    if (strlen($infos['participants']) === 0) {
        addError('nb_participants');
    }

    if (!isset($infos['status'])) {
        addError('status_missing');
    }

    return empty($_SESSION['errorsList']);
}

function checkInfosMail(array $infos): bool
{
    if (!isset($infos['lastname']) || strlen($infos['lastname']) === 0) {
        addError('lastname_null');
    }

    if (strlen($infos['lastname']) > 50) {
        addError('lastname_size');
    }

    if (!isset($infos['firstname']) || strlen($infos['firstname']) === 0) {
        addError('firstname_null');
    }

    if (strlen($infos['firstname']) > 50) {
        addError('firstname_size');
    }

    if (!isset($infos['email']) || strlen($infos['email']) === 0) {
        addError('email_null');
    }

    return empty($_SESSION['errorsList']);
}

/**
 * Get all formations from category afterboss and sub category after work
 *
 * @param [type] $dbCo
 * @return void
 */
function getFormAbAw($dbCo, $errors)
{

    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 1 AND id_sub_category = 1  AND date1_ > "1970-01-01" AND id_status = 2 ORDER BY date1_');
    $query->execute();

    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);
        echo '
            <card id="formation-' . $formation["id_formation"] . '" class="card_formation">
            <div class="card_intro">
                <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p class="content_intro-txt">
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : <span class="animator_name">' . $formation["name_host"] . '</span></p>
            </div>
           <div class="content_next_session">
                    <div class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'infos_next_session--var') . '">
                        <ul class="infos_next_session--lst-purple">
                            <l1>Le ' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
            </div>
            <div class= "' . ($formation["nb_participants"] === 0 ? 'hidden' : "card_participants") . '">
                <p>Nombre maximum de participants</p>
                <p>' . $formation["nb_participants"] . '</p>

            </div>
            <div class=' . ($formation["price"] === 0 ? 'hidden' : "card_price") . '>
                <p>Tarif : ' . $formation["price"] . '€ / session / personne</p>
            </div>
            <div class=' . (($formation["reduce_price"] === 0 || $formation["reduce_price"] === null) ? 'hidden' : "card_price") . '>
                <p>Tarif : ' . $formation["reduce_price"] . '€ / session / personne si partenaire</p>
            </div>
            <div class="card_content-btn">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-purple">Je m\'incris</button>
            </div>

        </card>
        <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select'], $formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
        ';
    }
}


/**
 * Get all formations from category afterboss and sub category les ateliers
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllFormAbLa($dbCo, $errors)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 1 AND id_sub_category = 3  AND date1_ > "1970-01-01" AND id_status = 2 ORDER BY date1_');
    $query->execute();

    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);
        echo '
            <card id="formation-' . $formation["id_formation"] . '" class="card_formation">
            <div class="card_intro">
                <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p>
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : <span class="animator_name">' . ($formation["name_host"] === 'non précisé' ? 'hidden' : $formation["name_host"]) . '</span></p>
                <p>
                    ' . $formation["specification"] . '
                </p>
            </div>
           <div class="content_next_session">
                    <div class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'infos_next_session--var') . '">
                        <ul class="infos_next_session--lst-purple">
                            <l1>Le ' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
            </div>
            <div class= "' . ($formation["nb_participants"] === 0 ? 'hidden' : "card_participants") . '">
                <p>Nombre maximum de participants</p>
                <p>' . $formation["nb_participants"] . '</p>

            </div>
            <div class=' . ($formation["price"] === 0 ? 'hidden' : "card_price") . '>
                <p>Tarif : ' . $formation["price"] . '€ / session / personne</p>
            </div>
            <div class=' . (($formation["reduce_price"] === 0 || $formation["reduce_price"] === null) ? 'hidden' : "card_price") . '>
                <p>Tarif : ' . $formation["reduce_price"] . '€ / session / personne si partenaire</p>
            </div>
            <div class="card_content-btn">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-purple">Je m\'incris</button>
            </div>
        </card>

        <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select'], $formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
        ';
    }
    unset($_SESSION['errorsList']);
}


/**
 * Get last formation from category afterboss
 *
 * @param [type] $dbCo
 * @return void
 */
function getLastFormAb($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN sub_category USING (id_sub_category) JOIN status USING (id_status) WHERE id_category = 1 AND id_status = 2 ORDER BY id_formation DESC LIMIT 1');
    $query->execute();
    $formation = $query->fetch();


    $formation["date1_"] = traductDate($formation["date1_"]);
    $formation["date2_"] = traductDate($formation["date2_"]);
    $formation["date3_"] = traductDate($formation["date3_"]);

    // <h2 class="card_title">' . $formation["name_subcat"] . '</h2>


    if ($formation["name_subcat"] === 'les ateliers') {
        $cardtitle = 'L\'ATELIERS À LA UNE';
    } else {
        $cardtitle = 'l\'AFTERWORK À LA UNE';
    }

    echo '
        <card class="card card--var-purple">
                <h2 class="card_title">' . $cardtitle . '</h2>
                <p class="card_txt">' . $formation["name"] . ' ' . $formation["subtitle"] . '
                </p>
                <p class="card_subtitle">PROCHAINE SESSION</p>
                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>Le ' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                    <button class="btn btn--var-white-purple">Je m\'inscris
                    </button>
                </div>
            </card>
    ';
}


/**
 * Get all formations from category e2d5j and sub category les ateliers
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllFormE2D5J($dbCo, $errors)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 2 AND id_sub_category = 4 AND id_status = 2 ORDER BY id_formation DESC');

    $query->execute();
    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);

        echo '
    <card id="formation-' . $formation["id_formation"] . '" class="card_formation--orange">
    <div class="card_intro">
        <h2 class="card_formation-ttl--orange"> ' . $formation["name"] . '
        </h2>
        <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p>
                    ' . $formation["description"] . '
                </p>
                <p class="txt_concour">
                    Nous proposons des formations gratuites grâce au concours et au partenariat que nous avons noué avec l\'ORIFF-PL (https://www.oriffplcn.fr). 
                </p>

                <img src="../assets/img/oriffpl.png" alt="">
                    
                <p class="' . ($formation["name_host"] === 'non précisé' ? 'hidden' : "animator") . '">Animé par : <span class="animator_name">' . $formation["name_host"] . '</span></p>
            </div>
           <div class="content_next_session">
                    <div class="infos_next_session--var-orange">
                        <ul class="infos_next_session--lst-orange">
                            <l1 class=' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? 'hidden' : '') . '>Du ' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? '' : $formation["date1_"]) . '</l1>
                            <l1 class=' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? 'hidden' : '') . '>au ' . ($formation["date2_"] === 'Jeudi 01 Janvier 1970' ? '' : $formation["date2_"]) . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
            </div>
            <div class= "' . ($formation["nb_participants"] === 0 ? 'hidden' : "card_participants--orange") . '">
                <p>Nombre maximum de participants</p>
                <p>' . $formation["nb_participants"] . '</p>
            </div>
            <div class=' . ($formation["price"] === 0 ? 'hidden' : "card_price--orange") . '>
                <p>Tarif : ' . $formation["price"] . '€ la session </p>
            </div>
            <div class=' . (($formation["reduce_price"] === 0 || $formation["reduce_price"] === null) ? 'hidden' : "card_price--orange") . '>
                <p>Tarif : ' . $formation["reduce_price"] . '€ / session / personne si partenaire</p>
            </div>
            <div class="card_content-btn">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-orange">Je m\'incris</button>
            </div>
        </card>

         <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select'], $formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
        ';
    }
    unset($_SESSION['errorsList']);
}

function getAllFormE2D3J($dbCo, $errors)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 2 AND id_sub_category = 5 AND id_status = 2 ORDER BY id_formation DESC LIMIT 3');

    $query->execute();
    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);

        echo '
    <card id="formation-' . $formation["id_formation"] . '" class="card_formation--orange">
    <div class="card_intro">
        <h2 class="card_formation-ttl--orange"> ' . $formation["name"] . '
        </h2>
        <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p>
                    ' . $formation["description"] . '
                </p>
                <p class="' . ($formation["name_host"] === 'non précisé' ? 'hidden' : "animator") . '">Animé par : <span class="animator_name">' . $formation["name_host"] . '</span></p>
            </div>
           <div class="content_next_session">
                    <div class="infos_next_session--var-orange">
                        <ul class="infos_next_session--lst-orange">
                            <l1 class=' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? 'hidden' : '') . '>Du ' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? '' : $formation["date1_"]) . '</l1>
                            <l1 class=' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? 'hidden' : '') . '>au ' . ($formation["date2_"] === 'Jeudi 01 Janvier 1970' ? '' : $formation["date2_"]) . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
            </div>
            <div class= "' . ($formation["nb_participants"] === 0 ? 'hidden' : "card_participants--orange") . '">
                <p>Nombre maximum de participants</p>
                <p>' . $formation["nb_participants"] . '</p>
            </div>
            <div class=' . ($formation["price"] === 0 ? 'hidden' : "card_price--orange") . '>
                <p>Tarif : ' . $formation["price"] . '€ la session </p>
            </div>
            <div class=' . (($formation["reduce_price"] === 0 || $formation["reduce_price"] === null) ? 'hidden' : "card_price--orange") . '>
                <p>Tarif : ' . $formation["reduce_price"] . '€ / session / personne si partenaire</p>
            </div>
            <div class="card_content-btn">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-orange">Je m\'incris</button>
            </div>
        </card>

        <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select'], $formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
        ';
    }
}

function getLastFormE2D($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN sub_category USING (id_sub_category) JOIN status USING (id_status) WHERE id_category = 2 AND id_status = 2 ORDER BY id_formation DESC LIMIT 1');
    $query->execute();
    $formation = $query->fetch();

    $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
    $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
    $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

    if ($formation["name_subcat"] === 'cursus 5 jours') {
        $cardtitle = 'LE CURSUS 5 JOURS À LA UNE';
    } else {
        $cardtitle = 'LE CURSUS 3 JOURS À LA UNE';
    }

    echo '
        <card class="card card--var-purple">
                <h2 class="card_title">' . $cardtitle . '</h2>
                <p class="card_txt">' . $formation["name"] . ' ' . $formation["subtitle"] . '
                </p>
                <p class="card_subtitle">PROCHAINE SESSION</p>
                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                    <button class="btn btn--var-white-orange">Je m\'inscris
                    </button>
                </div>
            </card>
    ';
}

function getAllFormLppF($dbCo, $errors)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 3 AND id_sub_category = 6 AND date1_ > "1970-01-01" AND id_status = 2 ORDER BY date1_');

    $query->execute();
    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);

        echo '
        <card id="formation-' . $formation["id_formation"] . '" class="card_formation--red">
            <div class="card_intro">
                <h2 class="card_formation-ttl--red">' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p class="content_intro-txt">
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : <span class="animator_name">' . $formation["name_host"] . '</span></p>
            </div>
           <div class="content_next_session">
                <div class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'infos_next_session--var--red') . '">
                        <ul class="infos_next_session--lst-red">
                            <l1>Le ' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                </div>                  
            </div>
            <div class= "' . ($formation["nb_participants"] === 0 ? 'hidden' : "card_participants--red") . '">
                <p>Nombre maximum de participants</p>
                <p>' . $formation["nb_participants"] . '</p>
            </div>
            <div class=' . ($formation["price"] === 0 ? 'hidden' : "card_price--red") . '>
                <p>Tarif : ' . $formation["price"] . '€ / session / personne</p>
            </div>
            <div class=' . (($formation["reduce_price"] === 0 || $formation["reduce_price"] === null) ? 'hidden' : "card_price--red content_price") . '>
                <p>Tarif : ' . $formation["reduce_price"] . '€ / session / personne si partenaire</p>
            </div>
            <div class="card_content-btn--red">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-red">Je m\'incris</button>
            </div>
        </card>
        </card>

        <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select']); var_dump($formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
    ';
    }
    unset($_SESSION['errorsList']);
}

function getLastFormLppF($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN sub_category USING (id_sub_category) JOIN status USING (id_status) WHERE id_category = 3 AND id_status = 2 ORDER BY id_formation DESC LIMIT 1');
    $query->execute();
    $formation = $query->fetch();

    $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
    $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
    $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

    if ($formation["name_subcat"] === 'conférences') {
        $cardtitle = 'LA CONFÉRENCE À LA UNE';
    }


    echo '
        <card id="formation-' . $formation["id_formation"] . '" class="card card--var-purple">
                <h2 class="card_title">' . $cardtitle . '</h2>
                <p class="card_txt">' . $formation["name"] . ' ' . $formation["subtitle"] . '
                </p>
                <p class="card_subtitle">PROCHAINE SESSION</p>
                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                    <button class="btn btn--var-white-red">Je m\'inscris
                    </button>
                </div>
            </card>
    ';
}

/**
 * Get all formations from category mouvement and sub category workflow
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllFormMouvement($dbCo, $errors)
{

    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 4 AND id_sub_category = 13 AND date1_ > "1970-01-01" AND id_status = 2 ORDER BY date1_');
    $query->execute();

    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);
        echo '
            <card id="formation-' . $formation["id_formation"] . '" class="card_formation--red-basic">
            <div class="card_intro">
                <h2 class="card_formation-ttl--red-basic"> ' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p class="content_intro-txt">
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : <span class="animator_name">' . $formation["name_host"] . '</span></p>
            </div>
            <div class="content_next_session">
           <div class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'infos_next_session--var--red-basic') . '">
                        <ul class="infos_next_session--lst-red-basic">
                            <l1>Le ' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>                  
            </div>
            <div class= "' . ($formation["nb_participants"] === 0 ? 'hidden' : "card_participants--red-basic") . '">
                <p>Nombre maximum de participants</p>
                <p>' . $formation["nb_participants"] . '</p>
            </div>
           <div class=' . ($formation["price"] === 0 ? 'hidden' : "card_price--red-basic content_price") . '>
                <p>Tarif : ' . $formation["price"] . '€ / session / personne</p>
            </div>
            <div class=' . (($formation["reduce_price"] === 0 || $formation["reduce_price"] === null) ? 'hidden' : "card_price--red-basic content_price") . '>
                <p>Tarif : ' . $formation["reduce_price"] . '€ / session / personne si partenaire</p>
            </div>
            
            <div class="card_content-btn">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-red-basic">Je m\'incris</button>
            </div>
            <!-- <div class="separator--formation"></div> -->
        </card>
        <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select'], $formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
        ';
    }
}

/**
 * Get all formations from category mouvement and sub category workflow
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllFormOutside($dbCo, $errors)
{

    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 5 AND id_sub_category = 13 AND date1_ > "1970-01-01" AND id_status = 2 ORDER BY date1_');
    $query->execute();

    while ($formation = $query->fetch()) {

        $formation["date1_"] = traductDate($formation["date1_"]);
        $formation["date2_"] = traductDate($formation["date2_"]);
        $formation["date3_"] = traductDate($formation["date3_"]);
        echo '
            <card id="formation-' . $formation["id_formation"] . '" class="card_formation--blue">
            <div class="card_intro">
                <h2 class="card_formation-ttl--blue"> ' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p class="content_intro-txt">
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : <span class="animator_name">' . $formation["name_host"] . '</span></p>
            </div>
           <div class="content_next_session">
                    <div class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'infos_next_session--var--blue') . '">
                        <ul class="infos_next_session--lst-blue">
                            <l1>Le ' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1 class=' . ($formation["localisation"] === '' ? 'hidden' : '') . '>à ' . $formation["localisation"] . '</l1>
                        </ul>
                </div>
            </div>
            <div class= "card_price--blue content_price">
                <p>Tarif: '.($formation["price"] === 0 ? 'Gratuit réservé aux étudiants' : ''.$formation["price"].' €').'</p>
            </div>
            <div class="card_content-btn">
                <button data-btn=' . $formation["id_formation"] . ' class="btn btn--inscription-blue">Je m\'incris</button>
            </div>
            <!-- <div class="separator--formation"></div> -->
        </card>
        <section data-form="' . $formation["id_formation"] . '" class="section_pop-up hidden">
            <div class="pop-up">
                <div class="pop-up_close-container">
                    <img data-close=' . $formation["id_formation"] . ' class="pop-up_close" src="../assets/img/close.png" alt="">
                </div>
                <div class="pop-up_content">
                    <form class="form" action="../../actions.php" method="post">
                        <div class="form_group">
                            <div class="form_group-input">
                                <label for="inputLastName" class="">Nom</label>
                                <input type="text" name="lastname" class="input" id="inputLastName" aria-describedby="">';
        // var_dump($_SESSION['id_form-select'], $formation["id_formation"]);

        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('lastname_null', $_SESSION['errorsList'])) {
                echo
                displayErrorMsg('lastname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('lastname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('lastname_size', $_SESSION['errorsList'], $errors);
            }
        }

        echo '</div>';

        echo '
                            <div class="form_group-input">
                                <label for="inputFirstName" class="">Prénom</label>
                                <input type="text" name="firstname" class="input" id="inputFirstName" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {

            if (isset($_SESSION['errorsList']) && in_array('firstname_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_null', $_SESSION['errorsList'], $errors);
            }

            if (isset($_SESSION['errorsList']) && in_array('firstname_size', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('firstname_size', $_SESSION['errorsList'], $errors);
            }
        }
        echo '</div>
                        </div>

                        <label for="inputEmail" class="">Email</label>
                        <input type="email" name="email" class="input" id="inputEmail" aria-describedby="">';
        if (isset($_SESSION['id_form-select']) && $_SESSION['id_form-select'] == $formation["id_formation"]) {
            if (isset($_SESSION['errorsList']) && in_array('email_null', $_SESSION['errorsList'])) {

                echo
                displayErrorMsg('email_null', $_SESSION['errorsList'], $errors);
            }
        }
        echo ' <label for="inputFormationName" class="">Sujet</label>
                        <input type="text" name="formationName" class="input" id="inputFormationName" aria-describedby="" value="' . $formation["name"] . '">

                        <div class="content_btn-form">
                            <input type="submit" value="Valider" class="btn btn--var-green">
                            <input id="token" type="hidden" name="token" value="' . $_SESSION['token'] . '">
                            <input type="hidden" name="action" value="post_form">
                            <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                            <input type="hidden" name="id_category" value="' . $formation["id_category"] . '">
                        </div>';
        echo '</form>
                </div>
            </div>
        </section>
        ';
    }
}

////////////////////////////////////ADMIN////////////////////////////


function getAllForm($dbCo)
{

    $query = $dbCo->query('SELECT id_formation,name ,name_host, subtitle, description, specification, date1_, date2_, date3_, time, localisation, id_sub_category, id_category, price, reduce_price, nb_participants, id_status FROM formation JOIN host USING (id_host) JOIN status USING (id_status) GROUP BY id_formation, id_sub_category
    ORDER BY id_sub_category');
    $query->execute();

    while ($formation = $query->fetch()) {

        $dataFormation[] = $formation;

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

        if ($formation["id_category"] === 1) {
            $color = 'purple';
        } else if ($formation["id_category"] === 2) {
            $color = 'orange';
        } else if ($formation["id_category"] === 3) {
            $color = 'red';
        } else if ($formation["id_category"] === 4) {
            $color = 'red-basic';
        } else if ($formation["id_category"] === 5) {
            $color = 'blue';
        }
        echo '
                <card class="card_formation--admin">
    
                <div class="card_intro">
                    <h2 class="card_formation-ttl-admin--' . $color . '"> ' . $formation["name"] . '
                    </h2>
                    <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
                </div>
                <div class="card_intro-txt">
                    <p>
                        ' . $formation["description"] . '
                    </p>
                    <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
                    <p>
                        ' . $formation["specification"] . '
                    </p>
                </div>
                <div class="card_infos-location">
                    <p>Où ?: </p>
                    <p class="tag-' . $color . '">' . $formation["localisation"] . '</p>
                </div>
                <div class="card_infos-dates">
                    <p>Prochaines sessions: </p>
                    <ul class="dates_lst">
                        <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag-' . $color . '') . '"> ' . $formation["date1_"] . '</li>
                        <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag-' . $color . '') . '"> ' . $formation["date2_"] . '</li>
                        <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag-' . $color . '') . '"> ' . $formation["date3_"] . '</li>
                    </ul>
                </div>
                 <div class="card_infos-time">
                    <p>Horaires: </p>
                    <p class="tag-' . $color . '">' . $formation["time"] . '</p>
                </div>
                <div class="card_infos-time">
                    <p>Nombre maximum de participants: </p>
                    <p class="tag-' . $color . '">' . $formation["nb_participants"] . '</p>
                </div>
                <div class="card_infos-time">
                    <p>Prix: </p>
                    <p class="tag-' . $color . '">' . $formation["price"] . '€</p>
                </div>
                <div class="card_infos-time">
                    <p>Prix avec réduction: </p>
                    <p class="tag-' . $color . '">' . $formation["reduce_price"] . '€</p>
                </div>


                <div class="card_infos-time">
                    <p>Statut: </p>
                    <p class="tag-' . $color . '">' . ($formation["id_status"] === 1 ? 'formation cachée' : 'formation visible') . '</p>
                </div>



                <div class="card_content-btn">
                <a href="_admin-edit.php?id=' . $formation["id_formation"] . '"><button class="btn btn--inscription-' . $color . '" type="input" name="action" value="edit-formation">modifier
                </button></a>
                <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                <input type="hidden" name="token" value="' .  $_SESSION['token']  . '">
                    </input>
                <form class="form_recap-form" action="actions.php" method="post">

                    <button class="btn btn--inscription-' . $color . '" type="input" name="action" value="delete-formation">supprimer</button>
                    <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                    </input>
                    <input type="hidden" name="token" value="' .  $_SESSION['token']  . '">
                    </input>
                </form>
                </div>
                <!-- <div class="separator--formation"></div> -->
            </card>
            ';
    }
    unset($_SESSION['msg']);
    unset($_SESSION['errorsList']);
}


function editFormation($dbCo, $id, $errors)
{
    
    $query = $dbCo->prepare('SELECT * FROM formation JOIN sub_category USING (id_sub_category) JOIN category USING (id_category) JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_formation = :id ');

    $isQueryOk = $query->execute([
        'id' => htmlspecialchars($id),
    ]);

    if ($isQueryOk) {
        $formation = $query->fetch();

        echo '
            <form id="" class="form_formation" action="../actions.php" method="post">


                    <label for="inputName" class="">Nom formation</label>
                    <input type="text" name="name" class="input" value="' . $formation["name"] . '" id="inputName" aria-describedby="">

                    <label for="inputSubtitle" class="">Sous-titre</label>
                    <input type="text" name="subtitle" class="input" value="' . $formation["subtitle"] . '"id="inputSubtitle" aria-describedby="">


                    <label for="inputDescription" class="">Description</label>
                    <textarea type="textearea" name="description" class="input-txt" " id="inputDescription" aria-describedby="" rows="5" cols="33">' . $formation["description"] . '</textarea>


                    <label for="inputSpecification" class="">Précision</label>
                    <textarea type="textearea" name="specification" class="input-txt" id="inputSpecification" aria-describedby="" rows="5" cols="33">' . $formation["specification"] . '</textarea>


                    <label class="edit_label" for="intervenant-select">Ancien intervenant : ' . $formation["name_host"] . '</label>

                    <select class="input" name="name_host" id="">
                        <option value="">Choisir un intervenant</option>';
        echo '' . getAllHosts($dbCo) . '';
        echo '</select>';


        if (isset($_SESSION['errorsList']) && in_array('edit-host_ko', $_SESSION['errorsList'])) {

            echo
            displayErrorMsg('edit-host_ko', $_SESSION['errorsList'], $errors);
        }

        echo '
                    <label class="edit_label" for="category-select">Ancienne catégorie : ' . $formation["name_category"] . '</label>

                    <select class="input" name="category" id="">
                        <option value="">Nom de la catégorie</option>';
        echo '' . getAllCategories($dbCo) . '';
        echo '</select>';


        if (isset($_SESSION['errorsList']) && in_array('edit-category_ko', $_SESSION['errorsList'])) {

            echo
            displayErrorMsg('edit-category_ko', $_SESSION['errorsList'], $errors);
        }

        echo '
                    <label class="edit_label" for="">Ancienne sous-catégorie : ' . $formation["name_subcat"] . '</label>

                    <select class="input" name="subCategory" id="">
                        <option value="">Choisir une sous-catégorie</option>';
        echo '' . getAllSubCategorie($dbCo) . '';
        echo '</select>';


        if (isset($_SESSION['errorsList']) && in_array('edit-subCategory_ko', $_SESSION['errorsList'])) {

            echo
            displayErrorMsg('edit-subCategory_ko', $_SESSION['errorsList'], $errors);
        }

        echo '
                    <label for="inputLocalisation" class="">Localisation</label>
                    <input type="text" name="localisation" class="input" value="' . $formation["localisation"] . '" id="inputLocalisation" aria-describedby="">


                    <label for="inputParticipant" class="">Nombre maximum de participant</label>
                    <input type="text" name="participants" class="input"
                    value="' . $formation["nb_participants"] . '" id="inputParticipant" aria-describedby="">';

        if (isset($_SESSION['errorsList']) && in_array('edit-participants_ko', $_SESSION['errorsList'])) {
            echo
            displayErrorMsg('edit-participants_ko', $_SESSION['errorsList'], $errors);
        }


        echo '
                    <label for="inputDate" class="edit_label">Ancienne date : ' . ((date('d/m/Y', strtotime($formation["date1_"])) === '01/01/1970') ? 'aucune date' : date('d/m/Y', strtotime($formation["date1_"]))) . '</label>
                    <input type="date" name="date1" class="input" id="inputDate" aria-describedby="">

                    <label for="inputDate2" class="edit_label">Ancienne date : ' . ((date('d/m/Y', strtotime($formation["date2_"])) === '01/01/1970') ? 'aucune date' : date('d/m/Y', strtotime($formation["date2_"]))) . '</label>
                    <input type="date" name="date2" class="input" id="inputDate2" aria-describedby="">

                    <label for="inputDate3" class="edit_label">Ancienne date : ' . ((date('d/m/Y', strtotime($formation["date3_"])) === '01/01/1970') ? 'aucune date' : date('d/m/Y', strtotime($formation["date3_"]))) . '</label>
                    <input type="date" name="date3" class="input" id="inputDate3" aria-describedby="">

                    <label for="inputTime" class="">Durée</label>
                    <input type="text" name="time" class="input" value="' . $formation["time"] . '" id="inputTime" aria-describedby="">

                    <label for="inputPrice" class="">Prix (si pas précisé, mettre 0)</label>
                    <input type="text" name="price" class="input"
                    value="' . $formation["price"] . '" id="inputPrice" aria-describedby="">

                    <label for="inputReducePrice" class="">Prix avec réduction</label>
                    <input type="text" name="reducePrice" class="input" id="inputReducePrice" aria-describedby="">

                    <label class="edit_label" for="">ancien statut: '. ($formation["id_status"] == 1 ? 'cachée' : 'visible') .'</label>

                    <select class="input" name="status" id="">
                        <option value="">État de la formation</option>
                        <option value=1>cachée</option>
                        <option value=2>visible</option>
                    </select>';

                    if (isset($_SESSION['errorsList']) && in_array('edit-status_ko', $_SESSION['errorsList'])) {

                        echo
                        displayErrorMsg('edit-status_ko', $_SESSION['errorsList'], $errors);
                    }

                    echo '

                    <div class="content_btn">
                        <input type="submit" value="Valider" class="btn btn--var-green">
                        <input id="token" type="hidden" name="token" value="' .  $_SESSION['token']  . '">
                        <input type="hidden" name="action" value="update-formation">
                        <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                    </div>
                </form>';
        unset($_SESSION['errorsList']);
    } else {
        addError('edit-formation_ko');
        redirectTo('_admin.php');
    }
}


/**
 * Check data for update
 *
 * @param array $updateData
 * @return boolean
 */
function checkUpdateFormation(array $infos): bool
{
    if ((!strlen($infos['name_host']) === 0) || !ctype_digit($infos['name_host'])) {
        addError('edit-host_ko');
    }

    if ((!strlen($infos['category']) === 0) || !ctype_digit($infos['category'])) {
        addError('edit-category_ko');
    }

    if ((!strlen($infos['subCategory']) === 0) || !ctype_digit($infos['subCategory'])) {
        addError('edit-subCategory_ko');
    }

    if ((!strlen($infos['status']) === 0) || !ctype_digit($infos['status'])) {
        addError('edit-status_ko');
    }

    return (empty($_SESSION['errorsList']));
}

/**
 * Check for connexion data format
 *
 * @param array $connexionData An array containing account data
 * @return boolean Is there errors in account data ?
 */
function checkConnexionInfo(array $connexionData): bool
{

    if (!isset($connexionData['adminName']) || strlen($connexionData['adminName']) === 0) {
        addError('connexion_nameAdmin');
    }

    if (strlen($connexionData['adminName']) > 10) {
        addError('connexion_nameAdmin_size');
    }

    if (empty($connexionData['password'])) {
        addError('connexion_password');
    }

    if (strlen($connexionData['password']) > 50) {
        addError('connexion_password_size');
    }

    return empty($_SESSION['errorsList']);
}

/**
 * connected to account
 *
 * @param PDO $dbCo
 * @return void
 */
function connectedMyAccount(PDO $dbCo)
{
    try {
        $query = $dbCo->prepare("SELECT admin_name, id_admin, password FROM admin WHERE admin_name = :admin_name");

        $query->execute([
            'admin_name' => htmlspecialchars($_REQUEST['adminName']),

        ]);

        while ($admin = $query->fetch()) {

            if (password_verify($_REQUEST['password'], $admin['password'])) {
                $_SESSION["id_admin"] = $admin["id_admin"];
                $_SESSION["admin_name"] = $admin["admin_name"];
                redirectTo('_admin.php');
            } else {
                addError('error_password');
                redirectTo('_connexion.php');
            }
        }
    } catch (Exception $e) {
        addError('error_connexion');
    }
}

/**
 * Check for account data format
 *
 * @param array $accountData An array containing account data
 * @return boolean Is there errors in account data ?
 */
function checkAdminInfo(array $adminData): bool
{
    if (!isset($adminData['nameAdmin']) || strlen($adminData['nameAdmin']) === 0) {
        addError('create_nameAdmin');
    }

    if (strlen($adminData['nameAdmin']) > 50) {
        addError('nameAdmin_size');
    }

    if (!isset($adminData['password']) || strlen($adminData['password']) === 0) {
        addError('password');
    }


    return (!empty($_SESSION['errorsList']));
}

function formationIsComing(PDO $dbCo)
{
    $query = $dbCo->query('SELECT *, name_subcat, name_category FROM `formation` JOIN category USING (id_category) JOIN sub_category USING (id_sub_category) JOIN host USING (id_host) WHERE date1_ > "1970-01-01" ORDER BY date1_ LIMIT 4');
    $query->execute();

    while ($formation = $query->fetch()) {

        if ($formation['id_category'] === 1) {
            $color = 'purple';
            $link = '_afterboss';
        } elseif ($formation['id_category'] === 2) {
            $color = 'orange';
            $link = '_entrepreneur2demain';
        } elseif ($formation['id_category'] === 3) {
            $color = 'red';
            $link = '_lespepes';
        } elseif ($formation['id_category'] === 4) {
            $color = 'red-basic';
            $link = '_mouvement-outside';
        } elseif ($formation['id_category'] === 5) {
            $color = 'blue';
            $link = '_mouvement-outside';
        }
    

        $formation["date1_"] = traductDate($formation["date1_"]);
        echo '
            <card class="card_formation--agenda ' . $color . '">
            <div class="card_infos-dates">
                <p class="date1">' . $formation["date1_"] . '</p>
            </div>

                <h2 class="card_formation-ttl-admin--' . $color . '"> ' . $formation["name"] . '
                </h2>

                <p>' . $formation["name_category"] . ' </p>

            <div class="card_intro-txt">
                <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
            </div>

            <div class="card_lk">
                <p class="card_sub-cat--' . $color . '"> ' . $formation["name_subcat"] . ' </p>
                <a class="card_lk--' . $color . '" href="/pages/' . $link . '.php#formation-' . $formation['id_formation'] . '">En savoir plus ></a>
            </div>
            
            </card>';
    }
}


/**
 * Display the next formation for category afterboss
 *
 * @param PDO $dbCo
 * @return void
 */
function getFormAwByDate(PDO $dbCo)
{

    $query = $dbCo->query('SELECT *, name_subcat, name_category FROM `formation` JOIN category USING (id_category) JOIN sub_category USING (id_sub_category) JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 1 AND id_status = 2 ORDER BY date1_ LIMIT 1');

    $query->execute();

    $formation = $query->fetch();
    
    $formation["date1_"] = traductDate($formation["date1_"]);

    echo '
        <card class="card card--var-purple">
                <h2 class="name_subCategory">' . $formation["name_subcat"] . '</h2>
                <p class="card_name">' . $formation["name"] . '</p>
                <p class="card_subtitle">' . $formation["subtitle"] . '</p>

                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                </div>
                <a class="btn btn--var-white-purple" href="/pages/_afterboss.php#formation-' . $formation['id_formation'] . '">en savoir plus >
                </a>
            </card>
    ';
}


/**
 * Display the next formation for category entrepreneur2demain
 *
 * @param PDO $dbCo
 * @return void
 */
function getCursusByDate(PDO $dbCo)
{

    $query = $dbCo->query('SELECT *, name_subcat, name_category FROM `formation` JOIN category USING (id_category) JOIN sub_category USING (id_sub_category) JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 2 AND date1_ > "1970-01-01" AND id_status = 2 ORDER BY date1_ LIMIT 1');

    $query->execute();

    $formation = $query->fetch();

    $formation["date1_"] = traductDate($formation["date1_"]);
    $formation["date2_"] = traductDate($formation["date2_"]);


    echo '
        <card class="card card--var-purple">
                <h2 class="name_subCategory">' . $formation["name_subcat"] . '</h2>
                
                <p class="card_subtitle">' . $formation["subtitle"] . '</p>

                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>Du ' . ($formation["date1_"] === 'Jeudi 01 Janvier 1970' ? '' : $formation["date1_"]) . ' </l1>
                            <l1>au ' . ($formation["date2_"] === 'Jeudi 01 Janvier 1970' ? '' : $formation["date2_"]) . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                </div>
                <a class="btn btn--var-white-orange" href="/pages/_entrepreneur2demain.php#formation-' . $formation['id_formation'] . '">en savoir plus >
                </a>
            </card>
    ';
}

/**
 * Get the next formation of category Les pepes flingueurs by date
 *
 * @param PDO $dbCo
 * @return void
 */
function getFormLesPepesByDate(PDO $dbCo)
{

    $query = $dbCo->query('SELECT *, name_subcat, name_category FROM `formation` JOIN category USING (id_category) JOIN sub_category USING (id_sub_category) JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 3 AND id_status = 2 ORDER BY date1_ LIMIT 1');

    $query->execute();

    $formation = $query->fetch();

    $formation["date1_"] = traductDate($formation["date1_"]);

    echo '
        <card class="card card--var-purple">
                <h2 class="name_subCategory">' . $formation["name_subcat"] . '</h2>
                <p class="card_name">' . $formation["name"] . '</p>
                <p class="card_subtitle">' . $formation["subtitle"] . '</p>

                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                </div>
                <a class="btn btn--var-white-red" href="/pages/_lespepes.php#formation-' . $formation['id_formation'] . '">en savoir plus >
                </a>
            </card>
    ';
}

/**
 * Get the next formation of category Mouvement by date
 *
 * @param PDO $dbCo
 * @return void
 */
function getFormMouvementByDate(PDO $dbCo)
{

    $query = $dbCo->query('SELECT *, name_subcat, name_category FROM `formation` JOIN category USING (id_category) JOIN sub_category USING (id_sub_category) JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 4 AND id_status = 2 ORDER BY date1_ LIMIT 1');

    $query->execute();

    $formation = $query->fetch();

    $formation["date1_"] = traductDate($formation["date1_"]);

    echo '
        <card class="card card--var-purple">
                <h2 class="name_subCategory">' . $formation["name_subcat"] . '</h2>
                <p class="card_name">' . $formation["name"] . '</p>
                <p class="card_subtitle">' . $formation["subtitle"] . '</p>

                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                </div>
                <a class="btn btn--var-white-red-basic" href="/pages/_mouvement-outside.php#formation-' . $formation['id_formation'] . '">en savoir plus >
                </a>
            </card>
    ';
}

/**
 * Get the next formation of category Mouvement by date
 *
 * @param PDO $dbCo
 * @return void
 */
function getFormOutsideByDate(PDO $dbCo)
{

    $query = $dbCo->query('SELECT *, name_subcat, name_category FROM `formation` JOIN category USING (id_category) JOIN sub_category USING (id_sub_category) JOIN host USING (id_host) JOIN status USING (id_status) WHERE id_category = 5 AND id_status = 2 ORDER BY date1_ LIMIT 1');

    $query->execute();

    $formation = $query->fetch();

    $formation["date1_"] = traductDate($formation["date1_"]);

    echo '
        <card class="card card--var-purple">
                <h2 class="name_subCategory">' . $formation["name_subcat"] . '</h2>
                <p class="card_name">' . $formation["name"] . '</p>
                <p class="card_subtitle">' . $formation["subtitle"] . '</p>

                <div class="content_next_session">
                    <div class="infos_next_session">
                        <ul class="infos_next_session--lst">
                            <l1>' . $formation["date1_"] . '</l1>
                            <l1>' . $formation["time"] . '</l1>
                            <l1>' . $formation["localisation"] . '</l1>
                        </ul>
                    </div>
                </div>
                <a class="btn btn--var-white-blue" href="/pages/_mouvement-outside.php#formation-' . $formation['id_formation'] . '">en savoir plus >
                </a>
            </card>
    ';
}

/**
 * Check for add link video
 *
 * @param array $videoData An array containing video data
 * @return boolean Is there errors in video data ?
 */
function checkLinkVideo(array $videoData): bool
{
    if (!isset($videoData['link'])) {
        addError('create_video-ko');
    }

    return (!empty($_SESSION['errorsList']));
}

function getVideos(PDO $dbCo)
{

    $query = $dbCo->query('SELECT * FROM video ORDER BY id_video DESC limit 10');

    $query->execute();

    $allVideos = $query->fetchAll();
    foreach ($allVideos as $key => $video) {

        echo '
        <div class="content_ifram">
        <iframe class="slider-item" src="' . $video['link'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        ';
    }
}

function getAllVideos(PDO $dbCo)
{

    $query = $dbCo->query('SELECT * FROM video');

    $query->execute();

    $allVideos = $query->fetchAll();
    foreach ($allVideos as $key => $video) {

        echo '
        <div class="content_ifram">
        <iframe class="slider-item" width="560" height="400" src="' . $video['link'] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <div class="content_ifram-btn">
            <form action="actions.php" method="POST">
                <button class="btn btn--sup-vid-red" type="input" name="action" value="delete-video">supprimer la vidéo</button>
                <input type="hidden" name="id_video" value="' . $video['id_video'] . '">
                <input type="hidden" name="token" value="' . $_SESSION['token'] . '">
                </input>
            </form>
        </div>
        </div>
        ';
    }
}


/**
 * Get message to display of error
 *
 * @param [type] $message
 * @param [type] $arrayDataMessages
 * @return void
 */
function getError($error, $arrayDataErrors)
{

    echo '
        <div data-msg="" class="show-msg--admin">
            <div class="content_error">
            <div class="content_error-cross">
                <img class="cross-img" src="../assets/img/close.png" alt="">
        </div>

        ' . displaySuccesMsg($error, $_SESSION['msg'], $arrayDataErrors) . '

        </div>
    </div>';
}


/**
 * Get message to display of success
 *
 * @param [type] $message
 * @param [type] $arrayDataMessages
 * @return void
 */
function getMessage($message, $arrayDataMessages)
{

    echo '
        <div data-msg="" class="show-msg--admin">
            <div data-msg="" class="content_success">
            <div class="content_success-cross">
                <img class="cross-img" src="../assets/img/close.png" alt="">
            </div>

            ' . displaySuccesMsg($message, $_SESSION['msg'], $arrayDataMessages) . '

            </div>
        </div>';
}
