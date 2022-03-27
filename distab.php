<style>
    :root {
        --discol: #18191c;
    }

    .disblock {
        width: 300px;
        height: auto;
    }

    .dsbanner {
        height: 60px;
        border-radius: 5px 5px 0px 0px;
        position: relative;
    }

    .dsav {
        background-size: 80px 80px;
        width: 80px;
        height: 80px;
        position: relative;
        border-radius: 50%;
        left: 20px;
        top: 20px;
        z-index: 100;
    }

    .round {
        content: "";
        width: 89px;
        height: 90px;
        position: absolute;
        border-radius: 50%;
        left: 15px;
        top: 15px;
        background-color: var(--discol);
    }

    .dsname {
        background-color: var(--discol);
        padding: 64px 16px 16px 16px;
        font-weight: bold;
        font-size: 20px;
        color: white;
    }

    .dsnum {
        color: #fff6;
        font-weight: bold;
    }

    .line {
        height: 1px;
        background-color: grey;
        width: 268px;
    }
    .dsroles > p {
        margin:8px 0px 5px 5px;
    }

    .secdis {
        padding: 0 15px 14px;
        background-color: var(--discol);
        border-radius: 0px 0px 5px 5px;
    }

    .roleslist {
        display: flex;
        position: relative;
        flex-wrap: wrap;
    }

    .role {
        padding: 5px 10px 5px 25px;
        border-radius: 5px;
        background-color: #292b2f;
        position: relative;
        margin: 3px;
        font-size: 12px;
        font-weight: bold;
        color: white;
        line-height: 1.2;
    }

    .asd {
        content: "";
        position: absolute;
        width: 14px;
        height: 14px;
        background-color: red;
        border-radius: 50%;
        left: 5px;
        top: 5px;
        z-index: 2;
    }
    .asd2 {
        content: "";
        position: absolute;
        width: 14px;
        height: 14px;
        background-color: red;
        border-radius: 50%;
        left: 5px;
        top: 5px;
        z-index: 2;
    }
    .asd:hover {
        cursor: pointer;
    }
    .asd::before {
        content: "";
        position: absolute;
        height: 1px;
        width: 8px;
        background-color: white;
        top: 7px;
        left: 3px;
        transform: rotate(45deg);
        opacity: 0;
        transition: all 0.1s linear;
    }
    .asd::after {
        content: "";
        position: absolute;
        height: 1px;
        width: 8px;
        background-color: white;
        top: 7px;
        left: 3px;
        transform: rotate(135deg);
        opacity: 0;
        transition: all 0.1s linear;
    }
    .asd:hover:after {
        opacity: 1;
    }
    .asd:hover:before {
        opacity: 1;
    }
    .disinfo {
        font-size:12px;
        text-decoration:underline;
        cursor:pointer;
        margin:2px;
        position: relative;
    }
    .disinfo::after {
        content: "Показывает ваши роли для проверки соответствия. Также в случаи нахождения конфликтов между ролями, можно будет её удалить. Для восстановления ролей обратно напишите соотвествующую команду на вашем сервере (Phase 1 => !verify, Phase 2 => !login)";
        height: 73px;
        line-height:1.2;
        width: 290px;
        position: absolute;
        left: 0;
        box-sizing: content-box;
        padding: 3px;
        color: #00d300;
        top: 20px;
        background: #424242;
        opacity: 0;
        display:none;
    }
    .disinfo:hover::after {
        opacity: 1;
        display:block;
    }
    .bannerinfo {
        width: 20px;
        height:20px;
        position: absolute;
        background: white;
        border-radius: 50%;
        right: 5px;
        top: 5px;
        cursor:pointer;
    }
    .bannerinfo::after {
        content: "Цвет баннера не совпадает с вашим? Чтобы это исправить, в настройках профиля вручную задайте желаемый цвет профиля, после чего отвяжие и снова привяжите дискорд.";
        position: absolute;
        height: 54px;
        width: 290px;
        left: -275px;
        top: -70px;
        padding: 5px;
        z-index: 100;
        background: #424242;
        color: #00d300;
        line-height: 1.2;
        font-size: 12px;
        opacity: 0;
        display:none;
    }
    .bannerinfo:hover::after {
        opacity: 1;
        display:block;
    }
</style>
<?php 
require __DIR__ . '/rolesph1.php';
require __DIR__ . '/rolesph2.php';
        function showdis ($ds, $rols, $phase, $info) {
            require __DIR__ . '/rolesph1.php';
            require __DIR__ . '/rolesph2.php';
            echo '<div class="disblock">';
            if ($ds['dscol'] != NULL) {
                echo '<div class="dsbanner" style="'."background-color:".$ds['dscol']."\">";
            } else {
                echo '<div class="dsbanner" style="'."background-color:"."#fff3"."\">";
                if ($info == true) {
                    echo '<div class="bannerinfo">';
                    echo '<img style="height:20px;position:absolute;" src="img/info.png" />';
                    echo '</div>';
                }
            }
            // background-image: url(https://cdn.discordapp.com/avatars/<?php echo $user['dsid']."/".$user['dsav'].".png");
                echo '<div class="dsav" style ="background-image: url(https://cdn.discordapp.com/avatars/'.$ds['dsid']."/".$ds['dsav'].'"></div>';
                echo '<div class="round"></div>
            </div>
            <div class="dsname">';
            echo $ds['dsname'];
            echo '<span class="dsnum">';
            echo "#".$ds['dsnum'];
            echo '</span>
            </div>
                <div class="secdis">
                <div class="line"></div>
                <div class="dsroles">
                <p class="dsnum" style="font-size: 15px;">РОЛИ</p>
                <div class="roleslist">';
                        $arrayw = array();
                        $rolesl = $rols['roleslist'];
                        $rolesl = trim($rolesl, "<@&>");
                        $tok = strtok($rolesl, ",");
                        while($tok) {
                            $tok = trim($tok, "<@&>");
                            $arrayw[] = $tok;
                            $tok = strtok (",");
                        }
                        if ($phase == 2) {
                            $allroles = $allroles2;
                        }
                        for ($i = 0; $i < count($arrayw) - 1; $i++) {
                            for ($j = 0; $j < count($arrayw) - 2; $j++) {
                                if ($allroles[$arrayw[$j]]['pos'] > $allroles[$arrayw[($j+1)]]['pos']) {
                                    list($arrayw[$j], $arrayw[($j+1)]) = array($arrayw[$j+1], $arrayw[$j]);
                                }
                            }
                        }
                        if ($info != false) {
                            for ($i = 0; $i < count($arrayw) - 1; $i++) {
                                if ($allroles[$arrayw[$i]]['color'] != NULL) {
                                    echo '<div id="'.$arrayw[$i].'" class="role"><div class="asd" style="background-color:'.$allroles[$arrayw[$i]]['color']."\"".">".'</div>'.$allroles[$arrayw[$i]]['name'].'</div>';
                                }
                            }
                        } else {
                            for ($i = 0; $i < count($arrayw) - 1; $i++) {
                                if ($allroles[$arrayw[$i]]['color'] != NULL) {
                                    echo '<div id="'.$arrayw[$i].'" class="role"><div class="asd2" style="background-color:'.$allroles[$arrayw[$i]]['color']."\"".">".'</div>'.$allroles[$arrayw[$i]]['name'].'</div>';
                                }
                            }
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        if ($info == true) {
                            echo '<div class ="disinfo">Для чего это нужно?</div>';
                        }
                        echo '</div>';
        }
        // if ($role == false) {
        //     return false;
        // }
    ?>