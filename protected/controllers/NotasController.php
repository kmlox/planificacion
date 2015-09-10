<?php

class NotasController extends Controller
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
    'actions'=>array('index','view','SelectGrado','SelectCurso','SelectAsignatura','Libroclases','Actualizar','Guardar'),
    'roles'=>array('profesor'),
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

    public function actionIndex()
    {

    $this->render('index',array(

    ));
    }    
    
    public function actionLibroclases()
    {
        $id_curso=$_POST['id_curso'];
        $id_asignatura=$_POST['id_asignatura'];
        $id_grado=$_POST['id_grado'];     
        
        $curso=Curso::model()->findbyPk($id_curso);
        $grado=Grado::model()->findbyPk($id_grado);        
        $asignatura=Asignatura::model()->findbyPk($id_asignatura);
        
        $id_alumnos = Alumno::model()->findAll('id_curso='.'"'.$id_curso.'"');
        
        $array_id=array();
        foreach($id_alumnos as $data){
            array_push($array_id, $data->id_alumno);                  
        }                
        
        $alumnos = Usuario::model()->findAllByAttributes(array("id_usuario"=>$array_id));
        
        $n_evaluaciones=Yii::app()->db->createCommand("SELECT n_evaluaciones("
                ."'".$_POST['id_curso']."',"."'".$_POST['id_asignatura']."')"                
                )->queryScalar();               
        
        $evaluaciones= Yii::app()->db->createCommand("CALL evaluaciones_curso("
                ."'".$_POST['id_curso']."',"."'".$_POST['id_asignatura']."')"
                )->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        
        
        $this->render('libroclases',array(
            'grado'=>$grado,
            'id_grado'=>$id_grado,
            'curso'=>$curso,
            'id_curso'=>$id_curso,
            'asignatura'=>$asignatura,
            'id_asignatura'=>$id_asignatura,
            'id_alumnos'=>$id_alumnos,
            'alumnos'=>$alumnos,
            'n_evaluaciones'=>$n_evaluaciones,
            'evaluaciones'=>$evaluaciones,
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
/*
    public function actionSelectAsignatura(){		
        $id_curso=(string)$_POST['id_curso'];

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
        $id_curso=(string)$_POST['id_curso'];
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
    public function actionActualizar(){
        
        $id_alumnos = Alumno::model()->findAll('id_curso='.'"'.$_POST['id_curso'].'"');
        
        $array_id=array();
        foreach($id_alumnos as $data){
            array_push($array_id, $data->id_alumno);                  
        }                
        
        $alumnos = Usuario::model()->findAllByAttributes(array("id_usuario"=>$array_id));
        
        $n_evaluaciones=Yii::app()->db->createCommand("SELECT n_evaluaciones("
                ."'".$_POST['id_curso']."',"."'".$_POST['id_asignatura']."')"                
                )->queryScalar();               
        
        $evaluaciones= Yii::app()->db->createCommand("CALL evaluaciones_curso("
                ."'".$_POST['id_curso']."',"."'".$_POST['id_asignatura']."')"
                )->setFetchMode(PDO::FETCH_OBJ)->queryAll();           
        
        foreach ($alumnos as $row){
            foreach ($evaluaciones as $filas){
            $calificaciones=Calificacion::model()->find("id_alumno="."'".$row->id_usuario."' and "
                    . "id_evaluacion=".$filas->id_evaluacion);
            
                $notas=$_POST[$row->id_usuario.",".$filas->id_evaluacion];
                
                //Si nota del formulario es un número
                if(is_numeric($notas)) { 
                    //Si existe anteriormente una nota almacenada en la base de datos
                    if($calificaciones!=NULL){
                        //si las notas son distintas y dentro del rango
                        if($calificaciones->nota!=$notas && $notas>=1 && $notas<=7){                                
                            //se actualiza nota con la almacenada anteriormente
                            Yii::app()->db->createCommand()
                            ->update('calificacion', array('nota'=>$notas),
                            'id_alumno=:id_alumno and id_evaluacion=:id_evaluacion',
                            array(':id_alumno'=>$row->id_usuario,':id_evaluacion'=>$filas->id_evaluacion));
                       } 
                    }
                    //Si no existe una nota almacenada en la base de datos
                    else{ 
                        //Se almacena nota en la base de datos
                        Yii::app()->db->createCommand()
                        ->insert('calificacion',
                        array('id_alumno'=>$row->id_usuario,'id_evaluacion'=>$filas->id_evaluacion,'nota'=>$notas));
                    }                    
                }
                //Si se borró nota en el formulario
                elseif($notas==NULL){
                    //Se elimina nota almacenada
                    Yii::app()->db->createCommand()
                    ->delete('calificacion','id_alumno=:id_alumno and id_evaluacion=:id_evaluacion',
                    array(':id_alumno'=>$row->id_usuario,':id_evaluacion'=>$filas->id_evaluacion));                                
                }
                //echo $notas." ";
            }
            //echo "<p></p>";      
        }            
        
        if(isset($_POST['yt1'])){
        echo "
        <form name='fr' action='libroclases' method='POST'>
        <input type='hidden' name='id_curso' value='".$_POST['id_curso']."' >
        <input type='hidden' name='id_asignatura' value='".$_POST['id_asignatura']."' >
        <input type='hidden' name='id_grado' value='".$_POST['id_grado']."' >
        </form>
        <script type='text/javascript'>
        document.fr.submit();
        </script>";
        }
        else{
            $this->redirect("../profesor");
        }
        
    }
    
    public function actionGuardar(){
        $id_alumnos = Alumno::model()->findAll('id_curso='.'"'.$_POST['id_curso'].'"');
        
        $array_id=array();
        foreach($id_alumnos as $data){
            array_push($array_id, $data->id_alumno);                  
        }                
        
        $alumnos = Usuario::model()->findAllByAttributes(array("id_usuario"=>$array_id));
        
        $n_evaluaciones=Yii::app()->db->createCommand("SELECT n_evaluaciones("
                ."'".$_POST['id_curso']."',"."'".$_POST['id_asignatura']."')"                
                )->queryScalar();               
        
        $evaluaciones= Yii::app()->db->createCommand("CALL evaluaciones_curso("
                ."'".$_POST['id_curso']."',"."'".$_POST['id_asignatura']."')"
                )->setFetchMode(PDO::FETCH_OBJ)->queryAll();           
        
        foreach ($alumnos as $row){
            foreach ($evaluaciones as $filas){
            $calificaciones=Calificacion::model()->find("id_alumno="."'".$row->id_usuario."' and "
                    . "id_evaluacion=".$filas->id_evaluacion);
            
                $notas=$_POST[$row->id_usuario.",".$filas->id_evaluacion];
                
                //Si nota del formulario es un número
                if(is_numeric($notas)) { 
                    //Si existe anteriormente una nota almacenada en la base de datos
                    if($calificaciones!=NULL){
                        //si las notas son distintas y dentro del rango
                        if($calificaciones->nota!=$notas && $notas>=1 && $notas<=7){                                
                            //se actualiza nota con la almacenada anteriormente
                            Yii::app()->db->createCommand()
                            ->update('calificacion', array('nota'=>$notas),
                            'id_alumno=:id_alumno and id_evaluacion=:id_evaluacion',
                            array(':id_alumno'=>$row->id_usuario,':id_evaluacion'=>$filas->id_evaluacion));
                       } 
                    }
                    //Si no existe una nota almacenada en la base de datos
                    else{ 
                        //Se almacena nota en la base de datos
                        Yii::app()->db->createCommand()
                        ->insert('calificacion',
                        array('id_alumno'=>$row->id_usuario,'id_evaluacion'=>$filas->id_evaluacion,'nota'=>$notas));
                    }                    
                }
                //Si se borró nota en el formulario
                elseif($notas==NULL){
                    //Se elimina nota almacenada
                    Yii::app()->db->createCommand()
                    ->delete('calificacion','id_alumno=:id_alumno and id_evaluacion=:id_evaluacion',
                    array(':id_alumno'=>$row->id_usuario,':id_evaluacion'=>$filas->id_evaluacion));                                
                }
                //echo $notas." ";
            }
            //echo "<p></p>";      
        }            
        
        redirect("portal");
        
    }
    
    
    
}



