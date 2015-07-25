<?php

class OFVController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
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

    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
            'actions'=>array('index','view','create','update','admin','eliminar','SelectGrado','SelectAsignatura'),
            'roles'=>array('profesor','admin'),
            ),
            array('deny',  // deny all users
            'users'=>array('*'),
            ),
        );
    }

    /**
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
    public function actionView($id)
    {
        $model=OFV::model()->findbyPk($id);
        
        if($model==NULL){
            $this->redirect(array('index'));
        }
        else{                
            if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){           
                if($model->id_profesor==Yii::app()->user->name){
                    $this->render('view',array(
                    'model'=>$model,   
                    //'model'=>$this->loadModel($id),
                    ));
                }
                else{
                    $this->redirect(array('index'));
                }                
            }
            else{
                $this->render('view',array(
                    'model'=>$model,
                ));
            }            
        } 
    }

    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate()
    {
        $model=new OFV;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['OFV']))
        {
            $model->attributes=$_POST['OFV'];
            if($model->save())
                $this->redirect('index');
        }

        $this->render('create',array(
        'model'=>$model,
        ));
    }

    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
    */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['OFV']))
        {
            $model->attributes=$_POST['OFV'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id_OFV));
        }
         elseif($model==NULL){
            $this->redirect(array('index'));
        }     
        else{                
            if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){           
                if($model->id_profesor==Yii::app()->user->name){
                    $this->render('update',array(
                    'model'=>$model,
                    ));
                }
                else{
                    $this->redirect(array('index'));
                }
            }
            else{
                 $this->render('update',array(
                'model'=>$model,
                ));            
            }
        }
    }

    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionEliminar($id)
    {
        $model=OFV::model()->findbyPk($id);
        
        if($model->id_profesor!=NULL){
            if($model->id_profesor==Yii::app()->user->name){
                Yii::app()->db->createCommand()->delete('OFV', 'id_OFV=:id', array(':id'=>$id));
            }
        }
        else{
            Yii::app()->db->createCommand()->delete('OFV', 'id_OFV=:id', array(':id'=>$id));
        }
        
        $this->redirect('index');     
    }   

    /**
    * Lists all models.
    */
    public function actionIndex()
    {
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){
            $dataProvider=new CActiveDataProvider('OFV',array('criteria'=>array('condition'=>'id_profesor='.'"'.Yii::app()->user->name.'"')));
        }
        else{
            $dataProvider=new CActiveDataProvider('OFV');
        }

        $this->render('index',array(
        'dataProvider'=>$dataProvider,
        ));
    }

    //Metodo para seleccionar grado y cargar en el dropdownlist anidado.
    //Se debe agregar m�todo en accessRules para poder ejecutar
    public function actionSelectGrado(){
        
        $id_nivel=(int) $_POST['id_nivel'];
        $data=NULL;
        
        if($id_nivel==1){
            //Cursos 7mo y 8vo basico
            $array_id=array('7B','8B');            
            $result=Grado::model()->findAllByAttributes(array("id_grado"=>$array_id));
            $data=CHtml::listData($result,'id_grado','nombre_grado'); 
        }
        else{
            //array de tipo int perteneciente a clave primaria
            $data=Grado::model()->findAll('id_nivel=:id_nivel',array(':id_nivel'=>(int) $_POST['id_nivel']));
            $data=CHtml::listData($data,'id_grado','nombre_grado');
        }

        echo "<option value=''>Seleccione Grado</option>";
        foreach ($data as $value=>$nombregrado)
        echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombregrado),true);


    }
    
    //Metodo para seleccionar asignatura y cargar en el dropdownlist anidado.
    //Se debe agregar método en accessRules para poder ejecutar
    public function actionSelectAsignatura(){		
        //array de tipo string perteneciente a clave primaria
        $data=Asignatura::model()->findAll('id_grado=:id_grado',array(':id_grado'=>(string) $_POST['id_grado']));
        $data=CHtml::listData($data,'id_asignatura','nombre_asignatura');

        echo "<option value=''>Seleccione Asignatura</option>";
        foreach ($data as $value=>$nombre_asig)
        echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombre_asig),true);
    }
    
    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $model=new OFV('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['OFV']))
            $model->attributes=$_GET['OFV'];
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){
            $model->id_profesor=Yii::app()->user->name;
        }
        $this->render('admin',array(
        'model'=>$model,
        ));
    }

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=OFV::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
protected function performAjaxValidation($model)
{
if(isset($_POST['ajax']) && $_POST['ajax']==='ofv-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
