<?php
$this->breadcrumbs=array(
	'Oas'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List OA','url'=>array('index')),
array('label'=>'Create OA','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('oa-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Oas</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'oa-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id_OA',
		'descripcion_OA',
		'id_asignatura',
		//'id_profesor',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
