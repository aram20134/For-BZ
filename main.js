$(document).ready(function () {
    $('.first').hover(function () {
        if(!$(this).hasClass('active-server')) {
            $(this).toggleClass('box-online-hover');
        }
    });
    $('.second').hover(function () {
        if(!$(this).hasClass('active-server')) {
        $(this).toggleClass('box-online-hover');
        }
    });
var map = '<?php echo $map ?>';
var map2 = '<?php echo $map2 ?>';

var sim1 = '<?php echo $sim1 ?>';
var sim2 = '<?php echo $sim2 ?>';

var gen1 = '<?php echo $gen1 ?>';
var gen2 = '<?php echo $gen2 ?>';

var nabo1 = '<?php echo $nabo1 ?>';
var nabo2 = '<?php echo $nabo2 ?>';

if (map == "Anaxes") {
    $('.first').toggleClass('map-anaxes');
} else if (map == "Tatooine" && sim1 == "1") {
    $('.first').toggleClass('map-tatooine_sim'); 
} else if (map == "Geonosis" && gen1 == "1") {
    $('.first').toggleClass('map-geonosis2');
} else if (map == "Naboo" && nabo1 == "1") {
    $('.first').toggleClass('map-naboo2'); 
} else if (map == "Korriban") {
    $('.first').toggleClass('map-korriban');
} else if (map == "Geonosis") {
    $('.first').toggleClass('map-geonosis');
} else if (map == "Tatooine") {
    $('.first').toggleClass('map-tatooine'); 
} else if (map == "Takodana") {
    $('.first').toggleClass('map-takodana');
} else if (map == "Naboo") {
    $('.first').toggleClass('map-naboo');
} else if (map == "Mygeeto") {
    $('.first').toggleClass('map-naboo');
}
if (map2 == "Corellia") {
    $('.second').toggleClass('map-corellia');
} else if (map2 == "Tatooine" && sim2 == "1") {
    $('.second').toggleClass('map-tatooine_sim');
} else if (map2 == "Geonosis" && gen2 == "1"){
    $('.second').toggleClass('map-geonosis2');
} else if (map2 == "Naboo" && nabo1 == "1") {
    $('.second').toggleClass('map-naboo2'); 
} else if (map2 == "Korriban") {
    $('.second').toggleClass('map-korriban');
} else if (map2 == "Naboo") {
    $('.second').toggleClass('map-naboo');
} else if (map2 == "Tatooine") {
    $('.second').toggleClass('map-tatooine'); 
} else if (map2 == "Takodana") {
    $('.second').toggleClass('map-takodana');
} else if (map2 == "Geonosis") {
    $('.second').toggleClass('map-geonosis');
} else if (map2 == "Mygeeto") {
    $('.second').toggleClass('map-mygeeto');
}
});