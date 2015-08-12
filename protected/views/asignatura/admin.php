<?php
$this->breadcrumbs=array(
	'Asignaturas'=>array('index'),
	'Administración de Asignaturas',
);

$this->menu=array(
array('label'=>'Listado de Asignaturas','url'=>array('index')),
array('label'=>'Crear Asignatura','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('asignatura-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administración de Asignaturas</h1>

<p>
	Puede ocupar opcionalmente estos operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	o <b>=</b>) al principio de cada valor de búsqueda.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'asignatura-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
     array(
		'name'=>'id_asignatura',
                'header'=>'ID Asignatura',
        ), 
		'nombre_asignatura',
     array(
		'name'=>'id_grado',
                'header'=>'Grado',
                'value' =>'$data->relGrado->nombre_grado'
        ),
		
array(
'class' => 'CButtonColumn',
           'template' => '{view}{update}{delete}',
                 'viewButtonUrl' =>'Yii::app()->createUrl("/asignatura/view?id=".$data->primaryKey)',
                 'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                 'updateButtonUrl' =>'Yii::app()->createUrl("/asignatura/update?id=".$data->primaryKey)',
                 'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/actualizar.png', 
                 'deleteButtonUrl' =>'Yii::app()->createUrl("/asignatura/eliminar?id=".$data->primaryKey)',
                 'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
        ),
),
)); ?>
