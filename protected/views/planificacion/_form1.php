<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'planificacion-form',
	'enableAjaxValidation'=>false,
        //activar widget subir archivos
        'htmlOptions' => array(
        'enctype' => 'multipart/form-data')
)); ?>

    <?php 
    $link="#";
        if($model->id_planificacion==NULL){
            $link="../../programas/".$id_asignatura.".pdf"."' target='_blank'>Revisar Programa";
        }
        else{
            $link="../../../programas/".$id_asignatura.".pdf"."' target='_blank'>Revisar Programa";
        }
               
        echo "<p align='center'>Decreto Estructura OA/Indicador - <a href='".$link."</a></p>"?>

<p class="help-block">Datos con <span class="required">*</span> son requeridos.</p>
    <?php echo $form->errorSummary($model); ?>
    
    <?php //id del profesor agregado de forma automática con variable sesion
    echo $form->hiddenField($model,'id_profesor', array('type'=>"hidden",'value'=>Yii::app()->user->name,)); ?>

    <?php //echo $form->textFieldGroup($model,'id_asignatura',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>4)))); 
    echo $form->hiddenField($model,'id_asignatura', array('type'=>"hidden",'value'=>$id_asignatura)); ?>

    <?php //echo $form->textFieldGroup($model,'id_grado',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>2)))); 
    echo $form->hiddenField($model,'id_grado', array('type'=>"hidden",'value'=>$id_grado)); ?>

    <?php //echo $form->textFieldGroup($model,'id_curso',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>3)))); 
    echo $form->hiddenField($model,'id_curso', array('type'=>"hidden",'value'=>$id_curso)); ?>

    <?php //echo $form->textFieldGroup($model,'fecha_creacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); 
        //Form de Creacion
        if ($model->id_planificacion==null){ 
            echo $form->hiddenField($model,'fecha_creacion', array('type'=>"hidden",'value'=>date('d-m-Y H:i:s',time()))); 
        }
    ?>

    <?php //echo $form->textFieldGroup($model,'fecha_modificacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); 
        //Form de Creacion
        if ($model->id_planificacion==null){ 
            echo $form->hiddenField($model,'fecha_modificacion', array('type'=>"hidden",'value'=>date('d-m-Y H:i:s',time()))); 
        }
    ?>

    <?php //echo $form->textFieldGroup($model,'tipo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); 
    echo $form->hiddenField($model,'tipo', array('type'=>"hidden",'value'=>$tipo)); ?>

    <?php //Form de Creacion
        if ($model->id_planificacion==null){
            echo $form->hiddenField($model,'estado', array('type'=>"hidden",'value'=>'Borrador')); 
        }          
    ?>

    <?php echo $form->datePickerGroup($model,'fecha_inicio',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')),'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

    <?php echo $form->datePickerGroup($model,'fecha_termino',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

<label class="control-label">Objetivos de Aprendizaje (OA)</label>
    <?php
        //Se cargan todas los OA correspondientes a la asignatura de todas las unidades
        $oa=OA::model()->findAll("id_asignatura='".$id_asignatura."'"." and ".
                "(id_profesor="."'".Yii::app()->user->name."'"." or "."id_profesor is NULL)");        
        //se consulta si se seleccionó alguna unidad previamente en sección crear planificación
        if($model->id_planificacion==NULL&&$id_unidad!=null){            
            $oas = Yii::app()->db->createCommand("CALL filtro_unidad_OA(".$id_unidad.",'".
                    $id_asignatura."','".Yii::app()->user->name."')")
                    ->setFetchMode(PDO::FETCH_OBJ)
                    ->queryAll();               
            $array_id=array();
            foreach($oas as $row){
                    array_push($array_id, $row->id_OA);                   
            }
            //Se cargan las OA correspondientes a la unidad seleccionada en sección crear planificación
            $oa = OA::model()->findAllByAttributes(array("id_OA"=>$array_id));
        }

        echo '<a href="#" id="btnSelectAll">Seleccionar Todo</a>'
    . '-<a href="#" id="btnDeselectAll">Deseleccionar Todo</a>';
        $text='';
        $child='children: [{title: "Indicadores",folder:true,children: [';
        $end_child="]},]},";  
        $string_indicadores='';

        //Form de Creacion
        if ($model->id_planificacion==null){
            foreach ($oa as $data){
                $codigooa=substr($data->id_OA,4,8);
                $text=$text."{title:'"."[".$codigooa."] ".$data->descripcion_OA."',key:'".$data->id_OA."',";

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
        //echo $text;
    ?>

<script type="text/javascript">
    var treeData = [
    <?php 
        echo "{title:'Objetivos de Aprendizaje',folder:true,key:'evaluacion',children:[".$text."]}";
    ?>	
    ];
	
    $(function(){
        //Inicializacion árbol
        $("#tree1").fancytree({
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
            $("#tree1").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
            return false;
	});
	$("#btnSelectAll").click(function(){
            $("#tree1").fancytree("getTree").visit(function(node){
            node.setSelected(true);
            });
            return false;
	});
    });
</script>

<div id="tree1"></div>

<div class="row">
<textarea id="Planificacion_IndicadoresIds" name="Planificacion[IndicadoresIds]" rows="1" cols="1" style="display:none"></textarea>         
</div>
    <?php echo $form->textAreaGroup($model,'habilidades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50, 'class'=>'span8')))); ?>

    <?php echo $form->textAreaGroup($model,'actitudes', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50, 'class'=>'span8')))); ?>

    <?php echo $form->textAreaGroup($model,'actividades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50, 'class'=>'span8')))); ?>

    <?php echo $form->textAreaGroup($model,'recursos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50, 'class'=>'span8')))); ?>

    <?php echo $form->textAreaGroup($model,'conocimientos_previos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50, 'class'=>'span8')))); ?>

    <?php echo $form->textAreaGroup($model,'conocimientos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>3, 'cols'=>50, 'class'=>'span8')))); ?>
        
<!--------------------------------------------------------------------------------------------------------------------------------------------->
<label class="control-label">Evaluación(es)</label>
    <?php
        //Se cargan todas los Evalucion
        $evaluacion=  Evaluacion::model()->findAll("id_asignatura='".$id_asignatura."'"." and "."id_curso='".$id_curso."'"." and "."id_profesor='".Yii::app()->user->name."'");

        echo '<a href="#" id="btnSelectAll2">Seleccionar Todo</a>'
    . '-<a href="#" id="btnDeselectAll2">Deseleccionar Todo</a>';
        $text='';
        $string_ev='';

        //Form de Creacion
        if ($model->id_planificacion==null){
                foreach ($evaluacion as $row){
                    $string_ev=$string_ev."{title:'[".$row->nombre_evaluacion."] ".$row->contenido."',folder:true,key:'".$row->id_evaluacion."'},";
                }
                $text=$text.$string_ev;
                $string_ev='';
        }
        //Form de Update
        else{
            $var=array();
            $evaluaciones_seleccionadas=PlanificacionTieneEvaluacion::model()->findAll("id_planificacion=".$model->id_planificacion);
            foreach ($evaluaciones_seleccionadas as $row){
                array_push($var,$row->id_evaluacion);
            }

            foreach ($evaluacion as $row){
                if (in_array($row->id_evaluacion, $var)) {
                    $string_ev=$string_ev."{title:'[".$row->nombre_evaluacion."] ".$row->contenido."',folder:true,key:'".$row->id_evaluacion."',selected:true},";
                }
                else{
                    $string_ev=$string_ev."{title:'[".$row->nombre_evaluacion."] ".$row->contenido."',folder:true,key:'".$row->id_evaluacion."'},";
                }                        
            
                $text=$text.$string_ev;
                $string_ev='';
            }

        }
        //echo $text;
    ?>

<script type="text/javascript">
    var treeData2 = [
    <?php 
        echo $text;
    ?>	
    ];
	
    $(function(){
        //Inicializacion árbol
        $("#tree2").fancytree({
            //extensions: ["select"],
            checkbox: true,
            selectMode: 3,
            source: treeData2,
            
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
                $("#Planificacion_EvaluacionesIds").text(selKeys.join(", "));
                // Se obtiene la lista de los nodos padre
                var selRootNodes = data.tree.getSelectedNodes(true);
                // y se convierte en un arreglo de id
                var selRootKeys = $.map(selRootNodes, function(node){
                    return node.key;
                });
                $("#echoSelection2").text(selRootKeys.join(", "));
                $("#echoSelectionRoots2").text(selRootNodes.join(", "));
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
        $("#btnDeselectAll2").click(function(){
            $("#tree2").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
            return false;
	});
	$("#btnSelectAll2").click(function(){
            $("#tree2").fancytree("getTree").visit(function(node){
            node.setSelected(true);
            });
            return false;
	});
    });
</script>
<div id="tree2"></div>

<div class="row">
<textarea id="Planificacion_EvaluacionesIds" name="Planificacion[EvaluacionesIds]" rows="1" cols="1" style="display:none"></textarea>         
</div>      
    
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
                echo '<label class="control-label">Eliminar - Material de Apoyo</label></br>';
                echo $checkbox;                     
            }
        }
    ?>
</br><label class="control-label">Agregar - Material de Apoyo</label>
    <?php
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Detalles',
            'size' => 'extra_small',
            'context' => 'primary',
            'htmlOptions' => array(
                'onclick' => 'js:bootbox.alert("<strong>Soporta archivos:</strong></p>jpg, gif, png, doc, docx, xls, xlsx, ppt, pptx, pdf</p></p>'
                . '<strong>Máximo: 10 archivos en total</strong>")'
            ),
        )
    );
    ?>
</br>
    <?php
        $this->widget('CMultiFileUpload', array(
        'model'=>$model,
                'name'=>'Planificacion',
        'attribute'=>'Planificacion',
        'accept'=>'jpg|gif|png|doc|docx|xls|xlsx|ppt|pptx|pdf',
        'options'=>array(),
        'denied'=>'Archivo no soportado',
        'max'=>10, // Máximo 10 archivos  
        'duplicate'=>'Archivo duplicado',
        ));
    ?>
    
<div class="form-actions"></br></p>
    <?php 
        $this->widget('booster.widgets.TbButton', array(
                'buttonType'=>'submit',
                'context'=>'primary',
                'label'=>$model->isNewRecord ? 'Crear Planificación' : 'Modificar Planificación',
        )); ?>
</div>

<?php $this->endWidget(); ?>
