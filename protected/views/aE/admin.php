<?php
$this->breadcrumbs=array(
	'Aprendizajes Esperados'=>array('index'),
	'Administración de Aprendizajes Esperados',
);

$this->menu=array(
array('label'=>'Listado de Aprendizajes Esperados','url'=>array('index')),
array('label'=>'Crear Aprendizajes Esperados','url'=>array('create')),
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

<h1>Administración de Aprendizajes Esperados</h1>

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
'id'=>'ae-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
    
    array(
		'name'=>'id_AE',
                'header'=>'Código AE',
                'value' =>'substr($data->id_AE,4,12)'
        ),
    array(
		'name'=>'descripcion_AE',
                'header'=>'Descripción AE',
        ),
     array(
		'name'=>'id_asignatura',
                'header'=>'Asignatura',
                'value' =>'$data->relAsignatura->nombre_asignatura'
        ),
array(
'class' => 'CButtonColumn',
           'template' => '{view}{update}{delete}',
                 'viewButtonUrl' =>'Yii::app()->createUrl("/aE/view?id=".$data->primaryKey)',
                 'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                 'updateButtonUrl' =>'Yii::app()->createUrl("/aE/update?id=".$data->primaryKey)',
                 'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/actualizar.png', 
                 'deleteButtonUrl' =>'Yii::app()->createUrl("/aE/eliminar?id=".$data->primaryKey)',
                 'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
        ), 
),
)); ?>
