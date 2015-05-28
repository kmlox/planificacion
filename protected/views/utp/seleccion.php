<?php
/*
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Manage',
);
 
 
$this->menu=array(
array('label'=>'List Usuario','url'=>array('index')),
array('label'=>'Create Usuario','url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('usuario-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Selección de Profesor</h1>

<p align="center">
	Seleccione un profesor para revisar cada una de sus planificaciones
</p>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'usuario-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
    array(
		'name'=>'id_usuario',
                'header'=>'Rut',
                'value' =>'$data->id_usuario',
         
    ),
    array(
		'name'=>'nombre_usuario',
                'header'=>'Nombre Profesor',
                'value' =>'$data->nombre_usuario',
         
    ),
    array(
		'name'=>'email',
                'header'=>'Email Profesor',
                'value' =>'$data->email',
         
    ),
	
    array(
    //'class'=>'booster.widgets.TbButtonColumn',
    'class' => 'CButtonColumn',
               'template' => '{view}',
                     'viewButtonUrl' =>'Yii::app()->createUrl("/utp/revision/?rut=".$data->primaryKey)',
                     'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
    ), 
),
)); ?>