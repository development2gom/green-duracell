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

        <?php $form = ActiveForm::begin([
            'id' => 'js-form-ticket',
            'options' => [
                'data-url' => Url::base()
            ]
            
        ]);?>

            <?= $form->field($ticket, 'txt_sucursal')->textInput(["class" => "form-control form-control-blue", "placeholder" => "Sucursal"])->label(false) ?>

            <?= $form->field($ticket, 'txt_codigo_ticket')->textInput(["class" => "form-control form-control-yellow", "placeholder" => "Código de ticket"])->label(false) ?>

            <div class="row js_div_clone">
                <div class="md-col-4">
                    <?= Html::dropDownList('productos[]', null, [
                        "AA 4+2pz"=>"AA 4+2pz",
                        "AAA 4+2pz"=>"AAA 4+2pz",
                        "AA 2pz"=>"AA 2pz",
                        "AAA 2pz"=>"AAA 2pz",
                        "C 2pz"=>"C 2pz",
                        "D 2pz"=>"D 2pz",
                        "9V 1pz"=>"9V 1pz",
                    ], ["class" => "form-control", "placeholder" => "Producto que compraste"]) ?>
                </div>
                <div class="md-col-4">
                    <input type="text" class="form-control form-control-yellow" placeholder="Código de barras" name="codigo_barras[]">
                </div>
                <div class="md-col-4">
                    <input type="text" class="form-control form-control-yellow" placeholder="Serial" name="seriales[]">                
                </div>
            </div>
            <div class="row js_nuevo_clone">

            </div>

            <button class="btn btn-default js_ingresar_producto">Ingresar mas producto</button>

            <div class="form-group form-group-actions">
                <?= Html::button(' ', ['class' => "btn btn-primary btn-guardar js-btn-guardar"]) ?>
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