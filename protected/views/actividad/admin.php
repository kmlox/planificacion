<?php
$this->breadcrumbs=array(
	'Actividads'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Actividad','url'=>array('index')),
array('label'=>'Create Actividad','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('actividad-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Actividads</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'actividad-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id_actividad',
		'id_profesor',
		'id_asignatura',
		'id_curso',
		'tipo',
		'estado',
		/*
		'fecha_inicio',
		'fecha_termino',
		'habilidades',
		'actitudes',
		'actividades',
		'recursos',
		'conocimientos_previos',
		'conocimientos',
		'id_evaluacion',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
