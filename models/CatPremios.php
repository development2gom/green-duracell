<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\web\HttpException;

/**
 * This is the model class for table "cat_premios".
 *
 * @property string $id_premio
 * @property string $num_periodo
 * @property string $txt_fecha
 * @property string $txt_descripcion
 * @property int $num_volumen
 * @property int $b_habilitado
 */
class CatPremios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_premios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_periodo', 'num_volumen', 'b_habilitado'], 'integer'],
            [['txt_fecha', 'txt_descripcion'], 'required'],
            [['txt_fecha'], 'safe'],
            [['txt_descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_premio' => 'Id Premio',
            'num_periodo' => 'Num Periodo',
            'txt_fecha' => 'Txt Fecha',
            'txt_descripcion' => 'Txt Descripcion',
            'num_volumen' => 'Num Volumen',
            'b_habilitado' => 'B Habilitado',
        ];
    }
    public static function getPremio()
    {
        $premio = self::find()->where(['b_habilitado'=>1])->andwhere(['>','num_volumen',0])
        ->andWhere(new Expression('date_format(now(),"%Y-%m-%d")=date_format(txt_fecha,"%Y-%m-%d")'))->one();
        if(!$premio)
        {
            throw new HttpException(404,'No se encontro el premio');
        }
        return $premio;
    }
}
