<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php if(!Yii::app()->user->isGuest){ 
$this->breadcrumbs=array(
	'Breadcrumbs',
);
?>
<h1><?php echo "Welcome Admin"; ?></h1>

<div class="yui3-g">
	<div class="yui3-u-3-4" >
    
    <h4>Create</h4>
    
    <div>
        <a class="dashboard_button button2" href="<?php echo Yii::app()->createAbsoluteUrl("/user/create"); ?>">
        <span class="dashboard_button_heading">User </span><span>Create User </span>
       </a>
       
       <a class="dashboard_button button2" href="#">
        <span class="dashboard_button_heading">Create Menu 1</span><span>Menu 1 Description</span>
       </a>   
       <a class="dashboard_button button2" href="#">
        <span class="dashboard_button_heading">Create Menu 2</span><span>Menu 2 Description</span>
       </a>   
       <a class="dashboard_button button2" href="#">
        <span class="dashboard_button_heading">Create Menu 3</span><span>Menu 3 Description</span>
       </a> 
    </div>
    
    <div style="clear: both;"></div>
        
    <h4 class="manage" >Manage</h4>
     
     <div>
        <a class="dashboard_button button1" href="<?php echo Yii::app()->createAbsoluteUrl("/user/admin"); ?>">
        <span class="dashboard_button_heading">User</span><span>Manage User</span>
    </a>
    
    
    <a class="dashboard_button button2" href="#">
    <span class="dashboard_button_heading">Manage Menu 1</span><span>Manage Menu 1 Description</span>
   </a>
    
    <a class="dashboard_button button2" href="#">
    <span class="dashboard_button_heading">Manage Menu 2</span><span>Manage Menu 2 Description</span>
   </a>
        
    <a class="dashboard_button button2" href="#">
    <span class="dashboard_button_heading">Manage Menu 3</span><span>Manage Menu 3 Description</span>
   </a>
  
    </div>

    <div style="clear: both;" ></div>
            
    <h4>Reports</h4>
    
    <div>
    <a class="dashboard_button button2" href="#">
        <span class="dashboard_button_heading">User </span><span>User Reports</span>
   </a>   
    </div>
</div>    
<?php    
}else{ ?>
<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
<?php } ?>