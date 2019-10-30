<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-wight, initial-scalle=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css\style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Контактная форма</title>
  <style>
  body { background: #FFFFFF }
  </style>
</head>
<body>

  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm"; style="background: url(jpg/1.jpg)">
    <h5 class="my-0 mr-md-auto font-weight-normal" style="color:#FFFFFF">Абонентская книга</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <?php
        if($_COOKIE['user'] == 'true'):
       ?>
           <a class="p-2 text-white" href="/adm.php">Главная</a>
            <a class="p-2 text-white" href="/about.php">Связь с разработчиком</a>
        <?php else: ?>
          <a class="p-2 text-white" href="/">Главная</a>
      <a class="p-2 text-white" href="/about.php">Связь с разработчиком</a>
        <?php endif; ?>
  
    </nav>
<?php require "blocks/cookie.php" ?>
  </div>

<div class="container" mt-5>

<h3>Контактная форма</h3>
<form action="check.php" method="post">
  <input type="email" name="email" placeholder="Введите Email"
  class="form-control"><br>
  <textarea name="message" class="form-control"
  placeholder="Введите ваше сообщение"></textarea><br>
  <button type="submit" name="send" class="btn btn-primary">Отправить</button>
</form>

</div>
<?php require "blocks/footer.php" ?>
</body>
</html>
