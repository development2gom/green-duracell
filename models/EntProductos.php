<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ent_productos".
 *
 * @property string $id_producto
 * @property string $id_ticket
 * @property string $uddi
 * @property string $txt_codigo_barras
 * @property string $txt_serial
 * @property string $b_habilitado
 *
 * @property EntTickets $ticket
 */
class EntProductos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ticket', 'uddi', 'txt_codigo_barras', 'txt_serial'], 'required'],
            [['id_ticket', 'b_habilitado'], 'integer'],
            [['uddi'], 'string', 'max' => 100],
            [['txt_nombre'], 'string', 'max' => 50],
            [['txt_codigo_barras'], 'string', 'min' => 11],
            [['txt_serial'], 'string', 'min' => 10],
            [['txt_serial'], 'unique'],
            [['uddi'], 'unique'],
            [['id_ticket'], 'exist', 'skipOnError' => true, 'targetClass' => EntTickets::className(), 'targetAttribute' => ['id_ticket' => 'id_ticket']],
            
            ['txt_codigo_barras', function($attribute, $params, $validator){
                // Validacion para AA 4+2pz
                if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index1']['txt_prod'] && ConstantesWeb::CODIGOS[0] != $this->$attribute){
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos1.');
                }else if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index2']['txt_prod'] && ConstantesWeb::CODIGOS[1] != $this->$attribute){
                    // Validacion para AAA 4+2pz
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos2.');
                }else if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index3']['txt_prod'] && ConstantesWeb::CODIGOS[2] != $this->$attribute){
                    // Validacion para AA 2pz
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos3.');
                }else if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index4']['txt_prod'] && ConstantesWeb::CODIGOS[3] != $this->$attribute){
                    // Validacion para AAA 4+2pz
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos4.');
                }else if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index5']['txt_prod'] && ConstantesWeb::CODIGOS[4] != $this->$attribute){
                    // Validacion para C 2pz
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos5.');
                }else if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index6']['txt_prod'] && ConstantesWeb::CODIGOS[5] != $this->$attribute){
                    // Validacion para D 2pz
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos6.');
                }else if($this->txt_nombre == ConstantesWeb::PRODUCTOS['index7']['txt_prod'] && ConstantesWeb::CODIGOS[6] != $this->$attribute){
                    // Validacion para 9V 1pz
                    $this->addError($attribute, 'Verificar que el codigo de barras o producto sean correctos7.');
                }else{
                      
                }
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'id_ticket' => 'Id Ticket',
            'uddi' => 'Uddi',
            'txt_codigo_barras' => 'Codigo de barras',
            'txt_serial' => 'Serial',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(EntTickets::className(), ['id_ticket' => 'id_ticket']);
    }
}
