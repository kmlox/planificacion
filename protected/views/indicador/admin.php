<?php
$this->breadcrumbs=array(
	'Indicadores'=>array('index'),
	'Administración de Indicadores',
);

$this->menu=array(
array('label'=>'Lista de Indicadores','url'=>array('index')),
array('label'=>'Crear Indicador','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('indicador-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administración de Indicadores</h1>

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
'id'=>'indicador-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
    
    array(
		'name'=>'descripcion_indicador',
                'header'=>'Descripción Indicador',
        ),
     array(
		'name'=>'id_oa',
                'header'=>'Código OA',
                'value' =>'substr($data->id_oa,4,8)'
        ),
		
array(
'class'=>'CButtonColumn',
    'template' => '{view}{update}{delete}',
                 'viewButtonUrl' =>'Yii::app()->createUrl("/indicador/view/".$data->primaryKey)',
                 'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                 'updateButtonUrl' =>'Yii::app()->createUrl("/indicador/update/".$data->primaryKey)',
                 'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/actualizar.png', 
                 'deleteButtonUrl' =>'Yii::app()->createUrl("/indicador/eliminar?id=".$data->primaryKey)',
                 'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
        
),
),
)); ?>
