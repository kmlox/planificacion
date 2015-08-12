<?php

class UsuarioController extends Controller
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
    'actions'=>array('index','view','create','update','eliminar'),
    'roles'=>array('admin'),
    ),
    array('allow',  // allow all users to perform 'index' and 'view' actions
    'actions'=>array('admin'),
    'roles'=>array('admin','directivo'),
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
        $model=new Usuario;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Usuario']))
        {
            $model->attributes=$_POST['Usuario'];
            if($this->validaRut($model->id_usuario)){
                if(!Usuario::model()->exists('id_usuario='.$model->id_usuario)){
                    $model->password=sha1($model->password);
                    if($model->save()){
                        if($model->rol=='admin'||$model->rol=='directivo'){
                            $this->redirect('index');
                        }                        
                        elseif($model->rol=='profesor'){
                            echo "
                            <form name='fr' action='../profesor/create' method='POST'>
                            <input type='hidden' name='id_profesor' value='$model->id_usuario' >
                            </form>
                            <script type='text/javascript'>
                            document.fr.submit();
                            </script>";
                        }
                        elseif($model->rol=='alumno'){
                            echo "
                            <form name='fr' action='../alumno/create' method='POST'>
                            <input type='hidden' name='id_alumno' value='$model->id_usuario' >
                            </form>
                            <script type='text/javascript'>
                            document.fr.submit();
                            </script>";
                        }                        
                    }
                }
                else{
                    $mensaje = "Rut ya existe en los registros";
                    print "<script>alert('$mensaje')</script>";                            
                } 
            }
            else{
                $mensaje = "Error de Rut";
                print "<script>alert('$mensaje')</script>";                            
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
        $model=Usuario::model()->findbyPk($id);
        
        if(isset($_POST['Usuario']))
        {
            $model->attributes=$_POST['Usuario'];
            if($model->password!=Usuario::model()->findbyPk($id)->password){
                 $model->password=sha1($model->password);
            }
            if($model->save()){
                if($model->rol=='profesor'){
                    $this->redirect(array('/profesor/update?id='.$model->id_usuario));
                }
                else{
                    $this->redirect(array('view?id='.$model->id_usuario));
                }
            }
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
    
    public function actionEliminar($id)
    {
        $model=Usuario::model()->findbyPk($id);
        $model->delete();
        //Yii::app()->db->createCommand()->delete('Usuario', 'id_usuario=:id', array(':id'=>$id));
        
        
        $this->redirect('index');        
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
    $dataProvider=new CActiveDataProvider('Usuario');
    $this->render('index',array(
    'dataProvider'=>$dataProvider,
    ));
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
    $model=new Usuario('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Usuario']))
    $model->attributes=$_GET['Usuario'];
    if(Directivo::model()->exists('id_directivo='.'"'.Yii::app()->user->name.'"')){
            $model->rol='profesor';
    }
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
    $model=Usuario::model()->findByPk($id);
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
    if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
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
