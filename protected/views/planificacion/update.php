<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	$model->id_planificacion=>array('view','id'=>$model->id_planificacion),
	'Modificar',
);

	$this->menu=array(
	array('label'=>'Lista de Planificaciones','url'=>array('index')),
	array('label'=>'Crear Planificacion','url'=>array('/crear')),
	array('label'=>'Ver detalle Planificacion','url'=>array('view','id'=>$model->id_planificacion)),
	array('label'=>'Administrar Planificaciones','url'=>array('admin')),
	);
	?>

<h1>Modificar Planificación <?php //echo $model->id_planificacion; ?></h1>
<h2 align="center">
    <?php 
    $nombre_asig=Asignatura::model()->findbyPK($model->id_asignatura)->nombre_asignatura;
    $nombre_gra=Grado::model()->findbyPK($model->id_grado)->nombre_grado;          
    $nombre_cur=Curso::model()->findbyPK($model->id_curso)->nombre_curso;
    echo $nombre_asig." - ".$nombre_gra." ".$nombre_cur;
    ?>
</h2></br>

<?php
//$nivel=$model->id_nivel;
$grado=$model->id_grado;
$curso=$model->id_curso;
$asignatura=$model->id_asignatura;
$tipo=$model->tipo;
//$unidad=$model->id_unidad;
?>
<?php
if($grado=='1B'||$grado=='2B'||$grado=='3B'||$grado=='4B'||$grado=='5B'||$grado=='6B'){
    echo $this->renderPartial('_form1',array('model'=>$model,'id_grado'=>$grado,'id_curso'=>$curso,'id_asignatura'=>$asignatura,'tipo'=>$tipo)); 
}
elseif ($grado=='7B'||$grado=='8B'||$grado=='1M'||$grado=='2M'||$grado=='3M'||$grado=='4M'){
    echo $this->renderPartial('_form2',array('model'=>$model,'id_grado'=>$grado,'id_curso'=>$curso,'id_asignatura'=>$asignatura,'tipo'=>$tipo)); 
}
?>