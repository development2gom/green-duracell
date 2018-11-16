<?php
use yii\helpers\Url;
use app\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = "Dashboard";

$this->params['classBody'] = "site-navbar-small";

$this->registerJsFile(
    '@web/webAssets/js/index.js',
    ['depends' => [AppAsset::className()]]
);
?>

<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-ingresar">

    <img class="pd-ingresar-img-texto" src="<?= Url::base() ?>/webAssets/images/ingresar/texto.png" alt="">

    <div class="pd-ingresar-conejo">
        <img src="<?= Url::base() ?>/webAssets/images/ingresar/conejo.png" alt="">
        <a href="<?= Url::base() ?>/login" class="btn btn-primary btn-ingresar"></a>
    </div>

    <div class="pd-ingresar-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div> 

</div>