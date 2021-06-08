<?php
namespace backend\controllers;
use \yii\rest\ActiveController;

use backend\models\Producto;

class ProductoController extends ActiveController {
   public $enableCsrfValidation = false;

    public function actions(){
        $actions =parent::actions(); //estoy tomando las acciones(index, create, update, delete) del padre active controller
        unset($actions['create']); //eliminar un elemento de un arreglo, elimino la accion index
        return $actions;
    }

    //public $modelClass ='backend/models/Producto';

    public $modelClass =Producto::class;

    // public function actionIndex(){
    //     echo 'this is a test'; exit;
    // }


    // public function actionIndex(){
    //     $model = new Producto();
    //     $models = $model->findAll(['precio'=>5000]);
    //     \Yii::$app->response->format = 'json';
    //     return $models;
    // }

    //Función que crea productos, requiere solamente el titulo y el precio.
    //
    public function actionCreateProduct(){
    
        \Yii::$app->response->format = 'json';
        $product = new Producto();
        $product->scenario=Producto::SCENARIO_CREATE;
        $product->attributes= \Yii::$app->request->post();

        if($product->validate()){
            $product->save();
            return array('status'=>true, 'data'=>'Producto creado exitosamente');
        }else{
            return array('status'=>false,'message'=>'No estoy validando','data'=>$product->getErrors());
        }

    }

    //La ruta para acceder a todo el listado de productos es
    //http://localhost/donutslapili/backend/web/index.php/productos

    // //Funcion que lista todos los productos
    // public function actionListProducts(){
    //     \Yii::$app->response->format = 'json';
    //     $product = Producto::find()->all();

    //     if(count($product)>0){
    //         return array('status'=>true, 'data'=>$product);
    //     }else{
    //         return array('status'=>false, 'data'=>'No se encontraron productos.');
    //     }
    // }
    
}