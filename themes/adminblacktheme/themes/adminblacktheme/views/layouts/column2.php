<?php $this->beginContent('//layouts/main'); ?>
<div class="yui3-g">
    <div class="yui3-u-1-5">
   	<?php    
    $menucreate=array(
    array('label'=>'User', 'url'=>array('user/create')),
    array('label'=>'Menu 1', 'url'=>"#"),
    array('label'=>'Menu 2', 'url'=>"#"),
    array('label'=>'Menu 3', 'url'=>"#"),
    );
			
    $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'Create','htmlOptions'=>array('class'=>'rightnavadmin'),
    ));
            
    $this->widget('zii.widgets.CMenu', array(
    'items'=>$menucreate,
        'htmlOptions'=>array('class'=>'operations'),
    ));            
    $this->endWidget();
            
    $menumanage=array(    
    array('label'=>'User', 'url'=>array('user/admin')),
    array('label'=>'Menu 1', 'url'=>"#"),
    array('label'=>'Menu 2', 'url'=>"#"),
    array('label'=>'Menu 3', 'url'=>"#"),
    );            
    $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Manage','htmlOptions'=>array('class'=>'rightnavadmin'),
    ));
            
    $this->widget('zii.widgets.CMenu', array(
        'items'=>$menumanage,
        'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();

/** Reports **/
           
    $menumanage=array(    
    array('label'=>'User', 'url'=>array('user/userreports'))  );            
    
    $this->beginWidget('zii.widgets.CPortlet', array(
        'title'=>'Reports','htmlOptions'=>array('class'=>'rightnavadmin'),
    ));
            
    $this->widget('zii.widgets.CMenu', array(
        'items'=>$menumanage,
        'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();

/** Reports  End **/
		?>
</div>

<div class="yui3-u-4-5">
    <div class="leftnavadmin">
        <?php echo $content;?>
    </div>
</div>

</div>
	
        
	

<?php $this->endContent(); ?>