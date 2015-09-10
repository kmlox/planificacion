<?php

class PortalController extends Controller
{
    public $layout='//layouts/column2';

    /**
    * @return array action filters
    */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
            'actions'=>array('profesor','alumno','directivo','administrador'),
            'users'=>array('@'),),            
            array('deny',  // deny all users
            'users'=>array('*'),
            ),
        );
    }
    
    public function actionProfesor()
    {
        $usuario=Usuario::model()->findbyPk(Yii::app()->user->name);
        if($usuario!=null&&$usuario->rol=='profesor'){
            $this->render('profesor',array(
            ));
        }
        else{
            echo '<script type="text/javascript">
            alert("Ud no posee los permisos para acceder a este portal");
            window.location.href="/planificacion";                          
            </script>';
        }
    }
    public function actionAlumno()
    {
         $usuario=Usuario::model()->findbyPk(Yii::app()->user->name);
        if($usuario!=null&&$usuario->rol=='alumno'){
            $this->render('alumno',array(
            ));
        }
        else{
            echo '<script type="text/javascript">
            alert("Ud no posee los permisos para acceder a este portal");
            window.location.href="/planificacion";                          
            </script>';
        }
    }
    public function actionDirectivo()
    {              
        $usuario=Usuario::model()->findbyPk(Yii::app()->user->name);
        if($usuario!=null&&$usuario->rol=='directivo'){
            $this->render('directivo',array(
            ));
        }
        else{
            echo '<script type="text/javascript">
            alert("Ud no posee los permisos para acceder a este portal");
            window.location.href="/planificacion";                          
            </script>';
        }        
    }
    public function actionAdministrador()
    {
        $usuario=Usuario::model()->findbyPk(Yii::app()->user->name);
        if($usuario!=null&&$usuario->rol=='admin'){
            $this->render('administrador',array(
            ));
        }
        else{
            echo '<script type="text/javascript">
            alert("Ud no posee los permisos para acceder a este portal");
            window.location.href="/planificacion";                          
            </script>';
        }
    }
    
}

