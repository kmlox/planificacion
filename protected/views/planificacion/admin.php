<?php
$this->breadcrumbs=array(
	'Planificaciones'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
array('label'=>'Lista de Planificaciones','url'=>array('index')),
array('label'=>'Crear Planificacion','url'=>array('/crear')),
);
 * 
 */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('planificacion-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Administración de Planificaciones</h1>

<p>
	Puede ocupar opcionalmente estos operadores (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	o <b>=</b>) al principio de cada valor de búsqueda.
</p>

<?php /* 
echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
*/ ?>
<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'planificacion-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'summaryText' => 'Mostrando de {start} al {end} - {count} total',
//'Mostrando {start} de {end} resultados {count} resultados',
//'ajaxUpdate'=>false,
'columns'=>array(
		//'id_planificacion',
                
    array(
		'name'=>'fecha_creacion',
                'header'=>'Fecha de creación',
                'value' =>'$data->fecha_creacion',
         
    ),
    array(
		'name'=>'fecha_modificacion',
                'header'=>'Fecha de modificación',
                'value' =>'$data->fecha_modificacion',
    ),
    array(
		'name'=>'id_profesor',
                'header'=>'Profesor',
               // 'type'=>'raw',
                'value' =>'$data->relUsuario->nombre_usuario'
        ),
    
    array(
		'name'=>'id_asignatura',
                'header'=>'Asignatura',
                'value' =>'$data->relAsignatura->nombre_asignatura'
        ),
    array(
		'name'=>'id_grado',
                'header'=>'Grado',
                'value' =>'$data->relGrado->nombre_grado'
        //'$data->relCurso->nombre_curso'
        ),
    array(
		'name'=>'id_curso',
                'header'=>'Curso',
                'value' =>'$data->relCurso->nombre_curso'
        //'$data->relCurso->nombre_curso'
        ),
   		'tipo',
		'estado',		
		'fecha_inicio',
		'fecha_termino',
		/*
                'habilidades',
		'actitudes',
		'actividades',
		'recursos',
		'conocimientos_previos',
		'conocimientos',
		'id_evaluacion',
		*/
array(
//'class'=>'booster.widgets.TbButtonColumn',
'class' => 'CButtonColumn',
           'template' => '{view}{delete}',
                 'viewButtonUrl' =>'Yii::app()->createUrl("/planificacion/".$data->primaryKey)',
                 'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                 'deleteButtonUrl' =>'Yii::app()->createUrl("/planificacion/delete",array("id" => $data->primaryKey))',
                 'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
        ),    
),
)); ?>
