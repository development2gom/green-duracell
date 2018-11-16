<?php
use yii\helpers\Url;
?>
<div class="nav-duracell nav-right">
  <h1 class="logo-duracell">
    <img src="<?= Url::base() ?>/webAssets/images/duracell.png" alt="">
  </h1>
  <?php
  if(!Yii::$app->user->isGuest){
?>
<a style="position: absolute;left: 23px;" class="btn btn-success" href="<?=Url::base()."site/logout"?>">Salir</a>
<?php
  }

  ?>
  
</div>