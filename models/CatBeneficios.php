<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_beneficios".
 *
 * @property int $id_beneficio
 * @property string $txt_nombre
 * @property string $txt_leyenda
 * @property string $txt_codigo_leyenda
 * @property int $num_cantidad
 *
 * @property EntTickets[] $entTickets
 */
class CatBeneficios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_beneficios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['txt_nombre'], 'required'],
            [['num_cantidad'], 'integer'],
            [['txt_nombre'], 'string', 'max' => 100],
            [['txt_leyenda', 'txt_codigo_leyenda'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_beneficio' => 'Id Beneficio',
            'txt_nombre' => 'Txt Nombre',
            'txt_leyenda' => 'Txt Leyenda',
            'txt_codigo_leyenda' => 'Txt Codigo Leyenda',
            'num_cantidad' => 'Num Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntTickets()
    {
        return $this->hasMany(EntTickets::className(), ['id_beneficio' => 'id_beneficio']);
    }

    public static function getBeneficio()
    {
        $beneficio = self::find()->where(['num_cantidad'>0])->orderBy('rand()')->one();
        return $beneficio;
        
    }
}
