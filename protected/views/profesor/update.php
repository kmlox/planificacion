<?php
$this->breadcrumbs=array(
	'Profesor',
	'Modificar',
);
/*
    $this->menu=array(
    array('label'=>'List Profesor','url'=>array('index')),
    array('label'=>'Create Profesor','url'=>array('create')),
    array('label'=>'View Profesor','url'=>array('view','id'=>$model->id_profesor)),
    array('label'=>'Manage Profesor','url'=>array('admin')),
    ); 
 */
    
?>

<h1>Modificar Asignaturas Profesor</h1>
<h2 align="center"><?php echo $model->relUsuario->nombre_usuario;?></h2><br>

<?php echo $this->renderPartial('_form',array('model'=>$model,'id_profesor'=>$model->relUsuario->nombre_usuario)); ?>