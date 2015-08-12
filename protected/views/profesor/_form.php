<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'profesor-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model,'id_profesor',array('type'=>"hidden",'value'=>$id_profesor)); ?>

<label class="control-label">Seleccione</label>
    <?php
        //Se cargan todas los Grados correspondientes a la asignatura de todas las unidades
        //se agrego id_grado!="@" ya que solo se necesitaba la instruccion ORDER BY
        $grado=Grado::model()->findAll('id_grado!="@" ORDER BY id_nivel,id_grado ASC');        
        //se consulta si se seleccionó alguna unidad previamente en sección crear planificación
       
        $text='';
        $child='children: [';
        $end_child="]},";  
        $string_asignatura='';

        //Form de Creacion
        if ($model->id_profesor==NULL){
            foreach ($grado as $data){
                $nombre_grado=$data->nombre_grado;
                $text=$text."{title:'"."[".$nombre_grado."]',folder:true,key:'".$data->id_grado."',";

                $asignatura=Asignatura::model()->findAll("id_grado="."'".$data->id_grado."' ORDER BY id_asignatura ASC");
                foreach ($asignatura as $row){
                    $string_asignatura=$string_asignatura."{title:'".$row->nombre_asignatura."',key:'".$row->id_asignatura."'},";
                }
                $text=$text.$child.$string_asignatura.$end_child;
                $string_asignatura='';
            }                
        }
        //Form de Update
        else{
            $var=array();
            $asignaturas_seleccionadas=ProfesorTieneAsignatura::model()->findAll("id_profesor="."'".$model->id_profesor."'");
            foreach ($asignaturas_seleccionadas as $row){
                array_push($var,$row->id_asignatura);
            }
           
            foreach ($grado as $data){
                $nombre_grado=$data->nombre_grado;
                $text=$text."{title:'"."[".$nombre_grado."]',folder:true,key:'".$data->id_grado."',";
                $asignatura=Asignatura::model()->findAll("id_grado="."'".$data->id_grado."'");
                
                foreach ($asignatura as $row){
                    if (in_array($row->id_asignatura, $var)) {
                        $string_asignatura=$string_asignatura."{title:'".$row->nombre_asignatura."',key:'".$row->id_asignatura."',selected:true},";
                    }
                    else{
                        $string_asignatura=$string_asignatura."{title:'".$row->nombre_asignatura."',key:'".$row->id_asignatura."'},";
                    }                        
                }
                
                $text=$text.$child.$string_asignatura.$end_child;
                $string_asignatura='';
            }     
        }
        //echo $text;
    ?>

<script type="text/javascript">
    var treeData = [
    <?php 
        echo "{title:'Asignaturas',folder:true,key:'asignaturas',children:[".$text."]}";
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
                $("#Profesor_Asignaturas").text(selKeys.join(", "));
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

<div id="tree1"></div>

<div class="row">
<textarea id="Profesor_Asignaturas" name="Profesor[Asignaturas]" rows="1" cols="1" style="display:none"></textarea>         

</div>
<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'context'=>'primary',
                    'label'=>$model->isNewRecord ? 'Guardar Asignaturas' : 'Modificar Asignaturas',
            )); ?>
</div>

<?php $this->endWidget(); ?>
