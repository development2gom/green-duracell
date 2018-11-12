<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="<?= Yii::$app->language ?>">
<!-- Etiqueta head -->
<?=$this->render("//components/head")?>
<body class="animsition <?=isset($this->params['classBody'])?$this->params['classBody']:''?>">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <?php $this->beginBody();?>
  
  <?=$this->render("//components/classic/topbar/nav-bar")?>

  <?=$this->render("//components/classic/topbar/menu")?>

  <?=$this->render("//components/classic/topbar/body", ["content"=>$content])?>
  
  <?=$this->render("//components/classic/topbar/footer")?>

  <div id="pleca-cookies" class="pleca-cookies">
    <div class="container-1220">
        <div class="pc-col-textos">
            <p>Utilizamos cookies para personalizar tu experiencia en nuestros sitios web. Al utilizar nuestro sitio, aceptas el uso de cookies tal como se describe en nuestra <a href="<?=Url::base()?>/site/aviso-privacidad">Política de Privacidad</a></p>
        </div>
        <div class="pc-col-button">
            <button class="btn btn-primary js-btn-cookies">OK</button>
        </div>
    </div>
    <span class="pc-close js-pc-close"><i class="ion ion-ios-close-empty"></i></span>
  </div>

  <?= $this->render("//components/unsoported")?>

  <?php $this->endBody();?>
 

  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>
<?php $this->endPage() ?>
