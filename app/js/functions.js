
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

/**
 * add class active and remove class hidden
 * @param {element} element link of nav with class "tabs"
 */
function addClassRemoveHidden(element, allCross) {
    element.classList.toggle("hidden");

    let selector = element.dataset.tab;

    let showTxt = document.querySelector(`#${selector}`);
    showTxt.classList.toggle("hidden");

    for (let cross of allCross) {
        if (cross.dataset.tab === selector) {
            cross.classList.toggle('icon-more--rotate');
        }else{
            cross.className = 'icon-more';
        }
    }
    hiddenArticle(showTxt);
    showBubble(selector);
}

function showBubble(selector) {
    const allBubbles = document.querySelectorAll('.itm_bublle');
    
    for (let bubble of allBubbles) {

        if (bubble.dataset.tab === selector) {
            bubble.classList.remove('hidden');
        }else{
            bubble.classList.add('hidden');
        }
    }
}


/**
 * Rotate cross icon
 * @param {*} element 
 */
function rotateIcon(element) {
    element.classList.toggle("icon-more--rotate");
}


/**
 * add class hidden
 * @param {element} showArticle article with the class hidden = false
 */
function hiddenArticle(showTxt) {

    const txtTab = document.querySelectorAll("[data-tab-content]");
    const allCross = document.querySelectorAll(".icon-more");

    for (let hidden of txtTab) {
        if (!(showTxt.classList === hidden.classList)) {
            hidden.classList = "display hidden";
        }
    } 
}

export default {
    openCloseMenu,
    addClassRemoveHidden,
    rotateIcon,
    hiddenArticle
}