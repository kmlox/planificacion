<?php

class PlanificacionController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','view','SelectGrado','SelectCurso','SelectAsignatura','SelectUnidad'),
				'users'=>array('*'),
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
            PlanificacionController::loadjscss();
            $model=new Planificacion;
            
         
            if(isset($_POST['Planificacion']))
            {
		$model->attributes=$_POST['Planificacion'];
                
                
		if($model->save())
                {
                    /*Se agrega relación m:m dentro del if save() ya que de esta forma se 
                    obtiene la id de actividad, ya que se encuentra oculta, al ser incremental*/
                    $indicadorselected=$_POST['Planificacion']['IndicadoresIds'];
                    $id_planificacion= $model->id_planificacion;                 
                    
                    /*Utiliza tabulador y nueva línea como caracteres de tokenización 
                    *ya que las id de indicadores vienen en una cadena de caracteres
                    *separados por una coma*/
                    $tok = strtok($indicadorselected, ",");
                    while ($tok !== false) {
                        /*se pregunta si es numerico ya que los id de indicadores
                        * seleccionados son tipo INT */
                        if(is_numeric($tok)){
                            Yii::app()->db->createCommand()->insert('planificacion_tiene_indicador',array('id_planificacion'=>$id_planificacion,'id_indicador'=>$tok));
                        }
                        $tok = strtok(" ,");  
                    }
                    
                    //SUBIR ARCHIVOS
                    $archivos = CUploadedFile::getInstancesByName('Planificacion');
                    
                    //Se consulta que la cantidad de archivos sea superior a cero para realizar subida
                    if (isset($archivos) && count($archivos) > 0) {
                        // Procedimiento de subida de archivos
                        foreach ($archivos as $doc => $pic) {
                            //Ruta donde se almacena archivo /user-documents/%id_usuario/%id_planificacion
                            $ruta='/user-documents/'.Yii::app()->user->name.'/planificacion/'.$id_planificacion.'/';
                            $path=Yii::getPathOfAlias('webroot').$ruta;
                            $namedoc=$pic->name;
                                                        
                            /*Utiliza tabulador y nueva línea como caracteres de tokenización 
                            para quitar espacio en el nombre del archivo */
                            $url='';
                            $tok2 = strtok($namedoc, " ");
                            while ($tok2 !== false) {
                                if($url==''){
                                    $url=$tok2;
                                }
                                else{
                                     $url=$url.'%20'.$tok2;
                                }                               
                                $tok2 = strtok("");  
                            }
                            
                            //crea carpeta si no existe
                            if(!is_dir($path))
                            {
                                //comandos php
                                mkdir($path,0777,true);
                                chmod($path,0777);
                            }

                            if ($pic->saveAs($path.$namedoc)){
                                // Se almacenan los archivos y se almacena en el modelo

                                $img_add = new Planificacion();
                                $img_add->save(); // Realizado
                                
                                Yii::app()->db->createCommand()->insert('material_apoyo',
                                array('id_planificacion'=>$id_planificacion,'url'=>'/planificacion'.$ruta.$url,'nombre_material_apoyo'=>$namedoc));
                            }
                            else{
                                //Si existe algun error en la subida
                                echo 'Error al subir archivos';
                            }
                        }
                    }
                   
                    $this->redirect(array('view','id'=>$model->id_planificacion));
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
            PlanificacionController::loadjscss();
            
            $model=$this->loadModel($id);

            if(isset($_POST['Planificacion']))
            {
		$model->attributes=$_POST['Planificacion'];
		
                $indicadorselected=$_POST['Planificacion']['IndicadoresIds'];
                $id_planificacion= $model->id_planificacion;  
                
                /* Utiliza tabulador y nueva línea como caracteres de tokenización */
                $tok = strtok($indicadorselected, ",");
                if($tok !== false){
                    Yii::app()->db->createCommand()->delete('planificacion_tiene_indicador', 'id_planificacion=:id_planificacion', array(':id_planificacion'=>$id_planificacion));
                    while ($tok !== false) {
                       if(is_numeric($tok)){
                           Yii::app()->db->createCommand()->insert('planificacion_tiene_indicador',array('id_planificacion'=>$id_planificacion,'id_indicador'=>$tok));
                       }
                       $tok = strtok(" ,");                            
                   }
                }
                
                //SUBIR ARCHIVOS
                $archivos = CUploadedFile::getInstancesByName('Planificacion');
                $ruta='/user-documents/'.Yii::app()->user->name.'/planificacion/'.$id_planificacion.'/';
                $path=Yii::getPathOfAlias('webroot').$ruta;         
                //Se consulta que la cantidad de archivos sea superior a cero para realizar subida
                if (isset($archivos) && count($archivos) > 0) {
                    // Procedimiento de subida de archivos
                    foreach ($archivos as $doc => $pic) {
                        //Ruta donde se almacena archivo /user-documents/%id_usuario/%id_planificacion
                        $namedoc=$pic->name;
                                                        
                        /*Utiliza tabulador y nueva línea como caracteres de tokenización 
                        para quitar espacio en el nombre del archivo */
                        $url='';
                        $tok2 = strtok($namedoc, " ");
                        while ($tok2 !== false) {
                            if($url==''){
                                $url=$tok2;
                            }
                            else{
                                $url=$url.'%20'.$tok2;
                            }                               
                            $tok2 = strtok("");  
                        }
                            
                        //crea carpeta si no existe
                        if(!is_dir($path))
                        {
                            //comandos php
                            mkdir($path,0777,true);
                            chmod($path,0777);
                        }                        
                        if ($pic->saveAs($path.$namedoc)){
                            // Se almacenan los archivos y se almacena en el modelo
                            $img_add = new Planificacion();
                            $img_add->save(); // Realizado
                            
                            //Se almacenan las url codificada en la tabla material_apoyo
                            Yii::app()->db->createCommand()->insert('material_apoyo',
                            array('id_planificacion'=>$id_planificacion,'url'=>'/planificacion'.$ruta.$url,'nombre_material_apoyo'=>$namedoc));
                        }
                        else{
                            //Si existe algun error en la subida
                            echo 'Error al subir archivos';
                        }
                    }
                }
                   
                //ELIMINAR ARCHIVOS
                $cont=1;
                while(!empty($_POST['Planificacion']['id_doc'.$cont])) {
                    //eliminar archivo carpeta
                    $url_doc=  MaterialApoyo::model()->findbyPk($$model['Planificacion']['id_doc'.$cont])->nombre_material_apoyo;
                    unlink($path.$url_doc);
                    //eliminar archivo de la tabla material_apoyo
                    Yii::app()->db->createCommand()->delete('material_apoyo','id_material_apoyo=:id', array(':id'=>$$model['Planificacion']['id_doc'.$cont]));                                
                    $cont=$cont+1;
                }
                //redireccion
                if($model->save())
                {
                    //fecha y hora actual
                    $fecha_hora=date('Y-m-d H:i:s',time());

                    Yii::app()->db->createCommand()
                        ->update('planificacion',array(
                            'fecha_modificacion'=>$fecha_hora,
                        ),'id_planificacion=:id',array(':id'=>$id_planificacion));
                    
                    $this->redirect(array('view','id'=>$model->id_planificacion));
                    
                }
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
		$this->loadModel($id)->delete();
                //elimina carpeta donde se alojan documentos de la planificacion a eliminar
                $id_planificacion= $id;  
                $ruta='/user-documents/'.Yii::app()->user->name.'/planificacion/'.$id_planificacion;
                $path=Yii::getPathOfAlias('webroot').$ruta;         
                if (file_exists($path)) {
                    //elimina por comando carpeta de archivos
                    system('rm -rf ' . escapeshellarg($path));
                }
               
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($$model['returnUrl']) ? $$model['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Planificacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Planificacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Planificacion']))
			$model->attributes=$_GET['Planificacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Planificacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Planificacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Planificacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='planificacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function loadjscss()
        {            
            //Direccion donde se encuentra .js y .css
            $baseUrl = Yii::app()->baseUrl; 
            //Javascript para ejecutar extension de indicadores
            $cs = Yii::app()->getClientScript();
            //comentado ya que utiliza jquery de carpeta asset generado por bootstrap
            //$cs->registerScriptFile($baseUrl.'/js/jquery.js');
            $cs->registerScriptFile($baseUrl.'/js/jquery-ui.js');
            $cs->registerScriptFile($baseUrl.'/js/jquery.fancytree.js');
            $cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');
            $cs->registerScriptFile($baseUrl.'/js/prettify.js');
            //Cascading Style Sheets para ejecutar extension de indicadores
            $cs->registerCssFile($baseUrl.'/css/prettify.css');
            $cs->registerCssFile($baseUrl.'/css/sample.css');
            $cs->registerCssFile($baseUrl.'/css/ui.fancytree.css');
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
		$id_curso=$_POST['id_curso'];
		$grado=Curso::model()->findbyPk($id_curso)->id_grado;
                $data=GradoTieneAsignatura::model()->findAll('id_grado='.'"'.$grado.'"');
                
                $array_id=array();
                
		foreach($data as $row){
                    array_push($array_id, $row->id_asignatura);                   
                }
                
                $result = Asignatura::model()->findAllByAttributes(array("id_asignatura"=>$array_id));
                
                $data=CHtml::listData($result,'id_asignatura','nombre_asignatura');
		
		echo "<option value=''>Seleccione Asignatura</option>";
		foreach ($data as $value=>$nombreasig)
		echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombreasig),true);
	}
        
        public function actionSelectUnidad(){		
		$id_asignatura=(string)$_POST['id_asignatura'];
                $total_unidades=Yii::app()->db->createCommand("SELECT total_unidades("."'".$id_asignatura."'".")")->queryScalar();    
                        
		  
                $array_id=array();
                
		for($i=1;$i<=$total_unidades;$i++){
                    array_push($array_id, $i);                   
                }
                
                $result = Unidad::model()->findAllByAttributes(array("id_unidad"=>$array_id));
                
                $data=CHtml::listData($result,'id_unidad','nombre_unidad');
		
		echo "<option value=''>Seleccionar Todas</option>";
		foreach ($data as $value=>$nombre_unidad)
		echo CHtml::tag('option', array('value'=>$value),CHtml::encode($nombre_unidad),true);
	}
}
