<?php
namespace app\models;

use Yii;
class Email{
  
	public $emailHtml;
	public $emailText;
	public $from;
	public $to;
	public $subject;
	public $params;

	const EMAIL_GANADOR = 1;
	const TEMPLATE_GANADOR = "@app/modules/ModUsuarios/email/ganador";

	function __construct($tipoEmail) {
		$this->from = Yii::$app->params ['modUsuarios'] ['email'] ['emailActivacion']; 
		$this->setEmailHtml($tipoEmail);
	}

	public function setEmailHtml($tipoEmail){
		switch ($tipoEmail) {
			case self::EMAIL_GANADOR:
				$this->emailHtml = self::TEMPLATE_GANADOR;
				break;
			
			default:
				# code...
				break;
		}
	}

	/**
	 * Envia mensaje de correo electronico
	 *   	
	 * @return boolean
	 */
	public function sendEmail($to, $subject, $params) {
		return Yii::$app->mailer->compose ( [
				// 'html' => '@app/mail/layouts/example',
				// 'text' => '@app/mail/layouts/text'
				'html' => $this->emailHtml,
				//'text' => $templateText 
		], $params )->setFrom ( $this->from )->setTo ( $to )->setSubject ( $subject )->send ();
	}
}