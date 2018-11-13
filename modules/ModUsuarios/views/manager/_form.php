<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-ajax',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]);?>
    
    <?= $form->field($model, 'txt_username')->textInput(["class" => "form-control", "placeholder" => "Nombre Completo"])->label(false) ?>

    <?= $form->field($model, 'num_edad')->textInput(["class" => "form-control", "placeholder" => "Edad"])->label(false) ?>

    <?= $form->field($model, 'txt_telefono')->textInput(["class" => "form-control", "placeholder" => "Teléfono celular"])->label(false) ?>

    <?= $form->field($model, 'txt_email')->textInput(["class" => "form-control", "placeholder" => "Correo electrónico"])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(["class" => "form-control", "placeholder" => "Crear contraseña"])->label(false) ?>

    <?= $form->field($model, 'repeatPassword')->passwordInput(["class" => "form-control", "placeholder" => "Confirmar contraseña"])->label(false) ?>


    <div class="form-group form-group-actions">
        <?= Html::submitButton(' ', ['class' => "btn btn-primary btn-enviar"]) ?>
	</div>

    <!-- <div class="form-group necesito-cuenta">
        ¿Tienes una cuenta? <a href="<?=Url::base()?>/login">Ingresa</a>
    </div> -->


<?php ActiveForm::end(); ?>

