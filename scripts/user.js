// Fixed navbar
const headerElement = document.querySelector('header');

function fixedNavbar() {
    headerElement.classList.toggle('scrolled', window.pageYOffset > 0);
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

// Toggle menu
let menu = document.querySelector('#menu-btn');
let nav = document.querySelector('.navbar');
menu.addEventListener('click', function() {
    nav.classList.toggle('active');
});

// Toggle user box
let userBtn = document.querySelector('#user-btn');
let userBox = document.querySelector('.user-box');
userBtn.addEventListener('click', function() {
    userBox.classList.toggle('active');
});

// Close update container
let closeBtn = document.querySelector('#close-form');
closeBtn.addEventListener('click', () => {
    document.querySelector('.update-container').style.display = 'none';
});

// Slider
document.addEventListener("DOMContentLoaded", function() {
    let heroSlider = document.querySelector('.hero-slider');
    let testimonialSlider = document.querySelector('.testimonial-slider');

    if (heroSlider) {
        new Glide(heroSlider, {
            type: 'carousel',
            autoplay: 5000,
            animationDuration: 500,
            perView: 1,
            animationTimingFunc: 'linear',
            gap: 0,
            hoverpause: false,
            breakpoints: {
                1024: {
                    perView: 1
                },
                768: {
                    perView: 1
                },
                480: {
                    perView: 1
                }
            }
        }).mount();
    }

    if (testimonialSlider) {
        new Glide(testimonialSlider, {
            type: 'carousel',
            autoplay: 5000,
            animationDuration: 500,
            perView: 1,
            animationTimingFunc: 'linear',
            gap: 0,
            hoverpause: false,
            breakpoints: {
                1024: {
                    perView: 1
                },
                768: {
                    perView: 1
                },
                480: {
                    perView: 1
                }
            }
        }).mount();
    }
});
