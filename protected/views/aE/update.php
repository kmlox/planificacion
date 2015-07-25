<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados'=>array('index'),
        substr($model->id_AE,4,12)=>array('view?id='.$model->id_AE),
	'Modificar',
);

	$this->menu=array(
            array('label'=>'Lista de Aprendizajes Esperados','url'=>array('index')),
            array('label'=>'Crear Aprendizajes Esperados','url'=>array('create')),
            array('label'=>'Administrar Aprendizajes Esperados','url'=>array('admin')),
	);
	?>

	<h1>Modificar Aprendizajes Esperaods <?php echo substr($model->id_AE,4,12) ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>