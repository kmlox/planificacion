<?php

class ImpresionController extends Controller
{
	
	

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
			'actions'=>array('index','view'),
			'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','anual','unidad','clase'),
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
/*
	public function actionIndex()
	{
            $this->layout="//layouts/main2";
            
                       
            $this->render('index',
                array(                
                   // 'talleres'=>$talleres,                   
                ));
            
		
	}
 * 
 */
        
        public function actionAnual($id)
	{
            $this->layout="//layouts/main2";
            $planificaciones=Planificacion::model()->findbyPk($id);
            
            //Yii::app()->user->name
            $nombre_profesor= Usuario::model()->findbyPk($planificaciones->id_profesor)->nombre_usuario;
            $model_curso=Curso::model()->findbyPk($planificaciones->id_curso);
            $nombre_grado=Grado::model()->findbyPk($model_curso->id_grado)->nombre_grado;
            $nombre_asignatura= Asignatura::model()->findbyPk($planificaciones->id_asignatura)->nombre_asignatura;
            
            $this->render('index',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Anual"
                ));
            
            /*            
            //PDF
            $mPDF1 = Yii::app()->ePdf->mpdf('utf-8', array(190,236)); //Esto lo pueden configurar como quieren, para eso deben de entrar en la web de MPDF para ver todo lo que permite.
             
            $mPDF1->WriteHTML($this->render('index', array('planificaciones'=>$planificaciones,), true));
           
            # Outputs ready PDF
            $mPDF1->Output();                      
            */
            
            # HTML2PDF has very similar syntax
            /*
            $html2pdf = Yii::app()->ePdf->HTML2PDF();

            $html2pdf->WriteHTML($this->renderPartial('index', array('planificaciones'=>$planificaciones), true));
            $html2pdf->Output();
            */
         
	}
        
        public function actionUnidad()
	{
            $curso=$_POST['curso'];
            $asignatura=$_POST['asignatura'];
            
            $nombre_profesor= Usuario::model()->findbyPk(Yii::app()->user->name)->nombre_usuario;
            $model_curso=Curso::model()->findbyPk($curso);
            $nombre_grado=Grado::model()->findbyPk($model_curso->id_grado)->nombre_grado;
            $nombre_asignatura= Asignatura::model()->findbyPk($asignatura)->nombre_asignatura;
            
            $this->layout="//layouts/main2";
            $planificaciones=Planificacion::model()->findAll("id_profesor="."'".Yii::app()->user->name."'"." and "."tipo='Unidad'".
                    " and "."id_curso="."'".$curso."'". " and "."id_asignatura="."'".$asignatura."'");
            /*
            //PDF
            $mPDF1 = Yii::app()->ePdf->mpdf();
            # You can easily override default constructor's params
            // $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
            # render (full page)
            $mPDF1->useOnlyCoreFonts = true;

            //Marca de agua
            $mPDF1->SetWatermarkText("Planificación Curricular");
            $mPDF1->showWatermarkText = true;
 
            $mPDF1->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            10, // margin_left
            10, // margin right
            10, // margin top
            10, // margin bottom
            18, // margin header
            12); // margin footer
            $mPDF1->WriteHTML($this->render('index', array('planificaciones'=>$planificaciones,), true));
           
            # Outputs ready PDF
            $mPDF1->Output();
            
            */
            
            $this->render('index',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Unidad"
                ));
	}
        
        public function actionClase()
	{
            $curso=$_POST['curso'];
            $asignatura=$_POST['asignatura'];
            
            $nombre_profesor= Usuario::model()->findbyPk(Yii::app()->user->name)->nombre_usuario;
            $model_curso=Curso::model()->findbyPk($curso);
            $nombre_grado=Grado::model()->findbyPk($model_curso->id_grado)->nombre_grado;
            $nombre_asignatura= Asignatura::model()->findbyPk($asignatura)->nombre_asignatura;
            
            $this->layout="//layouts/main2";
            $planificaciones=Planificacion::model()->findAll("id_profesor="."'".Yii::app()->user->name."'"." and "."tipo='Clase a clase'".
                    " and "."id_curso="."'".$curso."'". " and "."id_asignatura="."'".$asignatura."'");
            /*
            //PDF
            $mPDF1 = Yii::app()->ePdf->mpdf();
            # You can easily override default constructor's params
            // $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
            # render (full page)
            $mPDF1->useOnlyCoreFonts = true;

            //Marca de agua
            $mPDF1->SetWatermarkText("Planificación Curricular");
            $mPDF1->showWatermarkText = true;
 
            $mPDF1->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            10, // margin_left
            10, // margin right
            10, // margin top
            10, // margin bottom
            18, // margin header
            12); // margin footer
            $mPDF1->WriteHTML($this->render('index', array('planificaciones'=>$planificaciones,), true));
           
            # Outputs ready PDF
            $mPDF1->Output();
            
            */
            
            $this->render('index',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Clase a clase"
                ));		
	}
        
	
}

