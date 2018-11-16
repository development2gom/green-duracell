<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;

$this->title = "Registro de ticket";

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

            <?= $form->field($ticket, 'txt_productos')->dropDownList([
                "AA 4+2pz"=>"AA 4+2pz",
                "AAA 4+2pz"=>"AAA 4+2pz",
                "AA 2pz"=>"AA 2pz",
                "AAA 2pz"=>"AAA 2pz",
                "C 2pz"=>"C 2pz",
                "D 2pz"=>"D 2pz",
                "9V 1pz"=>"9V 1pz",
            ], ["class" => "form-control", "placeholder" => "Producto que compraste"])->label(false) ?>

            <?= $form->field($ticket, 'num_productos')->dropDownList(
                [
                    "1"=>"1",
                    "2"=>"2",
                    "3"=>"3",
                    "4"=>"4",
                    "5"=>"5+",
                ],
                ["class" => "form-control", "placeholder" => "Cantidad de producto"])->label(false) ?>

            <div class="form-group form-group-actions">
            <?= Html::submitButton(' ', ['class' => "btn btn-primary btn-guardar"]) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <div class="pd-registro-ticket-form-actions">
            <a class="pd-registro-ticket-form-link" href="<?= Url::base() ?>/site/terminos-condiciones">Términos y condiciones</a>
            <a class="pd-registro-ticket-form-link" href="<?= Url::base() ?>/site/aviso-privacidad">Aviso de Privacidad</a>
        </div>
    
    </div>

    <div class="pd-registro-ticket-example">
        <img src="<?= Url::base() ?>/webAssets/images/registro-ticket/ticket.png" alt="">
    </div>

    <div class="pd-registro-ticket-super-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div>    

</div>