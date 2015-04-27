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
				'actions'=>array('index','view'),
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
                            //borrar?echo $pic->name.'<br />';
                            //Ruta donde se almacena archivo /user-documents/%id_usuario/%id_planificacion
                            $ruta='/user-documents/'.Yii::app()->user->name.'/'.$id_planificacion.'/';
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
                                mkdir($path,0,true);
                                chmod($path,0775);
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
                    
                //Se consulta que la cantidad de archivos sea superior a cero para realizar subida
                if (isset($archivos) && count($archivos) > 0) {
                    // Procedimiento de subida de archivos
                    foreach ($archivos as $doc => $pic) {
                        //borrar?echo $pic->name.'<br />';
                        //Ruta donde se almacena archivo /user-documents/%id_usuario/%id_planificacion
                        $ruta='/user-documents/'.Yii::app()->user->name.'/'.$id_planificacion.'/';
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
                            mkdir($path,0,true);
                            chmod($path,0775);
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
                    Yii::app()->db->createCommand()->delete('material_apoyo','id_material_apoyo=:id', array(':id'=>$_POST['Planificacion']['id_doc'.$cont]));                                
                    $cont=$cont+1;
                }
                /*
                $id_doc=$_POST['Planificacion']['id_doc'];
                Yii::app()->db->createCommand()->delete('material_apoyo','id_material_apoyo=:id', array(':id'=>$id_doc));                                
                */
                
                if(!empty($_POST['Planificacion']['id_doc'])) {
                    while(!empty($_POST['Planificacion']['id_doc'])) {
                        Yii::app()->db->createCommand()->delete('material_apoyo','id_material_apoyo=:id', array(':id'=>$_POST['Planificacion']['id_doc']));                                
                    }
                }
                
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id_planificacion));
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

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
}