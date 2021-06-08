<?php

use yii\db\Migration;

/**
 * Class m210603_002250_donuts_pedidos_clientes
 */
class m210603_002250_donuts_pedidos_clientes extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Producto}}', [
            'idProducto'=> $this->primaryKey(),
            'titulo'=>$this->string(50)->unique()->notNull(),
            'descripcion'=>$this->string(200),
            'precio'=>$this->integer()->notNull(),
            'imagen'=>$this->string(100)], $tableOptions);

        $this->createTable('{{%Pedido}}', [
            'idPedido'=> $this->primaryKey(),
            'fecha'=>$this->date()->notNull(),
            'estado'=>$this->integer()->notNull(),
            'comentario'=>$this->string(200),
            'total'=>$this->float(),
            'idUsuario'=>$this->integer()], $tableOptions);

        $this->createTable('{{%Itemspedido}}', [
            'idItemsPedido'=> $this->primaryKey(),
            'cantidad'=>$this->integer()->notNull(),
            'idProducto'=>$this->integer()->notNull(),
            'idPedido'=>$this->integer()->notNull()], $tableOptions);  


        $this->addForeignKey('FK_pedido_user', 'Pedido', 'idUsuario', 'user', 'id');
        $this->addForeignKey('FK_itemspedido_producto', 'Itemspedido', 'idProducto', 'Producto', 'idProducto');
        $this->addForeignKey('FK_itemspedido_pedido', 'Itemspedido', 'idPedido', 'Pedido', 'idPedido');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_pedido_user', 'Pedido');
        $this->dropForeignKey('FK_itemspedido_producto', 'Itemspedido');
        $this->dropForeignKey('FK_itemspedido_pedido', 'Itemspedido');
        $this->dropTable('{{%Producto}}');
        $this->dropTable('{{%Pedido}}');
        $this->dropTable('{{%Itemspedido}}');
    }
}
