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
               
        echo "<p align='center'>Decreto Estructura CMO/OFV/AE - <a href='".$link."</a></p>"?>

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
	<?php echo $form->datePickerGroup($model,'fecha_inicio',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

	<?php echo $form->datePickerGroup($model,'fecha_termino',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>')); ?>

<label class="control-label">Contenidos Mínimos Obligatorios (CMO)</label>
        <?php
            //Se cargan todas los CMO correspondientes a la asignatura de todas las unidades
            $cmo=CMO::model()->findAll("id_asignatura='".$id_asignatura."'"." and "."(id_profesor="."'".Yii::app()->user->name."'"." or "."id_profesor is NULL)");
            
            echo '<a href="#" id="btnSelectAll">Seleccionar Todo</a>'
        . '-<a href="#" id="btnDeselectAll">Deseleccionar Todo</a>';
            $text='';
            $string_cmo='';
            
            //Form de Creacion
            if ($model->id_planificacion==null){
                foreach ($cmo as $data){
                    $string_cmo=$string_cmo."{title:'".$data->descripcion_CMO."',folder:true,key:'".$data->id_CMO."'},";
                   
                    $text=$text.$string_cmo;
                    $string_cmo='';
                }                
            }
            //Form de Update
            else{
                $var=array();
                $cmo_seleccionados=PlanificacionTieneCMO::model()->findAll("id_planificacion=".$model->id_planificacion);
                foreach ($cmo_seleccionados as $row){
                    array_push($var,$row->id_CMO);
                }
                $text='';
                foreach ($cmo as $data){
                    if (in_array($data->id_CMO, $var)) {
                        $string_cmo=$string_cmo."{title:'".$data->descripcion_CMO."',folder:true,key:'".$data->id_CMO."',selected:true},";
                    }
                    else{
                        $string_cmo=$string_cmo."{title:'".$data->descripcion_CMO."',folder:true,key:'".$data->id_CMO."'},";
                    }                        
                  
                    $text=$text.$string_cmo;
                    $string_cmo='';
                }     
            }
            //echo $text;
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
                $("#Planificacion_CMOIds").text(selKeys.join(", "));
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
<textarea id="Planificacion_CMOIds" name="Planificacion[CMOIds]" rows="1" cols="1" style="display:none"></textarea>         

<!--------------------------------------------------------------------------------------------------------------------------->

<label class="control-label">Objetivos Fundamentales Verticales (OFV)</label>
        <?php
            //Se cargan todas los OFV correspondientes a la asignatura de todas las unidades
            $ofv=OFV::model()->findAll("id_asignatura='".$id_asignatura."'"." and "."(id_profesor="."'".Yii::app()->user->name."'"." or "."id_profesor is NULL)");
            //se consulta si se seleccionó alguna unidad previamente en sección crear planificación
            //y si el formulario es para creación, de otro modo se cargan todos los OA
            if($model->id_planificacion==NULL&&$id_unidad!=null){
                $ofvs = Yii::app()->db->createCommand("CALL filtro_unidad(".$id_unidad.',"'.$id_asignatura.'"'.")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               

                $array_id=array();

                foreach(ofvs as $row){
                        array_push($array_id, $row->id_CMO);                   
                }
                //Se cargan las OA correspondientes a la unidad seleccionada en sección crear planificación
                $ofv = OFV::model()->findAllByAttributes(array("id_OFV"=>$array_id));
            }
        
            echo '<a href="#" id="btnSelectAll2">Seleccionar Todo</a>'
        . '-<a href="#" id="btnDeselectAll2">Deseleccionar Todo</a>';
            $text='';
            $string_ofv='';
            
            //Form de Creacion
            if ($model->id_planificacion==null){
                foreach ($ofv as $data){
                    $string_ofv=$string_ofv."{title:'".$data->descripcion_OFV."',folder:true,key:'".$data->id_OFV."'},";
                    $text=$text.$string_ofv;
                    $string_ofv='';
                }                
            }
            //Form de Update
            else{
                $var=array();
                $ofv_seleccionados=PlanificacionTieneOFV::model()->findAll("id_planificacion=".$model->id_planificacion);
                foreach ($ofv_seleccionados as $row){
                    array_push($var,$row->id_OFV);
                }
                
                $text='';
                foreach ($ofv as $data){
                        if (in_array($data->id_OFV, $var)) {
                            $string_ofv=$string_ofv."{title:'".$data->descripcion_OFV."',folder:true,key:'".$data->id_OFV."',selected:true},";
                        }
                        else{
                            $string_ofv=$string_ofv."{title:'".$data->descripcion_OFV."',folder:true,key:'".$data->id_OFV."'},";
                        }                        
                  
                    $text=$text.$string_ofv;
                    $string_ofv='';
                }     
            }
            //echo $text;
        ?>
<style type="text/css">
</style>


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
                $("#Planificacion_OFVIds").text(selKeys.join(", "));
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
<textarea id="Planificacion_OFVIds" name="Planificacion[OFVIds]" rows="1" cols="1" style="display:none"></textarea>         
</div>

<!------------------------------------------------------------------------------------------------------------------>

<label class="control-label">Aprendizajes Esperados (AE)</label>
        <?php
            //Se cargan todas los OFV correspondientes a la asignatura de todas las unidades
            $ae=AE::model()->findAll("id_asignatura='".$id_asignatura."'"." and "."(id_profesor="."'".Yii::app()->user->name."'"." or "."id_profesor is NULL)");
            //se consulta si se seleccionó alguna unidad previamente en sección crear planificación
            //y si el formulario es para creación, de otro modo se cargan todos los OA
            if($model->id_planificacion==NULL&&$id_unidad!=null){
                $aes = Yii::app()->db->createCommand("CALL filtro_unidad(".$id_unidad.',"'.$id_asignatura.'"'.")")->setFetchMode(PDO::FETCH_OBJ)->queryAll();               

                $array_id=array();

                foreach($aes as $row){
                        array_push($array_id, $row->id_AE);                   
                }
                //Se cargan las OA correspondientes a la unidad seleccionada en sección crear planificación
                $ae = AE::model()->findAllByAttributes(array("id_AE"=>$array_id));
            }
        
            echo '<a href="#" id="btnSelectAll3">Seleccionar Todo</a>'
        . '-<a href="#" id="btnDeselectAll3">Deseleccionar Todo</a>';
            $text='';
            $string_ae='';
            
            //Form de Creacion
            if ($model->id_planificacion==null){
                foreach ($ae as $data){
                    $string_ae=$string_ae."{title:'".$data->descripcion_AE."',folder:true,key:'".$data->id_AE."'},";
                    
                    $text=$text.$string_ae;
                    $string_ae='';
                }                
            }
            //Form de Update
            else{
                $var=array();
                $ae_seleccionados=PlanificacionTieneAE::model()->findAll("id_planificacion=".$model->id_planificacion);
                foreach ($ae_seleccionados as $row){
                    array_push($var,$row->id_AE);
                }
                
                $text='';
                foreach ($ae as $data){
                    if (in_array($data->id_AE, $var)) {
                            $string_ae=$string_ae."{title:'".$data->descripcion_AE."',folder:true,key:'".$data->id_AE."',selected:true},";
                    }
                    else{
                        $string_ae=$string_ae."{title:'".$data->descripcion_AE."',folder:true,key:'".$data->id_AE."'},";
                    }                        

                    $text=$text.$string_ae;
                    $string_ae='';
                }     
            }
            //echo $text;
        ?>
<style type="text/css">
</style>


<script type="text/javascript">
    var treeData3 = [
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
            source: treeData3,
            
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
                $("#Planificacion_AEIds").text(selKeys.join(", "));
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
        $("#btnDeselectAll3").click(function(){
            $("#tree3").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
            return false;
	});
	$("#btnSelectAll3").click(function(){
            $("#tree3").fancytree("getTree").visit(function(node){
            node.setSelected(true);
            });
            return false;
	});
    });
</script>

<div id="tree3"></div>

<div class="row">
<textarea id="Planificacion_AEIds" name="Planificacion[AEIds]" rows="1" cols="1" style="display:none"></textarea>    

<!--------------------------------------------------------------------------------------------------------------------->

</div>
       	<?php echo $form->textAreaGroup($model,'actividades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->textAreaGroup($model,'recursos', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>
        
        <?php echo $form->textAreaGroup($model,'habilidades', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php //echo $form->textFieldGroup($model,'id_evaluacion',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

<!--------------------------------------------------------------------------------------------------------------------------------------------->
<label class="control-label">Evaluación(es)</label>
    <?php
        //Se cargan todas los OA correspondientes a la asignatura de todas las unidades
        $evaluacion=  Evaluacion::model()->findAll("id_asignatura='".$id_asignatura."'"." and "."id_curso='".$id_curso."'"." and "."id_profesor='".Yii::app()->user->name."'");

        echo '<a href="#" id="btnSelectAll4">Seleccionar Todo</a>'
    . '-<a href="#" id="btnDeselectAll4">Deseleccionar Todo</a>';
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
       // echo $text2;
    ?>

<script type="text/javascript">
    var treeData4 = [
    <?php 
        echo $text;
    ?>	
    ];
	
    $(function(){
        //Inicializacion árbol
        $("#tree4").fancytree({
            //extensions: ["select"],
            checkbox: true,
            selectMode: 3,
            source: treeData4,
            
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
        $("#btnDeselectAll4").click(function(){
            $("#tree4").fancytree("getTree").visit(function(node){
                node.setSelected(false);
            });
            return false;
	});
	$("#btnSelectAll4").click(function(){
            $("#tree4").fancytree("getTree").visit(function(node){
            node.setSelected(true);
            });
            return false;
	});
    });
</script>

<div id="tree4"></div>

<div class="row">
<textarea id="Planificacion_EvaluacionesIds" name="Planificacion[EvaluacionesIds]" rows="1" cols="1" style="display:none"></textarea>         
</div>    
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
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear Planificación' : 'Modificar Planificación',
		)); ?>
</div>

<?php $this->endWidget(); ?>
