<?php
namespace backend\controllers;
use \yii\rest\ActiveController;

use backend\models\User;

class UserController extends ActiveController {
   public $enableCsrfValidation = false;

    public function actions(){
        $actions =parent::actions();  
        unset($actions['create']);  
        return $actions;
    }

    public $modelClass =User::class;

    //Función que crea productos, requiere el username, el password el email y el tipo de usuario
    //
    public function actionCreateUser(){
    
        \Yii::$app->response->format = 'json';
        $user = new User();
        $user->scenario=User::SCENARIO_CREATE;
        $user->attributes= \Yii::$app->request->post();

        if($user->validate()){
            $user->save();
            return array('status'=>true, 'data'=>'Usuario creado exitosamente...');
        }else{
            return array('status'=>false,'message'=>'No estoy validando','data'=>$user->getErrors());
        }

    }

    public function actionFindClient(){
        $model = new User();
        $models = $model->findAll(['name'=>'paula']);
        \Yii::$app->response->format = 'json';
        return $models;
    }

    //La ruta para acceder a todo el listado de usuarios es
    //http://localhost/donutslapili/backend/web/index.php/users
    
}