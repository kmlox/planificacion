<?php

class InformecursoController extends Controller
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
'actions'=>array('index','view','SelectGrado','SelectCurso','SelectAsignatura','SelectEvaluacion','asignatura'),
'users'=>array('*'),
),
array('allow', // allow authenticated user to perform 'create' and 'update' actions
'actions'=>array('create','update'),
'users'=>array('@'),
),
array('allow', // allow admin user to perform 'admin' and 'delete' actions
'actions'=>array('admin','delete'),
'users'=>array('admin'),
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
$this->render('view',array(
'model'=>$this->loadModel($id),
));
}

 public function actionAsignatura()
    {   
        $id_asignatura=$_POST['id_asignatura'];
        $id_evaluacion=$_POST['id_evaluacion'];
        
        $nombre_asignatura=  Asignatura::model()->findbyPk($id_asignatura)->nombre_asignatura;
        
        $id_curso=$_POST['id_curso'];
        $curso=Curso::model()->findbyPk($id_curso);
        $grado=Grado::model()->findbyPk($curso->id_grado);
        $nombre_curso=$grado->nombre_grado." - ".$curso->nombre_curso;
        
        $model_graph = Yii::app()->db->createCommand("CALL notas_curso_evaluacion("."'".$id_evaluacion."')")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        $array_notas=array();
        $array_eval=array();
        
            foreach($model_graph as $row){
                array_push($array_notas, floatval($row->nota));
                array_push($array_eval, (int)$row->cantidad);
            }   
                
                
        $this->render('asignatura',array(
            
            'model_graph'=>$model_graph,
            'array_notas'=>$array_notas,
            'array_eval'=>$array_eval,
            'nombre_asignatura'=>$nombre_asignatura,
        ));
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

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['AE']))
{
$model->attributes=$_POST['AE'];
if($model->save())
$this->redirect(array('view','id'=>$model->id_AE));
}

$this->render('update',array(
'model'=>$model,
));
}

/**
* Deletes a particular model.
* If deletion is successful, the browser will be redirected to the 'admin' page.
* @param integer $id the ID of the model to be deleted
*/

/**
* Lists all models.
*/
public function actionIndex()
{
            
    
$this->render('index',array(

));
}

//Metodo para seleccionar grado y cargar en el dropdownlist anidado.
	//Se debe agregar método en accessRules para poder ejecutar
	public function actionSelectGrado(){

            //array de tipo int perteneciente a clave primaria
            $data=Grado::model()->findAll('id_nivel=:id_nivel',array(':id_nivel'=>(int) $_POST['id_nivel']));

            $data=CHtml::listData($data,'id_grado','nombre_grado');

            echo "<option value=''>Seleccione Grado</option>";
            foreach ($data as $value=>$nombregrado)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombregrado),true);


	}
	//Metodo para seleccionar curso y cargar en el dropdownlist anidado.
	//Se debe agregar método en accessRules para poder ejecutar
	public function actionSelectCurso(){
            //array de tipo string perteneciente a clave primaria
            $data=Curso::model()->findAll('id_grado=:id_grado',array(':id_grado'=>(string) $_POST['id_grado']));
            $data=CHtml::listData($data,'id_curso','nombre_curso');

            echo "<option value=''>Seleccione Curso</option>";
            foreach ($data as $value=>$nombrecurso)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombrecurso),true);
		
	}
	
        public function actionSelectAsignatura(){		
            $id_curso=(string)$_POST['id_curso'];
           
            $grado=Curso::model()->findbyPk($id_curso)->id_grado;
            $data=Asignatura::model()->findAll('id_grado='.'"'.$grado.'"');

            $data=CHtml::listData($data,'id_asignatura','nombre_asignatura');
            
            echo "<option value=''>Seleccione Asignatura</option>";
            foreach ($data as $value=>$nombreasig)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombreasig),true);
        }
        
        public function actionSelectEvaluacion(){

            //array de tipo int perteneciente a clave primaria
            $data=  Evaluacion::model()->findAll('id_asignatura=:id_asignatura',array(':id_asignatura'=>(string) $_POST['id_asignatura']));

            $data=CHtml::listData($data,'id_evaluacion','nombre_evaluacion');

            echo "<option value=''>Seleccione Evaluación</option>";
            foreach ($data as $value=>$nombreevaluacion)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombreevaluacion),true);


	}
}

