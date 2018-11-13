<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

$this->title = 'Registrarse';
// $this->params['classBody'] = "";

$this->registerJsFile(
  '@web/webAssets/js/sign-up.js',
  ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<?= $this->render("//components/classic/topbar/nav-right")?>

<div class="pd-sign-up">

    <div class="pd-sign-up-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/aviso-privacidad/conejoregalos.png" alt="">
    </div>

    <div class="pd-sign-up-form">

        <img src="<?= Url::base() ?>/webAssets/images/ingresar/texto.png" alt="">

        <?= $this->render('_form', [
          'model' => $model,
        ]) ?>

        <div class="pd-sign-up-form-actions">
            <a class="pd-sign-up-form-link" href="<?= Url::base() ?>/site/terminos-condiciones">Términos y condiciones</a>
            <a class="pd-sign-up-form-link" href="<?= Url::base() ?>/site/aviso-privacidad">Aviso de Privacidad</a>
        </div>
    
    </div>

    <div class="pd-sign-up-super-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div>    

</div>