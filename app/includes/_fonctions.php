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
        // redirectTo($redirectUrl);
    }

    if (!isTokenOk()) {
        addError('csrf');
        // redirectTo($redirectUrl);
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
    $_SESSION['msg'] = $message;
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

function displayErrorMsg(string $error, array $arrayErrors, $arrayDataError)
{
    return '<p class="msg_error">' . $arrayDataError[getErrorValue($error, $arrayErrors)] . '</p>';
}


function checkName(array $nameInfo): bool
{
    if (!isset($nameInfo['name']) || strlen($nameInfo['name']) === 0) {
        addError('name');
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
    // if (!isset($infos['name']) || strlen($infos['name']) === 0) {
    //     addError('Le champ "nom" est requis.');
    // }

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

    return empty($_SESSION['errorsList']);
}

/**
 * Get all formations from category afterboss and sub category after work
 *
 * @param [type] $dbCo
 * @return void
 */
function getFormAbAw($dbCo)
{

    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) WHERE id_category = 1 AND id_sub_category = 1 ORDER BY id_formation DESC LIMIT 3');
    $query->execute();

    while ($formation = $query->fetch()) {

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));
        echo '
            <card class="card_formation">
            <div class="separator--formation"></div>
            <div class="card_intro">
                <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p>
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
            </div>
            <div class="card_infos-location">
                <p>Où ?: </p>
                <p class="tag">' . $formation["localisation"] . '</p>
            </div>
            <div class="card_infos-dates">
                <p>Prochaines sessions: </p>
                <ul class="dates_lst">
                    <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date1_"] . '</li>
                    <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date2_"] . '</li>
                    <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date3_"] . '</li>
                </ul>
            </div>
             <div class="card_infos-time">
                <p>Horaires: </p>
                <p class="tag">' . $formation["time"] . '</p>
            </div>
            <div class="card_content-btn">
                <button class="btn btn--inscription-purple">Je m\'incris</button>
            </div>
            <!-- <div class="separator--formation"></div> -->
        </card>
        ';
    }
}


/**
 * Get all formations from category afterboss and sub category les ateliers
 *
 * @param [type] $dbCo
 * @return void
 */
function getAllFormAbLa($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) WHERE id_category = 1 AND id_sub_category = 3 ORDER BY id_formation DESC LIMIT 3');
    $query->execute();

    while ($formation = $query->fetch()) {

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));
        echo '
            <card class="card_formation">
            <div class="separator--formation"></div>
            <div class="card_intro">
                <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
            </div>
            <div class="card_intro-txt">
                <p>
                    ' . $formation["description"] . '
                </p>
                <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
            </div>
            <div class="card_infos-location">
                <p>Où ?: </p>
                <p class="tag">' . $formation["localisation"] . '</p>
            </div>
            <div class="card_infos-dates">
                <p>Prochaines sessions: </p>
                <ul class="dates_lst">
                    <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date1_"] . '</li>
                    <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date2_"] . '</li>
                    <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date3_"] . '</li>
                </ul>
            </div>
             <div class="card_infos-time">
                <p>Horaires: </p>
                <p class="tag">' . $formation["time"] . '</p>
            </div>
            <div class="card_content-btn">
                <button class="btn btn--inscription-purple">Je m\'incris</button>
            </div>
            <!-- <div class="separator--formation"></div> -->
        </card>
        ';
    }
}


/**
 * Get last formation from category afterboss
 *
 * @param [type] $dbCo
 * @return void
 */
function getLastFormAb($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN sub_category USING (id_sub_category) WHERE id_category = 1 ORDER BY id_formation DESC LIMIT 1');
    $query->execute();
    $formation = $query->fetch();

    $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
    $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
    $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));


    echo '
        <card class="card card--var-purple">
                <h2 class="card_title">' . $formation["name_subcat"] . '</h2>
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
function getAllFormE2D5J($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) WHERE id_category = 2 AND id_sub_category = 4 ORDER BY id_formation DESC LIMIT 3');

    $query->execute();
    while ($formation = $query->fetch()) {

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

        echo '
    <card class="card_formation">
    <div class="separator--formation"></div>
    <div class="card_intro">
        <h2 class="card_formation-ttl"> ' . $formation["name"] . '
        </h2>
        <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
    </div>
    <div class="card_intro-txt">
        <p>
            ' . $formation["description"] . '
        </p>
        <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
    </div>
    <div class="card_infos-location">
        <p>Où ?: </p>
        <p class="tag--var-orange">' . $formation["localisation"] . '</p>
    </div>
    <div class="card_infos-dates">
        <p>Prochaines sessions: </p>
        <ul class="dates_lst">
            <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date1_"] . '</li>
            <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date2_"] . '</li>
            <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date3_"] . '</li>
        </ul>
    </div>
     <div class="card_infos-time">
        <p>Horaires: </p>
        <p class="tag--var-orange">' . $formation["time"] . '</p>
    </div>
    <div class="card_content-btn">
        <button class="btn btn--inscription-orange">Je m\'incris</button>
    </div>
    <!-- <div class="separator--formation"></div> -->
</card>
';
    }
}

function getAllFormE2D3J($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) WHERE id_category = 2 AND id_sub_category = 5 ORDER BY id_formation DESC LIMIT 3');

    $query->execute();
    while ($formation = $query->fetch()) {

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

        echo '
    <card class="card_formation">
    <div class="separator--formation"></div>
    <div class="card_intro">
        <h2 class="card_formation-ttl"> ' . $formation["name"] . '
        </h2>
        <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
    </div>
    <div class="card_intro-txt">
        <p>
            ' . $formation["description"] . '
        </p>
        <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
    </div>
    <div class="card_infos-location">
        <p>Où ?: </p>
        <p class="tag--var-orange">' . $formation["localisation"] . '</p>
    </div>
    <div class="card_infos-dates">
        <p>Prochaines sessions: </p>
        <ul class="dates_lst">
            <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date1_"] . '</li>
            <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date2_"] . '</li>
            <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date3_"] . '</li>
        </ul>
    </div>
     <div class="card_infos-time">
        <p>Horaires: </p>
        <p class="tag--var-orange">' . $formation["time"] . '</p>
    </div>
    <div class="card_content-btn">
        <button class="btn btn--inscription-orange">Je m\'incris</button>
    </div>
    <!-- <div class="separator--formation"></div> -->
</card>
';
    }
}

function getLastFormE2D($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN sub_category USING (id_sub_category) WHERE id_category = 2 ORDER BY id_formation DESC LIMIT 1');
    $query->execute();
    $formation = $query->fetch();

    $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
    $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
    $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));


    echo '
        <card class="card card--var-purple">
                <h2 class="card_title">' . $formation["name_subcat"] . '</h2>
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

function getAllFormLppF($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN host USING (id_host) WHERE id_category = 3 AND id_sub_category = 6 ORDER BY id_formation DESC LIMIT 3');

    $query->execute();
    while ($formation = $query->fetch()) {

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

        echo '
        <card class="card_formation">
            <div class="separator--formation"></div>
            <div class="card_intro">
                <h2 class="card_formation-ttl">' . $formation["name"] . '
                </h2>
                <p class="card_sub-txt"></p>
            </div>
            <div class="card_intro-txt">
                <p>
                ' . $formation["description"] . '
                </p>
                 
            </div>
            <div class="card_infos-location">
                <p>Où ?: </p>
                <p class="tag--var-red">' . $formation["localisation"] . '</p>
            </div>
            <div class="card_infos-dates">
                <p>Prochaines sessions: </p>
                <ul class="dates_lst">
                    <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag--var-red') . '">' . $formation["date1_"] . '</li>
                    <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag--var-red') . '">' . $formation["date2_"] . '</li>
                    <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag--var-red') . '">' . $formation["date3_"] . '</li>
                </ul>
            </div>
            <div class="card_infos-time">
                <p>Horaires: </p>
                <p class="tag--var-red">' . $formation["time"] . '</p>
            </div>
            <div class="card_content-btn">
                <button class="btn btn--inscription-red">Je m\'incris</button>
            </div>
            <!-- <div class="separator--formation"></div> -->
        </card>
    ';
    }
}

function getLastFormLppF($dbCo)
{
    $query = $dbCo->query('SELECT * FROM formation JOIN sub_category USING (id_sub_category) WHERE id_category = 3 ORDER BY id_formation DESC LIMIT 1');
    $query->execute();
    $formation = $query->fetch();

    $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
    $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
    $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

    echo '
        <card class="card card--var-purple">
                <h2 class="card_title">' . $formation["name_subcat"] . '</h2>
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

////////////////////////////////////ADMIN////////////////////////////


function getAllForm($dbCo)
{

    $query = $dbCo->query('SELECT id_formation,name ,name_host, subtitle, description, date1_, date2_, date3_, time, localisation, id_sub_category, id_category FROM formation JOIN host USING (id_host)GROUP BY id_formation, id_sub_category
    ORDER BY id_sub_category');
    $query->execute();

    while ($formation = $query->fetch()) {

        $dataFormation[] = $formation;

        $formation["date1_"] = date('d/m/Y', strtotime($formation["date1_"]));
        $formation["date2_"] = date('d/m/Y', strtotime($formation["date2_"]));
        $formation["date3_"] = date('d/m/Y', strtotime($formation["date3_"]));

        if ($formation["id_category"] === 1) {

            echo '
                <card class="card_formation--admin">
    
                <div class="card_intro">
                    <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                    </h2>
                    <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
                </div>
                <div class="card_intro-txt">
                    <p>
                        ' . $formation["description"] . '
                    </p>
                    <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
                </div>
                <div class="card_infos-location">
                    <p>Où ?: </p>
                    <p class="tag">' . $formation["localisation"] . '</p>
                </div>
                <div class="card_infos-dates">
                    <p>Prochaines sessions: </p>
                    <ul class="dates_lst">
                        <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date1_"] . '</li>
                        <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date2_"] . '</li>
                        <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag') . '"> ' . $formation["date3_"] . '</li>
                    </ul>
                </div>
                 <div class="card_infos-time">
                    <p>Horaires: </p>
                    <p class="tag">' . $formation["time"] . '</p>
                </div>
                <div class="card_content-btn">
                <a href="_admin-edit.php?id=' . $formation["id_formation"] . '"><button class="btn btn--inscription-purple" type="input" name="action" value="edit-formation">modifier
                </button></a>
                <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                <form class="form_recap-form" action="actions.php" method="post">

                    <button class="btn btn--inscription-purple" type="input" name="action" value="delete-formation">supprimer</button>
                    <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                    </input>
                </form>
                </div>
                <!-- <div class="separator--formation"></div> -->
            </card>
            ';
        }
        if ($formation["id_category"] === 2) {
            echo '
                <card class="card_formation--admin">
    
                <div class="card_intro">
                    <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                    </h2>
                    <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
                </div>
                <div class="card_intro-txt">
                    <p>
                        ' . $formation["description"] . '
                    </p>
                    <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
                </div>
                <div class="card_infos-location">
                    <p>Où ?: </p>
                    <p class="tag--var-orange">' . $formation["localisation"] . '</p>
                </div>
                <div class="card_infos-dates">
                    <p>Prochaines sessions: </p>
                    <ul class="dates_lst">
                        <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date1_"] . '</li>
                        <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date2_"] . '</li>
                        <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag--var-orange') . '"> ' . $formation["date3_"] . '</li>
                    </ul>
                </div>
                 <div class="card_infos-time">
                    <p>Horaires: </p>
                    <p class="tag--var-orange">' . $formation["time"] . '</p>
                </div>
                <div class="card_content-btn">
                <a href="_admin-edit.php?id=' . $formation["id_formation"] . '"><button class="btn btn--inscription-orange" type="input" name="action" value="edit-formation">modifier
                </button></a>
                <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                <form class="form_recap-form" action="actions.php" method="post">

                    <button class="btn btn--inscription-orange" type="input" name="action" value="delete-formation">supprimer</button>
                    <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                    </input>
                </form>
                </div>
            </card>
            ';
        }
        if ($formation["id_category"] === 3) {
            echo '
                <card class="card_formation--admin">
    
                <div class="card_intro">
                    <h2 class="card_formation-ttl"> ' . $formation["name"] . '
                    </h2>
                    <p class="card_sub-txt">' . $formation["subtitle"] . '</p>
                </div>
                <div class="card_intro-txt">
                    <p>
                        ' . $formation["description"] . '
                    </p>
                    <p class="animator">Animé par : ' . $formation["name_host"] . '</p>
                </div>
                <div class="card_infos-location">
                    <p>Où ?: </p>
                    <p class="tag--var-red">' . $formation["localisation"] . '</p>
                </div>
                <div class="card_infos-dates">
                    <p>Prochaines sessions: </p>
                    <ul class="dates_lst">
                        <li class="' . ($formation["date1_"] === '01/01/1970' ? 'hidden' : 'tag--var-red') . '"> ' . $formation["date1_"] . '</li>
                        <li class="' . ($formation["date2_"] === '01/01/1970' ? 'hidden' : 'tag--var-red') . '"> ' . $formation["date2_"] . '</li>
                        <li class="' . ($formation["date3_"] === '01/01/1970' ? 'hidden' : 'tag--var-red') . '"> ' . $formation["date3_"] . '</li>
                    </ul>
                </div>
                 <div class="card_infos-time">
                    <p>Horaires: </p>
                    <p class="tag--var-red">' . $formation["time"] . '</p>
                </div>
                <div class="card_content-btn">
                <a href="_admin-edit.php?id=' . $formation["id_formation"] . '"><button class="btn btn--inscription-red" type="input" name="action" value="edit-formation">modifier
                </button></a>
                <input type="hidden" name="id_formation" value="' . $formation["id_formation"] . '">
                <form class="form_recap-form" action="actions.php" method="post">

                    <button class="btn btn--inscription-red" type="input" name="action" value="delete-formation">supprimer</button>
                    <input type="hidden" name="id" value="' . $formation["id_formation"] . '">
                    </input>
                </form>
                </div>
            </card>
            ';
        }
    }
}

function editFormation($dbCo, $id, $errors)
{
    $query = $dbCo->prepare('SELECT * FROM formation JOIN sub_category USING (id_sub_category) JOIN category USING (id_category) JOIN host USING (id_host) WHERE id_formation = :id ');

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


                    <label class="edit_label" for="intervenant-select">Ancien intervenant : '. $formation["name_host"] .'</label>

                    <select class="input" name="name_host" id="">
                        <option value="">Choisir un intervenant</option>';
                    echo '' . getAllHosts($dbCo) . '';
                    echo '</select>';
                    

                    if (isset($_SESSION['errorsList']) && in_array('edit-host_ko', $_SESSION['errorsList'])) {

                    echo
                    displayErrorMsg('edit-host_ko', $_SESSION['errorsList'], $errors);

                    }

                    echo '
                    <label class="edit_label" for="category-select">Ancienne catégorie : '. $formation["name_category"].'</label>

                    <select class="input" name="category" id="">
                        <option value="">Nom de la catégorie</option>';
                    echo '' . getAllCategories($dbCo) . '';
                    echo '</select>';
                    

                    if (isset($_SESSION['errorsList']) && in_array('edit-category_ko', $_SESSION['errorsList'])) {

                    echo
                    displayErrorMsg('edit-category_ko', $_SESSION['errorsList'], $errors);

                    }

                    echo '
                    <label class="edit_label" for="">Ancienne sous-catégorie : '. $formation["name_subcat"].'</label>

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


                    <label for="inputDate" class="edit_label">Ancienne date : '. ((date('d/m/Y', strtotime($formation["date1_"])) === '01/01/1970') ? 'aucune date' : date('d/m/Y', strtotime($formation["date1_"]))) .'</label>
                    <input type="date" name="date1" class="input" id="inputDate" aria-describedby="">

                    <label for="inputDate2" class="edit_label">Ancienne date : '. ((date('d/m/Y', strtotime($formation["date2_"])) === '01/01/1970') ? 'aucune date' : date('d/m/Y', strtotime($formation["date2_"]))) .'</label>
                    <input type="date" name="date2" class="input" id="inputDate2" aria-describedby="">

                    <label for="inputDate3" class="edit_label">Ancienne date : '. ((date('d/m/Y', strtotime($formation["date3_"])) === '01/01/1970') ? 'aucune date' : date('d/m/Y', strtotime($formation["date3_"]))) .'</label>
                    <input type="date" name="date3" class="input" id="inputDate3" aria-describedby="">

                    <label for="inputTime" class="">Durée</label>
                    <input type="text" name="time" class="input" value="' . $formation["time"] . '" id="inputTime" aria-describedby="">


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
function checkUpdateFormation (array $infos): bool
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

    if (strlen($connexionData['password']) > 10) {
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


    return empty($_SESSION['errorsList']);
}
