<style>
    .log-ex {
        border: 2px solid red;
        padding: 10px;
        margin: 10px;
        transition: all 0.2s ease;
        box-shadow: 2px 2px 2px purple;
    }
    .log-ent {
        border: 2px solid #00a200;
        padding: 10px;
        margin: 10px;
        transition: all 0.2s ease;
        box-shadow: 2px 2px 2px cyan;
    }
    .log {
        display:flex;
        flex-direction: row;
        align-items: center;
    }
    .log-date {
        border: 2px solid white;
        padding: 10px;
        margin: 10px;
        box-shadow: 2px 2px 2px wheat;
    }
    .pl-f:hover {
        transform: scale(1.1);
    }
    .pages {
        display: flex;
        align-items: center;
        margin: 5px;
    }
    .page {
        padding: 4px 8px 4px 8px;
        margin: 4px;
        background-color: #00748e;
        transition: all 0.2s ease;
    }
    .page:hover {
        background-color: purple;
    }
    .page-active {
        background-color: purple;
    }
</style>
<?
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
require '../db.php';
$data = $_GET;

if ($data['phase'] == 1) {
    $logs = R::getAssoc('SELECT * FROM logs WHERE phase = 1 ORDER BY date desc');
} else {
    $logs = R::getAssoc('SELECT * FROM logs WHERE phase = 2 ORDER BY date desc');
}
$logs2 = $logs;
if ($data['page'] == 1) {
    $logs = array_slice($logs, 0, 1000);
} else if ($data['page'] == 2) {
    $logs = array_slice($logs, 1000, 2000);
} else if ($data['page'] == 3) {
    $logs = array_slice($logs, 2000, 3000);
}
?>
<div class="pages">
    <div>Страница </div>
    <? if ($data['page'] == 1) {
        echo '<a class="page page-active" href="logs?phase='.$data['phase'].'&page=1">1</a>';
    } else {
        echo '<a class="page" href="logs?phase='.$data['phase'].'&page=1">1</a>';
    }
    if ($data['page'] == 2) {
        echo '<a class="page page-active" href="logs?phase='.$data['phase'].'&page=2">2</a>';
    } else {
        echo '<a class="page" href="logs?phase='.$data['phase'].'&page=2">2</a>';
    }
    if ($data['page'] == 3) {
        echo '<a class="page page-active" href="logs?phase='.$data['phase'].'&page=3">3</a>';
    } else {
        echo '<a class="page" href="logs?phase='.$data['phase'].'&page=3">3</a>';
    }
    
    ?>
</div>
<?
foreach ($logs as $log) {
    $dateDiff = date_diff(new DateTime(), new DateTime($log['date']));
    $player = R::findOne('usersbz', 'steamname = :n AND phase = :ph', [':n' => $log['name'], ':ph' => $data['phase']]);
    $a = strtotime($log['date']);
    $log['date'] = date('d', $a).'-'.date('m', $a).'-'.date('Y', $a).' '.date('H', $a).':'.date('i', $a);
if ($player == NULL) {
    if ($log['status'] == 'Exit' and $log['name'] != NULL) {
        if ($dateDiff->d == 0 and $dateDiff->h == 0) {
            if ($dateDiff->i == 0) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' только что вышел с сервера</div></div>';
            } else {
                if ($dateDiff->i == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->i.' минуту назад</div></div>';
                } else if ($dateDiff->i == 2 or $dateDiff->i == 3 or $dateDiff->i == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->i.' минуты назад</div></div>';
                } else if ($dateDiff->i > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->i.' минут назад</div></div>';
                }
            }
           
        } else if ($dateDiff->h > 0 and $dateDiff->d == 0) {
            if ($dateDiff->h == 1) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->h.' час назад</div></div>';
            } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->h.' часа назад</div></div>';
            } else if ($dateDiff->h > 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->h.' часов назад</div></div>';
            }
            
        } else if ($dateDiff->d > 0) {
            if ($dateDiff->d == 1) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' час назад</div></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' часа назад</div></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' часов назад</div></div>';
                }
            } else if ($dateDiff->d == 2) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' зашёл на сервер '.$dateDiff->d.' дня и '.$dateDiff->h.' час назад</div></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' зашёл на сервер '.$dateDiff->d.' дня и '.$dateDiff->h.' часа назад</div></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' зашёл на сервер '.$dateDiff->d.' дня и '.$dateDiff->h.' часов назад</div></div>';
                }
            }
        }
    } else if ($log['status'] == 'Enter' and $log['name'] != NULL) {
        if ($dateDiff->d == 0 and $dateDiff->h == 0) {
            if ($dateDiff->i == 0) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' только что зашёл на сервер</div></div>';
            } else {
                if ($dateDiff->i == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' зашёл на сервер '.$dateDiff->i.' минуту назад</div></div>';
                } else if ($dateDiff->i == 2 or $dateDiff->i == 3 or $dateDiff->i == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' зашёл на сервер '.$dateDiff->i.' минуты назад</div></div>';
                } else if ($dateDiff->i > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' зашёл на сервер '.$dateDiff->i.' минут назад</div></div>';
                }
            }
           
        } else if ($dateDiff->h > 0 and $dateDiff->d == 0) {
            if ($dateDiff->h == 1) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' зашёл на сервер '.$dateDiff->h.' час назад</div></div>';
            } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' зашёл на сервер '.$dateDiff->h.' часа назад</div></div>';
            } else if ($dateDiff->h > 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ent">'.$log['name'].' зашёл на сервер '.$dateDiff->h.' часов назад</div></div>';
            }
            
        } else if ($dateDiff->d > 0) {
            if ($dateDiff->d == 1) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' час назад</div></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' часа назад</div></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' часов назад</div></div>';
                }
            } else if ($dateDiff->d == 2) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' дня и '.$dateDiff->h.' час назад</div></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' дня и '.$dateDiff->h.' часа назад</div></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><div class="log-ex">'.$log['name'].' вышел с сервера '.$dateDiff->d.' дня и '.$dateDiff->h.' часов назад</div></div>';
                }
            }
        }
    }
} else { // ИГРОК 
    if ($log['status'] == 'Exit' and $log['name'] != NULL) {
        if ($dateDiff->d == 0 and $dateDiff->h == 0) {
            if ($dateDiff->i == 0) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' только что вышел с сервера</a></div>';
            } else {
                if ($dateDiff->i == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->i.' минуту назад</a></div>';
                } else if ($dateDiff->i == 2 or $dateDiff->i == 3 or $dateDiff->i == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->i.' минуты назад</a></div>';
                } else if ($dateDiff->i > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->i.' минут назад</a></div>';
                }
            }
           
        } else if ($dateDiff->h > 0 and $dateDiff->d == 0) {
            if ($dateDiff->h == 1) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->h.' час назад</a></div>';
            } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->h.' часа назад</a></div>';
            } else if ($dateDiff->h > 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->h.' часов назад</a></div>';
            }
            
        } else if ($dateDiff->d > 0) {
            if ($dateDiff->d == 1) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' час назад</a></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' часа назад</a></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->d.' день и '.$dateDiff->h.' часов назад</a></div>';
                }
            } else if ($dateDiff->d == 2) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->d.' дня и '.$dateDiff->h.' час назад</a></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->d.' дня и '.$dateDiff->h.' часа назад</a></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ex pl-f">'.$player['number']." | ".$player['name'].' вышел с сервера '.$dateDiff->d.' дня и '.$dateDiff->h.' часов назад</a></div>';
                }
            }
        }
    } else if ($log['status'] == 'Enter' and $log['name'] != NULL) {
        if ($dateDiff->d == 0 and $dateDiff->h == 0) {
            if ($dateDiff->i == 0) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' только что зашёл на сервер</a></div>';
            } else {
                if ($dateDiff->i == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->i.' минуту назад</a></div>';
                } else if ($dateDiff->i == 2 or $dateDiff->i == 3 or $dateDiff->i == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->i.' минуты назад</a></div>';
                } else if ($dateDiff->i > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->i.' минут назад</a></div>';
                }
            }
           
        } else if ($dateDiff->h > 0 and $dateDiff->d == 0) {
            if ($dateDiff->h == 1) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->h.' час назад</a></div>';
            } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->h.' часа назад</a></div>';
            } else if ($dateDiff->h > 4) {
                echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->h.' часов назад</a></div>';
            }
            
        } else if ($dateDiff->d > 0) {
            if ($dateDiff->d == 1) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->d.' день и '.$dateDiff->h.' час назад</a></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->d.' день и '.$dateDiff->h.' часа назад</a></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->d.' день и '.$dateDiff->h.' часов назад</a></div>';
                }
            } else if ($dateDiff->d == 2) {
                if ($dateDiff->h == 1) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->d.' дня и '.$dateDiff->h.' час назад</a></div>';
                } else if ($dateDiff->h == 2 or $dateDiff->h == 3 or $dateDiff->h == 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->d.' дня и '.$dateDiff->h.' часа назад</a></div>';
                } else if ($dateDiff->h > 4) {
                    echo '<div class="log"><div class="log-date">'.$log['date'].'</div><a href="profile-other?number='.$player['number']."&phase=".$data['phase'].'" class="log-ent pl-f">'.$player['number']." | ".$player['name'].' зашёл на сервер '.$dateDiff->d.' дня и '.$dateDiff->h.' часов назад</a></div>';
                }
            }
        }
    }
}
}
?>
<div class="pages">
<div>Страница </div>
    <? if ($data['page'] == 1) {
        echo '<a class="page page-active" href="logs?phase='.$data['phase'].'&page=1">1</a>';
    } else {
        echo '<a class="page" href="logs?phase='.$data['phase'].'&page=1">1</a>';
    }
    if ($data['page'] == 2) {
        echo '<a class="page page-active" href="logs?phase='.$data['phase'].'&page=2">2</a>';
    } else {
        echo '<a class="page" href="logs?phase='.$data['phase'].'&page=2">2</a>';
    }
    if ($data['page'] == 3) {
        echo '<a class="page page-active" href="logs?phase='.$data['phase'].'&page=3">3</a>';
    } else {
        echo '<a class="page" href="logs?phase='.$data['phase'].'&page=3">3</a>';
    }
    ?>
</div>