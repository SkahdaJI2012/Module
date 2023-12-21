document.addEventListener("DOMContentLoaded", function() {
    let container = document.querySelector('.popup-container')
    let popupButtons = document.querySelectorAll('.open-popup');
    for (let i = 0; i < popupButtons.length; i++) {
        popupButtons[i].addEventListener('click', function() {
            container.style.display = 'flex';
        })
    }
    container.addEventListener('click', function(event) {
        if (event.target == container) {
            container.style.display = 'none'
        }
    })
});