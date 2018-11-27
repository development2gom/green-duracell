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

<?= $this->render("//components/classic/topbar/nav-right")?>

<div class="pd-sign-up">

    <div class="pd-sign-up-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/aviso-privacidad/conejoregalos.png" alt="">
    </div>

    <div class="registro-form-ingresar">

        <img class="registro-form-ingresar-img-duracell" src="<?= Url::base() ?>/webAssets/images/ingresar/text-duracell.png" alt="">
        <a href="<?= Url::base() ?>/login" class="btn btn-primary btn-ingresar">Ingresa aquí</a>

        <img class="registro-form-ingresar-img-ganan" src="<?= Url::base() ?>/webAssets/images/ingresar/texto-ganan.png" alt="">

    </div>

    <div class="pd-sign-up-super-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div>    

</div>
