<?php
$this->breadcrumbs=array(
	'Contenidos Mínimos Obligatorios'=>array('index'),
	'Administración de CMO',
);

$this->menu=array(
array('label'=>'Listado de CMO','url'=>array('index')),
array('label'=>'Crear CMO','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('cmo-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administración de CMO</h1>

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
'id'=>'cmo-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(    
    array(
		'name'=>'descripcion_CMO',
                'header'=>'Descripción CMO',
    ),
    array(
		'name'=>'id_asignatura',
                'header'=>'Asignatura',
                'value'=>'$data->relAsignatura->nombre_asignatura'
    ),
		//'id_asignatura',
		//'id_profesor',
array(
'class'=>'CButtonColumn',
    'template' => '{view}{update}{delete}',
                 'viewButtonUrl' =>'Yii::app()->createUrl("/cMO/view/".$data->primaryKey)',
                 'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                 'updateButtonUrl' =>'Yii::app()->createUrl("/cMO/update/".$data->primaryKey)',
                 'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/actualizar.png', 
                 'deleteButtonUrl' =>'Yii::app()->createUrl("/cMO/eliminar?id=".$data->primaryKey)',
                 'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
        
),
),
)); ?>
