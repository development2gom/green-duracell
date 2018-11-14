<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
// $this->params['classBody'] = "";

?>

<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-login">

	<img class="pd-login-img-texto" src="<?= Url::base() ?>/webAssets/images/ingresar/texto.png" alt="">

	<div class="pd-login-conejo">
		<img src="<?= Url::base() ?>/webAssets/images/ingresar/conejo.png" alt="">

		<?php 
		$form = ActiveForm::begin([
		'id' => 'form-ajax',
		'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		]);
		?>

			<?= $form->field($model, 'username')->textInput(["class" => "form-control form-control-name", "placeholder" => "Nombre"])->label(false) ?>

			<?= $form->field($model, 'password')->passwordInput(["class" => "form-control form-control-pass", "placeholder" => "Contraseña"])->label(false) ?>



			<div class="form-group form-group-actions">
				<?= Html::submitButton('<span class="ladda-label"> </span>', ["data-style" => "zoom-in", 'class' => 'btn btn-primary btn-login ladda-button', 'name' => 'login-button']); ?>
			</div>

		<?php ActiveForm::end(); ?>

		<div class="pd-login-form-actions">
            <a class="pd-login-form-link" href="<?= Url::base() ?>/sign-up">Crear cuenta</a>
        </div>

	</div>

		

</div>