import Tools from "./functions.js";


const burgerButton = document.querySelector(".nav_menu_berger");
const burgerMenu = document.querySelector(".nav_menu_berger-open");

Tools.openCloseMenu(burgerButton, burgerMenu);


const tabs = document.querySelectorAll('.itm_accordion');
const txtTab = document.querySelectorAll("[data-tab-content]");
const allCross = document.querySelectorAll(".icon-more");
const btnPopUp = document.querySelector("[data-make_rdv]");
const popUp = document.querySelector(".section_pop-up");
const closePopUp = document.querySelector(".pop-up_close");


btnPopUp.addEventListener("click", () => {
    popUp.classList.toggle("hidden");
});

closePopUp.addEventListener("click", () => {
    popUp.classList.toggle("hidden");
});

// Variables pour gérer l'animation
let intervalTxt;
let restartTimeout;
let autoShowTimeouts = []; // Pour stocker les timeouts des animations
let isUserInteracting = false;


for (let singleTab of tabs) {
    singleTab.addEventListener('click', function () {
        Tools.addClassRemoveHidden(singleTab, allCross);
        stopAutoShow(); // Arrête l'animation si l'utilisateur interagit
        scheduleRestart(); // Planifie la reprise de l'animation après un certain délai
    });
}


/**
 * Lorsque le document est totalement charge démarre l'animation
 */
document.addEventListener('DOMContentLoaded', () => {
    console.log("Animation started");
    startAutoShow(); // Démarrer l'animation automatiquement
});

/**
 * Démarrer l'animation
 */
function startAutoShow() {
    console.log("Starting new auto-show cycle");
    isUserInteracting = false; // Réinitialisation de l'interaction utilisateur
    stopAllTimeouts(); // Annule tous les timeouts actifs pour un cycle propre

    // Démarrer un cycle immédiatement
    runAutoShowCycle();
    
    // Créer un intervalle pour répéter le cycle toutes les 8 secondes
    intervalTxt = setInterval(() => {
        console.log("Running new cycle");
        runAutoShowCycle();
    }, 24000);
}


/**
 * Arreter l'animation
 */
function stopAutoShow() {
    console.log("Stopping auto-show");
    clearInterval(intervalTxt); // Annuler l'intervalle
    stopAllTimeouts(); // Annuler tous les timeouts en cours
}

/**
 * Planifie la reprise de l'animation à 10 secondes d'inactivité
 */
function scheduleRestart() {
    console.log("User interacted, scheduling restart...");
    clearTimeout(restartTimeout); // Annuler le délai de reprise s'il existe
    restartTimeout = setTimeout(() => {
        console.log("Restarting auto-show after inactivity");
        startAutoShow(); // Relancer l'animation après 10 secondes d'inactivité
    }, 10000); // Le délai est fixé à 10 secondes (ajustable)
}


/**
 * Annule tous les timeouts en cours
 */
function stopAllTimeouts() {
    autoShowTimeouts.forEach(timeout => clearTimeout(timeout)); // Annule tous les timeouts
    autoShowTimeouts = []; // Réinitialiser le tableau des timeouts
}

/**
 * Gestion automatique de l'affichage des onglets
 * @returns 
 */
function runAutoShowCycle() {
    if (isUserInteracting) {
        console.log("User is interacting, skipping auto-show cycle");
        return; // Ne pas lancer le cycle si l'utilisateur a interagi
    }

    console.log("Starting new auto-show cycle");

    // Affichage séquentiel des onglets avec des délais
    autoShowTimeouts.push(setTimeout(() => {
        Tools.addClassRemoveHidden(document.querySelector('.itm_accordion-purple'), allCross);
    }, 0)); // Affiche immédiatement le premier onglet

    autoShowTimeouts.push(setTimeout(() => {
        Tools.addClassRemoveHidden(document.querySelector('.itm_accordion-orange'), allCross);
    }, 4000)); // Affiche le deuxième onglet après 2 secondes

    autoShowTimeouts.push(setTimeout(() => {
        Tools.addClassRemoveHidden(document.querySelector('.itm_accordion-red'), allCross);
    }, 8000)); // Affiche le troisième onglet après 4 secondes

    autoShowTimeouts.push(setTimeout(() => {
        Tools.addClassRemoveHidden(document.querySelector('.itm_accordion-blue'), allCross);
    }, 12000)); // Affiche le quatrième onglet après 6 secondes

    autoShowTimeouts.push(setTimeout(() => {
        Tools.addClassRemoveHidden(document.querySelector('.itm_accordion-red-basic'), allCross);
    }, 16000)); // Affiche le quatrième onglet après 8 secondes

    autoShowTimeouts.push(setTimeout(() => {
        Tools.addClassRemoveHidden(document.querySelector('.itm_accordion-green'), allCross);
    }, 20000)); // Affiche le quatrième onglet après 10 secondes
}

// function scrollToAnchor(id) {
//     window.location.href = "/pages/_afterboss.php#" + id;
// }


