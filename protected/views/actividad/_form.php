<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'actividad-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'id_profesor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'id_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); ?>

	<?php echo $form->textFieldGroup($model,'id_curso',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>3)))); ?>

	<?php echo $form->textFieldGroup($model,'tipo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'estado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->datePickerGroup($model,'fecha_inicio',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click para seleccionar fecha')); ?>

	<?php echo $form->datePickerGroup($model,'fecha_termino',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click para seleccionar fecha')); ?>
        
        <label class="control-label">Objetivos de Aprendizaje (OA)</label>
        <?php 
        
            $text='';
            $child='children: [{title: "Indicadores",children: [';
            $end_child="]},]},";  
            $oa=OA::model()->findAll("id_asignatura='LE01'");
            $string_indicadores='';

            foreach ($oa as $data){

                $codigooa=substr($data->id_OA,4,8);
                $text=$text."{title:'"."[".$codigooa."] ".$data->descripcion_OA."',folder:true,key:'".$data->id_OA."',";

                $indicadores=Indicador::model()->findAll("id_oa="."'".$data->id_OA."'");
                foreach ($indicadores as $row){
                    $string_indicadores=$string_indicadores."{title:'".$row->descripcion_indicador."', key:'".$row->id_indicador."' },";
                }

                $text=$text.$child.$string_indicadores.$end_child;
                $string_indicadores='';

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
            lazyLoad: function(event, ctx) {
                ctx.result = {url: "ajax-sub2.json", debugDelay: 1000};
            },
            loadChildren: function(event, ctx) {
                ctx.node.fixSelection3AfterClick();
            },
            select: function(event, data) {
                // Se obtiene la lista de nodos seleccionados y se transforma en array
                var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
                return node.key;
                });
                $("#Actividad_IndicadoresIds").text(selKeys.join(", "));
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
    });
</script>

<div id="tree3"></div>

<div class="row">
<textarea id="Actividad_IndicadoresIds" name="Actividad[IndicadoresIds]" rows="1" cols="1" style="display:none"></textarea>         
</div>

        <?php echo $form->textAreaGroup($model,'habilidades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'actitudes', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'actividades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'recursos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'conocimientos_previos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'conocimientos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textFieldGroup($model,'id_evaluacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Planificación' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
