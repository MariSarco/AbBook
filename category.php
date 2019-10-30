<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-wight, initial-scalle=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css\style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrapformhelpers/css/bootstrap-formhelpers.min.css">
  <title>Контактная форма</title>
  <style>
  body { background: #FFFFFF }
  </style>
</head>
<body>

  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm"; style="background: url(jpg/1.jpg)">
    <h5 class="my-0 mr-md-auto font-weight-normal" style="color:#FFFFFF">Абонентская книга</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-white" href="/adm.php">Главная</a>
      <a class="p-2 text-white" href="/about.php">Связь с разработчиком</a>
    </nav>
  <?php require "blocks/cookie.php" ?>
  </div>

<div class="container" mt-5>

<h3>Добавление новой категории</h3>
<div class="col-md-3 order-md-1">

      <form class="needs-validation" novalidate="">
        <div class="row">
          <div class=" mb-3">
            <label for="firstName">Название категории</label>
            <input type="text" class="form-control" id="category" placeholder="" value="" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Добавить</button>
      </form>
    </div>

</div>
<?php require "blocks/footer.php" ?>
</body>
</html>
