<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;

/**
 * This is the model class for table "ent_tickets".
 *
 * @property string $id_ticket
 * @property string $id_usuario
 * @property string $uddi
 * @property string $txt_sucursal
 * @property string $txt_codigo_ticket
 * @property string $txt_codigo_barras
 * @property string $txt_productos
 * @property int $num_productos
 * @property int $b_habilitado
 *
 * @property ModUsuariosEntUsuarios $usuario
 */
class EntTickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ent_tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'uddi', 'txt_sucursal', 'txt_codigo_ticket',  'txt_productos', 'num_productos'], 'required'],
            [['id_usuario', 'num_productos', 'b_habilitado'], 'integer'],
            [['uddi', 'txt_codigo_ticket', 'txt_codigo_barras'], 'string', 'max' => 100],
            [['txt_sucursal'], 'string', 'max' => 200],
            [['txt_productos'], 'string', 'max' => 500],
            [['uddi'], 'unique'],
            //[['txt_codigo_ticket'], 'unique'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => EntUsuarios::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ticket' => 'Id Ticket',
            'id_usuario' => 'Id Usuario',
            'uddi' => 'Uddi',
            'txt_sucursal' => 'Sucursal',
            'txt_codigo_ticket' => 'Codígo por ticket',
            'txt_codigo_barras' => 'Codígo de barras de empaque',
            'txt_productos' => 'Producto que compraste',
            'num_productos' => 'Cantidad de producto',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }
}
