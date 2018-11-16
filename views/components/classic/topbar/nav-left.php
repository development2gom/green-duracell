<?php
use yii\helpers\Url;
?>
<div class="nav-duracell nav-left">
  <h1 class="logo-duracell">
    <img src="<?= Url::base() ?>/webAssets/images/duracell.png" alt="">
  </h1>
  <?php
  if(!Yii::$app->user->isGuest){
?>
<a style="position: absolute;right: 23px;" class="btn btn-primary btn-logout" href="<?=Url::base()."/site/logout"?>">
<i class="icon ion-ios-log-out" aria-hidden="true"></i>
</a>
<?php
  }

  ?>
</div>