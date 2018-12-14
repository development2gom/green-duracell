<?php

namespace app\models;

use Yii;
use yii\web\HttpException;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "rel_usuario_premio".
 *
 * @property int $id_usuario_premio
 * @property int $id_usuario
 * @property int $id_premio
 *
 * @property CatPremios $premio
 * @property EntUsuarios $usuario
 */
class RelUsuarioPremio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_usuario_premio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_premio'], 'required'],
            [['id_usuario', 'id_premio'], 'integer'],
            [['id_premio'], 'exist', 'skipOnError' => true, 'targetClass' => CatPremios::className(), 'targetAttribute' => ['id_premio' => 'id_premio']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_usuario_premio' => 'Id Usuario Premio',
            'id_usuario' => 'Id Usuario',
            'id_premio' => 'Id Premio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPremio()
    {
        return $this->hasOne(CatPremios::className(), ['id_premio' => 'id_premio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(EntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    public static function getRelByToken($token){
        $premioGanado = self::find()->where(["txt_token"=>$token])->one();

        if(!$premioGanado){
            throw new HttpException(404, "Petición no válida");
        }

        return $premioGanado;
    }

    public static function getPremioByToken($token){
        $premioGanado = self::find()->where(["txt_token"=>$token])->one();

        if(!$premioGanado){
            throw new HttpException(404, "Petición no válida");
        }

        return $premioGanado->premio;
    }
}
