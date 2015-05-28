<?php

class SeleccionController extends Controller
{
	
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
            return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
			'actions'=>array('index','view','SelectGrado','SelectAsignatura','SelectProfesor'),
			'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
          
            
            $this->render('index',
                array(                
                   // 'talleres'=>$talleres,                   
                ));
		
	}
        
          //Metodo para seleccionar grado y cargar en el dropdownlist anidado.
        //Se debe agregar m�todo en accessRules para poder ejecutar
        public function actionSelectGrado(){

            //array de tipo int perteneciente a clave primaria
            $data=Grado::model()->findAll('id_nivel=:id_nivel',array(':id_nivel'=>(int) $_POST['id_nivel']));

            $data=CHtml::listData($data,'id_grado','nombre_grado');

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

        public function actionSelectProfesor(){	

            $data = ProfesorTieneAsignatura::model()->findAll('id_asignatura=:id_asignatura',array(':id_asignatura'=>(string)$_POST['id_asignatura']));
            //$data = ProfesorTieneAsignatura::model()->findAll();
          
            $array_id=array();
            foreach ($data as $row){
                array_push($array_id, $row->id_profesor); 
            }
            
            $result = Usuario::model()->findAllByAttributes(array("id_usuario"=>$array_id));
                
            foreach ($result as $value){
            // echo CHtml::tag('option', array('value'=>$value),CHtml::encode(substr($nombregrado,4,8)),true);

            echo '<input type="radio" name="id_profesor" value="'.$value->id_usuario.'">'.$value->nombre_usuario.'<br>';
           
            }
            
        }
        
}

