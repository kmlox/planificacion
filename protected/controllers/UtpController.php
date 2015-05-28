<?php

class UtpController extends Controller
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
				'actions'=>array('index','view','Replanificaranual','Aprobaranual','Poraprobar','Replanificar','aprobar','seleccion','revision'),
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
        
        public function actionSeleccion()
	{
                $profesores=new Usuario();
                
                $profesores->rol='profesor';
		$this->render('seleccion',array(
			'model'=>$profesores,                        
                        ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Profesor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profesor']))
		{
			$model->attributes=$_POST['Profesor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_profesor));
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

		if(isset($_POST['Profesor']))
		{
			$model->attributes=$_POST['Profesor'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_profesor));
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
            
            $dataProvider=new CActiveDataProvider('Profesor');

            $this->render('index',array(
                    'dataProvider'=>$dataProvider,                       
            ));
	}
        
        public function actionRevision($rut)
	{
            
            $dataProvider=new CActiveDataProvider('Profesor');
            $id_profesor=$rut;
            //$id_profesor=$_POST['id_profesor'];
            $model_profesor=  Usuario::model()->findbyPK($id_profesor);
            $this->render('revision',array(
                    'dataProvider'=>$dataProvider,
                    'id_profesor'=>$id_profesor,
                    'model_profesor'=>$model_profesor,
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
        
        public function actionAprobaranual($id){
          
            Yii::app()->db->createCommand()
            ->update('planificacion', array(
                'estado'=>'Aprobado',
            ), 'id_planificacion=:id', array(':id'=>$id)); 
            
            //Volver página anterior
            echo '<script>window.history.go(-1)</script>';

        }
        
         public function actionReplanificaranual($id){
           
                Yii::app()->db->createCommand()
                ->update('planificacion', array(
                    'estado'=>'Borrador',
                ), 'id_planificacion=:id', array(':id'=>$id)); 
            
            //Volver página anterior
            echo '<script>window.history.go(-1)</script>';
        }
        
              
        public function actionReplanificar(){
            $curso=$_POST['curso'];
            $asignatura=$_POST['asignatura'];
            $profesor=$_POST['profesor'];
            $tipo=$_POST['tipo'];
            
            Yii::app()->db->createCommand()->update('planificacion', array(
                'estado'=>'Borrador'),
                    'id_profesor=:id_profesor and id_asignatura=:id_asignatura and '
                    . 'id_curso=:id_curso and tipo=:tipo', 
                    array(':id_profesor'=>$profesor,':id_asignatura'=>$asignatura,
                        ':id_curso'=>$curso,':tipo'=>$tipo)
                    ); 
            
            
            //Volver página anterior
            echo '<script>window.history.go(-1)</script>';
        }
        
         public function actionAprobar(){
            $curso=$_POST['curso'];
            $asignatura=$_POST['asignatura'];
            $profesor=$_POST['profesor'];
            $tipo=$_POST['tipo'];
            
            Yii::app()->db->createCommand()->update('planificacion', array(
                'estado'=>'Aprobado'),
                    'id_profesor=:id_profesor and id_asignatura=:id_asignatura and '
                    . 'id_curso=:id_curso and tipo=:tipo', 
                    array(':id_profesor'=>$profesor,':id_asignatura'=>$asignatura,
                        ':id_curso'=>$curso,':tipo'=>$tipo)
                    ); 
            
            
            //Volver página anterior
            echo '<script>window.history.go(-1)</script>';
        }
        
}
