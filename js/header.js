document.addEventListener('DOMContentLoaded', (e) => {
    window.onscroll = function(e) {
        let header = document.getElementById('header');
        if (window.scrollY > 60) {
            header.classList.add('transparent');
            header.style.padding = '10px';
        } else if (window.scrollY <= 40) {
            header.classList.remove('transparent');
            header.style.padding = '20px';
        }
    }
});