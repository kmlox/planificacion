<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administrar Usuarios',
);
if(!Directivo::model()->exists('id_directivo='.'"'.Yii::app()->user->name.'"')){
    $this->menu=array(
    array('label'=>'Lista de Usuarios','url'=>array('index')),
    array('label'=>'Crear Usuario','url'=>array('create')),
);  
}

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

if(Directivo::model()->exists('id_directivo='.'"'.Yii::app()->user->name.'"')){
    echo '<h1>Selección de Profesor(a)</h1>';
}
else{
    echo '<h1>Administrar Usuarios</h1>';
}
?>

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

<?php

if(Directivo::model()->exists('id_directivo='.'"'.Yii::app()->user->name.'"')){
    $this->widget('booster.widgets.TbGridView',array(
    'id'=>'usuario-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
                    'id_usuario',
                    'nombre_usuario',
                    //'password',
                    'email',
                    //'rol',
    array(
    'class' => 'CButtonColumn',
               'template' => '{view}',
                     'viewButtonUrl' =>'Yii::app()->createUrl("/utp/revision/?rut=".$data->primaryKey)',
                     'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                     ), 
    ),
    ));
}
else{
    $this->widget('booster.widgets.TbGridView',array(
    'id'=>'usuario-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
                    'id_usuario',
                    'nombre_usuario',
                    //'password',
                    'email',
                    'rol',
    array(
    'class' => 'CButtonColumn',
               'template' => '{view}{update}{delete}',
                     'viewButtonUrl' =>'Yii::app()->createUrl("/usuario/view?id=".$data->primaryKey)',
                     'viewButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/detalles.png',
                     'updateButtonUrl' =>'Yii::app()->createUrl("/usuario/update?id=".$data->primaryKey)',
                     'updateButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/actualizar.png', 
                     'deleteButtonUrl' =>'Yii::app()->createUrl("/usuario/eliminar?id=".$data->primaryKey)',
                     'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/web/eliminar.png', 
            ), 
    ),
    )); 
}
?>
