<?php

class AlumnoController extends Controller
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
            'actions'=>array('index','informe'),
            "roles"=>array('alumno'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
            'actions'=>array('create','update'),
            'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
            'actions'=>array('view','admin','delete'),
            'roles'=>array('admin'),
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

 public function actionInforme()
    {  
        AlumnoController::loadjscss();
        $id_asignatura=$_POST['id_asignatura'];
        $nombre_asignatura=  Asignatura::model()->findbyPk($id_asignatura)->nombre_asignatura;
        
        $id_usuario=$_POST['id_alumno'];
        $nombre_alumno=Usuario::model()->findbyPk($id_usuario)->nombre_usuario;
        
        $model_graph = Yii::app()->db->createCommand("CALL calificaciones_alumno("."'".$id_usuario."','".$id_asignatura."')")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               
        $array_notas=array();
        $array_eval=array();
        
            foreach($model_graph as $row){
                array_push($array_notas, floatval($row->nota));
                array_push($array_eval, $row->nombre_evaluacion);
            }   
                
                
        $this->render('informe',array(
            'nombre_alumno'=>$nombre_alumno,
            'model_graph'=>$model_graph,
            'array_notas'=>$array_notas,
            'array_eval'=>$array_eval,
            'nombre_asignatura'=>$nombre_asignatura,
            'id_alumno'=>$id_usuario,
        ));
    }
    public function loadjscss()
        {            
            //Direccion donde se encuentra .js y .css
            $baseUrl = Yii::app()->baseUrl; 
            //Javascript para ejecutar extension de indicadores
            $cs = Yii::app()->getClientScript();
            //comentado ya que utiliza jquery de carpeta asset generado por bootstrap
            //$cs->registerScriptFile($baseUrl.'/js/jquery.js');
            $cs->registerScriptFile($baseUrl.'/js/highcharts.js');
            $cs->registerScriptFile($baseUrl.'/js/exporting.js');
            
        }


    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate()
    {
        $model=new Alumno;
        
        if(empty($_POST['Alumno']['id_alumno'])){

            //inicializar variables
            $path="";
            $namedoc="";
            $archivo="";


            if(isset($_POST['Alumno'])){

                $model->attributes=$_POST['Alumno'];
                //SUBIR ARCHIVOS
                $photos = CUploadedFile::getInstancesByName('Alumno');

                // proceed if the images have been set
                if (isset($photos) && count($photos) > 0) {

                    // go through each uploaded image
                    foreach ($photos as $image => $pic) {
                        //echo $pic->name.'<br />';
                        $path=Yii::getPathOfAlias('webroot').'/user-documents/'.Yii::app()->user->name;
                        $namedoc="/".$pic->name;
                        //crea carpeta si no existe
                        if(!is_dir($path))
                        {
                            //comandos php
                            mkdir($path,0,true);
                            chmod($path,0775);
                        }

                        $archivo=$path.$namedoc;
                        if ($pic->saveAs($archivo)){
                            // Cargando la hoja de c�lculo
                            Yii::import('application.extensions.phpexcel.*');
                            require_once('Classes/PHPExcel.php');
                            require_once('Classes/PHPExcel/Reader/Excel2007.php');

                            $objReader = new PHPExcel_Reader_Excel2007();
                            $objPHPExcel = $objReader->load($archivo);
                            //$objFecha = new PHPExcel_Shared_Date();
                            // Asignar hoja de excel activa
                            $objPHPExcel->setActiveSheetIndex(0);

                            //conectamos con la base de datos
                            $cn = mysql_connect("localhost", "root", "0653") or die("ERROR EN LA CONEXION");
                            $db = mysql_select_db("planificacion_curricular2", $cn) or die("ERROR AL CONECTAR A LA BD");

                            //Para 100 registos
                            for ($i = 4; $i <= 103; $i++) {
                                    $_DATOS_EXCEL[$i]['rut'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
                                    $_DATOS_EXCEL[$i]['nombre_usuario'] = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
                            }
                        }
                        else{
                            echo 'Error con el documento o intente nuevamente';
                        }

                        $id_curso=$_POST['Alumno']['id_curso'];
                        $rut_validos=true;
                        $rut_erroneo='';
                        $sql  = "";
                        $sql2 = "";

                        if($id_curso!=NULL){
                            //recorremos el arreglo multidimensional
                            //para ir recuperando los datos obtenidos
                            //del excel e ir insertandolos en la BD
                            foreach ($_DATOS_EXCEL as $campo => $valor) {
                                $base="INSERT INTO usuario (`id_usuario`,`password`,`nombre_usuario`,`rol`) VALUES ";
                                $base2 = "INSERT INTO alumno (`id_alumno`,`id_curso`) VALUES ";

                                foreach ($valor as $campo2 => $valor2) {
                                    if($valor!='' && $valor2!=''){   
                                        $rut="";
                                        $campo2== "rut" ? $rut.=$valor2:'';
                                        $rut= str_replace(".", "", $rut);
                                        $valido=$this->validaRut($rut);

                                        $password=sha1(substr($rut,4,4));                                    
                                        $campo2 == "rut" ? $sql.= "('".$rut."','".$password."','" : $sql.= $valor2."','alumno'),";

                                        if($rut!='' && !$valido){
                                            $rut_validos=false;
                                            $rut_erroneo.=$rut." ; ";
                                        }
                                    }
                                }
                                foreach ($valor as $campo3 => $valor3) { 
                                    if($valor!='' && $valor3!='' && $rut_validos){
                                        $id="";
                                        $campo3== "rut" ? $id.=$valor3:"";
                                        //reemplaza los puntos del rut de la planilla Excel
                                        $id= str_replace(".", "", $id);

                                        $campo3 == "rut" ? $sql2.="('".$id."','".$id_curso."'),":"";                                

                                    }
                                }
                                if(!$rut_validos){                               
                                    $sql='';
                                    $base=''; 
                                    $sql2='';
                                    $base2=''; 
                                }
                            }
                            //eliminar ultima coma
                            $sql = substr($sql, 0, -1);
                            $sql2 = substr($sql2, 0, -1);

                            //comando para insertar formato español
                            mysql_query("SET NAMES 'utf8'");

                            $resultado=mysql_query($base.$sql);  
                            $resultado2=mysql_query($base2.$sql2);  

                            if (!$resultado && !$resultado2) {
                                $mensaje  = 'Error al ingresar, revise el (los) rut: '.$rut_erroneo;
                                print "<script>alert('$mensaje')</script>";
                            }
                            elseif($resultado && $resultado2){
                                $mensaje = "Ingresado exitosamente";
                                print "<script>alert('$mensaje')</script>";
                                print '<script language="JavaScript"> window.location.href ="'.Yii::app()->homeUrl."/alumno".'" </script>';
                            }
                            else{
                                $mensaje  = 'Error al ingresar, contáctese con el administrador de sistema';
                                print "<script>alert('$mensaje')</script>";
                            }                         
                        }
                        else{
                            $mensaje = "Error: Debe seleccionar un curso";
                            print "<script>alert('$mensaje')</script>";                            
                        }                   				
                        //una vez terminado el proceso borramos el archivo que esta en el servidor 
                        unlink($archivo);
                    }
                }
            }
            
        }
        else{
           if(isset($_POST['Alumno']))
            {
                $model->attributes=$_POST['Alumno'];
                if($model->save()){
                    $this->redirect(array('usuario/view?id='.$model->id_alumno));
                }
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
$model=$this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['Alumno']))
{
$model->attributes=$_POST['Alumno'];
if($model->save())
$this->redirect(array('view','id'=>$model->id_alumno));
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

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('Alumno');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new Alumno('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['Alumno']))
$model->attributes=$_GET['Alumno'];

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
$model=Alumno::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='alumno-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
    protected function validaRut($rut) 
    { 
        if(strlen($rut) > 10){ 
            return false; 
        } 

        if(strstr($rut, '-') == false){ 
            return false; 
        } 

        $array_rut_sin_guion = explode('-',$rut); // separamos el la cadena del digito verificador. 
        $rut_sin_guion = $array_rut_sin_guion[0]; // la primera cadena 
        $digito_verificador = $array_rut_sin_guion[1];// el digito despues del guion. 

        if(is_numeric($rut_sin_guion)== false){ 
            return false; 
        }
        
        if ($digito_verificador != 'k' and $digito_verificador != 'K'){ 
            if(is_numeric($digito_verificador)== false){ 
                return false; 
            } 
        }
        
        $cantidad = strlen($rut_sin_guion); //8 o 7 elementos 
        for ( $i = 0; $i < $cantidad; $i++)//pasamos el rut sin guion a un vector 
        { 
            $rut_array[$i] = $rut_sin_guion{$i}; 
        }   

        $i = ($cantidad-1); 
        $x=$i; 
        for ($ib = 0; $ib < $cantidad; $ib++)// ingresamos los elementos del ventor rut_array en otro vector pero al reves. 
        { 
            $rut_reverse[$ib]= $rut_array[$i]; 
            $rut_reverse[$ib]; 
            $i=$i-1; 
        } 

        $i=2; 
        $ib=0; 
        $acum=0;  

        do{ 
            if( $i > 7 ){ 
              $i=2; 
            } 
            $acum = $acum + ($rut_reverse[$ib]*$i); 
            $i++; 
            $ib++; 
        }
        
        while ( $ib <= $x); 

        $resto = $acum%11; 
        $resultado = 11-$resto; 
        if ($resultado == 11) { $resultado=0; } 
        if ($resultado == 10) { $resultado='k'; } 
        if ($digito_verificador == 'k' or $digito_verificador =='K') { $digito_verificador='k';} 

        if ($resultado == $digito_verificador) 
        { 
            return true; 
        } 
        
        else 
        { 
            return false; 
        } 
    }
}
