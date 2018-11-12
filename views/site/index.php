<?php
use yii\helpers\Url;
use app\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = "Dashboard";

$this->params['classBody'] = "site-navbar-small dashboard";

$this->registerJsFile(
    '@web/webAssets/js/index.js',
    ['depends' => [AppAsset::className()]]
);
?>