<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AppAsset;

$this->title = "Ganador";
?>

<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-ganador">

    <div class="pd-ganador-textos">
        <h3>¡Felicidades!</h3>
        <h5>Duracell te regala</h5>
        <h4>$100 pesos en STARBUCKS </h4>
        <!-- <h6>Serie 3</h6> -->
    </div>    

    <div class="pd-ganador-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/regalos.png" alt="">
    </div>

    <div class="pd-ganador-codigo">

        <div>

            <p>Envía tu ticket de compra y el código ganador al correo electrónico <span>promociones@publicidadgreen.com.mx</span> o llámanos al <span>01 800 467 1897</span>.</p>
            <h3>CÓDIGO</h3>
            <h4>545m4hj3j53h</h4>

        </div>

        <h6>Válido hasta: <span>31 de Enero de 2019</span></h6>    
    </div> 

</div>