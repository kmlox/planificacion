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
				'actions'=>array('create','update','anual','unidad','clase','index2','chart'),
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
        public function actionChart()
	{
             $this->render('chart',
                array(                
                   // 'talleres'=>$talleres,                   
                ));
		
	}
        
        public function actionAnual($id)
	{
            $this->layout="//layouts/main2";
            $planificaciones=Planificacion::model()->findbyPk($id);
            
            //Yii::app()->user->name
            $nombre_profesor= Usuario::model()->findbyPk($planificaciones->id_profesor)->nombre_usuario;
            $model_curso=Curso::model()->findbyPk($planificaciones->id_curso);
            $grado=Grado::model()->findbyPk($model_curso->id_grado);
            $id_grado=$grado->id_grado;
            $nombre_grado=$grado->nombre_grado;
            $nombre_asignatura= Asignatura::model()->findbyPk($planificaciones->id_asignatura)->nombre_asignatura;
            $estado=$planificaciones->estado;
            
            if($id_grado=='1B'||$id_grado=='2B'||$id_grado=='3B'||$id_grado=='4B'||$id_grado=='5B'||$id_grado=='6B'){
               $this->render('index',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Anual",
                    'estado'=>$estado
                ));
            }
            elseif ($id_grado=='7B'||$id_grado=='8B'||$id_grado=='1M'||$id_grado=='2M'||$id_grado=='3M'||$id_grado=='4M'){
                $this->render('ciclo2',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Anual",
                    'estado'=>$estado
                ));                
            }
            
            
            
            
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
            $id_profesor=(string)$_POST['id_profesor'];
            $nombre_profesor= Usuario::model()->findbyPk($id_profesor)->nombre_usuario;
            $model_curso=Curso::model()->findbyPk($curso);
            $grado=Grado::model()->findbyPk($model_curso->id_grado);
            $id_grado=$grado->id_grado;
            $nombre_grado=$grado->nombre_grado;
            $nombre_asignatura= Asignatura::model()->findbyPk($asignatura)->nombre_asignatura;
            $estado=(string)$_POST['estado'];
            $this->layout="//layouts/main2";
            $planificaciones=Planificacion::model()->findAll("id_profesor="."'".$id_profesor."'"." and "."tipo='Unidad'".
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
            if($id_grado=='1B'||$id_grado=='2B'||$id_grado=='3B'||$id_grado=='4B'||$id_grado=='5B'||$id_grado=='6B'){
               $this->render('index',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Unidad",
                    'estado'=>$estado
                ));                
            }
            elseif ($id_grado=='7B'||$id_grado=='8B'||$id_grado=='1M'||$id_grado=='2M'||$id_grado=='3M'||$id_grado=='4M'){
               $this->render('ciclo2',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Unidad",
                    'estado'=>$estado
                ));  
            }
            
	}
        
        public function actionClase()
	{
            $curso=$_POST['curso'];
            $asignatura=$_POST['asignatura'];
            $id_profesor=(string)$_POST['id_profesor'];
            $nombre_profesor= Usuario::model()->findbyPk($id_profesor)->nombre_usuario;
            $model_curso=Curso::model()->findbyPk($curso);
            $grado=Grado::model()->findbyPk($model_curso->id_grado);
            $id_grado=$grado->id_grado;
            $nombre_grado=$grado->nombre_grado;
            $nombre_asignatura= Asignatura::model()->findbyPk($asignatura)->nombre_asignatura;
            $estado=(string)$_POST['estado'];
            
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
            if($id_grado=='1B'||$id_grado=='2B'||$id_grado=='3B'||$id_grado=='4B'||$id_grado=='5B'||$id_grado=='6B'){
                $this->render('index',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Clase a clase",
                    'estado'=>$estado
                ));
            }
            elseif ($id_grado=='7B'||$id_grado=='8B'||$id_grado=='1M'||$id_grado=='2M'||$id_grado=='3M'||$id_grado=='4M'){
                $this->render('ciclo2',
                array(                
                    'planificaciones'=>$planificaciones,
                    'nombre_curso'=>$nombre_grado." ".$model_curso->nombre_curso,
                    'nombre_asignatura'=>$nombre_asignatura,
                    'nombre_profesor'=>$nombre_profesor,
                    'tipo'=>"Clase a clase",
                    'estado'=>$estado
                ));                
            }
            		
	}
        
	
}

