<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Recuperar contraseña';
$this->params['classBody'] = "page-login-v3 layout-full login-page";
?>

<?= $this->render("//components/classic/topbar/nav-left")?>

<div class="pd-login">

	<img class="pd-login-img-texto" src="<?= Url::base() ?>/webAssets/images/ingresar/texto.png" alt="">

	<div class="pd-login-conejo">

		<img src="<?= Url::base() ?>/webAssets/images/ingresar/conejo.png" alt="">

		<?php if (Yii::$app->session->hasFlash('success')): ?>
			<div class="alert dark alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
				<?= Yii::$app->session->getFlash('success') ?>
			</div>
		<?php endif; ?>

		<?php 
		$form = ActiveForm::begin([
			'id' => 'login-form'
		]); 
		?>

			<?= $form->field($model, 'username')->textInput(["class" => "form-control form-control-name", "placeholder" => "Correo electrónico"])->label(false) ?>

			<?= Html::submitButton('<span class="ladda-label">Recuperar contraseña</span>', ["data-style"=>"zoom-in", 'class' => 'btn btn-primary btn-recuperar ladda-button', 'name' => 'login-button']) ?>

		<?php ActiveForm::end(); ?>

		<!-- <div class="ayuda-soporte">
			<span>¿Necesitas ayuda? escribe a:</span>
			<a class="no-redirect login-link" href="mailto:soporte@2gom.com.mx?Subject=Solicitud%de%Soporte">soporte@2gom.com.mx</a>
		</div> -->

		<div class="pd-login-form-actions">
            <a class="pd-login-form-link" href="<?= Url::base() ?>/sign-up">Necesito una cuenta</a>
            <a class="pd-login-form-link" href="<?= Url::base() ?>/login">Iniciar sesión</a>
        </div>

	</div>

</div>
