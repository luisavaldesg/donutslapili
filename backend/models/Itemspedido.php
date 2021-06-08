<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "itemspedido".
 *
 * @property int $idItemsPedido
 * @property int $cantidad
 * @property int $idProducto
 * @property int $idPedido
 *
 * @property Pedido $idPedido0
 * @property Producto $idProducto0
 */
class Itemspedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemspedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cantidad', 'idProducto', 'idPedido'], 'required'],
            [['cantidad', 'idProducto', 'idPedido'], 'integer'],
            [['idPedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['idPedido' => 'idPedido']],
            [['idProducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idProducto' => 'idProducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idItemsPedido' => 'Id Items Pedido',
            'cantidad' => 'Cantidad',
            'idProducto' => 'Id Producto',
            'idPedido' => 'Id Pedido',
        ];
    }

    /**
     * Gets query for [[IdPedido0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedido0()
    {
        return $this->hasOne(Pedido::className(), ['idPedido' => 'idPedido']);
    }

    /**
     * Gets query for [[IdProducto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto0()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'idProducto']);
    }
}
