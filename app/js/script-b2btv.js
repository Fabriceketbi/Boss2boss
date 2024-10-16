import Tools from "./functions.js";


const burgerButton = document.querySelector(".nav_menu_berger");
const burgerMenu = document.querySelector(".nav_menu_berger-open");
const forms = document.querySelectorAll("[data-form]");
const btnPopUp = document.querySelectorAll("[data-btn]");
const scrollContainer = document.querySelector('.slider-items');

Tools.openCloseMenu(burgerButton, burgerMenu);

// scrollContainer.addEventListener('wheel', function(e) {
//     e.preventDefault();
//     const scrollAmount = e.deltaY * 2;  // Multipliez pour un effet plus visible
//     scrollContainer.scrollLeft += scrollAmount; 
// });

// const slider = document.querySelector('.slider-items');
//         let isDown = false;
//         let startX;
//         let scrollLeft;

//         // Au clic, capture la position initiale de la souris et du scroll
//         slider.addEventListener('mousedown', (e) => {
//             isDown = true;
//             slider.classList.add('active');
//             startX = e.pageX - slider.offsetLeft;
//             scrollLeft = slider.scrollLeft;
//         });

        // Quand le clic est relâché ou la souris quitte le slider
        // slider.addEventListener('mouseleave', () => {
        //     isDown = false;
        // });

        // slider.addEventListener('mouseup', () => {
        //     isDown = false;
        // });

        // Suivre le déplacement de la souris pour ajuster le scroll
        // slider.addEventListener('mousemove', (e) => {
            // if(!isDown) return;  // Ne scrolle que si le clic est maintenu
            // e.preventDefault();  // Empêche les comportements par défaut
            // const x = e.pageX - slider.offsetLeft;
            // const walk = (x - startX) * 5; // Ajuster le facteur pour la vitesse
            // slider.scrollLeft = scrollLeft - walk; // Appliquer le scroll en fonction du déplacement
        // });


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
