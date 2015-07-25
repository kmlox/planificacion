<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje'=>array('index'),
	substr($model->id_OA,4,8)=>array('view?id='.$model->id_OA),
	'Modificar',
);

	$this->menu=array(
            array('label'=>'Lista de Objetivos de Aprendizaje','url'=>array('index')),
            array('label'=>'Crear Objetivo de Aprendizaje','url'=>array('create')),
            array('label'=>'Administrar Objetivos de Aprendizaje','url'=>array('admin')),
            );

	?>

	<h1>Modificar Objetivo de Aprendizaje<br><?php echo substr($model->id_OA,4,8)?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>