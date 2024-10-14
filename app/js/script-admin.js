import Tools from "./functions.js";


const burgerButton = document.querySelector(".nav_menu_berger");
const burgerMenu = document.querySelector(".nav_menu_berger-open");
const forms = document.querySelectorAll("[data-form]");
const btnPopUp = document.querySelectorAll("[data-btn]");
const closePopUp = document.querySelectorAll(".pop-up_close");
const msgCross = document.querySelector(".cross-img");
const contentMsg = document.querySelector("[data-msg]");


if (msgCross) {
    
    msgCross.addEventListener("click", () => {
        contentMsg.classList.remove("show-msg--admin");
        contentMsg.classList.add("hidden");
    }
    );
}

closePopUp.forEach((cross) => {
    cross.addEventListener("click", () => {

        forms.forEach((form) => {
            
            if (form.getAttribute("data-form") === cross.getAttribute("data-close")) {
                form.classList.toggle("hidden");
            }
        })   
    })
});

btnPopUp.forEach((btn) => {
    btn.addEventListener("click", () => {

        forms.forEach((form) => {
            console.log(form);
            
            if (form.getAttribute("data-form") === btn.getAttribute("data-btn")) {
                form.classList.toggle("hidden");
            }
        })       
    })   
});




Tools.openCloseMenu(burgerButton, burgerMenu);

document.addEventListener("DOMContentLoaded", function() {
    console.log("Page chargée");

    // Vérifiez si une ancre est présente dans l'URL
    if (window.location.hash) {
        let anchor = window.location.hash;
        console.log("Ancre détectée :", anchor);

        // Créer une fonction qui scrolle vers l'ancre
        function scrollToAnchor() {
            const element = document.querySelector(anchor);
            if (element) {
                console.log("Élément trouvé :", element);
                element.scrollIntoView({ behavior: 'smooth' });
            } else {
                console.log("Élément non trouvé :", anchor);
            }
        }

        // Écouter les changements dans le DOM pour savoir quand le contenu dynamique est injecté
        const observer = new MutationObserver(function(mutationsList, observer) {
            for (let mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    console.log("Modification du DOM détectée");
                    // Vérifiez si l'élément avec l'ancre existe maintenant
                    const element = document.querySelector(anchor);
                    if (element) {
                        console.log("L'élément avec l'ancre a été ajouté au DOM :", element);
                        scrollToAnchor(); // Faites défiler vers l'ancre
                        observer.disconnect(); // Arrêtez l'observation une fois que l'ancre est trouvée
                    }
                }
            }
        });

        // Commencez à observer les changements dans le DOM
        observer.observe(document.body, { childList: true, subtree: true });
    }
});
