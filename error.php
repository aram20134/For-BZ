<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        background: #061b32;
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction:column;
        height:100%;
        width:100%;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    p {
        color:white;
        font-size: 28px;
        margin:10px;
    }
    #log {
        animation: logo 5s infinite linear;
    }
    @keyframes logo {
    0% {
        transform: rotateZ(0deg);
    }

    100% {
        transform: rotateZ(360deg);
    }
}
</style>

<head>
    <title>Ошибка</title>
</head>

<body>
    <img id="log" src="img/logo.png" style="height:300px;" />
    <p>Сайт находится на техобслуживании, доступ скоро будет восстановлен</p>
    <p style="font-size:20px;"></p>
</body>