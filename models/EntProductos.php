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
            [['txt_codigo_barras'], 'string', 'min' => 12],
            [['txt_serial'], 'string', 'min' => 10],
            [['txt_serial'], 'unique'],
            [['uddi'], 'unique'],
            [['id_ticket'], 'exist', 'skipOnError' => true, 'targetClass' => EntTickets::className(), 'targetAttribute' => ['id_ticket' => 'id_ticket']],
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
