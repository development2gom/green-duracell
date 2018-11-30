<?php
use yii\helpers\Url;
use app\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = "Premios Agotados";

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

    <div class="premios-agotados-cont">

        <p class="principal">Los beneficios de la promoción se han agotado.</p>

        <p class="secundario">Te invitamos a seguir registrando tus tickets de compra y blisters Duracell para ganar algunos de los premios quincenales y/o el premio final.</p>

        <div class="pd-aviso-privacidad-btns">
            <a class="btn-regresar" href="<?= Url::base() ?>">Regresar</a>
        </div>

    </div>

    <div class="pd-sign-up-super-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div>    

</div>
