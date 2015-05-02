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

<?php 
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

?>