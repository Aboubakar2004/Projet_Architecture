document.addEventListener('DOMContentLoaded', function () {
    const popupTriggers = document.querySelectorAll('.popup-trigger');
    const popup = document.getElementById('donate-popup');
    const closePopup = document.getElementById('close-popup');
    const blurBackground = document.createElement('div');
    blurBackground.classList.add('blur');

    popupTriggers.forEach(trigger => {
        trigger.addEventListener('click', function () {
            popup.classList.add('active');
            document.body.appendChild(blurBackground);
        });
    });

    closePopup.addEventListener('click', function () {
        popup.classList.remove('active');
        blurBackground.remove();
    });
});
