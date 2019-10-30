<?php
  if($_COOKIE['user'] == 'true'):
 ?>
     <h5 class="mr-md-3 font-weight-normal" style="color:#FFFFFF">Администратор</h5>
      <a class="btn btn-outline-danger" href="blocks/boof.php" >Выйти</a>
  <?php else: ?>
    <a class="btn btn-outline-light" href="join.php">Войти</a>

  <?php endif; ?>
