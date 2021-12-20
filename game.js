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
    function removeActiveBtn () {
        $('.menu-btn').removeClass('menu-btn-a41')
        $('.menu-btn').removeClass('menu-btn-a501')
        $('.menu-btn').removeClass('menu-btn-a212')
        $('.menu-btn').removeClass('menu-btn-CT')
        $('.menu-btn').removeClass('menu-btn-GVARD')
        $('.menu-btn').removeClass('menu-btn-MED')
        $('.menu-btn').removeClass('menu-btn-TRENER')
        $('.menu-btn').removeClass('menu-btn-ODISB')
        $('.menu-btn').removeClass('menu-btn-IPK')
    }


    $('.legion').click(function() {
        if($(this).hasClass("a41")) {
            removeActive();
            $(this).toggleClass('a41-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-a41');
        }
        if($(this).hasClass("a212")) {
            removeActive();
            $(this).toggleClass('a212-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-a212');
        }
        if($(this).hasClass("a501")) {
            removeActive();
            $(this).toggleClass('a501-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-a501')
        }
        if($(this).hasClass("CT")) {
            removeActive();
            $(this).toggleClass('CT-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-CT')
        }
        if($(this).hasClass("GVARD")) {
            removeActive();
            $(this).toggleClass('GVARD-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-GVARD')
        }
        if($(this).hasClass("IPK")) {
            removeActive();
            $(this).toggleClass('IPK-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-IPK')
        }
        if($(this).hasClass("MED")) {
            removeActive();
            $(this).toggleClass('MED-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-MED')
        }
        if($(this).hasClass("TRENER")) {
            removeActive();
            $(this).toggleClass('TRENER-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-TRENER')
        }
        if($(this).hasClass("ODISB")) {
            removeActive();
            $(this).toggleClass('ODISB-active');
            removeActiveBtn();
            $('.menu-btn').addClass('menu-btn-ODISB')
        }

        function activeGame () {
            $('.menu-content').addClass('not-active2');
            setTimeout(function() {
                $('.menu-content').addClass('not-active');
                $('.game').removeClass('not-active').addClass('active');
            }, 1000);
            
        }

            SelectedLeg = 0;
        if($('.menu-btn').click(function() {
            if($(this).hasClass('menu-btn-a41')) {
                SelectedLeg = 1;
                activeGame();

            }
            if($(this).hasClass('menu-btn-a212')) {
                SelectedLeg = 2;
            }
            if($(this).hasClass('menu-btn-a501')) {
                SelectedLeg = 3;
            }
        }));
    });
});
