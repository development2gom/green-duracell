<?php

namespace app\modules\ModUsuarios\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\modules\ModUsuarios\models\Utils;
use kartik\password\StrengthValidator;
use yii\web\UploadedFile;
use app\models\Email;
use app\models\AuthItem;
use app\models\Calendario;
use app\models\CatPremios;
use yii\db\Query;
use yii\db\Expression;
use app\models\EntTickets;
use app\models\RelUsuarioPremio;
use yii\web\HttpException;

/**
 * This is the model class for table "ent_usuarios".
 *
 * @property string $id_usuario
 * @property string $txt_token
 * @property string $txt_username
 * @property string $txt_apellido_paterno
 * @property string $txt_apellido_materno
 * @property string $txt_auth_key
 * @property string $txt_password_hash
 * @property string $txt_password_reset_token
 * @property string $txt_email
 * @property string $fch_creacion
 * @property string $fch_actualizacion
 * @property string $id_status
 *
 * @property EntSesiones[] $entSesiones
 * @property CatStatusUsuarios $idStatus
 * @property EntUsuariosActivacion[] $entUsuariosActivacions
 * @property EntUsuariosCambioPass[] $entUsuariosCambioPasses
 * @property EntUsuariosFacebook $entUsuariosFacebook
 */
class EntUsuarios extends \yii\db\ActiveRecord implements IdentityInterface

{
	const STATUS_PENDIENTED = 1;
	const STATUS_ACTIVED = 2;
	const STATUS_BLOCKED = 3;
	const USUARIO_REGISTRADO = "usuario-normal";
	public $password;
	public $repeatPassword;
	public $repeat;
	public $repeatEmail;
	public $image;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'mod_usuarios_ent_usuarios';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			// [
			// 	'repeatEmail',
			// 	'compare',
			// 	'compareAttribute' => 'txt_email',
			// 	'on' => 'registerInput',
			// 	'message' => 'Los email deben coincidir'
			// ],

			[
				[
					'password',
					'txt_auth_item'
				], 'trim',
			],

			[


				[
					'txt_username',
					'txt_email',
					'txt_auth_item',
					'password',
					'num_edad',
					'txt_telefono'
				],
				'required',

				'on' => 'create',
				'message' => 'Campo requerido'
			],

			[

				[
					'txt_username',
					'txt_email',
					'txt_auth_item',
					'password',
					'num_edad',
					'txt_telefono'
				],
				'required',
				'on' => 'update',
				'message' => 'Campo requerido'
			],







			[
				['txt_email', 'repeatEmail'], 'email',
				'on' => 'registerInput',

			],
			[
				'repeatPassword',
				'compare',
				'compareAttribute' => 'password',
				'on' => 'cambiarPass',
				'message' => 'Las contraseñas deben coincidir'
			],
			[
				'repeatPassword',
				'compare',
				'compareAttribute' => 'password',
				'on' => 'registerInput',
				'message' => 'Las contraseñas deben coincidir'
			],
			[
				'txt_email',
				'trim'
			],
			[
				'txt_username',
				'trim'
			],
			[
				[
					'id_status',
					'num_puntuacion',
					'id_premio'
				],
				'integer'
			],
			[
				[
					'txt_username',
					'txt_email',
					'num_edad',
					'txt_telefono'
				],
				'required',
				'on' => 'registerInput',
				'message' => 'Campo requerido'
			],
				// [ 
				// 		[ 
				// 				'password'
				// 		],
				// 		// StrengthValidator::className (),
				// 		// 'min' => 10,
				// 		// 'digit' => 2,
				// 		// 'special' => 2,
				// 		// 'upper'=>2,
				// 		// 'lower'=>2,
				// 		// 'special'=>2,
				// 		// 'hasUser'=>false,
						
				// ],
			[
				[
					'password',
					'repeatPassword'
				],
				'required',
				'on' => 'registerInput',
				'message' => 'Campo requerido'
			],
			[
				[
					'password',
					'repeatPassword'
				],
				'required',
				'on' => 'cambiarPass',
				'message' => 'Campo requerido'
			],
			[
				[
					'fch_creacion',
					'fch_actualizacion'
				],
				'safe'
			],
			[
				[
					'txt_username',
					'txt_password_hash',
					'txt_password_reset_token',
					'txt_email'
				],
				'string',
				'max' => 255,
				'message' => 'Solo puede ingresar 255 caracteres'
			],
			[
				[
					'txt_apellido_paterno',
					'txt_apellido_materno'
				],
				'string',
				'max' => 30,
				'message' => 'Solo puede ingresar 30 caracteres'
			],
			[
				[
					'txt_auth_key'
				],
				'string',
				'max' => 32
			],
			[
				[
					'txt_email'
				],
				'unique',
				'message' => 'El email ya se encuentra registrado'
			],
			[
				[
					'txt_token'
				],
				'unique'
			],
			[
				[
					'txt_password_reset_token',
					'txt_email',
					'txt_telefono'
				],
				'unique'
			],
			[
				[
					'id_status'
				],
				'exist',
				'skipOnError' => true,
				'targetClass' => CatStatusUsuarios::className(),
				'targetAttribute' => [
					'id_status' => 'id_status'
				]
				],
				['txt_email', 'email'],
				[['txt_telefono'], 'string', 'max'=>10, 'min'=>10, 'tooLong'=>'El numero de celular debe contener 10 dígitos','tooShort'=>'El numero de celular debe contener 10 dígitos'],
				
				[['num_edad'], 'integer', 'max'=>99, 'min'=>0, 'tooBig'=>'La edad no puede ser mayor a 99 años','tooSmall'=>'La edad no puede ser menor a 0 años'],
			
				

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id_usuario' => 'Id Usuario',
			'txt_token' => 'Txt Token',
			'txt_username' => 'Nombre completo',
			'txt_apellido_paterno' => 'Apellido Paterno',
			'txt_apellido_materno' => 'Apellido Materno',
			'num_edad' => 'Edad',
			'txt_telefono' => 'Telefono celular',
			'txt_auth_key' => 'Txt Auth Key',
			'txt_password_hash' => 'Txt Password Hash',
			'txt_password_reset_token' => 'Txt Password Reset Token',
			'txt_email' => 'Email',
			'fch_creacion' => 'Fch Creacion',
			'fch_actualizacion' => 'Fch Actualizacion',
			'id_status' => 'Status',
			'repeatEmail' => 'Repetir email',
			'repeatPassword' => 'Repetir contraseña',
			'password' => 'Contraseña',
			
		];
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getTickets()
	{
		return $this->hasMany(EntTickets::className(), [
			'id_usuario' => 'id_usuario'
		]);
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntSesiones()
	{
		return $this->hasMany(EntSesiones::className(), [
			'id_usuario' => 'id_usuario'
		]);
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdStatus()
	{
		return $this->hasOne(CatStatusUsuarios::className(), [
			'id_status' => 'id_status'
		]);
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntUsuariosActivacions()
	{
		return $this->hasMany(EntUsuariosActivacion::className(), [
			'id_usuario' => 'id_usuario'
		]);
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntUsuariosCambioPasses()
	{
		return $this->hasMany(EntUsuariosCambioPass::className(), [
			'id_usuario' => 'id_usuario'
		]);
	}

	/**
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getEntUsuariosFacebook()
	{
		return $this->hasOne(EntUsuariosFacebook::className(), [
			'id_usuario' => 'id_usuario'
		]);
	}

	/**
	 * INCLUDE USER LOGIN VALIDATION FUNCTIONS*
	 */
	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * @inheritdoc
	 */
	/* modified */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne([
			'access_token' => $token
		]);
	}
	
	/*
	 * removed
	 * public static function findIdentityByAccessToken($token)
	 * {
	 * throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	 * }
	 */
	/**
	 * Finds user by username
	 *
	 * @param string $username        	
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne([
			'txt_username' => $username
		]);
	}

	/**
	 * Finds user by email
	 *
	 * @param string $email        	
	 * @return EntUsuarios|null
	 */
	public static function findByEmail($username)
	{
		return static::findOne([
			'txt_email' => $username,
			'id_status' => self::STATUS_ACTIVED
		]);
	}

	/**
	 * Busca un usuario por token
	 * @param string $token
	 * @return EntUsuarios|null
	 */
	public static function findByToken($token)
	{
		return static::findOne([
			'txt_token' => $token,
		]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token
	 *        	password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		$expire = \Yii::$app->params['user.txt_passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = ( int )end($parts);
		if ($timestamp + $expire < time()) {
			// token expired
			return null;
		}

		return static::findOne([
			'txt_password_reset_token' => $token
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->txt_auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password
	 *        	password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->txt_password_hash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password        	
	 */
	public function setPassword($password)
	{
		$this->txt_password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->txt_auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->txt_password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->txt_password_reset_token = null;
	}
	/**
	 * EXTENSION MOVIE *
	 */

	/**
	 * Guarda al usuario en la base de datos
	 *
	 * @return EntUsuarios
	 */
	public function signup($isFacebook = false)
	{

		if (!$this->validate()) {
			return false;
		}

		$this->image = UploadedFile::getInstance($this, 'image');

		$this->txt_token = Utils::generateToken('usr');
		$this->txt_auth_item = 'usuario-normal';

		if ($this->image) {
			$this->txt_imagen = $this->txt_token . "." . $this->image->extension;
			if (!$this->upload()) {
				return false;
			}
		}

		if (!$this->txt_auth_item) {
			$this->txt_auth_item = self::USUARIO_REGISTRADO;
		}

		$this->setPassword($this->password);
		$this->generateAuthKey();
		$this->fch_creacion = Calendario::getFechaActual();


		$this->id_status = self::STATUS_ACTIVED;


		if ($this->save()) {

			$this->guardarRoleUsuario();

			return true;
		} else {
			return false;
		}

	}

	public function guardarRoleUsuario()
	{

		$auth = \Yii::$app->authManager;
		$authorRole = $auth->getRole($this->txt_auth_item);
		$auth->assign($authorRole, $this->getId());
	}


	public function upload()
	{
		$path = "profiles/" . $this->txt_token;
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		if ($this->image->saveAs($path . "/" . $this->txt_imagen)) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Agregamos los datos para el usuario
	 *
	 * @param unknown $dataUsuario        	
	 */
	public function addDataFromFaceBook($dataUsuario)
	{
		$this->txt_username = $dataUsuario['profile']['first_name'];
		$this->txt_apellido_paterno = $dataUsuario['profile']['last_name'];
		$this->txt_email = $dataUsuario['profile']['email'];
		$this->id_tipo_usuario = 1;

		return $this;
	}

	/**
	 * Obtiene el nombre completo del usuario
	 *
	 * @return string
	 */
	public function getNombreCompleto()
	{
		return $this->txt_username;
	}

	public function getNombreCorto()
	{
		return $this->txt_username;
	}

	public function getNombreAbreviado()
	{

		return null;
	}

	/**
	 * Actualiza el status del usuario a activado
	 *
	 * @return EntUsuarios|null
	 */
	public function activarUsuario()
	{
		$this->id_status = self::STATUS_ACTIVED;
		return $this->save() ? $this : null;
	}

	/**
	 * Actualiza el status del usuario a bloqueado
	 *
	 * @return EntUsuarios|null
	 */
	public function bloquearUsuario()
	{
		$this->id_status = self::STATUS_BLOCKED;
		return $this->save() ? $this : null;
	}

	/**
	 * Si la imagen esta vacia mandamos una por default
	 *
	 * @return string
	 */
	public function getImageProfile()
	{
		$basePath = Yii::getAlias('@web');

		$usuarioFacebook = $this->entUsuariosFacebook;

		if (empty($usuarioFacebook)) {
			if ($this->txt_imagen) {
				return $basePath . '/profiles/' . $this->txt_token . "/" . $this->txt_imagen;
			}

			return $basePath . '/webAssets/images/site/user.png';
		}

		return 'http://graph.facebook.com/' . $usuarioFacebook->id_facebook . '/picture';

	}

	public function isRegisterFaceBook()
	{
		$usuarioFacebook = $this->entUsuariosFacebook;

		if (empty($usuarioFacebook)) {
			return false;
		} else {
			return $usuarioFacebook;
		}
	}


	/**
	 * Envia email de activación
	 */
	public function enviarEmailActivacion($params = [])
	{
		$activacion = new EntUsuariosActivacion();
		$activacion->saveUsuarioActivacion($this->id_usuario);
		
		// Parametros para el email
		$params['url'] = Yii::$app->urlManager->createAbsoluteUrl([
			'activar-cuenta/' . $activacion->txt_token
		]);
		$params['user'] = $this->getNombreCompleto();

		try {
			$email = new Email();
			$email->emailHtml = "@app/modules/ModUsuarios/email/activarCuenta";
			$email->emailText = "@app/modules/ModUsuarios/email/layouts/text";
			$email->to = $this->txt_email;
			$email->subject = "Activación de cuenta";
			$email->params = $params;
			
			// Envio de correo electronico
			$email->sendEmail();
			return true;
		} catch (\Exception $e) {

			return false;
		}

	}

	public function enviarEmailBienvenida()
	{
		
		// Parametros para el email
		$params['url'] = Yii::$app->urlManager->createAbsoluteUrl([
			'ingresar/' . $this->txt_token
		]);
		$params['user'] = $this->nombreCompleto;
		$params['email'] = $this->txt_email;
		$params['password'] = $this->password;

		try {
			$email = new Email();
			$email->emailHtml = "@app/modules/ModUsuarios/email/bienvenida";
			$email->emailText = "@app/modules/ModUsuarios/email/layouts/text";
			$email->to = $this->txt_email;
			$email->subject = "Bienvenido";
			$email->params = $params;
			
			// Envio de correo electronico
			$email->sendEmail();
			return true;
		} catch (\Exception $e) {

			return false;
		}

	}

	public function getRoleDescription()
	{

		return $this->txtAuthItem->description;
	}


	public static function getUsuarioLogueado()
	{
		$usuarioLogueado = Yii::$app->user->identity;
		if (!$usuarioLogueado) {
			$usuarioLogueado = new EntUsuarios();
		}
		return $usuarioLogueado;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTxtAuthItem()
	{
		return $this->hasOne(AuthItem::className(), ['name' => 'txt_auth_item']);
	}

	public function randomPassword()
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];


		}
		return implode($pass);
	}
	public static function getUsuarioGanadorGlobal()
	{
		$puntuacion = self::find()->where(['id_status'=>2])->orderby('num_puntuacion DESC')->one();
		return $puntuacion;
	}

	public static function getUsuarioByFase(){
		
	}

	public static function getUsuarioGanadorFase(){
		$fase = CatPremios::getFase();
		
		if($fase){
			$rows = (new \yii\db\Query())
				->select(['T.id_usuario', 'PP.num_puntos'])
				->from('ent_tickets T ')
				->join('join', '(
					select P.id_ticket, sum(P.num_puntos) as num_puntos 
					FROM ent_productos P
					GROUP BY P.id_ticket
				) PP', 'PP.id_ticket = T.id_ticket')
				->where(['between', 'T.fch_registro', $fase->fch_inicio, $fase->fch_final])
				->orderBy('PP.num_puntos DESC')
				->limit(1)
				->one();
			if($rows){
				return self::find()->where(["id_usuario"=>$rows["id_usuario"]])->one();
			}
			throw new HttpException(404, "No hay fase disponible");
		}else{
			throw new HttpException(404, "No hay fase disponible");
		}

	}

	public function enviarEmailGanador($relUsuarioPremio){
		
		if($relUsuarioPremio){
			$params=[
				"user"=>$this->nombreCompleto,
				"idPremio"=>$relUsuarioPremio->id_premio,
				"url"=>$params['url'] = Yii::$app->urlManager->createAbsoluteUrl([
					'site/ganador-premio?token=' . $relUsuarioPremio->txt_token
				])
			];
			$email = new Email(Email::EMAIL_GANADOR);
			$email->sendEmail("humberto@2gom.com.mx", "Felicidades ganaste", $params);
		}
		
	}


	public function colocarPremio()
	{
		$premio = CatPremios::getPremio();
		$relUsuarioPremio = null;
		if($premio){
			$relUsuarioPremio = new RelUsuarioPremio();
			$relUsuarioPremio->id_premio = $premio->id_premio;
			$relUsuarioPremio->id_usuario = $this->id_usuario;
			$relUsuarioPremio->txt_token = Utils::generateToken("pr_");
			if(!$relUsuarioPremio->save()){
				throw new HttpException(500, "Error Processing Request".print_r($relUsuarioPremio->errors));
				
			}
		}else{
			throw new HttpException(500, "No hay premios disponibles");
		}
		return $relUsuarioPremio;
	}

}
