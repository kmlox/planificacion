<?php

class AEController extends Controller
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
            'actions'=>array('create','update','index','view','admin','eliminar','SelectGrado','SelectAsignatura'),
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
        $data=AE::model()->findbyPk($id);

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
        $model=new AE;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['AE']))
        {
            $model->attributes=$_POST['AE'];
            
            $n=(AE::model()->count('id_asignatura='.'"'.$model->id_asignatura.'"'));
           
            if($n<10){
                 $id=$model->id_asignatura."AE"."0".$n;
            }
            else{
                 $id=$model->id_asignatura."AE".$n;
            }            
            
            while(AE::model()->exists('id_AE='.'"'.$id.'"')){
                $n++;
                if($n<10){
                 $id=$model->id_asignatura."AE"."0".$n;
                }
                else{
                     $id=$model->id_asignatura."AE".$n;
                }  
            }
            
            $model->id_AE=$id;
            
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
        $model=AE::model()->findbyPk($id);
        
        if(isset($_POST['AE']))
        {
            $model->attributes=$_POST['AE'];
            if($model->save())
                $this->redirect(array('view?id='.$model->id_AE));
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
        $model=AE::model()->findbyPk($id);
        
        if($model->id_profesor!=NULL){
            //Profesor sólo puede eliminar sus AE
            if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"') 
                    && $model->id_profesor==Yii::app()->user->name){            
                Yii::app()->db->createCommand()->delete('AE', 'id_AE=:id', array(':id'=>$id));
            }
            else{
                //administrador puede eliminar AE de profesores
                 Yii::app()->db->createCommand()->delete('AE', 'id_AE=:id', array(':id'=>$id));
            }
        }
        else{
            //Sólo administradores pueden eliminar AE del sistema
            if(Usuario::model()->exists('id_usuario='.'"'.Yii::app()->user->name.'" and rol="admin"')) {
                Yii::app()->db->createCommand()->delete('AE', 'id_AE=:id', array(':id'=>$id));
            }
        }
        
        $this->redirect('index');        
    }
    
    /**
    * Lists all models.
    */
    public function actionIndex()
    {
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){
            $dataProvider=new CActiveDataProvider('AE',array('criteria'=>array('condition'=>'id_profesor='.'"'.Yii::app()->user->name.'"')));
        }
        else{
             $dataProvider=new CActiveDataProvider('AE');
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
        $model=new AE('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['AE']))
            $model->attributes=$_GET['AE'];
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){
            $model->id_profesor=Yii::app()->user->name;
        }
        $this->render('admin',array(
        'model'=>$model,
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
        $grado=(string) $_POST['id_grado'];
        $data=null;
        
        if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){           
        
            $asignatura_profesor = Yii::app()->db->createCommand("CALL asignatura_profesor('".Yii::app()->user->name."','".$grado."')")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               

            $array_id=array();

            foreach($asignatura_profesor as $row){
                array_push($array_id, $row->id_asignatura);
            }
            $data = Asignatura::model()->findAllByAttributes(array("id_asignatura"=>$array_id));
        }
        else{
            $data=Asignatura::model()->findAll('id_grado=:id_grado',array(':id_grado'=>(string) $_POST['id_grado']));
        }

        $data=CHtml::listData($data,'id_asignatura','nombre_asignatura');

        echo "<option value=''>Seleccione Asignatura</option>";
        foreach ($data as $value=>$nombreasig)
        echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombreasig),true);
    }
    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer the ID of the model to be loaded
    */
    public function loadModel($id)
    {
        $model=AE::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='ae-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
