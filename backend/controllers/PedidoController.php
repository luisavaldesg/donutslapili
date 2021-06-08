<?php
namespace backend\controllers;
use \yii\rest\ActiveController;

use backend\models\Pedido;

class PedidoController extends ActiveController {
   public $enableCsrfValidation = false;

    public function actions(){
        $actions =parent::actions();  
        unset($actions['create']);  
        return $actions;
    }

    public $modelClass =Pedido::class;


    public function actionCreatePedido($idUsuario=-1){
    
        \Yii::$app->response->format = 'json';
        $pedido = new Pedido();
        $pedido->scenario=Pedido::SCENARIO_CREATE;
        $pedido->fecha=date('Y-m-d'); 
        
        if($idUsuario===-1){
            $pedido->attributes= \Yii::$app->request->post();
        }else{
            
            $pedido->idUsuario=$idUsuario;
           
        }
        var_dump($pedido->estado);
        die();

        if($pedido->validate()){

            $pedido->save();
            return array('status'=>true, 'data'=>'Pedido creado exitosamente...');
        }else{
            return array('status'=>false,'message'=>'No estoy validando','data'=>$pedido->getErrors());
        }

    }
    //verdad que cualquiera puede hacer pedidos
    //necesito saber qué usuario hizo qué pedido
    //id del usuario, id del pedido
    //detalle del pedido, el id del producto y la cantidad
    //el id del usuario lo tengo en pedido
    //necesito buscar el id del pedido de ese usuario id
    public function actionCreateItemPedido($idUsuario,$idProducto, $cantidad){
        \Yii::$app->response->format = 'json';
        //actionCreatePedido($idUsuario);
        $pedido = new Pedido();
        //  $models = $model->findAll(['idUsuario'=>$idUsuario]);
        $pedido = Pedido::find()->where(['estado'=>Pedido::STATUS_INICIAL,'id'=>$idPedido])->one();
        if($pedido==1){

        }
        
        \Yii::$app->response->format = 'json';
        return $models;

    }

    public function actionFind(){
        $pedido = new Pedido();
        $pedido= Pedido::findOne(3);
        return $pedido;
    }

    public function actionFindClient(){
        $model = new User();
        $models = $model->findAll(['typeUser'=>1]);
        \Yii::$app->response->format = 'json';
        return $models;
    }

    //La ruta para acceder a todo el listado de usuarios es
    //http://localhost/donutslapili/backend/web/index.php/users
    
}