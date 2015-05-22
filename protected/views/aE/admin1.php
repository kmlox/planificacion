<?php
$this->breadcrumbs=array(
	'Aes'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List AE','url'=>array('index')),
array('label'=>'Create AE','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('ae-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Aes</h1>

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
'id'=>'ae-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id_AE',
		'descripcion_AE',
		'id_asignatura',
		'id_profesor',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>
