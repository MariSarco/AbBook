<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-wight, initial-scalle=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css\style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>AbBook</title>
  <style>
  body { background: #FFFFFF }
  </style>
</head>
<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm"; style="background: url(jpg/1.jpg)">
    <h5 class="my-0 mr-md-auto font-weight-normal" style="color:#FFFFFF">Абонентская книга</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-white" href="/">Главная</a>
      <a class="p-2 text-white" href="/about.php">Связь с разработчиком</a>
    </nav>

  </div>

<div class="container">

<h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
<input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus=""><br>
<input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required=""><br>
<div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Запомнить
    </label>
<a class="btn btn-lg btn-primary btn-block"  href="adm.php">Войти</a>
<?php
if($_COOKIE['user'] == 'true')
;
else
setcookie('user', 'true', time() + 3600,'/');
 ?>
  </div>



</div>
<?php require "blocks/footer.php" ?>
</body>
</html>
