<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $idPedido
 * @property string $fecha
 * @property int $estado
 * @property string|null $comentario
 * @property float|null $total
 * @property int|null $idUsuario
 *
 * @property Itemspedido[] $itemspedidos
 * @property User $idUsuario0
 */
class Pedido extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE='create';

    const STATUS_INICIAL = 1;
    const STATUS_PAGADO = 2;
    const STATUS_DESPACHADO = 3;
    const STATUS_CANCELADO = 4;
    const STATUS_ENTREGADO = 5;
    const STATUS_REGRESADO = 6;

    public static function tableName()
    {
        return 'pedido';
    }

    public function rules()
    {
        return [
            //[['fecha'], 'default', 'value'=>date('Y-m-d')],
            [['fecha'],'date', 'format'=>'php:Y-m-d'],
            ['estado', 'default', 'value' => self::STATUS_INICIAL],
            ['estado', 'in', 'range' => [self::STATUS_INICIAL, self::STATUS_PAGADO, self::STATUS_DESPACHADO,self::STATUS_CANCELADO,self::STATUS_ENTREGADO,self::STATUS_REGRESADO]],
            [['fecha'], 'safe'],
            [['idUsuario'], 'required'],
            [['estado', 'idUsuario'], 'integer'],
            [['total'], 'number'],
            [['comentario'], 'string', 'max' => 200],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idUsuario' => 'id']],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create']=['idUsuario'];
        return $scenarios;
    }


    public function getItemspedidos()
    {
        return $this->hasMany(Itemspedido::className(), ['idPedido' => 'idPedido']);
    }

    /**
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(User::className(), ['id' => 'idUsuario']);
    }
}
