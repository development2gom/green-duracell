<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_beneficios_codigos".
 *
 * @property int $id_beneficio_codigo
 * @property int $id_beneficio
 * @property string $txt_codigo
 * @property int $txt_pin
 * @property string $txt_account_number
 * @property int $b_usado
 *
 * @property CatBeneficios $beneficio
 */
class RelBeneficiosCodigos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_beneficios_codigos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_beneficio'], 'required'],
            [['id_beneficio', 'txt_pin', 'b_usado'], 'integer'],
            [['txt_codigo', 'txt_account_number'], 'string', 'max' => 100],
            [['id_beneficio'], 'exist', 'skipOnError' => true, 'targetClass' => CatBeneficios::className(), 'targetAttribute' => ['id_beneficio' => 'id_beneficio']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_beneficio_codigo' => 'Id Beneficio Codigo',
            'id_beneficio' => 'Id Beneficio',
            'txt_codigo' => 'Txt Codigo',
            'txt_pin' => 'Txt Pin',
            'txt_account_number' => 'Txt Account Number',
            'b_usado' => 'B Usado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficio()
    {
        return $this->hasOne(CatBeneficios::className(), ['id_beneficio' => 'id_beneficio']);
    }

    public static function getCodigoByBeneficio($id_beneficio){
        $codigo = self::find()->where(["id_beneficio"=>$id_beneficio, "b_usado"=>0])->one();

        if($codigo){
            $codigo->b_usado = 1;
            $codigo->save();
            return $codigo;
        }

        return new RelBeneficiosCodigos();
    }
}
