<?
$data = $_GET;
if ($data['phase'] == 1 and $data['page'] != 0) {
	$title = '[SWRP] Логи Phase 1'; 
} else if ($data['phase'] == 2 and $data['page'] != 0) {
	$title = '[SWRP] Логи Phase 2'; 
} else {
	$title = '[SWRP] Ошибка';
	$dead = true;
}
require __DIR__ . '/header2.php';
?>
<h1 style="text-align:center">Логи Phase <? echo $data['phase'] ?> за последние 3 дня</h1>
<div class="content" style="color:white;align-items:flex-start;">
    <div style="margin:5px;">Для поиска по дате или по нику используйте поиск через сочетание клавиш [CTRL] + [F]</div>
    
    <div id ="logi"></div>
	<?php if ($dead != true) : ?>
		<script>
        function getlogs () {
            $.ajax({
                url: './refs/getlogs.php',
                method: 'get',
                dataType: 'html',
                async: false,
                data: {phase: <?php echo $data['phase'];?>, page: <? echo $data['page'];?>},
                success: function(data){
					$('#logi').html(data);
                    setTimeout(getlogs, 60000);
                }
            });
        }
        getlogs();
    </script>
	<?php else : ?>
		<div class="alert-box">Ошибка! Такой страницы не существует!</div>
	<?php endif; ?>
</div>
<?php 
require __DIR__ . '/footer.php'; 
?>