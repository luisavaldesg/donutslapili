<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idProducto
 * @property string $titulo
 * @property string|null $descripcion
 * @property int $precio
 * @property string|null $imagen
 *
 * @property Itemspedido[] $itemspedidos
 */
class Producto extends \yii\db\ActiveRecord
{
   const SCENARIO_CREATE='create';

    public static function tableName()
    {
        return 'producto';
    }

    public function rules()
    {
        return [
            [['titulo', 'precio'], 'required'],
            [['precio'], 'integer'],
            [['titulo'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 200],
            [['imagen'], 'string', 'max' => 100],
            [['titulo'], 'unique'],
        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create']=['titulo','precio'];
        return $scenarios;
    }

    public function getItemspedidos()
    {
        return $this->hasMany(Itemspedido::className(), ['idProducto' => 'idProducto']);
    }
}
