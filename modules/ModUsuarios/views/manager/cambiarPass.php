<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Cambiar contraseña';
$this->params['classBody'] = "page-login-v3 layout-full login-page";

?>


<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-login">

	<img class="pd-login-img-texto" src="<?= Url::base() ?>/webAssets/images/ingresar/texto.png" alt="">

	<div class="pd-login-conejo">

		<img src="<?= Url::base() ?>/webAssets/images/ingresar/conejo.png" alt="">


        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, "placeholder" => "Nueva contraseña"])->label(false) ?>

            <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true, "placeholder" => "Confirmar contraseña"])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Cambiar contraseña' : 'Actualizar contraseña', ['class' => $model->isNewRecord ? 'btn btn-primary btn-recuperar' : 'btn btn-primary btn-recuperar']) ?>
            </div>

        <?php ActiveForm::end(); ?>

	</div>

</div>
