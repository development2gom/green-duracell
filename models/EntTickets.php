<?php

namespace app\models;

use Yii;
use app\modules\ModUsuarios\models\EntUsuarios;
use yii\db\Expression;
/**
 * This is the model class for table "ent_tickets".
 *
 * @property string $id_ticket
 * @property string $id_usuario
 * @property string $uddi
 * @property string $txt_sucursal
 * @property string $txt_codigo_ticket
 * @property int $b_habilitado
 *
 * @property EntProductos[] $entProductos
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
            [['id_usuario', 'uddi', 'txt_sucursal', 'txt_codigo_ticket'], 'required'],
            [['id_usuario', 'b_habilitado'], 'integer'],
            [['uddi', 'txt_codigo_ticket'], 'string', 'max' => 100],
            [['txt_sucursal'], 'string', 'max' => 200],
            [['uddi'], 'unique'],
            [['txt_codigo_ticket'], 'unique'],
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
            'txt_codigo_ticket' => 'Codigo de Ticket',
            'b_habilitado' => 'B Habilitado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntProductos()
    {
        return $this->hasMany(EntProductos::className(), ['id_ticket' => 'id_ticket']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(ModUsuariosEntUsuarios::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeneficio()
    {
        return $this->hasOne(CatBeneficios::className(), ['id_beneficio' => 'id_beneficio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoGanador()
    {
        return $this->hasOne(RelBeneficiosCodigos::className(), ['id_beneficio_codigo' => 'id_codigo']);
    }

    public static function getTicketsByDate($fchInicio, $fchFinal){
        $tickets = self::find()->where(['between', "fch_registro", $fchInicio, $fchFinal])->all();

        return $tickets;
    }

   public static function actualizarPuntuacion(){
       
   }

    public static function generarCodigo($idBeneficio){
        $codigo = RelBeneficiosCodigos::getCodigoByBeneficio($idBeneficio);

        return $codigo;
    }
}
