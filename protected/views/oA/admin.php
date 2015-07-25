<?php
$this->breadcrumbs=array(
	'Objetivos de Aprendizaje'=>array('index'),
	'Administración de Objetivos de Aprendizaje',
);

$this->menu=array(
array('label'=>'Lista de Objetivos de Aprendizaje','url'=>array('index')),
array('label'=>'Crear Objetivo de Aprendizaje','url'=>array('create')),
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

<h1>Administración de Objetivos de Aprendizaje</h1>

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
'id'=>'oa-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		
    array(
		'name'=>'id_OA',
                'header'=>'Código OA',
                'value' =>'substr($data->id_OA,4,8)'
        ),
    array(
		'name'=>'descripcion_OA',
                'header'=>'Descripción OA',
        ),
    array(
		'name'=>'id_asignatura',
                'header'=>'Asignatura',
                'value' =>'$data->relAsignatura->nombre_asignatura'
        ),
array(
//'class'=>'booster.widgets.TbButtonColumn',
'class' => 'CButtonColumn',
           'template' => '{view}{update}{delete}',
                 'viewButtonUrl' =>'Yii::app()->createUrl("/oA/view?id=".$data->primaryKey)',
                 'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                 'updateButtonUrl' =>'Yii::app()->createUrl("/oA/update?id=".$data->primaryKey)',
                 'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/actualizar.png', 
                 'deleteButtonUrl' =>'Yii::app()->createUrl("/oA/eliminar?id=".$data->primaryKey)',
                 'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
        ),  
),
)); ?>
