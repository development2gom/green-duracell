<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\assets\AppAsset;

$this->title = "Ganador";
?>

<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-ganador">

    <div class="pd-ganador-textos">
        <!-- <h3>¡Felicidades!</h3>
        <h5>Duracell te regala</h5>
        <h4>$100 pesos en STARBUCKS </h4> -->
        <!-- <h6>Serie 3</h6> -->

        <?php
        echo $beneficio->txt_leyenda;
        ?>
    </div>    

    <div class="pd-ganador-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/regalos.png" alt="">
    </div>

    <div class="pd-ganador-codigo">

        <div>
            <!-- <p>Envía tu ticket de compra y el código ganador al correo electrónico <span>promociones@publicidadgreen.com.mx</span> o llámanos al <span>01 800 467 1897</span>.</p>
            <h3>CÓDIGO</h3> -->
            <?php
            echo $beneficio->txt_codigo_leyenda;
            echo "<h4>".$ticket->txt_codigo."</h4>";
            ?>
            <?php
            if($ticket->id_beneficio==4 && $ticket->codigoGanador){
            ?>
             <h3>PIN</h3>
            <h4><?=$ticket->codigoGanador->txt_pin?></h4>
            <?php
            }
            ?>
        </div>

        <h6>Válido hasta: <span><?=$beneficio->txt_vigencia;?></span></h6>    

       <a class="btn btn-primary btn-registar-otro" href="<?=Url::base()?>">Registrar otro ticket</a>
    </div> 

</div>