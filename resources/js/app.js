require('./bootstrap');

const navbarToggler = document.querySelector('.navbar-toggler');

// Change navbar toggler icon when clicked.
if (navbarToggler) {
    navbarToggler.addEventListener('click', () => {
        if (navbarToggler.classList.contains('collapsed')) {
            navbarToggler.innerHTML = '<i class="fa-solid fa-bars"></i>';
        } else {
            navbarToggler.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        }
    });
}

// Disable the file input button when clicked.
document.addEventListener('trix-file-accept', function (e) {
    e.preventDefault();
})

// disable the heading1 in the trix editor
document.addEventListener('trix-change', function (e) {
    if (e.target.tagName === 'H1') {
        e.preventDefault();
    }
})


// Check that service workers are supported
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js');
    });
}
