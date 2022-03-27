<?php
$title="[SWRP] Профиль";
require "db.php";
require __DIR__ . '/header.php';
require "steamauth/steamauth.php";
require __DIR__ . '/distab.php';
?>
<?php $user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $_SESSION['logged_user']->number, ':ph' => $_SESSION['logged_user']->phase]); ?>
<?php

if ($user['phase'] == 1) {
	$roles = R::findOne('roles', 'discordid = ?', [$user['dsid']]); 
} else {
	$roles = R::findOne('roles2', 'discordid = ?', [$user['dsid']]); 
}

if ($roles == NULL and $user != NULL) {
	$user->rang = NULL;
	$user->bigrang = NULL;
	$user->legion = NULL;
	R::store($user);
}
?>
<script src="jquery-3.6.0.min.js"></script>
<script>
    $(function(){
  $('.asd').click(function(){
    $.ajax ({
        url: 'disdb.php',
        method: 'post',
        data: {id: $(this).parent().attr('id'), user: '<?php echo $user['number'] ?>', phase: '<?php echo $user['phase'] ?>'},
        success: function (data) {
            var elem = $('#'+data);
            $(elem).detach();
            console.log(data);
        }
    });
  });
});
</script>
<!--GRAPHICS-->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>

<?php if ($user['steamname'] != NULL) : ?>

<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function () {
	// [Date.UTC(2022, 0, 21), 100],
	var online = [
	<?php 
	if ($user['phase'] == 1) {
		$online = R::findAll('online', 'steamname = ?', [$user['steamname']]);
		foreach ($online as $key => $value) {
			$value['m']--;
			echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['time'].'],';
		}
		} elseif ($user['phase'] == 2) {
			$online = R::findAll('online2', 'steamname = ?', [$user['steamname']]);
			foreach ($online as $key => $value) {
				$value['m']--;
				echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['time'].'],';
			}
		}
	?>
	];
Highcharts.setOptions({
    lang: {
            loading: 'Загрузка...',
            months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            weekdays: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
            shortMonths: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек'],
            exportButtonTitle: "Экспорт",
            printButtonTitle: "Печать",
            rangeSelectorFrom: "С",
            rangeSelectorTo: "По",
            rangeSelectorZoom: "Период",
            downloadPNG: 'Скачать PNG',
            downloadJPEG: 'Скачать JPEG',
            downloadPDF: 'Скачать PDF',
            downloadSVG: 'Скачать SVG',
            printChart: 'Напечатать график'   
        }        
});
    var chart = Highcharts.stockChart('container', {
    	chart: {
    		backgroundColor: 'transparent',
    	},
    	navigator: {
    		enabled: true,
    	},
    	scrollbar: {
    		enabled: false,
    	},
        rangeSelector: {
        	enabled: false,
            selected: 1,
            buttonTheme: {
            	fill: 'none',
            	r: 8,
            	style: {
            		color: '#039',
                    fontWeight: 'bold'	
            	},
            	states: {
                    hover: {
                    	style : {
                    		color: 'black'	
                    	},
                    },
                    select: {
                        fill: '#039',
                        style: {
                            color: 'white'
                        }
                    }
                },
            },
            labelStyle: {
			color: 'white',
			fontWeight: 'bold'
			},
        },
		credits: {
    		enabled: false
		},
		yAxis: {
        	opposite: false,
            offset: 15,
            tickWidth: 1,
            tickLength: 10,
			tickAmount: 6,
            lineWidth: 1,
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        			fontSize:'20px',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		}
			},
    	},
    	xAxis: {
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        			fontSize:'15px',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white'
        		}
			},
    	},
        title: {
            text: 'Онлайн <?php echo "[".$user['number']." | ".$user['name']."]" ?>',
            style: {
            	color: 'white',
            	fontWeight: 'bold'
            },
        },
        plotOptions: {
        	series: {
            	borderWidth: 1,
            	color: 'darkred',
            	lineWidth: 4,
            	dataLabels: {
                	enabled: true,
                	format: '{y} м'
            	}
        	}
    	},
        series: [{
            name: 'Минуты',
            data: online,
            tooltip: {
                valueDecimals: 0
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 5,
                fillColor: 'red',
            },
        }]
    });
    if (window.matchMedia("(min-width: 1200px)").matches) {
    	
	} else {
		chart.setSize(1000);
	}
    if (window.matchMedia("(min-width: 1024px)").matches) {
    	
	} else {
		chart.setSize(800);
	}
    if (window.matchMedia("(min-width: 800px)").matches) {
    	
    } else {
    	chart.setSize(600);
    }
    if (window.matchMedia("(min-width: 600px)").matches) {
    	
    } else {
    	chart.setSize($(container).width());
    }
    });
</script>

<?php else : ?>
<div style="display:flex;justify-content:center;">
<?php 
	if ($user != NULL) {
		echo '<div class="alert-box">Для просмотра своего онлайна привяжите свой Steam</div>';
	} 
?>
<?php $onl = true; ?>
</div>
<?php endif ?>
<script>
	$(document).ready(function() {
	var out = "<?php echo $user['number']." | ".$user['name']." | ".$user['rang'] ?>";
	var stm = "<?php echo $user['steamid'] ?>";
		function copyToClipboard() {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(out).select();
			document.execCommand("copy");
			$temp.remove();
			
		}
		function copyToClipboard2() {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(stm).select();
			document.execCommand("copy");
			$temp.remove();
		}
		
		$('#prof-btn').click(function() {
			copyToClipboard();
			console.log('1');
		});
		$('#prof-btn2').click(function() {
			copyToClipboard2();
			console.log('2');
		});
		var phase = "<?php echo $_SESSION['logged_user']->phase ?>";
		
		var _0xbfa1=["\x31","\x32","\x63\x68\x65\x63\x6B\x65\x64","\x70\x72\x6F\x70","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x32","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x33","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x34","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x35","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x36","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x37","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x38","\x6C\x6F\x67","\x63\x6C\x69\x63\x6B","\x23\x63\x68\x65\x63\x6B\x2D\x72\x61\x6E\x67\x31","\x33","\x34","\x35","\x36","\x37","\x38"];if(phase== _0xbfa1[0]|| phase== _0xbfa1[1]){$(_0xbfa1[13])[_0xbfa1[12]](function(){$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[0])});$(_0xbfa1[4])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[1])});$(_0xbfa1[5])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[14])});$(_0xbfa1[6])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[15])});$(_0xbfa1[7])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[16])});$(_0xbfa1[8])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[17])});$(_0xbfa1[9])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[10])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[18])});$(_0xbfa1[10])[_0xbfa1[12]](function(){$(_0xbfa1[13])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[4])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[5])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[6])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[7])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[8])[_0xbfa1[3]](_0xbfa1[2],false);$(_0xbfa1[9])[_0xbfa1[3]](_0xbfa1[2],false);console[_0xbfa1[11]](_0xbfa1[19])})};

	});
		</script>
<?php if(isset($_SESSION['logged_user'])) : ?>
	<div class ="content">
		<?php if($user['legion'] != NULL and $user['rang'] != NULL and $user['steamid'] != NULL) : ?>
		<div class="profbz">
		<div class="profbz-content">
			<a target="_blank" href="<?php echo $user['profurl'] ?>"><img style="height:150px;" src="<?php echo $user['avatar']?>"  /></a>
			<?php echo '<div>'  ?>
			<?php echo '<div>'.$_SESSION['logged_user']->number.$a.$_SESSION['logged_user']->name.'</div>' ?>
			<?php echo '<div>'.$user['legion'].'</div>';  ?>
			<?php echo '<div>'.$user['rang'].'</div>';  ?>
			<?php echo '</div>'  ?>
		</div>
			<div class="prof-btns">
			<a target = "_blank" href="<?php echo $user['profurl'] ?>" class="prof-btn">профиль</a>
			<div id="prof-btn">копировать [Н|П|З]</div>
			<div id="prof-btn2">копировать STEAM ID</div>
			</div>
			</div>
		<?php endif; ?>
		
		
		<div class="prof-info">
			<h1 style="display:flex;justify-content:center;">Информация</h1>
			<div class ="text-prof">
				<p>
				<?php 
				if ($user['steamid'] == NULL or $user['dsid'] == NULL) {
					echo '<span class ="alert-box">Для полноценной работы функционала сайта подключите Steam и Discord</span>';
				}
				?>
				Ваш номер: <?php echo $_SESSION['logged_user']->number ?>
				<br>
				Ваш позывной: <?php echo $user['name'] ?> <span><a href="change-name" style="text-decoration:underline;">Сменить</a></span>
				<br>
				Фаза: <?php echo $_SESSION['logged_user']->phase; ?>
				<br>
				 <?php
 //	$online = R::findOne('online', 'd = :d AND m = :m AND y = :y AND steamname = :st', [':d' => $d, ':m' => $m, ':y' => $y, ':st'=>$player['name']]);
					$user = R::findOne('usersbz', 'number = :n AND phase = :p', [':n' => $_SESSION['logged_user']->number, ':p' => $_SESSION['logged_user']->phase]);
					
					require 'steamauth/userInfo.php';

					if ($user['steamid']) {
							if(isset($_SESSION['steamid'])) {
								$user->steamid =  $_SESSION['steam_steamid'];
								$user->avatar = $_SESSION['steam_avatarfull'];
								$user->profurl = $_SESSION['steam_profileurl'];
								$user->steamname = $_SESSION['steam_personaname'];
							}
							echo '<br>';
							echo '<span class="find">Steam:<a target="_blank" href="'.$user['profurl'].'"><img src="img/steam.png" style="height:50px;margin:5px;" />Подключено</a></span>';
							echo '<a href="steamauth/logout.php" style="text-decoration:underline;">(Выйти)</a>';
							
						} else if (isset($_SESSION['steamid'])) {
							$check = R::findOne('usersbz', 'steamid = :steamid AND phase = :ph', [':steamid' => $_SESSION['steamid'], ':ph' => $user['phase']]);
							if ($check == NULL) {
								$user->steamid = $_SESSION['steam_steamid'];
								$user->avatar = $_SESSION['steam_avatarfull'];
								$user->profurl = $_SESSION['steam_profileurl'];
								$user->steamname = $_SESSION['steam_personaname'];
								header("Refresh: 0");
							} else {
								echo '<br>';
								echo '<span>Steam:</span><span class ="alert-box" style="margin-bottom:0;"> Данный стим аккаунт уже привязан! </span>';
								echo '<span style="width:50%;display:flex;justify-content:center;"><button class="btn-retry" value="Refresh Page" onClick="window.location.reload();">Повторить</button></span>';
								unset($_SESSION['steamid']);
							}
						} else {
							echo 'Steam: ';loginButton(); echo '<span data="Подключите Steam аккаунт, чтобы вы и другие пользователи могли видеть ваш номер и позывной в списке игроков вашей фазы."><img src="img/info.png" class="ico-info"/></span>';
						}
						
						R::store($user);
						
						?>
				<br>
<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
error_reporting(E_ALL);
define('OAUTH2_CLIENT_ID', '929337070084825168');
define('OAUTH2_CLIENT_SECRET', 'L16oTijCr23v647O3R21iEesZcWuWcHI');
$authorizeURL = 'https://discord.com/api/oauth2/authorize?client_id=929337070084825168&redirect_uri=https%3A%2F%2Fswrpngg.space%2Fprofile&response_type=code&scope=identify%20connections';
$tokenURL = 'https://discordapp.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';
$revokeURL = 'https://discord.com/api/oauth2/token/revoke';

$dis = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $_SESSION['logged_user']->number, ':ph' => $user['phase']]);

function apiRequest($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    $headers[] = 'Accept: application/json';
    if(session('access_token'))
      $headers[] = 'Authorization: Bearer ' . session('access_token');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    return json_decode($response);
  }
  function get($key, $default=NULL) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
  }
  function session($key, $default=NULL) {
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
  }

if(get('action') == 'login') {
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://swrpngg.space/profile',
    'response_type' => 'code',
    'scope' => 'identify connections'
  );
  // Redirect the user to Discord's authorization page
  header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}
if(get('code')) {
    // Exchange the auth code for a token
    $token = apiRequest($tokenURL, array(
      "grant_type" => "authorization_code",
      'client_id' => OAUTH2_CLIENT_ID,
      'client_secret' => OAUTH2_CLIENT_SECRET,
      'redirect_uri' => 'https://swrpngg.space/profile',
      'code' => get('code')
    ));
    $logout_token = $token->access_token;
    $_SESSION['access_token'] = $token->access_token;
    header('Location: https://swrpngg.space/profile');
  }
$user = apiRequest($apiURLBase);
if(session('access_token') and $dis['dsid'] == NULL) {
		$user = apiRequest($apiURLBase);
		$check = R::findOne ('usersbz', 'dsid = :dsid AND phase = :ph', [':dsid' => $user->id, ':ph' => $dis['phase']]);
		if ($check == NULL) {
			echo '<span class="find">Discord:<a href=""><img src="img/discord.png" style="height:50px;margin:5px;" />Подключено</a></span>';
			echo '<a href="?action=logout" style="text-decoration:underline;">(Выйти)</a>';
			$dis->dsid = $user->id;
			$dis->dsav = $user->avatar;
			$dis->dsnum = $user->discriminator;
			$dis->dsname = $user->username;
			$dis->dscol = $user->banner_color;
			R::store($dis);
		} else if ($check != NULL) {
			echo '<br>';
			echo '<span>Discord:</span><span class ="alert-box" style="margin-bottom:0;"> Данный дискорд аккаунт уже привязан! </span>';
			echo '<span style="width:50%;display:flex;justify-content:center;"><button class="btn-retry" value="Refresh Page" onClick="window.location.reload();">Повторить</button></span>';
			unset($_SESSION['access_token']);
		} 
} else if ($dis['dsid'] != NULL) {
		$user = apiRequest($apiURLBase);
		echo '<span class="find">Discord:<img src="img/discord.png" style="height:50px;margin:5px;" />Подключено</span>';
		echo '<a href="?action=logout" style="text-decoration:underline;">(Выйти)</a>';
	
} else {
	echo 'Discord: <a href="?action=login" style="text-decoration:underline;">Подключить</a>'; echo '<span data="Подключите Discord аккаунт, чтобы вы и другие пользователи могли видеть в списке игроков вашей фазы ваш легион и звание."><img src="img/info.png" class="ico-info"/></span>';
}
if(get('action') == 'logout') {
    apiRequest($revokeURL, array(
        'token' => session('access_token'),
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
      ));
    unset($_SESSION['access_token']);
    $dis['dsid'] = NULL;
    $dis['legion'] = NULL;
    $dis['rang'] = NULL;
    $dis['bigrang'] = NULL;
	$dis['dsav'] = NULL;
	$dis['dscol'] = NULL;
	$dis['dsname'] = NULL;
	$dis['dsnum'] = NULL;
    $roles['discordid'] = NULL;
    $roles['roleslist'] = NULL;
    header('Location: https://swrpngg.space/profile');
    R::store($dis);
    R::store($roles);
    exit();
  }
//   print_r($user);
?>
				<br><br>
				Легион: <?php $user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $_SESSION['logged_user']->number, ':ph' => $dis['phase']]);
					if (isset($roles['roleslist'])) {
						$roles = $roles['roleslist'];
						// $user['rang'] = NULL;
						$user['bigrang'] = NULL;
						$user['legion'] = NULL;
						R::store($user);
					} else {
						$roles = NULL;
					}
					
					if ($roles != NULL and $user['phase'] == "1") {
						if (strpos($roles, '636268496107470850')) {
						$user->legion = "Тренера";
						$user->bigrang = "Мл. офицерский состав";
						R::store($user);
						echo '<span class="legTREN">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '750697611752898600')) {
						$user->legion = "ОДИСБ";
						$user->bigrang = "Мл. офицерский состав";
						R::store($user);
						echo '<span class="legODISB">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '781576937474621460')) {
						$user->legion = "41";
						R::store($user);
						echo '<span class="leg41">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '63626954529990246')) {
						$user->legion = "212";
						R::store($user);
						echo '<span class="leg212">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636269357831290887')) {
						$user->legion = "501";
						R::store($user);
						echo '<span class="leg501">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '650207151335407656')) {
						$user->legion = "Гвардия";
						R::store($user);
						echo '<span class="legGVARD">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '650207588801183791')) {
						$user->legion = "Медик";
						R::store($user);
						echo '<span class="legMED">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636270262475554899')) {
						$user->legion = "ИПК";
						R::store($user);
						echo '<span class="legIPK">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636270468797562900')) {
						$user->legion = "Солдат-клон";
						R::store($user);
						echo '<span class="legCT">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636271352591941632')) {
						$user->legion = "Без легиона";
						$user->rang = "Кадет";
						R::store($user);
						echo '<span class="N">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '891062472813977600')) {
						$user->legion = "ОДИСБ";
						$user->rang = "Осужденный";
						R::store($user);
						echo '<span class="legODISB">'. $user['legion'] . '</span>';
					// } // убрать ->
					} elseif (strpos($roles, '636115360910671892')) {
						$user->legion = "Без легиона";
						$user->rang = "Советник";
						R::store($user);
						echo '<span class="N">'. $user['legion'] . '</span>';
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
					
				} else if ($roles != NULL and $user['phase'] == "2") {
						if (strpos($roles, '758369712106373150')) {
							$user->legion = "Солдат-клон";
							echo '<span class="legCT">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530379817695313950')) {
							$user->legion = "ИПК";
							echo '<span class="legIPK">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758374474197237790')) {
							$user->legion = "41";
							echo '<span class="leg41">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530378413257785365')) {
							$user->legion = "212";
							echo '<span class="leg212">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530377477726535695')) {
							$user->legion = "501";
							echo '<span class="leg501">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758371450020560916')) {
							$user->legion = "Гвардия";
							echo '<span class="legGVARD">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758373770704191548')) {
							$user->legion = "Медик";
							echo '<span class="legMED">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758375394667003974')) {
							$user->legion = "Инструкторы";
							$user->bigrang = "Инструкторы";
							echo '<span class="legTREN">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758377044031176756')) {
							$user->legion = "ОДИСБ";
							echo '<span class="legODISB">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '538347524118020096')) { // Осужденный
							$user->legion = "ОДИСБ";
							$user->rang = "Осужденный";
							echo '<span class="legODISB">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758372584474804365')) { // Советник
							$user->legion = "Без легиона";
							$user->rang = "Советник";
							echo '<span class="N">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758369039994847312')) { // Кадет
							$user->legion = "Без легиона";
							$user->rang = "Кадет";
							echo '<span class="N">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530367354782089226'))  { // Админ
							$user->legion = "Без легиона";
							$user->rang = "Советник";
							echo '<span class="N">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '714416434737840148'))  {
							$user->legion = "ЭРК";
							echo '<span class="legERK">'. $user['legion'] . '</span>';
							R::store($user);
						} else {
							echo '<span class="N">Отсутствует</span>';
						}
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
					
				?>
				<br><br>
				Звание: <?php 
				if ($roles != NULL and $user['phase'] == "1") {
					if (strpos($roles, '636274085441044489')) {
					// $user->rang = NULL; // Рядовой состав
					$user->bigrang = "Рядовой состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273807589376012')) {
					// $user->rang = NULL; // Сержантский состав
					$user->bigrang = "Сержантский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273574352650240')) {
					// $user->rang = NULL; // Мл. офицерский состав
					$user->bigrang = "Мл. офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273329434656773')) {
					// $user->rang = NULL; // Офицерский состав	
					$user->bigrang = "Офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '698240245149335583')) {
					$user->rang = "Зам. начальника";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636268938631839765')) {
					$user->rang = "Начальник";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636268248186224700')) {
					$user->rang = "Командир";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267521997144086')) {
					$user->rang = "Тренер 1-го ранга";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '941259701700685856')) {
					$user->rang = "Тренер 2-го ранга";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '941259711364345889')) {
					$user->rang = "Тренер 3-го ранга";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '745142892355649657')) {
					$user->rang = "Главврач";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '745142845672915005')) {
					$user->rang = "Капитан 3-го класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267840537755657')) {
					$user->rang = "Командир первого класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '725828334575026268')) {
					$user->rang = "Капитан 2-го класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267285337604148')) {
					$user->bigrang = NULL;
					$user->rang = "Военврач 3-го ранга";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '725828326253658193')) {
					$user->bigrang = NULL;
					$user->rang = "Капитан 1-го класса";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636266998032105502')) {
					$user->bigrang = NULL;
					$user->rang = "Клон коммандер";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636266583567892485')) {
					$user->bigrang = NULL;
					$user->rang = "Военврач 2-го ранга";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650205871552331776')) {
					$user->bigrang = NULL;
					$user->rang = "Адмирал флота";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650205254494978048')) {
					$user->bigrang = NULL;
					$user->rang = "Клон маршал";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650205933225639957')) {
					$user->bigrang = NULL;
					$user->rang = "Военврач 1-го ранга";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650206724287889433')) {
					$user->legion = "Без легиона";
					$user->rang = "Советник";
					echo '<span class="E">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636271352591941632')) {
					$user->legion = "Без легиона";
					$user->rang = "Кадет";
					echo '<span class="N">'. $user['rang'] . '</span>'; 
				}  else {
					if ($user['bigrang'] == "Рядовой состав" and $user['rang'] != NULL) {
						echo '<span class="R">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Сержантский состав" and $user['rang'] != NULL) {
						echo '<span class="S">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Мл. офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="MO">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="O">'. $user['rang'] . '</span>'; 
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Кадет") {
						echo '<span class="N">'. $user['rang'] . '</span>'; 
					} else if (($user['legion'] == "Без легиона" and $user['rang'] == "Советник") and ($user['number'] == "2563")) {
						echo '<span class="A">'. $user['rang'] . '</span>'; 
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
				} 
			 	} else if ($roles != NULL and $user['phase'] == "2") {
					 $c = 1;
					if (strpos($roles, '530382067167657984')) {
					// $user->rang = NULL; // Рядовой состав
					$user->bigrang = "Рядовой состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530388776124547092')) {
					// $user->rang = NULL; // Капральский состав
					$user->bigrang = "Капральский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530382020451368962')) {
					// $user->rang = NULL; // Сержантский состав
					$user->bigrang = "Сержантский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530382190186463252')) {
					// $user->rang = NULL; // Старше-сержантский состав
					$user->bigrang = "Старше-сержантский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530381962511253514')) {
					// $user->rang = NULL; // Мл. офицерский состав
					$user->bigrang = "Мл. офицерский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530381907163217926') or strpos($roles, '944640382317240360')) {
					// $user->rang = NULL; // Офицерский состав
					$user->bigrang = "Офицерский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '758375394667003974')) {
					// $user->rang = NULL; // Офицерский состав
					$user->bigrang = "Инструкторы";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530386071670751242')) {
					$user->rang = "Командир";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530386137370460160')) {
					$user->rang = "Командир первого класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530386077769531392')) {
					$user->rang = "Коммандер";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530385530718781450')) {
					$user->rang = "Маршал-коммандер";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530531632172761119')) {
					if (strpos($roles, '780540907522883594')) {
						$user->rang = "Адмирал";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else {
						$user->bigrang = "КМД ИПК";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} if (strpos($roles, '538377815062478858')) {
					if (strpos($roles, '780540907522883594')) {
						$user->rang = "Военврач 1-го ранга";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else {
						$user->bigrang = "КМД МЕД";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} if (strpos($roles, '538346330465239050')) {
					if (strpos($roles, '780540907522883594')) {
						$user->rang = "Начальник ОДИСБ";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else {
						$user->bigrang = 'КМД ОДИСБ';
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} if (strpos($roles, '530388056797216790')) { 
					if (strpos($roles, '780540907522883594')) { // Глава подразделения
						$user->rang = "Каминоанский инструктор 1-го ранга";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else { // Другие кмд
						$user->bigrang = 'КМД Инструкторы';
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} else {
					if (($user['bigrang'] == "Рядовой состав" or $user['bigrang'] == "Капральский состав") and $user['rang'] != NULL) {
						echo '<span class="R">'. $user['rang'] . '</span>'; 
					} else if (($user['bigrang'] == "Сержантский состав" or $user['bigrang'] == "Старше-сержантский состав") and $user['rang'] != NULL) {
						echo '<span class="S">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Мл. офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="MO">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="O">'. $user['rang'] . '</span>'; 
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Кадет") {
						echo '<span class="N">'. $user['rang'] . '</span>'; 
					} else if (($user['legion'] == "Без легиона" and $user['rang'] == "Советник") and ($user['number'] == "2563" or $user['number'] == "7266")) {
						echo '<span class="A">'. $user['rang'] . '</span>'; 
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Советник") {
						echo '<span class="E">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Инструкторы" and $user['rang'] != NULL) {
						echo '<span class="MO">'. $user['rang'] . '</span>'; 
					} else if ($user['rang'] == NULL and $c == "1") {
						echo '<span class="N">Отсутствует</span>';
					} 
				}
				} else {
					echo '<span class="R">Отсутствует</span>'; 
				}
				R::store($user);
				
			?>
				<?php 
				if ($user['rang'] == NULL and $user['legion'] == NULL) {
					echo '<br>';
					echo '<br>';
					if ($user['phase'] == 1) {
						echo '<span style="display:inline-block;width:610px;max-width:100%;" class = "alert-box">Для получения легиона и звания напишите в дискорд сервер команду !verify в канале #4at (Для этого нужна привязка Steam и Discord) </span>';
					} else {
						echo '<span style="display:inline-block;width:610px;max-width:100%;" class = "alert-box">Для получения легиона и звания напишите в дискорд сервер команду !login в канале #команды-боту (Для этого нужна привязка Steam и Discord) </span>';
					}
				}  
				?>
				</p>
				<?php 
				if ($user['phase'] == 1) {
					$roles = R::findOne('roles', 'discordid = ?', [$user['dsid']]); 
				} else {
					$roles = R::findOne('roles2', 'discordid = ?', [$user['dsid']]);  
				}
				if ($roles != NULL and $user['dsav'] != NULL) {
					$role = showdis($user, $roles, $user['phase'], true);
					// if ($role == false) {
					// 	$user['rang'] = NULL;
					// 	R::store($user);
						// header('Location: https://swrpngg.space/profile');
						// $role = true;
					// }
				}
				?>
			</div>
			<figure class="highcharts-figure">
				<div id="container"></div>
				<div style="display:flex;justify-content:center;flex-direction:column;align-items:center;">
					<?php if ($onl != true) {
						echo '<div class ="alert-box" style="background:rgb(157, 192, 0, 0.5);border:2px solid green;">Погрешность счёта онлайна может составлять менее 5 минут</div>';
					}
					?>
					
				</div>
			</figure>
			
			
			<?php if($user['bigrang'] == "Капральский состав" or $user['bigrang'] == "Рядовой состав" or $user['bigrang'] == "Сержантский состав" or $user['bigrang'] == "Старше-сержантский состав" or $user['bigrang'] == "Мл. офицерский состав" or $user['bigrang'] == "Офицерский состав" or $user['bigrang'] == "КМД ОДИСБ" or $user['bigrang'] == "КМД ИПК" or $user['bigrang'] == "КМД Инструкторы" or $user['bigrang'] == "КМД МЕД" or $user['bigrang'] == "Инструкторы") : ?>
			<h1 style="display:flex;justify-content:center;text-align:center;">Укажите свои данные на SWRP Phase <?php echo $_SESSION['logged_user']->phase ?></h1>
			<div class ="alert-box" style="max-width:100%;">
				
				<p>
					Указывайте свои настоящие данные! Иначе ваш аккаунт может быть удалён!
				</p>
			</div>
				<div class="text-prof">
				
			<?php 
				function saverang($phase) {
				$data = $_POST;
				$user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $_SESSION['logged_user']->number, ':ph' => $phase]);
					if(isset($data['save'])) {
						$errors = array();
						
						if(trim($data['rang']) == "") {
							$errors[] = 'Выберите звание!';
						}
						if(!empty($errors)) {
							echo '<div class="alert-box"><p>'. array_shift($errors) . '</p></div>';
						} else {
							$user->rang = $data['rang'];
							R::store($user);
							header('Location: https://swrpngg.space/profile');
							exit;
						}
					}
				}
			?>
			<?php
				if ($user['phase'] == "1") {
					if ($user['bigrang'] == "Рядовой состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Рядовой-рекрут">';
							echo '<label for="check-rang1">Рядовой-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Рядовой">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Рядовой первого класса">';
							echo '<label for="check-rang3">Рядовой первого класса</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Специалист">';
							echo '<label for="check-rang4">Специалист</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Капрал">';
							echo '<label for="check-rang5">Капрал</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Интерн">';
							echo '<label for="check-rang1">Интерн</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Практикант">';
							echo '<label for="check-rang2">Практикант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
								
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Пилот-рекрут">';
							echo '<label for="check-rang1">Пилот-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Пилот">';
							echo '<label for="check-rang2">Пилот</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Старшина">';
							echo '<label for="check-rang3">Старшина</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Сержантский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Штаб-сержант">';
							echo '<label for="check-rang2">Штаб-сержант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Сержант первого класса">';
							echo '<label for="check-rang3">Сержант первого класса</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Мастер сержант">';
							echo '<label for="check-rang4">Мастер сержант</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Первый сержант">';
							echo '<label for="check-rang5">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang6" name="rang" value="Сержант-майор">';
							echo '<label for="check-rang6">Сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang7" name="rang" value="Команд сержант-майор">';
							echo '<label for="check-rang7">Команд сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang8" name="rang" value="Сержант-майор сухопутных войск">';
							echo '<label for="check-rang8">Сержант-майор сухопутных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Ординатор">';
							echo '<label for="check-rang1">Ординатор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший ординатор">';
							echo '<label for="check-rang2">Старший ординатор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Первый сержант">';
							echo '<label for="check-rang2">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Сержант-майор воздушных войск">';
							echo '<label for="check-rang3">Сержант-майор воздушных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Мл. офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Мл. лейтенант">';
							echo '<label for="check-rang1">Мл. лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант">';
							echo '<label for="check-rang2">Лейтенант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Военфельдшер">';
							echo '<label for="check-rang1">Военфельдшер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший военфельдшер">';
							echo '<label for="check-rang2">Старший военфельдшер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант флота">';
							echo '<label for="check-rang1">Лейтенант флота</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Прапорщик">';
							echo '<label for="check-rang2">Прапорщик</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Тренера") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Контрактный тренер">';
							echo '<label for="check-rang1">Контрактный тренер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Тренер-практикант">';
							echo '<label for="check-rang2">Тренер-практикант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Тренер">';
							echo '<label for="check-rang3">Тренер</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Старший тренер">';
							echo '<label for="check-rang4">Старший тренер</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Тренер спец. назначения">';
							echo '<label for="check-rang5">Тренер спец. назначения</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Стажёр">';
							echo '<label for="check-rang1">Стажёр</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Смотритель">';
							echo '<label for="check-rang2">Смотритель</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Оперативник">';
							echo '<label for="check-rang3">Оперативник</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Старший оперативник">';
							echo '<label for="check-rang4">Старший оперативник</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Дознаватель">';
							echo '<label for="check-rang5">Дознаватель</label>';
							
							echo '<input type="checkbox" id="check-rang6" name="rang" value="Руководитель">';
							echo '<label for="check-rang6">Руководитель</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Капитан">';
							echo '<label for="check-rang1">Капитан</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Майор">';
							echo '<label for="check-rang2">Майор</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Подполковник">';
							echo '<label for="check-rang3">Подполковник</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Полковник">';
							echo '<label for="check-rang4">Полковник</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Врач">';
							echo '<label for="check-rang1">Врач</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Полевой врач">';
							echo '<label for="check-rang2">Полевой врач</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Хирург">';
							echo '<label for="check-rang3">Хирург</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Военный хирург">';
							echo '<label for="check-rang4">Военный хирург</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант-коммандер">';
							echo '<label for="check-rang1">Лейтенант-коммандер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Коммандер">';
							echo '<label for="check-rang2">Коммандер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} 
					}
				} else if ($user['phase'] == "2") {
					if ($user['bigrang'] == "Рядовой состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Рядовой-рекрут">';
							echo '<label for="check-rang1">Рядовой-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Рядовой">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Рядовой первого класса">';
							echo '<label for="check-rang3">Рядовой первого класса</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Ассистент">';
							echo '<label for="check-rang1">Ассистент</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Пилот-рекрут">';
							echo '<label for="check-rang1">Пилот-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Пилот">';
							echo '<label for="check-rang2">Пилот</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Пилот первого класса">';
							echo '<label for="check-rang3">Пилот первого класса</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Стажер">';
							echo '<label for="check-rang1">Стажер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Капральский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Специалист">';
							echo '<label for="check-rang1">Специалист</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Капрал">';
							echo '<label for="check-rang2">Капрал</label>';

							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Специалист">';
							echo '<label for="check-rang1">Специалист</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Капрал">';
							echo '<label for="check-rang2">Капрал</label>';

							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший смотритель">';
							echo '<label for="check-rang1">Младший смотритель</label>';

							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Сержантский состав") {
						if($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Штаб-сержант">';
							echo '<label for="check-rang2">Штаб-сержант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Мастер сержант">';
							echo '<label for="check-rang3">Мастер сержант</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Первый сержант">';
							echo '<label for="check-rang4">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Сержант-майор">';
							echo '<label for="check-rang5">Сержант-майор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Интерн">';
							echo '<label for="check-rang1">Интерн</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Ординатор">';
							echo '<label for="check-rang2">Ординатор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Штаб-сержант">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Мастер сержант">';
							echo '<label for="check-rang3">Мастер сержант</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Первый сержант">';
							echo '<label for="check-rang4">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Сержант-майор">';
							echo '<label for="check-rang5">Сержант-майор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Смотритель">';
							echo '<label for="check-rang1">Смотритель</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший смотритель">';
							echo '<label for="check-rang2">Старший смотритель</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Смотритель первого класса">';
							echo '<label for="check-rang3">Смотритель первого класса</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Оперативник">';
							echo '<label for="check-rang4">Оперативник</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Старше-сержантский состав") {
						if($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Команд сержант-майор">';
							echo '<label for="check-rang1">Команд сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Сержант-майор сухопутных войск">';
							echo '<label for="check-rang2">Сержант-майор сухопутных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший военфельдшер">';
							echo '<label for="check-rang1">Младший военфельдшер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Военфельдшер">';
							echo '<label for="check-rang2">Военфельдшер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Команд сержант-майор">';
							echo '<label for="check-rang1">Команд сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Сержант-майор воздушных войск">';
							echo '<label for="check-rang2">Сержант-майор воздушных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Мл. офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший лейтенант">';
							echo '<label for="check-rang1">Младший лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант">';
							echo '<label for="check-rang2">Лейтенант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Старший военфельдшер">';
							echo '<label for="check-rang1">Старший военфельдшер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Прапорщик">';
							echo '<label for="check-rang1">Прапорщик</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Младший лейтенант">';
							echo '<label for="check-rang2">Младший лейтенант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Бригадир">';
							echo '<label for="check-rang1">Бригадир</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Инструкторы") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший инструктор">';
							echo '<label for="check-rang1">Младший инструктор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Капитан">';
							echo '<label for="check-rang1">Капитан</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Майор">';
							echo '<label for="check-rang2">Майор</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Подполковник">';
							echo '<label for="check-rang3">Подполковник</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Полковник">';
							echo '<label for="check-rang4">Полковник</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Полевой врач">';
							echo '<label for="check-rang1">Полевой врач</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Врач">';
							echo '<label for="check-rang2">Врач</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Хирург">';
							echo '<label for="check-rang3">Хирург</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Военный хирург">';
							echo '<label for="check-rang4">Военный хирург</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант">';
							echo '<label for="check-rang1">Лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант-коммандер">';
							echo '<label for="check-rang2">Лейтенант-коммандер</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Командир">';
							echo '<label for="check-rang3">Командир</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Капитан">';
							echo '<label for="check-rang4">Капитан</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Надзиратель">';
							echo '<label for="check-rang1">Надзиратель</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} else if ($user['legion'] == "Инструкторы") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Инструктор">';
							echo '<label for="check-rang1">Инструктор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший инструктор">';
							echo '<label for="check-rang2">Старший инструктор</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Оперативный инструктор">';
							echo '<label for="check-rang3">Оперативный инструктор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
						} 
					} elseif ($user['bigrang'] == "КМД ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший контр-адмирал">';
							echo '<label for="check-rang1">Младший контр-адмирал</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Контр-адмирал">';
							echo '<label for="check-rang2">Контр-адмирал</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Вице адмирал">';
							echo '<label for="check-rang3">Вице адмирал</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
					} elseif ($user['bigrang'] == "КМД МЕД") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Главврач">';
							echo '<label for="check-rang1">Главврач</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Военрвач 3-го ранга">';
							echo '<label for="check-rang2">Военрвач 3-го ранга</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Военрвач 2-го ранга">';
							echo '<label for="check-rang3">Военрвач 2-го ранга</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang($user['phase']);
							
							echo '</form>';
					} elseif ($user['bigrang'] == "КМД Инструкторы") {
						echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
						echo '<div style="display:flex;flex-direction:column;text-align:center;">';
						echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
						
						echo '<input type="checkbox" id="check-rang1" name="rang" value="Каминоанский инструктор 3-го ранга">';
						echo '<label for="check-rang1">Каминоанский инструктор 3-го ранга</label>';
						
						echo '<input type="checkbox" id="check-rang2" name="rang" value="Каминоанский инструктор 2-го ранга">';
						echo '<label for="check-rang2">Каминоанский инструктор 2-го ранга</label>';
						
						echo '</div>';
						echo '<div>';
							echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
						echo '</div>';
						saverang($user['phase']);
						
						echo '</form>';
					} elseif ($user['bigrang'] == "КМД ОДИСБ") {
						echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
						echo '<div style="display:flex;flex-direction:column;text-align:center;">';
						echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
						
						echo '<input type="checkbox" id="check-rang1" name="rang" value="Первый заместитель начальника">';
						echo '<label for="check-rang1">Первый заместитель начальника</label>';
						
						echo '<input type="checkbox" id="check-rang2" name="rang" value="Второй заместитель начальника">';
						echo '<label for="check-rang2">Второй заместитель начальника</label>';
						
						echo '</div>';
						echo '<div>';
							echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
						echo '</div>';
						saverang($user['phase']);
						
						echo '</form>';
					} elseif ($user['bigrang'] == "Инструкторы") {
						echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
						echo '<div style="display:flex;flex-direction:column;text-align:center;">';
						echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
						
						echo '<input type="checkbox" id="check-rang1" name="rang" value="Инструктор практикант">';
						echo '<label for="check-rang1">Инструктор практикант</label>';
						
						echo '<input type="checkbox" id="check-rang2" name="rang" value="Младший инструктор">';
						echo '<label for="check-rang2">Младший инструктор</label>';
						
						echo '<input type="checkbox" id="check-rang3" name="rang" value="Инструктор">';
						echo '<label for="check-rang3">Инструктор</label>';

						echo '<input type="checkbox" id="check-rang4" name="rang" value="Старший инструктор">';
						echo '<label for="check-rang4">Старший инструктор</label>';
						
						echo '<input type="checkbox" id="check-rang5" name="rang" value="Оперативный инструктор">';
						echo '<label for="check-rang5">Оперативный инструктор</label>';

						echo '</div>';
						echo '<div>';
							echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
						echo '</div>';
						saverang($user['phase']);
						
						echo '</form>';
					}
				}
			?>
			</div>
		</div>
	</div>
	<?php else : ?>
			</div>
		</div>
	<?php endif; ?>
	<?php else : ?>
		<div class ="content">
			<?php echo '<div class ="alert-box"> Для начала войдите в аккаунт! </div>'; ?>
		</div>
	<?php endif; ?>

<?php 
require __DIR__ . '/footer.php'; 
?>