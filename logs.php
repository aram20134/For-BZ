<?
$data = $_GET;
if ($data['phase'] == 1) {
	$title = '[SWRP] Логи Phase 1'; 
} else if ($data['phase'] == 2) {
	$title = '[SWRP] Логи Phase 2'; 
} else {
	$title = '[SWRP] Ошибка';
	$dead = true;
}
require __DIR__ . '/header2.php';
?>
<div class="content" style="color:white;">
	<?php if ($dead != true) : ?>
		<script>
        function getplayers () {
            $.ajax({
                url: './refs/getlogs.php',
                method: 'get',
                dataType: 'html',
                async: false,
                data: {phase: <?php echo $data['phase']; ?>},
                success: function(data){
					$('.content').html(data);
                }
            });
        }
        getplayers();
    </script>
	<?php else : ?>
		<div class="alert-box">Ошибка! Такой страницы не существует!</div>
	<?php endif; ?>
</div>
<?php 
require __DIR__ . '/footer.php'; 
?>