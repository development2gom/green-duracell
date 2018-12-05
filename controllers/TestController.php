<?php
namespace app\controllers;

use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;

class TestController  extends Controller{
    public function actionGanador(){
        EntUsuarios::getUsuarioGanadorFase('','');
    }
}