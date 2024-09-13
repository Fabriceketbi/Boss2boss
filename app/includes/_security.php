<?php 

include './includes/_database.php';


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
?>