<?php

class EvaluacionController extends Controller
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
        $model=new Evaluacion;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Evaluacion']))
        {
            $model->attributes=$$model['Evaluacion'];
            if($model->save()){
                //SUBIR ARCHIVOS
                    $archivos = CUploadedFile::getInstancesByName('Evaluacion');
                    $id_evaluacion=$model->id_evaluacion;
                    //Se consulta que la cantidad de archivos sea superior a cero para realizar subida
                    if (isset($archivos) && count($archivos) > 0) {
                        // Procedimiento de subida de archivos
                        foreach ($archivos as $doc => $pic) {
                            //borrar?echo $pic->name.'<br />';
                            //Ruta donde se almacena archivo /user-documents/%id_usuario/%id_planificacion
                            $ruta='/user-documents/'.Yii::app()->user->name.'/evaluacion/'.$id_evaluacion.'/';
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

                                $img_add = new Evaluacion();
                                $img_add->save(); // Realizado
                                
                                Yii::app()->db->createCommand()->update('evaluacion', array(
                                'nombre_documento'=>$namedoc,'url_documento'=>'/planificacion'.$ruta.$url), 'id_evaluacion=:id', array(':id'=>$id_evaluacion));
                                
                            }
                            else{
                                //Si existe algun error en la subida
                                echo 'Error al subir archivos';
                            }
                        }
                    }                
                $this->redirect(array('view','id'=>$model->id_evaluacion));
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
        
        if(isset($_POST['Evaluacion']))
        {
            $model->attributes=$_POST['Evaluacion'];
            
            if($model->save()){
                
                 //SUBIR ARCHIVOS
                $archivos = CUploadedFile::getInstancesByName('Evaluacion');
                $id_evaluacion=$model->id_evaluacion;
                $ruta='/user-documents/'.Yii::app()->user->name.'/evaluacion/'.$id_evaluacion.'/';
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

                        //si carpeta existe, se elimina archivo
                        $ruta_eliminar=Yii::getPathOfAlias('webroot').'/user-documents/'.Yii::app()->user->name.'/evaluacion/'.$id_evaluacion;      
                        if (file_exists($ruta_eliminar)) {
                            //elimina por comando carpeta de archivos
                            system('rm -rf ' . escapeshellarg($ruta_eliminar));
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
                            $img_add = new Evaluacion();
                            $img_add->save(); // Realizado

                            Yii::app()->db->createCommand()->update('evaluacion', array(
                                    'nombre_documento'=>$namedoc,'url_documento'=>'/planificacion'.$ruta.$url), 
                                    'id_evaluacion=:id', array(':id'=>$id));
                        }
                        else{
                            //Si existe algun error en la subida
                            echo 'Error al subir archivos';
                        }
                    }
                } 
                $this->redirect(array('view','id'=>$model->id_evaluacion));
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
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            
            $id_evaluacion= $id;  
            $path=Yii::getPathOfAlias('webroot').'/user-documents/'.Yii::app()->user->name.'/evaluacion/'.$id_evaluacion;;         
            if (file_exists($path)) {
                //elimina por comando carpeta de archivos
                system('rm -rf ' . escapeshellarg($path));
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($$model['returnUrl']) ? $$model['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
    * Lists all models.
    */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Evaluacion');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $model=new Evaluacion('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Evaluacion']))
            $model->attributes=$_GET['Evaluacion'];

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
        $model=Evaluacion::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='evaluacion-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
