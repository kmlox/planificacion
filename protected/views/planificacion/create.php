<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	'Crear Planificación',
);

$this->menu=array(
array('label'=>'Lista de Planificaciones','url'=>array('index')),
array('label'=>'Administrar Planificaciones','url'=>array('admin')),
);
?>

<h1>Crear Planificación</h1>
<h2 align="center">
    <?php 
    if(empty($_POST['id_asignatura'])||empty($_POST['tipo'])){
        $mensaje = "Error al crear planificación, revise información";
        print "<script>alert('$mensaje'); window.location = '../crear';</script>";
        //redirect("../crear");  
    }
    else{
        $nombre_asig=Asignatura::model()->findbyPK($_POST['id_asignatura'])->nombre_asignatura;
        $nombre_gra=Grado::model()->findbyPK($_POST['id_grado'])->nombre_grado;          
        $nombre_cur=Curso::model()->findbyPK($_POST['id_curso'])->nombre_curso;
        echo $nombre_asig." - ".$nombre_gra." ".$nombre_cur;
        echo '</h2></br>';

        $nivel=$_POST['id_nivel'];
        $grado=$_POST['id_grado'];
        $curso=$_POST['id_curso'];
        $asignatura=$_POST['id_asignatura'];
        $tipo=$_POST['tipo'];
        $unidad=$_POST['id_unidad'];

        if($grado=='1B'||$grado=='2B'||$grado=='3B'||$grado=='4B'||$grado=='5B'||$grado=='6B'){
            echo $this->renderPartial('_form1', array('model'=>$model,'id_nivel'=>$nivel,'id_grado'=>$grado,'id_curso'=>$curso,'id_asignatura'=>$asignatura,'tipo'=>$tipo,'id_unidad'=>$unidad)); 
        }
        elseif ($grado=='7B'||$grado=='8B'||$grado=='1M'||$grado=='2M'||$grado=='3M'||$grado=='4M'){
             echo $this->renderPartial('_form2', array('model'=>$model,'id_nivel'=>$nivel,'id_grado'=>$grado,'id_curso'=>$curso,'id_asignatura'=>$asignatura,'tipo'=>$tipo,'id_unidad'=>$unidad)); 
        }
    }
?>