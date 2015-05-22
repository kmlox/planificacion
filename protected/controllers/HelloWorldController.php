<?php

class HelloWorldController extends CController
{
        
    public function actionIndex()
    {
        $data = array();
        $data["myValue"] = $this->number;
 
        $this->render('index', $data);
    }
 
    public function actionUpdateAjax()
    {
        $data = array();
        $value=$this->number+1;
        $data["myValue"] = $value;
        $this->number=$value;
        
              
 
        $this->renderPartial('_ajaxContent', $data, false, true);
    }
    
     
    public function accessRules()
    {
            return array(
                    array('allow',  // allow all users to perform 'index' and 'view' actions
                            'actions'=>array('index','view','updateajax'),
                            'users'=>array('*'),
                    ),
            );
    }

}
