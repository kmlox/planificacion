<?php

class InformealumnoController extends Controller
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
'actions'=>array('index','view','SelectGrado','SelectCurso','SelectAsignatura','SelectAlumno','Asignatura','Asignatura2','SelectGraph'),
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

    public function actionAsignatura()
    {   
        $id_asignatura=$_POST['id_asignatura'];
        $nombre_asignatura=  Asignatura::model()->findbyPk($id_asignatura)->nombre_asignatura;
        
        $id_usuario=$_POST['id_usuario'];
        $nombre_alumno=Usuario::model()->findbyPk($id_usuario)->nombre_usuario;
        
        $model_graph = Yii::app()->db->createCommand("CALL calificaciones_alumno("."'".$id_usuario."','".$id_asignatura."')")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        $array_notas=array();
        $array_eval=array();
        
            foreach($model_graph as $row){
                array_push($array_notas, floatval($row->nota));
                array_push($array_eval, $row->nombre_evaluacion);
            }   
                
                
        $this->render('asignatura',array(
            'nombre_alumno'=>$nombre_alumno,
            'model_graph'=>$model_graph,
            'array_notas'=>$array_notas,
            'array_eval'=>$array_eval,
            'nombre_asignatura'=>$nombre_asignatura,
            'id_alumno'=>$id_usuario,
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
	
        public function actionSelectAlumno(){		
            $id_curso=(string)$_POST['id_curso'];
            $alumnos=Alumno::model()->findAll('id_curso='.'"'.$id_curso.'"');

            $array_id=array();
            foreach($alumnos as $row){
                array_push($array_id, $row->id_alumno);                   
            }                
            $data= Usuario::model()->findAllByAttributes(array("id_usuario"=>$array_id));

            $data=CHtml::listData($data,'id_usuario','nombre_usuario');

            echo "<option value=''>Seleccione Alumno</option>";
            foreach ($data as $value=>$nombrealumnos)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombrealumnos),true);
        }
        /*
        public function actionSelectAsignatura(){		
            $id_alumno=(string)$_POST['id_usuario'];
            $id_curso=Alumno::model()->findbyPk($id_alumno)->id_curso;
            $grado=Curso::model()->findbyPk($id_curso)->id_grado;
            $data=Asignatura::model()->findAll('id_grado='.'"'.$grado.'"');

            $data=CHtml::listData($data,'id_asignatura','nombre_asignatura');
            
            echo "<option value=''>Seleccione Asignatura</option>";
            foreach ($data as $value=>$nombreasig)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombreasig),true);
        }
         * 
         */
        public function actionSelectAsignatura(){		
            $id_alumno=(string)$_POST['id_usuario'];
            $id_curso=Alumno::model()->findbyPk($id_alumno)->id_curso;
            $grado=Curso::model()->findbyPk($id_curso)->id_grado;
            
            if(Profesor::model()->exists('id_profesor='.'"'.Yii::app()->user->name.'"')){           
                $asignatura_profesor = Yii::app()->db->createCommand("CALL asignatura_profesor('".Yii::app()->user->name."','".$grado."')")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               

                $array_id=array();

                foreach($asignatura_profesor as $row){
                    array_push($array_id, $row->id_asignatura);
                }
                $data = Asignatura::model()->findAllByAttributes(array("id_asignatura"=>$array_id));
            }
            else{
                $data=Asignatura::model()->findAll('id_grado='.'"'.$grado.'"');
            }
            
            $data=CHtml::listData($data,'id_asignatura','nombre_asignatura');

            echo "<option value=''>Seleccione Asignatura</option>";
            foreach ($data as $value=>$nombreasig)
            echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombreasig),true);
        }
        
                
}

