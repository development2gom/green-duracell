<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;

$this->registerJsFile(
    '@web/webAssets/js/site/ticket.js',
    ['depends' => [AppAsset::className()]]
);
?>

<?= $this->render("//components/classic/topbar/nav-right")?>

<div class="pd-registro-ticket">

    <div class="pd-registro-ticket-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/regalos.png" alt="">
    </div>

    <div class="pd-registro-ticket-form">

        <h3>Registra tu ticket</h3>

        <?php $form = ActiveForm::begin();?>

            <?= $form->field($ticket, 'txt_sucursal')->textInput(["class" => "form-control form-control-blue", "placeholder" => "Sucursal"])->label(false) ?>

            <?= $form->field($ticket, 'txt_codigo_ticket')->textInput(["class" => "form-control form-control-yellow", "placeholder" => "Código de ticket"])->label(false) ?>

            <?= $form->field($ticket, 'txt_codigo_barras')->textInput(["class" => "form-control form-control-red", "placeholder" => "Código de barras de empaque"])->label(false) ?>

            <?= $form->field($ticket, 'txt_productos')->textInput(["class" => "form-control", "placeholder" => "Producto que compraste"])->label(false) ?>

            <?= $form->field($ticket, 'num_productos')->textInput(["class" => "form-control", "placeholder" => "Cantidad de producto"])->label(false) ?>

            <div class="form-group form-group-actions">
            <?= Html::submitButton(' ', ['class' => "btn btn-primary btn-guardar"]) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <div class="pd-registro-ticket-form-actions">
            <a class="pd-registro-ticket-form-link" href="">Términos y condiciones</a>
            <a class="pd-registro-ticket-form-link" href="">Aviso de Privacidad</a>
        </div>
    
    </div>

    <div class="pd-registro-ticket-example"></div>

    <div class="pd-registro-ticket-super-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div>    

</div>