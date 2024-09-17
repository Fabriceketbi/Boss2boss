
/**
 * Change class of the menu page for to open
 * @param {element} element 
 * @param {*element} navElement 
 */
function openCloseMenu (burgerButton, burgerMenu) {
    burgerButton.addEventListener('click', function() {
        burgerMenu.classList.toggle('hidden');
    })
}

export default {
    openCloseMenu
}