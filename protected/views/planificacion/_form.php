<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'planificacion-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data')
)); ?>

<p class="help-block">Datos con <span class="required">*</span> son requeridos.</p>

<?php echo $form->errorSummary($model); ?>

	<?php //id del profesor agregado de forma automática con variable sesion
        echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name,)); ?>
	
	<?php echo $form->textFieldGroup($model,'id_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

	<?php echo $form->textFieldGroup($model,'id_grado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2)))); ?>

	<?php echo $form->textFieldGroup($model,'id_curso',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>3)))); ?>

	<?php echo $form->textFieldGroup($model,'fecha_creacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<?php echo $form->textFieldGroup($model,'fecha_modificacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<?php echo $form->textFieldGroup($model,'tipo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'estado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->datePickerGroup($model,'fecha_inicio',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click para seleccionar fecha')); ?>

	<?php echo $form->datePickerGroup($model,'fecha_termino',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click para seleccionar fecha')); ?>

<label class="control-label">Objetivos de Aprendizaje (OA)</label>
        <?php 
            echo '<a href="#" id="btnSelectAll">Seleccionar Todo</a>'
        . '-<a href="#" id="btnDeselectAll">Deseleccionar Todo</a>';
            $text='';
            $child='children: [{title: "Indicadores",children: [';
            $end_child="]},]},";  
            $oa=OA::model()->findAll("id_asignatura='LE01'");
            $string_indicadores='';
            
            //Form de Creacion
            if ($model->id_planificacion==null){
                foreach ($oa as $data){
                    $codigooa=substr($data->id_OA,4,8);
                    $text=$text."{title:'"."[".$codigooa."] ".$data->descripcion_OA."',folder:true,key:'".$data->id_OA."',";

                    $indicadores=Indicador::model()->findAll("id_oa="."'".$data->id_OA."'");
                    foreach ($indicadores as $row){
                        $string_indicadores=$string_indicadores."{title:'".$row->descripcion_indicador."',key:'".$row->id_indicador."'},";
                    }
                    $text=$text.$child.$string_indicadores.$end_child;
                    $string_indicadores='';
                }                
            }
            //Form de Update
            else{
                $var=array();
                $indicadores_seleccionados=PlanificacionTieneIndicador::model()->findAll("id_planificacion=".$model->id_planificacion);
                foreach ($indicadores_seleccionados as $row){
                    array_push($var,$row->id_indicador);
                }
                               
                foreach ($oa as $data){
                    $codigooa=substr($data->id_OA,4,8);
                    $text=$text."{title:'"."[".$codigooa."] ".$data->descripcion_OA."',folder:true,key:'".$data->id_OA."',";

                    $indicadores=Indicador::model()->findAll("id_oa="."'".$data->id_OA."'");
                    foreach ($indicadores as $row){
                        if (in_array($row->id_indicador, $var)) {
                            $string_indicadores=$string_indicadores."{title:'".$row->descripcion_indicador."',key:'".$row->id_indicador."',selected:true},";
                        }
                        else{
                            $string_indicadores=$string_indicadores."{title:'".$row->descripcion_indicador."',key:'".$row->id_indicador."'},";
                        }                        
                    }
                    $text=$text.$child.$string_indicadores.$end_child;
                    $string_indicadores='';
                }     
            }
          //  echo $text;
        ?>
<style type="text/css">
</style>


<script type="text/javascript">
    var treeData = [
    <?php 
        echo $text;
    ?>	
    ];
	
    $(function(){
        //Inicializacion árbol
        $("#tree3").fancytree({
            //extensions: ["select"],
            checkbox: true,
            selectMode: 3,
            source: treeData,
            
            //lazyLoad: function(event, ctx) {
            //    ctx.result = {url: "ajax-sub2.json", debugDelay: 1000};
            //},
            //loadChildren: function(event, ctx) {
            //    ctx.node.fixSelection3AfterClick();
            //},
            select: function(event, data) {
                // Se obtiene la lista de nodos seleccionados y se transforma en array
                var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
                return node.key;
                });
                $("#Planificacion_IndicadoresIds").text(selKeys.join(", "));
                // Se obtiene la lista de los nodos padre
                var selRootNodes = data.tree.getSelectedNodes(true);
                // y se convierte en un arreglo de id
                var selRootKeys = $.map(selRootNodes, function(node){
                    return node.key;
                });
                $("#echoSelection3").text(selRootKeys.join(", "));
                $("#echoSelectionRoots3").text(selRootNodes.join(", "));
            },
            dblclick: function(event, data) {
                data.node.toggleSelected();
            },
            keydown: function(event, data) {
                if( event.which === 32 ) {
                    data.node.toggleSelected();
                return false;
                }
            },
        // cookie e id que maneja el script
        cookieId: "fancytree-Cb3",
        idPrefix: "fancytree-Cb3-"
        });
        $("#btnDeselectAll").click(function(){
            $("#tree3").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
            return false;
	});
	$("#btnSelectAll").click(function(){
            $("#tree3").fancytree("getTree").visit(function(node){
            node.setSelected(true);
            });
            return false;
	});
    });
</script>

<div id="tree3"></div>

<div class="row">
<textarea id="Planificacion_IndicadoresIds" name="Planificacion[IndicadoresIds]" rows="1" cols="1" style="display:none"></textarea>         
</div>
        <?php echo $form->textAreaGroup($model,'habilidades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'actitudes', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'actividades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'recursos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'conocimientos_previos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'conocimientos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php //echo $form->textFieldGroup($model,'id_evaluacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>
<label class="control-label">Evaluación</label></br>       
        <?php echo $form->dropDownList($model,'id_evaluacion', CHtml::listData(Evaluacion::model()->findAll(), 'id_evaluacion','nombre_evaluacion'),array('empty'=>'Seleccione Evaluación')); ?> 
</br>
            <?php
            //Form de Update
            if ($model->id_planificacion!=null){
                $cont=1;
                $checkbox='';
                $material_apoyo=MaterialApoyo::model()->findAll("id_planificacion=".$model->id_planificacion);
                foreach($material_apoyo as $doc){
                    $checkbox=$checkbox.'<input type="checkbox" name="Planificacion[id_doc'.$cont.']" value='.'"'.$doc->id_material_apoyo.'"'.'/>';               
                    $checkbox=$checkbox.'<a href='.'"'.$doc->url.'"'.'target="_blank">'.$doc->nombre_material_apoyo.'</a><br/>';
                    $cont=$cont+1;
                }
                if($cont>1){
                    echo '</br><label class="control-label">Eliminar - Material de Apoyo</label></br>';
                    echo $checkbox;               
                }
                
            }
            ?>
</br><label class="control-label">Agregar - Material de Apoyo</label></br>
<?php
            
            $this->widget('CMultiFileUpload', array(
                'model'=>$model,
                        'name'=>'Planificacion',
                'attribute'=>'Planificacion',
                'accept'=>'jpg|gif|png|doc|docx|xls|xlsx|ppt|pptx|pdf',
                'options'=>array(),
                'denied'=>'Archivo no soportado',
                'max'=>10, // max 10 files  
                        'duplicate'=>'Archivo duplicado',
  		));
            ?>
    
<div class="form-actions"></br></p>
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Planificación' : 'Modificar Planificación',
		)); ?>
</div>

<?php $this->endWidget(); ?>
