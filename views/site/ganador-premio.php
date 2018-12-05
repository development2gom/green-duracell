<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AppAsset;

$this->title = "Ganador";
?>

<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-ganador">

    <div class="pd-ganador-textos pd-ganador-premio-imagen">
       <img src="<?= Url::base() ?>/webAssets/images/ganador/premio-ipad.png" alt="">
    </div>    

    <div class="pd-ganador-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/regalos.png" alt="">
    </div>

    <div class="pd-ganador-codigo">

        <div>
            <p>Envía tu ticket de compra y el código ganador al correo electrónico <span>promociones@publicidadgreen.com.mx</span> o llámanos al <span>01 800 467 1897</span>.</p>
        </div>

        <h6>Válido hasta: <span>28 de Febrero de 2019</span></h6> 

    </div> 

</div>