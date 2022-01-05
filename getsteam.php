<?php
$title="[SWRP] Вход";
require "db.php";
require __DIR__ . '/header.php';
?>

<?php
require '/lightopenid/OpenID.php';

$steamkey = 'E8CD01EFD4C1232BA23E9F5CA009D38E';
$script = 'https://swrpngg.space/getsteam';

try {
    $openid = new LightOpenID($script);
    if(!$openid->mode) {
        $openid->identity = 'http://steamcommunity.com/openid/?l=russian';
        header('location: '.$openid->authUrl());
    } elseif ($openid->mode == 'cancel') {
        echo 'User has canceled authentication';
    } else {
        if($openid->validate()) {
            $id = $openid->identity;
            $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
            preg_match($ptn, $id, $matches);

            $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$steamkey&steamids=$matches[1]";
            $json_object = file_get_contents($url);
            $json_decoded = json_decode($json_object);

            foreach ($json_decoded->response->players as $player) {
                echo '<img src="'.$player->avatarmedium.'"> <a href="'.$player->profileurl.'">'.htmlspecialchars($player->personaname).'</a><hr><pre>';
                var_dump($player);
                echo '</pre>';
            }
        } else {
        echo 'User is not logged in.';
        }
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}

?>

<?php 
require __DIR__ . '/footer.php'; 
?>