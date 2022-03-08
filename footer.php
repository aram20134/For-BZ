<div id = "cockies">
	<p> Данный сайт использует файлы COOKIE для корректной работы. Продолжая использование сайта вы соглашаетесь с тем, что мы используем COOKIE. </p>
	<button class ="acp">Хорошо</button>
</div>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script>
function checkCookies(){
    let cookieDate = localStorage.getItem('cookieDate');
    let cookieNotification = document.getElementById('cockies');
    let cookieBtn = cookieNotification.querySelector('.acp');

    if( !cookieDate || (+cookieDate + 31536000000) < Date.now() ){
        cookieNotification.classList.add('show');
    }

    cookieBtn.addEventListener('click', function(){
        localStorage.setItem( 'cookieDate', Date.now() );
        cookieNotification.classList.add('hide');
    })
}
checkCookies();
</script>
</body>
</html>

<footer>
	<div class="foot-phase">
	<div class ="img-content-l">
	<img class="img-foot" src="img/phase1/clone1.png">
	</div>
	<div class="foot-cont">
		<p>Star Wars RP Phase 1 <br> 185.97.254.212:27024</p>
			<div>
				<a href="http://discord.gg/sJ8Ardr"><img src ="img/discord2.png" class="ico-foot"></a>
			</div>
	</div>
	</div>
	<div class="foot-phase">
		<div class="foot-cont">
			<p>Star Wars RP Phase 2 <br> 185.97.254.212:27025 </p>
			<div>
				<a href="http://discord.gg/DTQDQdJ"><img src ="img/discord2.png" class="ico-foot"></a>
			</div>
		</div>
		<div class ="img-content-r">
		<img class="img-foot" src="img/phase2/clone2.png">
		</div>
	</div>
</footer>
