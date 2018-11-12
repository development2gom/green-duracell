<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="latin-message latin-unsoported">
    <div class="latin-message-cont l-un">
        <div class="l-un-textos">
            
            <img src="<?=Url::base()?>/webAssets/images/img-unsuported.png" alt="" class="l-un-textos-img">

            <h2 class="l-un-textos-title">
                Sorry, but this web browser isn't supported yet.
            </h2>
            <h3 class="l-un-textos-subtitle">Please join from Google Chrome</h3>

            <hr>

            <p class="l-un-textos-copy-link">Copy & paste this link Google Chrome on your computer</p>

            <a class="l-un-textos-a-link" href="#" target="_blank">https://sitio.com</a>

            <div class="l-un-textos-chrome">
                <img src="<?=Url::base()?>/webAssets/images/img-chrome.png" alt="">
                <p>Don't have Chrome?</p>
                <a href="" target="_blank">Install it for free.</a>
            </div>

        </div>
        <div class="l-un-footer">
            <p>&copy; 2018 Proyecto.</p>
        </div>
    </div>
</div>