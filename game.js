$(document).ready(function() {

    // GAME

const dino = document.getElementById("dino");
const cactus = document.getElementById("cactus");

document.addEventListener("keydown", function(event) {
    jump();
});

function jump () {
    if (dino.classList != "jump") {
        dino.classList.add("jump");
    }
    setTimeout(function() {
        dino.classList.remove("jump");
    }, 600)
}
let isAlive = setInterval (function() {
    let dinoTop = parseInt(window.getComputedStyle(dino).getPropertyValue("top"))
    let cactusLeft = parseInt(window.getComputedStyle(cactus).getPropertyValue("left"))
    
    if (cactusLeft < 100 && cactusLeft > 0 && dinoTop >= 140) {
        alert("Неудачно");
        location.reload()
    }
}, 10)

    // MENU

    function removeActive () {
        $('.legion').removeClass('a212-active')
        $('.legion').removeClass('a501-active')
        $('.legion').removeClass('a41-active')
        $('.legion').removeClass('CT-active')
        $('.legion').removeClass('GVARD-active')
        $('.legion').removeClass('IPK-active')
        $('.legion').removeClass('MED-active')
        $('.legion').removeClass('TRENER-active')
        $('.legion').removeClass('ODISB-active')
    }

    $('.legion').click(function() {
        if($(this).hasClass("a41")) {
            removeActive();
            $(this).toggleClass('a41-active');
        }
        if($(this).hasClass("a212")) {
            removeActive();
            $(this).toggleClass('a212-active');
        }
        if($(this).hasClass("a501")) {
            removeActive();
            $(this).toggleClass('a501-active');
        }
        if($(this).hasClass("CT")) {
            removeActive();
            $(this).toggleClass('CT-active');
        }
        if($(this).hasClass("GVARD")) {
            removeActive();
            $(this).toggleClass('GVARD-active');
        }
        if($(this).hasClass("IPK")) {
            removeActive();
            $(this).toggleClass('IPK-active');
        }
        if($(this).hasClass("MED")) {
            removeActive();
            $(this).toggleClass('MED-active');
        }
        if($(this).hasClass("TRENER")) {
            removeActive();
            $(this).toggleClass('TRENER-active');
        }
        if($(this).hasClass("ODISB")) {
            removeActive();
            $(this).toggleClass('ODISB-active');
        }
    });
});
