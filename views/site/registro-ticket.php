<?php
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use app\assets\AppAsset;
use app\models\ConstantesWeb;

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

            <div class="form-group">
                <input type="text" id="js-txt-sucursal" class="form-control form-control-blue" placeholder="Sucursal" name="sucursal">
                <p class="help-block help-block-error js-txt_sucursal"></p>
            </div>
            <div class="form-group">
                <input type="text" id="js-txt-codigo-ticket" class="form-control form-control-yellow" placeholder="Código de ticket" name="codigo_ticket">
                <p class="help-block help-block-error js-txt_codigo_ticket"></p>
            </div>
            <div class="form-group form-group-elements js_div_clone">
                <div class="row">
                    <div class="col-md-3 col-padding-right">

                        <?= Html::dropDownList('productos[]', null, [
                            ConstantesWeb::PRODUCTOS['index1']['value'] => ConstantesWeb::PRODUCTOS['index1']['txt_prod'],
                            ConstantesWeb::PRODUCTOS['index2']['value'] => ConstantesWeb::PRODUCTOS['index2']['txt_prod'],
                            ConstantesWeb::PRODUCTOS['index3']['value'] => ConstantesWeb::PRODUCTOS['index3']['txt_prod'],
                            ConstantesWeb::PRODUCTOS['index4']['value'] => ConstantesWeb::PRODUCTOS['index4']['txt_prod'],
                            ConstantesWeb::PRODUCTOS['index5']['value'] => ConstantesWeb::PRODUCTOS['index5']['txt_prod'],
                            ConstantesWeb::PRODUCTOS['index6']['value'] => ConstantesWeb::PRODUCTOS['index6']['txt_prod'],
                            ConstantesWeb::PRODUCTOS['index7']['value'] => ConstantesWeb::PRODUCTOS['index7']['txt_prod']
                        ], ["class" => "form-control", "placeholder" => "Producto que compraste"]) ?>

                        <?php // Html::dropDownList('productos[]', null, [
                        //     "1"=>"AA 4+2pz",
                        //     "AAA 4+2pz"=>"AAA 4+2pz",
                        //     "AA 2pz"=>"AA 2pz",
                        //     "AAA 2pz"=>"AAA 2pz",
                        //     "C 2pz"=>"C 2pz",
                        //     "D 2pz"=>"D 2pz",
                        //     "9V 1pz"=>"9V 1pz",
                        // ], ["class" => "form-control", "placeholder" => "Producto que compraste"]) ?>
                    </div>
                    <div class="col-md-4 col-padding-right">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-green js-codigo_barras" placeholder="Código de barras" name="codigo_barras[]">
                            <p class="help-block help-block-error js-codigo_barras-error" id="js-codigo_barras-0"></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-padding-right">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-pink js-txt_serial" placeholder="Serial" name="seriales[]">                
                            <p class="help-block help-block-error js-txt_serial-error" id="js-txt_serial-0"></p>
                        </div>
                    </div>
                    <div class="col-md-1 col-padding-right col-padding-left">
                        <button type="button" style='display:none' class="btn btn-icon btn-block btn-danger btn-round btn-delete js_quitar_producto"><i class="icon wb-close" aria-hidden="true"></i></button>
                      </div>
                   
                </div>
            </div>
            
            <div class="section-cloner js_nuevo_clone">

            </div>

            <div class="form-group form-group-actions">
                <button class="btn btn-success btn-mas-producto js_ingresar_producto"><i class="icon ion-md-add" aria-hidden="true"></i> Otro producto</button>
                <button class="btn btn-warning btn-ver-imagen" data-target="#modal-example-imagen" data-toggle="modal" type="button"><i class="icon ion-md-image" aria-hidden="true"></i></button>
            </div>

            <div class="form-group form-group-actions form-group-actions-mt-40">
                <?= Html::button('<span class="ladda-label"></span>', [
                    'class' => "btn btn-primary btn-guardar js-btn-guardar ladda-button",
                    "data-style"=>"zoom-in"
                    ]) ?>
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


<div class="modal modal-ejemplo-imagen fade" id="modal-example-imagen" aria-labelledby="modal-example-imagen" role="dialog" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Ejemplo de Ticket</h4>
            </div>
            <div class="modal-body">
                <img src="<?= Url::base() ?>/webAssets/images/example-ticket.png" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>