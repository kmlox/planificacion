<?php

class ProfesorController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            ProfesorController::loadjscss();
            $model=new Profesor;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Profesor']))
            {
                $model->attributes=$_POST['Profesor'];
                if($model->save()){
                    if(!empty($_POST['Profesor']['Asignaturas'])){
                        $id_profesor=$model->id_profesor;
                        $selected=$_POST['Profesor']['Asignaturas'];
                        /*Utiliza tabulador y nueva línea como caracteres de tokenización 
                        *ya que las id de evaluaciones vienen en una cadena de caracteres
                        *separados por una coma*/
                        $tok = strtok($selected, ",");
                        while ($tok !== false) {
                            /*se pregunta si es numerico ya que los id de indicadores
                            * seleccionados son tipo INT */
                            if(Asignatura::model()->exists("id_asignatura='".$tok."'")){
                                Yii::app()->db->createCommand()->insert('profesor_tiene_asignatura',array('id_profesor'=>$id_profesor,'id_asignatura'=>$tok));
                            }
                            $tok = strtok(" ,");
                        }
                    }
                    $this->redirect(array('usuario/view?id='.$model->id_profesor));
                }
            }

            $this->render('create',array(
                    'model'=>$model,
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
            $cs->registerScriptFile($baseUrl.'/js/jquery-ui.js');
            $cs->registerScriptFile($baseUrl.'/js/jquery.fancytree.js');
            $cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');
            $cs->registerScriptFile($baseUrl.'/js/prettify.js');
            //Cascading Style Sheets para ejecutar extension de indicadores
            $cs->registerCssFile($baseUrl.'/css/prettify.css');
            $cs->registerCssFile($baseUrl.'/css/sample.css');
            $cs->registerCssFile($baseUrl.'/css/ui.fancytree.css');
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            ProfesorController::loadjscss();
            $model=Profesor::model()->findbyPk($id);
        
            if(isset($_POST['Profesor']))
            {
                $model->attributes=$_POST['Profesor'];
                $concatenar='';
                if(!empty($_POST['Profesor']['Asignaturas'])){
                    $selected=$_POST['Profesor']['Asignaturas'];
                    /*Utiliza tabulador y nueva línea como caracteres de tokenización 
                    *ya que las id de evaluaciones vienen en una cadena de caracteres
                    *separados por una coma*/
                    $tok = strtok($selected, ",");
                    $concatenar=$tok." ";
                    Yii::app()->db->createCommand()->delete('profesor_tiene_asignatura', 'id_profesor=:id_profesor', array(':id_profesor'=>$id));
                    while ($tok !== false) {
                        if(Asignatura::model()->exists("id_asignatura='".$tok."'")){
                            Yii::app()->db->createCommand()->insert('profesor_tiene_asignatura',array('id_profesor'=>$id,'id_asignatura'=>$tok));
                        }
                        $tok = strtok(" ,");
                    }
                }
                    
            // if($model->save())
            $this->redirect(array('usuario/view?id='.$id));
              
            }
            elseif($model==NULL){
                $this->redirect(array('index'));
            }     
            else{ 
                $this->render('update',array(
                'model'=>$model,
                ));            
            }            
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
		$dataProvider=new CActiveDataProvider('Profesor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profesor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profesor']))
			$model->attributes=$_GET['Profesor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profesor the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Profesor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Profesor $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profesor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
