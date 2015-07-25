<?php

class OAController extends Controller
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
            'actions'=>array('index','view','create','update','eliminar','admin','SelectAsignatura','SelectIdoa'),
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
        $data=OA::model()->findbyPk($id);

        if($data==NULL){
            $this->redirect(array('index'));
        } 
        else{                
            if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){           
                if($data->id_profesor==Yii::app()->user->name){
                    $this->render('view',array(
                        'id'=>$id,
                        'data'=>$data    
                    ));
                }
                else{
                    $this->redirect(array('index'));
                }
            }
            else{
                $this->render('view',array(
                    'id'=>$id,
                    'data'=>$data    
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
        $model=new OA;

        if(isset($_POST['OA']))
        {
            $model->attributes=$_POST['OA'];
            
            $n=(OA::model()->count('id_asignatura='.'"'.$model->id_asignatura.'"'));
           
            if($n<10){
                 $id=$model->id_asignatura."OA"."0".$n;
            }
            else{
                 $id=$model->id_asignatura."OA".$n;
            }            
            
            while(OA::model()->exists('id_OA='.'"'.$id.'"')){
                $n++;
                if($n<10){
                 $id=$model->id_asignatura."OA"."0".$n;
                }
                else{
                     $id=$model->id_asignatura."OA".$n;
                }  
            }
            
            $model->id_OA=$id;
            
            if($model->save()){                
                $this->redirect(array('index'));
            }                
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
        $model=OA::model()->findbyPk($id);
        
        if(isset($_POST['OA']))
        {
            $model->attributes=$_POST['OA'];
            if($model->save())
                $this->redirect(array('view?id='.$model->id_OA));
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
    public function actionDelete($id)
    {
        //  Yii::app()->db->createCommand()->delete('OA', 'id_OA=:id', array(':id'=>"'".$id."'")); 
    
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    
    public function actionEliminar($id)
    {
        $model=OA::model()->findbyPk($id);
        
        if($model->id_profesor!=NULL){
            if($model->id_profesor==Yii::app()->user->name){
                Yii::app()->db->createCommand()->delete('OA', 'id_OA=:id', array(':id'=>$id));
            }
        }
        else{
            Yii::app()->db->createCommand()->delete('OA', 'id_OA=:id', array(':id'=>$id));
        }
        
        $this->redirect('index');        
    }

    /**
    * Lists all models.
    */
    public function actionIndex()
    {
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){
            $dataProvider=new CActiveDataProvider('OA',array('criteria'=>array('condition'=>'id_profesor='.'"'.Yii::app()->user->name.'"')));
        }
        else{
            $dataProvider=new CActiveDataProvider('OA');
        }
            $this->render('index',array(
                'dataProvider'=>$dataProvider,
            ));
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $model=new OA('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['OA']))
            $model->attributes=$_GET['OA'];
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){
            $model->id_profesor=Yii::app()->user->name;
        }
       
        $this->render('admin',array(
        'model'=>$model,
        ));
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
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=OA::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='oa-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
