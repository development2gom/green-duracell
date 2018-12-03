<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

use app\models\CatPremios;

/**
 * This is the model class for table "rel_usuario_premio".
 *
 * @property string $id_usuario_premio
 * @property string $id_usuario
 * @property string $id_premio
 *
 * @property CatPremios $premio
 * @property ModUsuariosEntUsuarios $usuario
 */
class RelUsusarioPremio extends \yii\db\ActiveRecord
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
    // public static function asignarGanador()
    // {
    //     $puntuacion = EntUsuarios::find()->where(['id_status'=>2])->orderby('num_puntuacion DESC')->one();
    //     $premio = CatPremios::getPremio();
        
    //     if($puntuacion && $premio)
    //     {
    //         $this->id_usuario = $puntuacion->id_usuario;
    //         $this->id_premio = $premio->id_premio;
    //         $this->save();
    //     }
    //     return $puntuacion.' '.$premio;
    // }
}
