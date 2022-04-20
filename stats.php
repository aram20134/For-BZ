<?php
$title="[SWRP] Статистика";
require __DIR__ . '/header2.php';
?>
<?php
function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}
$bz1 = R::findAll ('medbz', 'phase = ?', ['1']);
$bz2 = R::findAll ('medbz', 'phase = ?', ['2']);

$medbz = array();
$itog = array();
$medbz2 = array();
$itog2 = array();
foreach ($bz1 as $_arr) {
    if (recursive_array_search($_arr['d'].$_arr['m'].$_arr['y'], $medbz) == true) {
        $id = recursive_array_search($_arr['d'].$_arr['m'].$_arr['y'], $medbz);
        $itog[$id]['online'] += $_arr['online'];
        $itog[$id]['count'] += 1;
    } else {
        $medbz[] = $_arr['d'].$_arr['m'].$_arr['y'];
        $itog[] = ["online" => $_arr['online'], "d" => $_arr['d'], "m" => $_arr['m'], "y" => $_arr['y']];
    }
}
foreach ($bz2 as $_arr) {
    if (recursive_array_search($_arr['d'].$_arr['m'].$_arr['y'], $medbz2) == true) {
        $id = recursive_array_search($_arr['d'].$_arr['m'].$_arr['y'], $medbz2);
        $itog2[$id]['online'] += $_arr['online'];
        $itog2[$id]['count'] += 1;
    } else {
        $medbz2[] = $_arr['d'].$_arr['m'].$_arr['y'];
        $itog2[] = ["online" => $_arr['online'], "d" => $_arr['d'], "m" => $_arr['m'], "y" => $_arr['y']];
    }
}
$out = array();
$out2 = array();
foreach ($itog as $key => $val) {
if (!($val['d'].$val['m'].$val['y'] == '23032022')) {
    $a = $val['online'] / $val['count'];
    $out[] = ["d" => $val['d'], "m" => $val['m'], "y" => $val['y'], "online" => (int)$a];
}
}
foreach ($itog2 as $key => $val) {
if (!($val['d'].$val['m'].$val['y'] == '23032022')) {
    $a = $val['online'] / $val['count'];
    $out2[] = ["d" => $val['d'], "m" => $val['m'], "y" => $val['y'], "online" => (int)$a];
}
}
?>
<script src="jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script>
$(document).ready(function(){
    var online = [
        <?php 
            foreach ($out as $key => $value) {
                if (!(date("d").date("m").date("Y") == $value['d'].$value['m'].$value['y'])) {
                    $value['m']--;
                    echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['online'].'],';
                }
            }  
        ?>
    ];

    var online2 = [
        <?php 
            foreach ($out2 as $key => $value) {
                if (!(date("d").date("m").date("Y") == $value['d'].$value['m'].$value['y'])) {
                    $value['m']--;
                    echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['online'].'],';
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
            rangeSelectorZoom: "[Период]",
            downloadPNG: 'Скачать PNG',
            downloadJPEG: 'Скачать JPEG',
            downloadPDF: 'Скачать PDF',
            downloadSVG: 'Скачать SVG',
            printChart: 'Напечатать график'   
        }        
});


    var chart = Highcharts.stockChart('container', {
    	chart: {
    		useHTML: true,
    		backgroundColor: 'transparent',
    		width: 1000,
    	},
        legend: {
            enabled: true,
            backgroundColor: '#FCFFC5',
            borderColor: 'black',
            borderWidth: 2,
            shadow: true,
        },
    	navigator: {
    		enabled: true,
            series: [{
                data: online,
                opacity: 0.5,
                fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[5]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            }, {
                data: online2,
                opacity: 0.5,
                fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[4]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            }],
    	},
    	scrollbar: {
    		enabled: false,
    	},
        rangeSelector: {
            enabled: true, // false by default
            allButtonsEnabled: true,
            selected: '0',
            buttons: [{
                type: 'week',
                count: 1,
                text: 'Неделя',
            }, {
                type: 'all',
                text: 'Всё',
            }],
            buttonTheme: {
            	width: 50,
            	fill: 'none',
            	r: 8,
            	style: {
            		color: 'white',
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
		
        title: {
            text: 'Средний онлайн Phase 1 и Phase 2',
            style: {
            	color: 'white',
            	fontWeight: 'bold'
            },
        },
        yAxis: {
        	opposite: false,
            offset: 15,
            tickWidth: 1,
            tickLength: 10,
            tickAmount: 8,
            min: 0,
            max: 120,
            lineWidth: 2,
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		fontSize:'15px'
        		}
			},
    	},
    	xAxis: {
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		fontSize:'13px'
        		}
			},
    	},
        responsive: {
        	rules: [{
        		condition: {
        			maxWidth:1000
        		},
        		chartOptions: {
        			
        		},
        	}]	
        },
    	plotOptions: {
            area: {
                opacity: 0.7,
            },
        	series: {
            	borderWidth: 1,
            	// color: 'green',
            	lineWidth: 4,
            	dataLabels: {
                	enabled: true,
                	format: '{y}'
            	}
        	}
    	},
        series: [{
            name: 'Средний онлайн Phase 1',
            type: 'area',
            data: online,
            // opacity: 0.5,
            color: 'red',
            tooltip: {
                valueDecimals: 0,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 4,
                fillColor: 'red',
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[5]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
        }, {
            name: 'Средний онлайн Phase 2',
            type: 'area',
            // opacity: 0.5,
            color: 'blue',
            data: online2,
            tooltip: {
                valueDecimals: 0,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 4,
                fillColor: 'blue',
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[4]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
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
<?php 
$bz1 = R::getAssoc('SELECT * FROM bz1');
$bz2 = R::getAssoc('SELECT * FROM bz2');
?>
<script>    
$(document).ready(function(){
    var online = [
        <?php 
            foreach ($bz1 as $key => $value) {
                if (!(date("d").date("m").date("Y") == $value['d'].$value['m'].$value['y'])) {
                    $value['m']--;
                    echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['pick'].'],';
                }
            }  
        ?>
    ];

    var online2 = [
        <?php 
            foreach ($bz2 as $key => $value) {
                if (!(date("d").date("m").date("Y") == $value['d'].$value['m'].$value['y'])) {
                    $value['m']--;
                    echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['pick'].'],';
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
            rangeSelectorZoom: "[Период]",
            downloadPNG: 'Скачать PNG',
            downloadJPEG: 'Скачать JPEG',
            downloadPDF: 'Скачать PDF',
            downloadSVG: 'Скачать SVG',
            printChart: 'Напечатать график'   
        }        
});


    var chart = Highcharts.stockChart('container2', {
    	chart: {
    		useHTML: true,
    		backgroundColor: 'transparent',
    		width: 1000,
    	},
        legend: {
            enabled: true,
            backgroundColor: '#FCFFC5',
            borderColor: 'black',
            borderWidth: 2,
            shadow: true,
        },
    	navigator: {
    		enabled: true,
            series: [{
                data: online,
                opacity: 0.5,
                fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[5]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            }, {
                data: online2,
                opacity: 0.5,
                fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[4]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            }],
    	},
    	scrollbar: {
    		enabled: false,
    	},
        rangeSelector: {
            enabled: true, // false by default
            allButtonsEnabled: true,
            selected: '0',
            buttons: [{
                type: 'week',
                count: 1,
                text: 'Неделя',
            }, {
                type: 'all',
                text: 'Всё',
            }],
            buttonTheme: {
            	width: 50,
            	fill: 'none',
            	r: 8,
            	style: {
            		color: 'white',
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
		
        title: {
            text: 'Пиковый онлайн Phase 1 и Phase 2',
            style: {
            	color: 'white',
            	fontWeight: 'bold'
            },
        },
        yAxis: {
        	opposite: false,
            offset: 15,
            tickWidth: 1,
            tickLength: 10,
            tickAmount: 8,
            min: 0,
            max: 120,
            lineWidth: 2,
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		fontSize:'15px'
        		}
			},
    	},
    	xAxis: {
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		fontSize:'13px'
        		}
			},
    	},
        responsive: {
        	rules: [{
        		condition: {
        			maxWidth:1000
        		},
        		chartOptions: {
        			
        		},
        	}]	
        },
    	plotOptions: {
            area: {
                opacity: 0.7,
            },
        	series: {
            	borderWidth: 1,
            	// color: 'green',
            	lineWidth: 4,
            	dataLabels: {
                	enabled: true,
                	format: '{y}'
            	}
        	}
    	},
        series: [{
            name: 'Пиковый онлайн Phase 1',
            type: 'area',
            data: online,
            // opacity: 0.5,
            color: 'red',
            tooltip: {
                valueDecimals: 0,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 4,
                fillColor: 'red',
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[5]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
        }, {
            name: 'Пиковый онлайн Phase 2',
            type: 'area',
            // opacity: 0.5,
            color: 'blue',
            data: online2,
            tooltip: {
                valueDecimals: 0,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 4,
                fillColor: 'blue',
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[4]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
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
<div class="content">
    <div id="container"></div>
    <div id="container2"></div>
</div>

<?php 
require __DIR__ . '/footer.php'; 
?>