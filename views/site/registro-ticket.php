<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;

$this->registerJsFile(
    '@web/webAssets/js/site/ticket.js',
    ['depends' => [AppAsset::className()]]
);
?>

<?php
$form = ActiveForm::begin();?>

    <?= $form->field($ticket, 'txt_sucursal')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($ticket, 'txt_codigo_ticket')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($ticket, 'txt_codigo_barras')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($ticket, 'txt_productos')->textInput(["class" => "form-control"]) ?>

    <?= $form->field($ticket, 'num_productos')->textInput(["class" => "form-control"]) ?>

    <div class="form-group form-group-actions">
        <?= Html::submitButton('Guardar', ['class' => "btn btn-primary btn-block btn-lg"]) ?>
	</div>

<?php ActiveForm::end(); ?>
