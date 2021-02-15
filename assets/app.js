import './styles/app.css';


// onscroll function, resize the header
window.onscroll = function () {
    scrollFunction();
}

let header = document.querySelector('.header-top');
let logo = document.querySelector('.logo');
let searchBarContainer = document.querySelector('.search-bar');
let searchBar = document.querySelector('.search-input');

let categoriesMenu = document.querySelector('.categories-list');
let list = document.querySelector('.list-element');

function scrollFunction () {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        header.style.height = '5vh';
        categoriesMenu.style.top = '5vh';
        logo.style.fontSize = '20px';
        searchBarContainer.style.height = '20px';
        searchBar.style.height = '20px';
    } else {
        header.style.height = '10vh';
        categoriesMenu.style.top = '10vh';
        logo.style.fontSize = '1.5rem';
        searchBarContainer.style.height = '1.5rem';
        searchBar.style.height = '1.5rem';
    }
}