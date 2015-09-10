<?php

class IndicadorController extends Controller
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
            'actions'=>array('index','view','create','update','eliminar','admin','SelectCurso','SelectAsignatura','SelectOa','SelectDescripcion'),
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
        $model=Indicador::model()->findbyPk($id);
        
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
        $model=new Indicador;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Indicador']))
        {
            $model->attributes=$_POST['Indicador'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id_indicador));
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

        if(isset($_POST['Indicador']))
        {
            $model->attributes=$_POST['Indicador'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id_indicador));
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
        $model=Indicador::model()->findbyPk($id);
        if($model->id_profesor!=NULL){
            //Profesor sólo puede eliminar sus indicadores
            if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"') 
                    && $model->id_profesor==Yii::app()->user->name){            
                Yii::app()->db->createCommand()->delete('indicador', 'id_indicador=:id', array(':id'=>$id));
            }
            else{
                //administrador puede eliminar indicadores de profesores
                Yii::app()->db->createCommand()->delete('indicador', 'id_indicador=:id', array(':id'=>$id));
            }
        }
        else{
            //Sólo administradores pueden eliminar indicadores del sistema
            if(Usuario::model()->exists('id_usuario='.'"'.Yii::app()->user->name.'" and rol="admin"')) {
                Yii::app()->db->createCommand()->delete('indicador', 'id_indicador=:id', array(':id'=>$id));
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
            $dataProvider=new CActiveDataProvider('Indicador',array('criteria'=>array('condition'=>'id_profesor='.'"'.Yii::app()->user->name.'"')));
        }
        else {
             $dataProvider=new CActiveDataProvider('Indicador');
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
        $model=new Indicador('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Indicador']))
            $model->attributes=$_GET['Indicador'];
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
    $model=Indicador::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='indicador-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}

    //Metodo para seleccionar asignatura y cargar en el dropdownlist anidado.
    //Se debe agregar método en accessRules para poder ejecutar
    
    public function actionSelectAsignatura(){		
            $grado=(string) $_POST['id_grado'];
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
    public function actionSelectOa(){	
            
            //array de tipo int perteneciente a clave primaria
            $data=OA::model()->findAll('id_asignatura=:id_asignatura'." and "."(id_profesor="."'".Yii::app()->user->name."'"." or "."id_profesor is NULL)",array(':id_asignatura'=>(string) $_POST['id_asignatura']));

           // $data=CHtml::listData($data,'id_OA','id_OA');

           // echo "<option value=''>Seleccione OA</option>";
            $cont=1;
            foreach ($data as $value){
           // echo CHtml::tag('option', array('value'=>$value),CHtml::encode(substr($nombregrado,4,8)),true);
           
            echo '<input type="radio" name="Indicador[id_oa]" value="'.$value->id_OA.'">'.'['.substr($value->id_OA,4,8).'] '.$value->descripcion_OA.'<br>';
            $cont++;
            
            }
            //echo '<input type="text" name="country" value="rctm" readonly>';
    }
      public function actionSelectDescripcion(){	
            
        //array de tipo string perteneciente a clave primaria
        $data=OA::model()->findAll('id_OA=:id_oa',array(':id_oa'=>(string)$_POST['id_oa']));
        foreach ($data as $row){
            echo '<textarea  readonly="readonly" cols="1" rows="2" style="width:880px" >'.$row->descripcion_OA.'</textarea></br>';
        }        
                  
    }
}
