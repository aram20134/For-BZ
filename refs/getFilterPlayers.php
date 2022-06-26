<?php 
require_once ('../db.php');
$a = R::getAll('SELECT * FROM `usersbz` WHERE `number` LIKE :num or `name` LIKE :name LIMIT 10', [':num' => '%'.$_GET['filter'].'%', ':name' => '%'.$_GET['filter'].'%']);
if ($a != null) {
    foreach ($a as $pl) {
        $times = 0;
        if ($pl['phase'] == 1) {
            $online = R::findAll('online', 'steamname = ?', [$pl['steamname']]);
            foreach ($online as $onl) {
                $times += $onl['time'];
            }
        } else if ($pl['phase'] == 2) {
            $online = R::findAll('online2', 'steamname = ?', [$pl['steamname']]);
            foreach ($online as $onl) {
                $times += $onl['time'];
            }
        }
        $times == null ? $times = 0 : $times;
        if ($pl['steamid'] != null) {
            echo '<div style="border: 2px solid #00ff2945;" class="find-player">
                <div class="find-pl-img"><a target="__blank" href="profile-other?number='.$pl['number'].'&phase='.$pl['phase'].'"><img src="'.$pl['avatar'].'" /></a></div>
                <div class="find-pl-info">
                    <h2>'.$pl['number'].' | '.$pl['name'].'</h2>
                    <ul>
                        <li>Phase: '.$pl['phase'].'</li> 
                        <li>Онлайн за 14 дней: '.$times.' м</li>
                    </ul>
                </div>
            </div>';
        } else {
            if ($pl['phase'] == 1) {
                echo '<div style="border: 2px solid red;" class="find-player">
                <div class="find-pl-img"><img src="../img/phase1/clone1.png" /></div>
                <div class="find-pl-info">
                    <h2>'.$pl['number'].' | '.$pl['name'].'</h2>
                    <ul>
                        <li>Phase: '.$pl['phase'].'</li> 
                        <li>Онлайн за 14 дней: '.$times.' м</li>
                    </ul>
                </div>
            </div>';
            } elseif ($pl['phase'] == 2) {
                echo '<div style="border: 2px solid red;" class="find-player">
                <div class="find-pl-img"><img src="../img/phase2/clone2.png" /></div>
                <div class="find-pl-info">
                    <h2>'.$pl['number'].' | '.$pl['name'].'</h2>
                    <ul>
                        <li>Phase: '.$pl['phase'].'</li> 
                        <li>Онлайн за 14 дней: '.$times.' м</li>
                    </ul>
                </div>
            </div>';
            }
        }
    }
} else {
    echo '<h2 style="color:white;">Игроки не найдены</h2>';
}
?>