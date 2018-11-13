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
                $url = Url::base(true) . '/site/ganador?token='.$ticket->uddi;

				if($mensajes->mandarMensage('Se ha registrado tu ticket. Ingrese para revisar su premio. '.$url, $usuario->txt_telefono)){
                    
                    $this->redirect(['ganador', 'token'=>$ticket->uddi]);
                }else{
                    echo 'error mensaje';exit;
                }
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
        if(!$ticket){
            throw new BadRequestHttpException;
        }

        return $this->render('ganador');
    }


    public function actionAvisoPrivacidad(){
        
        return $this->render('aviso-privacidad');
    }

    public function actionTerminosCondiciones(){
        
        return $this->render('terminos-condiciones');
    }
}
