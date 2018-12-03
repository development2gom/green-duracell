<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\AccessControlExtend;
use app\models\EntTickets;
use app\modules\ModUsuarios\models\Utils;
use app\models\Mensajes;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\models\ResponseServices;
use app\models\EntProductos;
use app\models\ConstantesWeb;
use app\models\CatBeneficios;
use app\models\Calendario;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
        // return [
        //     'access' => [
        //         'class' => AccessControlExtend::className(),
        //         'only' => ['logout', 'about'],
        //         'rules' => [
        //             [
        //                 'actions' => ['logout'],
        //                 'allow' => true,
        //                 'roles' => ['admin'],
        //             ],

        //         ],
        //     ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        //];
    //}

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionTest(){
         //$auth = Yii::$app->authManager;

        //  // add "updatePost" permission
        //  $updatePost = $auth->createPermission('about');
        //  $updatePost->description = 'Update post';
        //  $auth->add($updatePost);
        //         // add "admin" role and give this role the "updatePost" permission
        // // as well as the permissions of the "author" role
        // $admin = $auth->createRole('test');
         //$auth->add($admin);
        // $auth->addChild($admin, $updatePost);

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        // $usuario = Yii::$app->user->identity;
        // $auth = \Yii::$app->authManager;
        // $authorRole = $auth->getRole('test');
        // $auth->assign($authorRole, $usuario->getId());
        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionConstruccion(){

        $this->layout = "classic/topBar/mainBlank";

        return $this->render("construccion");
    }



    public function actionGetcontrollersandactions()
    {
        $controllerlist = [];
        if ($handle = opendir('../controllers')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                    $controllerlist[] = $file;
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        $fulllist = [];
        foreach ($controllerlist as $controller):
            $handle = fopen('../controllers/' . $controller, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    if (preg_match('/public function action(.*?)\(/', $line, $display)):
                        if (strlen($display[1]) > 2):
                            $fulllist[strtolower(substr($controller, 0, -14))][] = strtolower($display[1]);
                        endif;
                    endif;
                }
            }
            fclose($handle);
        endforeach;

        print_r($fulllist);
        exit;
        return $fulllist;
    }

    public function actionGenerarPass($p){
        echo Yii::$app->security->generatePasswordHash($p);
        exit;
    }

    public function actionRegistrarTicket(){
        $usuario = Yii::$app->user->identity;
        $ticket = new EntTickets();
        // print_r($usuario);exit;

        if ($ticket->load(Yii::$app->request->post())){
            $ticket->id_usuario = $usuario->id_usuario;
            $ticket->uddi = Utils::generateToken('tck');

            if($ticket->save()){
                $mensajes = new Mensajes();
                $link = Yii::$app->urlManager->createAbsoluteUrl([
					'/site/ganador?token='.$ticket->uddi
				]);
				$urlCorta = $this->getShortUrl($link);

				//if(){
                    $mensajes->mandarMensage('Se ha registrado tu ticket. Ingrese para revisar su premio. '.$urlCorta, $usuario->txt_telefono);
                    $this->redirect(['ganador', 'token'=>$ticket->uddi]);
                // }else{
                // //     echo 'error mensaje';exit;
                //  }
            }else{
                print_r($ticket->errors);
                echo 'error';exit;
            }
        }

        return $this->render('registro-ticket', [
            'ticket' => $ticket
        ]);
    }

    public function actionGanador($token = null){
        if(!$token){
            throw new BadRequestHttpException;
        }

        $ticket = EntTickets::find()->where(['uddi'=>$token])->one();
        $beneficio = $ticket->beneficio;
        if(!$beneficio || !$ticket->id_codigo){
           return $this->redirect(["premios-agotados"]);
        }

        if(!$ticket){
            throw new BadRequestHttpException;
        }

        $fecha = Calendario::getFechaActual();

        return $this->render('ganador',[
            'beneficio' => $beneficio,
            'ticket' => $ticket
        ]);
    }

    private function getShortUrl($url)
	{
		$urlAutenticate = 'http://dgom.mobi';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlAutenticate);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=userGreenSaco&pass=passGreenSacro&app=GreenSacro&url=' . $url);
		curl_setopt($ch, CURLOPT_POSTREDIR, 3);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		
		// in real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS,
		// http_build_query(array('postvar1' => 'value1')));
		
		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close($ch);
		return $server_output;
    }
    
    public function actionAvisoPrivacidad(){
        
        return $this->render('aviso-privacidad');
    }

    public function actionTerminosCondiciones(){
        
        return $this->render('terminos-condiciones');
    }

    public function actionExportarUsuariosCsv(){
        $nuevoFichero = fopen('Usuario.csv', 'w+');
        fputs($nuevoFichero, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));

        if($nuevoFichero){
            $usuarios = EntUsuarios::find()->all();
            
            $delimiter = ",";
            $campos = [
                'Nombre',
                'Edad',
                'Telefono',
                'txt_email',
                'Premio',
                'Token premio'
            ];
        }

            fputcsv($nuevoFichero, $campos, $delimiter);

            foreach($usuarios as $usuario){
                $datos = [
                    $usuario->txt_username,
                    $usuario->num_edad,
                    $usuario->txt_telefono,
                    $usuario->txt_email,
                    null,
                    null
                ];

                fputcsv($nuevoFichero, $datos, $delimiter);
            }
            fseek($nuevoFichero, 0);
            header('Content-Type: text/csv');
            header("Content-disposition: attachment; filename=\"Localidades.csv\"");

            fpassthru($nuevoFichero);exit;
    }

    public function actionGuardarTickets(){ 
        $response = new ResponseServices();
        $usuario = Yii::$app->user->identity;

        if(isset($_POST['sucursal']) && isset($_POST['codigo_ticket']) && isset($_POST['productos']) && isset($_POST['codigo_barras']) && isset($_POST['seriales'])){
            $transaction = Yii::$app->db->beginTransaction();
            $errores = [];

            $beneficio = CatBeneficios::getBeneficio();

            $ticket = new EntTickets();
            $ticket->id_usuario = $usuario->id_usuario;
            $ticket->uddi = Utils::generateToken('tck_');
            $ticket->txt_sucursal = $_POST['sucursal'];
            $ticket->txt_codigo_ticket = $_POST['codigo_ticket'];
            $ticket->id_beneficio = $beneficio->id_beneficio;

            $codigo = EntTickets::generarCodigo($beneficio->id_beneficio);
            $ticket->txt_codigo = $codigo->txt_codigo;
            $ticket->id_codigo = $codigo->id_beneficio_codigo;
            

            $validarProd = true;
            foreach($_POST['productos'] as $key => $value){ 
                try{
                    if(!$ticket->save()){
                        $transaction->rollBack();
                        $response->result = $ticket->firstErrors;

                        return $response;
                    }

                    $productoConstante = ConstantesWeb::PRODUCTOS[$value];

                    $producto = new EntProductos();
                    $producto->id_ticket = $ticket->id_ticket;
                    $producto->uddi = Utils::generateToken('prod_');
                    $producto->txt_codigo_barras = $_POST['codigo_barras'][$key];
                    $producto->txt_serial = $_POST['seriales'][$key];
                    $producto->txt_nombre = $productoConstante['txt_prod'];

                    $usuario->num_puntuacion += $productoConstante['num_valor'];

                    if(!$usuario->save()){
                        $transaction->rollBack();
                        $response->result = $usuario->errors;
                    }
                    
                    if(!$producto->save()){
                        $transaction->rollBack();
                        
                        $errores[$key] = $producto->errors;
                        $validarProd = false;
                        
                        $response->result = $errores;
                    }else{
                        $array1 = [
                            'txt_codigo_barras' => '',
                            'txt_serial' => ''
                        ];
                        $errores[$key] = json_encode($array1);
                    }
                    
                }catch(\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
            if(!$validarProd){
                return $response;
            }

            $transaction->commit();

            // $mensajes = new Mensajes();
            // $link = Yii::$app->urlManager->createAbsoluteUrl([
            //     '/site/ganador?token='.$ticket->uddi
            // ]);
            // $urlCorta = $this->getShortUrl($link);

            // $mensajes->mandarMensage('Se ha registrado tu ticket. Ingrese para revisar su premio. '.$urlCorta, $usuario->txt_telefono);

            $response->status = "success";
            $response->message = "Se guardo correctamente el ticket y los productos";
            $response->result = $ticket;
        }
        
        return $response;
    }

    public function actionPremiosAgotados(){
        
        return $this->render('premios-agotados');
    }
public function actionTester()
{
    $prueva = EntUsuarios::asignarGanador();
    return $prueva;
}
}
